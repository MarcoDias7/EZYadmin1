<?php
	class ImportExampleBookingShell extends AppShell {

		public $uses = array('VatAccount', 'Booking', 'Account');

	    public function main() {

	    	ini_set('auto_detect_line_endings', TRUE);

	    	$this->company_id = 82;
	    	$user_id = 2;

	    	$first_line = true;

	    	$this->Booking->validator()->remove('amount', 'rounding');

	    	$custom_id = 1;


			if (($handle = fopen("ImportData/example_booking.csv", "r")) !== FALSE) {
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