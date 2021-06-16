<?php
/* Smarty version 3.1.30, created on 2020-10-26 17:34:39
  from "/home/makromed/public_html/demo/templates/default/layout/default.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f96d06fdfdb36_40911561',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c3ba91a8f8bb60999be2d574e9ce5a763eb62a3b' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/default/layout/default.tpl',
      1 => 1603718923,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:templates/default/_partial/header.tpl' => 1,
    'file:templates/default/_partial/footer.tpl' => 1,
  ),
),false)) {
function content_5f96d06fdfdb36_40911561 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
$_smarty_tpl->_subTemplateRender("file:templates/default/_partial/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_12437168165f96d06fdfd390_99040213', 'content');
?>

<?php $_smarty_tpl->_subTemplateRender("file:templates/default/_partial/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
/* {block 'content'} */
class Block_12437168165f96d06fdfd390_99040213 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'content'} */
}
