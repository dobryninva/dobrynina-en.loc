<?php
/**
 * AutoTemplate for MODx Revolution
 *
 * This plugin sets a new document's template automatically to the one it's siblings
 * have or, if it has no siblings, to the one it's parent has.
 *
 * AutoTemplate is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * AutoTemplate is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
 * details.
 *
 * You should have received a copy of the GNU General Public License along with
 * Inherit Template; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @author      Maarten     <@maarten>
 * @copyright   Copyright (c) 2009, Magnatron
 * @license     GPL v2
 *
 * @package     AutoTemplate
 * @subpackage  plugin
 */


if ($modx->event->name === 'OnDocFormRender') {
	
	// Only when new
	if (empty($scriptProperties['mode']) || $scriptProperties['mode'] !== 'new') return;
	
	// Siblings
	$c = $modx->newQuery('modResource', array('parent'=>$_REQUEST['parent']));
	$c->sortby('id', 'desc'); // Reference last added sibling
	$siblings = $modx->getCollection('modResource', $c);
	if(count($siblings)>0){
		$bro = array_shift($siblings);
		$modx->controller->setProperty('template', $bro->get('template'));
		return;
	}
	// No siblings, use parent
	if((int)$_REQUEST['parent']!=0){
		$dad = $modx->getObject('modResource', $_REQUEST['parent']);
		$modx->controller->setProperty('template', $dad->get('template'));
		return;
	}
}

return;
return;
