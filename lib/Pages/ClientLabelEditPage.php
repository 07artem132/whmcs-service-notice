<?php
/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 21.04.2019
 * Time: 16:41
 */

namespace WHMCS\Module\Addon\ServiceNotice\Pages;


use WHMCS\Module\Addon\ServiceNotice\Models\LabelModel;
use WHMCS\Module\Addon\ServiceNotice\Traits\IsRequestMethodTraits;
use WHMCS\Module\Addon\ServiceNotice\Controllers\LanguageController;

class ClientLabelEditPage {
	use IsRequestMethodTraits;

	function getParam() {
		global $whmcs;

		if ( ! array_key_exists( 'sid', $_GET ) || ! is_int( (int) $_GET['sid'] ) ) {
			return [];
		}

		$tblhosting_id = $_GET['sid'];

		if ( $this->isRequestMethod( 'POST' ) ) {
			$LabelModel                       = LabelModel::find( $tblhosting_id );
			$LabelModel->label                = $_POST['label'];
			$LabelModel->comment              = $_POST['comment'];
			$LabelModel->display_service_list = empty( $_POST['display_service_list'] ) ? 0 : 1;
			$LabelModel->display_service_info = empty( $_POST['display_service_info'] ) ? 0 : 1;
			$LabelModel->display_invoice_info = empty( $_POST['display_invoice_info'] ) ? 0 : 1;
			$LabelModel->save();
			redir( "action=productdetails&id=" . $tblhosting_id, "clientarea.php" );
			die();
		}


		$LabelModel = LabelModel::firstOrCreate( [
			'tblhosting_id' => $tblhosting_id
		], [
			'label'                => '',
			'comment'              => '',
			'display_service_list' => 0,
			'display_service_info' => 0,
			'display_invoice_info' => 0
		] );

		$label                = $LabelModel->label;
		$comment              = $LabelModel->comment;
		$display_service_list = $LabelModel->display_service_list;
		$display_service_info = $LabelModel->display_service_info;
		$display_invoice_info = $LabelModel->display_invoice_info;
		\Menu::addContext( "service", $LabelModel->service()->first() );
		\Menu::primarySidebar( 'serviceView' );
		\Menu::secondarySidebar( 'serviceView' );


		return array(
			'pagetitle'    => LanguageController::trans( 'ClientLabelEditPageTitle' ),
			'breadcrumb'   => array(
				'clientarea.php'                 => $whmcs->get_lang( "clientareatitle" ),
				'clientarea.php?action=products' => $whmcs->get_lang( "clientareaproducts" ),
				'index.php?m=ServiceNotice'      => LanguageController::trans( 'ClientLabelEditPageTitle' )
			),
			'templatefile' => 'ClientEditLabel.tpl',
			'requirelogin' => true,
			'vars'         => array(
				'label'                => $label,
				'comment'              => $comment,
				'display_service_list' => $display_service_list,
				'display_service_info' => $display_service_info,
				'display_invoice_info' => $display_invoice_info,
				'translate'            => LanguageController::class,
				'tblhosting_id'        => $_GET['sid']
			),
		);
	}

}