<?php
/* Smarty version 3.1.30, created on 2020-10-28 12:36:47
  from "/home/makromed/public_html/demo/templates/default/news/news.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f992d9f7eb539_35929649',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '63a32ea8dd212927cd7e77086b482a5b530eabad' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/default/news/news.tpl',
      1 => 1603718935,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f992d9f7eb539_35929649 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_14122551295f992d9f7ea9e7_34424595', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['layout']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, true);
}
/* {block 'content'} */
class Block_14122551295f992d9f7ea9e7_34424595 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <div class="wrap margin-top-100 col-md-12">
        <div class="container">
            <div class="row">
                <div class="clearfix"></div>
                <?php if ($_smarty_tpl->tpl_vars['news_list']->value) {?>
                    <div class="col-md-12" id="blog">
                        <div class="col-md-12 no-padding">
                            <div class="row">
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['news_list']->value, 'news');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['news']->value) {
?>
                                <div class="col-md-4 item-block">
                                    <div class="blog-item">
                                        <div class="blog-img">
                                            <img src="<?php echo base_url('uploads');?>
/<?php echo $_smarty_tpl->tpl_vars['news']->value->image;?>
" alt="">
                                        </div>
                                        <span class="news-date"><?php echo $_smarty_tpl->tpl_vars['news']->value->created_at;?>
</span>
                                        <div class="blog-title">
                                            <h2><?php echo short_title($_smarty_tpl->tpl_vars['news']->value->title,'...',10);?>
</h2>
                                        </div>
                                        <div class="blog-content">
                                            <p><?php echo mb_substr(strip_tags($_smarty_tpl->tpl_vars['news']->value->description),0,145,'UTF-8');?>
 ...</p>
                                             <a class="blog-read" href="<?php echo base_url('news/');
echo $_smarty_tpl->tpl_vars['news']->value->slug;?>
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
