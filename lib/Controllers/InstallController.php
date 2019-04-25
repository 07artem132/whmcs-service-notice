<?php
/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 24.04.2019
 * Time: 20:23
 */

namespace WHMCS\Module\Addon\ServiceNotice\Controllers;

use \WHMCS\Database\Capsule;

class InstallController {
public static 	function createTableServiceNotice() {
		try {
			if ( ! Capsule::schema()->hasTable( 'mod_addon_service_notice' ) ) {
				Capsule::schema()->create( 'mod_addon_service_notice', function ( $table ) {
					/** @var \Illuminate\Database\Schema\Blueprint $table */
					$table->unsignedInteger( 'tblhosting_id' )->unique();
					$table->text( 'label' );
					$table->text( 'comment' );
					$table->boolean( 'display_service_list' );
					$table->boolean( 'display_service_info' );
					$table->boolean( 'display_invoice_info' );
					$table->timestamps();
				} );
			}
		} catch ( \Exception $e ) {
			return array(
				'status'      => 'error',
				'description' => sprintf( LanguageController::trans( 'errorCreateTable' ), 'mod_addon_service_notice', $e->getMessage() )
			);
		}

		return [];
	}

	public static	function createTableServiceNoticeAllowForProduct() {
		try {
			if ( ! Capsule::schema()->hasTable( 'mod_addon_service_notice_allow_for_product' ) ) {
				Capsule::schema()->create( 'mod_addon_service_notice_allow_for_product', function ( $table ) {
					/** @var \Illuminate\Database\Schema\Blueprint $table */
					$table->unsignedInteger( 'pid' )->unique();
					$table->timestamps();
				} );
			}
		} catch ( \Exception $e ) {
			return array(
				'status'      => 'error',
				'description' => sprintf( LanguageController::trans( 'errorCreateTable' ), 'mod_addon_service_notice_allow_for_product', $e->getMessage() )
			);
		}
		return [];

	}
}