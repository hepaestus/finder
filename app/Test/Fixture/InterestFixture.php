<?php
/**
 * InterestFixture
 *
 */
class InterestFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'unsigned' => true),
		'activity_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'unsigned' => true),
		'giving' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'recieving' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'importance' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 2, 'unsigned' => true),
		'experience' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 2, 'unsigned' => true),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'user_id' => 1,
			'activity_id' => 1,
			'giving' => 1,
			'recieving' => 1,
			'importance' => 1,
			'experience' => 1,
			'created' => '2014-10-23 12:00:45',
			'modified' => '2014-10-23 12:00:45'
		),
	);

}
