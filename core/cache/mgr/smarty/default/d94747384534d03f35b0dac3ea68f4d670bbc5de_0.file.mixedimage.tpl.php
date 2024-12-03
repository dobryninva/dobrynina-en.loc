<?php
/* Smarty version 3.1.48, created on 2024-10-28 07:45:53
  from '/home/vladimir/www/html/dobrynina-en.loc/core/components/mixedimage/elements/tv/input/tpl/mixedimage.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_671f170114b584_43569166',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd94747384534d03f35b0dac3ea68f4d670bbc5de' => 
    array (
      0 => '/home/vladimir/www/html/dobrynina-en.loc/core/components/mixedimage/elements/tv/input/tpl/mixedimage.tpl',
      1 => 1652340303,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_671f170114b584_43569166 (Smarty_Internal_Template $_smarty_tpl) {
?><input type="hidden" id="tv<?php echo $_smarty_tpl->tpl_vars['tv']->value->id;?>
" name="tv<?php echo $_smarty_tpl->tpl_vars['tv']->value->id;?>
" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tv']->value->value, ENT_QUOTES, 'UTF-8', true);?>
" /> 
<div id="mixedimage<?php echo $_smarty_tpl->tpl_vars['tv']->value->id;?>
" class="mixedimage"></div>

<?php if ($_smarty_tpl->tpl_vars['showPreview']->value === "true") {?>
	<div id="tv-image-preview-<?php echo $_smarty_tpl->tpl_vars['tv']->value->id;?>
" class="modx-tv-image-preview">
		<?php if ($_smarty_tpl->tpl_vars['isVideo']->value) {?> 
		    <?php if ($_smarty_tpl->tpl_vars['tv']->value->value) {?>
			    <video controls>
				  <source src="../<?php echo $_smarty_tpl->tpl_vars['source_path']->value;
echo $_smarty_tpl->tpl_vars['tv']->value->value;?>
" type="<?php echo $_smarty_tpl->tpl_vars['current_mime']->value;?>
"> 
					Your browser does not support the video tag.
				</video> 
			<?php }?>
		<?php } else { ?>
		    <?php if ($_smarty_tpl->tpl_vars['tv']->value->value) {?>
				<img src="<?php echo $_smarty_tpl->tpl_vars['_config']->value['connectors_url'];?>
system/phpthumb.php?w=300&h=300&aoe=0&far=0&src=<?php echo $_smarty_tpl->tpl_vars['tv']->value->value;?>
&source=<?php echo $_smarty_tpl->tpl_vars['tv']->value->source;?>
" alt="" />
			<?php }?>
		<?php }?> 
	</div>
<?php }?>

<?php echo '<script'; ?>
 type="text/javascript">
 
	mixedimage<?php echo $_smarty_tpl->tpl_vars['tv']->value->id;?>
 = MODx.load({
		
		xtype: 'mixedimage-panel'
		,renderTo: 'mixedimage<?php echo $_smarty_tpl->tpl_vars['tv']->value->id;?>
'
		,tvFieldId: 'tv<?php echo $_smarty_tpl->tpl_vars['tv']->value->id;?>
'
		,tvId: '<?php echo $_smarty_tpl->tpl_vars['tv']->value->id;?>
'
		,value: '<?php echo $_smarty_tpl->tpl_vars['tv']->value->value;?>
'
		,res_id: <?php echo $_smarty_tpl->tpl_vars['res_id']->value;?>

		,res_alias: '<?php echo $_smarty_tpl->tpl_vars['res_alias']->value;?>
'
		,p_id: <?php echo $_smarty_tpl->tpl_vars['p_id']->value;?>

		,p_alias: '<?php echo $_smarty_tpl->tpl_vars['p_alias']->value;?>
'
		,tv_id: <?php echo $_smarty_tpl->tpl_vars['tv_id']->value;?>

		,ms_id: <?php echo $_smarty_tpl->tpl_vars['ms_id']->value;?>

		,acceptedMIMEtypes: <?php echo $_smarty_tpl->tpl_vars['MIME_TYPES']->value;?>

		,prefixFilename: <?php echo $_smarty_tpl->tpl_vars['prefixFilename']->value;?>

		,triggerlist: '<?php echo $_smarty_tpl->tpl_vars['triggerlist']->value;?>
'
		,source: '<?php echo $_smarty_tpl->tpl_vars['tv']->value->source;?>
'
		,showPreview: <?php echo $_smarty_tpl->tpl_vars['showPreview']->value;?>

		,removeFile: <?php echo $_smarty_tpl->tpl_vars['removeFile']->value;?>

		,ctx_path: '<?php echo $_smarty_tpl->tpl_vars['source_path']->value;?>
'
		,onlyEdit: <?php echo $_smarty_tpl->tpl_vars['onlyEdit']->value;?>

		,openPath: '<?php echo $_smarty_tpl->tpl_vars['openPath']->value;?>
'
		,isVideo: '<?php echo $_smarty_tpl->tpl_vars['isVideo']->value;?>
'
		,current_mime: '<?php echo $_smarty_tpl->tpl_vars['current_mime']->value;?>
'
		
	});
	
	var field = mixedimage<?php echo $_smarty_tpl->tpl_vars['tv']->value->id;?>

	MODx.makeDroppable(field, function(v){  
		var newValue = v.replace('<?php echo $_smarty_tpl->tpl_vars['source_path']->value;?>
', '');
		field.setValue(newValue);
		field.fireEvent('select',{ relativeUrl:newValue });
	});

<?php echo '</script'; ?>
><?php }
}
