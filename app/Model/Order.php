<?php

class Order extends AppModel {

	// Used to activate the internationalization of the validation messages below
	public $validationDomain = 'validation';

	public $belongsTo = array('User', 'Company');
	
	public $validate = array(

		'plan' => array(
			'required' => array(
				'rule' => array('inList', array('1', '2', '3')),
				'message' => 'You need to select a valid plan.'
			)
		),

		'tos' => array(
			'required' => array(
				'rule' => array('comparison', '!=', 0),
				'required' => true,
				'message' => 'You need to accept the Terms of Services'
			)
		),

		'name' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'You need to provide a name for your billing address.'
			)
		),

		'street' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'You need to provide a street.'
			)
		),

		'zip' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'You need to provide a zip.'
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'The zip code has to be a number.'
			),
		),


		'city' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'You need to provide a city.'
			)
		),


		'country' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'You need to provide a country.'
			)
		),

	);

	public function postFinanceHashTest($values, $type = 'IN') {
		$values = array_change_key_case($values, CASE_UPPER);
		ksort($values);

		$sha = array();
		foreach ($values as $key => $item) {
			if ($item !== '') {
				$sha[] = strtoupper($key).'='.$item;
			}
		}
		$sha = implode(Configure::read('SHA'.$type.'KEY'), $sha).Configure::read('SHA'.$type.'KEY');
		return $sha;
	}

	public function postFinanceHash($values, $type = 'IN') {
		$values = array_change_key_case($values, CASE_UPPER);
		ksort($values);

		$sha = array();
		foreach ($values as $key => $item) {
			if ($item !== '') {
				$sha[] = strtoupper($key).'='.$item;
			}
		}
		$sha = implode(Configure::read('SHA'.$type.'KEY'), $sha).Configure::read('SHA'.$type.'KEY');
		return strtoupper(sha1($sha));
	}

}