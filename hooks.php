<?php

use WHMCS\Module\Addon\ServiceNotice\Models\LabelAllowForProductModel;
use WHMCS\Module\Addon\ServiceNotice\Models\LabelModel;
use WHMCS\Module\Addon\ServiceNotice\Pages\ClientLabelOutputProductPage;
use WHMCS\Module\Addon\ServiceNotice\Controllers\LanguageController;
use WHMCS\Billing\Invoice;

LanguageController::init();

add_hook( 'ClientAreaPageProductsServices', 1, function ( $vars ) {
	$ids = [];

	for ( $i = 0; $i < count( $vars['services'] ); $i ++ ) {
		$ids[] = $vars['services'][ $i ]['id'];
	}

	$LabelModel = LabelModel::whereIn( 'tblhosting_id', $ids )->get();

	$ids = array_flip( $ids );

	foreach ( $LabelModel as $item ) {
		if ( ! $item->display_service_list ) {
			continue;
		}

		$vars['services'][ $ids[ $item->tblhosting_id ] ]['domain'] = $item->label;
	}

	return [
		'services' => $vars['services']
	];
} );

add_hook( 'ClientAreaPrimarySidebar', 1, function ( $primarySidebar ) {
	if ( is_null( $primarySidebar->getChild( 'Service Details Actions' ) ) ) {
		return;
	}

	$service = Menu::context( 'service' );

	if ( $service->domainStatus !== "Active" ) {
		return;
	}

	if ( empty( LabelAllowForProductModel::find( $service->packageid ) ) ) {
		return;
	}

	$primarySidebar->getChild( 'Service Details Actions' )->addChild( 'LabelEdit', [
		'label' => LanguageController::trans( 'ChangeLabel' ),
		'uri'   => '/?m=ServiceNotice&sid=' . base64_encode(encrypt((string)$service->id )),
		'order' => '99'
	] )->setClass( ( array_key_exists( 'm', $_GET ) && $_GET['m'] === 'ServiceNotice' ? 'active' : '' ) );
} );

add_hook( 'ClientAreaProductDetailsOutput', 1, function ( $service ) {
	$ClientLabelOutputProduct = new ClientLabelOutputProductPage();

	return $ClientLabelOutputProduct->renderToText( $service['service'] );
} );

add_hook( 'InvoiceCreationPreEmail', 1, function ( $vars ) {
	try {
		$invoice = Invoice::find( $vars['invoiceid'] );
		foreach ( $invoice->items()->get() as $item ) {
			if ( empty( $item->relid ) ) {
				continue;
			}


			if ( empty( $LabelModel = LabelModel::find( $item->relid ) ) ) {
				continue;
			}

			if ( ! $LabelModel->display_invoice_info ) {
				continue;
			}

			$item->description .= PHP_EOL . LanguageController::trans( 'Label' ) . ': ' . $LabelModel->label;
			$item->save();
		}
	} catch ( \Exception $e ) {

	}
} );

add_hook('ServiceDelete', 1, function($vars) {
    LabelModel::find( $vars['serviceid'] )->delete();
});
