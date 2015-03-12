<?php
App::uses('AppModel', 'Model');

/**
 * Product Model
 *
 */
class Product extends AppModel {

	public $primaryKey = 'id';

    public $companyId;

    public $displayField = array("%s - %s", "{n}.Product.product_num", "{n}.Product.product_name");

    public $belongsTo = array('Company', 'VatAccount');

    //public $hasMany = array( 'VatAccount' );

    public $validate = array(

        'product_name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Product name is missing.'
            )
        ),

        'product_num' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Product number is missing.'
            ),
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'The product number has to be a numerical value.'
            ),
            'checkUniqueProductNum' => array(
                "rule" => array("checkUniqueProductNum"),
                'message' => 'Product number already exists !',
                'required' => 'create',
            ),
        ),

        'product_unit' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Product unit is missing.'
            ),
        ),

        'product_quantity' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Product quantity is missing.'
            ),
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Product quantity has to be a numerical value.'
            ),
        ),

        'product_price_unity' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Product price per unit is missing.'
            ),
            'numeric' => array(
                'rule' => array('decimal'),
                'message' => 'The product price per unit has to be a decimal value.'
            ),
        ),

    );

    public function beforeValidate($options = array()) {

        // get the companyId
        $this->companyId = CakeSession::read('Company.id');

    }

    public function beforeSave($options = array()) {


        // set company_id to Product
        $this->data['Product']['company_id'] = $this->companyId;

        return true;

    }

    public function checkUniqueProductNum($productNum){

        $companyId = CakeSession::read('Company.id');

        $conditions = array(
            'Product.company_id' => $companyId,
            'Product.product_num' => $productNum,
        );

        // Used for letting edit a Product, and save the productNum without validation blockage.
        if (isset($this->data[$this->alias][$this->primaryKey])) {
            $conditions[$this->alias . '.' . $this->primaryKey . ' <>'] = $this->data[$this->alias][$this->primaryKey];
        }

        if ($this->hasAny($conditions))
            return false;
        else
            return true;

    }

    public function getLastProductNum($companyId){

        $result = $this->find('first', array(
            'fields' => 'Product.product_num',
            'order' => 'Product.product_num DESC',
            'conditions' => array('Product.company_id' => $companyId)
        ));

        if($result == null)
            return '5000';
        else
            return $result['Product']['product_num'];

    }

}
