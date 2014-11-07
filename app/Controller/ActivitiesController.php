<?php
App::uses('AppController', 'Controller');
/**
 * Activities Controller
 *
 * @property Activity $Activity
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ActivitiesController extends AppController {

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
		$this->Activity->recursive = 0;
		$this->set('activities', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Activity->exists($id)) {
			throw new NotFoundException(__('Invalid activity'));
		}
		$options = array('conditions' => array('Activity.' . $this->Activity->primaryKey => $id));
		$this->set('activity', $this->Activity->find('first', $options));
        
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Activity->create();
            if ( ! $this->request->data['Activity']['category'] ) {
                $this->request->data['Activity']['category'] = 0;
            }
            if ( ! $this->request->data['Activity']['sub_category_of'] ) {
                $this->request->data['Activity']['sub_category_of'] = 0;
            }
			if ($this->Activity->save($this->request->data)) {
				$this->Session->setFlash(__('The activity has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The activity could not be saved. Please, try again.'));
			}
		}
		$interests = $this->Activity->Interest->find('list');
		$this->set(compact('interests'));

		//$cat_options = array('conditions' => array('Activity.category' => '0'), 'fields' => array('Activity.id', 'Activity.name'), 'order' => array('Activity.category', 'Activity.name ASC'));//, 'group' => array('Activity.category', 'Activity.sub_category_of'));
        //$category = $this->Activity->find('list', $cat_options); 
        //pr($category);
        //$this->set(compact('category'));
        
		//$sub_cat_options = array('conditions' => array('Activity.category !=' => '0'), 'fields' => array('Activity.id', 'Activity.name'), 'order' => array('Activity.sub_category_of','Activity.name ASC'));
        //$sub_category_of = $this->Activity->find('list', $sub_cat_options); 
        //pr($sub_category_of);
        //$this->set(compact('sub_category_of'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Activity->exists($id)) {
			throw new NotFoundException(__('Invalid activity'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Activity->save($this->request->data)) {
				$this->Session->setFlash(__('The activity has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The activity could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Activity.' . $this->Activity->primaryKey => $id));
			$this->request->data = $this->Activity->find('first', $options);
		}
		$interests = $this->Activity->Interest->find('list');
		$this->set(compact('interests'));

		//$cat_options = array('conditions' => array('Activity.category' => '0'), 'fields' => array('Activity.id', 'Activity.name'), 'order' => array('Activity.category', 'Activity.name ASC'));//, 'group' => array('Activity.category', 'Activity.sub_category_of'));
		//$cat_options = array('fields' => array('Activity.id', 'Activity.name'), 'order' => array('Activity.category', 'Activity.name ASC'));//, 'group' => array('Activity.category', 'Activity.sub_category_of'));
        //$category = $this->Activity->find('list', $cat_options); 
        //pr($category);
        //$this->set(compact('category'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Activity->id = $id;
		if (!$this->Activity->exists()) {
			throw new NotFoundException(__('Invalid activity'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Activity->delete()) {
			$this->Session->setFlash(__('The activity has been deleted.'));
		} else {
			$this->Session->setFlash(__('The activity could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Activity->recursive = 0;
		$this->set('activities', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Activity->exists($id)) {
			throw new NotFoundException(__('Invalid activity'));
		}
		$options = array('conditions' => array('Activity.' . $this->Activity->primaryKey => $id));
		$this->set('activity', $this->Activity->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Activity->create();
			if ($this->Activity->save($this->request->data)) {
				$this->Session->setFlash(__('The activity has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The activity could not be saved. Please, try again.'));
			}
		}
		$interests = $this->Activity->Interest->find('list');
		$this->set(compact('interests'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Activity->exists($id)) {
			throw new NotFoundException(__('Invalid activity'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Activity->save($this->request->data)) {
				$this->Session->setFlash(__('The activity has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The activity could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Activity.' . $this->Activity->primaryKey => $id));
			$this->request->data = $this->Activity->find('first', $options);
		}
		$interests = $this->Activity->Interest->find('list');
		$this->set(compact('interests'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Activity->id = $id;
		if (!$this->Activity->exists()) {
			throw new NotFoundException(__('Invalid activity'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Activity->delete()) {
			$this->Session->setFlash(__('The activity has been deleted.'));
		} else {
			$this->Session->setFlash(__('The activity could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
