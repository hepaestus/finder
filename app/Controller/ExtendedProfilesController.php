<?php
App::uses('AppController', 'Controller');
/**
 * ExtendedProfiles Controller
 *
 * @property ExtendedProfile $ExtendedProfile
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ExtendedProfilesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Solr');
    public $uses = array('ExtendedProfile', 'User');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ExtendedProfile->recursive = 0;
		$this->set('extendedProfiles', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ExtendedProfile->exists($id)) {
			throw new NotFoundException(__('Invalid extended profile'));
		}
		$options = array('conditions' => array('ExtendedProfile.' . $this->ExtendedProfile->primaryKey => $id));
		$this->set('extendedProfile', $this->ExtendedProfile->find('first', $options));
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
			$this->ExtendedProfile->create();
            $this->request->data['ExtendedProfile']['user_id'] = $user_id;
			if ($this->ExtendedProfile->save($this->request->data)) {
				$this->Session->setFlash(__('The extended profile has been saved.'));

                #Get the user and update with the extended_profile_id
                $user = $this->User->find('first', array('conditions' => array('User.id' => $user_id), 'recursive' => -1));
                $user['User']['extended_profile_id'] = $this->ExtendedProfile->id;
                $this->User->save($user);

                $solr_result = $this->Solr->pushUserToSolr($user_id);
				return $this->redirect(array('controller' => 'users', 'action' => 'view', $user_id));
			} else {
				$this->Session->setFlash(__('The extended profile could not be saved. Please, try again.'));
			}
		}
		$users = $this->ExtendedProfile->User->find('list');
		$this->set(compact('users'));
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
		if (!$this->ExtendedProfile->exists($id)) {
			throw new NotFoundException(__('Invalid extended profile'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ExtendedProfile->save($this->request->data)) {
				$this->Session->setFlash(__('The extended profile has been saved.'));
                $solr_result = $this->Solr->pushUserToSolr($user_id);
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The extended profile could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ExtendedProfile.' . $this->ExtendedProfile->primaryKey => $id));
			$this->request->data = $this->ExtendedProfile->find('first', $options);
		}
		$users = $this->ExtendedProfile->User->find('list');
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
		$this->ExtendedProfile->id = $id;
		if (!$this->ExtendedProfile->exists()) {
			throw new NotFoundException(__('Invalid extended profile'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ExtendedProfile->delete()) {
			$this->Session->setFlash(__('The extended profile has been deleted.'));
		} else {
			$this->Session->setFlash(__('The extended profile could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->ExtendedProfile->recursive = 0;
		$this->set('extendedProfiles', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->ExtendedProfile->exists($id)) {
			throw new NotFoundException(__('Invalid extended profile'));
		}
		$options = array('conditions' => array('ExtendedProfile.' . $this->ExtendedProfile->primaryKey => $id));
		$this->set('extendedProfile', $this->ExtendedProfile->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->ExtendedProfile->create();
			if ($this->ExtendedProfile->save($this->request->data)) {
				$this->Session->setFlash(__('The extended profile has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The extended profile could not be saved. Please, try again.'));
			}
		}
		$users = $this->ExtendedProfile->User->find('list');
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
		if (!$this->ExtendedProfile->exists($id)) {
			throw new NotFoundException(__('Invalid extended profile'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ExtendedProfile->save($this->request->data)) {
				$this->Session->setFlash(__('The extended profile has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The extended profile could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ExtendedProfile.' . $this->ExtendedProfile->primaryKey => $id));
			$this->request->data = $this->ExtendedProfile->find('first', $options);
		}
		$users = $this->ExtendedProfile->User->find('list');
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
		$this->ExtendedProfile->id = $id;
		if (!$this->ExtendedProfile->exists()) {
			throw new NotFoundException(__('Invalid extended profile'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ExtendedProfile->delete()) {
			$this->Session->setFlash(__('The extended profile has been deleted.'));
		} else {
			$this->Session->setFlash(__('The extended profile could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
