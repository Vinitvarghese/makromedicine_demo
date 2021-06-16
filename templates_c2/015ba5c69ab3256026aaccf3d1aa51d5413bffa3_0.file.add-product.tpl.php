<?php
/* Smarty version 3.1.30, created on 2020-10-27 14:59:59
  from "/home/makromed/public_html/demo/templates/default/product/add-product.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f97fdaf20e4b2_24397110',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '015ba5c69ab3256026aaccf3d1aa51d5413bffa3' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/default/product/add-product.tpl',
      1 => 1603718926,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f97fdaf20e4b2_24397110 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_7457475005f97fdaf20b2e9_14821796', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['layout']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, true);
}
/* {block 'content'} */
class Block_7457475005f97fdaf20b2e9_14821796 extends Smarty_Internal_Block
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
  
    }
    .tables-data .table > thead.is-fixed {
  border: none;
}
.tables-data .table > thead.is-fixed > tr > th{
  border-bottom: 1px solid rgb(184, 184, 184)!important;
  background: #e9e9e9!important;
}
td:nth-child(1) {
    min-width: 39px!important;
    max-width: 39px!important;
    width: 39px!important;
}
/* .two,.three,.four,.six,.seven,.eight,.nine{
    max-width: 150px!important;
    width: 150px!important;
} */
.nine{
    max-width: 85px!important;
    width: 85px!important;
}

.tables-data .table > thead.is-fixed > tr > th:nth-child(1){
  min-width: 39px;
  width: 39px;
  border-left: 1px solid rgb(184, 184, 184)!important;;
}
.tables-data .table > thead.is-fixed > tr > th:nth-child(2){
  min-width: 158px;
  width: 158px;
}
.tables-data .table > thead.is-fixed > tr > th:nth-child(3){
  min-width: 189px;
  width: 189px;
}
.tables-data .table > thead.is-fixed > tr > th:nth-child(4){
  min-width: 199px;
  width: 199px;
}
.tables-data .table > thead.is-fixed > tr > th:nth-child(5){
  min-width: 157px;
  width: 157px;
}
.tables-data .table > thead.is-fixed > tr > th:nth-child(6){
  min-width: 89px;
  width: 89px;
}
.tables-data .table > thead.is-fixed > tr > th:nth-child(7){
     min-width: 189px;
    width: 189px;
}
.tables-data .table > thead.is-fixed > tr > th:nth-child(8){
      min-width: 189px;
    width: 189px;
}
.tables-data .table > thead.is-fixed > tr > th:nth-child(9){
     min-width: 86px;
    width: 120px;
} 
.tables-data .table > thead > tr > th .form-control{
    border: 0;
  }

  #example_wrapper {
    max-width: 1170px;
    margin: 0 auto;
    padding: 0 15px;
}
.tables-data .table > thead > tr > th .btn-default:hover, .tables-data .table > thead > tr > th .btn-default:focus, .tables-data .table > thead > tr > th .btn-default:active, .tables-data .table > thead > tr > th .btn-default.active, .tables-data .table > thead > tr > th .open > .dropdown-toggle.btn-default{
    padding: 10px 6px!important;
}
.bootstrap-select.btn-group .dropdown-toggle .filter-option{
    margin: 0;
    font-size: 10px;
}
.tables-data .table > thead > tr > th .form-control,
.tables-data .table > thead > tr > th a{
    font-size: 10px;
}
.bootstrap-select.btn-group .dropdown-toggle .caret{
    border-top: 3px solid;
    border-right: 3px solid transparent;
    border-left: 3px solid transparent;
    right: 7px;
}
.six a{
    line-height: 0.5;
}
.six center{
    padding: 6px 0;
}
</style>
    <div class="wrap margin-top-100 col-md-12">
        <div class="container-fuild">
            <div class="row">
               <div class="container no-padding" style="width: 1326px">
                  <?php if ($_smarty_tpl->tpl_vars['UserData']->value->checked != 1) {?>
                    <br>
                <div class="alert alert-danger" style="margin-top: 10px;margin-bottom:0">
                    Please confirm your account by clicking URL sent to your e-mail. After the confirmation of your account your products will appear on the search list.
                </div>
                <br>
              <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['UserData']->value->status != 1) {?>
                    <br>
                <div class="alert alert-danger" style="margin-top: 10px;margin-bottom:0">
                    Please  <a href="javascript:;" onclick="$('#comfirmAccount').modal();">upload a certificate.</a> . After the confirmation of certificate your account will be approved and your products will appear on the top rank of the search list.
                </div>
                <br>
              <?php }?>
             
               </div>
                <div class="clearfix"></div>
                   <div class="col-md-12 no-padding add-product-nav" id="addProductNav">
                        <ul class="add-product-nav-ul">
                            <li class="active"><a href="#section1"><span class="num">1</span><span class="txt">Add Products</span></a></li>
                            <li><a href="#section2"><span class="num">2</span><span class="txt">Ingredients</span></a></li>
                            <li><a href="#section3"><span class="num">3</span><span class="txt">Dosage</span></a></li>
                            <li><a href="#section4"><span class="num">4</span><span class="txt">Information</span></a></li>
                        </ul>
                    </div>

                    <div class="clearfix"></div>
                <div class="container" id="add-product">
                 
                    <div class="clearfix"></div>
                    <h2 class="add-pr-heading" id="section1">Add Products <i class="fa fa-info-circle" data-toggle="modal" data-target="#infoAdd" style="cursor: pointer;"></i></h2>
                    <div class="col-md-12 no-padding add-product collapse <?php if (isset($_smarty_tpl->tpl_vars['message']->value)) {?> in <?php }?>" id="collapseExample">
                        <div class="col-md-12 no-padding panel-add">
                            <form class="" role="form" method="POST" action="<?php echo site_url_multi('product/add');?>
"  enctype="multipart/form-data">
                                <input type="hidden" name="request" value="add">
                                <div class="no-padding search-tool" style="display:none;">
                                    <div class="col-md-12 malecule">
                                        <div class="search-module">
                                            <div class="search-inner"></div>
                                            <input type="text" class="module-search" id="for-search" placeholder="Search">
                                            
                                        </div>
                                        <div class="col-md-12 no-padding discom">
                                            <ul class="list-chemical periodic collapse in" id="chemical">
                                                <?php if ($_smarty_tpl->tpl_vars['chemichal']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['chemichal']->value, 'chemical');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['chemical']->value) {
?>
                                                <li data-txt="<?php echo $_smarty_tpl->tpl_vars['chemical']->value->meaning;?>
" data-no="<?php echo $_smarty_tpl->tpl_vars['chemical']->value->atc_code;?>
" data-formula="" data-target="chemical" data-id="<?php echo $_smarty_tpl->tpl_vars['chemical']->value->id;?>
">
                                                    <span class="ischeck"></span>
                                                    <a href="#<?php echo $_smarty_tpl->tpl_vars['chemical']->value->atc_code;?>
" >
                                                        <div class="lib-span" data-toggle="tooltip" data-placement="bottom" title="<?php echo $_smarty_tpl->tpl_vars['chemical']->value->atc_code;?>
 | <?php echo $_smarty_tpl->tpl_vars['chemical']->value->meaning;?>
"><?php echo $_smarty_tpl->tpl_vars['chemical']->value->atc_code;?>
 </div>
                                                        <div class="lib-span2"> | <?php echo $_smarty_tpl->tpl_vars['chemical']->value->meaning;?>
</div>
                                                    </a>
                                                    <div class="clearfix"></div>
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
"> <span class="ischeck"></span><a href="#"   title="<?php echo $_smarty_tpl->tpl_vars['herbal']->value->name;?>
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
"> <span class="ischeck"></span><a href="#" data-toggle="tooltip" data-placement="right" title="<?php echo $_smarty_tpl->tpl_vars['animal']->value->name;?>
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
                                                    <span class="ischeck"></span>
                                                    <a href="#<?php echo $_smarty_tpl->tpl_vars['cas_number']->value->cas_no;?>
"  data-toggle="tooltip" data-placement="bottom" title="<?php echo str_replace('"','',$_smarty_tpl->tpl_vars['cas_number']->value->chemical_name);?>
">
                                                        <div class="lib-span3"  ><?php echo $_smarty_tpl->tpl_vars['cas_number']->value->cas_no;?>
 </div>
                                                        <div class="lib-span4"> | <?php echo $_smarty_tpl->tpl_vars['cas_number']->value->chemical_name;?>
</div>
                                                    </a>
                                                    <div class="clearfix"></div>
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
"> <span class="ischeck"></span><a href="#" data-toggle="tooltip" data-placement="right" title="<?php echo $_smarty_tpl->tpl_vars['dossageform']->value->name;?>
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
"> <span class="ischeck"></span><a href="#" data-toggle="tooltip" data-placement="right" title="<?php echo $_smarty_tpl->tpl_vars['medical']->value->name;?>
"><?php echo $_smarty_tpl->tpl_vars['medical']->value->name;?>
</a> </li>
                                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                                            </ul>
                                         <!--    <button type="button" class="btn btn-default show-sug mt-10" data-toggle="modal" data-type="chemical" data-target="#suggestionModal" style="display:block">+ Add your suggestion</button> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 no-padding specilation">
                                    <div class="col-md-12 add-frist">
                                        <?php if (isset($_smarty_tpl->tpl_vars['message']->value)) {?>
                                            <?php echo '<script'; ?>
> toastr.warning(`<?php echo $_smarty_tpl->tpl_vars['message']->value['message'];?>
`); <?php echo '</script'; ?>
>
                                        <?php }?>
                                        <div class="form-group" style="margin-bottom: 0!important">
                                            <div class="col-md-4 col-xs-12">
                                                <div class="col-md-4 no-padding label-cont" style="margin-bottom:15px;">
                                                    <label>Product type</label>
                                                </div>
                                                <div class="col-md-8 no-padding" style="margin-bottom:15px;">
                                                    <select name="pr_type" class="form-control mylos selectpicker show-menu-arrow product_type_select" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" title="Please Select Type">
                                                        <?php if ($_smarty_tpl->tpl_vars['product_type']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product_type']->value, 'type', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['type']->value) {
?>
                                                        <option value="<?php echo $_smarty_tpl->tpl_vars['type']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['type']->value->name;?>
</option>
                                                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                                                    </select>
                                                </div>
                                               
                                            </div>
                                            <div class="col-md-4 col-xs-12 brandName">
                                                <div class="col-md-4 no-padding label-cont" >
                                                    <label>Brand name</label>
                                                </div>
                                                <div class="col-md-8 no-padding" >
                                                    <input type="text" name="title" class="form-control mylos brandname" placeholder="Brand name" disabled="disabled">
                                                </div>
                                            </div>
                                            <div class="col-md-4 country col-xs-12">
                                                <div class="col-md-4 no-padding label-cont">
                                                    <label>Country</label>
                                                </div>
                                                <div class="col-md-8 no-padding ">
                                                    <select name="country" class="form-control mylos selectpicker company-country show-menu-arrow" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1">
                                                        <?php if ($_smarty_tpl->tpl_vars['countrys']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['countrys']->value, 'country', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['country']->value) {
?>
                                                            <option value="<?php echo $_smarty_tpl->tpl_vars['country']->value->id;?>
" data-name="<?php echo $_smarty_tpl->tpl_vars['country']->value->code;?>
" <?php if ($_smarty_tpl->tpl_vars['UserData']->value->country_id == $_smarty_tpl->tpl_vars['country']->value->id) {?> selected="selected" <?php } elseif (empty($_smarty_tpl->tpl_vars['UserData']->value->country_id)) {?> <?php if ($_smarty_tpl->tpl_vars['country']->value->id == $_smarty_tpl->tpl_vars['ip_country']->value->id) {?> selected="selected" <?php }?> <?php }?>><?php echo $_smarty_tpl->tpl_vars['country']->value->name;?>
</option>
                                                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="clearfix row" style="margin: 0">

                                                 <div class="col-md-12 frist-inner"></div>
                                            </div>
                                            <div class="col-md-9 no-padding content_add">
                                                <div class="pull-left">
                                                    <label>Add new ingredient</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <button type="button" class="target chemical" data-widget="" data-target="#chemical" >ATC Code +</button>
                                                    <button type="button" class="target herbal" data-widget="" data-target="#herbal" >Herbal +</button>
                                                    <button type="button" class="target animal" data-widget="" data-target="#animal">Biological + </button>
                                                    <button type="button" class="target casNumber" data-widget="" data-target="#casNumber">CAS Number +</button>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="two-column">
                                        <h2 class="add-pr-heading forcontent" id="section3">Packaging - <span>Dosage form and pack size</span></h2>
                                        <div class="col-md-12 term-inner">
                                           <div class="form-group">
                                                <div class="col-md-12 no-padding">
                                                   <div class="col-md-1 no-padding dossage-limit" style="width:100px;">
                                                        <button type="button" class="dossage dossageForm btn-dossage" data-widget=""  data-target="#dossageForm">Add</button>
                                                    </div>
                                                    <div class="col-md-12 no-padding dossageForm-inner" >

                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <div id="div_timer"></div>
                                    </div>
                                    <div class="three-column">
                                        <h2 class="add-pr-heading forcontent">Add Medical Classifiction - <span>Therapeutic use area</span></h2>
                                        <div class="col-md-12 term-inner">
                                            <div class="form-group">
                                                <div class="col-md-12 no-padding">
                                                   
                                                    <div class="col-md-1 no-padding medical-limit" style="width:100px;">
                                                        <button type="button" class="dossage medicalClassifictionForm btn-medicalClassifiction" data-widget=""  data-target="#medicalClassification"> Add</button>
                                                    </div>
                                                    <div class="col-md-12 no-padding medicalClassifiction-inner"></div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                       <h2 class="add-pr-heading forcontent" id="section4">General Information - <span>Additional information about product</span></h2>
                                        <div class="col-md-12 term-inner detailsBottom">
                                            <div class="form-group">
                                                    <div class="col-md-4">
                                                     <div class="input-group add-c-count" >
                                                        <span class="input-group-addon beautiful" >MINIMUM ORDER QUANTITY</span>
                                                        <input type="number" class="form-control mylos" placeholder="<?php echo translate('moq');?>
" name="moq">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="input-group add-c-count" >
                                                            <span class="input-group-addon beautiful" >Shelf life</span>
                                                            <input type="number" class="form-control mylos" placeholder="" name="shelf_life">
                                                            <span class="input-group-addon beautiful inp-addon-last" >month</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="input-group add-c-unit" >
                                                            <label>Storage</label>
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
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="col-md-4">
                                                        <label>Add Photo</label>
                                                        <div class="col-md-12 no-padding img-full-right-block img_forece">
                                                            <div class="inner-img">
                                                                <div class="img-upload-group add bitrix" var-attr="lab_1">
                                                                    <div class="reload-form-upload">
                                                                        <label>
                                                                            <input type="file" name="userfile[]" class="userfile">
                                                                            <button type="button" class="mini-upload upload-button" data-id="" data-target="">UPLOAD</button>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>        
                                                        </div>
                                                    </div> 

                                                    <div class="col-md-4">
                                                        <label>Dossier Format</label>
                                                        <div class="col-md-12 no-padding">
                                                            <input type="checkbox" id="BE" name="be" value="1">
                                                            <label for="BE">BE</label>
                                                            <input type="checkbox" id="CTD" name="ctd" value="1">
                                                            <label for="CTD" style="margin-left:15px;">CTD</label>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="col-md-12">
                                                        <div class="input-group add-c-count" >
                                                            <span class="input-group-addon beautiful" >Add more information</span>
                                                            <textarea class="form-control mylos" placeholder="" name="description" rows="4"></textarea>
                                                        </div>   
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 no-padding term-inner button-row">
                                            <div class="form-group">
                                                <div class="col-md-12 no-padding">
                                                   
                                                    <button type="submit" class="submit-product-btn pull-right" style="margin-top:0px;border-radius:0px;">Save</button>
                                                     <button type="button" class="close-product-btn" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style="display:none;">CLOSE</button>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                    <style>
                        .add-product-btn {
                            margin: 5px 0;
                        }
                    </style>
                    <div class="col-md-12 no-padding add-product-button-wrapper" style="clear:both;margin: 0 auto;float: none; padding: 0;">
                        <button type="button" class="add-product-btn" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">ADD NEW PRODUCT</button>
                        <button type="button" class="add-product-btn add-product-btn-violet-color" onclick="location.href = '../pages/<?php echo $_smarty_tpl->tpl_vars['UserData']->value->slug;?>
/products'">RETURN TO PAGE</button>
                        
                    </div>
                </div>
                <div class="col-md-12">
                    <form class="searchTable" action="<?php echo base_url('home/search_table');?>
" method="post">
                      <div class="col-md-12 no-padding tables-data">
                          <table class="table table-striped no-padding display table-search-not"  id="example" >
                              <thead>
                                  <tr>
                                      <th class="one"></th>
                                      <th class="two">
                                        <select class="form-control selectpicker show-menu-arrow product_type" multiple data-live-search="true" data-selected-text-format="count > 0" data-actions-box="true" title="Product Type"></select>
                                      </th>
                                      <th class="three">
                                        <input type="text" name="brand_name" class="form-control brand_name" placeholder="Brand Name">
                                      </th>
                                      <th class="four">
                                        <select class="form-control selectpicker show-menu-arrow select_content" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Content"></select>
                                      </th>
                                      <th class="five">
                                        <select class="form-control selectpicker show-menu-arrow select_dossage" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Dosage form"></select>
                                      </th>
                                      <th class="six">
                                        <select class="form-control selectpicker show-menu-arrow select_country" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Country"></select>
                                      </th>
                                      <th class="seven">
                                        <select class="form-control selectpicker show-menu-arrow select_medical" multiple data-live-search="true" multiple data-actions-box="true" data-selected-text-format="count > 0" title="Medical Classification"></select>
                                      </th>
                                      <th class="eight">
                                        <select class="form-control selectpicker show-menu-arrow select_company" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Company"></select>
                                      </th>
                                    
                                      <th class="ten" style="min-width:108px!important"><a href="#" style="margin-left:8px">Operations</a></th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php if ($_smarty_tpl->tpl_vars['products']->value) {?>
                                      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['products']->value, 'product');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
?>
                                      <?php $_smarty_tpl->_assignInScope('company', get_company_name($_smarty_tpl->tpl_vars['product']->value->user_id));
?>
                                      <?php $_smarty_tpl->_assignInScope('atc_code', json_decode($_smarty_tpl->tpl_vars['product']->value->atc_code));
?>
                                      <?php $_smarty_tpl->_assignInScope('herbal', json_decode($_smarty_tpl->tpl_vars['product']->value->herbal));
?>
                                      <?php $_smarty_tpl->_assignInScope('animals', json_decode($_smarty_tpl->tpl_vars['product']->value->animal));
?>
                                      <?php $_smarty_tpl->_assignInScope('casNumbers', json_decode($_smarty_tpl->tpl_vars['product']->value->cas));
?>

                                        <?php $_smarty_tpl->_assignInScope('defaultname', '');
?>

                                        <?php if ($_smarty_tpl->tpl_vars['product']->value->title == '' || is_null($_smarty_tpl->tpl_vars['product']->value->title)) {?>


                                       <?php if (count($_smarty_tpl->tpl_vars['casNumbers']->value) > 0) {?>

                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['casNumbers']->value, 'casss');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['casss']->value) {
?>
                                                
                                             <?php $_smarty_tpl->_assignInScope('casformule', get_cas_formula($_smarty_tpl->tpl_vars['casss']->value->id));
?>
                                             <?php $_smarty_tpl->_assignInScope('casname', get_cas_name($_smarty_tpl->tpl_vars['casss']->value->id));
?>
                                             <?php if ($_smarty_tpl->tpl_vars['casformule']->value && $_smarty_tpl->tpl_vars['casformule']->value != '' && !empty($_smarty_tpl->tpl_vars['casformule']->value) && !is_null($_smarty_tpl->tpl_vars['casformule']->value)) {?>
                                                <?php $_smarty_tpl->_assignInScope('defaultname', $_smarty_tpl->tpl_vars['casformule']->value);
?>
                                             <?php } else { ?>
                                                <?php $_smarty_tpl->_assignInScope('defaultname', $_smarty_tpl->tpl_vars['casname']->value);
?>
                                              
                                             <?php }?>
                                  
                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>


                                            <?php } elseif (count($_smarty_tpl->tpl_vars['atc_code']->value) > 0) {?>

                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['atc_code']->value, 'atc');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['atc']->value) {
?>
                                            <?php $_smarty_tpl->_assignInScope('defaultname', get_atc_code_name($_smarty_tpl->tpl_vars['atc']->value->id));
?>
                                           
                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>



                                        <?php }?>

                                        <?php }?>

                                      <?php if (count($_smarty_tpl->tpl_vars['atc_code']->value) > 0 || count($_smarty_tpl->tpl_vars['herbal']->value) > 0 || count($_smarty_tpl->tpl_vars['animals']->value) > 0 || count($_smarty_tpl->tpl_vars['casNumbers']->value) > 0) {?>
                                      <?php if (isset($_smarty_tpl->tpl_vars['company']->value->company_name)) {?>
                                      <?php if (!empty(trim($_smarty_tpl->tpl_vars['company']->value->company_name))) {?>
                                      <tr <?php if ($_smarty_tpl->tpl_vars['product']->value->checked == 0) {?> class="not-active" <?php }?>>
                                          <td class="closed_tb one" style="width: 39px"></td>
                                          <td class="closed_tb two">
                                            <p><?php echo get_product_type_name($_smarty_tpl->tpl_vars['product']->value->pr_type);?>
</p>
                                          </td>
                                          <td class="closed_tb three">
                                            <a href="<?php echo site_url_multi('product/view/');
echo $_smarty_tpl->tpl_vars['product']->value->id;
if ($_smarty_tpl->tpl_vars['product']->value->alias) {?>-<?php echo $_smarty_tpl->tpl_vars['product']->value->alias;
}?>" target="_blank"> <p><?php if ($_smarty_tpl->tpl_vars['product']->value->title != '' && !is_null($_smarty_tpl->tpl_vars['product']->value->title)) {
echo $_smarty_tpl->tpl_vars['product']->value->title;
} else {
echo $_smarty_tpl->tpl_vars['defaultname']->value;
}?></p></a>
                                          </td>
                                          <td class="closed_tb content four">
                                              <span>
                                              <?php if (count($_smarty_tpl->tpl_vars['atc_code']->value) > 0) {?>
                                                  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['atc_code']->value, 'atc');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['atc']->value) {
?>
                                                      <b><?php echo get_atc_code_no($_smarty_tpl->tpl_vars['atc']->value->id);?>
</b>
                                                      <span>(<?php echo $_smarty_tpl->tpl_vars['atc']->value->mdoza;?>
 <?php echo get_unit_name($_smarty_tpl->tpl_vars['atc']->value->vdoza);?>
 <?php if (!is_null($_smarty_tpl->tpl_vars['atc']->value->mdoza2) && $_smarty_tpl->tpl_vars['atc']->value->mdoza2 != '') {?> / <?php echo $_smarty_tpl->tpl_vars['atc']->value->mdoza2;?>
 <?php echo get_unit_name($_smarty_tpl->tpl_vars['atc']->value->vdoza2);
}?>)</span>
                                                  <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                              <?php }?>
                                              <?php if (count($_smarty_tpl->tpl_vars['herbal']->value) > 0) {?>
                                                  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['herbal']->value, 'herb');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['herb']->value) {
?>
                                                      <b><?php echo get_herbal_name($_smarty_tpl->tpl_vars['herb']->value->id);?>
</b>
                                                      <span>(<?php echo $_smarty_tpl->tpl_vars['herb']->value->mdoza;?>
 <?php echo get_unit_name($_smarty_tpl->tpl_vars['herb']->value->vdoza);?>
)</span>
                                                  <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                              <?php }?>
                                              <?php if (count($_smarty_tpl->tpl_vars['animals']->value) > 0) {?>
                                                  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['animals']->value, 'animal');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['animal']->value) {
?>
                                                      <b><?php echo get_animal_name($_smarty_tpl->tpl_vars['animal']->value->id);?>
</b>
                                                      <span><?php echo $_smarty_tpl->tpl_vars['animal']->value->mdoza;?>
 <?php echo get_unit_name($_smarty_tpl->tpl_vars['animal']->value->vdoza);?>
</span>
                                                  <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                              <?php }?>
                                              <?php if (count($_smarty_tpl->tpl_vars['casNumbers']->value) > 0) {?>
                                                  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['casNumbers']->value, 'casss');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['casss']->value) {
?>
                                                      <b><?php echo get_cas_name($_smarty_tpl->tpl_vars['casss']->value->id);?>
</b>
                                                      <span><?php echo $_smarty_tpl->tpl_vars['casss']->value->mdoza;?>
 <?php echo get_unit_name($_smarty_tpl->tpl_vars['casss']->value->vdoza);?>
</span>
                                                  <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                              <?php }?>
                                              </span>
                                          </td>
                                          <td class="closed_tb five">
                                            <span>
                                              <?php $_smarty_tpl->_assignInScope('var', json_decode($_smarty_tpl->tpl_vars['product']->value->packing_type));
?>
                                              <?php if (count($_smarty_tpl->tpl_vars['var']->value) > 0) {?>
                                                  <?php $_smarty_tpl->_assignInScope('f', json_decode(json_encode($_smarty_tpl->tpl_vars['var']->value[0])));
?>
                                                  <b><?php echo get_packing_type_name($_smarty_tpl->tpl_vars['f']->value->id);?>
</b>
                                                  <span>(<?php if ($_smarty_tpl->tpl_vars['f']->value->mdoza2 != 0) {
echo $_smarty_tpl->tpl_vars['f']->value->mdoza2;
}?> <?php echo get_unit_name($_smarty_tpl->tpl_vars['f']->value->vdoza2);?>
 <?php if ($_smarty_tpl->tpl_vars['f']->value->mdoza != 0) {
echo $_smarty_tpl->tpl_vars['f']->value->mdoza;
}?> <?php echo get_drug_type_code($_smarty_tpl->tpl_vars['f']->value->vdoza);?>
)</span>
                                              <?php }?>
                                            </span>
                                          </td>
                                          <td class="closed_tb six">
                                              <center>
                                                  <a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo get_country_name($_smarty_tpl->tpl_vars['product']->value->country);?>
">
                                                      <img src="<?php echo base_url('templates/default/assets/img/country/');
echo get_country_code($_smarty_tpl->tpl_vars['product']->value->country);?>
.png" alt="<?php echo get_country_name($_smarty_tpl->tpl_vars['product']->value->country);?>
" class="table-img">
                                                      <p style="font-size:10px;color:#555;"><?php echo get_country_name($_smarty_tpl->tpl_vars['product']->value->country);?>
</p>
                                                  </a>
                                              </center>
                                          </td>
                                          <td class="closed_tb seven">
                                            <span>
                                              <?php if (!empty($_smarty_tpl->tpl_vars['product']->value->medical_cl)) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, get_selected_medical($_smarty_tpl->tpl_vars['product']->value->medical_cl), 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
                                              <b><?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
</b>
                                              <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>
 <?php } else { ?> <?php }?>
                                            </span>
                                          </td>
                                          <td class="closed_tb eight">
                                            <span>
                                            <?php if (isset($_smarty_tpl->tpl_vars['company']->value->company_name)) {
echo $_smarty_tpl->tpl_vars['company']->value->company_name;
}?>
                                            </span>
                                          </td>
                                        
                                          <td class="closed_tb ten">
                                            <center>
                                              <div class="btn-group" style="width:100px;">
                                                  <button type="button" class="btn btn-success btn-bix" data-toggle="tooltip" data-placement="top" title="Copy" onclick="window.location='<?php echo base_url("product/copy/");
echo $_smarty_tpl->tpl_vars['product']->value->id;?>
'"> <i class="fa fa-copy"></i> </button>
                                                  <button type="button" class="btn btn-info btn-bix" data-toggle="tooltip" data-placement="top" title="Edit" onclick="window.location='<?php echo base_url("product/update/");
echo $_smarty_tpl->tpl_vars['product']->value->id;?>
'"> <i class="fa fa-pencil"></i> </button>
                                                  <button type="button" class="btn btn-danger btn-bix remove-trash" data-toggle="tooltip" data-placement="top" title="Delete" onclick="if(confirm('Are you sure?')) window.location='<?php echo base_url("product/delete/");
echo $_smarty_tpl->tpl_vars['product']->value->id;?>
'"> <i class="fa fa-trash"></i> </button>
                                              </div>
                                            </center>
                                          </td>
                                      </tr>
                                      <?php }?>
                                      <?php }?>
                                      <?php }?>
                                  <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                              <?php }?>
                              </tbody>
                          </table>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

            <div id="comfirmAccount" class="modal fade" role="dialog" style="z-index:999999999999999;">
           <div class="modal-dialog">
               <div class="modal-content">
                 <form class="comfirmAccount" action="<?php echo base_url();?>
profile/comfirmAccount" method="post">
                   <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title data-title">Comfirm Account</h4>
                   </div>
                   <div class="modal-body data-response">
                     <div class="form-group">
                       <input type="file" name="certifcate" style="display:none;" class="certifcate-input"/>
                       <button type="button" class="btn btn-danger choose-certifcate">Choose Certifcate</button>
                     </div>
                     <div class="clearfix"></div>
                     <div class="form-group">
                         <label for="company-date">Information</label>
                         <textarea type="text" name="info" class="form-control"></textarea>
                     </div>
                   </div>
                   <div class="modal-footer">
                      <button type="submit" class="btn btn-success">Save</button>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                   </div>
                 </form>
               </div>
           </div>
        </div>


    <!-- Modal -->
    <div class="modal fade" id="infoAdd" tabindex="-1" role="dialog" aria-labelledby="infoAddLabel">
      <div class="modal-dialog" role="document" style="width: 65%">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="infoAddLabel">Product Adding</h4>
          </div>
          <div class="modal-body">
         <iframe width="100%" height="450" src="https://www.youtube.com/embed/6sT604EHm0o?rel=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
          </div>
        </div>
      </div>
    </div>

       <!-- Modal -->
    <div class="modal fade" id="plusModal" tabindex="-1" role="dialog" aria-labelledby="infoAddLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="infoAddLabel">Additional Data</h4>
          </div>
          <div class="modal-body">
          You can expand this row by clicking "+" button and add more data about current content.
          </div>
        </div>
      </div>
    </div>

    <?php echo '<script'; ?>
>
        function addHerbal(count, data_txt, data_no, data_formula, data_target, data_id) {
            var component =
            `<div class="form-group vared herbalRow label_` + data_id + `">
                <div class="col-md-2 no-padding label_add_prod">
                    <label>Ingredient ` + count + `</label>
                    <input type="hidden" name="herbals[` + count + `][id]" value="` + data_id + `">
                </div>
                 <div class="col-md-12 no-padding add-c-row">
                     <div class="input-group add-c-name">
                        <span class="input-group-addon beautiful" style="width:101px;">Herbal</span>
                        <input type="text" class="form-control fix-inputgroup" title="`+data_txt+`" value="` + data_txt + `" reaadonly disabled>
                    </div>
               
                
               
                    <div class="input-group add-c-count" style="margin-bottom:5px;">
                        <span class="input-group-addon beautiful" >Quantity</span>
                        <input type="text" class="form-control mylos"  name="herbals[` + count + `][mdoza]" required>
                    </div>
                            <div class="input-group add-c-unit">
                                <label for="">Dose Unit</label>
                                <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1"  name="herbals[` + count + `][vdoza]" required>
                                    <option value="">-</option>
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
                            <div class="input-group add-c-unit">
                                <label for="">Herb part</label>
                                <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="herbals[` + count + `][part]">
                                    <option class="bs-title-option" value="">-</option>
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
                            <div class="input-group add-c-unit">
                            <label for="">Herb form</label>
                                <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="herbals[` + count + `][form]">
                                    <option class="bs-title-option" value="">-</option>
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
                             <button type="button" class="btn remove-item remove-c-row" data-toggle="tooltip" data-placement="top" data-cid="`+data_id+`" title="" > <img src="<?php echo base_url('templates/default/assets/img/times.png');?>
"></button>
                    </div>
                    
                </div>
               
            </div>
            `;
            return component;
        }
        function addAnimal(count, data_txt, data_no, data_formula, data_target, data_id) {
        var component =
            `<div class="form-group vared animalRow label_` + data_id + `">
                <div class="col-md-2 no-padding label_add_prod">
                    <label>Ingredient ` + count + `</label>
                    <input type="hidden" name="animals[` + count + `][id]" value="` + data_id + `">
                </div>
                <div class="col-md-12 no-padding">
                    <div class="input-group add-c-name">
                        <span class="input-group-addon beautiful" style="width:101px;">Animal</span>
                        <input type="text" class="form-control fix-inputgroup" title="`+data_txt+`" value="` + data_txt + `" reaadonly disabled>
                    </div>
                    
                    <div class="input-group add-c-count">
                        <span class="input-group-addon beautiful" style="width: 95px;height: 32px;">Quantity</span>
                        
                        <input type="text" class="form-control mylos"  name="animals[` + count + `][mdoza]" required>
                    </div>
                    <div class="input-group add-c-count">
                        <label for="">Dose unit</label>
                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1"  name="animals[` + count + `][vdoza]" required>
                            <option value="">-</option>
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
                    <div class="input-group add-c-unit">
                        <label for="">Animal part</label>
                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="animals[` + count + `][part]">
                            <option class="bs-title-option" value="">-</option>
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
                    <div class="input-group add-c-unit">
                    <label for="">Animal form</label>
                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="animals[` + count + `][form]">
                            <option class="bs-title-option" value="">-</option>
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
                    
                    <button type="button"  data-cid="`+data_id+`" class="btn btn-danger btn-bix pull-right remove-item remove-c-row" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"> <i class="fa fa-trash"></i> </button>
                </div>
               
            </div>`;
        return component;
        }
        function addChermical(count, data_txt, data_no, data_formula, data_target, data_id) {
            var component =
            `<div class="form-group vared chemicalRow label_`+data_id+`">
                <div class="col-md-2 no-padding label_add_prod">
                    <label>Ingredient ` + count + `</label>
                    <input type="hidden" name="atc_codes[` + count + `][id]" value="` + data_id + `">
                </div>
                <div class="col-md-12 no-padding add-c-row">
                    <div class="input-group add-c-code">
                        <span class="input-group-addon beautiful" style="width:101px;">Atc code</span>
                        <input type="text" class="form-control fix-inputgroup" value="`+data_no+`" reaadonly disabled>
                    </div>
                    <div class="input-group add-c-name">
                        <span class="input-group-addon beautiful" style="width:101px;">Name</span>
                        <input type="text" class="form-control fix-inputgroup" title="`+data_txt+`" value="`+data_txt+`" reaadonly disabled>
                    </div>
                    <div class="input-group add-c-count" >
                        <span class="input-group-addon beautiful">Quantity</span>
                        <input type="text" class="form-control mylos" value="1"  name="atc_codes[` + count + `][mdoza]" required>
                    </div>
                    <div class="input-group add-c-unit">
                    <label for="">Dose Unit</label>
                                <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1"  name="atc_codes[` + count + `][vdoza]" required>
                                    <option value="">-</option>
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
                            <div style="float:left;">
                                <button type="button" class="plus_item" data-id="` + count + `" data-type="atc_codes"><span class="fa fa-info"></span>+</button>
                                <button type="button" class="minus_item"><span class="fa fa-info"></span>-</button>
                            </div>
                              <div class="extra-mg"></div>
                            <button type="button" class="btn remove-item remove-c-row" data-cid="`+data_id+`" data-toggle="tooltip" data-placement="top" > <img src="<?php echo base_url('templates/default/assets/img/times.png');?>
"></button>
                          
                       
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
                                <input type="text" class="form-control" placeholder="purity (%)" name="atc_codes[` + count + `][purity]" style="border-radius:4px!important">
                            </div>
                        </div>
                    </div>`;
                }
                component+=`</div>
               
            </div>`;
            return component;
        }
        function addDossageForm(count, data_txt, data_no, data_formula, data_target, data_id) {
            var component =
            `<div class="form-group label_` + data_id + `" style="padding-bottom: 0px;">
                <div class="col-md-12 no-padding add-c-row">
                    <div class="input-group add-c-name">
                        <span class="input-group-addon beautiful" style="width:101px;">Dosage form</span>
                        <input type="text" class="form-control fix-inputgroup" title="`+data_txt+`" style="width:100%" value="` + data_txt + `" reaadonly disabled>
                        <input type="hidden" name="packing_types[` + count + `][id]" value="` + data_id + `">
                    </div>
                    
                    
                    
                    <div class="input-group add-c-count">
                        <span class="input-group-addon beautiful" >Quantity</span>
                        <input type="text" class="form-control mylos" value="1" name="packing_types[` + count + `][mdoza]" required>
                    </div>
                    <div class="input-group add-c-unit">
                    <label for="">Packing</label>
                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1"  name="packing_types[` + count + `][vdoza]" title="-" required>
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
                    <div style="float:left;">
                        <button type="button" class="plus_item" data-id="` + count + `" data-type="packing_types"><span class="fa fa-info"></span>+</button>
                        <button type="button" class="minus_item"><span class="fa fa-info"></span>-</button>
                    </div>
                    <div class="extra-mg"></div>
                    <button type="button" class="btn remove-item-dossage" data-toggle="tooltip" data-placement="top" title="" data-cid="`+data_id+`" > <img src="<?php echo base_url('templates/default/assets/img/times.png');?>
"> </button>                    

                    
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>`;
            return component;
        }
        function addmedicalClassification(count, data_txt, data_no, data_formula, data_target, data_id) {
            var component =
            `<div class="form-group col-md-3 no-padding label_` + data_id + `" style="margin-right:10px!important">
                <div class="input-group">
                    <input type="text" class="form-control mylos fix-inputgroup" value="` + data_txt + `" readonly>
                    <input type="hidden" value="` + data_id + `" name="classifiction[` + count + `]" readonly>
                    <span class="input-group-btn">
                          <button type="button" class="btn remove-item-classifiction" data-cid="`+data_id+`" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"> <img src="<?php echo base_url('templates/default/assets/img/times.png');?>
">  </button>
                    </span>
                </div>
            </div>`;
            return component;
        }
        function addCasNumber(count, data_txt, data_no, data_formula, data_target, data_id) {
            data_txt = data_txt.replace('"','');

            var component =
            `<div class="form-group cas-add-row vared label_` + data_id + `">
                <div class="col-md-2 no-padding label_add_prod">
                    <label>Ingredient ` + count + `</label>
                    <input type="hidden" name="cass[` + count + `][id]" value="` + data_id + `">
                </div>
                <div class="col-md-12 no-padding add-c-row">
                    <div class="input-group add-c-code add-cas-code">
                        <span class="input-group-addon beautiful" style="width:101px;">CAS No</span>
                        <input type="text" class="form-control fix-inputgroup" title="`+data_no+`" value="`+data_no+`" reaadonly disabled>
                    </div>
                    <div class="input-group add-c-code add-cas-formula">
                        <span class="input-group-addon beautiful" style="width:101px;">Formula</span>
                        <input type="text" class="form-control fix-inputgroup" title="`+data_formula+`" value="`+data_formula+`" reaadonly disabled>
                    </div>
                   
                
               
                    <div class="input-group add-c-unit add-c-purity">
                        <label>Purity</label>
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
                    <div class="input-group add-c-unit add-c-purity">  
                    <span class="input-group-addon beautiful" >Purity(%)</span> 
                        <input type="text" class="form-control" name="cass[` + count + `][purity]">
                    </div>
                    <div class="input-group add-c-count add-c-purity" >
                            <span class="input-group-addon beautiful">Quantity</span>
                           <input type="text" class="form-control mylos"value="1"  name="cass[` + count + `][mdoza]" required>
                    </div>   
                    <div class="input-group add-c-unit" >
                    <label for="">Dose unit</label>
                       <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1"  name="cass[` + count + `][vdoza]" required>
                                <option value="">-</option>
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
                    
                     <div style="float:left;margin-right: 10px;">
                                <button type="button" class="plus_item" data-id="` + count + `" data-type="cass"><span class="fa fa-info"></span>+</button>
                                <button type="button" class="minus_item"><span class="fa fa-info"></span>-</button>
                            </div>
                            <div class="extra-mg" style="margin-left:0;"></div>
                      <button type="button" class="btn remove-item remove-c-row" data-toggle="tooltip" data-placement="top" title="" data-cid="`+data_id+`"> <img src="<?php echo base_url('templates/default/assets/img/times.png');?>
"></button>

                       <div class="input-group add-c-name">
                        <span class="input-group-addon beautiful" style="width:101px;">Name</span>
                        <input type="text" class="form-control fix-inputgroup" title="`+data_txt+`" value="`+data_txt+`" reaadonly disabled>
                    </div>

                    <div class="extra-mg2" style="margin-left:0"></div>

                </div>
                <div class="clearfix"></div>
            </div>`;
            return component;
        }
        $(document).on('click', '.plus_item', function(e){
            if(!$(e.target).hasClass('fa-info')){
            var data_id = $(this).data('id');
            var data_type = $(this).data('type');
            var component =
            `<div class="col-sm-4 no-padding">
                <label for="">Quantity</label>
                <input type="text" class="form-control mylos" name="`+data_type+`[`+data_id+`][mdoza2]" value="">
             </div>
             <div class="col-sm-8 no-padding">
             <label for="">Volume unit</label>
                <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="` + data_type + `[` + data_id + `][vdoza2]">
                    <option value="">-</option>
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

             var component2 = `<div class="input-group add-c-unit add-c-acode" >
                        <span class="input-group-addon beautiful" >ATC Code</span>
                        <div class="form-inline" style="">
                             <input type="text" class="form-control mylos tagsinput atc_code_input" name="` + data_type + `[` + data_id + `][atc_code]" data-role="tagsinput" multiple>
                        </div>
                    </div>`;


            $(this).parent().parent().find('div.extra-mg').append(component);
            $(this).parent().parent().find('div.extra-mg2').append(component2);
           var slp =  $('.selectpicker').selectpicker();
                       slp.on('shown.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                          $(e.target).parent().siblings('label').css('z-index', 9999999999);
                         
                        });
                       slp.on('hidden.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                          $(e.target).parent().siblings('label').css('z-index', 555);
                         
                        });

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

          $('.extra-mg2 input.atc_code_input').tagsinput({
                        typeaheadjs: {
                            name: 'citynames',
                            displayKey: 'name',
                            valueKey: 'name',
                            source: citynames.ttAdapter()
                        }
                    });
            $(this).hide();
            $(this).parent().find('.minus_item').show();
        }
        });
        $(document).on('click', '.minus_item', function(e){
            if(!$(e.target).hasClass('fa-info')){
                $(this).parent().parent().find('div.extra-mg').empty();
                $(this).parent().parent().find('div.extra-mg2').empty();
                $(this).hide();
                $(this).parent().find('.plus_item').show();
            }
        });
    <?php echo '</script'; ?>
>
    
    <?php echo '<script'; ?>
 type="text/javascript">
        $(document).ready(function(){
            var fin = [];
            $('select.product_type_select').on('change', function(e){
                var selected = $(this).find('option:selected').val();
                if(selected != 0){
                    $.isLoading({text:""});
                    e.preventDefault();
                    $('.brandname').removeAttr('disabled');
                    $('.content_add').show();
                    $('.frist-inner').empty().css('padding','0px');

                       $('.add-product-nav-ul li:nth-child(2)').siblings().removeClass('active');
                        $('.add-product-nav-ul li:nth-child(2)').addClass('active');

                    
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
                                if (value == '1')
                                {
                                    $('.' + key).show();
                                }
                                else
                                {
                                    $('.' + key).hide();
                                }
                            });
                            $.each(json.settings[0].multiple[0], function(key, value) {
                                if (value == '1')
                                {

                                }
                                else
                                {

                                }
                            });
                            setTimeout(function(){$.isLoading("hide"); }, 1000);

                        },
                        error: function(){
                            setTimeout(function(){$.isLoading("hide"); }, 1000);
                        }
                    });
                    e.preventDefault();
                    return false;
                }
                else{
                    $('.brandname').attr('disabled','disabled');
                    $('.content_add').hide();
                }
            });
        });

        function finaly(_this)
        {
            $.isLoading({text: ""});
            $('.btn-dossage').removeClass('active');
            $('.target').removeClass('active');
            _this.addClass('active');
            var target = _this.attr('data-target');
            $('.periodic').removeClass('in');
            $(target).addClass('in');
            var target_str = target.replace('#','');
            $('.search-inner').html('<h2>Select ' +target_str + ' items</h2>').find('h2').animate({marginLeft: "0px"}, 500);
            $('.search-inner').append('<span class="fa fa-times"></span>');
            $('.search-tool').addClass('col-md-3');
            $('.search-tool').show();
           
            $('body').append('<div class="blackstack"></div>');
            setTimeout(function () { $.isLoading("hide"); }, 200);
           $('.module-search').val('').trigger('keyup');
     //       $('.module-search').css('border', '1px solid red').trigger( "focus" );
        }

        $(document).on('click', '.target , .dossage', function () {

            var cookies = $.cookie('setting');

            var brandname = $('.brandname');

            if(cookies.settings[0].visible[0].brandName == '1')
            {
             //   brandname.attr('required');
              /*  if(brandname.val() == '')
                {
                    brandname.css('border','1px solid red');
                }
                else{*/
                    brandname.removeAttr('style');
                    finaly($(this));
               // }
            }else{
                finaly($(this));
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

    <?php echo '</script'; ?>
>
    
    <?php echo '<script'; ?>
 type="text/javascript">
        var fore = 1;
        var count = 1;
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
                $('.frist-inner').prev('.add-pr-heading').remove();
                $('.frist-inner').before('<h2 class="add-pr-heading forcontent" id="section2">Ingredients - <span>Ingreidents and dosages</span></h2>');
                $('.frist-inner').css('padding','20px');
                    
                if(data_target == 'chemical')
                {
                    if(cookies.settings[0].multiple[0].chemical == '1')
                    {
                        var component = addChermical(count, data_txt,data_no, data_formula , data_target, data_id);
                        $('.frist-inner').append(component);
                         var slp =  $('.selectpicker').selectpicker();
                       slp.on('shown.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                          $(e.target).parent().siblings('label').css('z-index', 9999999999);
                         
                        });
                       slp.on('hidden.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                          $(e.target).parent().siblings('label').css('z-index', 555);
                         
                        });
                        $('.bs-searchbox').each(function(){
                            $(this).prop('placeholder','Search');
                        })
                       // $('.search-tool').removeClass('col-md-3');
                        
                       // $('.blackstack').remove();
                        //$('.search-tool').hide();

                        
                        $(".two-column").slideDown( "slow", function(){});

                          $('.add-product-nav-ul li:nth-child(3)').siblings().removeClass('active');
                        $('.add-product-nav-ul li:nth-child(3)').addClass('active');

                        count += 1;
                        chemicalcount +=1;
                    }
                    else
                    {
                        if(chemicalcount < 1)
                        {
                            var component = addChermical(count, data_txt,data_no, data_formula , data_target, data_id);
                            $('.frist-inner').append(component);
                            var slp =  $('.selectpicker').selectpicker();
                       slp.on('shown.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                          $(e.target).parent().siblings('label').css('z-index', 9999999999);
                         
                        });

                        slp.on('hidden.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                          $(e.target).parent().siblings('label').css('z-index', 555);
                         
                        });
                         //   $('.search-tool').removeClass('col-md-3');
                            
                         //   $('.blackstack').remove();
                    //        $('.search-tool').hide();
                            $(".two-column").slideDown( "slow", function(){});
                               $('.add-product-nav-ul li:nth-child(3)').siblings().removeClass('active');
                        $('.add-product-nav-ul li:nth-child(3)').addClass('active');
                            chemicalcount +=1;
                        }
                    }
                      $('.form-group.vared').each(function(index, el) {
            var ind = index+1;
            $(el).find('.label_add_prod label').text('Ingredient '+ind);
        });

                }
                else if(data_target == 'herbal')
                {
                    if(cookies.settings[0].multiple[0].herbal == '1')
                    {
                        var component = addHerbal(count, data_txt,data_no, data_formula , data_target, data_id);
                        $('.frist-inner').append(component);
                       var slp =  $('.selectpicker').selectpicker();
                       slp.on('shown.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                          $(e.target).parent().siblings('label').css('z-index', 9999999999);
                         
                        });
                       slp.on('hidden.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                          $(e.target).parent().siblings('label').css('z-index', 555);
                         
                        });
                     /*   $('.search-tool').removeClass('col-md-3');
                      
                        $('.blackstack').remove();
                        $('.search-tool').hide();*/

                      

                        $(".two-column").slideDown( "slow", function(){});
                           $('.add-product-nav-ul li:nth-child(3)').siblings().removeClass('active');
                        $('.add-product-nav-ul li:nth-child(3)').addClass('active');
                        count += 1;
                        herbalcount += 1;
                    }
                    else
                    {
                        if(herbalcount < 1)
                        {
                            var component = addHerbal(count, data_txt,data_no, data_formula , data_target, data_id);
                            $('.frist-inner').append(component);
                             var slp =  $('.selectpicker').selectpicker();
                       slp.on('shown.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                          $(e.target).parent().siblings('label').css('z-index', 9999999999);
                         
                        });
                       slp.on('hidden.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                          $(e.target).parent().siblings('label').css('z-index', 555);
                         
                        });
                           /* $('.search-tool').removeClass('col-md-3');
                        
                            $('.blackstack').remove();
                            $('.search-tool').hide();*/

                            $(".two-column").slideDown( "slow", function(){});
                               $('.add-product-nav-ul li:nth-child(3)').siblings().removeClass('active');
                        $('.add-product-nav-ul li:nth-child(3)').addClass('active');
                            herbalcount += 1;
                        }
                    }

                        $('.form-group.vared').each(function(index, el) {
                            var ind = index+1;
                            $(el).find('.label_add_prod label').text('Ingredient '+ind);
                        });
                }
                else if (data_target == 'animal')
                {
                    if(cookies.settings[0].multiple[0].animal == '1')
                    {
                        var component = addAnimal(count, data_txt,data_no, data_formula , data_target, data_id);
                        $('.frist-inner').append(component);
                         var slp =  $('.selectpicker').selectpicker();
                       slp.on('shown.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                          $(e.target).parent().siblings('label').css('z-index', 9999999999);
                         
                        });
                       slp.on('hidden.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                          $(e.target).parent().siblings('label').css('z-index', 555);
                         
                        });
                     /*   $('.search-tool').removeClass('col-md-3');
                      
                        $('.blackstack').remove();
                        $('.search-tool').hide();*/

                        $(".two-column").slideDown( "slow", function(){});
                           $('.add-product-nav-ul li:nth-child(3)').siblings().removeClass('active');
                        $('.add-product-nav-ul li:nth-child(3)').addClass('active');
                        count += 1;
                        animalcount += 1;

                    }
                    else
                    {
                        if(animalcount < 1)
                        {
                            var component = addAnimal(count, data_txt,data_no, data_formula , data_target, data_id);
                            $('.frist-inner').append(component);
                            var slp =  $('.selectpicker').selectpicker();
                       slp.on('shown.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                          $(e.target).parent().siblings('label').css('z-index', 9999999999);
                         
                        });
                       slp.on('hidden.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                          $(e.target).parent().siblings('label').css('z-index', 555);
                         
                        });
                           /* $('.search-tool').removeClass('col-md-3');
                          
                            $('.blackstack').remove();
                            $('.search-tool').hide();
*/
                            $(".two-column").slideDown( "slow", function(){});
                               $('.add-product-nav-ul li:nth-child(3)').siblings().removeClass('active');
                        $('.add-product-nav-ul li:nth-child(3)').addClass('active');
                            count += 1;
                            animalcount += 1;
                        }
                    }

                      $('.form-group.vared').each(function(index, el) {
            var ind = index+1;
            $(el).find('.label_add_prod label').text('Ingredient '+ind);
        });
                }
                else if (data_target == 'casNumber')
                {
                    if(cookies.settings[0].multiple[0].casNumber == '1')
                    {
                        var component = addCasNumber(count, data_txt,data_no, data_formula , data_target, data_id);
                        $('.frist-inner').append(component);
                        var slp =  $('.selectpicker').selectpicker();
                       slp.on('shown.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                          $(e.target).parent().siblings('label').css('z-index', 9999999999);
                         
                        });
                       slp.on('hidden.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                          $(e.target).parent().siblings('label').css('z-index', 555);
                         
                        });
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
                       
                        $('.blackstack').remove();
                        $('.search-tool').hide();

                        $(".two-column").slideDown( "slow", function(){});
                           $('.add-product-nav-ul li:nth-child(3)').siblings().removeClass('active');
                        $('.add-product-nav-ul li:nth-child(3)').addClass('active');
                        count += 1;
                        come += 1;
                    }
                    else
                    {
                        if(come < 1)
                        {
                            var component = addCasNumber(count, data_txt,data_no, data_formula , data_target, data_id);
                            $('.frist-inner').append(component);
                            var slp =  $('.selectpicker').selectpicker();
                       slp.on('shown.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                          $(e.target).parent().siblings('label').css('z-index', 9999999999);
                         
                        });
                       slp.on('hidden.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                          $(e.target).parent().siblings('label').css('z-index', 555);
                         
                        });
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
                         
                            $('.blackstack').remove();
                            $('.search-tool').hide();

                            $(".two-column").slideDown( "slow", function(){});
                               $('.add-product-nav-ul li:nth-child(3)').siblings().removeClass('active');
                        $('.add-product-nav-ul li:nth-child(3)').addClass('active');
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
                        var slp =  $('.selectpicker').selectpicker();
                       slp.on('shown.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                          $(e.target).parent().siblings('label').css('z-index', 9999999999);
                         
                        });
                       slp.on('hidden.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                          $(e.target).parent().siblings('label').css('z-index', 555);
                         
                        });
                        $('.search-tool').removeClass('col-md-3');
                       
                        $('.blackstack').remove();
                        $('.search-tool').hide();
                        $('.add-product-nav-ul li:nth-child(4)').siblings().removeClass('active');
                        $('.add-product-nav-ul li:nth-child(4)').addClass('active');
                        $(".three-column").slideDown( "slow", function(){});
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
                             var slp =  $('.selectpicker').selectpicker();
                       slp.on('shown.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                          $(e.target).parent().siblings('label').css('z-index', 9999999999);
                         
                        });
                       slp.on('hidden.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                          $(e.target).parent().siblings('label').css('z-index', 555);
                         
                        });
                            $('.search-tool').removeClass('col-md-3');
                              $('.add-product-nav-ul li:nth-child(4)').siblings().removeClass('active');
                        $('.add-product-nav-ul li:nth-child(4)').addClass('active');
                           $(".three-column").slideDown( "slow", function(){});
                            $('.blackstack').remove();
                            $('.search-tool').hide();

                            $(".two-column").slideDown( "slow", function(){});
                               $('.add-product-nav-ul li:nth-child(3)').siblings().removeClass('active');
                        $('.add-product-nav-ul li:nth-child(3)').addClass('active');
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
                    var slp =  $('.selectpicker').selectpicker();
                       slp.on('shown.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                          $(e.target).parent().siblings('label').css('z-index', 9999999999);
                         
                        });
                       slp.on('hidden.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                          $(e.target).parent().siblings('label').css('z-index', 555);
                         
                        });

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
                                <input type="file" name="userfile[]" class="userfile">
                                <button type="button" class="mini-upload upload-button" data-id="" data-target="">UPLOAD</button>
                            </label>
                        </div>
                    </div>`;
            $('.img-full-right-block .inner-img').append(comp);
            e.preventDefault();
            return false;
        });
        $(document).on('change','.userfile',function(){
               fore = fore +1;
               console.log(11);
            comp = `<div class="img-upload-group add bitrix" var-attr="lab_`+fore+`">
                        <div class="reload-form-upload">
                            <label>
                                <input type="file" name="userfile[]" class="userfile">
                                <button type="button" class="mini-upload upload-button" data-id="" data-target="">UPLOAD</button>
                            </label>
                        </div>
                    </div>`;
            $('.img-full-right-block .inner-img').append(comp);
        })
        
    <?php echo '</script'; ?>
>

    <?php echo '<script'; ?>
 type="text/javascript">
    $(document).ready(function (){
      var table = $('#example').DataTable({
          dom: 'lrtip',
          bPaginate: true,
          bLengthChange: false,
          pageLength: 100,
          bFilter: true,
          bInfo: false,
          ordering: false,
          bAutoWidth: false,
          columnDefs: [ {
            targets  : 'no-sort',
            orderable:  false,
            className: 'mdl-data-table__cell--non-numeric'
          }],
          fnDrawCallback: function( oSettings ) {
            $("td.content > span").each(function() {
                if (checkOverflowDubli($(this).parent()) && $(this).parent().siblings("td:first-child").find('.fa-plus').length==0) {
                    $(this).parent().siblings("td:first-child").append('<i class="fa fa-plus open_table"></i>');
                }
            });
            $("td.three > span").each(function() {
                if (checkOverflowDubli($(this).parent()) && $(this).parent().siblings("td:first-child").find('.fa-plus').length==0) {
                    $(this).parent().siblings("td:first-child").append('<i class="fa fa-plus open_table"></i>');
                }
            });
          },
          initComplete: function () {
            // Product Type
            this.api().columns([1]).every( function () {
              var element = [];
              var column = this;
              var select = $(".product_type");
              column.data().unique().sort().each( function ( d, j ) {
                var mar = $(d).text();
                element.push($.trim(mar));
              });
              element = $.uniqueSort(element);
              $.each( element, function ( index, value ) {
                 select.append( '<option value="'+value+'">'+value+'</option>' )
              });
            });

            // Content
            this.api().columns([3]).every( function () {
              var element = [];
              var column = this;
              var select = $(".select_content");
              column.data().unique().sort().each( function ( d, j ) {
                var mar = $(d).find('b');
                $.each(mar, function(res,req){
                  var pass = $.trim($(req).text());
                  element.push($.trim(pass));
                });
              });
              element = $.uniqueSort(element);
              $.each( element, function ( index, value ) {
                 select.append( '<option value="'+value+'">'+value+'</option>' )
              });
            });

            this.api().columns([4]).every( function () {
              var element = [];
              var column = this;
              var select = $(".select_dossage");
              column.data().unique().sort().each( function ( d, j ) {
                var mar = $(d).find('b');
                $.each(mar, function(res,req){
                  var pass = $.trim($(req).text());
                  element.push($.trim(pass));
                });
              });
              element = $.uniqueSort(element);
              $.each( element, function ( index, value ) {
                 select.append( '<option value="'+value+'">'+value+'</option>' )
              });
            });
            this.api().columns([5]).every( function () {
              var element = [];
              var column = this;
              var select = $(".select_country");
              column.data().unique().sort().each( function ( d, j ) {
                var mar = $(d).find('p');
                $.each(mar, function(res,req){
                  var pass = $.trim($(req).text());
                  element.push($.trim(pass));
                });
              });
              element = $.uniqueSort(element);
              $.each( element, function ( index, value ) {
                 select.append( '<option value="'+value+'">'+value+'</option>' )
              });
            });
            this.api().columns([6]).every( function () {
              var element = [];
              var column = this;
              var select = $(".select_medical");
              column.data().unique().sort().each( function ( d, j ) {
                var mar = $(d).find('b');
                $.each(mar, function(res,req){
                  var pass = $.trim($(req).text());
                  element.push($.trim(pass));
                });
              });
              element = $.uniqueSort(element);
              $.each( element, function ( index, value ) {
                 select.append( '<option value="'+value+'">'+value+'</option>' )
              });
            });
            this.api().columns([7]).every( function () {
              var element = [];
              var column = this;
              var select = $(".select_company");
              column.data().unique().sort().each( function ( d, j ) {
                var f = $.trim(d);
                var mar = $(f);
                $.each(mar, function(res,req){
                  var pass = $(req).text();
                  element.push($.trim(pass));
                });
              });
              element = $.uniqueSort(element);
              $.each( element, function ( index, value ) {
                 select.append( '<option value="'+value+'">'+value+'</option>' )
              });
            });
             var slp =  $('.selectpicker').selectpicker();
                       slp.on('shown.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                          $(e.target).parent().siblings('label').css('z-index', 9999999999);
                         
                        });
                       slp.on('hidden.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                          $(e.target).parent().siblings('label').css('z-index', 555);
                         
                        });
         }
      });

      $('.product_type').on('change', function(){
        var search = [];
        $.each($('.product_type option:selected'), function(){
              search.push($(this).val());
        });
        search = search.join('|');
        regExSearch = '^\\s' + search +'\\s*$';
        table.column(1).search(search, true, false).draw();
      });

      $('.select_content').on('change', function(){
        var search = [];
        $.each($('.select_content option:selected'), function(){
              search.push($(this).val());
        });
        search = search.join('|');
        regExSearch = '^\\s' + search +'\\s*$';
        table.column(3).search(search, true, false).draw();
      });
      $('.select_dossage').on('change', function(){
        var search = [];
        $.each($('.select_dossage option:selected'), function(){
              search.push($(this).val());
        });
        search = search.join('|');
        regExSearch = '^\\s' + search +'\\s*$';
        table.column(4).search(search, true, false).draw();
      });
      $('.select_country').on('change', function(){
        var search = [];
        $.each($('.select_country option:selected'), function(){
              search.push($(this).val());
        });
        search = search.join('|');
        regExSearch = '^\\s' + search +'\\s*$';
        table.column(5).search(search, true, false).draw();
      });
      $('.select_medical').on('change', function(){
        var search = [];
        $.each($('.select_medical option:selected'), function(){
              search.push($(this).val());
        });
        search = search.join('|');
        regExSearch = '^\\s' + search +'\\s*$';
        table.column(6).search(search, true, false).draw();
      });
      $('.select_company').on('change', function(){
        var search = [];
        $.each($('.select_company option:selected'), function(){
              search.push($(this).val());
        });
        search = search.join('|');
        regExSearch = '^\\s' + search +'\\s*$';
        table.column(7).search(search, true, false).draw();
      });
      $('.brand_name').on('change', function(){
        var  search = $(this).val();
        table.column(2).search(search, true, false).draw();
      });
    });


    <?php echo '</script'; ?>
>

    <?php echo '<script'; ?>
>
  

   var top_offset1 = 72;
 var top_offset2 = 107;
 var top_offset3 = 242;
 var top_offset33 = 247;
if ($(".searchTable").length){


}


 var somethingChanged = false;
   $('#add-product select').on('change',function(){
     somethingChanged = true;
     console.log($(this));
   });
   $('#add-product input[type="text"]').on('keyup',function(){
     somethingChanged = true;
     console.log($(this));
   });
  
    $(window).bind('beforeunload', function(e){
      if ($(e.target.activeElement).attr('type') != 'submit' && somethingChanged){
           return 'You have unsaved changes; are you sure you want to leave this page?';
         }
   });
$('.bootstrap-select.btn-group').on('click',function(){
    if($(this).hasClass('open')){
        $(this).prev('label').css('z-index','99999999999');
    }
    else{
        $(this).prev('label').css('z-index','555');
    }
})

  
<?php echo '</script'; ?>
>

<?php echo '<script'; ?>
>
    // When the user scrolls the page, execute myFunction
    window.onscroll = function() {myFunction()};

    var eTop = $('#addProductNav').offset().top; //get the offset top of the element


    // Get the navbar
    var navbar = $("#addProductNav");

    // Get the offset position of the navbar
    var sticky = eTop - $(window).scrollTop();

    console.log(sticky);

    // Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
    function myFunction() {
      if (window.pageYOffset >= sticky) {
        navbar.addClass("isfixed")
      } else {
        navbar.removeClass("isfixed");
      }
    }

      $('#addProductNav li a').click(function(e) {
        e.preventDefault();
        var targetUrl = $(this).attr('href');
        $(this).parent().siblings().removeClass('active');
        $(this).parent().addClass('active');
        $('html, body').animate({
            scrollTop: $(targetUrl).offset().top-85
        }, 800);
});


          $(document).on('click', '.remove-item', function() {
      var id = $(this).data('cid');
      var that = $(this);
      if(confirm('Are you sure?')){
    
          var parentrow = that.parent().parent();
          parentrow.remove();
               if(that.parent().parent().hasClass('cas-add-row')){
            $('.casNumber').removeAttr('disabled').removeClass('disabled');
            come--;
          }
         
          console.log($('.search-tool li[data-id="'+id+'"]').length);
          $('.search-tool li[data-id="'+id+'"]').removeClass('selected');
  
        $('.form-group.vared').each(function(index, el) {
            var ind = index+1;
            $(el).find('.label_add_prod label').text('Ingredient '+ind);
        });
             
            }
    });

        $(document).on('click','.search-inner .fa-times', function(){
            $('.search-tool').removeClass('col-md-3');
            $('.blackstack').remove();
            $('.search-tool').hide();
        })

        $(window).scroll(function () {/* 
    var sctop =  $(window).scrollTop() ;
   if(sctop<160){
        $('.add-product-nav-ul li:nth-child(1)').siblings()
    .removeClass('active');
        $('.add-product-nav-ul li:nth-child(1)').addClass('active');
   }
   else if(sctop>=160 && sctop<425){
        $('.add-product-nav-ul li:nth-child(2)').siblings()
    .removeClass('active');
        $('.add-product-nav-ul li:nth-child(2)').addClass('active');
   }
    else if(sctop>=425 && sctop<615){
        $('.add-product-nav-ul li:nth-child(3)').siblings()
    .removeClass('active');
        $('.add-product-nav-ul li:nth-child(3)').addClass('active');
   }
    else{
        $('.add-product-nav-ul li:nth-child(4)').siblings()
    .removeClass('active');
        $('.add-product-nav-ul li:nth-child(4)').addClass('active');
   }
*/});
 $(document).on('submit','.comfirmAccount', function(e){
            e.preventDefault();
            var formData = new FormData($(this)[0]);
            $.ajax({
                type:'POST',
                url:site_url+'profile/comfirmAccount/',
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                success:function(data){
                  var obj = JSON.parse(data);
                  if(obj.type == 'success')
                  {
                    $('#comfirmAccount').modal('hide');
                    $('.left-button-area button').removeAttr('onclick').addClass('send-us-certifcate').text('Send your information');
                    toastr.success(obj.message);
                  }
                  else
                  {
                    toastr.error(obj.message);
                  }
                }
            });
            e.preventDefault();
            return false;
        });

 $(document).ready(function() {
     if($('.dataTables_paginate>span').length == 0){
        $('.dataTables_paginate').hide();
        /*$('#return-to-pages ').on('click', function(){
            window.location ='https://demo.makromedicine.com/profile/create-page';
        })*/
     }
 });




<?php echo '</script'; ?>
>

<?php
}
}
/* {/block 'content'} */
}
