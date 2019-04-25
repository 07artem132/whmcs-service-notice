<?php
/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 21.04.2019
 * Time: 16:41
 */

namespace WHMCS\Module\Addon\ServiceNotice\Pages;

use Smarty;
use WHMCS\Product\Product;
use WHMCS\Module\Addon\ServiceNotice\Configs\SmartyConfig;
use WHMCS\Module\Addon\ServiceNotice\Models\LabelModel;
use WHMCS\Module\Addon\ServiceNotice\Models\LabelAllowForProductModel;
use WHMCS\Module\Addon\ServiceNotice\Controllers\LanguageController;

class AdminLabelViewPage {
	/**
	 * @throws \SmartyException
	 */
	function render() {
		global $customadminpath;
		$smarty = new Smarty;
		$smarty->setCompileDir( SmartyConfig::GetCompileDir() );
		$smarty->setTemplateDir( SmartyConfig::GetTemplateDir() );
		$smarty->assign( 'labels', LabelModel::with( 'service.client' )->get() );
		$smarty->assign( 'LabelAllowForProduct', LabelAllowForProductModel::all()->pluck( 'pid' ) );
		$smarty->assign( 'productsGroupByGID', Product::join( 'tblproductgroups', 'tblproducts.gid', '=', 'tblproductgroups.id' )
		                                              ->orderBy( 'tblproductgroups.order', 'ASC' )
		                                              ->orderBy( 'tblproducts.order', 'ASC' )
		                                              ->orderBy( 'tblproducts.name', 'ASC' )
		                                              ->select( 'tblproducts.gid', 'tblproducts.id', 'tblproductgroups.name AS groupname', 'tblproducts.name AS productname' )
		                                              ->get()->groupBy( 'gid' ) );
		$smarty->assign( 'translate', LanguageController::class );
		$smarty->assign( 'adminPath', $customadminpath );
		$smarty->display( SmartyConfig::GetTemplateDir() . "AdminLabelView.tpl" );
	}
}