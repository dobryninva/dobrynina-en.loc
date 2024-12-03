<?php
/** @var array $scriptProperties */
/** @var Comparison $Comparison */
if (!function_exists('dd')){
  function dd($var){
    print '<pre>';
    print_r($var);
    print '</pre>';
  }
}

// @dd lexicon & fields_default & vendor_dictionary
$modx->lexicon->load('minishop2:default');
$fields_default = array('id','type','contentType','pagetitle','longtitle','description','alias','alias_visible','link_attributes','published','pub_date','unpub_date','parent','isfolder','introtext','richtext','template','menuindex','searchable','cacheable','createdby','createdon','editedby','editedon','deleted','deletedon','deletedby','publishedon','publishedby','menutitle','donthit','privateweb','privatemgr','content_dispo','hidemenu','class_key','context_key','content_type','uri','uri_override','hide_children_in_tree','show_in_tree','properties');
$vendor_dictionary = array('name'=>'Производитель','resource'=>'id ресурса','country'=>'Страна','logo'=>'Логотип','address'=>'Адрес','phone'=>'Телефон','fax'=>'Факс','email'=>'Емайл','description'=>'Описание','properties'=>'Свойства');

$Comparison = $modx->getService('comparison','Comparison',$modx->getOption('comparison_core_path',null,$modx->getOption('core_path').'components/comparison/').'model/comparison/',$scriptProperties);
if (!($Comparison instanceof Comparison)) return '';
$Comparison->initialize($modx->context->key);
/** @var pdoFetch $pdoFetch */
$pdoFetch = $modx->getService('pdoFetch');
$pdoFetch->setConfig($scriptProperties);

$list = !empty($_REQUEST['list'])
  ? (string) $_REQUEST['list']
  : 'default';

if (isset($_SESSION['Comparison'][$modx->context->key][$list]['ids'])) {
  $ids = array_keys($_SESSION['Comparison'][$modx->context->key][$list]['ids']);
}
elseif (!empty($_REQUEST['cmp_ids'])) {
  $ids = explode(',', preg_replace('/[^0-9\,]/', '', $_REQUEST['cmp_ids']));
}
else {
  return $modx->lexicon('comparison_err_no_list');
}

if (empty($fields)) {$fields = '{"default":["data.price","data.article","vendor.name","data.color","data.size"]}';}
if (empty($tplRow)) {$tplRow = 'tpl.Comparison.row';}
if (empty($tplParam)) {$tplParam = 'tpl.Comparison.param';}
if (empty($tplCell)) {$tplCell = 'tpl.Comparison.cell';}
if (empty($tplHead)) {$tplHead = 'tpl.Comparison.head';}
if (empty($tplCorner)) {$tplCorner = 'tpl.Comparison.corner';}
if (empty($tplOuter)) {$tplOuter = 'tpl.Comparison.outer';}
if (empty($minItems)) {$minItems = 1;}
if (empty($maxItems)) {$maxItems = 10;}
if (!isset($scriptProperties['showUnpublished'])) {$scriptProperties['showUnpublished'] = false;}
if (!isset($scriptProperties['showDeleted'])) {$scriptProperties['showDeleted'] = false;}
$fields = $modx->fromJSON($fields);
if (empty($fields) || !is_array($fields)) {
  return $modx->lexicon('comparison_err_wrong_fields');
}
elseif (!isset($fields[$list])) {
  if ($modx->user->isAuthenticated('mgr')) {
    return $modx->lexicon('comparison_err_wrong_list', array('list' => $list));
  }
  else {
    return $modx->lexicon('comparison_err_no_list');
  }
}
$fields = $fields[$list];

$format = null;
if (!empty($formatSnippet)) {
  /** @var modSnippet $format */
  $format = $modx->getObject('modSnippet', array('name' => $formatSnippet));
}

// Joining MS2 tables
if (in_array('msProduct', $modx->classMap['modResource'])) {
  $class = 'msProduct';
  $leftJoin = array(
    'Data' => array('class' => 'msProductData'),
    'Vendor' => array('class' => 'msVendor', 'on' => 'Vendor.id = Data.vendor'),
  );

  $select = array(
    $class => !empty($includeContent) ?  $modx->getSelectColumns($class, $class) : $modx->getSelectColumns($class, $class, '', array('content'), true),
    'Data' => $modx->getSelectColumns('msProductData', 'Data', 'data.', array('id'), true),
    'Vendor' => $modx->getSelectColumns('msVendor', 'Vendor', 'vendor.', array('id'), true),
  );

  $thumbsSelect = array();
  if (!empty($includeThumbs)) {
    $thumbs = array_map('trim',explode(',',$includeThumbs));
    if(!empty($thumbs[0])){
      foreach ($thumbs as $thumb) {
        $leftJoin[$thumb] = array(
          'class' => 'msProductFile',
          'on' => "`$thumb`.`product_id` = `{$class}`.`id` AND `$thumb`.`parent` != 0 AND `$thumb`.`path` LIKE '%/$thumb/'"
        );
        $select[$thumb] = "`$thumb`.`url` as `$thumb`";
      }
    }
  }
}
else {
  $class = 'modResource';
  $leftJoin = $select = array();
}
// dd($select);
// Add custom parameters
foreach (array('leftJoin','select') as $v) {
  if (!empty($scriptProperties[$v])) {
    $tmp = $modx->fromJSON($scriptProperties[$v]);
    if (is_array($tmp)) {
      $$v = array_merge($$v, $tmp);
    }
  }
  unset($scriptProperties[$v]);
}
$properties = array(
  'class' => $class,
  'parents' => 0,
  'resources' => implode(',', $ids),
  'includeTVs' => implode(',', $fields),
  'leftJoin' => $leftJoin,
  'select' => $select,
  'groupby' => $class . '.id',
  'limit' => $maxItems,
  'return' => 'data',
  'nestedChunkPrefix' => 'comparison_'
);
$pdoFetch->setConfig(array_merge($scriptProperties, $properties), false);
$resources = $pdoFetch->run();

$output = $rows = '';
if (count($ids) < $minItems) {
  $output = $modx->lexicon('comparison_err_min_count');
}
elseif (count($ids) > $maxItems) {
  $output = $modx->lexicon('comparison_err_max_resource');
}
else {

// dd($resources);
// dd($fields);

  $row_idx = 1;
  foreach ($fields as $field) {

    // @dd field_caption & measure_unit & type
    $field_caption = $field_measure_unit = $field_type = '';
    $field_arr = array();
    if (stripos($field, 'option.') === 0) {
      $tmp_field = substr($field, 7);
      $q = $modx->newQuery('msOption');
      $q->select('caption,measure_unit,type');
      $q->where(array(
        'key' => $tmp_field,
      ));
      $q->prepare();
      if($q->stmt && $q->stmt->execute()){
        $field_arr = $q->stmt->fetch(PDO::FETCH_ASSOC);
      }
      $field_caption = $field_arr['caption'];
      $field_type = $field_arr['type'];
      if (!empty($field_arr['measure_unit'])) $field_measure_unit = $field_arr['measure_unit'];
    }
    elseif (stripos($field, 'data.') === 0) {
      $tmp_field = substr($field, 5);
      $field_caption = $modx->lexicon('comparison_field_'.$tmp_field);
    }
    elseif (stripos($field, 'vendor.') === 0) {
      $tmp_field = substr($field, 7);
      $field_caption = $vendor_dictionary[$tmp_field];
    }
    elseif (!in_array($field, $fields_default)) {
      // tv
      $q = $modx->newQuery('modTemplateVar');
      $q->select('caption');
      $q->where(array(
        'name' => $field,
      ));
      $q->prepare();
      if($q->stmt && $q->stmt->execute()){
        $field_caption = $q->stmt->fetchColumn();
      }
    } else {
      $field_caption = $modx->lexicon('comparison_field_'.$field);
    }

    // @dd row_idx in $cells
    $cells = $pdoFetch->getChunk($tplParam, array('row_idx' => $row_idx,'field' => $field,'param' => $field_caption));
    $cell_idx = 1;
    $previous_value = null;
    $same = true;
    $empty_row = true; // @dd

    foreach ($resources as $resource) {
      $value = '';
      if (array_key_exists($field, $resource)) {
        $value = $resource[$field]; // стандартные поля ресурса + ТВшки
      }
      elseif (stripos($field, 'option.') === 0) {
        $tmp_field = substr($field, 7);
        $values = $pdoFetch->getCollection(
          'msProductOption',
          array('key' => $tmp_field, 'product_id' => $resource['id']),
          array('select' => 'value', 'sortby' => 'value')
        );
        if (!empty($values)) {
          if (count($values) > 1) {
            $value = array();
            foreach ($values as $tmp) {
              $value[] = $tmp['value'];
            }
          }
          else {
            $value = $values[0]['value'];
          }
        }
        $pdoFetch->addTime('Get product option "' . $tmp_field . '" for product "' . $resource['id'] . '"');
      }
      // Send value to special snippet
      if ($format) {
        $format->_cacheable = false;
        $format->_processed = false;
        $format->_content = '';
        $value = $format->process(array(
          'name' => $field,
          'field' => $field,
          'input' => $value,
          'value' => $value,
          'resource' => $resource,
          'pdoTools' => $pdoFetch,
          'pdoFetch' => $pdoFetch,
        ));
      }
      else {
        if (is_array($value)) {
          natsort($value);
          $value = implode(', ', $value);
        }
        if ($class == 'msProduct' && in_array($field, array('price','data.price', 'old_price','data.old_price', 'weight','data.weight'))) {
          /** @var miniShop2 $miniShop2 */
          if ($miniShop2 = $modx->getService('miniShop2')) {
            switch ($field) {
              case 'price':
              case 'data.price':
                if (file_exists(MODX_CORE_PATH . 'components/msdiscount/')) {
                    /** @var msDiscount $msDiscount */
                    $msDiscount = $modx->getService('msDiscount');
                    $value = $msDiscount->getNewPrice($resource, $value);
                } else {
                    $value = $miniShop2->formatPrice($value) . ' ' . $modx->lexicon('ms2_frontend_currency');
                }
                break;
              case 'old_price':
              case 'data.old_price':
                $value = $miniShop2->formatPrice($value) . ' ' . $modx->lexicon('ms2_frontend_currency');
                break;
              case 'weight':
              case 'data.weight':
                $value = $miniShop2->formatWeight($value) . ' ' . $modx->lexicon('ms2_frontend_weight_unit');
                break;
            }
          }
        }
      }

      if ($same && $cell_idx > 1) {
        $same = $previous_value == $value;
      }
      // @add check row with empty values
      if ($empty_row && !empty($value)) {
        $empty_row = false;
      }
      // @dd measure_unit & type in $cells
      $cells .= $pdoFetch->getChunk($tplCell, array('value' => $value, 'measure_unit'=>$field_measure_unit, 'type'=>$field_type, 'cell_idx' => $cell_idx ++, 'classes' => ' field-'.$field));
      $previous_value = $value;

    } // end foreach ($resources as $resource)

    if (!$empty_row) {
      $rows .= $pdoFetch->getChunk($tplRow, array('cells' => $cells, 'row_idx' => $row_idx++, 'same' => $same));
    }

  } // end foreach ($fields as $field)

  $cells = $pdoFetch->getChunk($tplCorner);
  foreach ($resources as $resource) {
    $resource['list'] = $list;
    $cells .= $pdoFetch->getChunk($tplHead, $resource);
  }
  $head = $pdoFetch->getChunk($tplRow, array('cells' => $cells, 'list' => $list));

  $output = $pdoFetch->getChunk($tplOuter, array('head' => $head, 'rows' => $rows));
}

if ($modx->user->hasSessionContext('mgr') && !empty($showLog)) {
  $output .= '<pre class="CompareListLog">' . print_r($pdoFetch->getTime(),1) . '</pre>';
}

$modx->regClientScript('<script type="text/javascript">Comparison.list.initialize(".comparison-table", {minItems:'.$minItems.'});</script>', true);
return $output;