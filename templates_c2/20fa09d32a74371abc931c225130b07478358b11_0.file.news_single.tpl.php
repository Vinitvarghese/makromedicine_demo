<?php
/* Smarty version 3.1.30, created on 2020-10-26 23:43:12
  from "/home/makromed/public_html/demo/templates/default/news/news_single.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f9726d0569689_83865961',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '20fa09d32a74371abc931c225130b07478358b11' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/default/news/news_single.tpl',
      1 => 1603718936,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f9726d0569689_83865961 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_25409935f9726d05689b9_45210543', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['layout']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, true);
}
/* {block 'content'} */
class Block_25409935f9726d05689b9_45210543 extends Smarty_Internal_Block
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
                                <div class="blog-fullimg">
                                    <img src="<?php echo base_url('uploads');?>
/<?php echo $_smarty_tpl->tpl_vars['news']->value->image;?>
" alt="<?php echo $_smarty_tpl->tpl_vars['news']->value->title;?>
">
                                </div>
                            </div>
                            <div class="col-md-12 col-xs-12">
                                <h1 class="blog-title-mor"><?php echo $_smarty_tpl->tpl_vars['news']->value->title;?>
</h1>
                               
                                <span class="blog-tiles"><i class="fa fa-calendar fa-fw"></i><?php echo $_smarty_tpl->tpl_vars['data_format']->value;?>
</span>
                                <span class="blog-tiles"><i class="fa fa-eye fa-fw"></i><?php echo $_smarty_tpl->tpl_vars['news']->value->views;?>
</span>
                            </div>
                            <div class="col-md-12 col-xs-12 blog-description">
                                <p><?php echo $_smarty_tpl->tpl_vars['news']->value->description;?>
</p>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-12 col-xs-12 blog-footer">
                                <div class="col-md-6">
                                    <?php $_smarty_tpl->_assignInScope('var', explode(',',$_smarty_tpl->tpl_vars['news']->value->meta_keyword));
?>
                                    <p> TAG:  <?php if (is_array($_smarty_tpl->tpl_vars['var']->value)) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['var']->value, 'value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
?><a href=""><?php echo $_smarty_tpl->tpl_vars['value']->value;?>
</a><?php
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
