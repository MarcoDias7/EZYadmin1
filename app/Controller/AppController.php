<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $helpers = array("Js",
        'EZYCount',
        'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
        'Form' => array('className' => 'BoostCake.BoostCakeForm'),
        'Paginator' => array('className' => 'BoostCake.BoostCakePaginator'),
    );
	public $components = array("RequestHandler", "Session",
		'Auth' => array(
            'authenticate' => array(
                'Form' => array(
                    'fields' => array('username' => 'email'),
                )
            ),
            'flash' => array(
                'element' => 'alert',
                'key' => 'auth',
                'params' => array(
                    'plugin' => 'BoostCake',
                    'class' => 'alert-error'
                )
            ),
            'loginAction' => array('controller' => 'users', 'action' => 'login'),
            'loginRedirect' => array('controller' => 'users', 'action' => 'index'),
            'logoutRedirect' => '/',
            'authError' => "You need to sign in in order to view this page."
        )
	);

    public function beforeFilter() {
        $this->Auth->loginRedirect = array('controller' => 'users', 'action' => 'index');

        $languages = array('fr' => 'fra', 'en' => 'eng', 'de' => 'deu'
            );
        $browserLanguage = 'fr';
        if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            $browserLanguage = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        }
        if ($this->Auth->loggedIn()) {
            $langUser = $this->Auth->user('language');
            $lang = $langUser;
        }
        else if ($this->Session->check('language') && isset($languages[$this->Session->read('language')])) {
            $lang = $this->Session->read('language');
        }
        else if (isset($languages[$browserLanguage]) && $browserLanguage != 'de') {
            $lang = $browserLanguage;
        }
        else {
            $lang = 'fr';
        }

        $this->changeLanguage($lang);

        if ($this->Auth->loggedIn()) {
            $this->LoadModel('Company');
            $this->LoadModel('Notification');
            $this->LoadModel('Permission');
            $this->Company->recursive = 0;
            $company = $this->Company->findById($this->Session->read('Company.id'));
            if (!empty($company)) {

                $curTime = time();
                $timeToGet = $curTime;
                if (date('N', $curTime) <= 2) {
                    $timeToGet += 3600*24*3;
                }
                else {
                    $timeToGet += 3600*24*5;
                }
                $timeToGet = date('Y-m-d', $timeToGet);

                $notifs = $this->Notification->find('count', array('conditions' => array(
                    'Notification.company_id' => $company['Company']['id'],
                    'Notification.done' => 0,
                    'Notification.date <=' => $timeToGet
                    )));
                $this->set('notifReminder', $notifs);

            }
            $this->set('MenuCurrentCompany', $company);
            $this->set('is_admin', $this->checkPermission('admin'));
            $this->set('can_write', $this->checkPermission('write'));
        }
    }

    // Return if the user has the right to read, write or is an admin of the current company
    protected function checkPermission($type = '', $companyId = '') {
        $this->loadModel('Permission', 'Company');

        $undirectId = $companyId;

        if (empty($companyId)) {
            $companyId = $this->Session->read('Company.id');
        }
        if (!is_null($companyId)) {
            $this->Company->contain();
            $comp = $this->Company->findById($companyId);
            //if (!empty($comp) && $comp['Company']['current_step'] == 5) {
                $userPerm = $this->Permission->findByUserIdAndCompanyId($this->Auth->user('id'), $companyId);
                return (isset($userPerm) && (empty($type) || (($userPerm['Permission']['write'] || $userPerm['Permission']['admin']) && $type == 'write' && ($undirectId || (!$undirectId && !$userPerm['Company']['is_expired']))
                    || ($userPerm['Permission']['admin'] && $type == 'admin'))));
            //}
        }
        return false;
    }

    // Return if the user has the right to read, write or is an admin of the current company
    protected function getPermission() {
        $this->loadModel('Permission');
        $companyId = $this->Session->read('Company.id');
        if (!is_null($companyId)) {
            $userPerm = $this->Permission->findByUserIdAndCompanyId($this->Auth->user('id'), $companyId);
            if ($userPerm['Permission']['admin']) {
                return 'admin';
            }
            else if ($userPerm['Permission']['write']) {
                return 'write';
            }
            else {
                return 'read';
            }
        }
        return '';
    }

   public function dateToMysql($date) {
      if (empty($date)) {
            return '';
      }
    $token = "-";
    if (strpos('.', $date) != -1) {
        $token = '.';
    }
        @list($day, $month, $year) = explode($token, $date);
        return $year."-".$month."-".$day;
    }

    public function dateFromMysql($date) {
      if (empty($date)) {
            return '';
      }
        @list($year, $month, $day) = explode("-", $date);
        return $day.".".$month.".".$year;
    }

    public function dateTimeFromMysql($datetime) {
        $date = explode(" ", $datetime);

        @list($year, $month, $day) = explode("-", $date[0]);
        return $day.".".$month.".".$year." ".$date[1];
    }
    

    protected function setFlash($message, $type = 'success') {
        $this->Session->setFlash($message, 'alert', array(
            'plugin' => 'BoostCake',
            'class' => 'alert-'.$type
        ));
    }

    protected function setFlashDanger($message) {
        $this->setFlash($message, 'danger');
    }


    protected function format_nbr($nbr, $decimal = 2) {
        return number_format($nbr, $decimal, '.', '\'');
    }


    protected function swiss_rounding($value) {
        $value = number_format($value, 2, '.', '');
        $last = strlen($value) - 1;
        $lastDigit = $value[$last];
        if ($lastDigit >= 3 && $lastDigit <= 6) {
            $lastDigit = 5;
        }
        else {
            $lastDigit = 0;
        }
        $value[$last] = $lastDigit;
        return $value;
    }


   protected function changeLanguage($lang) {
        $languages = array('fr' => 'fra', 'en' => 'eng', 'de' => 'deu'
            );
        if (!isset($languages[$lang])) {
            $lang = 'fr';
        }
        $this->language = $lang;
        $this->set('language', $this->language);
        Configure::write('Config.language', $languages[$lang]);
    }
 }

