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
				'rule' => array('inList', array('blocked','unknown','acquaintance','friend','relationship')),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)
		)
	);

/**
 * belongsTo associations
 *
 * @var array
 */
	#public $belongsTo = array(
	#	'User' => array(
	#		'className' => 'User',
	#		'foreignKey' => 'user_id',
	#		'conditions' => '',
	#		'fields' => '',
	#		'order' => ''
	#	)
	#);

/**
 * hasMany associations
 *
 * @var array
 */
    #public $hasMany = array(
    #    'Connection' => array(
    #        'classname' => 'Connection',
    #        'foreignKey' => 'connection_id',
    #        'conditions' => '',
    #        'fields' => '',
    #        'order' => ''
    #    )
    #);

}
