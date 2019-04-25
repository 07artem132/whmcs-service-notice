<?php
/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 21.04.2019
 * Time: 16:41
 */

namespace WHMCS\Module\Addon\ServiceNotice\API;

use Smarty;
use WHMCS\Product\Product;
use WHMCS\Module\Addon\ServiceNotice\Traits\IsRequestMethodTraits;
use WHMCS\Module\Addon\ServiceNotice\Models\LabelModel;
use WHMCS\Module\Addon\ServiceNotice\Models\LabelAllowForProductModel;
use WHMCS\Module\Addon\ServiceNotice\Controllers\LanguageController;

class AdminAjaxApi {
	use IsRequestMethodTraits;

	function boot() {
		if ( ! $this->isRequestMethod( 'POST' ) ) {
			return;
		}

		switch ( true ) {
			case array_key_exists( 'tblhosting_id', $_POST ) && array_key_exists( 'display_service_info', $_POST ):
				$LabelModel                       = LabelModel::find( $_POST['tblhosting_id'] );
				$LabelModel->display_service_info = $_POST['display_service_info'];
				$LabelModel->save();
				$this->response( 'success', LanguageController::trans( 'apiSaveEdit' ) );
				break;
			case array_key_exists( 'tblhosting_id', $_POST ) && array_key_exists( 'display_service_list', $_POST ):
				$LabelModel                       = LabelModel::find( $_POST['tblhosting_id'] );
				$LabelModel->display_service_list = $_POST['display_service_list'];
				$LabelModel->save();
				$this->response( 'success', LanguageController::trans( 'apiSaveEdit' ) );
				break;
			case array_key_exists( 'tblhosting_id', $_POST ) && array_key_exists( 'label', $_POST ) && array_key_exists( 'comment', $_POST ) :
				$LabelModel          = LabelModel::find( $_POST['tblhosting_id'] );
				$LabelModel->label   = $_POST['label'];
				$LabelModel->comment = $_POST['comment'];
				$LabelModel->save();
				$this->response( 'success', LanguageController::trans( 'apiSaveEdit' ) );
				break;
			case array_key_exists( 'tblhosting_id', $_POST ) && array_key_exists( 'display_invoice_info', $_POST ):
				$LabelModel                       = LabelModel::find( $_POST['tblhosting_id'] );
				$LabelModel->display_invoice_info = $_POST['display_invoice_info'];
				$LabelModel->save();
				$this->response( 'success', LanguageController::trans( 'apiSaveEdit' ));
				break;
			case array_key_exists( 'tblhosting_id', $_POST ) && array_key_exists( 'delete', $_POST ):
				LabelModel::destroy( $_POST['tblhosting_id'] );
				$this->response( 'success', LanguageController::trans( 'apiSaveEdit' ) );
				break;
			case array_key_exists( 'pid', $_POST ) && array_key_exists( 'status', $_POST ):
				if ( $_POST['status'] ) {
					LabelAllowForProductModel::firstOrCreate( [ 'pid' => $_POST['pid'] ] );
				} else {
					LabelAllowForProductModel::destroy( $_POST['pid'] );
				}
				$this->response( 'success', LanguageController::trans( 'apiSaveEdit' ));
				break;
			case array_key_exists( 'gid', $_POST ) && array_key_exists( 'status', $_POST ):
				foreach ( Product::where( 'gid', $_POST['gid'] )->get()->pluck( 'id' ) as $pid ) {
					if ( $_POST['status'] ) {
						LabelAllowForProductModel::firstOrCreate( [ 'pid' => $pid ] );
					} else {
						LabelAllowForProductModel::destroy( $pid );
					}
				}
				$this->response( 'success', LanguageController::trans( 'apiSaveEdit' ) );
				break;
			default:
				$this->response( 'error', LanguageController::trans( 'apiUnknownAction' ) );
				break;
		}
	}

	function response( $status, $message = null ) {
		echo json_encode( [
			'status'  => $status,
			'message' => $message
		] );
		die();
	}
}