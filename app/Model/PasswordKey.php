<?php

class PasswordKey extends AppModel {
	public $name = 'PasswordKey';

	public $belongsTo = array('User');

}