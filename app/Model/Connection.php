<?php
App::uses('AppModel', 'Model');
/**
 * Connection Model
 *
 * @property User $User
 */
class Connection extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'connection_type';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'connection_type' => array(
			'inList' => array(
				'rule' => array('inList'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

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
		)
	);
}
