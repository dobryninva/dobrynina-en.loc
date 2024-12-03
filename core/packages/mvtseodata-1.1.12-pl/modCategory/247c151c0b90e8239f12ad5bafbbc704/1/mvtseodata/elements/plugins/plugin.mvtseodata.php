<?php
if ($mvtSeoData = $modx->getService('mvtseodata', 'mvtSeoData', $modx->getOption('mvtseodata_core_path', null,
        $modx->getOption('core_path') . 'components/mvtseodata/') . 'model/mvtseodata/', array())
    ) {
                      
    switch ($modx->event->name) {
		
					
		/*
		* Можно подменять штатные или добавлять нужные плейсхолдеры  "на лету"	
		* Но помните о кэше: системный кэш обновляется при первом запросе страницы.
		* Если обязательно уже при первом запросе страницы нужны данные из модуля (например для "скармливания" поисковику), 
		*    используйте сниппет mvtSeoData: {set $seoData = '!mvtSeoData' | snippet} , $seoData содержит данные из модуля.
		*/
    	case 'OnLoadWebDocument': 
			$seoData = $mvtSeoData->Run($modx->resource);
			if(is_array($seoData)) {
				foreach($seoData as $k => $v) {	
					if($k == 'content') {
					    $modx->resource->set($k, $v);
					}
					else {
					    if(!empty($v)) {
						    $modx->resource->set($k, $v); 
					    }
					}
				}
			}
			break;
		
			

		/*
		* Получает данные товара при индексировании. 
		*/
		case 'mvtSeoDataIndexOnReceivingProductData':
			/*if(!empty($product)) {
				$data = [];
				# перевод в граммы - это заменит значение веса
				$data['weight'] = $product->get('weight') * 1000;
				
				# изменение цены - это заменит значение цены
				$data['price'] = $product->get('price') + 10;
			}
			*/
			if(!empty($data)) {
				$modx->event->output($data);
			}
			break;
		
			
			
		/*
		* Получает категорию при индексировании. 
		* $category - объект ресурса, $products - массив собранных товаров данной категории
		*/
		case 'mvtSeoDataIndexOnReceivingCategoryData':
			$modx->event->output([
				'products' => $products
			]);
			break;
    }
    
}