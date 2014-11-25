<?php
App::uses('AppController', 'Controller');
/**
 * ActivityCategories Controller
 *
 * @property ActivityCategory $ActivityCategory
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ActivityCategoriesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ActivityCategory->recursive = 0;
		$this->Paginator->settings = array('order' => array('ActivityCategory.lft' => 'ASC'));
		$this->set('activityCategories', $this->Paginator->paginate());
		//pr( $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ActivityCategory->exists($id)) {
			throw new NotFoundException(__('Invalid activity category'));
		}
		$options = array('conditions' => array('ActivityCategory.' . $this->ActivityCategory->primaryKey => $id));
		$this->set('activityCategory', $this->ActivityCategory->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ActivityCategory->create();
			if ($this->ActivityCategory->save($this->request->data)) {
				$this->Session->setFlash(__('The activity category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The activity category could not be saved. Please, try again.'));
			}
        } else {
		    $options = array('fields' => array('ActivityCategory.id', 'ActivityCategory.name'), 'order' => array('ActivityCategory.lft' => 'ASC'));
            $parent_id = $this->ActivityCategory->find('list', $options);
            $this->set('parent_id', $parent_id);
            pr($parent_id);
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
		if (!$this->ActivityCategory->exists($id)) {
			throw new NotFoundException(__('Invalid activity category'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ActivityCategory->save($this->request->data)) {
				$this->Session->setFlash(__('The activity category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The activity category could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ActivityCategory.' . $this->ActivityCategory->primaryKey => $id));
			$this->request->data = $this->ActivityCategory->find('first', $options);

		    $options = array('fields' => array('ActivityCategory.id', 'ActivityCategory.name'), 'order' => array('ActivityCategory.lft' => 'ASC'));
            $parent_id = $this->ActivityCategory->find('list', $options);
            $this->set('parent_id', $parent_id);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ActivityCategory->id = $id;
		if (!$this->ActivityCategory->exists()) {
			throw new NotFoundException(__('Invalid activity category'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ActivityCategory->delete()) {
			$this->Session->setFlash(__('The activity category has been deleted.'));
		} else {
			$this->Session->setFlash(__('The activity category could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->ActivityCategory->recursive = 0;
		$this->set('activityCategories', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->ActivityCategory->exists($id)) {
			throw new NotFoundException(__('Invalid activity category'));
		}
		$options = array('conditions' => array('ActivityCategory.' . $this->ActivityCategory->primaryKey => $id));
		$this->set('activityCategory', $this->ActivityCategory->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->ActivityCategory->create();
			if ($this->ActivityCategory->save($this->request->data)) {
				$this->Session->setFlash(__('The activity category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The activity category could not be saved. Please, try again.'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->ActivityCategory->exists($id)) {
			throw new NotFoundException(__('Invalid activity category'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ActivityCategory->save($this->request->data)) {
				$this->Session->setFlash(__('The activity category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The activity category could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ActivityCategory.' . $this->ActivityCategory->primaryKey => $id));
			$this->request->data = $this->ActivityCategory->find('first', $options);
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->ActivityCategory->id = $id;
		if (!$this->ActivityCategory->exists()) {
			throw new NotFoundException(__('Invalid activity category'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ActivityCategory->delete()) {
			$this->Session->setFlash(__('The activity category has been deleted.'));
		} else {
			$this->Session->setFlash(__('The activity category could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
