<?php
class UsersController extends AppController {

	public $uses = array('User', 'Permission', 'Order');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->deny('all');
		$this->Auth->allow('login');
		$this->Auth->allow('subscribe');
		$this->Auth->allow('validation');
		$this->Auth->allow('forgot');
		$this->Auth->allow('forgot_change');
		$this->Auth->allow('language');
		$this->Auth->allow('resend_validation');
	}

	public function change_password() {
		$this->set('title_for_layout', __('Change my password'));
		$user = $this->User->findById($this->Auth->user('id'));
		if ($this->request->is('post') || $this->request->is('put')) {
			if (AuthComponent::password($this->request->data['User']['password']) != $user['User']['password']) {
					$this->setFlashDanger(__('Your password is invalid, please check your inputs.'));
			}
			else if ($this->request->data['User']['new_password'] != $this->request->data['User']['confirm_new_password']) {
				$this->setFlashDanger(__('The password don\'t match'));
			}
			else {
				$user['User']['password'] = $this->request->data['User']['new_password'];

				if ($this->User->save($user)) {
					$this->setFlash(__('Your password has been changed'));
				}
			}

		}
	}

	// The default page when the user is logged in
	public function index() {
		$this->set('title_for_layout', __('My companies'));
		$this->set('user', $this->Auth->user());

		$companies = $this->Permission->findAllByUserId($this->Auth->user('id'), array(), array('Permission.position DESC'));
		
		//To improve : find all subscriptions where id_company is in $companies
		$subscriptions = $this->Order->find('all');

		if (!empty($companies)) {
			$this->set('companies', $companies);
			$this->set('subscriptions', $subscriptions);
			if ($this->request->is('post') || $this->request->is('put')) {
				if($this->request->data['order_ok']);
					$this->setFlash(__('Thank you for the purchase.<br />
			The invoice has been sent to your email address: %s<br />
			A copy of the invoice will be available to you in Company Settings.', $this->Auth->user('email')));
			}

			$user = $this->User->findById($this->Auth->user('id'));
			$this->User->id = $this->Auth->user('id');

			// Check if the user did the tour (2 -> yes)
			if($user['User']['didTour']==0) { //Tour not done
				$this->User->saveField('didTour', 1);

				$this->set('doTour', true);
			}
			else if ($user['User']['didTour'] == 1) { //Tour done
				$this->User->saveField('didTour', 2);
			}
			
			$this->render('got_company');
		}
	}

	public function language($code) {
		$languages = array('fr', 'en', 'de');

		if (in_array($code, $languages)) {
			if ($this->Auth->loggedIn()) {
				$this->User->id = $this->Auth->user('id');
				$this->User->saveField('language', $code);
				$this->Session->write('Auth.User.language', $code);
			}
			$this->Session->write('language', $code);
		}

		return $this->redirect($this->referer());
	}


	public function forgot_change($user_id, $key) {

		if ($this->Auth->loggedIn()) {
			return $this->redirect('index');
		}

		$this->loadModel('PasswordKey');

		$user = $this->User->findById($user_id);

		$check = $this->PasswordKey->find('first', array('conditions' => array(
			'PasswordKey.user_id' => $user_id,
			'PasswordKey.key' => $key,
			'PasswordKey.created >=' => date('Y-m-d H:i:s', strtotime("-2 hours")))));

		if (!empty($check)) {
			if ($this->request->is('post') || $this->request->is('put')) {
				if ($this->request->data['User']['password'] != $this->request->data['User']['confirm_new_password']) {
					$this->setFlashDanger(__('The password don\'t match'));
				}
				else {
					$user['User']['password'] = $this->request->data['User']['password'];
					if ($this->User->save($user)) {
						$this->setFlash(__('Your password has been changed.'));
					}
				}
			}	
		}
		else {
			$this->setFlashDanger(__('This link is not valid anymore'));
			$this->redirect('/');
		}
	}


	public function forgot() {
		if ($this->Auth->loggedIn()) {
			return $this->redirect('index');
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			if (!empty($this->request->data['User']['email'])) {
				$checkEmail = $this->User->findByEmail($this->request->data['User']['email']);

				if (!empty($checkEmail)) {
					$key = sha1(md5(uniqid()));
					$this->loadModel('PasswordKey');

					$data = array('PasswordKey' => array(
						'user_id' => $checkEmail['User']['id'],
						'key' => $key));

					$this->PasswordKey->save($data);

					App::uses('CakeEmail', 'Network/Email');
					$Email = new CakeEmail();
					$Email->viewVars(array(
										'email' => $checkEmail['User']['email'],
										'key' => $key,
										'user_id' => $checkEmail['User']['id'],
										'firstname' => $checkEmail['User']['first_name'],
										'lastname' => $checkEmail['User']['last_name'],
									));

					$Email->template('forgot', 'beautiful')
							->emailFormat('html')
							->from(array('noreply@ezycount.ch' => 'EZYcount'))
							->to($checkEmail['User']['email'])
							->subject(__('Change your password'))
							->send();

					$this->setFlash(__('An email has been sent with a link to change your password. It will stay active for 2 hours.'));

				}
				else {
					$this->setFlashDanger(__('Couldn\'t find an account with this email.'));
				}
			}
		}

	}

	public function login() {

		$this->layout = 'login';
		
		if ($this->Auth->loggedIn()) {
			$this->redirect('admin');
		}

		// We change the layout to get rid of the navbar
		//$this->layout = 'signin';
		if ($this->request->is('post')) {
			// We try to log the user with the given informations
			if ($this->Auth->login()) {

				if ($this->Session->check('language') && $this->Session->read('language') != $this->Auth->user('language')) {
					$this->User->id = $this->Auth->user('id');
					$this->User->saveField('language', $this->Session->read('language'));
					$this->Session->write('Auth.User.language', $this->Session->read('language'));
				}
				// If the login was successful, we log the event in the database


				if ($this->Auth->user('disabled')) {
					$this->setFlashDanger(__('Your account has been disabled, please contact the support for more information.'));

					$this->Auth->logout();
				}

				else if (!$this->Auth->user('is_activated')) {
					$this->setFlashDanger(__('Your account has not been activated yet. Please check your emails and click on the confirmation link to activate your account.<br />
						If you want us to resend the validation email please click <a href="%s">here</a>.', Router::url('/users/resend_validation/'.$this->Auth->user('id'))));

					$this->Auth->logout();
				}
				else {
					$this->loadModel('Log');
					$save = array('user_id' => $this->Auth->user('id'),
					'ip' => $_SERVER['REMOTE_ADDR'],
					'user_agent' => $_SERVER['HTTP_USER_AGENT'],
					'message' => 'logged in');
					$this->Log->save($save);

					// Check if the user has a read access to a company, if so we log him into it
					$company = $this->User->Permission->find('first', array('conditions' =>
						array('Permission.user_id' => $this->Auth->user('id')),
						'order' => array('Permission.position DESC')));

					if (!empty($company)) {
						$this->Session->write('Company.id', $company['Company']['id']);

						$countcomp = $this->User->Permission->find('count',  array('conditions' =>
						array('Permission.user_id' => $this->Auth->user('id'))));

						if ($countcomp === 1 && $company['Company']['current_step'] == 5) {
							return $this->redirect('/bookings/cash');
						}
					}

					$redirect = $this->Auth->redirectUrl();
					if (strstr($redirect, 'activateright')) {
						return $this->redirect($redirect);
					}

					if($this->Session->read('language')==''){
						$this->Session->write('language', 'fr') ;
					}

					// We redirect to the user panel
					return $this->redirect('/admin');
				}
			}
			else {
					$this->setFlashDanger(__('The account / password is invalid.'));
			}
		}
	}

	public function logout() {
		$this->Session->destroy('Company.id');
		$this->redirect($this->Auth->logout());
	}


	
}
