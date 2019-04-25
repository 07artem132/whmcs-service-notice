<?php
/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 20.04.2019
 * Time: 19:09
 */

namespace WHMCS\Module\Addon\ServiceNotice\Models;


class LabelAllowForProductModel extends \WHMCS\Model\AbstractModel {
	protected $table = "mod_addon_service_notice_allow_for_product";
	protected $primaryKey = 'pid';
	public $incrementing = false;
	protected $fillable = [
		'pid'
	];
}