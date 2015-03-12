<?php
class AdminController extends AppController {


	public $components = array('Paginator');

	public $uses = array('Order', 'User', 'Permission', 'Company', 'Import', 'Booking', 'Coupon', 'VatAccount', 'Account');


	public $paginate = array(
   		'paramType' => 'querystring'
	);

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->deny();

		if (!$this->Auth->user('is_admin')) {
			return $this->redirect('/');
		}

		$this->layout = 'admin';
	}


	public function index() {
		$nbr_plan1 = $this->Order->find('count', array('conditions' => array('Order.status' => 5, 'Order.plan' => 1)));
		$nbr_plan2 = $this->Order->find('count', array('conditions' => array('Order.status' => 5, 'Order.plan' => 2)));
		$nbr_plan3 = $this->Order->find('count', array('conditions' => array('Order.status' => 5, 'Order.plan' => 3)));

		$nbr_sells = $nbr_plan1 + $nbr_plan2 + $nbr_plan3;

		$users = $this->User->find('count');

		$users_paying = $this->Order->find('all', array('conditions' => array('Order.status' => 5), 'group' => 'Order.user_id'));

		$users_paying = count($users_paying);

		$users_with_access = $this->Permission->find('count', array('group' => 'Permission.user_id',
			'conditions' => array('Company.test' => 0),
			"joins" => array(
            array(
                "table" => "companies",
                "alias" => "Companies",
                "type" => "LEFT",
                "conditions" => array(
                    "Companies.id = Permission.company_id"
                )
            ))));

		$companies_test = $this->Company->find('count', array('conditions' => array('Company.test' => 1)));

		$companies = $this->Company->find('count', array('conditions' => array('Company.test' => 0, 'Company.current_step' => 5)));

		$companies_total = $companies_test + $companies;

		$bookings = $this->Booking->find('count', array('conditions' => array('Company.test' => 0, 'Company.current_step' => 5),
		"joins" => array(
            array(
                "table" => "companies",
                "alias" => "Companies",
                "type" => "LEFT",
                "conditions" => array(
                    "Companies.id = Booking.company_id"
                )
            ))));

		$avg_bookings = round($bookings / $companies, 2);

		$avg_users = round($users_with_access / $companies, 2);

		$coupons = $this->Coupon->find('count');


		$this->set(compact('nbr_plan1', 'nbr_plan2', 'nbr_plan3', 'nbr_sells', 'users', 'users_paying', 'users_with_access', 'coupons', 'companies', 'companies_total', 'companies_test', 'avg_users', 'avg_bookings'));
	}

	public function edit_user($id = '') {
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->User->id = $id;
			$this->User->saveField('email', $this->request->data['User']['email']);
			$this->User->saveField('disabled', $this->request->data['User']['disabled']);
			return $this->redirect('users');
		}
		else {
			$this->request->data = $this->User->findById($id);
		}
	}

	public function users() {
		ini_set('memory_limit', '256M');
		$this->adminhelper('User');

		$usersList = $this->User->find('all', array(
		    'fields' => array(
		        'User.*',
		        'Log.created'
		    ),
		    'joins' => array(
		        array(
		            'table' => 'logs',
		            'alias' => 'Log',
		            'type'  => 'left outer',
		            //'fields' => array('MAX (Log.id) AS id'),
		            'conditions' => array(
		                ' User.id = Log.user_id'
		            ),
		            'order' => array('Log.created' => 'desc')
		        )
		    ),
		    'order' => array('User.id' => 'asc')
		));

/*
		

		foreach($usersList as $key=>$value){
			$importUser = $this->Import->find('first', array('conditions' => array('Import.user_id' => $value['User']['id'])));
			
			if(!empty($importUser)){
				$value['User']['hasImport'] = true;
			}
		}
		


*/

		
		//$this->adminhelper('Logs');
		//$this->set('usersList', $this->User->find('all'));

		//	$this->recursive = -1;
		//debug($usersList);die();


		$this->set('usersList', $usersList);

	}

	public function disable_company($id = '') {
		if (!empty($id)) {
			$this->Company->id = $id;
			$comp = $this->Company->findById($id);
			if (!empty($comp)) {
				$this->Company->saveField('disabled', !($comp['Company']['disabled']));
			}
		}
		return $this->redirect('companies');
	}

	public function coupons() {
		$this->adminhelper('Coupon');
		$this->set('CouponsList', $this->Coupon->find('all'));
	}

	public function coupon_create() {
		$this->adminhelper('Coupon');

		if ($this->request->is('post')) {
            
            $this->Coupon->create();

            if ($this->Coupon->save($this->request->data)) {
                $this->Session->setFlash(__('Your coupon has been saved.'));
                return $this->redirect(array('action' => 'coupons'));
            }

            $this->Session->setFlash(__('Unable to add your coupon.'));
        }
	}

	public function coupon_edit($id = null) {
		if (!$id) {
        	//error
    	}

		$coupon = $this->Coupon->findById($id);
		if (!$coupon) {
        	//error
    	}


		if ($this->request->is(array('post', 'put'))) {
		        $this->Coupon->id = $id;
		        if ($this->Coupon->save($this->request->data)) {
		            $this->Session->setFlash(__('Your coupon has been updated.'));
		            return $this->redirect(array('action' => 'coupons'));
		        }
		        $this->Session->setFlash(__('Unable to update your coupon.'));
		}

		if (!$this->request->data) {
        	$this->request->data = $coupon;
    	}
	}

	public function coupon_delete($id) {

	    if ($this->Coupon->delete($id)) {
	        $this->Session->setFlash(
	            __('The coupon has been deleted')
	        );
	        return $this->redirect(array('action' => 'coupons'));
	    }

	}

	public function companies() {
		$this->adminhelper('Company');
		$this->set('companiesList', $this->Company->find('all'));
	}

	public function export_orders() {
		$header = array('amount ht', 'zip', 'date', 'plan', 'language', 'status (5 = ok)');

		$orders = $this->Order->find('all');

		$output = fopen('php://output', 'w');
		ob_start();
		fputcsv($output, $header);

		foreach ($orders as $item) {

			$line = array($item['Order']['amount_ht'], $item['Order']['zip'], $item['Order']['created'],
				$item['Order']['plan'], $item['Order']['language'], $item['Order']['status']);
			fputcsv($output, $line);
		}
		fclose($output);
		$csv = ob_get_clean();
	    $this->response->body($csv);
	    $this->response->type('csv');

	    $this->response->download(date('ymd').'_order_export.csv');

	    return $this->response;
	}
	
	public function export_users() {
		$header = array('title', 'zip', 'bought a plan', 'language', 'created');

		$this->User->contain(array('Permission', 'Permission.Company', 'Order'));
		$users = $this->User->find('all');

		$output = fopen('php://output', 'w');
		ob_start();
		fputcsv($output, $header);

		foreach ($users as $item) {
			$zip = Set::extract('Permission.{n}.Company.zip', $item);
			$zip = array_unique($zip);
			$line = array($item['User']['title'], implode(";", $zip), empty($item['Order']) ? 'no' : 'yes', $item['User']['language'], $item['User']['created']);
			fputcsv($output, $line);
		}
		fclose($output);
		$csv = ob_get_clean();
	   	$this->response->body($csv);
	    $this->response->type('csv');

	    $this->response->download(date('ymd').'_users_export.csv');
	    return $this->response;
	}

	public function export_companies() {
		$header = array('number', 'zip', 'type', 'vat', 'created', 'effective / net', 'expiration date', 'current step (5 = ok)', 'test');

		$companies = $this->Company->find('all');

		$output = fopen('php://output', 'w');
		ob_start();
		fputcsv($output, $header);

		foreach ($companies as $item) {
			$line = array($item['Company']['number'], $item['Company']['zip'], $item['Company']['type'], ($item['Company']['vat_registered'] ? 'yes' : 'no'), $item['Company']['created'], ($item['Company']['vat_model'] ? 'effective' : 'net'), $item['Company']['expiration_date'], $item['Company']['current_step'], ($item['Company']['test'] ? 'yes' : 'no'));
			fputcsv($output, $line);
		}
		fclose($output);
		$csv = ob_get_clean();
	   	$this->response->body($csv);
	    $this->response->type('csv');

	    $this->response->download(date('ymd').'_companies_export.csv');
	    return $this->response;
	}


	private function adminhelper($model = '') {
		if ($this->request->is('post') || $this->request->is('put')) {
			if (!empty($this->request->data['Filter'])) {
				$filter_url['controller'] = $this->request->params['controller'];
				$filter_url['action'] = $this->request->params['action'];
				// We need to overwrite the page every time we change the parameters
				$filter_url['page'] = 1;
				$filter_url['key_search'] = urlencode($this->request->data['Filter']['key']);
                $filter_url['search'] = urlencode($this->request->data['Filter']['search']);
				return $this->redirect($filter_url);
			}
		}

		if (isset($this->params['named']['search']) && !empty($this->params['named']['key_search'])) {
			$this->Paginator->settings['conditions'] = array($this->params['named']['key_search'].' LIKE' => '%'.$this->params['named']['search'].'%');
			$this->request->data['Filter']['key'] = $this->params['named']['key_search'];
			$this->request->data['Filter']['search'] = $this->params['named']['search'];
		}

	    $data = $this->Paginator->paginate($model);
	    $this->set('data', $data);
	}


	    public function import_ezy() {

	    	ini_set('auto_detect_line_endings', TRUE);

	    	$this->company_id = 99;
	    	$user_id = 2;

	    	$first_line = true;

	    	$this->Booking->validator()->remove('amount', 'rounding');

	    	$custom_id = 1;


			if (($handle = fopen(APP."/ImportData/example_booking.csv", "r")) !== FALSE) {
			    while (($data = fgetcsv($handle, 0, ";")) !== FALSE) {

			    	if ($first_line) {
			    		$first_line = false;
			    		continue;
			    	}

			    	$requestdata = array('Booking' => array());
			    	$requestdata['Booking']['company_id'] = $this->company_id;
			    	$date = explode(".", $data[0]);
			    	$requestdata['Booking']['date'] = $date[2].'-'.$date[1].'-'.$date[0];
			    	$requestdata['Booking']['description'] = $data[1];

			    	$debit_account = $this->Account->findByCompanyIdAndNumber($this->company_id, $data[2]);
			    	if (empty($debit_account)) {
			    		echo "Can't find the account number ".$data[2].", discarding\n";
			    		continue;
			    	}
			    	$credit_account = $this->Account->findByCompanyIdAndNumber($this->company_id, $data[3]);
			    	if (empty($credit_account)) {
			    		echo "Can't find the account number ".$data[3].", discarding\n";
			    		continue;
			    	}
			    	$requestdata['Booking']['custom_id'] = $custom_id;
			    	$requestdata['Booking']['debit_account_id'] = $debit_account['Account']['id'];
			    	$requestdata['Booking']['credit_account_id'] = $credit_account['Account']['id'];
			    	$requestdata['Booking']['amount'] = trim(str_replace("'", '', $data[4]));

			    	if ($data[5] == 1) {
				    	$tva_account = $this->VatAccount->findByCompanyIdAndCode($this->company_id, trim($data[7]));
				    	if (empty($tva_account)) {
				    		echo "Can't find the vat account number ".$data[7].", discarding\n";
				    		continue;
				    	}
				    	$requestdata['Booking']['vat_account_id'] = $tva_account['VatAccount']['id'];

				    	$requestdata['Booking']['vat_net'] = ($data[6] == 0);
			    	}

			    	print_r($requestdata);





					/* We use a transaction to make things atomic
						Indeed, the amount is in each booking but we keep a total in the Account table
						so we have to make sure that at each moment the sum is the same
					*/
					$ds = ConnectionManager::getDataSource('default');
					// We begin the transaction
					$ds->begin();
					$error = true;

					$useVAT = false;
					if (!empty($requestdata['Booking']['vat_account_id'])) {
						$useVAT = true;
						$vatAcc = $this->VatAccount->findByCompanyIdAndId($this->company_id, $requestdata['Booking']['vat_account_id']);

						if (!empty($vatAcc)) {
							$net = ($requestdata['Booking']['vat_net']);
							$vatRate = $vatAcc['VatAccount']['rate'] / 100;

							if ($vatAcc['VatAccount']['due']) {
								$vatMainAcc = $this->Account->findByCompanyIdAndVatOwed($this->company_id, 1);
							}
							else {
								$vatMainAcc = $this->Account->findByCompanyIdAndVatPaid($this->company_id, 1);	
							}

						}
						else {
							// throw an error
							$useVAT = false;
						}
					}


					// $requestdata['Booking']['company_id'] = $this->company_id;
					// $oldDate = $requestdata['Booking']['date'];
					// @list($day, $month, $year) = explode("-", $requestdata['Booking']['date']);
					// $requestdata['Booking']['date'] = $year.'-'.$month.'-'.$day;
					// $this->Booking->create();
					// if ($this->Booking->save($requestdata)) {
					// 	$this->Account->recursive = 1;
					// 	$debit_account = $this->Account->findById($requestdata['Booking']['debit_account_id']);
					// 	if (!empty($debit_account)) {
					// 			if ($useVAT && $debit_account['VAT']) {
					// 				if ($requestdata['Booking']['vat_account_id'])
					// 			}
					// 			$debit_account['Account']['amount'] += $requestdata['Booking']['amount'];
					// 			if ($this->Account->save($debit_account)) {
					// 			$credit_account = $this->Account->findById($requestdata['Booking']['credit_account_id']);
					// 			if (!empty($credit_account)) {
					// 				$credit_account['Account']['amount'] -= $requestdata['Booking']['amount'];
					// 				if ($this->Account->save($credit_account)) {
					// 					$ds->commit();
					// 					$error = false;
					// 					return $this->redirect('/bookings');
					// 				}
					// 			}
					// 		}
					// 	}
					// }


					$this->Account->recursive = 1;
					$debit_account = $this->Account->findById($requestdata['Booking']['debit_account_id']);
					$credit_account = $this->Account->findById($requestdata['Booking']['credit_account_id']);
					$oldAmount = $requestdata['Booking']['amount'];
					if (!empty($debit_account) && !empty($credit_account)) {
							if ($useVAT && ($debit_account['Account']['VAT'] || $credit_account['Account']['VAT'])) {
								if ($net) {
									$requestdata['Booking']['amount'] = $oldAmount / (1 + $vatRate);
									$vatAmount = $oldAmount * ($vatRate / (1 + $vatRate));
								}
								else {
									$vatAmount = $oldAmount * $vatRate;	
								}
							}
							if ($this->Account->save($debit_account)) {
							if ($this->Account->save($credit_account)) {
								$requestdata['Booking']['company_id'] = $this->company_id;
								$oldDate = $requestdata['Booking']['date'];
								$requestdata['Booking']['user_id'] = $user_id;
								$this->Booking->create();
								if ($this->Booking->save($requestdata)) {
									$mainBookingId = $this->Booking->getLastInsertID();

									$noMinError = true;

									if ($useVAT) {
										if ($debit_account['Account']['VAT']) {
											$newBooking = array('Booking' => array(
												'company_id' => $this->company_id,
												'user_id' => $user_id,
												'description' => 'VAT',
												'debit_account_id' => $vatMainAcc['Account']['id'],
												'credit_account_id' => $credit_account['Account']['id'],
												'amount' => $vatAmount,
												'custom_id' => $custom_id,
												'state' => 'booked',
												'date' => $requestdata['Booking']['date'],
												'vat_booking_id' => $mainBookingId
											));

											$this->Booking->create();
											$noMinError = $this->Booking->save($newBooking);
										}

										if ($noMinError && $credit_account['Account']['VAT']) {
											$newBooking = array('Booking' => array(
												'company_id' => $this->company_id,
												'user_id' => $user_id,
												'description' => 'VAT',
												'credit_account_id' => $vatMainAcc['Account']['id'],
												'debit_account_id' => $debit_account['Account']['id'],
												'amount' => $vatAmount,
												'custom_id' => $custom_id,
												'state' => 'booked',
												'date' => $requestdata['Booking']['date'],
												'vat_booking_id' => $mainBookingId
											));

											$this->Booking->create();
											$noMinError = $this->Booking->save($newBooking);
										}
									}

									if ($noMinError) {
										$ds->commit();
										$error = false;
									}
								}
							}
						}
					}

					$requestdata['Booking']['date'] = $oldDate;
					if ($error) {
						print_r($this->Booking->validationErrors);
						echo "ERROR\n";
						$ds->rollback();
					}
					$custom_id++;
		    	}
		    	fclose($handle);
			}
	    }
}