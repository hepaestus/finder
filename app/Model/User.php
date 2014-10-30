<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

/**
 * User Model
 *
 * @property Profile $Profile
 * @property ExtendedProfile $ExtendedProfile
 * @property ExtendedProfile $ExtendedProfile
 * @property Interest $Interest
 * @property Profile $Profile
 * @property Reputation $Reputation
 */
class User extends AppModel {

    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new SimplePasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash($this->data[$this->alias]['password']);
        }
        return true;
    }


/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required'
            )
        ),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Please enter a valid email address',
				'allowEmpty' => false,
				'required' => true,
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)
		),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A Password Is Required'
            )
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin','user')),
                'message' => 'Please Enter A Valid Role',
                'allowEmpty' => true,
                'required' => false,
            ),
        ),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasOne associations
 *
 * @var array
 */
	public $hasOne = array(
		'Profile' => array(
			'className' => 'Profile',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'dependent' => true,
			'order' => ''
		),
		'ExtendedProfile' => array(
			'className' => 'ExtendedProfile',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'dependent' => true,
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Interest' => array(
			'className' => 'Interest',
			'foreignKey' => 'user_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Reputation' => array(
			'className' => 'Reputation',
			'foreignKey' => 'user_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Connection' => array(
			'className' => 'Connection',
			'foreignKey' => 'user_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
	);
}
