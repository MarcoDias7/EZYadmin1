<?php
App::uses('AppModel', 'Model');

/**
 * Charge Model
 *
 */
class Charge extends AppModel {

	public $primaryKey = 'id';

    public $companyId;

    public $belongsTo = array('Company');

    public $validate = array(

        'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Other charge name missing.'
            )
        ),

        'code' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Other charge number missing.'
            ),
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Other charge number has to be a numerical value.'
            ),
            'checkUniqueCode' => array(
                "rule" => array("checkUniqueCode"),
                'message' => 'Other charge number already exists !',
                'required' => 'create',
            ),
        ),


        'value' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Other charge value missing.'
            ),
            'numeric' => array(
                'rule' => array('decimal'),
                'message' => 'Other charge has to be a decimal value.'
            ),
        ),


    );

    public function beforeValidate($options = array()) {

        // get the companyId
        $this->companyId = CakeSession::read('Company.id');

    }

    public function beforeSave($options = array()) {


        // set company_id to charge
        $this->data['Charge']['company_id'] = $this->companyId;

        return true;

    }

    public function checkUniqueCode($code){

        $companyId = CakeSession::read('Company.id');

        $conditions = array(
            'Charge.company_id' => $companyId,
            'Charge.code' => $code,
        );

        // Used for letting edit a Charge, and save the code without validation blockage.
        if (isset($this->data[$this->alias][$this->primaryKey])) {
            $conditions[$this->alias . '.' . $this->primaryKey . ' <>'] = $this->data[$this->alias][$this->primaryKey];
        }

        if ($this->hasAny($conditions))
            return false;
        else
            return true;

    }

    public function getLastCode($companyId){

        $result = $this->find('first', array(
            'fields' => 'Charge.code',
            'order' => 'Charge.code DESC',
            'conditions' => array('Charge.company_id' => $companyId)
        ));

        if($result == null)
            return '6000';
        else
            return $result['Charge']['code'];

    }

}
