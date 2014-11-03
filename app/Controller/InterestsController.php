<?php
App::uses('AppController', 'Controller');
/**
 * Interests Controller
 *
 * @property Interest $Interest
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class InterestsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
    public $uses = array('Interest','Activity','User');

     public function beforeFilter() {
         parent::beforeFilter();
         $this->Auth->allow(array('add','edit'));
     }

/**
 * index method
 *
 * @return void
 */
	public function index() {
        $loggedInUser = $this->Session->read('Auth.User');
        $user_id = $loggedInUser['id'];
		$this->Interest->recursive = 1;
		$this->Paginator->settings = array('conditions' => array('Interest.user_id' => $user_id));
		$this->set('interests', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	#public function view($id = null) {
	#	if (!$this->Interest->exists($id)) {
	#		throw new NotFoundException(__('Invalid interest'));
	#	}
	#	$options = array('conditions' => array('Interest.' . $this->Interest->primaryKey => $id));
	#	$this->set('interest', $this->Interest->find('first', $options));
	#}
    public function view($id = null) {
        if (!$this->Interest->exists($id)) {
            throw new NotFoundException(__('Invalid interest'));
        }
        $options = array('conditions' => array('Interest.' . $this->Interest->primaryKey => $id));
        $this->set('interest', $this->Interest->find('first', $options));
    }

/**
 * add method
 *
 * @return void
 */
	#public function add() {
	#	if ($this->request->is('post')) {
	#		$this->Interest->create();
	#		if ($this->Interest->save($this->request->data)) {
	#			$this->Session->setFlash(__('The interest has been saved.'));
	#			return $this->redirect(array('action' => 'index'));
	#		} else {
	#			$this->Session->setFlash(__('The interest could not be saved. Please, try again.'));
	#		}
	#	}
	#	$users = $this->Interest->User->find('list');
	#	$activities = $this->Interest->Activity->find('list');
	#	$activities = $this->Interest->Activity->find('list');
	#	$this->set(compact('users', 'activities', 'activities'));
    #}
    public function add() {
        $loggedInUser = $this->Session->read('Auth.User');
        $user_id = $loggedInUser['id'];
        if ($this->request->is('post')) {
            $save_count = 0;
            #error_log("REQUEST : " . print_r( $this->request->data() , 1));
            foreach( $this->request->data['Interest'] as $each_interest) {
                #error_log("EACH INTEREST : " . print_r( $each_interest, 1));
                if ( array_key_exists('activity_id', $each_interest) ) {
                    $new_interest = array( 'Interest' => array(
                            'user_id' => $this->Session->read('Auth.User.id'),
                            'activity_id' => $each_interest['activity_id'],
                            'giving' => $each_interest['giving'],
                            'recieving' => $each_interest['recieving'],
                            'importance' => $each_interest['importance'],
                            'experience' => $each_interest['experience'],
                        )
                    );
                    error_log("NEW INTEREST : " . print_r($new_interest,1));
                    $this->Interest->create();
                    if( $this->Interest->save($new_interest)) {
                        error_log("INTEREST SAVED");
                        ++$save_count;
                    } else {
                        $this->Session->setFlash(__('The interest could not be saved. Please, try again.'));
                    }
                }
            }
            $this->Session->setFlash(__($save_count . ' interests saved.'));
            //$this->Interest->recursive = 1;
            //$users = $this->Interest->User->find('list');
            //$this->set(compact('users'));
            //$this->set('activities', $this->Activity->find('all'));
            //return $this->redirect('view/' . $this->Session->read('Auth.User.id'));
			//return $this->redirect(array('controller' => 'users', 'action' => 'view', $user_id));
			return $this->redirect(array('controller' => 'interests', 'action' => 'index'));
        } else {
            $this->set('activities', $this->Activity->find('all'));
            $this->set('interests', $this->Interest->find('all'));
        }
    }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Interest->exists($id)) {
			throw new NotFoundException(__('Invalid interest'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Interest->save($this->request->data)) {
				$this->Session->setFlash(__('The interest has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The interest could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Interest.' . $this->Interest->primaryKey => $id));
			$this->request->data = $this->Interest->find('first', $options);
		}
		$users = $this->Interest->User->find('list');
		$activities = $this->Interest->Activity->find('list');
		$activities = $this->Interest->Activity->find('list');
		$this->set(compact('users', 'activities', 'activities'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Interest->id = $id;
		if (!$this->Interest->exists()) {
			throw new NotFoundException(__('Invalid interest'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Interest->delete()) {
			$this->Session->setFlash(__('The interest has been deleted.'));
		} else {
			$this->Session->setFlash(__('The interest could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Interest->recursive = 1;
		$this->set('interests', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Interest->exists($id)) {
			throw new NotFoundException(__('Invalid interest'));
		}
		$options = array('conditions' => array('Interest.' . $this->Interest->primaryKey => $id));
		$this->set('interest', $this->Interest->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Interest->create();
			if ($this->Interest->save($this->request->data)) {
				$this->Session->setFlash(__('The interest has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The interest could not be saved. Please, try again.'));
			}
		}
		$users = $this->Interest->User->find('list');
		$activities = $this->Interest->Activity->find('list');
		$activities = $this->Interest->Activity->find('list');
		$this->set(compact('users', 'activities', 'activities'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Interest->exists($id)) {
			throw new NotFoundException(__('Invalid interest'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Interest->save($this->request->data)) {
				$this->Session->setFlash(__('The interest has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The interest could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Interest.' . $this->Interest->primaryKey => $id));
			$this->request->data = $this->Interest->find('first', $options);
		}
		$users = $this->Interest->User->find('list');
		$activities = $this->Interest->Activity->find('list');
		$activities = $this->Interest->Activity->find('list');
		$this->set(compact('users', 'activities', 'activities'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Interest->id = $id;
		if (!$this->Interest->exists()) {
			throw new NotFoundException(__('Invalid interest'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Interest->delete()) {
			$this->Session->setFlash(__('The interest has been deleted.'));
		} else {
			$this->Session->setFlash(__('The interest could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
