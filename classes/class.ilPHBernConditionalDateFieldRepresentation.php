<?php
require_once('./Modules/DataCollection/classes/Fields/Datetime/class.ilDclDatetimeFieldRepresentation.php');
require_once('./Modules/DataCollection/classes/Fields/Datetime/class.ilDclDatetimeFieldModel.php');
require_once('./Customizing/global/plugins/Services/Cron/CronHook/DclContentImporter/classes/Helper/class.srDclContentImporterMultiLineInputGUI.php');
require_once('./Customizing/global/plugins/Services/Cron/CronHook/DclContentImporter/classes/class.ilDclContentImporterPlugin.php');

/**
 * Class ilPHBernConditionalDateFieldRepresentation
 *
 * @author  Michael Herren <mh@studer-raimann.ch>
 * @version 1.0.0
 */
class ilPHBernConditionalDateFieldRepresentation extends ilDclDatetimeFieldRepresentation {
	protected $pl;


	/**
	 * ilPHBernConditionalDateFieldRepresentation constructor.
	 *
	 * @param ilDclBaseFieldModel $field
	 */
	public function __construct(ilDclBaseFieldModel $field) {
		$this->pl = ilPHBernConditionalDatePlugin::getInstance();

		parent::__construct($field);
	}


	/**
	 * @param ilPropertyFormGUI $form
	 * @param int               $record_id
	 *
	 * @return ilMultiSelectInputGUI|ilSelectInputGUI|null
	 */
	public function getInputField(ilPropertyFormGUI $form, $record_id = 0) {
		global $tpl;
		$input = parent::getInputField($form, $record_id);

		if($this->field->hasProperty(ilPHBernConditionalDateFieldModel::PROP_HIDE_ON)) {
			$field_value_pairs = $this->field->getProperty(ilPHBernConditionalDateFieldModel::PROP_HIDE_ON);
			$or = '';
			$condition = '';
			foreach ($field_value_pairs as $array) {
				$field_id = $array[ilPHBernConditionalDateFieldModel::PROP_HIDE_ON_FIELD];
				$field_value = $array[ilPHBernConditionalDateFieldModel::PROP_HIDE_ON_FIELD_VALUE];

				$condition .= $or . '$("#field_'.$field_id.'").val() == "'.$field_value.'"';
				$or = ' || ';
				if(isset($_POST['field_'.$field_id]) && $_POST['field_'.$field_id] == $field_value) {
					$input->setRequired(false);
				}
			}

			if ($condition) {
				$script = '$("#field_'.$field_id.'")
				.change(function () {
					if('.$condition.') {
						$("#field_'.$this->field->getId().'").val("");
						$("#il_prop_cont_field_'.$this->field->getId().'").hide();
					} else {
						$("#il_prop_cont_field_'.$this->field->getId().'").show();
					}
				})
				.change();';

				$tpl->addOnLoadCode($script);

			}

		}



		return $input;
	}


	/**
	 * @inheritDoc
	 */
	public function buildFieldCreationInput(ilObjDataCollection $dcl, $mode = 'create') {
		$opt = parent::buildFieldCreationInput($dcl, $mode);

		$multiinput = new srDclContentImporterMultiLineInputGUI($this->pl->txt('hide_on_field'), $this->getPropertyInputFieldId(ilPHBernConditionalDateFieldModel::PROP_HIDE_ON));
		$multiinput->setInfo("Field & Field-Value");
		$multiinput->setTemplateDir(ilDclContentImporterPlugin::getInstance()->getDirectory());

		$input = new ilSelectInputGUI($this->pl->txt('hide_on_field'),ilPHBernConditionalDateFieldModel::PROP_HIDE_ON_FIELD);

		$fields = ilDclCache::getTableCache($this->field->getTableId())->getFields();
		$options = array(''=>'');
		foreach($fields as $field) {
			$options[$field->getId()] = $field->getTitle();
		}
		$input->setOptions($options);
		$multiinput->addInput($input);

		$input = new ilTextInputGUI('Datacollection Ref-ID', ilPHBernConditionalDateFieldModel::PROP_HIDE_ON_FIELD_VALUE);
		$multiinput->addInput($input);

		$opt->addSubItem($multiinput);
		return $opt;
	}
}