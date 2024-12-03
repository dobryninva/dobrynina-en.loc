<?php return array (
  '7f8afcd1a9d42100eff08fc09e43ad5f' => 
  array (
    'criteria' => 
    array (
      'name' => 'canonical',
    ),
    'object' => 
    array (
      'name' => 'canonical',
      'path' => '{core_path}components/canonical/',
      'assets_path' => '{assets_path}components/canonical/',
    ),
  ),
  '0322d63876b31a206d76542b8994a1d1' => 
  array (
    'criteria' => 
    array (
      'category' => 'Canonical',
    ),
    'object' => 
    array (
      'id' => 60,
      'parent' => 0,
      'category' => 'Canonical',
      'rank' => 0,
    ),
  ),
  '6d570d82b71e26b8372788d209a83a6b' => 
  array (
    'criteria' => 
    array (
      'name' => 'Canonical',
    ),
    'object' => 
    array (
      'id' => 98,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'Canonical',
      'description' => 'Create a canonical tag for Symlinks for SEO',
      'editor_type' => 0,
      'category' => 60,
      'cache_type' => 0,
      'snippet' => '/**
 * Canonical snippet for Canonical extra
 *
 * Copyright 2010-2014 by Bob Ray <http://bobsguides.com>
 * @created 07-31-2010
 *
 * Canonical is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * Canonical is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * Canonical; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package canonical
 */

/******************************
*             Usage           *
*******************************

/*
Install the snippet with Package Manager and put the
following snippet tag in the <head> section of all templates
[[!Canonical]]
*/
/** @var $modx modX */

$docId = $modx->resource->get(\'id\');
$query = $modx->newQuery("modSymLink");

$query->select(array(
    \'id\',
    \'class_key\',
    \'content\',
));
$query->where(array(
    \'id\' => $docId,
    \'class_key\' => \'modSymLink\'
));

if ($query->prepare() && $query->stmt->execute()) {
    $results = $query->stmt->fetchAll(PDO::FETCH_ASSOC);
}

if (!empty($results)) {
    $id = (integer) $results[0][\'content\'];
    $url = $modx->makeUrl($id, \'\', \'\', \'full\');
    $modx->setPlaceholder(\'rid\',$id);
    return \'<link rel="canonical" href="\' . $url . \'" />\';
}

$modx->setPlaceholder(\'rid\',$docId);

return \'\';',
      'locked' => 0,
      'properties' => 'a:0:{}',
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '/**
 * Canonical snippet for Canonical extra
 *
 * Copyright 2010-2014 by Bob Ray <http://bobsguides.com>
 * @created 07-31-2010
 *
 * Canonical is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * Canonical is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * Canonical; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package canonical
 */

/******************************
*             Usage           *
*******************************

/*
Install the snippet with Package Manager and put the
following snippet tag in the <head> section of all templates
[[!Canonical]]
*/
/** @var $modx modX */

$docId = $modx->resource->get(\'id\');
$query = $modx->newQuery("modSymLink");

$query->select(array(
    \'id\',
    \'class_key\',
    \'content\',
));
$query->where(array(
    \'id\' => $docId,
    \'class_key\' => \'modSymLink\'
));

if ($query->prepare() && $query->stmt->execute()) {
    $results = $query->stmt->fetchAll(PDO::FETCH_ASSOC);
}

if (!empty($results)) {
    $id = (integer) $results[0][\'content\'];
    $url = $modx->makeUrl($id, \'\', \'\', \'full\');
    $modx->setPlaceholder(\'rid\',$id);
    return \'<link rel="canonical" href="\' . $url . \'" />\';
}

$modx->setPlaceholder(\'rid\',$docId);

return \'\';',
    ),
  ),
);