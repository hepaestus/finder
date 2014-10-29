<?php
App::uses('Interest', 'Model');

/**
 * Interest Test Case
 *
 */
class InterestTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.interest',
		'app.user',
		'app.profile',
		'app.extended_profile',
		'app.reputation',
		'app.activity',
		'app.activities_interest'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Interest = ClassRegistry::init('Interest');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Interest);

		parent::tearDown();
	}

}
