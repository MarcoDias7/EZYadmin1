<?php

class Design extends AppModel {
	public $name = 'Design';

	public $belongsTo = array('Company');

	// Used to activate the internationalization of the validation messages below
	public $validationDomain = 'validation';

	// Enforce the required validations rule when you create a new user
	public $validate = array(		
		'name' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'required' => true,
				'message' => 'You need to provide a name.'
			)
		),
	);
}