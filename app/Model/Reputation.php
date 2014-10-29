<?php
App::uses('AppModel', 'Model');
/**
 * Reputation Model
 *
 * @property User $User
 * @property User $User
 */
class Reputation extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'reviewer_id';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Reviewer' => array(
			'className' => 'User',
			'foreignKey' => 'reviewer_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
