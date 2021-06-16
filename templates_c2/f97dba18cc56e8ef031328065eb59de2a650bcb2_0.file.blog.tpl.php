<?php
/* Smarty version 3.1.30, created on 2020-10-28 12:35:50
  from "/home/makromed/public_html/demo/templates/default/blog/blog.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f992d66bb5f08_22956372',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f97dba18cc56e8ef031328065eb59de2a650bcb2' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/default/blog/blog.tpl',
      1 => 1603718928,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f992d66bb5f08_22956372 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_15131879905f992d66bb53b7_45003573', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['layout']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, true);
}
/* {block 'content'} */
class Block_15131879905f992d66bb53b7_45003573 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <div class="wrap margin-top-100 col-md-12">
        <div class="container">
            <div class="row">
                <div class="clearfix"></div>
                <?php if ($_smarty_tpl->tpl_vars['blog_list']->value) {?>
                    <div class="col-md-12" id="blog">
                        <div class="col-md-12 no-padding">
                            <div class="row">
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['blog_list']->value, 'blog');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['blog']->value) {
?>
                                <div class="col-md-4 item-block">
                                    <div class="blog-item">
                                        <div class="blog-img">
                                        <?php if ($_smarty_tpl->tpl_vars['blog']->value->image != NULL) {?>
                                        <img src="<?php echo base_url('uploads/');
echo $_smarty_tpl->tpl_vars['blog']->value->image;?>
" alt="<?php echo $_smarty_tpl->tpl_vars['blog']->value->title;?>
">
                                        <?php } else { ?>
                                        <img src="<?php echo base_url('uploads/catalog/');?>
nophoto.png" alt="<?php echo $_smarty_tpl->tpl_vars['blog']->value->title;?>
" style="height: 240px;object-fit: contain;">
                                        <?php }?>
                                        </div>
                                        <span class="news-date"><?php echo $_smarty_tpl->tpl_vars['blog']->value->created_at;?>
</span>
                                        <div class="blog-title">
                                            <h2><?php echo short_title($_smarty_tpl->tpl_vars['blog']->value->title,'...',11);?>
</h2>
                                        </div>
                                        <div class="blog-content">
                                            <p style="width:100%"><?php echo mb_substr(str_replace('&nbsp;',' ',strip_tags($_smarty_tpl->tpl_vars['blog']->value->description)),0,120,'UTF-8');?>
 ...</p>
                                            <a class="blog-read" href="<?php echo base_url('blog/');
echo $_smarty_tpl->tpl_vars['blog']->value->slug;?>
">Read More</a>
                                        </div>
                                    </div>
                                </div>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <?php echo $_smarty_tpl->tpl_vars['pagination']->value;?>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php }?>
            </div>
        </div>
    </div>
<?php
}
}
/* {/block 'content'} */
}
