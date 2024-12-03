<?php

$output = '<div style="margin:5px;">';
$output .= '    <p><input name="menu_position" type="radio" value="topnav" /> - Отображение в верхнем меню</p>';
$output .= '    <p><input name="menu_position" type="radio" value="components" checked="checked" /> - Отображение в меню "Приложения"</p>';
$output .= '</div>';
$output .= '<hr><div style="margin:5px;">';
$output .= '    <p>Введите имя Host в robots.txt: <br><input name="host_name" type="text" value="'.MODX_HTTP_HOST.'" required="required" /></p>';
$output .= '</div>';

return $output;

?>