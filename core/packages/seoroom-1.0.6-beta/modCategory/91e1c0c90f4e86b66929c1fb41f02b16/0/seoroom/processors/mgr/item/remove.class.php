<?php

/**
 * Remove an Items
 */
class SEOroomItemRemoveProcessor extends modObjectProcessor {
	public $objectType = 'modChunk';
	public $classKey = 'modChunk';
	public $languageTopics = array('seoroom');
    public $category;
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

        $this->setSEOCategory();
        $this->SEOCounter();

		return $this->success();
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

    private function SEOCounter(){

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

        return true;

    }

}

return 'SEOroomItemRemoveProcessor';