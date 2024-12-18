<?php return array (
  'bc5a41753d2d8fb2a7552534f3403b04' => 
  array (
    'criteria' => 
    array (
      'name' => 'cacheclear',
    ),
    'object' => 
    array (
      'name' => 'cacheclear',
      'path' => '{core_path}components/cacheclear/',
      'assets_path' => '{assets_path}components/cacheclear/',
    ),
  ),
  '308d50264da78c9ce6291a0a78b801fc' => 
  array (
    'criteria' => 
    array (
      'category' => 'CacheClear',
    ),
    'object' => 
    array (
      'id' => 61,
      'parent' => 0,
      'category' => 'CacheClear',
      'rank' => 0,
    ),
  ),
  'ce6ae00dcc8dbd51ea2a59f939f7ae46' => 
  array (
    'criteria' => 
    array (
      'name' => 'CacheClear',
    ),
    'object' => 
    array (
      'id' => 99,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'CacheClear',
      'description' => 'Delete all files in the core/cache directory',
      'editor_type' => 0,
      'category' => 61,
      'cache_type' => 0,
      'snippet' => '/**
 * CacheClear snippet for CacheClear extra
 *
 * Copyright 2012-2019 Bob Ray <https://bobsguides.com>
 * Created on 12-14-2012
 *
 * CacheClear is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * CacheClear is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * CacheClear; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package cacheclear
 */

/**
 * Description
 * -----------
 * Delete all files in the core/cache directory
 *
 * Variables
 * ---------
 * @var $modx modX
 * @var $scriptProperties array
 *
 * @package cacheclear
 **/

if (!function_exists("rrmdir")) {
    function rrmdir($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir . "/" . $object) == "dir") {
                        rrmdir($dir . "/" . $object);
                    } else {
                        unlink($dir . "/" . $object);
                    }
                }
            }
            reset($objects);
            rmdir($dir);
        }
    }
}

$output = \'\';
$modx->lexicon->load(\'cacheclear:default\');

$cm = $modx->getCacheManager();
$cacheDir = $cm->getCachePath();

$cacheDir = rtrim($cacheDir, \'/\\\\\');

$output .= \'<p>\' . $modx->lexicon(\'cc_cache_dir\') . \': \' . $cacheDir;
$output .= \'<br />\';

$files = scandir($cacheDir);


$output .= "<ul>\\n";
foreach ($files as $file) {
    if ($file == \'.\' || $file == \'..\') {
        continue;
    }
    if (is_dir($cacheDir . \'/\' . $file)) {
        if ($file == \'logs\') {
            continue;
        }
        $output .= "\\n<li>" . $modx->lexicon(\'cc_removing\') . \': \' . $file . \'</li>\';
        rrmdir($cacheDir . \'/\' . $file);
        if (is_dir($cacheDir . \'/\' . $file)) {
            $output .= "\\n<li>" . $modx->lexicon(\'cc_failed_to_remove\') . \': \' . $file . \'</li>\';
        }
    } else {
        unlink($cacheDir . \'/\' . $file);
    }
}

$output .= "\\n</p></ul><p>" . $modx->lexicon(\'cc_finished\') . "</p>";


return $output;',
      'locked' => 0,
      'properties' => 'a:0:{}',
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '/**
 * CacheClear snippet for CacheClear extra
 *
 * Copyright 2012-2019 Bob Ray <https://bobsguides.com>
 * Created on 12-14-2012
 *
 * CacheClear is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * CacheClear is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * CacheClear; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package cacheclear
 */

/**
 * Description
 * -----------
 * Delete all files in the core/cache directory
 *
 * Variables
 * ---------
 * @var $modx modX
 * @var $scriptProperties array
 *
 * @package cacheclear
 **/

if (!function_exists("rrmdir")) {
    function rrmdir($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir . "/" . $object) == "dir") {
                        rrmdir($dir . "/" . $object);
                    } else {
                        unlink($dir . "/" . $object);
                    }
                }
            }
            reset($objects);
            rmdir($dir);
        }
    }
}

$output = \'\';
$modx->lexicon->load(\'cacheclear:default\');

$cm = $modx->getCacheManager();
$cacheDir = $cm->getCachePath();

$cacheDir = rtrim($cacheDir, \'/\\\\\');

$output .= \'<p>\' . $modx->lexicon(\'cc_cache_dir\') . \': \' . $cacheDir;
$output .= \'<br />\';

$files = scandir($cacheDir);


$output .= "<ul>\\n";
foreach ($files as $file) {
    if ($file == \'.\' || $file == \'..\') {
        continue;
    }
    if (is_dir($cacheDir . \'/\' . $file)) {
        if ($file == \'logs\') {
            continue;
        }
        $output .= "\\n<li>" . $modx->lexicon(\'cc_removing\') . \': \' . $file . \'</li>\';
        rrmdir($cacheDir . \'/\' . $file);
        if (is_dir($cacheDir . \'/\' . $file)) {
            $output .= "\\n<li>" . $modx->lexicon(\'cc_failed_to_remove\') . \': \' . $file . \'</li>\';
        }
    } else {
        unlink($cacheDir . \'/\' . $file);
    }
}

$output .= "\\n</p></ul><p>" . $modx->lexicon(\'cc_finished\') . "</p>";


return $output;',
    ),
  ),
);