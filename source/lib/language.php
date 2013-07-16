<?php

class Language {
	/**
	 * @return string
	 */
	public function get() {
		global $languages; // @TODO retrieve from config class.

		$session = new Leviathan_Session();
		$language = $session->value('language');

		if (!$language || !array_key_exists($language, $languages)) {
			$language = $languages[0];
			$session->store('language', $language);
		}

		return $language;
	}
}