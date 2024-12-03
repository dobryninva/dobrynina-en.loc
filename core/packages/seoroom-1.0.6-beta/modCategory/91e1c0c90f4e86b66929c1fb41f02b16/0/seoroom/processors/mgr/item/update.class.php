<?php

/**
 * Update an Item
 */
class SEOroomItemUpdateProcessor extends modObjectUpdateProcessor {
	public $objectType = 'modChunk';
	public $classKey = 'modChunk';
	public $languageTopics = array('seoroom');
    public $category;
	//public $permission = 'save';


	/**
	 * We doing special check of permission
	 * because of our objects is not an instances of modAccessibleObject
	 *
	 * @return bool|string
	 */
	public function beforeSave() {
		if (!$this->checkPermissions()) {
			return $this->modx->lexicon('access_denied');
		}

		return true;
	}


	/**
	 * @return bool
	 */
	public function beforeSet() {

		$id = (int)$this->getProperty('id');
		$name = trim($this->getProperty('name'));

		if (empty($id)) {
			return $this->modx->lexicon('seoroom_item_err_ns');
		}

        if(preg_match('/[^a-zA-Z0-9_-]/', $name)){
            $this->modx->error->addField('name', 'Допустимые символы a-zA-Z0-9_-');
        }

        if (empty($name)) {
			$this->modx->error->addField('name', $this->modx->lexicon('seoroom_item_err_name'));
		}
		elseif ($this->modx->getCount($this->classKey, array('name' => $name, 'id:!=' => $id))) {
			$this->modx->error->addField('name', $this->modx->lexicon('seoroom_item_err_ae'));
		}

        $this->setProperty('name', 'seo.counter.'.$name);
        $this->setSEOCategory();

		return parent::beforeSet();

	}

    private function setSEOCategory(){

        $this->category = $this->modx->getObject('modCategory', array('category' => 'seo'));
        if(!$this->category){
            $this->category = $this->modx->newObject('modCategory');
            $this->category->set('category', 'seo');
            if(!$this->category->save()){
                $this->modx->error->addField('name', 'Невозможно создать категорию seo');
                return false;
            }
        }

        $this->setProperty('category', $this->category->get('id'));

        return true;

    }

    public function afterSave(){

        $query = $this->modx->newQuery('modChunk');
        $query->where(array('name:LIKE' => '%seo.counter.%'));
        $collection = $this->modx->getCollection('modChunk', $query);
        $content = '';
        foreach($collection as $chunk) $content .= $chunk->get('content');

        $seo_counters = $this->modx->getObject('modChunk', array(
            'category' => $this->category->get('id'),
            'name' => 'seo.counters'
        ));
        if(!$seo_counters){

            $seo_counters = $this->modx->newObject('modChunk');
            $seo_counters->set('name', 'seo.counters');
            $seo_counters->set('category', $this->category->get('id'));
            $seo_counters->set('content', $content);
            if(!$seo_counters->save()) $this->modx->error->addField('name', 'Невозможно создать общий чанк [[$seo.counters]]');

        }

        $seo_counters->set('content', $content);
        if(!$seo_counters->save()) $this->modx->error->addField('name', 'Невозможно изменить общий чанк [[$seo.counters]]');

        return parent::afterSave();

    }

}

return 'SEOroomItemUpdateProcessor';
