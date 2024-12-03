<?php

/**
 * Create an Item
 */
class SEOroomOfficeItemCreateProcessor extends modObjectCreateProcessor {
	public $objectType = 'SEOroomItem';
	public $classKey = 'SEOroomItem';
	public $languageTopics = array('seoroom');
	//public $permission = 'create';


	/**
	 * @return bool
	 */
	public function beforeSet() {
		$name = trim($this->getProperty('name'));
		if (empty($name)) {
			$this->modx->error->addField('name', $this->modx->lexicon('seoroom_item_err_name'));
		}
		elseif ($this->modx->getCount($this->classKey, array('name' => $name))) {
			$this->modx->error->addField('name', $this->modx->lexicon('seoroom_item_err_ae'));
		}

		return parent::beforeSet();
	}

}

return 'SEOroomOfficeItemCreateProcessor';