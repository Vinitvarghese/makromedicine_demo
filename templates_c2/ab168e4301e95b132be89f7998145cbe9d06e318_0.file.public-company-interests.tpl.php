<?php
/* Smarty version 3.1.30, created on 2020-10-27 18:16:33
  from "/home/makromed/public_html/demo/templates/default/company/public-company-interests.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f982bc1944c16_78496809',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ab168e4301e95b132be89f7998145cbe9d06e318' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/default/company/public-company-interests.tpl',
      1 => 1603802536,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../company/public-company-sidebar.tpl' => 1,
  ),
),false)) {
function content_5f982bc1944c16_78496809 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_16335560375f982bc1943959_16476190', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['layout']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, true);
}
/* {block 'content'} */
class Block_16335560375f982bc1943959_16476190 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <link rel="stylesheet" href="<?php echo base_url('templates/default/assets/css/prefix-style.css');?>
" media="all">
    <style>
    table {
      width: 100%;
      border: none;
      border-top: 1px solid #EEEEEE;
      font-family: arial, sans-serif;
      border-collapse: collapse;
    }

    td,
    th {
      border: 1px solid #EEEEEE;
      border-top: none;
      text-align: left;
      padding: 8px;
      color: #363D41;
      font-size: 14px;
    }

    tr {
      background-color: #fff;
      border: none;
      cursor: pointer;
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      justify-content: flex-start;
    }

    tr:first-child:hover {
      cursor: default;
      background-color: #fff;
    }

    tr:hover {
      background-color: #EEF4FD;
    }

    .expanded-row-content {
      border-top: none;
      display: grid;
      grid-column: 1/-1;
      justify-content: flex-start;
      color: #AEB1B3;
      font-size: 13px;
      background-color: #fff;
    }

    .hide-row {
      display: none;
    }
  </style>



    <div class="n_content_area interest_container full_width">
    <a href="#" id="openMenu" class="public-menu-float">Menu</a>
        <div class="container-fluid">
            <div class="row">
                <?php $_smarty_tpl->_subTemplateRender("file:../company/public-company-sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

                <div class="n_right_section decrease_padding start_with_text">
                    <div class="with_buttons full_width">
                        <h2>INTEREST</h2>
                        <!--<a href="#" class="n_green_col">Add Products</a>-->
                    </div>
                    
                    <div class="scroll_table_n full_width lst_tbl">
                    <?php $_smarty_tpl->_assignInScope('key', 0);
?>
                        <?php if ($_smarty_tpl->tpl_vars['interests']->value) {?>
                    <table>
                    <tr>
                      <th>Product type</th>
                      <th>Status</th>
                      <th>Standart</th>
                      <th>Continent</th>
                      <th>Country</th>
                    </tr>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['interests']->value, 'your_interests', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['your_interests']->value) {
?>
                    <tr onClick='toggleRow(this)'>
                      <td>
                        <?php $_smarty_tpl->_assignInScope('product_type_array', explode(',',$_smarty_tpl->tpl_vars['your_interests']->value['product_type']));
?>
                        <?php if ($_smarty_tpl->tpl_vars['product_types']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product_types']->value, 'product_type', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['product_type']->value) {
?>
                            <?php if ($_smarty_tpl->tpl_vars['k']->value > 1) {?>
                                <?php break 1;?>
                            <?php }?>
                            <?php if (in_array($_smarty_tpl->tpl_vars['product_type']->value->id,$_smarty_tpl->tpl_vars['product_type_array']->value)) {?> <?php echo $_smarty_tpl->tpl_vars['product_type']->value->name;?>
, <?php }?>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                      </td>
                      <td>
                        <?php $_smarty_tpl->_assignInScope('status_array', explode(',',$_smarty_tpl->tpl_vars['your_interests']->value['status']));
?>
                        <?php if ($_smarty_tpl->tpl_vars['groups']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['groups']->value, 'group', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['group']->value) {
?>
                            <?php if ($_smarty_tpl->tpl_vars['k']->value > 1) {?>
                                <?php break 1;?>
                            <?php }?>
                            <?php if (in_array($_smarty_tpl->tpl_vars['group']->value->id,$_smarty_tpl->tpl_vars['status_array']->value)) {?> <?php echo $_smarty_tpl->tpl_vars['group']->value->name;?>
, <?php }?>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                      </td>
                      <td>
                        <?php $_smarty_tpl->_assignInScope('standart_array', explode(',',$_smarty_tpl->tpl_vars['your_interests']->value['standart']));
?>
                        <?php if ($_smarty_tpl->tpl_vars['standarts']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['standarts']->value, 'standart', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['standart']->value) {
?>
                            <?php if ($_smarty_tpl->tpl_vars['k']->value > 1) {?>
                                <?php break 1;?>
                            <?php }?>
                           <?php if (in_array($_smarty_tpl->tpl_vars['standart']->value->id,$_smarty_tpl->tpl_vars['standart_array']->value)) {?> <?php echo $_smarty_tpl->tpl_vars['standart']->value->name;?>
, <?php }?>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                      </td>
                      <td>
                        <?php $_smarty_tpl->_assignInScope('continent_array', explode(',',$_smarty_tpl->tpl_vars['your_interests']->value['continent']));
?>
                        <?php if ($_smarty_tpl->tpl_vars['continents']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['continents']->value, 'continent', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['continent']->value) {
?>
                            <?php if ($_smarty_tpl->tpl_vars['k']->value == 1) {?>
                                <?php break 1;?>
                            <?php }?>
                            <?php if (in_array($_smarty_tpl->tpl_vars['continent']->value->code,$_smarty_tpl->tpl_vars['continent_array']->value)) {?> <?php echo $_smarty_tpl->tpl_vars['continent']->value->name;?>
, <?php }?>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>
...<?php }?>
                      </td>
                      <td>
                        <?php $_smarty_tpl->_assignInScope('country_array', explode(',',$_smarty_tpl->tpl_vars['your_interests']->value['country']));
?>
                        <?php if ($_smarty_tpl->tpl_vars['countrys']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['countrys']->value, 'country', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['country']->value) {
?>
                            <?php if ($_smarty_tpl->tpl_vars['k']->value == 1) {?>
                                <?php break 1;?>
                            <?php }?>
                            <?php if (in_array($_smarty_tpl->tpl_vars['country']->value->id,$_smarty_tpl->tpl_vars['country_array']->value)) {?> <?php echo $_smarty_tpl->tpl_vars['country']->value->name;?>
 <?php }?>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>
...<?php }?>

                          <i class="fa interest_open_close fa-plus"></i>
                      </td>
                      <td class='expanded-row-content hide-row'>
                        <table>
                            <tr>
                            <td>
                            <?php $_smarty_tpl->_assignInScope('product_type_array', explode(',',$_smarty_tpl->tpl_vars['your_interests']->value['product_type']));
?>
                            <?php if ($_smarty_tpl->tpl_vars['product_types']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product_types']->value, 'product_type');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['product_type']->value) {
?>
                                <?php if (in_array($_smarty_tpl->tpl_vars['product_type']->value->id,$_smarty_tpl->tpl_vars['product_type_array']->value)) {?> <?php echo $_smarty_tpl->tpl_vars['product_type']->value->name;?>
, <?php }?>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                          </td>
                          <td>
                            <?php $_smarty_tpl->_assignInScope('status_array', explode(',',$_smarty_tpl->tpl_vars['your_interests']->value['status']));
?>
                            <?php if ($_smarty_tpl->tpl_vars['groups']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['groups']->value, 'group');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['group']->value) {
?>
                                <?php if (in_array($_smarty_tpl->tpl_vars['group']->value->id,$_smarty_tpl->tpl_vars['status_array']->value)) {?> <?php echo $_smarty_tpl->tpl_vars['group']->value->name;?>
, <?php }?>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                          </td>
                          <td>
                            <?php $_smarty_tpl->_assignInScope('standart_array', explode(',',$_smarty_tpl->tpl_vars['your_interests']->value['standart']));
?>
                            <?php if ($_smarty_tpl->tpl_vars['standarts']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['standarts']->value, 'standart');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['standart']->value) {
?>
                               <?php if (in_array($_smarty_tpl->tpl_vars['standart']->value->id,$_smarty_tpl->tpl_vars['standart_array']->value)) {?> <?php echo $_smarty_tpl->tpl_vars['standart']->value->name;?>
, <?php }?>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                          </td>
                          <td>
                            <?php $_smarty_tpl->_assignInScope('continent_array', explode(',',$_smarty_tpl->tpl_vars['your_interests']->value['continent']));
?>
                            <?php if ($_smarty_tpl->tpl_vars['continents']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['continents']->value, 'continent');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['continent']->value) {
?>
                                <?php if (in_array($_smarty_tpl->tpl_vars['continent']->value->code,$_smarty_tpl->tpl_vars['continent_array']->value)) {?> <?php echo $_smarty_tpl->tpl_vars['continent']->value->name;?>
, <?php }?>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                          </td>
                          <td>
                            <?php $_smarty_tpl->_assignInScope('country_array', explode(',',$_smarty_tpl->tpl_vars['your_interests']->value['country']));
?>
                            <?php if ($_smarty_tpl->tpl_vars['countrys']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['countrys']->value, 'country');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['country']->value) {
?>
                                <?php if (in_array($_smarty_tpl->tpl_vars['country']->value->id,$_smarty_tpl->tpl_vars['country_array']->value)) {?> <?php echo $_smarty_tpl->tpl_vars['country']->value->name;?>
, <?php }?>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                          </td>
                            </tr>
                        </table>
                      </td>
                    </tr>   
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>
             
                  </table>
                <?php }?>
                    </div>
                </div><!-- /.right_section -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->

    </div><!-- /.n_content_area -->

    <?php echo '<script'; ?>
>
    const toggleRow = (element) => {
      element.getElementsByClassName('expanded-row-content')[0].classList.toggle('hide-row');
      $(element).find('.interest_open_close').toggleClass('fa-plus fa-minus');
    }
  <?php echo '</script'; ?>
>

<?php
}
}
/* {/block 'content'} */
}
