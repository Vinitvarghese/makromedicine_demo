<?php
/* Smarty version 3.1.30, created on 2020-10-19 18:00:20
  from "/home/makromed/public_html/demo/templates/admin/default/_partial/navbar.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f8d9bf484f4d1_45411797',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7d8789b9822217e60b048feebac1e534959a3d2a' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/admin/default/_partial/navbar.tpl',
      1 => 1591649998,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f8d9bf484f4d1_45411797 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!-- Second navbar -->
	<div class="navbar navbar-default" id="navbar-second">
		<ul class="nav navbar-nav no-border visible-xs-block">
			<li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-menu7"></i></a></li>
		</ul>

		<div class="navbar-collapse collapse" id="navbar-second-toggle">
			<ul class="nav navbar-nav">
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sidebar_menus']->value, 'menu');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['menu']->value) {
?>
					<li class="<?php if ($_smarty_tpl->tpl_vars['menu']->value['active'] == 1) {?>active<?php }?> <?php if ($_smarty_tpl->tpl_vars['menu']->value['parent']) {?>dropdown<?php }?>">
						<a href="<?php echo $_smarty_tpl->tpl_vars['menu']->value['href'];?>
" <?php if ($_smarty_tpl->tpl_vars['menu']->value['parent']) {?>class="dropdown-toggle" data-toggle="dropdown"<?php }?> target="<?php echo $_smarty_tpl->tpl_vars['menu']->value['target'];?>
">
							<i class="<?php echo $_smarty_tpl->tpl_vars['menu']->value['icon'];?>
 position-left"></i> <?php echo $_smarty_tpl->tpl_vars['menu']->value['name'];?>
 <?php if ($_smarty_tpl->tpl_vars['menu']->value['parent']) {?><span class="caret"></span><?php }?>
						</a>
						<?php if ($_smarty_tpl->tpl_vars['menu']->value['parent']) {?>
							<ul class="dropdown-menu width-250">
								<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['menu']->value['parent'], 'sub_menu');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['sub_menu']->value) {
?>
									<li <?php if ($_smarty_tpl->tpl_vars['sub_menu']->value['active'] == 1) {?>class="active"<?php }?>>
										<a href="<?php echo $_smarty_tpl->tpl_vars['sub_menu']->value['href'];?>
"><i class="<?php echo $_smarty_tpl->tpl_vars['sub_menu']->value['icon'];?>
 position-left"></i> <?php echo $_smarty_tpl->tpl_vars['sub_menu']->value['name'];
if ($_smarty_tpl->tpl_vars['sub_menu']->value['parent']) {?><span class="caret"></span><?php }?></a>
									
									<?php if ($_smarty_tpl->tpl_vars['sub_menu']->value['parent']) {?>
									<ul class="dropdown-menu dropdown-submenu">
										<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sub_menu']->value['parent'], 'sub_menu2');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['sub_menu2']->value) {
?>
										<li <?php if ($_smarty_tpl->tpl_vars['sub_menu2']->value['active'] == 1) {?>class="active"<?php }?>>
											<a href="<?php echo $_smarty_tpl->tpl_vars['sub_menu2']->value['href'];?>
" <?php echo var_dump($_smarty_tpl->tpl_vars['sub_menu2']->value['sug_count']);?>
><i class="<?php echo $_smarty_tpl->tpl_vars['sub_menu2']->value['icon'];?>
 position-left"></i> <?php echo $_smarty_tpl->tpl_vars['sub_menu2']->value['name'];?>
 <?php if (isset($_smarty_tpl->tpl_vars['sub_menu2']->value['sug_count']) && $_smarty_tpl->tpl_vars['sub_menu2']->value['sug_count'] > 0) {?> (<?php echo $_smarty_tpl->tpl_vars['sub_menu2']->value['sug_count'];?>
)<?php }?></a>
										</li>
										<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

									</ul>
									<?php }?>

									</li>

								<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

							</ul>
						<?php }?>
					</li>
				<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

			</ul>
		</div>
	</div>
	<!-- /second navbar --><?php }
}
