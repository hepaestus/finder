<?php
App::uses('AppController', 'Controller');
/**
 * Reputations Controller
 *
 * @property Reputation $Reputation
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ReputationsController extends AppController {

/**
 * Components
 *
 * @var array
 */
    public $components = array('Paginator', 'Session', 'Solr');
    public $uses = array('Reputation', 'User');

/**
 * index method
 *
 * @return void
 */
    public function index() {
        $loggedInUser = $this->Session->read('Auth.User');
        $user_id = $loggedInUser['id'];
        $this->Reputation->recursive = 0;
        $this->Paginator->settings = array('recursive' => 1, 'conditions' => array('OR' => array( array('Reputation.user_id' => $user_id), array('Reputation.reviewer_id' => $user_id))));
        //pr($this->Paginator->paginate());
        $this->set('reputations', $this->Paginator->paginate());
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
        if ( $this->isReviewer($id) || $this->isSubject($id) ) {
            if (!$this->Reputation->exists($id)) {
                throw new NotFoundException(__('Invalid reputation'));
            }
            $options = array('conditions' => array('Reputation.' . $this->Reputation->primaryKey => $id));
            $this->set('reputation', $this->Reputation->find('first', $options));
        } else {
            $this->Session->setFlash(__('You cannot view this reputation.'));
            return $this->redirect(array('controller' => 'users', 'action' => 'view', $user_id));
        }
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

            $username = $this->request->data['Reputation']['username'] ;
            $user_to = $this->User->findByUsername($username);
            if ( $user_to ) {

                $this->request->data['Reputation']['user_id'] = $user_to['User']['id'];

                $existing_review = $this->Reputation->findByUserIdAndReviewerId($user_to['User']['id'], $user_id);            
                if ( $existing_review ) {
                    $this->Session->setFlash(__('You Have Already Reviewed That User.'));
                    return $this->redirect(array('controller' => 'reputations', 'action' => 'view', $existing_review['Reputation']['id']));
                }
    
                $this->Reputation->create();
                $this->request->data['Reputation']['reviewer_id'] = $user_id;
                if ($this->Reputation->save($this->request->data)) {
                    $solr_result = $this->Solr->pushUserToSolr($user_to['User']['id']);                
                    $this->Session->setFlash(__('The reputation has been saved.'));
                    return $this->redirect(array('controller' => 'users', 'action' => 'view', $user_id));
                } else {
                    $this->Session->setFlash(__('The reputation could not be saved. Please, try again.'));
                }
            } else {
                    $this->Session->setFlash(__('User not found, try again.'));
                    $this->request->data['Reputation']['username'] = "";
            }
        }
            
        //$users = $this->Reputation->User->find('list', array('fields' => array('User.username'), 'conditions' => array('User.id !=' => $user_id)));
        //$this->set(compact('users'));
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

        if (!$this->Reputation->exists($id)) {
            throw new NotFoundException(__('Invalid reputation'));
        }
        $review = $this->isReviewer($id);
        if ( $review ) {
            if ($this->request->is(array('post', 'put'))) {
                if ($this->Reputation->save($this->request->data)) {
                    $this->Session->setFlash(__('The reputation has been saved.'));

                    //pr($review); die();
                    $solr_result = $this->Solr->pushUserToSolr($review['Reputation']['user_id']);

                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The reputation could not be saved. Please, try again.'));
                }
            } else {
                $options = array('conditions' => array('Reputation.' . $this->Reputation->primaryKey => $id));
                $this->request->data = $this->Reputation->find('first', $options);
            }
        } else {
            $this->Session->setFlash(__('You cannot edit this reputation.'));
            return $this->redirect(array('action' => 'index'));
        }
        $users = $this->Reputation->User->find('list');
        $reviewers = $this->Reputation->Reviewer->find('list');
        $this->set(compact('users', 'reviewers'));
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
        $this->Reputation->id = $id;

        if (!$this->Reputation->exists()) {
            throw new NotFoundException(__('Invalid reputation'));
        }
        
        $review = $this->isReviewer($id);
        if ( $review ) {
            $this->request->allowMethod('post', 'delete');
            if ($this->Reputation->delete()) {

                $solr_result = $this->Solr->pushUserToSolr($review['Reputation']['user_id']);
            
                $this->Session->setFlash(__('The reputation has been deleted.'));
            } else {
                $this->Session->setFlash(__('The reputation could not be deleted. Please, try again.'));
            }
        } else {
            $this->Session->setFlash(__('You Cannot Delete This Reputation'));
        }        
        return $this->redirect(array('action' => 'index'));
    }

/**
 * isReviewer method
 *
 * @return connection 
 */
    public function isReviewer($reputation_id) {
        $loggedInUser = $this->Session->read('Auth.User');
        $user_id = $loggedInUser['id'];
        $return = false;
        if ($this->Reputation->exists($reputation_id)) {
             $reputation= $this->Reputation->find('first', array('conditions' => array('Reputation.id' => $reputation_id, 'Reputation.reviewer_id' => $user_id)));
             if ( $reputation ) {
                 $return = $reputation;
             }
        }
        error_log(" IS REVIEWER: " . print_r($return,1));
        return $return;
    }

/**
 * isSubject method
 *
 * @return connection
 */
    public function isSubject($reputation_id) {
        $loggedInUser = $this->Session->read('Auth.User');
        $user_id = $loggedInUser['id'];
        $return = false;
        if ($this->Reputation->exists($reputation_id)) {
             $reputation = $this->Reputation->find('first', array('conditions' => array('Reputation.id' => $reputation_id, 'Reputation.user_id' => $user_id)));
             if ( $reputation ) {
                 $return = $reputation;
             }
        }
        error_log(" IS SUBJECT: " . print_r($return,1));
        return $return;
    }

/**
 * admin_index method
 *
 * @return void
 */
    public function admin_index() {
        $this->Reputation->recursive = 0;
        $this->set('reputations', $this->Paginator->paginate());
    }

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function admin_view($id = null) {
        if (!$this->Reputation->exists($id)) {
            throw new NotFoundException(__('Invalid reputation'));
        }
        $options = array('conditions' => array('Reputation.' . $this->Reputation->primaryKey => $id));
        $this->set('reputation', $this->Reputation->find('first', $options));
    }

/**
 * admin_add method
 *
 * @return void
 */
    public function admin_add() {
        if ($this->request->is('post')) {
            $this->Reputation->create();
            if ($this->Reputation->save($this->request->data)) {
                $this->Session->setFlash(__('The reputation has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The reputation could not be saved. Please, try again.'));
            }
        }
        $users = $this->Reputation->User->find('list');
        $reviewers = $this->Reputation->Reviewer->find('list');
        $this->set(compact('users', 'reviewers'));
    }

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function admin_edit($id = null) {
        if (!$this->Reputation->exists($id)) {
            throw new NotFoundException(__('Invalid reputation'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Reputation->save($this->request->data)) {
                $this->Session->setFlash(__('The reputation has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The reputation could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Reputation.' . $this->Reputation->primaryKey => $id));
            $this->request->data = $this->Reputation->find('first', $options);
        }
        $users = $this->Reputation->User->find('list');
        $reviewers = $this->Reputation->Reviewer->find('list');
        $this->set(compact('users', 'reviewers'));
    }

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function admin_delete($id = null) {
        $this->Reputation->id = $id;
        if (!$this->Reputation->exists()) {
            throw new NotFoundException(__('Invalid reputation'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Reputation->delete()) {
            $this->Session->setFlash(__('The reputation has been deleted.'));
        } else {
            $this->Session->setFlash(__('The reputation could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
