<?php
/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 24.04.2019
 * Time: 21:22
 */

namespace WHMCS\Module\Addon\ServiceNotice\Pages;

use Smarty;
use WHMCS\Module\Addon\ServiceNotice\Configs\SmartyConfig;
use WHMCS\Module\Addon\ServiceNotice\Models\LabelModel;
use WHMCS\Module\Addon\ServiceNotice\Controllers\LanguageController;

class ClientLabelOutputProductPage {
	function renderToText( $service ) {
		$labelModel = LabelModel::find( $service->id );

		if ( ! $labelModel->display_service_info ) {
			return '';
		}

		$smarty = new Smarty;
		$smarty->setCompileDir( SmartyConfig::GetCompileDir() );
		$smarty->setTemplateDir( SmartyConfig::GetTemplateDir() );
		$smarty->assign( 'label', LabelModel::find( $service->id ) );
		$smarty->assign( 'translate', LanguageController::class );

		return $smarty->fetch( SmartyConfig::GetTemplateDir() . "ClientLabelOutputProduct.tpl" );
	}
}