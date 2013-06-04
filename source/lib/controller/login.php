<?php

class Controller_Login extends Controller_Abstract {
	private function rememberUser() {
		$cookie = new Leviathan_Cookie();

		$userKey = $cookie->value('user');
		if (!$userKey) {
			return;
		}

//		$database = new Lisbeth_Database();
//		$escapedUserKey = $database->escape($userKey);
//
//		$sql = "
//			SELECT
//				`id`
//			FROM
//				`accounts`
//			WHERE
//				MD5(CONCAT(`id`,  `password`)) = '{$escapedUserKey}'
//			LIMIT 1;";
//		$result = $database->query($sql)->fetchOne();
//		$database->freeResult();

		$result = md5('1md5 hash');
		if ($result) {
			$cookie->store('user', $result);

			$accountId = 1;

			$session = new Leviathan_Session();
			$session->store('userId', $accountId);

//			$continue = $this->request()->get('continue');
//			if (!$continue) {
//				$continue = 'profile';
//			}

			$this->redirect(
				Router::build(array('city'))
			);
		}
	}

	/**
	 * @param int $accountId
	 * @param string $password
	 */
	private function createCookie($accountId, $password) {
		$cookie = new Leviathan_Cookie();
		$cookie->store(
			'user',
			md5($accountId . $password),
			86400 * 365
		);
	}

	public function index() {
		$this->assertOffline();

		$this->rememberUser();

		$request = $this->request();
		if ($request->post('login')) {
			$name = (string)$request->post('name', '');
			$password = (string)$request->post('password', '');

			// Account mock
			$account = array(
				'id' => 1,
				'password' => 'md5 hash',
				'language' => 'en'
			);

			$accountId = (int)$account['id'];

			$session = new Leviathan_Session();
			$session
				->store('userId', $accountId)
				->store('language', $account['language']);

			$this->createCookie($accountId, $account['password']);


			$url = Router::build(array('city'));
			$this->redirect($url);
		}

		JavaScript::getInstance()
			->bind("$('.moreGames').moreGames();")
			->bind("$('.login').loginBox();");

		$template = new Leviathan_Template();

		$this->render($template, 'login');
	}

	/**
	 * @return array
	 */
	protected function pageData() {
		return array(
			'title' => Game::getInstance()->name() . ' - Login',
			'template' => 'pageOffline'
		);
	}
}