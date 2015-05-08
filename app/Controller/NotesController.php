<?php
App::uses('AppController', 'Controller');
/**
 * Notes Controller
 *
 * @property Note $Note
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class NotesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
    public $uses = array('Note', 'User');
    public $findMethods = array('available' => true);

/**
 * index method
 *
 * @return void
 */
	public function index() {
        $loggedInUser = $this->Session->read('Auth.User');
        $user_id = $loggedInUser['id'];
		$this->Note->recursive = 0;

        $conditions = array("Note.user_id" => $user_id, "Note.sender_delete" => 0);
        $notesOutgoing = $this->Note->find('all', array('conditions' => $conditions));
		$this->set('notesOutgoing', $notesOutgoing);
        
        $conditions = array("Note.to_user_id" => $user_id, "Note.receiver_delete" => 0);
        $notesIncoming = $this->Note->find('all', array('conditions' => $conditions));
		$this->set('notesIncoming', $notesIncoming);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Note->exists($id)) {
			throw new NotFoundException(__('Invalid note'));
		}
		$options = array('conditions' => array('Note.' . $this->Note->primaryKey => $id));
		$this->set('note', $this->Note->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Note->create();
            $username = $this->request->data['Note']['username'] ;
            $user_to = $this->User->findByUsername($username);
            if ( $user_to ) {
                $this->request->data['UserTo'] = $user_to;
                $this->request->data['Note']['to_user_id'] = $user_to['User']['id'];
                $loggedInUser = $this->Session->read('Auth.User');
                $this->request->data['Note']['user_id'] = $loggedInUser['id'];
                $this->request->data['User'] = $loggedInUser;
                $this->request->data['User']['id'] = $loggedInUser['id'];
			    if ($this->Note->save($this->request->data)) {
				    $this->Session->setFlash(__('The note has been saved.'));
				    return $this->redirect(array('action' => 'index'));
			    } else {
				    $this->Session->setFlash(__('The note could not be saved. Please, try again.'));
			    }
            } else {
			    $this->Session->setFlash(__('Invalid Username. Please, try again.'));
            }
		}
		//$users = $this->Note->User->find('list');
		//$toUsers = $this->Note->ToUser->find('list');
		//$this->set(compact('users', 'toUsers'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Note->exists($id)) {
			throw new NotFoundException(__('Invalid note'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Note->save($this->request->data)) {
				$this->Session->setFlash(__('The note has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The note could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Note.' . $this->Note->primaryKey => $id));
			$this->request->data = $this->Note->find('first', $options);
		}
		$users = $this->Note->User->find('list');
		$toUsers = $this->Note->ToUser->find('list');
		$this->set(compact('users', 'toUsers'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
        $loggedInUser = $this->Session->read('Auth.User');
		$this->Note->id = $id;
		if (!$this->Note->exists()) {
			throw new NotFoundException(__('Invalid note'));
		}
		$this->request->allowMethod('post', 'delete', 'ajax');

        $note = $this->Note->find('first', array('conditions' => array('Note.id' => $id)));
        if ( $note['Note']['user_id'] == $loggedInUser['id'] ) {
          $note['Note']['sender_delete'] = 1;
        } 
        if ( $note['Note']['to_user_id'] == $loggedInUser['id'] ) {
          $note['Note']['receiver_delete'] = 1;
        }

        error_log( print_r($note,1));

        $delete_flag = 0;
        if ( $note['Note']['sender_delete'] == 1 && $note['Note']['receiver_delete'] == 1 ) {
            if ($this->Note->delete() ) {
                $delete_flag = 1;
            }
        } else {
            if ($this->Note->save($note) ) {
                $delete_flag = 1;
            }
        }

        if ( $this->request->is('ajax') ) {
            $this->autoRender = false;
            $this->layout = 'ajax';
            return json_encode($delete_flag);
        } else {
            if ( $delete_flag ) {
			    $this->Session->setFlash(__('The note has been deleted.'));
		        return $this->redirect(array('action' => 'index'));
		    } else {
			    $this->Session->setFlash(__('The note could not be deleted. Please, try again.'));
		        return $this->redirect(array('action' => 'index'));
		    }
        }
	}


/**
 * reply method
 *
 * @return void
 */
    public function reply($id = null) {
        $loggedInUser = $this->Session->read('Auth.User');
		$this->Note->id = $id;
		if (!$this->Note->exists()) {
			throw new NotFoundException(__('Invalid note'));
        } else {
            $note = $this->Note->find('first', array('conditions' => array('Note.id' => $this->Note->id)));
            $this->set('subject', "Re: " . $note['Note']['subject']);
        }
		if ($this->request->is(array('post', 'put'))) {

            $this->Note->create();
            error_log( print_r($this->request->data['Note'],1));
            
            // Reverse the user_id and to_user_id since this is a reply
            $new_note_user_id = $this->request->data['Note']['to_user_id'];
            $new_note_to_user_id = $this->request->data['Note']['user_id'];
            $this->request->data['Note']['user_id'] = $new_note_user_id;
            $this->request->data['Note']['to_user_id'] = $new_note_to_user_id;

            error_log( print_r($this->request->data['Note'],1));

			if ($this->Note->save($this->request->data)) {
				$this->Session->setFlash(__('Your Reply Has Been Sent.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The note could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Note.' . $this->Note->primaryKey => $id));
			$this->request->data = $this->Note->find('first', $options);
		}
		//$toUser = $this->Note->User->find('first');
		//$user = $this->Note->ToUser->find('first');
		//$this->set(compact('user', 'toUser'));
    }


/**
 * mark_read method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function mark_read($id = null) {
        $this->autoRender = false;
        $this->layout = 'ajax';

        error_log("User Agent? : " . $this->request->header('User-Agent') );

        $result = 0;
        
		if (!$this->Note->exists($id)) {
			throw new NotFoundException(__('Invalid note'));
			$result = 0;
        }
        $loggedInUser = $this->Session->read('Auth.User');
        $user_id = $loggedInUser['id'];

        $options = array('conditions' => array('Note.' . $this->Note->primaryKey => $id));
        $note = $this->Note->find('first', $options); 

        if ( $note['Note']['to_user_id'] == $user_id) { 
            $note['Note']['read'] = 1;
            if ( $this->Note->save($note) ) {
				$result = 1;
            }
        }
        return json_encode($result);
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Note->recursive = 0;
		$this->set('notes', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Note->exists($id)) {
			throw new NotFoundException(__('Invalid note'));
		}
		$options = array('conditions' => array('Note.' . $this->Note->primaryKey => $id));
		$this->set('note', $this->Note->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Note->create();
			if ($this->Note->save($this->request->data)) {
				$this->Session->setFlash(__('The note has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The note could not be saved. Please, try again.'));
			}
		}
		$users = $this->Note->User->find('list');
		$toUsers = $this->Note->ToUser->find('list');
		$this->set(compact('users', 'toUsers'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Note->exists($id)) {
			throw new NotFoundException(__('Invalid note'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Note->save($this->request->data)) {
				$this->Session->setFlash(__('The note has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The note could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Note.' . $this->Note->primaryKey => $id));
			$this->request->data = $this->Note->find('first', $options);
		}
		$users = $this->Note->User->find('list');
		$toUsers = $this->Note->ToUser->find('list');
		$this->set(compact('users', 'toUsers'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Note->id = $id;
		if (!$this->Note->exists()) {
			throw new NotFoundException(__('Invalid note'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Note->delete()) {
			$this->Session->setFlash(__('The note has been deleted.'));
		} else {
			$this->Session->setFlash(__('The note could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
