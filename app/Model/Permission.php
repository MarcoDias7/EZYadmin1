<?php
// Represents the permissions for a given company and a given user
// If a row is present then the user has read permission
// the fields 'write' and 'admin' are set if he has the given permissions

class Permission extends AppModel {
	public $name = 'Permission';

	public $belongsTo = array('Company', 'User');

	public $actsAs = array('Containable');
}