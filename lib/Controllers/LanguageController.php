<?php
/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 20.04.2019
 * Time: 18:09
 */

namespace WHMCS\Module\Addon\ServiceNotice\Controllers;

use WHMCS\Module\Addon\ServiceNotice\Traits\JsonDecodeAndValidateTraits;
use WHMCS\Module\Addon\ServiceNotice\Exceptions\InvalidJsonException;
use WHMCS\Module\Addon\ServiceNotice\Configs\ModuleConfig;

class LanguageController {
	use JsonDecodeAndValidateTraits;
	private static $language = [];

	private static function getLanguage() {
		global $CONFIG;

		return isset( $_SESSION['Language'] ) ? $_SESSION['Language'] : $CONFIG['Language'];
	}

	/**
	 * @param string $language
	 *
	 * @return array
	 * @throws InvalidJsonException
	 */
	private static function loadLanguage( $language ) {
		return self::JsonDecodeAndValidate( file_get_contents( self::getLangPath() . $language . '.json' ), true );
	}

	private static function getLangPath() {
		return ModuleConfig::getWhmcsRootDir() . '/modules/addons/' . ModuleConfig::getModuleName() . '/lang/';
	}

	/**
	 * @throws InvalidJsonException
	 */
	public static function init() {
		self::$language = self::loadLanguage( ModuleConfig::getDefaultLanguage() );

		if ( file_exists( self::getLangPath() . self::getLanguage() . '.json' ) ) {
			self::$language = array_merge(
				self::$language,
				self::loadLanguage( self::getLanguage() )
			);
		}
	}

	/**
	 * @param string $key
	 *
	 * @return string
	 */
	public static function trans( $key ) {
		return self::$language[ $key ];
	}
}