<?php

/**
 * Get a list of Items
 */
class SEOroomItemGetListProcessor extends modObjectGetListProcessor {
	public $objectType = 'modChunk';
	public $classKey = 'modChunk';
	public $defaultSortField = 'id';
	public $defaultSortDirection = 'DESC';
	//public $permission = 'list';


	/**
	 * * We doing special check of permission
	 * because of our objects is not an instances of modAccessibleObject
	 *
	 * @return boolean|string
	 */
	public function beforeQuery() {
		if (!$this->checkPermissions()) {
			return $this->modx->lexicon('access_denied');
		}

		return parent::beforeQuery();
	}


	/**
	 * @param xPDOQuery $c
	 *
	 * @return xPDOQuery
	 */
	public function prepareQueryBeforeCount(xPDOQuery $c) {

		$query = trim($this->getProperty('query'));
        $query = ($query) ? '%seo.counter.'.$query.'%' : '%seo.counter.%';
        $c->where(array('name:LIKE' => $query));
        return $c;

    }


	/**
	 * @param xPDOObject $object
	 *
	 * @return array
	 */
	public function prepareRow(xPDOObject $object) {
		$array = $object->toArray();
		$array['actions'] = array();

        //Name
        $array['name'] = str_replace('seo.counter.', '', $array['name']);

		// Edit
		$array['actions'][] = array(
			'cls' => '',
			'icon' => 'icon icon-edit',
			'title' => $this->modx->lexicon('seoroom_item_update'),
			//'multiple' => $this->modx->lexicon('seoroom_items_update'),
			'action' => 'updateItem',
			'button' => true,
			'menu' => true,
		);

		// Remove
		$array['actions'][] = array(
			'cls' => '',
			'icon' => 'icon icon-trash-o action-red',
			'title' => $this->modx->lexicon('seoroom_item_remove'),
			'multiple' => $this->modx->lexicon('seoroom_items_remove'),
			'action' => 'removeItem',
			'button' => true,
			'menu' => true,
		);

		return $array;
	}

}

return 'SEOroomItemGetListProcessor';