<?php

/* Log all the important actions for legal issues
Keep track of the account, ip, user-agent, time and a message represeting the event
*/

class Log extends AppModel {
    public $name = 'Log';
    public $useTable = 'logs';
    public $belongsTo = array('User');
}