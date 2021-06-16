<?php
/* Smarty version 3.1.30, created on 2020-10-19 18:00:33
  from "/home/makromed/public_html/demo/templates/admin/default/company_name/index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f8d9c011ff0a2_65483943',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e911031bd349ecdef4a8c5b47c7c05896294db4f' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/admin/default/company_name/index.tpl',
      1 => 1591650063,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f8d9c011ff0a2_65483943 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_15822070955f8d9c011fe516_64314937', 'content');
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['layout']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, true);
}
/* {block 'content'} */
class Block_15822070955f8d9c011fe516_64314937 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div class="panel panel-white">
	<div class="panel-heading">
		<h5 class="panel-title"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</h5>
		<div class="heading-elements">
			<div class="btn-group">
				<?php if (isset($_smarty_tpl->tpl_vars['language_list_holder']->value) && is_array($_smarty_tpl->tpl_vars['language_list_holder']->value)) {?>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['language_list_holder']->value, 'language');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['language']->value) {
?>		
                        <a href="<?php echo site_url_multi($_smarty_tpl->tpl_vars['admin_url']->value);?>
/<?php echo $_smarty_tpl->tpl_vars['module_name']->value;?>
?language_id=<?php echo $_smarty_tpl->tpl_vars['language']->value['id'];?>
" class="<?php echo $_smarty_tpl->tpl_vars['language']->value['class'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['admin_theme']->value;?>
/global_assets/images/flags/<?php echo $_smarty_tpl->tpl_vars['language']->value['code'];?>
.png" alt="<?php echo $_smarty_tpl->tpl_vars['language']->value['name'];?>
"> <?php echo mb_strtoupper($_smarty_tpl->tpl_vars['language']->value['name'], 'UTF-8');?>
 <span class="label bg-slate-700"><?php echo $_smarty_tpl->tpl_vars['language']->value['count'];?>
</span></a>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

				<?php }?>
			</div>
			<a class="btn btn-default heading-btn pull-right table-toolbar-button"><i class="icon-gear"></i></a>

			<?php if (isset($_smarty_tpl->tpl_vars['search_field']->value)) {?>
				<?php echo form_open(current_url(),'class="heading-form pull-right" method="GET"');?>

					<div class="form-group has-feedback">
						<?php echo form_element($_smarty_tpl->tpl_vars['search_field']->value);?>

						<div class="form-control-feedback">
							<i class="icon-search4 text-size-base text-muted"></i>
						</div>
					</div>
				<?php echo form_close();?>

			<?php }?>
		</div>
	</div>



	<?php if (isset($_smarty_tpl->tpl_vars['all_fields']->value) && !empty($_smarty_tpl->tpl_vars['all_fields']->value)) {?>
	<div class="table-toolbar-area" style="display: none; border-bottom: 1px solid #dfdfdf; background: #f5f5f5; padding: 10px;">
		<div class="row">
			<?php echo form_open(current_url(),'method="GET"');?>

			<div class="col-md-10" style="padding-top: 5px">
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['all_fields']->value, 'column_data', false, 'column');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['column']->value => $_smarty_tpl->tpl_vars['column_data']->value) {
?> 
				<label class="checkbox-inline"><input name="fields[]" type="checkbox" class="styled table-column-checkbox" <?php if (in_array($_smarty_tpl->tpl_vars['column']->value,$_smarty_tpl->tpl_vars['fields']->value)) {?>checked="checked"<?php }?> value="<?php echo $_smarty_tpl->tpl_vars['column']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['column_data']->value['table'][$_smarty_tpl->tpl_vars['current_lang']->value];?>
</label></a>
				<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

			</div>
			<div class="col-md-2">				
				<button class="btn btn-xs btn-primary btn-labeled btn-block"><b><i class="icon-floppy-disk"></i></b> <?php echo translate('form_button_save',true);?>
</button>
			</div>
			<?php echo form_close();?>

		</div>
	</div>
	<?php }?>
	<?php echo form_open_multipart(current_url(),'class="form-horizontal" id="form-list"');?>

        <?php echo $_smarty_tpl->tpl_vars['table']->value;?>

	<?php echo form_close();?>

	
    <div class="panel-footer">
		<a class="heading-elements-toggle"><i class="icon-more"></i></a>
		<div class="heading-elements">
			<span class="heading-left-element" style="padding-left:10px;">
				<?php echo form_dropdown('per_page',$_smarty_tpl->tpl_vars['per_page_lists']->value,$_smarty_tpl->tpl_vars['per_page']->value,array("class"=>"bootstrap-select","data-style"=>"btn-default btn-xs"));?>

			</span>
			<?php echo $_smarty_tpl->tpl_vars['pagination']->value;?>

		</div>
	</div>

</div>
<?php echo '<script'; ?>
 type="text/javascript">
	$('.table-toolbar-button').on('click', function(){
		$('.table-toolbar-area').slideToggle( "fast" );
	});
	$('.table-column-checkbox').change(function(){
		var column = $(this).val();
		if($(this).prop('checked')){
			$('.column_'+column).removeClass('hide');
		}
		else{
			$('.column_'+column).addClass('hide');
		}
	});
<?php echo '</script'; ?>
>
<?php
}
}
/* {/block 'content'} */
}
