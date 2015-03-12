<?php
	class Contact extends AppModel {
	 
		var $name = 'Contact';
	 
		var $useTable = false;
	 
		var $_schema = array(
			'field' => array(
				'type' => 'string',
				'length' => 255
			),
			'subject' => array(
				'type' => 'string',
				'length' => 255
			),
			'email' => array(
				'type' => 'string',
				'length' => 50
			),
			'message' => array(
				'type' => 'text'
			)
		);

		public function beforeValidate($options = array()) {
		
			/*if(!isset($this->data['Contact']['field']) || $this->data['Contact']['field'] =''){
				$this->data['Contact']['field'] = __('Trustees');
			}*/

			//debug($this->data);die();

		}
	 
		// Règles de validation des données
		var $validate = array(
			'field' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'allowEmpty' => false,
			),
			'subject' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'allowEmpty' => false,
			),
			'email' => array(
				'rule' => 'email',
				'required' => true,
				'allowEmpty' => false,
				'message' => "Please fill a valid email address."
			),
			'message' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'allowEmpty' => false,
			)
		);
	}