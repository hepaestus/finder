<?php
App::uses('Reputation', 'Model');

/**
 * Reputation Test Case
 *
 */
class ReputationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.reputation',
		'app.user',
		'app.profile',
		'app.extended_profile',
		'app.interest',
		'app.activity',
		'app.activities_interest',
		'app.reviewer'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Reputation = ClassRegistry::init('Reputation');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Reputation);

		parent::tearDown();
	}

}
