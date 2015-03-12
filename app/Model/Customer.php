<?php
App::uses('AppModel', 'Model');

/**
 * Customer Model
 *
 */
class Customer extends AppModel {

	public $primaryKey = 'id';

    public $companyId;

    public $displayField = array("%s - %s", "{n}.Customer.customer_num", "{n}.Customer.customer_name");

    public $belongsTo = array('Company');

    public $validate = array(

        'customer_name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Customer name is missing.'
            )
        ),

        'customer_num' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Customer number is missing.'
            ),
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'The customer number has to be a numerical value.'
            ),
            'checkUniqueCustomerNum' => array(
                "rule" => array("checkUniqueCustomerNum"),
                'message' => 'Customer number already exists !',
                'required' => 'create',
            ),
        ),

        'zip' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'ZIP number is missing.'
            ),
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'ZIP number has to be a numerical value.'
            ),
        ),


        'city' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'City is missing.'
            )
        ),


        'country' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Country is missing.'
            )
        ),


        'email' => array(
            'email' => array(
                'rule' => array('email'),
                'allowEmpty' => true,
                'message' => 'Email address is missing.'
            )
        ),

    );

    public function beforeValidate($options = array()) {

        // get the companyId
        $this->companyId = CakeSession::read('Company.id');

    }

    public function beforeSave($options = array()) {


        // set company_id to Customer
        $this->data['Customer']['company_id'] = $this->companyId;

        return true;

    }

    public function checkUniqueCustomerNum($customerNum){

        $companyId = CakeSession::read('Company.id');

        $conditions = array(
            'Customer.company_id' => $companyId,
            'Customer.customer_num' => $customerNum,
        );

        // Used for letting edit a Customer, and save the customNum without validation blockage.
        if (isset($this->data[$this->alias][$this->primaryKey])) {
            $conditions[$this->alias . '.' . $this->primaryKey . ' <>'] = $this->data[$this->alias][$this->primaryKey];
        }

        if ($this->hasAny($conditions))
            return false;
        else
            return true;

    }

    public function getLastCustomerNum($companyId){

        $result = $this->find('first', array(
            'fields' => 'Customer.customer_num',
            'order' => 'Customer.customer_num DESC',
            'conditions' => array('Customer.company_id' => $companyId)
        ));

        if($result == null)
            return '4000';
        else
            return $result['Customer']['customer_num'];

    }

}
