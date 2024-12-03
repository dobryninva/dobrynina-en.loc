<?php
if (!function_exists('dd')){
  function dd($var){
    print '<pre>';
    print_r($var);
    print '</pre>';
    print '<hr>';
  }
}
if (!function_exists('memory_usage')){
	function memory_usage($usage, $base_memory_usage, $text = 'used') {
		$mb = round(($usage - $base_memory_usage)/1024/1024, 4);
		print "{$text}: {$mb} Mb <br>\n";
		// printf("{$text}: %d Mb <br>\n", round(($usage - $base_memory_usage)/1024/1024, 4));
		return;
	}
}
if (!function_exists('size_of_var')){
	function size_of_var($var) {
	  $start_memory = memory_get_usage();
	  $tmp = unserialize(serialize($var));
	  $mb = round((memory_get_usage() - $start_memory)/1024/1024, 4);
	  print "var size: {$mb} Mb<br> \n";
	  return;
	}
}

class Functions {

  public $modx;
  public $pdoTools;

  public $site_name = '';
  public $site_url = '';

  public $cache_dir = 'funs'; // folder/sub_folder
	public $cache_path = '';

  public function __construct(modX &$modx)
  {
    $this->modx = &$modx;
    $this->pdoTools = $modx->getService('pdoTools');

    $this->cli = (defined('PHP_SAPI') && (PHP_SAPI == "cli")) ? 1 : 0;
    $this->br = $this->cli ? "\n" : "<br>";

    $site_url = $this->modx->getOption('site_url');
    $this->site_url = $this->cli ? (strpos($site_url, 'https') === false ? str_replace('http', 'https', $site_url) : $site_url ) : $site_url;
		$this->site_name = $this->modx->getOption('site_name');

    $this->cache_path = MODX_BASE_PATH.'artmebius/snippets/cache/'.$this->cache_dir;
		if (file_exists($this->cache_path) === false) {
	  	mkdir($this->cache_path, 0755, true);
  	}

    return;
  }


  // #tools

  public function print_time($timer, $title = 'прошло')
  {
    print $title . ': ' . round(microtime(true) - $timer, 4) . ' сек. <br>';

    return;
  }


  public function log($value, $text = '', $append = 1)
  {
		$log_path = MODX_ASSETS_PATH . 'logs/temp.log';
		$log_str = (!empty($text)) ? $text.": \n" : "";
  	$log_str .= print_r($value, true) . "\n\n";
  	if ($append) {
			file_put_contents($log_path, $log_str, FILE_APPEND | LOCK_EX);
  	} else {
			file_put_contents($log_path, $log_str, LOCK_EX);
  	}
  }

  public function br($repeat = 1)
  {
  	print str_repeat($this->br, $repeat);
  	return;
  }

  public function cache_check($id)
  {
  	return file_exists($this->cache_path.'/'.$id.'.json');
  }

  public function cache_set($output, $id)
  {
  	if (is_array($output)) {
  		$output = json_encode($output);
  	} else {
  		$output = json_encode(['cache_value'=>$output]);
  	}
  	$file = $this->cache_path.'/'.$id.'.json';

  	return file_put_contents($file, $output, LOCK_EX);
  }

  public function cache_get($id)
  {
		$file = $this->cache_path.'/'.$id.'.json';
		$data = file_get_contents($file);
		if ($data !== false) {
			$data = json_decode($data, 1);
			if (count($data) == 1 && !empty($data['cache_value'])) {
				return $data['cache_value'];
			}
		}
		return $data;
  }


  public function set_arr_key($arr, $key)
  {
    return array_column($arr, null, $key);
  }


  public function save_image($img, $path)
  {
    $ch = curl_init($img);
    $options = array(
      CURLOPT_HEADER => 0,
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_BINARYTRANSFER => 1,
      CURLOPT_FAILONERROR => 1
    );
    curl_setopt_array($ch, $options);
    $file = curl_exec($ch);

    if (!curl_errno($ch)) {
      // $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); // check 200 || CURLOPT_FAILONERROR => 1

      if (file_exists($path)) unlink($path);
      $fp = fopen($path,'x');
      fwrite($fp, $file);
      fclose($fp);

    } else {
      $this->modx->log(1, 'Не удалось сохранить картинку: <br>' . $img . '<br>' . curl_error($ch));
    }

    curl_close($ch);
    return;
  }


  public function check_file($url)
  {
    $check = 1;
    $ch = curl_init($url);
    $options = array(
      // CURLOPT_POST => 1,
      CURLOPT_HEADER => 0,
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_BINARYTRANSFER => 1,
      CURLOPT_FAILONERROR => 1
    );
    curl_setopt_array($ch, $options);
    $file = curl_exec($ch);
    if (!curl_errno($ch)) {
      $check = 1;
    } else {
      $check = 0;
    }
    curl_close($ch);
    return $check;
  }


  public function clear_dir($dir, $self = 0)
  {
    $dir_list = array_diff(scandir($dir), array('..', '.'));

    foreach ($dir_list as $file){
      if (is_dir($dir.$file)){
        $this->clear_dir($dir.$file.'/');
        rmdir($dir.$file);
      } else {
        unlink($dir.$file);
      }
    }

    if ($self) rmdir($dir);

    return;
  }


  public function rawurlencode_re($string)
  {
    $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
    $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
    return str_replace($entities, $replacements, rawurlencode($string));
  }



  // #modx

  public function refresh_cache()
  {
    $this->modx->cacheManager->refresh();
  }

  public function db_select($table, $select, $where = array(), $fetch = 'assoc')
  {
    if (empty($table) || empty($select)) return false;

    $q = $this->modx->newQuery($table);
    $q->select($select);
    if (!empty($where)) {
      $q->where($where);
    }
    $q->prepare();
    if($q->stmt && $q->stmt->execute()){
      switch ($fetch) {
        case 'column':
          return $q->stmt->fetch(PDO::FETCH_COLUMN);
          break;

        case 'assoc':
        default:
          return $q->stmt->fetch(PDO::FETCH_ASSOC);
          break;
      }
    } else {
      $this->modx->log(1, print_r($q->stmt->errorInfo(), true) . ' SQL: <br>' . $q->toSQL());
    }
    $q->stmt->closeCursor();

    return;
  }


  public function db_select_all($table, $select, $where = array(), $fetch = 'assoc', $distinct = 0)
  {
    if (empty($table) || empty($select)) return false;

    $q = $this->modx->newQuery($table);
    $q->select($select);
    if (!empty($where)) {
      $q->where($where);
    }
    if ($distinct) {
      $q->query['distinct'] = 'DISTINCT';
    }
    $q->prepare();
    if($q->stmt && $q->stmt->execute()){
      switch ($fetch) {
        case 'pair':
          return $q->stmt->fetchAll(PDO::FETCH_KEY_PAIR);
          break;

        case 'column':
          return $q->stmt->fetchAll(PDO::FETCH_COLUMN);
          break;

        case 'group':
          return $q->stmt->fetchAll(PDO::FETCH_COLUMN|PDO::FETCH_GROUP);
          break;

        case 'assoc':
        default:
          return $q->stmt->fetchAll(PDO::FETCH_ASSOC);
          break;
      }
    } else {
      $this->modx->log(1, print_r($q->stmt->errorInfo(), true) . ' SQL: <br>' . $q->toSQL());
    }
    $q->stmt->closeCursor();

    return;
  }


  public function db_count($table, $where = array())
  {
    if (empty($table)) return false;

    $where_placeholders = array();
    $where_sql = '';
    $table = $this->modx->getTableName($table);

    if (!empty($where)) {
      // foreach (array_keys($where) as $k) $where_placeholders[] = "`{$k}` =?";
      foreach (array_keys($where) as $column) {
        $tmp = explode(':', $column);
        $column = current($tmp); // TODO: очистка от знаков без :
        $sign = count($tmp) > 1 ? end($tmp) : '=';
        $where_placeholders[] = "`{$column}` {$sign}?";
      }
      $where_sql = ' WHERE ' . implode(' AND ', $where_placeholders);
    }

    $sql = "SELECT COUNT(*) FROM {$table}" . $where_sql;

    $stmt = $this->modx->prepare($sql);
    if (!$stmt->execute(array_values($where))) {
      $this->modx->log(1, print_r($stmt->errorInfo(), true) . ' SQL: ' . $sql . '<br> data: <br>' . print_r($where, true));
      $count = null;
    } else {
      $count = $stmt->fetchColumn();
    }
    $stmt->closeCursor();

    return $count;
  }


  public function db_insert($table, $data)
  {
    if (empty($table) || empty($data)) return false;

    $table = $this->modx->getTableName($table);
    $keys = array_keys($data);
    $fields = '`' . implode('`,`', $keys) . '`';
    $placeholders = substr(str_repeat('?,', count($keys)), 0, -1);
    $sql = "INSERT INTO {$table} ({$fields}) VALUES ({$placeholders});";
    $stmt = $this->modx->prepare($sql);
    if (!$stmt->execute(array_values($data))) {
      $this->modx->log(1, print_r($stmt->errorInfo(), true) . ' SQL: ' . $sql . '<br> data: <br>' . print_r($data, true));
      exit;
    }
    $stmt->closeCursor();

    return;
  }


  public function db_update($table, $data, $where)
  {
    if (!$table || !$data || !$where) return false;

    $q = $this->modx->newQuery($table);
    $q->command('update');
    $q->set($data);
    $q->where($where);
    $q->prepare();
    if (!$q->stmt->execute()) {
      $this->modx->log(1, print_r($q->stmt->errorInfo(), true) . ' SQL: <br>' . $q->toSQL());
    }
    $q->stmt->closeCursor();

    return true;
  }


  public function db_delete($table, $where)
  {
    if (empty($table) || empty($where)) return false;

    $q = $this->modx->newQuery($table);
    $q->command('delete');
    $q->where($where);
    $q->prepare();
    if (!$q->stmt->execute()) {
      $this->modx->log(1, print_r($q->stmt->errorInfo(), true) . ' SQL: <br>' . $q->toSQL());
    }
    $q->stmt->closeCursor();

    return;
  }


  public function db_truncate($table)
  {
    if (empty($table)) return false;

    $table = $this->modx->getTableName($table);
    $sql = "TRUNCATE TABLE {$table};";
    $stmt = $this->modx->prepare($sql);
    if (!$stmt->execute()) {
      $this->modx->log(1, print_r($stmt->errorInfo(), true) . ' SQL: ' . $sql);
    }
    $stmt->closeCursor();

    return;
  }


  public function publisher_resources($published = 1, $template = 0, $exclude_ids = '')
  {
    if (!$template) return false;
    $where = array(
      'template' => $template
    );
    if (!empty($exclude_ids)) {
      $exclude_ids_arr = array_map('trim', explode(',', $exclude_ids));
      $where['id:NOT IN'] = $exclude_ids_arr;
    }
    $q = $this->modx->newQuery('modResource');
    $q->command('update');
    $q->set(array(
      'published' => $published
    ));
    $q->where($where);
    $q->prepare();
    $q->stmt->execute();
    $q->stmt->closeCursor();

    return;
  }


  public function plugin_disable($plugin_id, $disabled)
  {
    $data = array('disabled' => $disabled);
    $where = array('id' => $plugin_id);
    // $this->db_update('modPlugin', $data, 'id', $plugin_id);
    $this->db_update('modPlugin', $data, $where);

    return;
  }


  public function print_result($select, $result_assoc)
  {
    $output = $th_cols = $td_cols = '';
    if (!is_array($select)) {
      $select = explode(',', $select);
    }
    foreach ($select as $key => $title) {
      $title = explode('.', $title);
      $th_cols .= '<th style="border: 1px solid #000;padding: 4px;">'.end($title).'</th>';
      $td_cols .= '<td style="border: 1px solid #000;padding: 4px;">{$'.end($title).'}</td>';
    }
    $tpl = '@INLINE <tr>'.$td_cols.'</tr>';
    $tpl_wrapper = '@INLINE <table cellpadding="0" cellspacing="0" style="border-collapse: collapse;"><thead><tr>'.$th_cols.'</tr></thead><tbody>{$output}</tbody></table><div>Кол-во: {$count}</div>';
    foreach ($result_assoc as $row) {
      $output .= $this->pdoTools->getChunk($tpl, $row);
    }
    $output = $this->pdoTools->getChunk($tpl_wrapper, ['output' => $output, 'count' => count($result_assoc)]);
    print $output;
    return;
  }


  // #console

  public function console()
  {
    return;
  }


  // #tests

  public function test($sat = 0)
  {
    $arr = array('a' => 'foo', 'b' => 'bar', 'sat' => $sat);
    $tpl = '@INLINE <div>{$a} и {$b} {$sat} на трубе</div>';

    print $this->pdoTools->getChunk($tpl, $arr);
    return;
  }

} // end class


// #usage

// $funs = $modx->getService('funs', 'functions', MODX_BASE_PATH.'artmebius/snippets/model/');


?>