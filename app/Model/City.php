<?php
  class City extends AppModel {

    public function getCity($country = null, $zip = null, $city = null) {

      if(!empty($zip) || !empty($city)) {

        $conditions = array('country' => $country);

        if ($zip != null) {
          $conditions['zip LIKE'] = trim($zip).'%';
        }
        else {
          $conditions['city LIKE'] = trim($city).'%';
        }

        $city = $this->find('all', array(
          'conditions' => $conditions
        ));

        return Set::combine($city, '{n}.City.id', '{n}.City');
      }
      return false;
    }
  }