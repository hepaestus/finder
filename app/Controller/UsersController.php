<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session','Solr');
    public $uses = array('User','Activity','Profile','ExtendedProfile','Connection','Reputation');
    public $findMethods = array('available' => true);


    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('register','login','logout','view','edit','delete');
    }

    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->User->id = $this->Auth->user('id');
                $this->User->saveField('lastlogin', date("Y-m-d H:i:s"));
                $this->User->saveField('loggedin', 1);
                return $this->redirect($this->Auth->redirect(array('controller' => 'users', 'action' => 'view', $this->Auth->user('id'))));
            }
            //$this->Session->setFlash(__('Your username or password was incorrect.'));
            $this->Session->setFlash(__('Invalid Username or Password, Try Again'));
        }
    }

    public function logout() {
        $loggedInUser = $this->Session->read('Auth.User');
        $this->User->id = $loggedInUser['id'];
        //$this->User->id = $this->Auth->user('id');
        $this->User->saveField('loggedin', 0);
        return $this->redirect($this->Auth->logout('/pages/finder'));
    }

    public function register() {
        if ($this->request->is('post') ) {
            $this->User->create();
            error_log(" REQUEST DATA: " . print_r($this->request->data, 1));
            unset($this->User->Profile->validate['user_id']);
            if ($this->User->saveAssociated($this->request->data)) {
                $this->Session->setFlash(__('Your User Has Been Created. You can login now!.'));
                //$this->Auth->login($this->request->data['User']);
                //$id = $this->User->id;
                //$this->request->data['User'] = array_merge( $this->request->data['User'], array('id' => $id) );
                return $this->redirect(array('action' => 'login'));
            } else {
                $this->Session->setFlash(__('There was an error nothing happened.'));
                return $this->render('register');
            }
        } else {
            return $this->render('register');
        }
    }

/**
 * index method
 *
 * @return void
 */
	public function index() {
        /* Regular Users should not see the index of all users. Only admins should see this */
        return $this->redirect(array('controller' => 'users', 'action' => 'view', $this->Auth->user('id')));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	#public function view($id = null) {
	#	if (!$this->User->exists($id)) {
	#		throw new NotFoundException(__('Invalid user'));
	#	}
	#	$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
	#	$this->set('user', $this->User->find('first', $options));
	#}

    /* TODO - You should not be able to view other users profiles unless you have a connection with them. */
    /* TODO - Users in freindships or relationships should be able to view another users profile/ext profile/friends etc.*/
    public function view($id = null) {
        $loggedInUser = $this->Session->read('Auth.User');
        $user_id = $loggedInUser['id'];
        
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }

        $options = array('conditions' => array('User.' . $this->User->primaryKey => $user_id));
        $this->User->recursive = 2;
        $this->set('user', $this->User->find('first', $options));
        
        $reputationsOutgoing = $this->Reputation->findAllByReviewerId($user_id);
        //pr($reputationsOutgoing);
        $this->set('reputationsOutgoing', $reputationsOutgoing);
        $connectionsOutgoing = $this->Connection->findAllByUserId($user_id);
        $this->set('connectionsOutgoing', $connectionsOutgoing);

        $reputationsIncoming = $this->Reputation->findAllByUserId($user_id);
        $this->set('reputationsIncoming', $reputationsIncoming);
        $connectionsIncoming = $this->Connection->findAllByConnectionId($user_id);
        $this->set('connectionsIncoming', $connectionsIncoming);
    }

/**
 * add method
 *
 * @return void
 */
	#public function add() {
	#	if ($this->request->is('post')) {
	#		$this->User->create();
	#		if ($this->User->save($this->request->data)) {
	#			$this->Session->setFlash(__('The user has been saved.'));
	#			return $this->redirect(array('action' => 'index'));
	#		} else {
	#			$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
	#		}
	#	}
	#	$profiles = $this->User->Profile->find('list');
	#	$extendedProfiles = $this->User->ExtendedProfile->find('list');
	#	$this->set(compact('profiles', 'extendedProfiles'));
	#}
    
    public function add() {
        $loggedInUser = $this->Session->read('Auth.User');
        $user_id = $loggedInUser['id'];
        if ($this->request->is('post') ) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved.'));
                return $this->redirect(array('controller' => 'users', 'action' => 'view', $user_id));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
         } else {
             $this->Session->setFlash(__('You could not do that.'));
             return $this->redirect(array('controller' => 'pages', 'action' => 'display', 'finder'));
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
        $loggedInUser = $this->Session->read('Auth.User');
        $user_id = $loggedInUser['id'];
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
                $solr_result = $this->Solr->pushUserToSolr($user_id);
                if ( ! $solr_result ) {
				    $this->Session->setFlash(__('The user has been saved. But no propegated to the Search'));
                } else {
				    $this->Session->setFlash(__('The user has been saved.'));
                }
                /* TODO - User should NOT go to the INDEX of users after a user is saved? */
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
		$profiles = $this->User->Profile->find('list');
		$extendedProfiles = $this->User->ExtendedProfile->find('list');
		$this->set(compact('profiles', 'extendedProfiles'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	#public function delete($id = null) {
	#	$this->User->id = $id;
	#	if (!$this->User->exists()) {
	#		throw new NotFoundException(__('Invalid user'));
	#	}
	#	$this->request->allowMethod('post', 'delete');
	#	if ($this->User->delete()) {
	#		$this->Session->setFlash(__('The user has been deleted.'));
	#	} else {
	#		$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
	#	}
	#	return $this->redirect(array('action' => 'index'));
	#}

    public function delete($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
            return $this->redirect(array('controller' => 'pages', 'action' => 'display', 'finder'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->User->delete()) {
            /* TODO - Also delete other associated table entries! */
            $this->Session->setFlash(__('The user has been deleted.'));
        } else {
            $this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		$profiles = $this->User->Profile->find('list');
		$extendedProfiles = $this->User->ExtendedProfile->find('list');
		$this->set(compact('profiles', 'extendedProfiles'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
		$profiles = $this->User->Profile->find('list');
		$extendedProfiles = $this->User->ExtendedProfile->find('list');
		$this->set(compact('profiles', 'extendedProfiles'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
            /* TODO - ALSO delete other associated table entries! */
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
