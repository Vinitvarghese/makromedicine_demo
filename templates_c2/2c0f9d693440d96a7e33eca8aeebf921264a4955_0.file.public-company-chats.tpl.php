<?php
/* Smarty version 3.1.30, created on 2020-10-28 07:59:19
  from "/home/makromed/public_html/demo/templates/default/company/public-company-chats.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f98ec9754d532_07013229',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2c0f9d693440d96a7e33eca8aeebf921264a4955' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/default/company/public-company-chats.tpl',
      1 => 1603802537,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../company/public-company-sidebar.tpl' => 1,
  ),
),false)) {
function content_5f98ec9754d532_07013229 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_16969784735f98ec9754cc88_20496386', 'content');
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['layout']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, true);
}
/* {block 'content'} */
class Block_16969784735f98ec9754cc88_20496386 extends Smarty_Internal_Block
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
                    <h2>Chats</h2>
                </div>
                <div class="full_width news_tiles">
                    <div class="jumbotron" style="background-color: rgba(255, 210, 0, 1);">
                        <div class="container">
                            <h1><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Under Construction</h1>
                            <p>This page is under construction.</p>
                        </div>
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
