<?php
/**
* menu_prepare
*
* @version v.1.0
*
* @example
* {'menu_prepare' | snippet : ['menu'=>$menu_custom]}
*
* @var string $menu - migx с меню, обязательное
*
* @return array возвращает меню в виде многомерного массива с расставленными классами
*/

$menu = $modx->getOption('menu', $scriptProperties, '');
$rid = $modx->resource->id;

if (!function_exists('menu_prepare')) {
	function menu_prepare($menu,$rid,$level=1)
	{
		$has_active = 0;
		foreach ($menu as $m => $item) {
			$class = '';
			$menu[$m]['level'] = $level;
			if ($item['id']==$rid) {
				$class .= ' current';
				// $menu[$m]['class'] = 'active current';
				$has_active = 1;
			}
			if (!empty($item['submenu'])) {
				// parent
				$class .= ' parent';
				$submenu = json_decode($item['submenu'],1);
				$tmp = menu_prepare($submenu,$rid,$level+1);
				$menu[$m]['submenu'] = $tmp['menu'];
				if ($tmp['active']) {
					$class .= ' active';
					// $menu[$m]['class'] = 'active';
					$has_active = 1;
				}
			}
			$menu[$m]['class'] = $class;
			if (!empty($item['addmenu'])) {
				$menu[$m]['addmenu'] = json_decode($item['addmenu'],1);
			}
		}
		return ['menu' => $menu, 'active' => $has_active];
	}
}

if (empty($menu)) return;
if (!is_array($menu)) $menu = json_decode($menu,1);
$menu = menu_prepare($menu, $modx->resource->id)['menu'];

return $menu;