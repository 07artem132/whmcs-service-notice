<?php
/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 24.12.2017
 * Time: 15:02
 */

namespace WHMCS\Module\Addon\ServiceNotice\Configs;


class SmartyConfig {

	public static function GetTemplateDir() {
		return ROOTDIR . '/modules/addons/' . ModuleConfig::getModuleName() . '/templates/';
	}

	public static function GetCompileDir() {
		return ROOTDIR . '/templates_c';
	}
}