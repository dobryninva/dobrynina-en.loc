<?php
/** @var modX $modx */
switch ($modx->event->name) {
  case 'pdoToolsOnFenomInit':
    /** @var Fenom $fenom
      Мы получаем переменную $fenom при его первой инициализации и можем вызывать его методы.
      Например, добавим модификатор вывода имени домена сайта из произвольной ссылки.
    */
    $fenom->addModifier('ignore', function($input) {
      return '{ignore}' . $input . '{/ignore}';
    });
    $fenom->addModifier('lighthouse', function($input) {
      if (stripos($_SERVER['HTTP_USER_AGENT'], 'Lighthouse') === false) {
        return $input;
      } else return;
    });
    // STRING
    $fenom->addModifier('num_format', function($input) {
      if(strlen($input)==0) return '';
      $input = floatval(str_replace(array(' ',','), array('','.'), $input));
      return number_format($input,(floor($input) == $input ? 0 : 2),'.',' ');
    });
    $fenom->addModifier('before', function($input, $options = '') {
      return !empty($options) ? $options.$input : $input;
    });
    $fenom->addModifier('after', function($input, $options = '') {
      return !empty($options) ? $input.$options : $input;
    });
    $fenom->addModifier('strrev', function($input) {
      return strrev($input);
    });
    $fenom->addModifier('explode', function ($input, $options = ',') {
      return array_map('trim', explode($options, $input));
    });
    $fenom->addModifier('bracket', function ($input) {
      return str_replace(['{','}'], ['{ ',' }'], $input);
    });
    $fenom->addModifier('time', function($input) {
      return time();
    });
    $fenom->addModifier('capitalize', function ($input) {
	  	return mb_strtoupper(mb_substr($input, 0, 1)) . mb_strtolower(mb_substr($input, 1, mb_strlen($input)));
		});
		$fenom->addModifier('lcfirst', function ($input) {
    	return mb_strtolower(mb_substr($input,0,1)) . mb_substr($input,1);
    });
    $fenom->addModifier('sklon', function ($input, $options) {
			$padezhi = ['im','rd','dt','vn','tv','pr','V_vn','v_vn','V_pr','v_pr'];
			if (in_array($options, $padezhi)) {
				$cities_file = MODX_BASE_PATH.'artmebius/cities.txt';
				if (file_exists($cities_file)) {
					$cities = file_get_contents($cities_file);
					$cities_arr = explode(PHP_EOL, $cities);
					$result = [];
					foreach ($cities_arr as $city) {
						$city_arr = explode('||', $city);
						for ($i=0; $i < count($city_arr); $i++) {
							$result[$city_arr[0]][$padezhi[$i]] = $city_arr[$i];
						}
					}
					if (isset($result[$input][$options])) {
						return $result[$input][$options];
					}
				}
			}
			return $input;
		});
    // ARRAY
    $fenom->addModifier('array_merge', function(...$input) {
      if (!empty($input)) {
        foreach ($input as $a => $arr) {
          if (!is_array($arr)) {
            $input[$a] = (array)$arr;
          }
        }
        $output = array_merge(...$input);
      } else {
        $output = array();
      }
      return $output;
    });
    $fenom->addModifier('array_keys', function($input) {
      return array_keys($input);
    });
    $fenom->addModifier('array_values', function($input) {
      return array_values($input);
    });
    $fenom->addModifier('array_reverse', function($input) {
      return array_reverse($input);
    });
    $fenom->addModifier('shuffle', function($input) {
      return shuffle($input);
    });
    // FORMAT
    $fenom->addModifier('ceil', function($input) {
      return ceil($input);
    });
    $fenom->addModifier('floor', function($input) {
      return floor($input);
    });
    $fenom->addModifier('round', function($input, $options = 0) {
      return round(floatval($input),intval($options));
    });
    $fenom->addModifier('mod', function($input, $options = 2) {
      return $input % $options;
    });
    // TYPES
    $fenom->addModifier('int', function($input) {
      $output = (int)$input;
      return $output;
    });

    #tags

    $fenom->addCompiler('exit', function() {
      return "return;";
    });

    break;
}