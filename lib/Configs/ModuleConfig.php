<?php
/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 24.04.2019
 * Time: 15:27
 */

namespace WHMCS\Module\Addon\ServiceNotice\Configs;


class ModuleConfig {
	private static $moduleName = 'ServiceNotice';
	private static $defaultLanguage = 'russian';
	private static $whmcsRootDir = ROOTDIR;

	/**
	 * @return mixed
	 */
	public static function getWhmcsRootDir() {
		return self::$whmcsRootDir;
	}
	/**
	 * @return string
	 */
	public static function getDefaultLanguage() {
		return self::$defaultLanguage;
	}

	/**
	 * @return string
	 */
	public static function getModuleName() {
		return self::$moduleName;
	}

}