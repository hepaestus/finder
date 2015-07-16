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
    public $uses = array('User','Activity','Interest','Profile','ExtendedProfile','Connection','Reputation','Note');
    public $findMethods = array('available' => true);


    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('register','login','logout','view','edit','delete');
    }

    public function login() {
        $this->set('title_for_layout','Welcome');
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->User->id = $this->Auth->user('id');
                $loggedInUser = $this->Session->read('Auth.User');
                $user_id = $loggedInUser['id'];
                $this->User->saveField('lastlogin', date("Y-m-d H:i:s"));
                $this->User->saveField('loggedin', 1);
                $solr_result = $this->Solr->pushUserToSolr($this->Auth->user('id'));
                //error_log("Should Redirect!!!!! To User View : " . $user_id );                
                $this->set('new_data_url','/finder/users/view/' . $user_id);
                return $this->redirect(array('controller' => 'users', 'action' => 'view', $user_id));
            }
            $this->Session->setFlash(__('Invalid Username or Password, Try Again'));
        }
    }

    public function logout() {
        $loggedInUser = $this->Session->read('Auth.User');
        if ( $loggedInUser ) { 
            $this->User->id = $loggedInUser['id'];
            $this->User->saveField('loggedin', 0);
            $solr_result = $this->Solr->pushUserToSolr($this->Auth->user('id'));
        }
        return $this->redirect($this->Auth->logout('/pages/finder'));
    }

    public function register() {
        if ($this->request->is('post') ) {
            $this->User->create();
            //error_log(" REQUEST DATA: " . print_r($this->request->data, 1));
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
            $this->set('title_for_layout','Register A New User');
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

        // error_log("This is View 0");
        $this->set('title_for_layout','Welcome');
        $this->set('welcome_user', $this->Auth->user('username'));
        $loggedInUser = $this->Session->read('Auth.User');
        $user_id = $loggedInUser['id'];
                
        if ( $id != null && $id != $user_id ) {
            return $this->redirect(array('controller' => 'users', 'action' => 'view_match', $id));
        }

        if ($this->User->exists($user_id)) {

            // error_log("This is View 1");
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $user_id));
            $this->User->recursive = 2;
            $this->set('user', $this->User->find('first', $options));
            //pr($this->User->find('first', $options));
    
            // Outbox
            $order = array("Note.created desc", "Note.read");
            $conditions = array("Note.user_id" => $user_id, "Note.sender_delete" => 0);
            $notesOutgoing = $this->Note->find('all', array('conditions' => $conditions, 'recursive' => 2, 'order' => $order));
		    $this->set('notesOutgoing', $notesOutgoing);
        
            // Inbox
            $order = array("Note.created desc", "Note.read");
            $conditions = array("Note.to_user_id" => $user_id, "Note.receiver_delete" => 0 );
            $notesIncoming = $this->Note->find('all', array('conditions' => $conditions, 'recursive' => 2, 'order' => $order));
		    $this->set('notesIncoming', $notesIncoming);
        
            // Reputations
            $reputationsOutgoing = $this->Reputation->findAllByReviewerId($user_id,NULL,NULL,NULL,NULL,NULL,NULL,2);
            $this->set('reputationsOutgoing', $reputationsOutgoing);
    
            $reputationsIncoming = $this->Reputation->findAllByUserId($user_id,NULL,NULL,NULL,NULL,2);
            $this->set('reputationsIncoming', $reputationsIncoming);
            $this->set('reputationSummary', $this->requestAction( array('controller' => 'reputations', 'action' => 'reputationSummary', $user_id)));

            // Connections
            $connectionsOutgoing = $this->Connection->findAllByUserId($user_id,NULL,NULL,NULL,NULL,2); //, null, null, array('created' => 'desc'), null ,null, 2);
            $this->set('connectionsOutgoing', $connectionsOutgoing);

            $connectionsIncoming = $this->Connection->findAllByConnectionId($user_id,NULL,NULL,NULL,NULL,2);
            $this->set('connectionsIncoming', $connectionsIncoming);
        
            // Matches
            $matches = $this->requestAction('/searches/return_matches/' . $user_id);
            $this->set('matches', $matches);

            // Other
            $this->set('data_url', "/finder/users/view/$user_id");

            // error_log("This is View 2");            
        } else  {
            $this->Session->setFlash(__('There was an error!'));
        }
    }

/**
 * view_match method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function view_match($id = null) {
        $loggedInUser = $this->Session->read('Auth.User');
        $user_id = $loggedInUser['id'];
        
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }

        $connections_options = array('recursive' => -1, 'conditions' => array( 'OR' => array( array('Connection.user_id' => $id, 'Connection.connection_id' => $user_id) , array('Connection.user_id' => $user_id, 'Connection.connection_id' => $id )))); 
        //$connections_options = array('recursive' => -1, 'conditions' => array( 'Connection.user_id' => $id, 'Connection.connection_id' => $user_id)); 
        $connection_list = $this->User->Connection->find('all', $connections_options);

        $connection_type = "none";
        $options = array();
		$this->Session->setFlash(__('FOO BAR'));
        if ( $connection_list ) { 

            foreach( $connection_list as $connection ) {
                
                //error_log("CONNECTION :".  print_r($connection,1));
                $connection_type =  strtolower($connection['Connection']['connection_type']);
    
                if ( $connection_type == 'blocked' ) {
                    if ( $connection['Connection']['user_id'] == $id ) {
		                $this->Session->setFlash(__('This User Has Blocked You. Maybe You Were A Jerk.'));
                        return $this->redirect(array('controller' => 'users', 'action' => 'view', $user_id));
                    } else if ( $connection['Connection']['user_id'] == $user_id ) {
		                $this->Session->setFlash(__('YOU HAVE BLOCKED THIS USER. You will have to unblock them to see their profile.'));
                        return $this->redirect(array('controller' => 'users', 'action' => 'view', $user_id));
                    }    
                } else if ( $connection_type == 'relationship' ) {
                    if ( $connection['Connection']['user_id'] == $id ) {
		                $this->Session->setFlash(__('This Person Says You Are In A Relationship!'));
                        $options = array('conditions' => array('User.' . $this->User->primaryKey => $id), 'recursive' => 2);
                    } else if ( $connection['Connection']['user_id'] == $user_id ) {
		                $this->Session->setFlash(__('You Say You Are In A Relationship!'));
                        $options = array('conditions' => array('User.' . $this->User->primaryKey => $id), 'recursive' => 2);
                    }
                } else if ( $connection_type == 'friend' ) {
                    if ( $connection['Connection']['user_id'] == $id ) {
		                $this->Session->setFlash(__('This Person Says You Are Friends!'));
                        $options = array('conditions' => array('User.' . $this->User->primaryKey => $id), 'recursive' => 1);
                    } else if ( $connection['Connection']['user_id'] == $user_id ) {
		                $this->Session->setFlash(__('You Say You Are Friends!'));
                        $options = array('conditions' => array('User.' . $this->User->primaryKey => $id), 'recursive' => 1);
                    }
                } else if ( $connection_type == 'acquaintance' ) {
                   if ( $connection['Connection']['user_id'] == $id ) {
		               $this->Session->setFlash(__('This Person Says You Are Acquaintances!'));
                       $options = array('conditions' => array('User.' . $this->User->primaryKey => $id), 'recursive' => 0);
                   } else if ( $connection['Connection']['user_id'] == $user_id ) {
		               $this->Session->setFlash(__('You Say You Are In Acquaintances!'));
                       $options = array('conditions' => array('User.' . $this->User->primaryKey => $id), 'recursive' => 0);
                   }
                } else if ( $connection['Connection']['user_id'] == $id ) {
		            $this->Session->setFlash(__('That user is trying to connect with you but they you have not yet verified it'));
                    return $this->redirect(array('controller' => 'users', 'action' => 'view', $user_id));
                } else if ( $connection['Connection']['user_id'] == $user_id ) {
		            $this->Session->setFlash(__('You have a connection with that user. But they have not yet verified it. They must be busy! :)'));
                    return $this->redirect(array('controller' => 'users', 'action' => 'view', $user_id));
                }
            }

        } else {
		    $this->Session->setFlash(__('You do not have a connection with that user. Try Creating one!'));
            return $this->redirect(array('controller' => 'connections', 'action' => 'add', $id));
        }        

        // Interests Query        
        // SELECT 
        //   *
        // FROM
        //   interests
        //       LEFT JOIN
        //   (activities) ON (interests.activity_id = activities.id)
        // WHERE
        //   interests.user_id in ( $id,$user_id )
        // group by interests.activity_id
        // having count(*) > 1;

        $interests = $this->Interest->query('SELECT * FROM interests LEFT JOIN (activities) ON (interests.activity_id = activities.id) WHERE interests.user_id in ( ' . $id . ',' . $user_id . ') group by interests.activity_id having count(*) > 1 order by activities.name asc;');
        $user = $this->User->find('first', $options);
        $this->set('user', $user);
        $this->set('interests', $interests);
        $this->set('connection_type', $connection_type);
    }

/**
 * add method
 *
 * @return void
 */
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
        //pr($loggedInUser);
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {

            if ( $this->request->data['User']['password_new'] && $this->request->data['User']['password_repeat'] ) {
                if ( $this->request->data['User']['password_new'] == $this->request->data['User']['password_repeat'] ) {

                    $this->request->data['User']['password'] = $this->request->data['User']['password_new'];                    

                } else {
				    $this->Session->setFlash(__('Passwords Did Not Match. Please Retry.'));
                    $this->redirect(array('controller' => 'users', 'action' => 'edit', $user_id));
                }
            //} else { // THERE IS NO NEED FOR THIS FOR SOME REASON.
            //    $this->request->data['User']['password'] = $loggedInUser['password'];
            }
            
            unset($this->request->data['User']['password_new']);
            unset($this->request->data['User']['password_repeat']);

            $this->request->data['User']['id'] = $loggedInUser['id'];
            $this->request->data['User']['profile_id'] = $loggedInUser['profile_id'];
            $this->request->data['User']['extended_profile_id'] = $loggedInUser['extended_profile_id']; 
            $this->request->data['User']['recovery_hash'] = $loggedInUser['recovery_hash']; 
            $this->request->data['User']['role'] = $loggedInUser['role']; 
            $this->request->data['User']['loggedin'] = 1; 
            $this->request->data['User']['lastlogin'] = $loggedInUser['lastlogin']; 
            $this->request->data['User']['created'] = $loggedInUser['created']; 

            //pr($this->request->data);

			if ($this->User->save($this->request->data)) {
                $solr_result = $this->Solr->pushUserToSolr($user_id);
                if ( ! $solr_result ) {
				    $this->Session->setFlash(__('The user has been saved. But no propegated to the Search'));
                } else {
				    $this->Session->setFlash(__('The user has been saved.'));
                }
				return $this->redirect(array('controller' => 'users', 'action' => 'view', $user_id));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
		//$profiles = $this->User->Profile->find('list');
		//$extendedProfiles = $this->User->ExtendedProfile->find('list');
		//$this->set(compact('profiles', 'extendedProfiles'));
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
