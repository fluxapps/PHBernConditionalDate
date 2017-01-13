<?php
require_once("./Modules/DataCollection/classes/Fields/Datetime/class.ilDclDatetimeFieldModel.php");
require_once("./Modules/DataCollection/classes/Helpers/class.ilDclRecordQueryObject.php");

/**
 * Class ilPHBernConditionalDateFieldModel
 *
 * @author  Michael Herren <mh@studer-raimann.ch>
 * @version 1.0.0
 */
class ilPHBernConditionalDateFieldModel extends ilDclDatetimeFieldModel {

	const PROP_HIDE_ON = "phbe_cdate_hide_on";
	const PROP_HIDE_ON_FIELD = "f";
	const PROP_HIDE_ON_FIELD_VALUE = "v";

	/**
	 * @inheritDoc
	 */
	public function __construct($a_id = 0) {
		parent::__construct($a_id);

		$this->setStorageLocationOverride(3);
	}

	/**
	 * @inheritDoc
	 */
	public function getValidFieldProperties() {
		$props = array_merge(parent::getValidFieldProperties(), array(ilDclBaseFieldModel::PROP_PLUGIN_HOOK_NAME, self::PROP_HIDE_ON, self::PROP_HIDE_ON_FIELD, self::PROP_HIDE_ON_FIELD_VALUE));
		return $props;
	}


	/**
	 * Check validity
	 * @param      $value
	 * @param null $record_id
	 *
	 * @return bool
	 * @throws ilDclInputException
	 */
	public function checkValidity($value, $record_id = NULL) {
		global $ilUser;

		if($this->hasProperty(ilPHBernConditionalDateFieldModel::PROP_HIDE_ON_FIELD)) {

		}

		return true;
	}
}