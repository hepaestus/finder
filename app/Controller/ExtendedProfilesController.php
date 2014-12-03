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

            pr($this->request->data);
            $error_message = "";
            if ( $this->request->data['ExtendedProfile']['image']['error'] == 0 &&
                 $this->request->data['ExtendedProfile']['image']['size'] > 0 ) {

                $file_name = $this->request->data['ExtendedProfile']['image']['name'];
                $file_extension = $this->request->data['ExtendedProfile']['image']['type'];

                $file_tmp = $this->request->data['ExtendedProfile']['image']['tmp_name'];
                if ( preg_match("/jpeg/",$file_extension)) {
                    $file_extension = "jpg";
                } elseif ( preg_match("/gif/",$file_extension)) {
                    $file_extension = "gif";
                } elseif ( preg_match("/png/",$file_extension)) {
                    $file_extension = "png";
                } else {
			        throw new NotFoundException(__('Invalid File Type'));
                }

                $new_file_name = md5($file_name);
                $new_path = $this->_randomPath($file_name);
                
                if ( ! file_exists($new_path)) {
                    if ( ! mkdir($new_path, '0755', true)) {
			            throw new NotFoundException(__('Could not create destination directory.'));
                    }
                }
                $new_image = "uploads" . DS . $new_path . $new_file_name . "." . $file_extension;

                if (!move_uploaded_file($file_tmp, $new_image)) {
                    $error_message = " File Not Copied. ";
                    $this->request->data['ExtendedProfile']['image'] = "";
                }
                $this->request->data['ExtendedProfile']['image'] = $new_image;
                pr($this->request->data);
            } else {
                $error_message = " File Not Uploaded. ";
                $this->request->data['ExtendedProfile']['image'] = "";
            }

			if ($this->ExtendedProfile->save($this->request->data)) {
				$this->Session->setFlash(__('The extended profile has been saved.' . $error_message));
                $solr_result = $this->Solr->pushUserToSolr($user_id);
                
				return $this->redirect(array('controller' => 'extended_profiles', 'action' => 'view', $id));
			} else {
				$this->Session->setFlash(__('The extended profile could not be saved. Please, try again.'));
				return $this->redirect(array('controller' => 'users', 'action' => 'view', $user_id));
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
 * Builds a semi random path based on the id to avoid having thousands of files
 * or directories in one directory. This would result in a slowdown on most file systems.
 *
 * Works up to 5 level deep
 *
 * @see http://en.wikipedia.org/wiki/Comparison_of_file_systems#Limits
 * @param mixed $string
 * @param integer $level
 * @return mixed
 * @access protected
 */
	protected function _randomPath($string, $level = 3) {
		if (!$string) {
			throw new Exception(__('First argument is not a string!', true));
		}

		$string = crc32($string);
		$decrement = 0;
		$path = null;
		
		for ($i = 0; $i < $level; $i++) {
			$decrement = $decrement -2;
			$path .= sprintf("%02d" . DS, substr('000000' . $string, $decrement, 2));
		}

		return $path;
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
