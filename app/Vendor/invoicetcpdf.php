<?php
	App::import('Vendor','tcpdf/tcpdf');
	 
	class INVOICETCPDF extends TCPDF {

		public $footer = "TEST";
		public $header = "TEST";

	    public function Header() {

			// Set font
			$this->SetFont('helvetica', '', 11);

	        // Logo
	        //$this->Image(APP.WEBROOT_DIR.DS.'img'.DS.'mail'.DS.'ezy_logo.png', 10, 5, 50, 0, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
			$this->writeHTML($this->header);
	    }

	    // Page footer
	    public function Footer($html = "test") {

	        $this->SetY(-20);

	        // Set font
	        $this->SetFont('helvetica', '', 11);

	        $this->writeHtml($this->footer);
	    }

		public function setFooterHtml($footer){

			$this->footer = $footer;

		}

		public function setHeaderHtml($header){

			$this->header = $header;

		}

	}