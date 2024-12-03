<?php

/**
 * Remove an Items
 */
class SEOroomOfficeItemRemoveProcessor extends modObjectProcessor {
	public $objectType = 'SEOroomItem';
	public $classKey = 'SEOroomItem';
	public $languageTopics = array('seoroom');
	//public $permission = 'remove';


	/**
	 * @return array|string
	 */
	public function process() {
		if (!$this->checkPermissions()) {
			return $this->failure($this->modx->lexicon('access_denied'));
		}

		$ids = $this->modx->fromJSON($this->getProperty('ids'));
		if (empty($ids)) {
			return $this->failure($this->modx->lexicon('seoroom_item_err_ns'));
		}

		foreach ($ids as $id) {
			/** @var SEOroomItem $object */
			if (!$object = $this->modx->getObject($this->classKey, $id)) {
				return $this->failure($this->modx->lexicon('seoroom_item_err_nf'));
			}

			$object->remove();
		}

		return $this->success();
	}

}

return 'SEOroomOfficeItemRemoveProcessor';