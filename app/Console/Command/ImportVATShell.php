<?php
	class ImportVATShell extends AppShell {

		public $uses = array('VatAccount');

	    public function main() {

	    	ini_set('auto_detect_line_endings', TRUE);

			if (($handle = fopen("ImportData/VAT table.csv", "r")) !== FALSE) {
			    while (($data = fgetcsv($handle, 0, ";")) !== FALSE) {
			    	$tosave = array('VatAccount' => array(
			    		'company_id' => NULL,
			    		'code' => $data[0],
			    		'name' => utf8_encode($data[1]),
			    		'number' => (empty($data[2])) ? '' : str_replace(';;', ';', ';'.implode(';', explode(';', $data[2])).';'),
			    		'due' => ($data[3] == '1'),
			    		'rate' => ($data[5] == NULL) ? 0 : $data[5],
						'selected' => ($data[7] == '1'), 	
						'valid_from' => '2013-01-01',
						'model' => 1		    		
			    	));
			    		$this->VatAccount->create();
			    		$this->VatAccount->save($tosave);
		    	}
		    	fclose($handle);
			}
	    }
	}