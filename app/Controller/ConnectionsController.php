<?php
App::uses('AppController', 'Controller');
/**
 * Connections Controller
 *
 * @property Connection $Connection
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ConnectionsController extends AppController {
     
/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
    public $uses = array('Connection','User');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Connection->recursive = 1;
		$this->set('connections', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Connection->exists($id)) {
			throw new NotFoundException(__('Invalid connection'));
		}
		$options = array('conditions' => array('Connection.' . $this->Connection->primaryKey => $id));
		$this->set('connection', $this->Connection->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
        $loggedInUser = $this->Session->read('Auth.User');
        $user_id = $loggedInUser['id'];
		if ($this->request->is('post')) {
            $this->request->data['Connection']['user_id'] = $user_id;
            error_log("CONNECTION REQUEST :". print_r( $this->request, 1));
			$this->Connection->create();
            $this->request->data['Connection']['verified'] = 0;
			if ($this->Connection->save($this->request->data)) {
				$this->Session->setFlash(__('Your connection has been saved but must be verified.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The connection could not be saved. Please, try again.'));
			}
		}
		$connections = $this->User->find('list');
		$this->set(compact('connections'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Connection->exists($id)) {
			throw new NotFoundException(__('Invalid connection'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Connection->save($this->request->data)) {
				$this->Session->setFlash(__('The connection has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The connection could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Connection.' . $this->Connection->primaryKey => $id));
			$this->request->data = $this->Connection->find('first', $options);
		}
		$users = $this->Connection->find('list');
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Connection->id = $id;
		if (!$this->Connection->exists()) {
			throw new NotFoundException(__('Invalid connection'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Connection->delete()) {
			$this->Session->setFlash(__('The connection has been deleted.'));
		} else {
			$this->Session->setFlash(__('The connection could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * verify method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function verify($id = null) {
        $loggedInUser = $this->Session->read('Auth.User');
        $user_id = $loggedInUser['id'];

		if (!$this->Connection->exists($id)) {
			throw new NotFoundException(__('Invalid connection'));
		}

        //Get the connection
        // AND Verfify that it is address to this user
        $connection = $this->Connection->find('first', array('conditions' => array('Connection.id' => $id, 'Connection.connection_id' => $user_id)));
        if ( $connection ) {
            
            // If this connection exists then Save settings.
		    if ($this->request->is(array('post', 'put'))) {

                $this->request->data['Connection']['id']            = $connection['Connection']['id'];
                $this->request->data['Connection']['user_id']       = $connection['Connection']['user_id'];
                $this->request->data['Connection']['connection_id'] = $connection['Connection']['connection_id'];
                $this->request->data['Connection']['message']       = $connection['Connection']['message'];
                
			    if ($this->Connection->save($this->request->data)) {
				    $this->Session->setFlash(__('The connection has been verified.'));
    				return $this->redirect(array('action' => 'index'));
    			} else {
    				$this->Session->setFlash(__('The connection could not be saved. Please, try again.'));
    			}
		    }
        } else {
    	    $this->Session->setFlash(__('Connection could not be verified.'));
        }
		$connections = $this->Connection->find('list');
		$this->set(compact('connections'));
    	#return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Connection->recursive = 0;
		$this->set('connections', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Connection->exists($id)) {
			throw new NotFoundException(__('Invalid connection'));
		}
		$options = array('conditions' => array('Connection.' . $this->Connection->primaryKey => $id));
		$this->set('connection', $this->Connection->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Connection->create();
			if ($this->Connection->save($this->request->data)) {
				$this->Session->setFlash(__('The connection has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The connection could not be saved. Please, try again.'));
			}
		}
		$users = $this->Connection->User->find('list');
		$this->set(compact('users'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Connection->exists($id)) {
			throw new NotFoundException(__('Invalid connection'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Connection->save($this->request->data)) {
				$this->Session->setFlash(__('The connection has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The connection could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Connection.' . $this->Connection->primaryKey => $id));
			$this->request->data = $this->Connection->find('first', $options);
		}
		$users = $this->Connection->User->find('list');
		$this->set(compact('users'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Connection->id = $id;
		if (!$this->Connection->exists()) {
			throw new NotFoundException(__('Invalid connection'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Connection->delete()) {
			$this->Session->setFlash(__('The connection has been deleted.'));
		} else {
			$this->Session->setFlash(__('The connection could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
