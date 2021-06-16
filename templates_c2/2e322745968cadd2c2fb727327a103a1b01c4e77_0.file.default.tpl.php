<?php
/* Smarty version 3.1.30, created on 2020-10-19 18:00:20
  from "/home/makromed/public_html/demo/templates/admin/default/layout/default.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f8d9bf482d896_02779284',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2e322745968cadd2c2fb727327a103a1b01c4e77' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/admin/default/layout/default.tpl',
      1 => 1591650058,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:templates/admin/default/_partial/header.tpl' => 1,
    'file:templates/admin/default/_partial/navbar.tpl' => 1,
    'file:templates/admin/default/_partial/footer.tpl' => 1,
  ),
),false)) {
function content_5f8d9bf482d896_02779284 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
$_smarty_tpl->_subTemplateRender("file:templates/admin/default/_partial/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php $_smarty_tpl->_subTemplateRender("file:templates/admin/default/_partial/navbar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


	<!-- Page header -->
	<div class="page-header page-header-default">
		<div class="page-header-content">
			<div class="page-title">
				<h4>
					<i class="icon-arrow-left52 position-left"></i>
					<span class="text-semibold"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</span>
					<small class="display-block"><?php echo $_smarty_tpl->tpl_vars['subtitle']->value;?>
</small>
				</h4>
			</div>

			<div class="heading-elements visible-elements">
				<?php if (isset($_smarty_tpl->tpl_vars['buttons']->value) && is_array($_smarty_tpl->tpl_vars['buttons']->value)) {?>
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['buttons']->value, 'button');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['button']->value) {
?>
					<<?php echo $_smarty_tpl->tpl_vars['button']->value['type'];?>
 <?php if ($_smarty_tpl->tpl_vars['button']->value['type'] == 'a') {?> href="<?php echo $_smarty_tpl->tpl_vars['button']->value['href'];?>
" <?php }?> class="<?php echo $_smarty_tpl->tpl_vars['button']->value['class'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
" <?php if (!empty($_smarty_tpl->tpl_vars['button']->value['additional']) && isset($_smarty_tpl->tpl_vars['button']->value['additional'])) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['button']->value['additional'], 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?> <?php echo $_smarty_tpl->tpl_vars['key']->value;?>
="<?php echo $_smarty_tpl->tpl_vars['value']->value;?>
"<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>
 <?php }?>>
						<b><i class="<?php echo $_smarty_tpl->tpl_vars['button']->value['icon'];?>
"></i></b> <?php echo $_smarty_tpl->tpl_vars['button']->value['text'];?>
</<?php echo $_smarty_tpl->tpl_vars['button']->value['type'];?>
>
					<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

				<?php }?>
			</div>
		</div>
		<div class="breadcrumb-line"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
			<?php echo $_smarty_tpl->tpl_vars['breadcrumbs']->value;?>

			<?php if (isset($_smarty_tpl->tpl_vars['breadcrumb_links']->value) && !empty($_smarty_tpl->tpl_vars['breadcrumb_links']->value)) {?>
				<ul class="breadcrumb-elements">
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['breadcrumb_links']->value, 'breadcrumb_link');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['breadcrumb_link']->value) {
?>
							<li><a href="<?php echo $_smarty_tpl->tpl_vars['breadcrumb_link']->value['href'];?>
"><i class="<?php echo $_smarty_tpl->tpl_vars['breadcrumb_link']->value['icon_class'];?>
"></i> <?php echo $_smarty_tpl->tpl_vars['breadcrumb_link']->value['text'];?>
 <span class="<?php echo $_smarty_tpl->tpl_vars['breadcrumb_link']->value['label_class'];?>
"><?php echo $_smarty_tpl->tpl_vars['breadcrumb_link']->value['label_value'];?>
</span></a></li>
						<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

				</ul>
			<?php }?>
		</div>
	</div>
	<!-- /page header -->

	

	<!-- Page container -->
	<div class="page-container">
		<!-- Page content -->
		<div class="page-content">
			<!-- Main content -->
			<div class="content-wrapper">
				<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_12707051245f8d9bf482cdd5_77973833', 'content');
?>

			</div>
			<!-- /main content -->
		</div>
		<!-- /page content -->
	</div>
	<!-- /page container -->
<?php $_smarty_tpl->_subTemplateRender("file:templates/admin/default/_partial/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
/* {block 'content'} */
class Block_12707051245f8d9bf482cdd5_77973833 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'content'} */
}
