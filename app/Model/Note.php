<?php
App::uses('AppModel', 'Model');
/**
 * Note Model
 *
 * @property User $User
 * @property ToUser $ToUser
 */
class Note extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'subject';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ToUser' => array(
			'className' => 'User',
			'foreignKey' => 'id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
