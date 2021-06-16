<?php
/* Smarty version 3.1.30, created on 2020-10-28 09:48:31
  from "/home/makromed/public_html/demo/templates/default/prlist.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f99062f41c8a7_29950070',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '874f68f35ca4312bc914a3c159d191502e314db6' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/default/prlist.tpl',
      1 => 1603718917,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f99062f41c8a7_29950070 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_18188480445f99062f41bec2_98808367', 'content');
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['layout']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, true);
}
/* {block 'content'} */
class Block_18188480445f99062f41bec2_98808367 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


 <div class="wrap margin-top-100 col-md-12">
      <div class="container">
        <div class="row">
          <div class="clearfix"></div>
			 <div class="col-md-12" id="about" style="background: #fff; margin-bottom: 10px;margin-top: 10px;">
			<table class="table table-hover">
				<tbody>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['companies']->value, 'company');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['company']->value) {
?>
				<tr>
					<td><a href="<?php echo base_url('company/');
echo $_smarty_tpl->tpl_vars['company']->value->slug;?>
"><?php echo $_smarty_tpl->tpl_vars['company']->value->company_name;?>
</a></td>
				</tr>
				<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

				</tbody>
			</table>
			<?php echo $_smarty_tpl->tpl_vars['pagination']->value;?>

			</div>
		</div>
	</div>
</div>

<?php
}
}
/* {/block 'content'} */
}
