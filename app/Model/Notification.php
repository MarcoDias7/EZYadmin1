<?php

class Notification extends AppModel {
	public $name = 'Notification';

	public $belongsTo = array('Company', 'Booking');

	public $validate = array(
		'valid_from' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'You need to provide a valid date.'
			),
			'date' => array(
				'rule' => array('date'),
				'message' => 'You need to provide a valid date.',
			),
		),
	);

}