<?php

/**
 * Class CreationException
 */
class CreationException extends Exception {
	/**
	 * @return CreationException
	 */
	public static function insufficientResources() {
		return new self(
			'@TODO Translate missing resources.',
			1
		);
	}

	/**
	 * @return CreationException
	 */
	public static function cantBuild() {
		return new self('cantBuild', 2);
	}

	/**
	 * @return CreationException
	 */
	public static function cantUpgrade() {
		return new self('cantUpgrade', 3);
	}

	/**
	 * @return CreationException
	 */
	public static function invalidPosition() {
		return new self(
			'@TODO Translate invalid position.',
			4
		);
	}
}