<?php
  class CitiesController extends AppController {

    public $layout = 'basic';

    public $components = array('RequestHandler');

    public function index() {
      if ($this->request->is('ajax')) {
        $city = $this->request->query('city');
        $zip = $this->request->query('zip');
        $country = $this->request->query('country');
        $cities = $this->City->getCity($country, $zip, $city);
        $this->set(compact('cities'));
        $this->set('_serialize', 'cities');
      }
    }
  }