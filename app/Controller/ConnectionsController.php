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
    public $uses = array('Connection','User', 'Search');

/**
 * index method
 *
 * @return void
 */
    public function index() {
        $loggedInUser = $this->Session->read('Auth.User');
        $user_id = $loggedInUser['id'];
        $this->Connection->recursive = 1;
        $connections = $this->Connection->findAllByUserId($user_id);
        $this->set('connections', $connections);
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function view($id = null) {
        $loggedInUser = $this->Session->read('Auth.User');
        $user_id = $loggedInUser['id'];
        if (!$this->Connection->exists($id)) {
            throw new NotFoundException(__('Invalid connection'));
        }
        $options = array('conditions' => array('Connection.' . $this->Connection->primaryKey => $id));
        $connection = $this->Connection->find('first', $options);
        //pr($connection);
        if ( $connection['Connection']['user_id'] == $user_id ) {
            $this->set(compact('connection')); 
        } else {
            $this->Session->setFlash(__('You Can\'t View That.'));
            return $this->redirect(array('controller' => 'users', 'action' => 'view', $user_id));
        }
    }

/**
 * add method
 *
 * @return void
 */
    public function add($id = null) {
        $loggedInUser = $this->Session->read('Auth.User');
        $user_id = $loggedInUser['id'];

        if ($this->request->is('post')) {
            $this->request->data['Connection']['user_id'] = $user_id;

            #error_log("CONNECTION REQUEST :". print_r( $this->request, 1));

            $other_user = $this->request->data['Connection']['connection_id'];
            $pending_out_connections = $this->Connection->find('first', array('conditions' => array( 'Connection.user_id' => $user_id, 'Connection.connection_id' => $other_user )));
            $pending_inc_connections = $this->Connection->find('first', array('conditions' => array( 'Connection.user_id' => $other_user, 'Connection.connection_id' => $user_id )));
            
            if ( count($pending_out_connections) > 0 || count($pending_inc_connections) > 0 ) {
                $this->Session->setFlash(__('You Already Have a Pending or Existing Connection With That User'));
                return $this->redirect(array('action' => 'add', $id)); 
            }
            
            if ( ! $this->request->data['Connection']['connection_id'] ) {
                $this->Session->setFlash(__('Null User'));
                return $this->redirect(array('action' => 'add')); 
            }

            // if () { 
            //    TODO - Some method of stopping a user from spamming connection requests. A limit on the number per time period? 
            // }

            $this->Connection->create();
            $this->request->data['Connection']['verified'] = 0;
            if ($this->Connection->save($this->request->data)) {
                $this->Session->setFlash(__('Your FOOBAR connection has been saved but must be verified.'));

                // Create a recirpical connection 
                $r_connection = $this->Connection->findByUserIdAndConnectionId( $other_user, $user_id );
                error_log("RECIPROCAL CONNECTIONS: ". print_r($r_connection,1));
                if ( count($r_connection) > 0 ) {
                    $this->Session->setFlash(__('A reciprocal connection already exists.'));                        
                } else {
                    //Create a recipocal connection
                    if( $this->Connection->create() ) { 
                        $recip_connection['Connection']['user_id'] = $other_user;
                        $recip_connection['Connection']['connection_id'] = $user_id;
                        $recip_connection['Connection']['connection_type'] = "Unknown";
                        //$recip_connection['Connection']['connection_type'] = $this->request->data['Connection']['connection_type'];
                        $recip_connection['Connection']['message'] = 'Automatically Created Reciprocal Connection';
                        if ( $this->Connection->save( $recip_connection) ) {
                            $this->Session->setFlash(__('The connection has been verified and a reciprocal connection saved.'));
                            return $this->redirect(array('action' => 'index'));
                        }
                    }
                }
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The connection could not be saved. Please, try again.'));
            }
        } 
        if ( $id ) {
            $connections = $this->User->find('list', array('conditions' => array('User.id' => $id), 'fields' => array('User.id', 'User.username'), 'recursive' => -1));
        } else {
            $connections = $this->User->find('list', array('conditions' => array('User.id !=' => $user_id), 'fields' => array('User.id', 'User.username'), 'recursive' => 1));
        }
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
        $loggedInUser = $this->Session->read('Auth.User');
        $user_id = $loggedInUser['id'];

        if (!$this->Connection->exists($id)) {
            throw new NotFoundException(__('Invalid connection'));
        }

        // If you are the one being connected to you should be able to verify this connection
        if ( $this->isSubject($id) ) {
            $this->Session->setFlash(__('You can\'t edit this connection but you can verify it.'));
            return $this->redirect(array('controller' => 'connections', 'action' => 'verify', $id));
        }
        
        // If you are the one being connected to you should be able to edit this connection
        $connection = $this->isOwner($id);
        if ( $connection ) {
            if ($this->request->is(array('post', 'put'))) {
                $this->request->data['Connection']['id']            = $connection['Connection']['id'];
                $this->request->data['Connection']['user_id']       = $connection['Connection']['user_id'];
                $this->request->data['Connection']['connection_id'] = $connection['Connection']['connection_id'];
                if ($this->Connection->save($this->request->data)) {
                    $this->Session->setFlash(__('The connection has been saved.'));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The connection could not be saved. Please, try again.'));
                }
            } else {
			     $options = array('conditions' => array('Connection.' . $this->User->primaryKey => $id));
			     $this->request->data = $this->Connection->find('first', $options);
            } 
        } else {
            $this->Session->setFlash(__('You cannot edit this connection foo.'));
            return $this->redirect(array('controller' => 'users', 'action' => 'view', $user_id));
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
        $loggedInUser = $this->Session->read('Auth.User');
        $user_id = $loggedInUser['id'];
        $this->Connection->id = $id;
        if (!$this->Connection->exists()) {
            throw new NotFoundException(__('Invalid connection'));
        }
        if ( $this->isOwner($id) || $this->isSubject($id) ) {
            $this->request->allowMethod('post', 'delete');
            if ($this->Connection->delete()) {
                $this->Session->setFlash(__('The connection has been deleted.'));
            } else {
                $this->Session->setFlash(__('The connection could not be deleted. Please, try again.'));
            }
        } else {
            $this->Session->setFlash(__('You Could Not Delete That Connection.'));
        }
        return $this->redirect(array('controller' => 'users', 'action' => 'view', $user_id));
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
        $connection = $this->isSubject($id);
        if ( $connection ) {
            
            $this_connection = $connection['Connection']['id'];
            $owner_user = $connection['Connection']['connection_id'];
            $other_user = $connection['Connection']['user_id'];
            $this_user = $user_id;

            // If this connection exists then Save settings.
            if ($this->request->is(array('post', 'put'))) {

                $this->request->data['Connection']['id']            = $connection['Connection']['id'];
                $this->request->data['Connection']['user_id']       = $connection['Connection']['user_id'];
                $this->request->data['Connection']['connection_id'] = $connection['Connection']['connection_id'];
                $this->request->data['Connection']['message']       = $connection['Connection']['message'];
                $this->request->data['Connection']['verified']      = 1;
                
                if ($this->Connection->save($this->request->data)) {
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The connection could not be saved. Please, try again.'));
                }
            }
        } else {
            $this->Session->setFlash(__('Connection could not be verified.'));
            return $this->redirect(array('controller' => 'Users', 'action' => 'view', $user_id));
        }
        $this->set(compact('connection'));
        #return $this->redirect(array('action' => 'index'));
    }

/**
 * isOwner method
 *
 * @return connection 
 */
    public function isOwner($connection_id) {
        $loggedInUser = $this->Session->read('Auth.User');
        $user_id = $loggedInUser['id'];
        $return = false;
        if ($this->Connection->exists($connection_id)) {
             $connection = $this->Connection->find('first', array('conditions' => array('Connection.id' => $connection_id, 'Connection.user_id' => $user_id)));
             if ( $connection ) {
                 $return = $connection;
             }
        }
        return $return;
    }

/**
 * isSubject method
 *
 * @return connection
 */
    public function isSubject($connection_id) {
        $loggedInUser = $this->Session->read('Auth.User');
        $user_id = $loggedInUser['id'];
        $return = false;
        if ($this->Connection->exists($connection_id)) {
             $connection = $this->Connection->find('first', array('conditions' => array('Connection.id' => $connection_id, 'Connection.connection_id' => $user_id)));
             if ( $connection ) {
                 $return = $connection;
             }
        }
        return $return;
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
        $users = $this->Connection->User->find('list', array( 'fields' => array('username')));
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
