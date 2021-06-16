<?php
/* Smarty version 3.1.30, created on 2020-10-19 18:00:20
  from "/home/makromed/public_html/demo/templates/admin/default/dashboard/index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f8d9bf481eb95_29226253',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '31c8b7e1e1e882cf09441ae97e36dcf9e23c6d3a' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/admin/default/dashboard/index.tpl',
      1 => 1591650063,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f8d9bf481eb95_29226253 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1192137305f8d9bf481e763_67245569', 'content');
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['layout']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, true);
}
/* {block 'content'} */
class Block_1192137305f8d9bf481e763_67245569 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<div class="content">
		<div class="row">
			<?php if ($_smarty_tpl->tpl_vars['modules']->value) {?>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['modules']->value, 'module');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['module']->value) {
?>
					<div class="col-lg-2 col-md-4 col-sm-6">
						<div class="panel panel-body panel-body-accent" style="min-height:114px;">
							<div class="media no-margin">
								<div class="media-left media-middle">
									<a href="<?php echo $_smarty_tpl->tpl_vars['module']->value->link;?>
"><i class="<?php echo $_smarty_tpl->tpl_vars['module']->value->icon;?>
 icon-3x text-info-800"></i></a>
								</div>

								<div class="media-body text-right">
									<h3 class="no-margin text-semibold"><span class="text-success"><?php echo $_smarty_tpl->tpl_vars['module']->value->active_count;?>
</span> / <span class="text-danger"><?php echo $_smarty_tpl->tpl_vars['module']->value->deactive_count;?>
</span></h3>
									<span class="text-uppercase text-size-mini text-muted"><?php echo $_smarty_tpl->tpl_vars['module']->value->name;?>
</span>
								</div>
							</div>
						</div>
					</div>
					
				<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

			<?php }?>
		</div>
	</div>
<?php
}
}
/* {/block 'content'} */
}
