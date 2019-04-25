<?php
/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 20.04.2019
 * Time: 17:57
 */

use \WHMCS\Module\Addon\ServiceNotice\API\AdminAjaxApi;
use \WHMCS\Module\Addon\ServiceNotice\Controllers\LanguageController;
use \WHMCS\Module\Addon\ServiceNotice\Pages\AdminLabelViewPage;
use \WHMCS\Module\Addon\ServiceNotice\Pages\ClientLabelEditPage;
use \WHMCS\Module\Addon\ServiceNotice\Controllers\UninstallController;
use \WHMCS\Module\Addon\ServiceNotice\Controllers\InstallController;
use  WHMCS\Module\Addon\Setting;
use \WHMCS\Module\Addon\ServiceNotice\Configs\ModuleConfig;

function ServiceNotice_config() {
	LanguageController::init();

	return [
		"name"        => LanguageController::trans( 'name' ),
		"description" => LanguageController::trans( 'description' ),
		"version"     => "1",
		"author"      => "<a href=\"https://github.com/07artem132\">07artem132</a>",
		"language"    => "russian",
		"fields"      => [
			"DeleteTableWhenDisabled" => [
				"FriendlyName" => "Удалять данные модуля при отключении ?",
				"Type"         => "yesno",
				"Description"  => " Отметьте здесь дабы удалить данные модуля при отключении оного.",
			]
		]
	];
}

/**
 * @param $vars
 *
 * @throws SmartyException
 */
function ServiceNotice_output( $vars ) {
	$AdminAjaxApi = new AdminAjaxApi();
	$AdminAjaxApi->boot();

	$AdminLabelViewPage = new AdminLabelViewPage();
	$AdminLabelViewPage->render();
}

function ServiceNotice_activate() {

	if ( ! empty( $error = InstallController::createTableServiceNotice() ) ) {
		return $error;
	}

	if ( ! empty( $error = InstallController::createTableServiceNoticeAllowForProduct() ) ) {
		return $error;
	}

	return array(
		'status'      => 'success',
		'description' => LanguageController::trans( 'successfulActivation' ),
	);
}

function ServiceNotice_deactivate() {
	if ( ! empty( $dropTable = Setting::Module( ModuleConfig::getModuleName() )->where( 'setting', '=', 'DeleteTableWhenDisabled' )->first() ) ) {
		if ( $dropTable->value === 'on' ) {
			if ( ! empty( $error = UninstallController::dropTable( 'mod_addon_service_notice' ) ) ) {
				return $error;
			}

			if ( ! empty( $error = UninstallController::dropTable( 'mod_addon_service_notice_allow_for_product' ) ) ) {
				return $error;
			}
		}
	}

	return array(
		'status'      => 'success',
		'description' => LanguageController::trans( 'successfulDeactivation' )
	);
}

function ServiceNotice_clientarea( $vars ) {
	$ClientLabelEditPage = new ClientLabelEditPage();

	return $ClientLabelEditPage->getParam();
}
