<?php
/* Smarty version 3.1.30, created on 2020-10-28 12:01:18
  from "/home/makromed/public_html/demo/templates/admin/default/permission/index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f99254e169d42_01463791',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7aa867e00424fb9fcab85d776b87519b73aa078c' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/admin/default/permission/index.tpl',
      1 => 1591650063,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f99254e169d42_01463791 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_7265763395f99254e1690e2_70081572', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['layout']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, true);
}
/* {block 'content'} */
class Block_7265763395f99254e1690e2_70081572 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div class="panel panel-white">
	<div class="panel-heading">
		<h5 class="panel-title"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</h5>
		<div class="heading-elements">
			<a class="btn btn-default heading-btn pull-right table-toolbar-button"><i class="icon-gear"></i></a>
			<?php echo form_open(current_url(),'class="heading-form pull-right" method="get"');?>

				<div class="form-group has-feedback">
					<?php echo form_element($_smarty_tpl->tpl_vars['search_field']->value['name']);?>

					<div class="form-control-feedback">
						<i class="icon-search4 text-size-base text-muted"></i>
					</div>
				</div>
			<?php echo form_close();?>

		</div>
	</div>
	<?php if (isset($_smarty_tpl->tpl_vars['message']->value) && !empty($_smarty_tpl->tpl_vars['message']->value)) {?>
	<div class="panel-body">
		<div class="alert alert-success no-border">
			<?php echo $_smarty_tpl->tpl_vars['message']->value;?>

		</div>
	</div>
	<?php }?>
    <?php if (isset($_smarty_tpl->tpl_vars['columns']->value) && !empty($_smarty_tpl->tpl_vars['columns']->value)) {?>
	<div class="table-toolbar-area" style="display: none; border-bottom: 1px solid #dfdfdf; background: #f5f5f5; padding: 10px;">
		<div class="row">
			<div class="col-md-11" style="padding-top: 5px">
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['columns']->value, 'column_data', false, 'column');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['column']->value => $_smarty_tpl->tpl_vars['column_data']->value) {
?> 
				<label class="checkbox-inline"><input type="checkbox" class="styled table-column-checkbox" checked="checked" value="<?php echo $_smarty_tpl->tpl_vars['column']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['column_data']->value['table'][$_smarty_tpl->tpl_vars['current_lang']->value];?>
</label></a>
				<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

			</div>
			<div class="col-md-1">				
				<button class="btn btn-xs btn-primary btn-labeled btn-block"><b><i class="icon-floppy-disk"></i></b> <?php echo translate('form_button_save',TRUE);?>
</button>
			</div>
		</div>
	</div>
	<?php }?>
	<?php echo form_open_multipart((site_url_multi($_smarty_tpl->tpl_vars['admin_url']->value)).('/extension/delete'),'class="form-horizontal" id="form-list"');?>

	<?php echo $_smarty_tpl->tpl_vars['table']->value;?>

	<?php echo form_close();?>

	<div class="panel-footer">
		<a class="heading-elements-toggle"><i class="icon-more"></i></a>
		<div class="heading-elements">
			<span class="heading-left-element">
			<?php echo form_dropdown('per_page',$_smarty_tpl->tpl_vars['per_page_lists']->value,$_smarty_tpl->tpl_vars['per_page']->value,array("class"=>"bootstrap-select","data-style"=>"btn-default btn-xs"));?>

			</span>
			<?php echo $_smarty_tpl->tpl_vars['pagination']->value;?>

		</div>
	</div>
</div>
<?php echo '<script'; ?>
 type="text/javascript">
	$('.table-toolbar-button').on('click', function(){
		$('.table-toolbar-area').toggle();
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
