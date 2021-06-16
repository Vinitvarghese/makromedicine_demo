<?php
/* Smarty version 3.1.30, created on 2020-10-27 17:46:10
  from "/home/makromed/public_html/demo/templates/default/faq.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f9824a2e42b31_77995300',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '049f21757c34f2cb7449dab58bdaf0d23752f34b' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/default/faq.tpl',
      1 => 1603718918,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f9824a2e42b31_77995300 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_17865081475f9824a2e42173_83325296', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['layout']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, true);
}
/* {block 'content'} */
class Block_17865081475f9824a2e42173_83325296 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<div class="wrap margin-top-100 col-md-12">
		<div class="container">
			<div class="row">
				
				<div class="col-md-12" style="margin-top:25px;margin-bottom:25px;">
					<div class="col-md-12">
						<h1 class="faq-title"><?php echo translate('title');?>
</h1>
						<p class="faq-subtitle"> <?php echo translate('description');?>
</p>
					</div>
					<div class="clearfix"></div>
					<?php if ($_smarty_tpl->tpl_vars['faqs']->value) {?>
					<div class="panel-group" id="accordion">
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['faqs']->value, 'faq', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['faq']->value) {
?>
						<div class="panel panel-default">
							<div class="panel-heading shape" data-toggle="collapse" data-parent="#accordion" href="#collapse_<?php echo $_smarty_tpl->tpl_vars['faq']->value->id;?>
">
								<h4 class="panel-title"><?php echo $_smarty_tpl->tpl_vars['faq']->value->question;?>
</h4>
							</div>
							<div id="collapse_<?php echo $_smarty_tpl->tpl_vars['faq']->value->id;?>
" class="panel-collapse collapse <?php if ($_smarty_tpl->tpl_vars['key']->value == 0) {?>}in<?php }?>">
								<div class="panel-body"><?php echo $_smarty_tpl->tpl_vars['faq']->value->answer;?>
</div>
							</div>
						</div>
						<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

					</div>
					<?php }?>
				</div>
			</div>
		</div>
	</div>
<?php
}
}
/* {/block 'content'} */
}
