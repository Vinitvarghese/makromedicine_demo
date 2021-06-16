<?php
/* Smarty version 3.1.30, created on 2020-10-20 14:30:53
  from "/home/makromed/public_html/demo/templates/default/blog/blog_single.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f8ebc5d110e20_61284297',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3908caf8fcad7acfd4e88c0f771808a804887c96' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/default/blog/blog_single.tpl',
      1 => 1603111923,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f8ebc5d110e20_61284297 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_5151776715f8ebc5d1108b2_63829488', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['layout']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, true);
}
/* {block 'content'} */
class Block_5151776715f8ebc5d1108b2_63829488 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div class="wrap margin-top-100 col-md-12">
    <div class="container">
        <div class="row">
            <div class="clearfix"></div>
            <div class="col-md-12" id="blog-single">
                <div class="col-md-12 no-padding">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            
                        </div>
                        <div class="col-md-12 col-xs-12">
                            <h1 class="blog-title-mor"><?php echo $_smarty_tpl->tpl_vars['blog']->value->title;?>
</h1>
                             <span class="blog-tiles"><i class="fa fa-calendar fa-fw"></i><?php echo $_smarty_tpl->tpl_vars['data_format']->value;?>
</span>
                                <span class="blog-tiles"><i class="fa fa-eye fa-fw"></i><?php echo $_smarty_tpl->tpl_vars['blog']->value->views;?>
</span>
                        </div>
                        <div class="col-md-12 col-xs-12 blog-description">
                            <p><?php echo $_smarty_tpl->tpl_vars['blog']->value->description;?>
</p>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-12 col-xs-12 blog-footer">
                            <div class="col-md-6">
                                <?php $_smarty_tpl->_assignInScope('var', explode(',',$_smarty_tpl->tpl_vars['blog']->value->meta_keyword));
?>
                                <p> TAG:  <?php if (is_array($_smarty_tpl->tpl_vars['var']->value)) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['var']->value, 'value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
?><b><?php echo $_smarty_tpl->tpl_vars['value']->value;?>
</b>,<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?> </p>
                            </div>
                            <div class="col-md-6">
                                <div class="pull-right">
                                    <div class="addthis_inline_share_toolbox_8nyn"></div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}
}
/* {/block 'content'} */
}
