<?php
/* Smarty version 3.1.48, created on 2024-10-23 12:32:20
  from '/home/vladimir/www/html/dobrynina-en.loc/manager/templates/default/element/tv/renders/input/email.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_6718c2a4773479_75766832',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6657674272703f46b25381a7cedf959dc613f098' => 
    array (
      0 => '/home/vladimir/www/html/dobrynina-en.loc/manager/templates/default/element/tv/renders/input/email.tpl',
      1 => 1712645508,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6718c2a4773479_75766832 (Smarty_Internal_Template $_smarty_tpl) {
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
    
        xtype: 'textfield'
        ,applyTo: 'tv<?php echo $_smarty_tpl->tpl_vars['tv']->value->id;?>
'
        ,width: 400
        ,vtype: 'email'
        ,enableKeyEvents: true
        ,msgTarget: 'under'
        ,allowBlank: <?php if ($_smarty_tpl->tpl_vars['params']->value['allowBlank'] == 1 || $_smarty_tpl->tpl_vars['params']->value['allowBlank'] == 'true') {?>true<?php } else { ?>false<?php }?>
        <?php if ((($tmp = @$_smarty_tpl->tpl_vars['params']->value['maxLength'])===null||$tmp==='' ? '' : $tmp) != '' && (($tmp = @$_smarty_tpl->tpl_vars['params']->value['maxLength'])===null||$tmp==='' ? '' : $tmp) > 0) {
if ((($tmp = @$_smarty_tpl->tpl_vars['params']->value['minLength'])===null||$tmp==='' ? '' : $tmp) != '' && (($tmp = @$_smarty_tpl->tpl_vars['params']->value['minLength'])===null||$tmp==='' ? '' : $tmp) >= 0 && (($tmp = @$_smarty_tpl->tpl_vars['params']->value['maxLength'])===null||$tmp==='' ? '' : $tmp) > (($tmp = @$_smarty_tpl->tpl_vars['params']->value['minLength'])===null||$tmp==='' ? '' : $tmp)) {?>,maxLength: <?php echo sprintf("%d",$_smarty_tpl->tpl_vars['params']->value['maxLength']);
}?> <?php }?>
        <?php if ((($tmp = @$_smarty_tpl->tpl_vars['params']->value['minLength'])===null||$tmp==='' ? '' : $tmp) != '' && (($tmp = @$_smarty_tpl->tpl_vars['params']->value['minLength'])===null||$tmp==='' ? '' : $tmp) >= 0) {?>,minLength: <?php echo sprintf("%d",$_smarty_tpl->tpl_vars['params']->value['minLength']);
}?>
    
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
