<?php

/**
 * Class CreationException
 */
class CreationException extends Exception {
	/**
	 * @throws CreationException
	 */
	public static function insufficientResources() {
		return new self(
			'@TODO Translate missing resources.',
			1
		);
	}

	/**
	 * @throws CreationException
	 */
	public static function noConstructionSite() {
		return new self(
			'@TODO Translate construction site not available.',
			2
		);
	}

	/**
	 * @throws CreationException
	 */
	public static function invalidPosition() {
		return new self(
			'@TODO Translate invalid position.',
			3
		);
	}
}