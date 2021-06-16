<?php
/* Smarty version 3.1.30, created on 2020-09-17 17:27:49
  from "/home/makromed/public_html/demo/templates/default/product/edit-product.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f636455e01794_07899664',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b4a823f71c5c13662781830189844c9d88b40e68' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/default/product/edit-product.tpl',
      1 => 1591650067,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f636455e01794_07899664 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>
 <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_9573059345f636455dfe324_40675444', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['layout']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, true);
}
/* {block 'content'} */
class Block_9573059345f636455dfe324_40675444 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<style>
    .not-active,.not-active td{
        background-color: #FFCDD2!important;
    }
    #example_wrapper{
    max-width: 1326px;
    margin: 0 auto;
    }
    .dataTables_paginate{
    float:right!important;
    }
     .tables-data .table-search-not{
    width:100%;
     table-layout:fixed;
    }
</style>
<div class="wrap margin-top-100 col-md-12">
    <div class="container-fuild">
        <div class="row">
            <div class="clearfix"></div>
            <div class="col-md-12" id="add-product">
                <div class="col-md-12 no-padding add-product <?php if (isset($_smarty_tpl->tpl_vars['message']->value)) {?> in <?php }?>" id="collapseExample">
                    <div class="col-md-12 no-padding panel-add">
                        <form class="editProductForm" role="form" method="POST" action="<?php echo site_url_multi('product/add');?>
">
                            <input type="hidden" name="request" value="update">
                            <input type="hidden" name="product_id" value="<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
">
                            <div class="no-padding search-tool" style="display:none;">
                                <div class="col-md-12 malecule">
                                    <div class="search-module">
                                        <input type="text" class="module-search" placeholder="Search">
                                        <div class="search-inner"></div>
                                    </div>
                                    <div class="col-md-12 no-padding discom">
                                        <ul class="list-chemical periodic collapse" id="chemical">
                                            <?php if ($_smarty_tpl->tpl_vars['chemichal']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['chemichal']->value, 'chemical');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['chemical']->value) {
?>
                                            <li data-txt="<?php echo $_smarty_tpl->tpl_vars['chemical']->value->meaning;?>
" data-no="<?php echo $_smarty_tpl->tpl_vars['chemical']->value->atc_code;?>
" data-formula="" data-target="chemical" data-id="<?php echo $_smarty_tpl->tpl_vars['chemical']->value->id;?>
">
                                                <a href="#<?php echo $_smarty_tpl->tpl_vars['chemical']->value->atc_code;?>
">
                                                    <div class="lib-span" data-toggle="tooltip" data-placement="right" title="<?php echo $_smarty_tpl->tpl_vars['chemical']->value->atc_code;?>
 | <?php echo $_smarty_tpl->tpl_vars['chemical']->value->meaning;?>
"><?php echo $_smarty_tpl->tpl_vars['chemical']->value->atc_code;?>
 </div>
                                                    <div class="lib-span2"> | <?php echo mb_substr($_smarty_tpl->tpl_vars['chemical']->value->meaning,0,15,'UTF-8');?>
</div>
                                                </a>
                                            </li>
                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                                        </ul>
                                        <ul class="list-herbal periodic collapse" id="herbal">
                                            <?php if ($_smarty_tpl->tpl_vars['herbals']->value) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['herbals']->value, 'herbal');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['herbal']->value) {
?>
                                            <li data-txt="<?php echo $_smarty_tpl->tpl_vars['herbal']->value->name;?>
" data-no="" data-formula="" data-target="herbal" data-id="<?php echo $_smarty_tpl->tpl_vars['herbal']->value->id;?>
"> <a href="#" data-toggle="tooltip" data-placement="right" title="<?php echo $_smarty_tpl->tpl_vars['herbal']->value->name;?>
"><?php echo $_smarty_tpl->tpl_vars['herbal']->value->name;?>
</a> </li>
                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                                        </ul>
                                        <ul class="list-animal periodic collapse" id="animal">
                                            <?php if ($_smarty_tpl->tpl_vars['animals']->value) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['animals']->value, 'animal');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['animal']->value) {
?>
                                            <li data-txt="<?php echo $_smarty_tpl->tpl_vars['animal']->value->name;?>
" data-no="" data-formula="" data-target="animal" data-id="<?php echo $_smarty_tpl->tpl_vars['animal']->value->id;?>
"> <a href="#" data-toggle="tooltip" data-placement="right" title="<?php echo $_smarty_tpl->tpl_vars['animal']->value->name;?>
"><?php echo $_smarty_tpl->tpl_vars['animal']->value->name;?>
</a> </li>
                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                                        </ul>
                                        <ul class="list-casNumber periodic collapse" id="casNumber">
                                            <?php if ($_smarty_tpl->tpl_vars['cas_numbers']->value) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cas_numbers']->value, 'cas_number');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['cas_number']->value) {
?>
                                            <li data-txt="<?php echo htmlentities($_smarty_tpl->tpl_vars['cas_number']->value->chemical_name);?>
" data-no="<?php echo $_smarty_tpl->tpl_vars['cas_number']->value->cas_no;?>
" data-formula="<?php echo $_smarty_tpl->tpl_vars['cas_number']->value->molecular_formula;?>
" data-target="casNumber" data-id="<?php echo $_smarty_tpl->tpl_vars['cas_number']->value->id;?>
">
                                                <a href="#<?php echo $_smarty_tpl->tpl_vars['cas_number']->value->cas_no;?>
" title="<?php echo htmlentities($_smarty_tpl->tpl_vars['cas_number']->value->chemical_name);?>
">
                                                    <div class="lib-span3" data-toggle="tooltip" data-placement="right" title="<?php echo $_smarty_tpl->tpl_vars['cas_number']->value->chemical_name;?>
"><?php echo $_smarty_tpl->tpl_vars['cas_number']->value->cas_no;?>
 </div>
                                                    <div class="lib-span4"> | <?php echo mb_substr($_smarty_tpl->tpl_vars['cas_number']->value->chemical_name,0,14,'UTF-8');?>
</div>
                                                </a>
                                            </li>
                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                                        </ul>
                                        <ul class="list-dossageForm periodic collapse" id="dossageForm">
                                            <?php if ($_smarty_tpl->tpl_vars['dossageforms']->value) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['dossageforms']->value, 'dossageform');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['dossageform']->value) {
?>
                                            <li data-txt="<?php echo $_smarty_tpl->tpl_vars['dossageform']->value->name;?>
" data-no="" data-formula="" data-target="dossageForm" data-id="<?php echo $_smarty_tpl->tpl_vars['dossageform']->value->id;?>
"> <a href="#" data-toggle="tooltip" data-placement="right" title="<?php echo $_smarty_tpl->tpl_vars['dossageform']->value->name;?>
"><?php echo $_smarty_tpl->tpl_vars['dossageform']->value->name;?>
</a> </li>
                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                                        </ul>
                                        <ul class="list-dossageForm periodic collapse" id="medicalClassification">
                                            <?php if ($_smarty_tpl->tpl_vars['medicals']->value) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['medicals']->value, 'medical');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['medical']->value) {
?>
                                            <li data-txt="<?php echo $_smarty_tpl->tpl_vars['medical']->value->name;?>
" data-no="" data-formula="" data-target="medicalClassification" data-id="<?php echo $_smarty_tpl->tpl_vars['medical']->value->id;?>
"> <a href="#" data-toggle="tooltip" data-placement="right" title="<?php echo $_smarty_tpl->tpl_vars['medical']->value->name;?>
"><?php echo $_smarty_tpl->tpl_vars['medical']->value->name;?>
</a> </li>
                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 no-padding specilation">
                                <div class="col-md-12 add-frist">
                                    <div class="form-group">
                                        <div class="col-md-5 no-padding">
                                            <div class="col-md-4 no-padding" style="margin-bottom:15px;">
                                                <label>Product type</label>
                                            </div>
                                            <div class="col-md-7 no-padding" style="margin-bottom:15px;">
                                                <select name="pr_type" class="form-control mylos selectpicker show-menu-arrow product_type_select" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1">
                                                    <option value="0"></option>
                                                    <?php if ($_smarty_tpl->tpl_vars['product_type']->value) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product_type']->value, 'type', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['type']->value) {
?>
                                                    <option value="<?php echo $_smarty_tpl->tpl_vars['type']->value->id;?>
" <?php if ($_smarty_tpl->tpl_vars['product']->value->pr_type == $_smarty_tpl->tpl_vars['type']->value->id) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['type']->value->name;?>
</option>
                                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>
 <?php }?>
                                                </select>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-md-4 no-padding" style="margin-bottom:15px;">
                                                <label>Brand name</label>
                                            </div>
                                            <div class="col-md-7 no-padding " style="margin-bottom:15px;">
                                                <input type="text" name="title" class="form-control mylos" placeholder="Brand name" value="<?php echo $_smarty_tpl->tpl_vars['product']->value->title;?>
">
                                            </div>
                                        </div>
                                        <div class="col-md-6 no-padding country">
                                            <div class="col-md-1 col-lg-2 no-padding ">
                                                <label>Country</label>
                                            </div>
                                            <div class="col-md-4 no-padding ">
                                                <select name="country" class="form-control mylos selectpicker show-menu-arrow" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1">
                                                    <?php if ($_smarty_tpl->tpl_vars['countrys']->value) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['countrys']->value, 'country', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['country']->value) {
?>
                                                    <option value="<?php echo $_smarty_tpl->tpl_vars['country']->value->id;?>
" <?php if ($_smarty_tpl->tpl_vars['product']->value->country == $_smarty_tpl->tpl_vars['country']->value->id) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['country']->value->name;?>
</option>
                                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>
 <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 no-padding country">
                                            <div class="col-md-2 no-padding" style="width: 257px;">
                                                <label>Add new content</label>
                                            </div>
                                            <div class="col-md-10 no-padding">
                                                <button type="button" class="target chemical" data-widget="" data-target="#chemical">ATC code +</button>
                                                <button type="button" class="target herbal" data-widget="" data-target="#herbal">Herbal +</button>
                                                <button type="button" class="target animal" data-widget="" data-target="#animal">Animal + </button>
                                                <button type="button" class="target casNumber" data-widget="" data-target="#casNumber">CAS Number +</button>
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="col-md-12 frist-inner">
                                    <?php $_smarty_tpl->_assignInScope('count', 1);
?> <?php $_smarty_tpl->_assignInScope('atc_codes', json_decode($_smarty_tpl->tpl_vars['product']->value->atc_code));
?> <?php if (!empty($_smarty_tpl->tpl_vars['atc_codes']->value)) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['atc_codes']->value, 'atc_code');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['atc_code']->value) {
?>
                                    <div class="form-group vared label_<?php echo $_smarty_tpl->tpl_vars['atc_code']->value->id;?>
">
                                        <div class="col-md-2 no-padding label_add_prod">
                                            <label>Ingredient <?php echo $_smarty_tpl->tpl_vars['count']->value;?>
</label>
                                            <input type="hidden" name="atc_codes[<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
][id]" value="<?php echo $_smarty_tpl->tpl_vars['atc_code']->value->id;?>
">
                                        </div>
                                        <div class="col-md-3 no-padding">
                                            <div class="input-group">
                                                <span class="input-group-addon beautiful" style="width:101px;">Atc code</span>
                                                <input type="text" class="form-control fix-inputgroup" value="<?php echo get_atc_code_name($_smarty_tpl->tpl_vars['atc_code']->value->id);?>
" reaadonly disabled>
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-addon beautiful" style="width:101px;">NAME</span>
                                                <input type="text" class="form-control fix-inputgroup" value="<?php echo get_atc_code_no($_smarty_tpl->tpl_vars['atc_code']->value->id);?>
" reaadonly disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-1" style="border-right:1px solid rgb(209, 209, 209);">
                                            <button type="button" class="btn btn-danger btn-bix pull-right remove-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"> <i class="fa fa-trash"></i> </button>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group" style="margin-bottom:5px;">
                                                <span class="input-group-addon beautiful" style="width: 95px;height: 32px;">Quantity</span>
                                                <div class="form-inline" style="">
                                                    <div style="width:82px;float:left;">
                                                        <label></label>
                                                        <input type="text" class="form-control mylos" placeholder="Quantity" name="atc_codes[<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
][mdoza]" value="<?php echo $_smarty_tpl->tpl_vars['atc_code']->value->mdoza;?>
">
                                                    </div>
                                                    <div style="width:95px;float:left;">
                                                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="atc_codes[<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
][vdoza]">
                                                            <option value="">Dose unit</option>
                                                            <?php if ($_smarty_tpl->tpl_vars['unit']->value) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['unit']->value, 'value', false, 'ey');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['ey']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
                                                            <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
" <?php if ($_smarty_tpl->tpl_vars['atc_code']->value->vdoza == $_smarty_tpl->tpl_vars['value']->value->id) {?>selected="selected"<?php }?> data-code="<?php echo $_smarty_tpl->tpl_vars['value']->value->short_name;?>
" data-subtext="<?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
"><?php echo $_smarty_tpl->tpl_vars['value']->value->short_name;?>
</option>
                                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>
 <?php }?>
                                                        </select>
                                                    </div>
                                                    <div style="width:20px;float:left;">
                                                        <?php if ($_smarty_tpl->tpl_vars['atc_code']->value->mdoza2) {?>
                                                        <button type="button" class="plus_item" data-id="<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
" data-type="chemicals" style="display: none;">+</button>
                                                        <button type="button" class="minus_item" style="display:block !important">-</button>
                                                        <?php } else { ?>
                                                        <button type="button" class="plus_item" data-id="<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
" data-type="chemicals">+</button>
                                                        <button type="button" class="minus_item" style="display: none;">-</button>
                                                        <?php }?>
                                                    </div>
                                                    
                                                        <?php if ($_smarty_tpl->tpl_vars['atc_code']->value->mdoza2) {?>
                                                        <div style="width:45%;float:left;" class="extra-mg">
                                                        <div class="col-sm-6 no-padding">
                                                            <input type="text" class="form-control mylos" placeholder="Quantity" name="atc_codes[<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
][mdoza2]" value="<?php echo $_smarty_tpl->tpl_vars['atc_code']->value->mdoza2;?>
">
                                                        </div>
                                                        <div class="col-sm-6 no-padding">
                                                            <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="atc_codes[<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
][vdoza2]">
                                                                <option value="">Volume unit</option>
                                                                <?php if ($_smarty_tpl->tpl_vars['unit']->value) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['unit']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
                                                                <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
" <?php if ($_smarty_tpl->tpl_vars['atc_code']->value->vdoza2 == $_smarty_tpl->tpl_vars['value']->value->id) {?>selected="selected"<?php }?> data-code="<?php echo $_smarty_tpl->tpl_vars['value']->value->short_name;?>
" data-subtext="<?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
"><?php echo $_smarty_tpl->tpl_vars['value']->value->short_name;?>
</option>
                                                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>
 <?php }?>
                                                            </select>
                                                        </div>
                                                         </div>
                                                        <?php } else { ?>
                                                             <div style="width:45%;float:left;display: none;" class="extra-mg">
                                                        <div class="col-sm-6 no-padding">
                                                            <input type="text" class="form-control mylos" placeholder="Quantity" name="atc_codes[<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
][mdoza2]" >
                                                        </div>
                                                        <div class="col-sm-6 no-padding">
                                                            <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="atc_codes[<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
][vdoza2]">
                                                                <option value="">Volume unit</option>
                                                                <?php if ($_smarty_tpl->tpl_vars['unit']->value) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['unit']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
                                                                <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
" data-code="<?php echo $_smarty_tpl->tpl_vars['value']->value->short_name;?>
" data-subtext="<?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
"><?php echo $_smarty_tpl->tpl_vars['value']->value->short_name;?>
</option>
                                                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>
 <?php }?>
                                                            </select>
                                                        </div>
                                                         </div>
                                                        <?php }?>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <?php $_smarty_tpl->_assignInScope('count', $_smarty_tpl->tpl_vars['count']->value+1);
?> <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>
 <?php }?> <?php $_smarty_tpl->_assignInScope('herbals', json_decode($_smarty_tpl->tpl_vars['product']->value->herbal));
?> <?php if (!empty($_smarty_tpl->tpl_vars['herbals']->value)) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['herbals']->value, 'herbal');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['herbal']->value) {
?>
                                    <div class="form-group vared label_<?php echo $_smarty_tpl->tpl_vars['herbal']->value->id;?>
">
                                        <div class="col-md-2 no-padding label_add_prod">
                                            <label>Ingredient <?php echo $_smarty_tpl->tpl_vars['count']->value;?>
</label>
                                            <input type="hidden" name="herbals[<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
][id]" value="<?php echo $_smarty_tpl->tpl_vars['herbal']->value->id;?>
">
                                        </div>
                                        <div class="col-md-3 no-padding">
                                            <div class="input-group">
                                                <span class="input-group-addon beautiful" style="width:101px;">Herbal</span>
                                                <input type="text" class="form-control fix-inputgroup" value="<?php echo get_herbal_name($_smarty_tpl->tpl_vars['herbal']->value->id);?>
" reaadonly disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-1" style="border-right:1px solid rgb(209, 209, 209);">
                                            <button type="button" class="btn btn-danger btn-bix pull-right remove-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"> <i class="fa fa-trash"></i> </button>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group" style="margin-bottom:5px;">
                                                <span class="input-group-addon beautiful" style="width: 95px;height: 32px;">Quantity</span>
                                                <div class="form-inline" style="">
                                                    <div style="width:82px;float:left;">
                                                        <label></label>
                                                        <input type="text" class="form-control mylos" placeholder="Quantity" name="herbals[<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
][mdoza]" value="<?php echo $_smarty_tpl->tpl_vars['herbal']->value->mdoza;?>
">
                                                    </div>
                                                    <div style="width:95px;float:left;">
                                                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="herbals[<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
][vdoza]">
                                                            <option value="">Dose unit</option>
                                                            <?php if ($_smarty_tpl->tpl_vars['unit']->value) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['unit']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
                                                            <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
" <?php if ($_smarty_tpl->tpl_vars['herbal']->value->vdoza == $_smarty_tpl->tpl_vars['value']->value->id) {?>selected="selected"<?php }?> data-code="<?php echo $_smarty_tpl->tpl_vars['value']->value->short_name;?>
" data-subtext="<?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
"><?php echo $_smarty_tpl->tpl_vars['value']->value->short_name;?>
</option>
                                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>
 <?php }?>
                                                        </select>
                                                    </div>
                                                    <div style="width:95px;float:left;">
                                                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="herbals[<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
][part]">
                                                            <option class="bs-title-option" value="">Herb part</option>
                                                            <?php if ($_smarty_tpl->tpl_vars['herb_parts']->value) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['herb_parts']->value, 'herb_part', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['herb_part']->value) {
?>
                                                            <option value="<?php echo $_smarty_tpl->tpl_vars['herb_part']->value->id;?>
" <?php if ($_smarty_tpl->tpl_vars['herbal']->value->part == $_smarty_tpl->tpl_vars['herb_part']->value->id) {?>selected="selected"<?php }?> data-code="<?php echo $_smarty_tpl->tpl_vars['herb_part']->value->name;?>
" title="<?php echo $_smarty_tpl->tpl_vars['herb_part']->value->name;?>
"><?php echo $_smarty_tpl->tpl_vars['herb_part']->value->name;?>
</option>
                                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>
 <?php }?>
                                                        </select>
                                                    </div>
                                                    <div style="width:95px;float:left;">
                                                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="herbals[<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
][form]">
                                                            <option class="bs-title-option" value="">Herb form</option>
                                                            <?php if ($_smarty_tpl->tpl_vars['herb_forms']->value) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['herb_forms']->value, 'herb_form', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['herb_form']->value) {
?>
                                                            <option value="<?php echo $_smarty_tpl->tpl_vars['herb_form']->value->id;?>
" <?php if ($_smarty_tpl->tpl_vars['herbal']->value->form == $_smarty_tpl->tpl_vars['herb_form']->value->id) {?>selected="selected"<?php }?> data-code="<?php echo $_smarty_tpl->tpl_vars['herb_form']->value->name;?>
" title="<?php echo $_smarty_tpl->tpl_vars['herb_form']->value->name;?>
"><?php echo $_smarty_tpl->tpl_vars['herb_form']->value->name;?>
</option>
                                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>
 <?php }?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="clearfix"></div>

                                    <?php $_smarty_tpl->_assignInScope('count', $_smarty_tpl->tpl_vars['count']->value+1);
?> <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>
 <?php }?> <?php $_smarty_tpl->_assignInScope('animals', json_decode($_smarty_tpl->tpl_vars['product']->value->animal));
?> <?php if (!empty($_smarty_tpl->tpl_vars['animals']->value)) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['animals']->value, 'animal');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['animal']->value) {
?>
                                    <div class="form-group vared label_<?php echo $_smarty_tpl->tpl_vars['animal']->value->id;?>
">
                                        <div class="col-md-2 no-padding label_add_prod">
                                            <label>Ingredient <?php echo $_smarty_tpl->tpl_vars['count']->value;?>
</label>
                                            <input type="hidden" name="animals[<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
][id]" value="<?php echo $_smarty_tpl->tpl_vars['animal']->value->id;?>
">
                                        </div>
                                        <div class="col-md-3 no-padding">
                                            <div class="input-group">
                                                <span class="input-group-addon beautiful" style="width:101px;">Animal</span>
                                                <input type="text" class="form-control fix-inputgroup" value="<?php echo get_animal_name($_smarty_tpl->tpl_vars['animal']->value->id);?>
" reaadonly disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-1" style="border-right:1px solid rgb(209, 209, 209);">
                                            <button type="button" class="btn btn-danger btn-bix pull-right remove-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"> <i class="fa fa-trash"></i> </button>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group" style="margin-bottom:5px;">
                                                <span class="input-group-addon beautiful" style="width: 95px;height: 32px;">Quantity</span>
                                                <div class="form-inline" style="">
                                                    <div style="width:82px;float:left;">
                                                        <label></label>
                                                        <input type="text" class="form-control mylos" placeholder="Quantity" name="animals[<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
][mdoza]" value="<?php echo $_smarty_tpl->tpl_vars['animal']->value->mdoza;?>
">
                                                    </div>
                                                    <div style="width:95px;float:left;">
                                                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="animals[<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
][vdoza]">
                                                            <option value="">Dose unit</option>
                                                            <?php if ($_smarty_tpl->tpl_vars['unit']->value) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['unit']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
                                                            <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
" <?php if ($_smarty_tpl->tpl_vars['animal']->value->vdoza == $_smarty_tpl->tpl_vars['value']->value->id) {?>selected="selected"<?php }?> data-code="<?php echo $_smarty_tpl->tpl_vars['value']->value->short_name;?>
" data-subtext="<?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
"><?php echo $_smarty_tpl->tpl_vars['value']->value->short_name;?>
</option>
                                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>
 <?php }?>
                                                        </select>
                                                    </div>
                                                    <div style="width:95px;float:left;">
                                                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="animals[<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
][part]">
                                                            <option class="bs-title-option" value="">Animal part</option>
                                                            <?php if ($_smarty_tpl->tpl_vars['animal_parts']->value) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['animal_parts']->value, 'animal_part', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['animal_part']->value) {
?>
                                                            <option value="<?php echo $_smarty_tpl->tpl_vars['animal_part']->value->id;?>
" <?php if ($_smarty_tpl->tpl_vars['animal']->value->part == $_smarty_tpl->tpl_vars['animal_part']->value->id) {?>selected="selected"<?php }?> data-code="<?php echo $_smarty_tpl->tpl_vars['animal_part']->value->name;?>
" title="<?php echo $_smarty_tpl->tpl_vars['animal_part']->value->name;?>
"><?php echo $_smarty_tpl->tpl_vars['animal_part']->value->name;?>
</option>
                                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>
 <?php }?>
                                                        </select>
                                                    </div>
                                                    <div style="width:95px;float:left;">
                                                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="animals[<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
][form]">
                                                            <option class="bs-title-option" value="">Animal form</option>
                                                            <?php if ($_smarty_tpl->tpl_vars['animal_forms']->value) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['animal_forms']->value, 'animal_form', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['animal_form']->value) {
?>
                                                            <option value="<?php echo $_smarty_tpl->tpl_vars['animal_form']->value->id;?>
" <?php if ($_smarty_tpl->tpl_vars['animal']->value->form == $_smarty_tpl->tpl_vars['animal_form']->value->id) {?>selected="selected"<?php }?> data-code="<?php echo $_smarty_tpl->tpl_vars['animal_form']->value->name;?>
" title="<?php echo $_smarty_tpl->tpl_vars['animal_form']->value->name;?>
"><?php echo $_smarty_tpl->tpl_vars['animal_form']->value->name;?>
</option>
                                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>
 <?php }?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="clearfix"></div>

                                    <?php $_smarty_tpl->_assignInScope('count', $_smarty_tpl->tpl_vars['count']->value+1);
?> <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>
 <?php }?> <?php $_smarty_tpl->_assignInScope('cass', json_decode($_smarty_tpl->tpl_vars['product']->value->cas));
?> <?php if (!empty($_smarty_tpl->tpl_vars['cass']->value)) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cass']->value, 'cas');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['cas']->value) {
?>
                                    <div class="form-group cas-add-row vared label_<?php echo $_smarty_tpl->tpl_vars['cas']->value->id;?>
">
                                        <div class="col-md-2 no-padding label_add_prod">
                                            <label>Ingredient <?php echo $_smarty_tpl->tpl_vars['count']->value;?>
</label>
                                            <input type="hidden" name="cass[<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
][id]" value="<?php echo $_smarty_tpl->tpl_vars['cas']->value->id;?>
">
                                        </div>
                                        <div class="col-md-3 no-padding">
                                            <div class="input-group">
                                                <span class="input-group-addon beautiful" style="width:101px;">CAS No</span>
                                                <input type="text" class="form-control fix-inputgroup" value="<?php echo get_cas_no($_smarty_tpl->tpl_vars['cas']->value->id);?>
" reaadonly disabled>
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-addon beautiful" style="width:101px;">Formula</span>
                                                <input type="text" class="form-control fix-inputgroup" value="<?php echo get_cas_formula($_smarty_tpl->tpl_vars['cas']->value->id);?>
" reaadonly disabled>
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-addon beautiful" style="width:101px;">Name</span>
                                                <input type="text" class="form-control fix-inputgroup" value="<?php echo get_cas_name($_smarty_tpl->tpl_vars['cas']->value->id);?>
" reaadonly disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-1" style="border-right:1px solid rgb(209, 209, 209);">
                                            <button type="button" class="btn btn-danger btn-bix pull-right remove-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"> <i class="fa fa-trash"></i> </button>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group" style="margin-bottom:5px;">
                                                <span class="input-group-addon beautiful" style="width: 95px;height: 32px;">Purity</span>
                                                <div class="form-inline" style="height:34px">
                                                    <div class="form-group">
                                                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="cass[<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
][purity_unit]" style="z-index:1040;">
                                                            <?php if ($_smarty_tpl->tpl_vars['puritys']->value) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['puritys']->value, 'purity', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['purity']->value) {
?>
                                                            <option value="<?php echo $_smarty_tpl->tpl_vars['purity']->value->id;?>
" <?php if ($_smarty_tpl->tpl_vars['cas']->value->purity_unit == $_smarty_tpl->tpl_vars['purity']->value->id) {?>selected="selected"<?php }?> data-code="<?php echo $_smarty_tpl->tpl_vars['purity']->value->code;?>
"> <?php echo $_smarty_tpl->tpl_vars['purity']->value->code;?>
 </option>
                                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>
 <?php }?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label></label>
                                                        <input type="text" class="form-control" placeholder="purity (%)" name="cass[<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
][purity]" value="<?php echo $_smarty_tpl->tpl_vars['cas']->value->purity;?>
">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="input-group" style="margin-bottom:5px;">
                                                <span class="input-group-addon beautiful" style="width: 95px;height: 32px;">Quantity</span>
                                                <div class="form-inline" style="">
                                                    <div style="width:82px;float:left;">
                                                        <label></label>
                                                        <input type="text" class="form-control mylos" placeholder="Quantity" name="cass[<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
][mdoza]" value="<?php echo $_smarty_tpl->tpl_vars['cas']->value->mdoza;?>
">
                                                    </div>
                                                    <div style="width:95px;float:left;">
                                                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="cass[<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
][vdoza]">
                                                            <option value="">Dose unit</option>
                                                            <?php if ($_smarty_tpl->tpl_vars['unit']->value) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['unit']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
                                                            <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
" <?php if ($_smarty_tpl->tpl_vars['cas']->value->vdoza == $_smarty_tpl->tpl_vars['value']->value->id) {?>selected="selected"<?php }?> data-code="<?php echo $_smarty_tpl->tpl_vars['value']->value->short_name;?>
" data-subtext="<?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
"><?php echo $_smarty_tpl->tpl_vars['value']->value->short_name;?>
</option>
                                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>
 <?php }?>
                                                        </select>
                                                    </div>
                                                    <div style="width:20px;float:left;">
                                                        <?php if ($_smarty_tpl->tpl_vars['cas']->value->mdoza2) {?>
                                                        <button type="button" class="minus_item" style="display:block !important">-</button>
                                                        <button type="button" class="plus_item" data-id="`+count+`" data-type="cass" style="display: none;">+</button>
                                                        <?php } else { ?>
                                                        <button type="button" class="plus_item" data-id="`+count+`" data-type="cass">+</button>
                                                          <button type="button" class="minus_item" style="display:none">-</button>
                                                        <?php }?>
                                                    </div>
                                                    <div style="width:45%;float:left;" class="extra-mg">
                                                        <?php if ($_smarty_tpl->tpl_vars['cas']->value->mdoza2) {?>
                                                        <div class="col-sm-6 no-padding">
                                                            <input type="text" class="form-control mylos" placeholder="Quantity" name="cass[<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
][mdoza2]" value="<?php echo $_smarty_tpl->tpl_vars['cas']->value->mdoza2;?>
">
                                                        </div>
                                                        <div class="col-sm-6 no-padding">
                                                            <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="cass[<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
][vdoza2]">
                                                                <option value="">Volume unit</option>
                                                                <?php if ($_smarty_tpl->tpl_vars['unit']->value) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['unit']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
                                                                <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
" <?php if ($_smarty_tpl->tpl_vars['cas']->value->vdoza2 == $_smarty_tpl->tpl_vars['value']->value->id) {?>selected="selected"<?php }?> data-code="<?php echo $_smarty_tpl->tpl_vars['value']->value->short_name;?>
" data-subtext="<?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
"><?php echo $_smarty_tpl->tpl_vars['value']->value->short_name;?>
</option>
                                                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>
 <?php }?>
                                                            </select>
                                                        </div>
                                                        <?php }?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="input-group" style="width: 740px;margin-bottom:5px;">
                                                <span class="input-group-addon beautiful" style="width:85px;height: 32px;">ATC Code</span>
                                                <div class="form-inline" style="">
                                                    <input type="text" class="form-control mylos tagsinput atc_code_input" placeholder="ATC CODE" name="" data-role="tagsinput" multiple>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <?php $_smarty_tpl->_assignInScope('count', $_smarty_tpl->tpl_vars['count']->value+1);
?> <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>
 <?php }?>

                                </div>
                                <div class="col-md-12 term-inner">
                                    <div class="form-group">
                                        <div class="col-md-12 no-padding">
                                            <div class="col-md-2 no-padding label_add_prod">
                                                <label>Add Dosage Form</label>
                                            </div>
                                            <div class="col-md-1 no-padding dossage-limit" style="width:40px;display:none;">
                                                <button type="button" class="dossage dossageForm btn-dossage" data-widget="" data-target="#dossageForm" >+</button>
                                            </div>
                                            <div class="col-md-8 no-padding dossageForm-inner">
                                                <?php $_smarty_tpl->_assignInScope('countx', 1);
?> <?php $_smarty_tpl->_assignInScope('packing_types', json_decode($_smarty_tpl->tpl_vars['product']->value->packing_type));
?> <?php if (!empty($_smarty_tpl->tpl_vars['packing_types']->value)) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['packing_types']->value, 'packing_type');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['packing_type']->value) {
?>
                                                <div class="form-group label_<?php echo $_smarty_tpl->tpl_vars['packing_type']->value->id;?>
">
                                                    <div class="col-md-5 no-padding">
                                                        <div class="input-group">
                                                            <span class="input-group-addon beautiful" style="width:101px;">Dossage</span>
                                                            <input type="text" class="form-control fix-inputgroup" style="width:100%" value="<?php echo get_packing_type_name($_smarty_tpl->tpl_vars['packing_type']->value->id);?>
" reaadonly disabled>
                                                            <input type="hidden" name="packing_types[<?php echo $_smarty_tpl->tpl_vars['countx']->value;?>
][id]" value="<?php echo $_smarty_tpl->tpl_vars['packing_type']->value->id;?>
">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1" style="border-right:1px solid rgb(209, 209, 209);">
                                                        <button type="button" class="btn btn-danger btn-bix pull-right remove-item-dossage" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"> <i class="fa fa-trash"></i> </button>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="input-group" style="margin-bottom:5px;">
                                                            <span class="input-group-addon beautiful" style="width: 95px;height: 32px;">Quantity</span>
                                                            <div class="form-inline" style="">
                                                                <div style="width:82px;float:left;">
                                                                    <label></label>
                                                                    <input type="text" class="form-control mylos" placeholder="Quantity" name="packing_types[<?php echo $_smarty_tpl->tpl_vars['countx']->value;?>
][mdoza]" value="<?php echo $_smarty_tpl->tpl_vars['packing_type']->value->mdoza;?>
">
                                                                </div>
                                                                <div style="width:95px;float:left;">
                                                                    <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="packing_types[<?php echo $_smarty_tpl->tpl_vars['countx']->value;?>
][vdoza]" title="Packing">
                                                                        <?php if ($_smarty_tpl->tpl_vars['drug_types']->value) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['drug_types']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
                                                                        <option <?php if ($_smarty_tpl->tpl_vars['packing_type']->value->vdoza == $_smarty_tpl->tpl_vars['value']->value->id) {?>selected="selected"<?php }?> value="<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
</option>
                                                                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>
 <?php }?>
                                                                    </select>
                                                                </div>
                                                                <div style="width:20px;float:left;">
                                                                    <?php if ($_smarty_tpl->tpl_vars['packing_type']->value->mdoza2) {?>
                                                                    <button type="button" class="minus_item" style="display:block !important">-</button>
                                                                     <button type="button" class="plus_item" data-id="<?php echo $_smarty_tpl->tpl_vars['countx']->value;?>
" data-type="packing_types" style="display: none;">+</button>
                                                                    <?php } else { ?>
                                                                    <button type="button" class="plus_item" data-id="<?php echo $_smarty_tpl->tpl_vars['countx']->value;?>
" data-type="packing_types">+</button>
                                                                     <button type="button" class="minus_item" style="display:none">-</button>
                                                                    <?php }?>
                                                                </div>
                                                                <div style="width:45%;float:left;" class="extra-mg">
                                                                    <?php if ($_smarty_tpl->tpl_vars['packing_type']->value->mdoza2) {?>
                                                                    <div class="col-sm-6 no-padding">
                                                                        <input type="text" class="form-control mylos" placeholder="Quantity" name="packing_types[<?php echo $_smarty_tpl->tpl_vars['countx']->value;?>
][mdoza2]" value="<?php echo $_smarty_tpl->tpl_vars['packing_type']->value->mdoza2;?>
">
                                                                    </div>
                                                                    <div class="col-sm-6 no-padding">
                                                                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="packing_types[<?php echo $_smarty_tpl->tpl_vars['countx']->value;?>
][vdoza2]">
                                                                            <option value="">Volume unit</option>
                                                                            <?php if ($_smarty_tpl->tpl_vars['unit']->value) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['unit']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
                                                                            <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
" <?php if ($_smarty_tpl->tpl_vars['packing_type']->value->vdoza2 == $_smarty_tpl->tpl_vars['value']->value->id) {?>selected="selected"<?php }?> data-code="<?php echo $_smarty_tpl->tpl_vars['value']->value->short_name;?>
" data-subtext="<?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
"><?php echo $_smarty_tpl->tpl_vars['value']->value->short_name;?>
</option>
                                                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>
 <?php }?>
                                                                        </select>
                                                                    </div>
                                                                    <?php }?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <?php $_smarty_tpl->_assignInScope('countx', $_smarty_tpl->tpl_vars['countx']->value+1);
?> <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>
 <?php }?>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="col-md-12 term-inner">
                                    <div class="form-group">
                                        <div class="col-md-12 no-padding">
                                            <div class="col-md-2 no-padding label_add_prod">
                                                <label class="medical-limit">Add Medical Classifiction</label>
                                            </div>
                                            <div class="col-md-1 no-padding medical-limit" style="width:40px;">
                                                <button type="button" class="dossage medicalClassifictionForm btn-medicalClassifiction" data-widget="" data-target="#medicalClassification"> +</button>
                                            </div>
                                            <div class="col-md-8 no-padding medicalClassifiction-inner">
                                                <?php $_smarty_tpl->_assignInScope('medical_cls', explode(',',$_smarty_tpl->tpl_vars['product']->value->medical_cl));
?> <?php $_smarty_tpl->_assignInScope('medical_cl_count', 0);
?> <?php if (!empty($_smarty_tpl->tpl_vars['medical_cls']->value)) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['medical_cls']->value, 'medical_cl');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['medical_cl']->value) {
?>
                                                <div class="form-group col-md-3 no-padding label_<?php echo $_smarty_tpl->tpl_vars['medical_cl']->value;?>
">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control mylos fix-inputgroup" value="<?php echo get_medical_classification_name($_smarty_tpl->tpl_vars['medical_cl']->value);?>
" readonly>
                                                        <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['medical_cl']->value;?>
" name="classifiction[<?php echo $_smarty_tpl->tpl_vars['medical_cl_count']->value;?>
]" readonly>
                                                        <span class="input-group-btn">
                                                            <button type="button" class="btn btn-danger btn-bix pull-right remove-item-classifiction" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"> <i class="fa fa-times"></i> </button>
                                                        </span>
                                                    </div>
                                                </div>
                                                <?php $_smarty_tpl->_assignInScope('medical_cl_count', $_smarty_tpl->tpl_vars['medical_cl_count']->value+1);
?> <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>
 <?php }?>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="col-md-12 term-inner">
                                    <div class="form-group">
                                        <div class="col-md-12 no-padding">
                                            <div class="col-md-2 no-padding label_add_prod">
                                                <label>Dossier Format</label>
                                            </div>
                                            <div class="col-md-2 no-padding">
                                                <input type="checkbox" id="BE" name="be" value="1" <?php if ($_smarty_tpl->tpl_vars['product']->value->be == 1) {?>checked="checked"<?php }?> >
                                                <label for="BE">BE</label>
                                                <input type="checkbox" id="CTD" name="ctd" value="1" <?php if ($_smarty_tpl->tpl_vars['product']->value->ctd == 1) {?>checked="checked"<?php }?> >
                                                <label for="CTD" style="margin-left:15px;">CTD</label>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="col-md-12 term-inner">
                                    <div class="form-group">
                                        <div class="col-md-12 no-padding">
                                            <div class="form-group">
                                                <div class="col-md-2 no-padding label_add_prod">
                                                    <label>Minimale Order Quantity</label>
                                                </div>
                                                <div class="col-md-2 no-padding">
                                                    <input type="text" class="form-control mylos" placeholder="Moq" name="moq" value="<?php echo $_smarty_tpl->tpl_vars['product']->value->moq;?>
">
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-2 no-padding label_add_prod">
                                                    <label>Shelf life</label>
                                                </div>
                                                <div class="col-md-1 no-padding">
                                                    <input type="text" class="form-control mylos" placeholder="Shelf life" name="shelf_life" value="<?php echo $_smarty_tpl->tpl_vars['product']->value->shelf_life;?>
">
                                                </div>
                                                <div class="col-md-2 label_add_prod">
                                                    <label> Month</label>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-2 no-padding label_add_prod">
                                                    <label>Storage</label>
                                                </div>
                                                  <div class="col-md-2 no-padding">
                                                            <select class="form-control mylos selectpicker show-menu-arrow pils storage-select" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="storage">
                                                                <option value="1">Do not store over 30 C</option>
                                                                <option value="2">Do not store over 25 C</option>
                                                                <option value="3">Do not store over 15 C</option>
                                                                <option value="4">Do not store over 8 C</option>
                                                                <option value="5">Do not store below 8 C</option>
                                                                <option value="6">Protect from moisture</option>
                                                                <option value="7">Protect from light</option>
                                                                <option value="8">Other</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input type="text" class="form-control mylos storage-input" placeholder="Storage" name="storage" style="display:none;" value="<?php echo $_smarty_tpl->tpl_vars['product']->value->storage;?>
">
                                                        </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="col-md-12 term-inner">
                                    <div class="form-group">
                                        <div class="col-md-12 no-padding">
                                            <div class="form-group" style="padding-bottom:0px;">
                                                <div class="col-md-2 no-padding label_add_prod">
                                                    <label>Add Photo</label>
                                                </div>
                                                <div class="col-md-10 no-padding">
                                                    <div class="col-md-12 no-padding img-full-right-block img_forece">
                                                        <div class="inner-img">
                                                            <?php if ($_smarty_tpl->tpl_vars['product_images']->value) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product_images']->value, 'product_image');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['product_image']->value) {
?>
                                                            <div class="img-upload-group bitrix add lab_<?php echo $_smarty_tpl->tpl_vars['product_image']->value['image_id'];?>
" var-attr="lab_<?php echo $_smarty_tpl->tpl_vars['product_image']->value['image_id'];?>
">
                                                                <div class="reload-form-cover-mini">
                                                                    <img src="<?php echo base_url('uploads');?>
/catalog/product/<?php echo $_smarty_tpl->tpl_vars['product_image']->value['image'];?>
" title="" alt="" />
                                                                    <button type="button" class="remove-image product" data-id="<?php echo $_smarty_tpl->tpl_vars['product_image']->value['image_id'];?>
"> </button>
                                                                </div>
                                                            </div>
                                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>
 <?php }?>
                                                        </div>
                                                        <div class="img-upload-group add bitrix" var-attr="">
                                                            <div class="reload-form-upload">
                                                                <label>
                                                                    <button type="button" class="add-button-photos" data-target="">+</button>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="col-md-12 no-padding term-inner">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <div class="form-group" style="padding-bottom:0px;">
                                               
                                                    <div class="col-md-12 no-padding term-inner moreInfo">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <div class="form-group" style="padding-bottom:0px;">
                                                        <div class="col-md-2 no-padding label_add_prod">
                                                            <button type="button" class="btn-moders moreInfo" data-toggle="collapse" data-target="#more-information" aria-expanded="false" aria-controls="more-information" style="width:auto">Add more information</button>
                                                        </div>
                                                        <div class="col-md-6 no-padding">
                                                            <div class="col-md-12 no-padding more-information collapse" id="more-information">
                                                                <textarea name="description" placeholder="demo" data-validation-error-msg=" " data-validation="alphanumeric " class="ckeditor" id="CKeditor" <?php if ($_smarty_tpl->tpl_vars['product']->value->description == '' || is_null($_smarty_tpl->tpl_vars['product']->value->description)) {?>style="visibility: hidden; display: none;"<?php }?>><?php echo $_smarty_tpl->tpl_vars['product']->value->description;?>
</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                              
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                     <button type="submit" class="submit-product-btn pull-right" style="margin-top:0px;border-radius:0px;margin-right: 20px">Save</button>
                                <div class="clearfix" style="margin-bottom: 30px; "></div>
                                </div>
                               
                            </div>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo '<script'; ?>
>
    function addHerbal(count, data_txt, data_no, data_formula, data_target, data_id) {
        var component =
        `<div class="form-group vared label_` + data_id + `">
            <div class="col-md-2 no-padding label_add_prod">
                <label>Ingredient ` + count + `</label>
                <input type="hidden" name="herbals[` + count + `][id]" value="` + data_id + `">
            </div>
            <div class="col-md-3 no-padding">
                <div class="input-group">
                    <span class="input-group-addon beautiful" style="width:101px;">Herbal</span>
                    <input type="text" class="form-control fix-inputgroup" value="` + data_txt + `" reaadonly disabled>
                </div>
            </div>
            <div class="col-md-1 hidden-xs" style="border-right:1px solid rgb(209, 209, 209);">
                <button type="button" class="btn btn-danger btn-bix pull-right remove-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"> <i class="fa fa-trash"></i> </button>
            </div>
            <div class="col-md-6">
                <div class="input-group" style="margin-bottom:5px;">
                    <span class="input-group-addon beautiful" style="width: 95px;height: 32px;">Quantity</span>
                    <div class="form-inline" style="">
                        <div style="width:82px;float:left;">
                            <label></label>
                            <input type="text" class="form-control mylos" placeholder="Quantity"  name="herbals[` + count + `][mdoza]">
                        </div>
                        <div style="width:95px;float:left;">
                            <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1"  name="herbals[` + count + `][vdoza]">
                                <option value="">Dose unit</option>
                                <?php if ($_smarty_tpl->tpl_vars['unit']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['unit']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
" data-code="<?php echo $_smarty_tpl->tpl_vars['value']->value->short_name;?>
" data-subtext="<?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
"><?php echo $_smarty_tpl->tpl_vars['value']->value->short_name;?>
</option>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                            </select>
                        </div>
                        <div style="width:95px;float:left;">
                            <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="herbals[` + count + `][part]">
                                <option class="bs-title-option" value="">Herb part</option>
                                <?php if ($_smarty_tpl->tpl_vars['herb_parts']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['herb_parts']->value, 'herb_part', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['herb_part']->value) {
?>
                                  <option value="<?php echo $_smarty_tpl->tpl_vars['herb_part']->value->id;?>
" data-code="<?php echo $_smarty_tpl->tpl_vars['herb_part']->value->name;?>
" title="<?php echo $_smarty_tpl->tpl_vars['herb_part']->value->name;?>
"><?php echo $_smarty_tpl->tpl_vars['herb_part']->value->name;?>
</option>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                            </select>
                        </div>
                        <div style="width:95px;float:left;">
                            <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="herbals[` + count + `][form]">
                                <option class="bs-title-option" value="">Herb form</option>
                                <?php if ($_smarty_tpl->tpl_vars['herb_forms']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['herb_forms']->value, 'herb_form', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['herb_form']->value) {
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['herb_form']->value->id;?>
" data-code="<?php echo $_smarty_tpl->tpl_vars['herb_form']->value->name;?>
" title="<?php echo $_smarty_tpl->tpl_vars['herb_form']->value->name;?>
"><?php echo $_smarty_tpl->tpl_vars['herb_form']->value->name;?>
</option>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                           </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>`;
        return component;
    }
    function addAnimal(count, data_txt, data_no, data_formula, data_target, data_id) {
    var component =
    `<div class="form-group vared label_` + data_id + `">
        <div class="col-md-2 no-padding label_add_prod">
            <label>Ingredient ` + count + `</label>
            <input type="hidden" name="animals[` + count + `][id]" value="` + data_id + `">
        </div>
        <div class="col-md-3 no-padding">
            <div class="input-group">
                <span class="input-group-addon beautiful" style="width:101px;">Animal</span>
                <input type="text" class="form-control fix-inputgroup" value="` + data_txt + `" reaadonly disabled>
            </div>
        </div>
        <div class="col-md-1 hidden-xs" style="border-right:1px solid rgb(209, 209, 209);">
            <button type="button" class="btn btn-danger btn-bix pull-right remove-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"> <i class="fa fa-trash"></i> </button>
        </div>
        <div class="col-md-6">
            <div class="input-group" style="margin-bottom:5px;">
                <span class="input-group-addon beautiful" style="width: 95px;height: 32px;">Quantity</span>
                <div class="form-inline" style="">
                    <div style="width:82px;float:left;">
                        <label></label>
                        <input type="text" class="form-control mylos" placeholder="Quantity"  name="animals[` + count + `][mdoza]">
                    </div>
                    <div style="width:95px;float:left;">
                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1"  name="animals[` + count + `][vdoza]">
                            <option value="">Dose unit</option>
                            <?php if ($_smarty_tpl->tpl_vars['unit']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['unit']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
" data-code="<?php echo $_smarty_tpl->tpl_vars['value']->value->short_name;?>
" data-subtext="<?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
"><?php echo $_smarty_tpl->tpl_vars['value']->value->short_name;?>
</option>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                        </select>
                    </div>
                    <div style="width:95px;float:left;">
                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="animals[` + count + `][part]">
                            <option class="bs-title-option" value="">Animal part</option>
                            <?php if ($_smarty_tpl->tpl_vars['animal_parts']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['animal_parts']->value, 'animal_part', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['animal_part']->value) {
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['animal_part']->value->id;?>
" data-code="<?php echo $_smarty_tpl->tpl_vars['animal_part']->value->name;?>
" title="<?php echo $_smarty_tpl->tpl_vars['animal_part']->value->name;?>
"><?php echo $_smarty_tpl->tpl_vars['animal_part']->value->name;?>
</option>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                        </select>
                    </div>
                    <div style="width:95px;float:left;">
                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="animals[` + count + `][form]">
                            <option class="bs-title-option" value="">Animal form</option>
                            <?php if ($_smarty_tpl->tpl_vars['animal_forms']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['animal_forms']->value, 'animal_form', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['animal_form']->value) {
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['animal_form']->value->id;?>
" data-code="<?php echo $_smarty_tpl->tpl_vars['animal_form']->value->name;?>
" title="<?php echo $_smarty_tpl->tpl_vars['animal_form']->value->name;?>
"><?php echo $_smarty_tpl->tpl_vars['animal_form']->value->name;?>
</option>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>`;
    return component;
    }
    function addChermical(count, data_txt, data_no, data_formula, data_target, data_id) {
        var component =
        `<div class="form-group vared label_`+data_id+`">
            <div class="col-md-2 no-padding label_add_prod">
                <label>Ingredient ` + count + `</label>
                <input type="hidden" name="atc_codes[` + count + `][id]" value="` + data_id + `">
            </div>
            <div class="col-md-3 no-padding">
                <div class="input-group">
                    <span class="input-group-addon beautiful" style="width:101px;">Atc code</span>
                    <input type="text" class="form-control fix-inputgroup" value="`+data_no+`" reaadonly disabled>
                </div>
                <div class="input-group">
                    <span class="input-group-addon beautiful" style="width:101px;">NAME</span>
                    <input type="text" class="form-control fix-inputgroup" value="`+data_txt+`" reaadonly disabled>
                </div>
            </div>
            <div class="col-md-1 hidden-xs" style="border-right:1px solid rgb(209, 209, 209);">
                <button type="button" class="btn btn-danger btn-bix pull-right remove-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"> <i class="fa fa-trash"></i> </button>
            </div>
            <div class="col-md-6">
                <div class="input-group" style="margin-bottom:5px;">
                    <span class="input-group-addon beautiful" style="width: 95px;height: 32px;">Quantity</span>
                    <div class="form-inline" style="">
                        <div style="width:82px;float:left;">
                            <label></label>
                            <input type="text" class="form-control mylos" placeholder="Quantity"  name="atc_codes[` + count + `][mdoza]">
                        </div>
                        <div style="width:95px;float:left;">
                            <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1"  name="atc_codes[` + count + `][vdoza]">
                                <option value="">Dose unit</option>
                                <?php if ($_smarty_tpl->tpl_vars['unit']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['unit']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
" data-code="<?php echo $_smarty_tpl->tpl_vars['value']->value->short_name;?>
" data-subtext="<?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
"><?php echo $_smarty_tpl->tpl_vars['value']->value->short_name;?>
</option>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                            </select>
                        </div>
                        <div style="width:20px;float:left;">
                            <button type="button" class="plus_item" data-id="` + count + `" data-type="atc_codes">+</button>
                            <button type="button" class="minus_item">-</button>
                        </div>
                        <div style="width:45%;float:left;" class="extra-mg"></div>
                    </div>
                </div>`;
                 if($('select[name="pr_type"]').val() != 3){
                   component+= `<div class="input-group" style="margin-bottom:5px;">
                    <span class="input-group-addon beautiful" style="width: 95px;height: 32px;">Purity</span>
                    <div class="form-inline" style="height:34px">
                        <div class="form-group">
                            <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="atc_codes[` + count + `][purity_unit]" style="z-index:1040;">
                                <?php if ($_smarty_tpl->tpl_vars['puritys']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['puritys']->value, 'purity', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['purity']->value) {
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['purity']->value->id;?>
" data-code="<?php echo $_smarty_tpl->tpl_vars['purity']->value->code;?>
"> <?php echo $_smarty_tpl->tpl_vars['purity']->value->code;?>
 </option>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label></label>
                            <input type="text" class="form-control" placeholder="purity (%)" name="atc_codes[` + count + `][purity]">
                        </div>
                    </div>
                </div>`;
                }
                component+=`</div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>`;
        return component;
    }
    function addDossageForm(count, data_txt, data_no, data_formula, data_target, data_id) {
        var component =
        `<div class="form-group label_` + data_id + `" style="padding-bottom: 0px;">
            <div class="col-md-5 no-padding">
                <div class="input-group">
                    <span class="input-group-addon beautiful" style="width:101px;">Dossage</span>
                    <input type="text" class="form-control fix-inputgroup" style="width:100%" value="` + data_txt + `" reaadonly disabled>
                    <input type="hidden" name="packing_types[` + count + `][id]" value="` + data_id + `">
                </div>
            </div>
            <div class="col-md-1 hidden-xs" style="border-right:1px solid rgb(209, 209, 209);">
                <button type="button" class="btn btn-danger btn-bix pull-right remove-item-dossage" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"> <i class="fa fa-trash"></i> </button>
            </div>
            <div class="col-md-6">
                <div class="input-group" style="margin-bottom:5px;">
                    <span class="input-group-addon beautiful" style="width: 95px;height: 32px;">Quantity</span>
                    <div class="form-inline" style="">
                        <div style="width:82px;float:left;">
                            <label></label>
                            <input type="text" class="form-control mylos" placeholder="Quantity"  name="packing_types[` + count + `][mdoza]">
                        </div>
                        <div style="width:95px;float:left;">
                            <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1"  name="packing_types[` + count + `][vdoza]" title="Packing">
                                <?php if ($_smarty_tpl->tpl_vars['drug_types']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['drug_types']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
</option>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                            </select>
                        </div>
                        <div style="width:20px;float:left;">
                            <button type="button" class="plus_item" data-id="` + count + `" data-type="packing_types">+</button>
                            <button type="button" class="minus_item">-</button>
                        </div>
                        <div style="width:33%;float:left;" class="extra-mg"></div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>`;
        return component;
    }
    function addmedicalClassification(count, data_txt, data_no, data_formula, data_target, data_id) {
        var component =
        `<div class="form-group col-md-3 no-padding label_` + data_id + `">
            <div class="input-group">
                <input type="text" class="form-control mylos fix-inputgroup" value="` + data_txt + `" readonly>
                <input type="hidden" value="` + data_id + `" name="classifiction[` + count + `]" readonly>
                <span class="input-group-btn">
                      <button type="button" class="btn btn-danger btn-bix pull-right remove-item-classifiction" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"> <i class="fa fa-times"></i> </button>
                </span>
            </div>
        </div>`;
        return component;
    }
    function addCasNumber(count, data_txt, data_no, data_formula, data_target, data_id) {
        var component =
        `<div class="form-group cas-add-row vared label_` + data_id + `">
            <div class="col-md-2 no-padding label_add_prod">
                <label>Ingredient ` + count + `</label>
                <input type="hidden" name="cass[` + count + `][id]" value="` + data_id + `">
            </div>
            <div class="col-md-3 no-padding">
                <div class="input-group">
                    <span class="input-group-addon beautiful" style="width:101px;">CAS No</span>
                    <input type="text" class="form-control fix-inputgroup" value="`+data_no+`" reaadonly disabled>
                </div>
                <div class="input-group">
                    <span class="input-group-addon beautiful" style="width:101px;">Formula</span>
                    <input type="text" class="form-control fix-inputgroup" value="`+data_formula+`" reaadonly disabled>
                </div>
                <div class="input-group">
                    <span class="input-group-addon beautiful" style="width:101px;">Name</span>
                    <input type="text" class="form-control fix-inputgroup" value="`+data_txt+`" reaadonly disabled>
                </div>
            </div>
            <div class="col-md-1 hidden-xs" style="border-right:1px solid rgb(209, 209, 209);">
                <button type="button" class="btn btn-danger btn-bix pull-right remove-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"> <i class="fa fa-trash"></i> </button>
            </div>
            <div class="col-md-6">
                <div class="input-group" style="margin-bottom:5px;">
                    <span class="input-group-addon beautiful" style="width: 95px;height: 32px;">Purity</span>
                    <div class="form-inline" style="height:34px">
                        <div class="form-group">
                            <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="cass[` + count + `][purity_unit]" style="z-index:1040;">
                                <?php if ($_smarty_tpl->tpl_vars['puritys']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['puritys']->value, 'purity', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['purity']->value) {
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['purity']->value->id;?>
" data-code="<?php echo $_smarty_tpl->tpl_vars['purity']->value->code;?>
"> <?php echo $_smarty_tpl->tpl_vars['purity']->value->code;?>
 </option>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label></label>
                            <input type="text" class="form-control" placeholder="purity (%)" name="cass[` + count + `][purity]">
                        </div>
                    </div>
                </div>
                <div class="input-group" style="margin-bottom:5px;">
                    <span class="input-group-addon beautiful" style="width: 95px;height: 32px;">Quantity</span>
                    <div class="form-inline" style="">
                        <div style="width:82px;float:left;">
                            <label></label>
                            <input type="text" class="form-control mylos" placeholder="Quantity"  name="cass[` + count + `][mdoza]">
                        </div>
                        <div style="width:95px;float:left;">
                            <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1"  name="cass[` + count + `][vdoza]">
                                <option value="">Dose unit</option>
                                <?php if ($_smarty_tpl->tpl_vars['unit']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['unit']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
" data-code="<?php echo $_smarty_tpl->tpl_vars['value']->value->short_name;?>
" data-subtext="<?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
"><?php echo $_smarty_tpl->tpl_vars['value']->value->short_name;?>
</option>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                            </select>
                        </div>
                        <div style="width:20px;float:left;">
                            <button type="button" class="plus_item" data-id="` + count + `" data-type="cass">+</button>
                            <button type="button" class="minus_item">-</button>
                        </div>
                        <div style="width:45%;float:left;" class="extra-mg"></div>
                    </div>
                </div>
                <div class="input-group" style="width: 740px;margin-bottom:5px;">
                    <span class="input-group-addon beautiful" style="width:85px;height: 32px;">ATC Code</span>
                    <div class="form-inline" style="">
                         <input type="text" class="form-control mylos tagsinput atc_code_input" placeholder="ATC CODE" name="" data-role="tagsinput" multiple>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>`;
        return component;
    }
    $(document).on('click', '.plus_item', function() {
        var data_id = $(this).data('id');
        var data_type = $(this).data('type');
        var component =
        `<div class="col-sm-6 no-padding">
            <input type="text" class="form-control mylos" placeholder="Quantity" name="` + data_type + `[` + data_id + `][mdoza2]" value="1">
         </div>
         <div class="col-sm-6 no-padding">
            <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="` + data_type + `[` + data_id + `][vdoza2]">
                <option value="">Volume unit</option>
                <?php if ($_smarty_tpl->tpl_vars['unit']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['unit']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
" data-code="<?php echo $_smarty_tpl->tpl_vars['value']->value->short_name;?>
" data-subtext="<?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
"><?php echo $_smarty_tpl->tpl_vars['value']->value->short_name;?>
</option>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
            </select>
         </div>`;
        $(this).hide();
        $('.selectpicker').selectpicker();
        $(this).parent().find('.minus_item').show();
        $(this).parents('.input-group').find('div.extra-mg').show();
    });
    $(document).on('click', '.minus_item', function() {
        $(this).hide();
        $(this).parent().find('.plus_item').show();
        $(this).parent().parent().find('div.extra-mg').hide();
    });
    
    function getChemical(param) {
        return $.ajax({
            type:'POST',
            url:site_url+'product/get_chemical/',
            data: {'chemical_id':param},
            async: false
        });
    }
    function getHerbal(param) {
        return $.ajax({
            type:'POST',
            url:site_url+'product/get_herbal/',
            data: {'herbal_id':param},
            async: false
        });
    }
    function getAnimal(param) {
        return $.ajax({
            type:'POST',
            url:site_url+'product/get_animal/',
            data: {'animal_id':param},
            async: false
        });
    }
    function getCasNumber(param) {
        return $.ajax({
            type:'POST',
            url:site_url+'product/get_cas_number/',
            data: {'cas_number_id':param},
            async: false
        });
    }
    function getPackingType(param) {
        return $.ajax({
            type:'POST',
            url:site_url+'product/get_packing_type/',
            data: {'packing_type_id':param},
            async: false
        });
    }
    function getMedicalClass(param) {
        return $.ajax({
            type:'POST',
            url:site_url+'product/get_medical_class/',
            data: {'medical_id':param},
            async: false
        });
    }
    function getProductType(param) {
        return $.ajax({
            type:'POST',
            url:site_url+'product/get_product_type/',
            data: {'product_type_id':param},
            async: false
        });
    }
    function getUnitName(param) {
        return $.ajax({
            type:'POST',
            url:site_url+'product/volume_unit/',
            data: {'unit_id':param},
            async: false
        });
    }
    
<?php echo '</script'; ?>
>

    
    <?php echo '<script'; ?>
 type="text/javascript">
        $(document).ready(function(){
            var fin = [];
           if($('.cas-add-row').length){
            $('.casNumber').addClass('disabled').prop('disabled',true);
           }
                var selected =$('select.product_type_select').find('option:selected').val();
                if(selected != 0){
                    $.isLoading({text:""});
                  
                    $('.brandname').removeAttr('disabled');
                    $('.content_add').show();
                    $.ajax({
                    type:'POST',
                        url: site_url + 'product/type/',
                        data: {'value':selected},
                        cache:false,
                        success:function(data){
                            var obj = jQuery.parseJSON(data);
                            json = {
                                id : obj[0].id,
                                name : obj[0].name,
                                settings : [{
                                    visible : [{
                                        chemical : obj[0].chemical_visible,
                                        herbal : obj[0].herbal_visible,
                                        animal : obj[0].animal_visible,
                                        casNumber : obj[0].casNumber_visible,
                                        dossageForm : obj[0].dossageForm_visible,
                                        medicalClassifiction : obj[0].medicalClassifiction_visible,
                                        moreInfo : obj[0].moreInfo_visible,
                                        brandName : obj[0].brandName_visible,
                                        country : obj[0].country_visible,
                                    }],
                                    multiple : [{
                                        chemical : obj[0].chemical_multiple,
                                        herbal : obj[0].herbal_multiple,
                                        casNumber : obj[0].casNumber_multiple,
                                        dossageForm : obj[0].dossageForm_multiple,
                                        medicalClassifiction : obj[0].medicalClassifiction_multiple
                                    }]
                                }]
                            };
                            $.removeCookie('setting');
                            $.cookie.json = true;
                            $.cookie('setting', json);
                            $.each(json.settings[0].visible[0], function(key, value) {
                                if (value == '1'){$('.' + key).show();}
                                else{$('.' + key).hide();}
                            });
                            setTimeout(function(){$.isLoading("hide"); }, 1000);

                        },
                        error: function(){
                            setTimeout(function(){$.isLoading("hide"); }, 1000);
                        }
                    });
                  
                }
                else{
                    $('.brandname').attr('disabled','disabled');
                    $('.content_add').hide();
                }
          
        });

        $('select.product_type_select').trigger('change');

        function finaly(_this)
        {
            $.isLoading({text: ""});
            $('.btn-dossage').removeClass('active');
            $('.target').removeClass('active');
            _this.addClass('active');
            var target = _this.attr('data-target');
            $('.periodic').removeClass('in');
            $(target).addClass('in');
            $('.search-inner').html('<span style="color:red;margin-left:-300px;">Select ' +target + ' items</span>').find('span').animate({marginLeft: "0px"}, 500);
            $('.search-tool').addClass('col-md-3');
            $('.search-tool').show();
            $('.specilation').removeClass('col-md-12');
            $('.specilation').addClass('col-md-9');
            $('.specilation').append('<div class="blackstack" style="position: absolute; top: 0; right: 0; bottom: 0; left: 0; z-index: 1040; background-color: #000;opacity:.6;"></div>');
            setTimeout(function () { $.isLoading("hide"); }, 200);
            $('.module-search').val('');
            $('.module-search').css('border', '1px solid red').trigger( "focus" );
        }

        $(document).on('click', '.target , .dossage', function () {
            var cookies = $.cookie('setting');
            var brandname = $('.brandname');
            console.log(cookies);
            if(cookies.settings[0].visible[0].brandName == '1')
            {
                brandname.attr('required');
                if(brandname.val() == '')
                {
                    brandname.css('border','1px solid red');
                }
                else{
                    brandname.removeAttr('style');
                    finaly($(this));
                }
            }else{
                finaly($(this));
            }
        });

    <?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 type="text/javascript">
    var fore = 0;
    var count = <?php echo $_smarty_tpl->tpl_vars['count']->value;?>
;
    var general = <?php echo $_smarty_tpl->tpl_vars['parent_cal']->value;?>
;
    var come = 0;
    var chemicalcount = 0;
    var herbalcount = 0;
    var animalcount = 0;
    var dossageFormCount = 0;
    var medicalClassificationCount = 0;
    
    $(document).on('click keydown', '.discom ul.in li', function(e) {

            if (!$(this).hasClass('selected')) {
                e.preventDefault();
                $(this).addClass('selected');
                var data_txt        = $(this).attr('data-txt');
                var data_target     = $(this).attr('data-target');
                var data_id         = $(this).attr('data-id');
                var data_no         = $(this).attr('data-no');
                var data_formula    = $(this).attr('data-formula');
                var cookies         = $.cookie('setting');
                //console.log(cookies);
                if(data_target == 'chemical')
                {
                    if(cookies.settings[0].multiple[0].chemical == '1')
                    {
                        var component = addChermical(count, data_txt,data_no, data_formula , data_target, data_id);
                        $('.frist-inner').append(component);
                        $('.selectpicker').selectpicker();
                        $('.search-tool').removeClass('col-md-3');
                        $('.specilation').addClass('col-md-12');
                        $('.specilation').removeClass('col-md-9');
                        $('.blackstack').remove();
                        $('.search-tool').hide();

                        $(".two-column").slideDown( "slow", function(){});
                        count += 1;
                        chemicalcount +=1;
                    }
                    else
                    {
                        if(chemicalcount < 1)
                        {
                            var component = addChermical(count, data_txt,data_no, data_formula , data_target, data_id);
                            $('.frist-inner').append(component);
                            $('.selectpicker').selectpicker();
                            $('.search-tool').removeClass('col-md-3');
                            $('.specilation').addClass('col-md-12');
                            $('.specilation').removeClass('col-md-9');
                            $('.blackstack').remove();
                            $('.search-tool').hide();
                            $(".two-column").slideDown( "slow", function(){});
                            chemicalcount +=1;
                        }
                    }
                }
                else if(data_target == 'herbal')
                {
                    if(cookies.settings[0].multiple[0].herbal == '1')
                    {
                        var component = addHerbal(count, data_txt,data_no, data_formula , data_target, data_id);
                        $('.frist-inner').append(component);
                        $('.selectpicker').selectpicker();
                        $('.search-tool').removeClass('col-md-3');
                        $('.specilation').addClass('col-md-12');
                        $('.specilation').removeClass('col-md-9');
                        $('.blackstack').remove();
                        $('.search-tool').hide();

                        $(".two-column").slideDown( "slow", function(){});
                        count += 1;
                        herbalcount += 1;
                    }
                    else
                    {
                        if(herbalcount < 1)
                        {
                            var component = addHerbal(count, data_txt,data_no, data_formula , data_target, data_id);
                            $('.frist-inner').append(component);
                            $('.selectpicker').selectpicker();
                            $('.search-tool').removeClass('col-md-3');
                            $('.specilation').addClass('col-md-12');
                            $('.specilation').removeClass('col-md-9');
                            $('.blackstack').remove();
                            $('.search-tool').hide();

                            $(".two-column").slideDown( "slow", function(){});
                            herbalcount += 1;
                        }
                    }
                }
                else if (data_target == 'animal')
                {
                    if(cookies.settings[0].multiple[0].animal == '1')
                    {
                        var component = addAnimal(count, data_txt,data_no, data_formula , data_target, data_id);
                        $('.frist-inner').append(component);
                        $('.selectpicker').selectpicker();
                        $('.search-tool').removeClass('col-md-3');
                        $('.specilation').addClass('col-md-12');
                        $('.specilation').removeClass('col-md-9');
                        $('.blackstack').remove();
                        $('.search-tool').hide();

                        $(".two-column").slideDown( "slow", function(){});
                        count += 1;
                        animalcount += 1;
                    }
                    else
                    {
                        if(animalcount < 1)
                        {
                            var component = addAnimal(count, data_txt,data_no, data_formula , data_target, data_id);
                            $('.frist-inner').append(component);
                            $('.selectpicker').selectpicker();
                            $('.search-tool').removeClass('col-md-3');
                            $('.specilation').addClass('col-md-12');
                            $('.specilation').removeClass('col-md-9');
                            $('.blackstack').remove();
                            $('.search-tool').hide();

                            $(".two-column").slideDown( "slow", function(){});
                            count += 1;
                            animalcount += 1;
                        }
                    }
                }
                else if (data_target == 'casNumber')
                {
                    if(cookies.settings[0].multiple[0].casNumber == '1')
                    {
                        var component = addCasNumber(count, data_txt,data_no, data_formula , data_target, data_id);
                        $('.frist-inner').append(component);
                        $('.selectpicker').selectpicker();
                        var citynames = new Bloodhound({
                            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
                            queryTokenizer: Bloodhound.tokenizers.whitespace,
                            local: $.map(general, function(city) {
                                return {
                                    value: city.value,
                                    name: city.name
                                };
                            })
                        });
                        $('input.atc_code_input').tagsinput({
                            typeaheadjs: {
                                name: 'citynames',
                                displayKey: 'name',
                                valueKey: 'name',
                                source: citynames.ttAdapter()
                            }
                        });

                        $('.search-tool').removeClass('col-md-3');
                        $('.specilation').addClass('col-md-12');
                        $('.specilation').removeClass('col-md-9');
                        $('.blackstack').remove();
                        $('.search-tool').hide();

                        $(".two-column").slideDown( "slow", function(){});
                        count += 1;
                        come += 1;
                    }
                    else
                    {
                        if(come < 1)
                        {
                            var component = addCasNumber(count, data_txt,data_no, data_formula , data_target, data_id);
                            $('.frist-inner').append(component);
                            $('.selectpicker').selectpicker();
                            var citynames = new Bloodhound({
                                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
                                queryTokenizer: Bloodhound.tokenizers.whitespace,
                                local: $.map(general, function(city) {
                                    return {
                                        value: city.value,
                                        name: city.name
                                    };
                                })
                            });
                            $('input.atc_code_input').tagsinput({
                                typeaheadjs: {
                                    name: 'citynames',
                                    displayKey: 'name',
                                    valueKey: 'name',
                                    source: citynames.ttAdapter()
                                }
                            });
                             $('.casNumber').addClass('disabled').prop('disabled',true);
                            $('.search-tool').removeClass('col-md-3');
                            $('.specilation').addClass('col-md-12');
                            $('.specilation').removeClass('col-md-9');
                            $('.blackstack').remove();
                            $('.search-tool').hide();

                            $(".two-column").slideDown( "slow", function(){});
                            count += 1;
                            come += 1;
                        }
                    }
                }
                else if (data_target == 'dossageForm')
                {
                    if(cookies.settings[0].multiple[0].casNumber == '1')
                    {
                        var component = addDossageForm(count, data_txt,data_no, data_formula , data_target, data_id);
                        $('.dossageForm-inner').show();
                        $('.dossageForm-inner').append(component);
                        $('.dossage-limit').hide();
                        $('.selectpicker').selectpicker();
                        $('.search-tool').removeClass('col-md-3');
                        $('.specilation').addClass('col-md-12');
                        $('.specilation').removeClass('col-md-9');
                        $('.blackstack').remove();
                        $('.search-tool').hide();

                        $(".two-column").slideDown( "slow", function(){});
                        count += 1;
                        dossageFormCount += 1;
                    }
                    else
                    {
                        if(dossageFormCount < 1)
                        {
                            var component = addDossageForm(count, data_txt,data_no, data_formula , data_target, data_id);
                            $('.dossageForm-inner').show();
                            $('.dossageForm-inner').append(component);
                            $('.dossage-limit').hide();
                            $('.selectpicker').selectpicker();
                            $('.search-tool').removeClass('col-md-3');
                            $('.specilation').addClass('col-md-12');
                            $('.specilation').removeClass('col-md-9');
                            $('.blackstack').remove();
                            $('.search-tool').hide();

                            $(".two-column").slideDown( "slow", function(){});
                            count += 1;
                            dossageFormCount += 1;
                        }
                    }
                }
                else if (data_target == 'medicalClassification')
                {
                    var component = addmedicalClassification(count, data_txt,data_no, data_formula , data_target, data_id);
                    $('.medicalClassifiction-inner').show();
                    $('.medicalClassifiction-inner').append(component);
                    $('.selectpicker').selectpicker();

                    count += 1;
                }
                else
                {
                    return false;
                }

                e.preventDefault();
                return false;
            }
        
    });

   $('.storage-select').change(function(){
            var value = $(this).val();
            if(value == 8)
            {
                $('.storage-input').show();
            }
            else
            {
                $('.storage-input').hide();
            }
        });

    $(document).on('click keydown', '.discom ul.in li.selected', function(e) {

            e.preventDefault();
            $(this).removeClass('selected');
            var data_txt        = $(this).attr('data-txt');
            var data_target     = $(this).attr('data-target');
            var data_id         = $(this).attr('data-id');
            var data_no         = $(this).attr('data-no');
            var data_formula    = $(this).attr('data-formula');
            var cookies         = $.cookie('setting');
            $('.label_'+data_id).remove();
            e.preventDefault();
            return false;
        
    });
    $(document).on('click', '.add-button-photos', function(e) {
        e.preventDefault();
        fore = fore +1;
        comp = `<div class="img-upload-group add bitrix" var-attr="lab_`+fore+`">
                    <div class="reload-form-upload">
                        <label>
                            <input type="file" name="userfile[`+fore+`]">
                            <button type="button" class="mini-upload upload-button" data-id="" data-target=""></button>
                        </label>
                    </div>
                </div>`;
        $('.img-full-right-block .inner-img').append(comp);
        e.preventDefault();
        return false;
    });
    $(document).on('click','.remove-image.product', function(e){
        var data_id = $(this).attr('data-id');
        e.preventDefault();
        $.ajax({
            type:'POST',
            url:site_url+'product/delete_image/',
            data: {'image_id': data_id},
            success:function(data){
                if(data == 'true')
                {
                    $('.lab_'+data_id).remove();
                    toastr.success('This image delete success');
                }
                else
                {
                    toastr.danger('Does not delete images');
                }
            }
        });
        e.preventDefault();
        return false;
    });
    
<?php echo '</script'; ?>
>
<?php if (isset($_smarty_tpl->tpl_vars['message']->value)) {
echo '<script'; ?>
>toastr.warning(`<?php echo $_smarty_tpl->tpl_vars['message']->value['message'];?>
`);<?php echo '</script'; ?>
><?php }
}
}
/* {/block 'content'} */
}
