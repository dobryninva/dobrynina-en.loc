<?php
/**
* [[!sortInputs? &name=`sortby` &value=`menuindex`]]
*/
$value = ($_GET[$name] != '') ? $_GET[$name] : $value;
$output = '<input type="hidden" name="'.$name.'" value="'.$value.'" />';
return $output;