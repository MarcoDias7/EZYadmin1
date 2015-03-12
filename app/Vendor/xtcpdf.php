<?php
	App::import('Vendor','tcpdf/tcpdf');
	 
	class XTCPDF extends TCPDF {

	    public function Header() {
	        // Logo
	        $this->Image(APP.WEBROOT_DIR.DS.'img'.DS.'mail'.DS.'ezy_logo.png', 10, 5, 50, 0, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
	    }

	    // Page footer
	    public function Footer() {
	        $this->SetY(-20);
	        $this->SetTextColor(104, 104, 104); 
	        // Set font
	        $this->SetFont('helvetica', '', 10);
	        // Page number
	        $html = '<div style="text-align: center;">'.__('www.ezycount.ch').'<br />'.
	        __('© EZYcount is a service of superVX AG, registered company in 3012 Bern').'</div>';
	        $this->writeHtml($html);
	    }

	}