<?php
/* Smarty version 3.1.39, created on 2021-10-12 16:38:33
  from '/home/evgenius/public_html/dveri.artmebius.ru/core/components/controlerrorlog/templates/error_table.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61658fd97723c8_21321416',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e65b06b4f2401086988d9624d910e5ee1917c48c' => 
    array (
      0 => '/home/evgenius/public_html/dveri.artmebius.ru/core/components/controlerrorlog/templates/error_table.tpl',
      1 => 1634045844,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61658fd97723c8_21321416 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/evgenius/public_html/dveri.artmebius.ru/core/model/smarty/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>
<table class="error-log-table">
	<thead>
	<tr>
		<th><i class="celicon celicon-minus-square toggle" id="toggle-total" onclick="controlErrorLog.toggleAll(this)"></i></th>
		<th class="date"><?php echo $_smarty_tpl->tpl_vars['lexicon']->value['date'];?>
</th>
		<th class="time"><?php echo $_smarty_tpl->tpl_vars['lexicon']->value['time'];?>
</th>
		<th class="type"><?php echo $_smarty_tpl->tpl_vars['lexicon']->value['type'];?>
</th>
        <?php if ($_smarty_tpl->tpl_vars['defExists']->value) {?>
			<th class="type"><?php echo $_smarty_tpl->tpl_vars['lexicon']->value['def'];?>
</th>
        <?php }?>
		<th><?php echo $_smarty_tpl->tpl_vars['lexicon']->value['file'];?>
</th>
		<th><?php echo $_smarty_tpl->tpl_vars['lexicon']->value['line'];?>
</th>
	</tr>
	</thead>
	<tbody>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['messages']->value, 'message');
$_smarty_tpl->tpl_vars['message']->iteration = 0;
$_smarty_tpl->tpl_vars['message']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['message']->value) {
$_smarty_tpl->tpl_vars['message']->do_else = false;
$_smarty_tpl->tpl_vars['message']->iteration++;
$__foreach_message_1_saved = $_smarty_tpl->tpl_vars['message'];
?>
		<tr id="elt-row<?php echo $_smarty_tpl->tpl_vars['message']->iteration;?>
" class="<?php echo mb_strtolower($_smarty_tpl->tpl_vars['message']->value->type, 'UTF-8');?>
-message error-data <?php if ($_smarty_tpl->tpl_vars['message']->value->type == 'FATAL') {?>text-error<?php }?>">
			<td><div class="type-border"></div><i class="celicon celicon-minus-square error-data toggle" onclick="controlErrorLog.toggle(this)"></i></td>
			<td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['message']->value->date,((string)$_smarty_tpl->tpl_vars['dateFormat']->value));?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['message']->value->time;?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['message']->value->type;?>
</td>
            <?php if ($_smarty_tpl->tpl_vars['defExists']->value) {?>
				<td><?php echo $_smarty_tpl->tpl_vars['message']->value->def;?>
</td>
            <?php }?>
			<td><?php echo $_smarty_tpl->tpl_vars['message']->value->file;?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['message']->value->line;?>
</td>
		</tr>
		<tr id="elt-row<?php echo $_smarty_tpl->tpl_vars['message']->iteration;?>
-message" class="<?php echo mb_strtolower($_smarty_tpl->tpl_vars['message']->value->type, 'UTF-8');?>
-message error-description <?php if ($_smarty_tpl->tpl_vars['message']->value->type == 'FATAL') {?>text-error<?php }?>">
			<td colspan="<?php if ($_smarty_tpl->tpl_vars['defExists']->value) {?>7<?php } else { ?>6<?php }?>"><div class="type-border"></div>
				<pre><?php echo $_smarty_tpl->tpl_vars['message']->value->message;?>
</pre>
			</td>
		</tr>
    <?php
$_smarty_tpl->tpl_vars['message'] = $__foreach_message_1_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	</tbody>
</table><?php }
}
