<?php
/* Smarty version 3.1.48, created on 2024-10-23 12:32:20
  from '/home/vladimir/www/html/dobrynina-en.loc/manager/templates/default/element/tv/renders/input/number.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_6718c2a4573b75_99946205',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '13b3417ee1f9b54fec7a7617b4cec1a0c7a0411b' => 
    array (
      0 => '/home/vladimir/www/html/dobrynina-en.loc/manager/templates/default/element/tv/renders/input/number.tpl',
      1 => 1712645508,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6718c2a4573b75_99946205 (Smarty_Internal_Template $_smarty_tpl) {
?><input id="tv<?php echo $_smarty_tpl->tpl_vars['tv']->value->id;?>
" name="tv<?php echo $_smarty_tpl->tpl_vars['tv']->value->id;?>
"
	type="text" class="textfield"
	value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tv']->value->get('value'), ENT_QUOTES, 'UTF-8', true);?>
"
	<?php echo (($tmp = @$_smarty_tpl->tpl_vars['style']->value)===null||$tmp==='' ? '' : $tmp);?>

	tvtype="<?php echo $_smarty_tpl->tpl_vars['tv']->value->type;?>
"
/>

<?php echo '<script'; ?>
>
// <![CDATA[

Ext.onReady(function() {
    var fld = MODx.load({
    
        xtype: 'numberfield'
        ,applyTo: 'tv<?php echo $_smarty_tpl->tpl_vars['tv']->value->id;?>
'
        ,width: 400
        ,enableKeyEvents: true
        ,autoStripChars: true
        ,allowBlank: <?php if ($_smarty_tpl->tpl_vars['params']->value['allowBlank'] == 1 || $_smarty_tpl->tpl_vars['params']->value['allowBlank'] == 'true') {?>true<?php } else { ?>false<?php }?>
        ,allowDecimals: <?php if ((($tmp = @$_smarty_tpl->tpl_vars['params']->value['allowDecimals'])===null||$tmp==='' ? '' : $tmp) && (($tmp = @$_smarty_tpl->tpl_vars['params']->value['allowDecimals'])===null||$tmp==='' ? '' : $tmp) != 'false' && (($tmp = @$_smarty_tpl->tpl_vars['params']->value['allowDecimals'])===null||$tmp==='' ? '' : $tmp) != 'No') {?>true<?php } else { ?>false<?php }?>
        ,allowNegative: <?php if ((($tmp = @$_smarty_tpl->tpl_vars['params']->value['allowNegative'])===null||$tmp==='' ? '' : $tmp) && (($tmp = @$_smarty_tpl->tpl_vars['params']->value['allowNegative'])===null||$tmp==='' ? '' : $tmp) != 'false' && (($tmp = @$_smarty_tpl->tpl_vars['params']->value['allowNegative'])===null||$tmp==='' ? '' : $tmp) != 'No') {?>true<?php } else { ?>false<?php }?>
        ,decimalPrecision: <?php if ((($tmp = @$_smarty_tpl->tpl_vars['params']->value['decimalPrecision'])===null||$tmp==='' ? '' : $tmp) >= 0) {
echo sprintf("%d",(($tmp = @$_smarty_tpl->tpl_vars['params']->value['decimalPrecision'])===null||$tmp==='' ? '' : $tmp));
} else { ?>2<?php }?>
        ,strictDecimalPrecision: <?php if ((($tmp = @$_smarty_tpl->tpl_vars['params']->value['strictDecimalPrecision'])===null||$tmp==='' ? '' : $tmp) && (($tmp = @$_smarty_tpl->tpl_vars['params']->value['strictDecimalPrecision'])===null||$tmp==='' ? '' : $tmp) != 'false' && (($tmp = @$_smarty_tpl->tpl_vars['params']->value['strictDecimalPrecision'])===null||$tmp==='' ? '' : $tmp) != 'No') {?>true<?php } else { ?>false<?php }?>
        ,decimalSeparator: <?php if ((($tmp = @$_smarty_tpl->tpl_vars['params']->value['decimalSeparator'])===null||$tmp==='' ? '' : $tmp)) {?>'<?php echo (($tmp = @$_smarty_tpl->tpl_vars['params']->value['decimalSeparator'])===null||$tmp==='' ? '' : $tmp);?>
'<?php } else { ?>'.'<?php }?>
        <?php if ((($tmp = @$_smarty_tpl->tpl_vars['params']->value['maxValue'])===null||$tmp==='' ? '' : $tmp) != '' && is_numeric((($tmp = @$_smarty_tpl->tpl_vars['params']->value['maxValue'])===null||$tmp==='' ? '' : $tmp))) {?>,maxValue: <?php echo (($tmp = @$_smarty_tpl->tpl_vars['params']->value['maxValue'])===null||$tmp==='' ? '' : $tmp);
}?>
        <?php if ((($tmp = @$_smarty_tpl->tpl_vars['params']->value['minValue'])===null||$tmp==='' ? '' : $tmp) != '' && is_numeric((($tmp = @$_smarty_tpl->tpl_vars['params']->value['minValue'])===null||$tmp==='' ? '' : $tmp))) {?>,minValue: <?php echo (($tmp = @$_smarty_tpl->tpl_vars['params']->value['minValue'])===null||$tmp==='' ? '' : $tmp);
}?>
        ,msgTarget: 'under'
    
        ,listeners: { 'keydown': { fn:MODx.fireResourceFormChange, scope:this}}
    });
    MODx.makeDroppable(fld);
    Ext.getCmp('modx-panel-resource').getForm().add(fld);
});

// ]]>
<?php echo '</script'; ?>
>
<?php }
}
