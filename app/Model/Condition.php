<?php
App::uses('AppModel', 'Model');
/**
 * Condition Model
 *
 * @property DiscountDay $DiscountDay
 */
class Condition extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'label';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'label' => array(
			'alphaNumeric' => array(
				'rule' => array('alphaNumeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),

	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed



    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(

        'Company' => array(
            'className' => 'Company',
            'foreignKey' => 'company_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),

    );


/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'DiscountDay' => array(
			'className' => 'DiscountDay',
			'foreignKey' => 'condition_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
