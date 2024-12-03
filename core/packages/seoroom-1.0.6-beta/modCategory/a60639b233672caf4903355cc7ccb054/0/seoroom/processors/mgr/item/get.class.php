<?php

/**
 * Get an Item
 */
class SEOroomItemGetProcessor extends modObjectGetProcessor {
	public $objectType = 'modChunk';
	public $classKey = 'modChunk';
	public $languageTopics = array('seoroom:default');
	//public $permission = 'view';


	/**
	 * We doing special check of permission
	 * because of our objects is not an instances of modAccessibleObject
	 *
	 * @return mixed
	 */
	public function process() {
		if (!$this->checkPermissions()) {
			return $this->failure($this->modx->lexicon('access_denied'));
		}
        $this->object->set('name', str_replace('seo.counter.', '', $this->object->get('name')));
		return parent::process();
	}

}

return 'SEOroomItemGetProcessor';