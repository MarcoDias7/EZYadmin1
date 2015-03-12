<?php
App::uses('AppModel', 'Model');

/**
 * BankAccount Model
 *
 */
class BankAccount extends AppModel {

	public $primaryKey = 'id';

    public $companyId;

    //public $displayField = array("%s - %s", "{n}.BankAccount.institution", "{n}.BankAccount.num");

    public $belongsTo = array('Company');

    public $validate = array(

        'institution' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Institue missing.'
            )
        ),

        'num' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Bank account missing.'
            ),
            'checkUniqueNumBankAccount' => array(
                "rule" => array("checkUniqueNumBankAccount"),
                'message' => 'Bank account already exists !',
                'required' => 'create',
            ),
        ),

        'zip' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'ZIP code missing.'
            ),
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'ZIP code has to be a numerical value.'
            ),
        ),


        'city' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'City missing.'
            )
        ),


        'country' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Country missing.'
            )
        ),

    );

    public function beforeValidate($options = array()) {

        // get the companyId
        $this->companyId = CakeSession::read('Company.id');

    }

    public function beforeSave($options = array()) {


        // set company_id to BankAccount
        $this->data['BankAccount']['company_id'] = $this->companyId;

        return true;

    }

    public function checkUniqueNumBankAccount($bankAccountNum){

        $companyId = CakeSession::read('Company.id');

        $conditions = array(
            'BankAccount.company_id' => $companyId,
            'BankAccount.num' => $bankAccountNum,
        );

        // Used for letting edit a bankAccount, and save the bankAccountNum without validation blockage.
        if (isset($this->data[$this->alias][$this->primaryKey])) {
            $conditions[$this->alias . '.' . $this->primaryKey . ' <>'] = $this->data[$this->alias][$this->primaryKey];
        }

        if ($this->hasAny($conditions))
            return false;
        else
            return true;

    }



}
