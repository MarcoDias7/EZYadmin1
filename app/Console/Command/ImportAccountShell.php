<?php
	class ImportAccountShell extends AppShell {

		public $uses = array('Account', 'AccountCategory');

	    public function main() {

	    	$lastRootCat = NULL;
	    	$lastSecCat = NULL;
	    	$lastLeafCat = NULL;
	    	ini_set('auto_detect_line_endings', TRUE);

			if (($handle = fopen("ImportData/accounts.csv", "r")) !== FALSE) {
			    while (($data = fgetcsv($handle, 0, ";")) !== FALSE) {
			        if (trim($data[0])) {
			        	$name = $data[2];
			        	$range_bottom = $data[0];
			        	$range_up = $data[1];
			        	$this->AccountCategory->create();
			        	$this->AccountCategory->save(array('AccountCategory' => array('company_type' => (empty($data[19])) ? ' ' : $data[19], 'name_fr' => utf8_encode($name), 'name_en' => utf8_encode($data[22]), 'name_de' => utf8_encode($data[21]), 'range_bottom' => $range_bottom, 'range_up' => $range_up, 'show' => !empty($data[17]))));
			        	$lastRootCat = $this->AccountCategory->getLastInsertId();
			        	$lastLeafCat = NULL;
			        	$this->out('New category : '.$name);
			        }
			        else if (trim($data[3])) {
			        	$name = $data[5];
			        	$range_bottom = $data[3];
			        	$range_up = $data[4];
			        	$this->AccountCategory->create();
			        	$this->AccountCategory->save(array('AccountCategory' =>
							array('parent_id' => $lastRootCat, 'company_type' => (empty($data[19])) ? ' ' : $data[19], 'name_fr' => utf8_encode($name), 'name_en' => utf8_encode($data[22]), 'name_de' => utf8_encode($data[21]), 'range_bottom' => $range_bottom, 'range_up' => $range_up, 'show' => !empty($data[17]))));
			        	$lastSecCat = $this->AccountCategory->getLastInsertId();
 			        	$this->out('New sub-category : '.$name);
			        }
			        else if (trim($data[6])) {
			        	$name = $data[8];
			        	$range_bottom = $data[6];
			        	$range_up = $data[7];
			        	$this->AccountCategory->create();
			        	$this->AccountCategory->save(array('AccountCategory' =>
							array('parent_id' => $lastSecCat, 'company_type' => (empty($data[19])) ? ' ' : $data[19], 'name_fr' => utf8_encode($name), 'name_en' => utf8_encode($data[22]), 'name_de' => utf8_encode($data[21]), 'range_bottom' => $range_bottom, 'range_up' => $range_up, 'show' => !empty($data[17]))));
			        	$lastLeafCat = $this->AccountCategory->getLastInsertId();
 			        	$this->out('New sub-category : '.$name);
			        }
			        else if (trim($data[9])) {
		        		$this->Account->create();
		        		if ($lastLeafCat != NULL) {
		        			$cat = $lastLeafCat;
		        		}
		        		else if ($lastSecCat != NULL) {
		        			$cat = $lastSecCat;
		        		}
		        		else {
		        			$cat = $lastRootCat;
		        		}

		        		$tosave = array(
		        			'account_category_id' => $cat,
		        			'number' => $data[9],
		        			'title_fr' => utf8_encode($data[10]),
		        			'title_en' => utf8_encode($data[22]),
		        			'title_de' => utf8_encode($data[21]),
		        			'cash' => $data[13],
		        			'VAT' => $data[14],
		        			'debit_green' => $data[15],
		        			'type' => $data[20],
		        			'VAT_paid' => ($data[18] == 'paye'),
		        			'VAT_owed' => ($data[18] == 'recu'),
		        			'model' => ($data[16] == '1') ? 'simplified' : 'default',
		        		);

		        		if (!empty($data[19])) {
		        			$tosave['company_type'] = $data[19];
		        		}



		        		$this->Account->save(array('Account' => $tosave), false);
		        		$this->out($this->Account->validateErrors);
		        		$this->out('New account : '.$data[10]);
			        }
		    	}
		    	fclose($handle);
			}
	    }
	}