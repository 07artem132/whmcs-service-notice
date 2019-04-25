<?php
/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 20.04.2019
 * Time: 19:09
 */

namespace WHMCS\Module\Addon\ServiceNotice\Models;


class LabelModel extends \WHMCS\Model\AbstractModel {
	protected $table = "mod_addon_service_notice";
	protected $booleans = [
		"display_service_list",
		"display_service_info"
	];
	protected $primaryKey = 'tblhosting_id';
	public $incrementing = false;
	protected $fillable = [
		'tblhosting_id',
		'label',
		'comment',
		'display_service_list',
		'display_service_info',
		'display_invoice_info',
	];

	public function service() {
		return $this->belongsTo( "WHMCS\\Service\\Service", "tblhosting_id" );
	}
}