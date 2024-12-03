<?php

/**
 * Create an Item
 */
class SEOroomItemCreateProcessor extends modObjectCreateProcessor {

    public $objectType = 'modChunk';
    public $classKey = 'modChunk';
    public $languageTopics = array('seoroom');
    //public $permission = 'create';

    public $modx;
    private $category;

    function beforeSet(){

        $this->validateSEOCounterSave();
        $this->setSEOCategory();

        $this->setProperty('name', 'seo.counter.'.$this->getProperty('name'));

        return parent::beforeSet();

    }

    private function validateSEOCounterSave() {

        $name = trim($this->getProperty('name'));

        if(empty($name)){
            $this->modx->error->addField('name', $this->modx->lexicon('seoroom_item_err_name'));
        }
        elseif ($this->modx->getCount($this->classKey, array('name' => $name))) {
            $this->modx->error->addField('name', $this->modx->lexicon('seoroom_item_err_ae'));
        }

        if(preg_match('/[^a-zA-Z0-9_-]/', $name)){
            $this->modx->error->addField('name', 'Допустимые символы a-zA-Z0-9_-');
        }
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

    function afterSave(){

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

return 'SEOroomItemCreateProcessor';