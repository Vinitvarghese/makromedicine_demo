<?php
/* Smarty version 3.1.30, created on 2020-10-28 15:21:14
  from "/home/makromed/public_html/demo/templates/default/company/public-company-view-news.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f99542a7fa5d8_81709495',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '984192bb520da5e26770d2172c82fc1f015f559f' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/default/company/public-company-view-news.tpl',
      1 => 1603802539,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../company/public-company-sidebar.tpl' => 1,
  ),
),false)) {
function content_5f99542a7fa5d8_81709495 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once '/home/makromed/public_html/demo/application/libraries/Smarty/libs/plugins/modifier.date_format.php';
if (!is_callable('smarty_modifier_truncate')) require_once '/home/makromed/public_html/demo/application/libraries/Smarty/libs/plugins/modifier.truncate.php';
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_3141039345f99542a7f9958_72711611', 'content');
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['layout']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, true);
}
/* {block 'content'} */
class Block_3141039345f99542a7f9958_72711611 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <link rel="stylesheet" href="<?php echo base_url('templates/default/assets/css/prefix-style.css');?>
" media="all">
    <div class="n_content_area full_width">
    <a href="#" id="openMenu" class="public-menu-float">Menu</a>

        <div class="container-fluid">
            <div class="row">
                <?php $_smarty_tpl->_subTemplateRender("file:../company/public-company-sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

                <div class="n_right_section start_with_text news_page">
                    <div class="with_buttons full_width">
                        <h2><?php echo $_smarty_tpl->tpl_vars['news']->value['title'];?>
</h2>
                    </div>
                    <div class="full_width news_tiles">
                        <div class="row">

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="new_in_top" >
                                        <?php if (smarty_modifier_date_format($_smarty_tpl->tpl_vars['news']->value['date'],"%D") == date("d/m/Y")) {?>
                                            <span class="day_n ">Date: Today</span>
                                        <?php } elseif (smarty_modifier_date_format($_smarty_tpl->tpl_vars['news']->value['date'],"%D") == date('d/m/Y',strtotime("-1 day"))) {?>
                                            <span class="day_n ">Date: Yesterday</span>
                                        <?php } else { ?>
                                            <span class="day_n ">Date: <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['news']->value['date'],"%D");?>
</span>
                                        <?php }?>

                                        <span class="show_new_read_count">View: <?php echo $_smarty_tpl->tpl_vars['news']->value['view'];?>
</span>
                                    </div>

                                    <div class="full_width news_img">
                                        <?php if (smarty_modifier_date_format($_smarty_tpl->tpl_vars['news']->value['date'],"%D") == date("d/m/Y")) {?>
                                            <span class="abs_right_n">new</span>
                                        <?php }?>
                                        <img src="<?php echo base_url('uploads/news/');
echo $_smarty_tpl->tpl_vars['news']->value['image'];?>
" alt="news" />
                                    </div>
                                    <p class="mt-10 news_desc"><?php echo $_smarty_tpl->tpl_vars['news']->value['description'];?>
</p>

                                </div>

                            <?php if ((!empty($_smarty_tpl->tpl_vars['other_news']->value))) {?>
                                <div class="col-md-12 col-sm-11 col-xs-11 other_news">
                                    <div class="news-title">
                                        <h2>Other news</h2>

                                        <div class="slider_btns">
                                            <button type="button" class="slider_btn slider_left">
                                                <svg width="7" height="9" viewBox="0 0 7 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0 4.5L7 9V0L0 4.5Z" fill="white"/>
                                                </svg>
                                            </button>
                                            <button type="button" class="slider_btn slider_right">
                                                <svg width="7" height="9" viewBox="0 0 7 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7 4.5L0 9V0L7 4.5Z" fill="white"/>
                                                </svg>

                                            </button>
                                        </div>
                                    </div>

                                    <div class="row other_news_slider">
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['other_news']->value, 'newsitem');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['newsitem']->value) {
?>
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <?php if (smarty_modifier_date_format($_smarty_tpl->tpl_vars['newsitem']->value['date'],"%d/%m/%y") == date("d/m/y")) {?>
                                                    <span class="day_n">Today</span>
                                                <?php } elseif (smarty_modifier_date_format($_smarty_tpl->tpl_vars['newsitem']->value['date'],"%d/%m/%y") == date('d/m/y',strtotime("-1 day"))) {?>
                                                    <span class="day_n">Yesterday</span>
                                                <?php } else { ?>
                                                    <span class="day_n"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['newsitem']->value['date'],"%d/%m/%y");?>
</span>
                                                <?php }?>

                                                <div class="full_width news_img">
                                                    <?php if (smarty_modifier_date_format($_smarty_tpl->tpl_vars['newsitem']->value['date'],"%d/%m/%y") == date("d/m/y")) {?>
                                                        <span class="abs_right_n">new</span>
                                                    <?php }?>
                                                    <a href="<?php echo site_url_multi('/');?>
companies/<?php echo $_smarty_tpl->tpl_vars['slug']->value;?>
/news/<?php echo $_smarty_tpl->tpl_vars['newsitem']->value['id'];?>
" >
                                                        <img src="<?php echo base_url('uploads/news/');
echo $_smarty_tpl->tpl_vars['newsitem']->value['image'];?>
" alt="news" />
                                                    </a>
                                                </div>
                                                <a href="<?php echo site_url_multi('/');?>
companies/<?php echo $_smarty_tpl->tpl_vars['slug']->value;?>
/news/<?php echo $_smarty_tpl->tpl_vars['newsitem']->value['id'];?>
" class="heading_nn"><?php echo $_smarty_tpl->tpl_vars['newsitem']->value['title'];?>
</a>
                                                <p style="width: 100%;"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['newsitem']->value['description'],220);?>
</p>
                                            </div>
                                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                    </div>

                                </div><!-- end of other news -->
                            <?php }?>
                        </div>
                    </div>

                </div><!-- /.right_section -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->

    </div><!-- /.n_content_area -->

<?php
}
}
/* {/block 'content'} */
}
