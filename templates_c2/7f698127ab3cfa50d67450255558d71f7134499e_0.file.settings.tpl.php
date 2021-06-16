<?php
/* Smarty version 3.1.30, created on 2020-10-28 16:12:12
  from "/home/makromed/public_html/demo/templates/default/company/settings.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f99601c07b7b4_94234024',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7f698127ab3cfa50d67450255558d71f7134499e' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/default/company/settings.tpl',
      1 => 1603802535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../profile/sidebar.tpl' => 1,
  ),
),false)) {
function content_5f99601c07b7b4_94234024 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_821878805f99601c078f10_84827640', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['layout']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, true);
}
/* {block 'content'} */
class Block_821878805f99601c078f10_84827640 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <link rel="stylesheet" href="<?php echo base_url('templates/default/assets/css/prefix-style.css');?>
" media="all">

    <div class="n_content_area full_width">
    <a href="#" id="openMenu" class="accounts-menu-float">Menu</a>
        <div class="container-fluid">
            <div class="all_modals full_width">
                <div id="changePassword" class="modal fade" role="dialog" style="z-index:999999999999999;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true"><img src="<?php echo base_url('templates/default/assets/images/icons/close_n.png');?>
"/></span></button>
                            </div>
                            <div class="modal-body">
                                <h3>CHANGE PASSWORD</h3>
                                <form class="changePassword" action="<?php echo base_url();?>
profile/changePassword" method="post">
                                    <div class="mod_center_inp change_pss">
                                        <div class="full_width relative">
                                            <label>Current Password</label>
                                            <input type="password" name="current_password"/>
                                            <span class="eye_im"><img src="<?php echo base_url('templates/default/assets/images/icons/eye_bar.png');?>
"/></span>
                                        </div>
                                        <div class="full_width relative">
                                            <label>New Password</label>
                                            <input type="password" name="new_password" />
                                            <span class="eye_im"><img src="<?php echo base_url('templates/default/assets/images/icons/eye.png');?>
"/></span>
                                        </div>
                                        <div class="full_width relative">
                                            <label>Confirm Password</label>
                                            <input type="password" name="re_password" />
                                            <span class="eye_im"><img src="<?php echo base_url('templates/default/assets/images/icons/eye.png');?>
"/></span>
                                        </div>

                                        
                                    </div><!-- /.mod_center_inp -->


                                    <div class="like_btn_n fnt_normal full_width">
                                        <button type="submit" class="send_n">Save</button>
                                        <button type="button" class="back_n" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                

                <?php if ($_smarty_tpl->tpl_vars['user']->value['group_id'] == 2 || $_smarty_tpl->tpl_vars['user']->value['group_id'] == 3 || $_smarty_tpl->tpl_vars['user']->value['group_id'] == 4) {?>
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
                                            <input type="file" name="certifcate" style="display:none;"
                                                   class="certifcate-input"/>
                                            <button type="button" class="btn btn-danger choose-certifcate">Choose
                                                Certifcate
                                            </button>
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
                <?php }?>

            </div>

            <?php if ($_smarty_tpl->tpl_vars['UserData']->value->status != 1 && ($_smarty_tpl->tpl_vars['user']->value['group_id'] == 2 || $_smarty_tpl->tpl_vars['user']->value['group_id'] == 3 || $_smarty_tpl->tpl_vars['user']->value['group_id'] == 4)) {?>
                <div class="row" style="margin-bottom: 1em">
                    <div class="col-sm-12">
                        <div class="alert alert-warning" style="margin-top: 10px;margin-bottom:0">
                            Please <a href="javascript:;" onclick="$('#comfirmAccount').modal();">upload a
                                certificate.</a> After the confirmation of certificate your account will be approved and
                            your products will appear on the top rank of the search list.
                        </div>
                    </div>
                </div>
            <?php }?>
            <div class="row">
                <?php $_smarty_tpl->_subTemplateRender("file:../profile/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

                <div class="n_right_section start_with_text">
                    <div class="with_buttons full_width">
                        <h2>PROFILE INFORMATION</h2>
                        <a href="#" onclick="$('#changePassword').modal();">Change password</a>
                        <a href="<?php echo site_url_multi('/');?>
profile/settings/">Edit Info</a>
                    </div><!-- /.with_buttons -->
                    <h3 class="french">ЗАПОЛНЕННОСТЬ ПРОФИЛЯ</h3>
                    <div class="n_gray_box full_width">
                        <ul>
                            <li><span>1. Заполните профиль информацией,</span><span>2. Добавьте продукты</span></li>
                            <li>От степени заполнения профиля зависит количество доступных вам функций сайта</li>
                        </ul>
                    </div><!-- /.n_gray_box -->
                    <?php $_smarty_tpl->_assignInScope('percent', 0);
?>
                    <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->fullname)) {?>
                        <?php $_smarty_tpl->_assignInScope('percent', $_smarty_tpl->tpl_vars['percent']->value+20);
?>
                    <?php }?>
                    <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->brith_day)) {?>
                        <?php $_smarty_tpl->_assignInScope('percent', $_smarty_tpl->tpl_vars['percent']->value+20);
?>
                    <?php }?>
                    <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->adress)) {?>
                        <?php $_smarty_tpl->_assignInScope('percent', $_smarty_tpl->tpl_vars['percent']->value+20);
?>
                    <?php }?>
                    <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->phone)) {?>
                        <?php $_smarty_tpl->_assignInScope('percent', $_smarty_tpl->tpl_vars['percent']->value+20);
?>
                    <?php }?>
                    <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->email)) {?>
                        <?php $_smarty_tpl->_assignInScope('percent', $_smarty_tpl->tpl_vars['percent']->value+20);
?>
                    <?php }?>

                    <?php $_smarty_tpl->_assignInScope('c', $_smarty_tpl->tpl_vars['percent']->value);
?>
                    <?php $_smarty_tpl->_assignInScope('val1', 0);
?>
                    <?php $_smarty_tpl->_assignInScope('val2', 0);
?>
                    <?php if ($_smarty_tpl->tpl_vars['percent']->value <= 50) {?>
                        <?php $_smarty_tpl->_assignInScope('val1', (180*($_smarty_tpl->tpl_vars['percent']->value*2))/100);
?>
                    <?php } elseif ($_smarty_tpl->tpl_vars['percent']->value > 50) {?>
                        <?php $_smarty_tpl->_assignInScope('val1', 180);
?>
                        <?php $_smarty_tpl->_assignInScope('val2', (180*(($_smarty_tpl->tpl_vars['percent']->value-50)*2))/100);
?>
                    <?php }?>
                    <style>
                        @keyframes loading-1 {
                            0% {
                                -webkit-transform: rotate(0deg);
                                transform: rotate(0deg);
                            }
                            100% {
                                -webkit-transform: rotate(180deg);
                                transform: rotate(<?php echo $_smarty_tpl->tpl_vars['val1']->value;?>
deg);
                            }
                        }

                        @keyframes loading-2 {
                            0% {
                                -webkit-transform: rotate(0deg);
                                transform: rotate(0deg);
                            }
                            100% {
                                -webkit-transform: rotate(144deg);
                                transform: rotate(<?php echo $_smarty_tpl->tpl_vars['val2']->value;?>
deg);
                            }
                        }
                    </style>
                    <div class="n_diagram_detail full_width">
                        <div class="n_diagram">
                            <div class="progress blue">
                    <span class="progress-left">
                        <span class="progress-bar"></span>
                    </span>
                                <span class="progress-right">
                        <span class="progress-bar"></span>
                    </span>
                                <div class="progress-value"><?php echo round($_smarty_tpl->tpl_vars['percent']->value,0);?>
%</div>
                            </div>
                        </div><!-- /.n_diagram -->
                        <div class="n_list_sys">
                            <ul>
                                <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->fullname)) {?>
                                    <li>
                                        <span><img src="<?php echo base_url('templates/default/assets/images/icons/gren.png');?>
"/></span><span>Full Name is available</span>
                                    </li>
                                <?php } else { ?>
                                    <li>
                                        <span><img src="<?php echo base_url('templates/default/assets/images/icons/redd.png');?>
"/></span><span>Full Name is not available</span>
                                    </li>
                                <?php }?>
                                <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->brith_day)) {?>
                                    <li>
                                        <span><img src="<?php echo base_url('templates/default/assets/images/icons/gren.png');?>
"/></span><span>Birthday is available</span>
                                    </li>
                                <?php } else { ?>
                                    <li>
                                        <span><img src="<?php echo base_url('templates/default/assets/images/icons/redd.png');?>
"/></span><span>Birthday is not available</span>
                                    </li>
                                <?php }?>

                                <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->adress)) {?>
                                    <li>
                                        <span><img src="<?php echo base_url('templates/default/assets/images/icons/gren.png');?>
"/></span><span>Address is available</span>
                                    </li>
                                <?php } else { ?>
                                    <li>
                                        <span><img src="<?php echo base_url('templates/default/assets/images/icons/redd.png');?>
"/></span><span>Address is not available</span>
                                    </li>
                                <?php }?>

                                <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->phone)) {?>
                                    <li>
                                        <span><img src="<?php echo base_url('templates/default/assets/images/icons/gren.png');?>
"/></span><span>Phone is available</span>
                                    </li>
                                <?php } else { ?>
                                    <li>
                                        <span><img src="<?php echo base_url('templates/default/assets/images/icons/redd.png');?>
"/></span><span>Phone is not available</span>
                                    </li>
                                <?php }?>

                                <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->email)) {?>
                                    <li>
                                        <span><img src="<?php echo base_url('templates/default/assets/images/icons/gren.png');?>
"/></span><span>Email is available</span>
                                    </li>
                                <?php } else { ?>
                                    <li>
                                        <span><img src="<?php echo base_url('templates/default/assets/images/icons/redd.png');?>
"/></span><span>Email is not available</span>
                                    </li>
                                <?php }?>
                            </ul>
                        </div><!-- /.n_list_sys -->
                        <hr>
                    </div><!-- /.n_diagram_detail -->

                    <div class="full_width max-arrange">
                        <div class="with_buttons full_width m20s">
                            <h2>COMPANY INFORMATION</h2>
                            <a href="<?php echo site_url_multi('/');?>
pages/<?php echo $_smarty_tpl->tpl_vars['UserData']->value->slug;?>
" style="width: 150px;" target="_blank">Page</a>
                            <a href="<?php echo site_url_multi('/');?>
companies/<?php echo $_smarty_tpl->tpl_vars['UserData']->value->slug;?>
" style="width: 150px;" target="_blank">Public Page</a>
                        </div><!-- /.personal_info -->
                        <div class="step_n_modal full_width">
                            <label>Steps</label>
                            <span class="step-selector sel1 active" data-step="step1" data-step-count="1">1</span>
                            <span class="step-selector sel2" data-step="step2" data-step-count="2">2</span>
                            <span class="step-selector sel3" data-step="step3" data-step-count="3">3</span>
                            <span class="step-selector sel4" data-step="step4" data-step-count="4">4</span>
                        </div><!-- /.step_n_modal -->

                        <form class="userSettings" action="<?php echo base_url();?>
profile/save" enctype="multipart/form-data"
                              method="post">
                            <div class="n_like_form full_width step1 steps">
                                <div class="n_first_block">
                                    <div class="full_width" style="position: relative">
                                        <label>Company Name <sup>*</sup></label>
                                        <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->company_name)) {?>
                                            <input type="text" name="company_name" id="company-name"
                                                   class="readonly"
                                                   placeholder="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->company_name;?>
"
                                                   value="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->company_name;?>
" disabled>
                                            <input type="hidden" name="company_name"
                                                   value="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->company_name;?>
">
                                        <?php } else { ?>
                                            <input type="text" name="company_name" id="company-name"
                                                   class="readonly" placeholder="" value="">
                                        <?php }?>

                                    </div><!-- /.full_width -->
                                    <div class="full_width sel_full">
                                        <label>Status <sup>*</sup></label>
                                        <select name="group_id" class="n_select">
                                            <option value="2" <?php if ($_smarty_tpl->tpl_vars['user']->value['group_id'] == 2) {?> selected="selected" <?php }?> >
                                                Manufacturer
                                            </option>
                                            <option value="3" <?php if ($_smarty_tpl->tpl_vars['user']->value['group_id'] == 3) {?> selected="selected" <?php }?>>
                                                Distributor
                                            </option>
                                            <option value="4" <?php if ($_smarty_tpl->tpl_vars['user']->value['group_id'] == 4) {?> selected="selected" <?php }?>>
                                                Agent
                                            </option>
                                            <option value="5" <?php if ($_smarty_tpl->tpl_vars['user']->value['group_id'] == 5) {?> selected="selected" <?php }?> <?php if ($_smarty_tpl->tpl_vars['user']->value['group_id'] == 2 || $_smarty_tpl->tpl_vars['user']->value['group_id'] == 3 || $_smarty_tpl->tpl_vars['user']->value['group_id'] == 4) {?> disabled <?php }?>>
                                                Manager
                                            </option>
                                            <option value="6" <?php if ($_smarty_tpl->tpl_vars['user']->value['group_id'] == 6) {?> selected="selected" <?php }?> <?php if ($_smarty_tpl->tpl_vars['user']->value['group_id'] == 2 || $_smarty_tpl->tpl_vars['user']->value['group_id'] == 3 || $_smarty_tpl->tpl_vars['user']->value['group_id'] == 4) {?> disabled <?php }?>>
                                                User
                                            </option>
                                        </select>
                                    </div><!-- /.full_width -->
                                    <div class="full_width sel_full">
                                        <label>Field of activity <sup>*</sup></label>
                                        <select class="selectpicker"
                                                name="product_type[]" multiple data-live-search="true"
                                                data-selected-text-format="count > 1" title="Field of activity">
                                            <?php if ($_smarty_tpl->tpl_vars['product_type']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product_type']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
                                                <option <?php if ($_smarty_tpl->tpl_vars['selected_product_type']->value) {
if (in_array($_smarty_tpl->tpl_vars['value']->value->id,$_smarty_tpl->tpl_vars['selected_product_type']->value)) {?> selected <?php }
}?>
                                                        value="<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
</option>
                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                                        </select>
                                    </div><!-- /.full_width -->
                                    <div class="full_width sel_full">
                                        <label>Standard <!--<a href="#" onclick="$('#acntVerfication').modal();">Upload Files</a>--></label>
                                            <select name="standart[]"
                                                    class="selectpicker standart"
                                                    multiple data-live-search="true"
                                                    data-selected-text-format="count > 1" title="Standard">
                                                <?php if ($_smarty_tpl->tpl_vars['standarts']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['standarts']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
                                                    <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
" <?php if ($_smarty_tpl->tpl_vars['selected_standart']->value) {
if (in_array($_smarty_tpl->tpl_vars['value']->value->id,$_smarty_tpl->tpl_vars['selected_standart']->value)) {?> selected <?php }
}?>><?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
</option>
                                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                                            </select>
                                        <div class="img-full-right-block img_forece" id="img_forece"></div>
                                        <!--
                                        <div class="all_modals full_width">
                                                <div id="acntVerfication" class="modal fade" role="dialog" style="z-index:999999999999999;">
                                                    <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                    <div class="modal-header" style="background: none;">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><img src="<?php echo base_url('templates/default/assets/images/icons/close_n.png');?>
"/></span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h3>ACCOUNT VERIFICATION</h3>
                                                        <p>Введите необходимые документы, для подтверждения подлинности компании.<br> Ваш аккаунт будет верифицирован после подтверждения модераторами.</p>
                                                        <div class="mod_center_inp_textarea">
                                                            <div class="img-full-right-block img_forece"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                        -->
                                    </div><!-- /.full_width -->

                                    <div class="full_width date_of_brth">
                                        <label>Establishment date <sup>*</sup></label>
                                        <input type="text" name="establishment_date" id="company-date"
                                               class="" placeholder="Establishment date"
                                               value="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->establishment_date;?>
">
                                    </div><!-- /.full_width -->

                                    <div class="full_width">
                                        <label>Website</label>
                                        <input type="text" name="website" id="company-tags"
                                                placeholder="" value="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->website;?>
">
                                    </div><!-- /.full_width -->

                                </div><!-- /.n_first_block -->

                                <div class="n_second_block">
                                    <div class="full_width">
                                        <label>Country <sup>*</sup></label>
                                        <select class="selectpicker company-country"
                                                name="country_id" data-live-search="true"
                                                data-selected-text-format="count > 1" title="Country">
                                            <?php if ($_smarty_tpl->tpl_vars['countrys']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['countrys']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
                                                <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
" data-name="<?php echo $_smarty_tpl->tpl_vars['value']->value->code;?>
"
                                                        <?php if ($_smarty_tpl->tpl_vars['value']->value->id == $_smarty_tpl->tpl_vars['UserData']->value->country_id) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
</option>
                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                                        </select>
                                    </div><!-- /.full_width -->
                                    <div class="full_width">
                                        <label>Address</label>
                                        <input type="text" name="company_address" id="pac-input"
                                               class="my-address controls"
                                               autocomplete="false" placeholder="Search your address"
                                               value="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->company_address;?>
"/>
                                        <input type="hidden" name="company_lat" class="company_lat"
                                               value="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->company_lat;?>
"/>
                                        <input type="hidden" name="company_lng" class="company_lng"
                                               value="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->company_lng;?>
"/>
                                    </div><!-- /.full_width -->

                                    <div class="full_width map__ map__2">
                                        <div  id="map"></div>
                                    </div><!-- map__-->

                                    <div class="full_width">
                                        <label>Tags</label>
                                        <input type="text" name="tags[]" id="company-tags"
                                               class="tagsinput" value="<?php echo $_smarty_tpl->tpl_vars['tags']->value;?>
">
                                    </div><!-- /.full_width -->

                                </div><!-- /.n_second_block -->
                            </div><!-- /.n_like_form -->

                            <div class="n_like_form full_width step2 steps">
                               

                                <div class="upload_img_area">
                                    <div class="upload-btn-wrapper">
                                        <button class="btn">Add Logo</button>
                                        <input type="file" name="company_logo" id="company_logo"
                                               value="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->company_logo;?>
"
                                               class="form-control mylos company_logo">
                                    </div>

                                    <div class="add_logo_n" id="company_logo_wrapper" data-image="<?php echo site_url();?>
uploads/catalog/users/<?php echo str_replace(array(site_url(),'uploads/catalog/users/'),array('',''),$_smarty_tpl->tpl_vars['UserData']->value->company_logo);?>
">

                                    </div>
                                </div>

                                
                                <div class="upload_img_area">
                                    <div class="upload-btn-wrapper cov">
                                        <button class="btn">Add Cover Photo</button>
                                        <input type="file" name="company_banner" id="company_banner"
                                               value="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->company_banner;?>
"
                                               class="company_banner">
                                    </div>

                                    <div class="add_cover_n" id="company_cover_wrapper" data-image="<?php echo site_url();?>
uploads/catalog/users/<?php echo str_replace(array(site_url(),'uploads/catalog/users/'),array('',''),$_smarty_tpl->tpl_vars['UserData']->value->company_banner);?>
">

                                    </div>
                                </div>

                                <div class="full_width text_stl">
                                    <label>About Company</label>
                                    <textarea name="company_info" id="company-info"><?php echo $_smarty_tpl->tpl_vars['UserData']->value->company_info;?>
</textarea>
                                </div><!-- /.full_width -->
                            </div><!-- /.n_like_form -->

                            <div class="n_like_form full_width step3 steps">
                                <div class="responsible-company-inner">
                                <?php if ($_smarty_tpl->tpl_vars['company_info']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['company_info']->value, 'company', false, 'secret');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['secret']->value => $_smarty_tpl->tpl_vars['company']->value) {
?>
                                    <div class="form-group"
                                         style="border-top:1px solid #ddd;padding-top: 20px;">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="company-status" class="round"> Full
                                                    Name </label>
                                                <input type="text" name="company[fullname][][]"
                                                       id="company-status" class="form-control mylos"
                                                       value="<?php echo $_smarty_tpl->tpl_vars['company']->value->fullname;?>
">
                                            </div>
                                            <div class="form-group copiered_company">
                                                <label for="company-phone" class="round"> Phone </label>
                                                <input type="hidden" name="company[code][][]"
                                                       class="dial-up"
                                                       value="<?php if (empty($_smarty_tpl->tpl_vars['company']->value->code)) {
echo $_smarty_tpl->tpl_vars['UserData']->value->country_code;
} else {
echo $_smarty_tpl->tpl_vars['company']->value->code;
}?>">
                                                <input type="phone" name="company[phone][][]" id="phone"
                                                       class="form-control inputmask mylos <?php if (empty($_smarty_tpl->tpl_vars['company']->value->code)) {?> phones <?php } else { ?> phones <?php }?>"
                                                       value="<?php echo $_smarty_tpl->tpl_vars['company']->value->phone;?>
"
                                                       data-co="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->country_code;?>
">
                                            </div>
                                        </div>
                                        <div class="col-md-4 no-padding">
                                            <div class="form-group">
                                                <label for="company-status" class="round"> Email </label>
                                                <input type="text" name="company[email][][]"
                                                       id="company-status" class="form-control mylos"
                                                       value="<?php echo $_smarty_tpl->tpl_vars['company']->value->email;?>
">
                                            </div>
                                            <div class="form-group">
                                                <label for="company-ext" class="fill"> Type </label>
                                                <select class="selectpicker form-control show-menu-arrow mylos"
                                                        name="company[phone_type][][]"
                                                        data-live-search="true"
                                                        data-selected-text-format="count > 1" title="Type">
                                                    <?php if ($_smarty_tpl->tpl_vars['phone_type']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['phone_type']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
                                                        <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
" <?php if ($_smarty_tpl->tpl_vars['company']->value->phone_type == $_smarty_tpl->tpl_vars['value']->value->id) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
</option>
                                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="form-group has-suggestion">
                                                    <label for="company-ext" class="fill">Person
                                                        Type </label>
                                                    <select class="selectpicker form-control show-menu-arrow mylos "
                                                            name="company[person_type][][]"
                                                            data-live-search="true"
                                                            data-selected-text-format="count > 1"
                                                            required
                                                            title="Person Type">
                                                        <?php if ($_smarty_tpl->tpl_vars['person_type']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['person_type']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
                                                            <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
" <?php if ($_smarty_tpl->tpl_vars['company']->value->person_type == $_smarty_tpl->tpl_vars['value']->value->id) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
</option>
                                                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12 no-padding">
                                                    <label for="company-ext" class="fill"> Ext </label>
                                                    <input type="text" name="company[ext][][]"
                                                           id="company-ext" class="form-control mylos"
                                                           value="<?php echo $_smarty_tpl->tpl_vars['company']->value->ext;?>
">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>


                                <?php } else { ?>
                                    <div class="form-group"
                                         style="border-top:1px solid #ddd;padding-top: 20px;">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="company-status" class="round"> Full
                                                    Name </label>
                                                <input type="text" name="company[fullname][][]"
                                                       id="company-status" class="form-control mylos"
                                                       value="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->fullname;?>
">
                                            </div>
                                            <div class="form-group copiered_company">
                                                <label for="company-phone" class="round"> Phone </label>
                                                <input type="hidden" name="company[code][][]"
                                                       class="dial-code" value="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->country_code;?>
">
                                                <input type="phone" name="company[phone][][]" id="phone"
                                                       class=""
                                                       value="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->phone;?>
"
                                                       data-co="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->country_code;?>
">
                                            </div>
                                        </div>
                                        <div class="col-md-4 no-padding">
                                            <div class="form-group">
                                                <label for="company-status" class="round"> Email </label>
                                                <input type="text" name="company[email][][]"
                                                       id="company-status" class="form-control mylos"
                                                       value="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->email;?>
">
                                            </div>
                                            <div class="form-group">
                                                <label for="company-ext" class="fill"> Type </label>
                                                <select class="selectpicker form-control show-menu-arrow mylos"
                                                        name="company[phone_type][][]"
                                                        data-live-search="true"
                                                        data-selected-text-format="count > 1" title="Type">
                                                    <?php if ($_smarty_tpl->tpl_vars['phone_type']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['phone_type']->value, 'value', false, 'key');
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
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="form-group has-suggestion">
                                                    <label for="company-ext" class="fill">Person
                                                        Type </label>
                                                    <select class="selectpicker form-control show-menu-arrow mylos mb-20"
                                                            name="company[person_type][][]"
                                                            data-live-search="true"
                                                            data-selected-text-format="count > 1"
                                                            required
                                                            title="Person Type">
                                                        <?php if ($_smarty_tpl->tpl_vars['person_type']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['person_type']->value, 'value', false, 'key');
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
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-9 no-padding">
                                                    <label for="company-ext" class="fill"> Ext </label>
                                                    <input type="text" name="company[ext][][]"
                                                           id="company-ext" class="form-control mylos"
                                                           value="">
                                                </div>
                                                <div class="col-md-3 no-padding"
                                                     style="padding-top:25px;padding-right:10px;">
                                                    <button type="button" style="height: 32px;"
                                                            class="btn btn-danger btn-bix pull-right remove-item-phone"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="" data-original-title="Sil"><i
                                                                class="fa fa-trash"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                <?php }?>
                                </div>
                                <div class="full_width admoreplus">
                                    <a href="#" class="confirm-btn responsible-btn" data-target="company">Add More +</a>
                                </div><!-- /.admoreplus -->

                                <hr class="thrx">

                                <div class="full_width n_like_form">
                                    <div class="n_first_block">
                                        <div class="full_width">
                                            <label>Facebook</label>
                                            <input type="text" name="company_facebook" id="company-status"
                                                   value="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->company_facebook;?>
">
                                        </div><!-- /.full_width -->
                                        <div class="full_width">
                                            <label>Youtube</label>
                                            <input type="text" name="company_youtube" id="company-status"
                                                   value="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->company_youtube;?>
">
                                        </div><!-- /.full_width -->
                                    </div><!-- /.n_first_block -->

                                    <div class="n_second_block">
                                        <div class="full_width">
                                            <label>Twitter</label>
                                            <input type="text" name="company_twitter" id="company-activity"
                                                   value="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->company_twitter;?>
">
                                        </div><!-- /.full_width -->
                                        <div class="full_width">
                                            <label>Linkedin</label>
                                            <input type="text" name="company_linkedin" id="company-activity"
                                                   value="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->company_linkedin;?>
">
                                        </div><!-- /.full_width -->
                                    </div><!-- /.n_first_block -->
                                </div><!-- /.full_width -->
                            </div><!-- /.n_like_form -->

                            <div class="full_width sel_item_adj step4 steps">
                                <div class="comon_h3">
                                    <h3>Products</h3>
                                    <a href="<?php echo base_url('/product');?>
" class="add-product" id="save-and-add-product">Add Product</a>
                                </div>
                            </div><!-- /.sel_item_adj -->

                            <div class="btn_wrap full_width">
                                <div class="btn_wrap hasfull full_width">
                                    <a href="#" id="company_next" class="n_cancel">Previous</a>
                                    <a href="#" id="company_prev" class="n_save">Next</a>
                                    <input id="submit_btn" type="submit" class="n_save">
                                </div><!-- /.btn_wrap -->
                            </div><!-- /.btn_wrap -->
                        </form>
                    </div><!-- /.max_arrange -->
                </div><!-- /.n_right_section -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.n_content_area -->

    <?php echo '<script'; ?>
>
        $(document).ready(function () {
           $('.step-selector').on('click', function(ev){
               ev.preventDefault();
               $('.step-selector').removeClass('active');
               $(this).addClass('active');
               var currentStep = $(this).attr('data-step');
               $('.steps').fadeOut();
               $('.'+currentStep).fadeIn();
           });

           // Next Prev click
            $("#company_prev").on('click', function(ev){
                ev.preventDefault();
                var currentStep = $(".step-selector.active").attr("data-step");
                var currentStepCount = parseInt($(".step-selector.active").attr("data-step-count"));
                var nextStep = currentStepCount+1;
                if(nextStep <= 4) {
                    $('.step-selector').removeClass('active');
                    $('.sel'+nextStep).addClass('active');
                    $('.steps').fadeOut();
                    $('.step'+nextStep).fadeIn();
                }
            });
            $("#company_next").on('click', function(ev){
                ev.preventDefault();
                var currentStep = $(".step-selector.active").attr("data-step");
                var currentStepCount = parseInt($(".step-selector.active").attr("data-step-count"));
                var previousStep = currentStepCount-1;
                if(previousStep > 0) {
                    $('.step-selector').removeClass('active');
                    $('.sel'+previousStep).addClass('active');
                    $('.steps').fadeOut();
                    $('.step'+previousStep).fadeIn();
                }
            });
        });
    <?php echo '</script'; ?>
>




    <div class="clearfix"></div>
    <div class="">
        <div class="container">
            
            <div id="changeCompanyName" class="modal fade" role="dialog" style="z-index:999999999999999;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form class="changeCompanyName" action="<?php echo base_url();?>
profile/changeCompanyName" method="post">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title data-title">Please enter new company name</h4>
                            </div>
                            <div class="modal-body data-response">
                                <div class="form-group">
                                    <label for="company-date">New Company Name </label>
                                    <input type="text" name="new_company_name" class="form-control mylos"
                                           placeholder="New Company Name" required>
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
                                    <input type="file" name="certifcate" style="display:none;"
                                           class="certifcate-input"/>
                                    <button type="button" class="btn btn-danger choose-certifcate">Choose Certifcate
                                    </button>
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
        </div>
    </div>
    <div class="clearfix"></div>
    <?php if (isset($_GET['same_comp'])) {?>
        <?php echo '<script'; ?>
>
            var err = 'Account already exists on the system with that company name.  Please enter a different company name.';
            $(document).ready(function () {
                toastr.error(err);
            });
        <?php echo '</script'; ?>
>
    <?php }?>
    <?php echo '<script'; ?>
 type="text/javascript">
        function addPhone(count, target) {
            var component = `<div class="form-group label_"` + count + ` style="border-top:1px solid #ddd;padding-top: 20px;">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="company-status" class="round"> Full Name </label>
                    <input type="text" name="` + target + `[fullname][` + count + `][]" id="company-status" class="form-control mylos" >
                </div>
                <div class="form-group copiered_` + target + `">
                    <label for="company-phone" class="round"> Phone </label>
                    <input type="hidden" name="` + target + `[code][` + count + `][]" class="dial-code" value="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->country_code;?>
">
                    <input type="phone" name="` + target + `[phone][` + count + `][]" id="phone" class="form-control inputmask phone mylos phone_br"  value="">
                </div>
            </div>
            <div class="col-md-4 no-padding">
                <div class="form-group">
                    <label for="company-status" class="round"> Email </label>
                    <input type="text" name="` + target + `[email][` + count + `][]" id="company-status" class="form-control mylos" >
                </div>
                <div class="form-group">
                    <label for="company-ext" class="fill"> Type </label>
                    <select class="selectpicker form-control show-menu-arrow mylos" name="` + target + `[phone_type][` + count + `][]" data-live-search="true" data-selected-text-format="count > 1" title="Type">
                        <?php if ($_smarty_tpl->tpl_vars['phone_type']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['phone_type']->value, 'value', false, 'key');
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
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <div class="form-group has-suggestion">
                        <label for="company-ext" class="fill">Person Type </label>
                        <select required class="selectpicker form-control show-menu-arrow mylos mb-20" name="` + target + `[person_type][` + count + `][]" data-live-search="true" data-selected-text-format="count > 1" title="Person Type">
                            <?php if ($_smarty_tpl->tpl_vars['person_type']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['person_type']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
</option>SS
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-9 no-padding">
                        <label for="company-ext" class="fill"> Ext </label>
                        <input type="text" name="` + target + `[ext][` + count + `][]" id="company-ext" class="form-control mylos">
                    </div>
                    <div class="col-md-3 no-padding" style="padding-top:25px;padding-right:10px;">
                        <button type="button" style="height: 31px;" class="btn btn-danger btn-bix pull-right remove-item-phone" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"> <i class="fa fa-trash"></i> </button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>`;
            return component;
        }
    <?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFH8I3kyiSc5ZOCMFnRoKyDipc3yTFoKQ&libraries=places&callback=initAutocomplete"
            async defer><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
>
        <?php if ($_smarty_tpl->tpl_vars['get_confirm_status']->value == false) {?>
        <?php if ($_smarty_tpl->tpl_vars['UserData']->value->status == 0) {?>
        // $('#comfirmAccount').modal();
        $("verify_account_modal").on('click', function(){
            $('#comfirmAccount').modal();
        });
        <?php }?>
        <?php }?>
        <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->company_lat) || !empty($_smarty_tpl->tpl_vars['UserData']->value->company_lng)) {?>
        var json_lat = <?php echo $_smarty_tpl->tpl_vars['UserData']->value->company_lat;?>
;
        var json_lng = <?php echo $_smarty_tpl->tpl_vars['UserData']->value->company_lng;?>
;
        var json_title = '<?php echo $_smarty_tpl->tpl_vars['UserData']->value->company_address;?>
';
        
        function initAutocomplete() {
            var myLatLng = {lat: json_lat, lng: json_lng};
            var map = new google.maps.Map(document.getElementById('map'), {
                center: myLatLng,
                zoom: 15,
                mapTypeId: 'roadmap'
            });
            var image = {
                url: 'https://maps.gstatic.com/mapfiles/place_api/icons/geocode-71.png',
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(25, 25)
            };
            var beachMarker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                icon: image
            });
            var input = document.getElementById('pac-input');
            var searchBox = new google.maps.places.SearchBox(input);
            map.addListener('bounds_changed', function () {
                searchBox.setBounds(map.getBounds());
            });
            var markers = [];
            searchBox.addListener('places_changed', function () {

                var places = searchBox.getPlaces();
                if (places.length == 0) {
                    return;
                }
                markers.forEach(function (marker) {
                    marker.setMap(null);
                });

                markers = [];
                var bounds = new google.maps.LatLngBounds();
                places.forEach(function (place) {
                    if (!place.geometry) {
                        console.log("Returned place contains no geometry");
                        return;
                    }
                    var icon = {
                        url: place.icon,
                        size: new google.maps.Size(71, 71),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(17, 34),
                        scaledSize: new google.maps.Size(25, 25)
                    };
                    markers.push(new google.maps.Marker({
                        map: map,
                        icon: icon,
                        title: place.name,
                        position: place.geometry.location
                    }));
                    $('.company_lat').val(place.geometry.location.lat());
                    $('.company_lng').val(place.geometry.location.lng());
                    if (place.geometry.viewport) {
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                map.fitBounds(bounds);
            });
        }
        
        <?php } else { ?>
        var json_title = '<?php echo $_smarty_tpl->tpl_vars['UserData']->value->company_name;?>
';
        
        function initAutocomplete() {
            $.ajax({
                url: "https://ipinfo.io/?callback=",
                type: "GET",
                dataType: 'json',
                cache: true,
                success: function (data, status, error) {
                    var reg = data.loc.split(',');
                    var myLatLng = {lat: parseFloat(reg[0]), lng: parseFloat(reg[1])};
                    var map = new google.maps.Map(document.getElementById('map'), {
                        center: myLatLng,
                        zoom: 15,
                        mapTypeId: 'roadmap'
                    });
                    var image = {
                        url: 'https://maps.gstatic.com/mapfiles/place_api/icons/geocode-71.png',
                        size: new google.maps.Size(71, 71),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(17, 34),
                        scaledSize: new google.maps.Size(25, 25)
                    };
                    var beachMarker = new google.maps.Marker({
                        position: myLatLng,
                        map: map,
                        icon: image
                    });
                    var input = document.getElementById('pac-input');
                    var searchBox = new google.maps.places.SearchBox(input);
                    map.addListener('bounds_changed', function () {
                        searchBox.setBounds(map.getBounds());
                    });
                    var markers = [];
                    searchBox.addListener('places_changed', function () {
                        var places = searchBox.getPlaces();
                        if (places.length == 0) {
                            return;
                        }
                        markers.forEach(function (marker) {
                            marker.setMap(null);
                        });
                        markers = [];
                        var bounds = new google.maps.LatLngBounds();
                        places.forEach(function (place) {
                            if (!place.geometry) {
                                console.log("Returned place contains no geometry");
                                return;
                            }
                            var icon = {
                                url: place.icon,
                                size: new google.maps.Size(71, 71),
                                origin: new google.maps.Point(0, 0),
                                anchor: new google.maps.Point(17, 34),
                                scaledSize: new google.maps.Size(25, 25)
                            };
                            markers.push(new google.maps.Marker({
                                map: map,
                                icon: icon,
                                title: place.name,
                                position: place.geometry.location
                            }));
                            $('.company_lat').val(place.geometry.location.lat());
                            $('.company_lng').val(place.geometry.location.lng());
                            if (place.geometry.viewport) {
                                bounds.union(place.geometry.viewport);
                            } else {
                                bounds.extend(place.geometry.location);
                            }
                        });
                        map.fitBounds(bounds);
                    });
                }
            });
        }
        
        <?php }?>

        var social1 = true;
        var social2 = true;
        var social3 = true;
        var social4 = true;
        var web = true;
        $(document).ready(function () {
            
            $(document).on('click', '.send-us-certifcate', function () {
                toastr.info('Your information has been sent successfully. We will send your information but after checking.');
            });
            $(document).on('click', '.remove-image', function (e) {
                e.preventDefault();
                var attr = $(this).attr('data-id');
                var user_id = $(this).attr('user-id');
                $.ajax({
                    type: 'POST',
                    url: site_url + 'profile/deleteimg/',
                    data: {'value': attr, 'user_id': user_id},
                    cache: false,
                    success: function (data) {
                        if (data == 'true') {
                            $('.bitrix.block_' + attr).remove();
                            $('.standart option[value="' + attr + '"]').removeAttr('selected');
                            $('.selectpicker').selectpicker('refresh');
                            toastr.success('This image delete successful !');
                        } else {
                            toastr.danger('Can not delete this image !');
                        }
                    }
                });
                e.preventDefault();
                return false;
            });
            $(document).on('click', '.upload-btn-box', function (e) {
                e.preventDefault();
                $(this).parent().find('input[type="file"]').trigger('click');
                e.preventDefault();
                return false;
            });
            var count = 0;
            $(document).on('click', '.responsible-btn', function (ev) {
                ev.preventDefault();
                count = count + 1;
                var target = $(this).attr('data-target');
                var component = addPhone(count, target);
                var dial_codes = $('.dial-codes').val();
                $('.responsible-' + target + '-inner').append(component);
                $('.selectpicker').selectpicker('refresh');
                //    $('.inputmask.phone').inputmask({"mask": "99 999-99-99"});
                $('.phone').intlTelInput({
                    
                    <?php if (isset($_smarty_tpl->tpl_vars['UserData']->value->country_code) && $_smarty_tpl->tpl_vars['UserData']->value->country_code != '') {?>
                    initialCountry: '<?php echo $_smarty_tpl->tpl_vars['UserData']->value->country_code;?>
',
                    <?php } else { ?>
                    
                    initialCountry: "auto",
                    geoIpLookup: function (callback) {
                        $.get("https://ipinfo.io", function () {
                        }, "jsonp").always(function (resp) {
                            var countryCode = resp.country;
                            callback(countryCode);
                        });
                    }
                    
                    <?php }?>
                    
                });
            });
            
            $(document).on('click', '.remove-item-phone', function () {
                $(this).parent().parent().parent().parent().remove();
            });
            var general = <?php echo $_smarty_tpl->tpl_vars['tag_maps']->value;?>
;
            var citynames = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                local: $.map(general, function (city) {
                    return {
                        value: city.value,
                        name: city.name
                    };
                })
            });
            $('input.tagsinput').tagsinput({
                typeaheadjs: {
                    name: 'citynames',
                    displayKey: 'name',
                    valueKey: 'name',
                    source: citynames.ttAdapter()
                }
            });
            $('.standart').change(function (e) {
                var standart = $(this).val();
                // var st_text = $(this).find('option:selected').text();
                $.each(standart, function (index, value) {
                    if (!$('.img_forece .bitrix').hasClass("block_" + value)) {
                        var st_text = $('.standart').find('option[value="' + value + '"]').text();
                        var comp = `<div class="img-upload-group bitrix block_` + value + `" var-attr="` + value + `">
                        <div class="reload-form-upload">
                            <label>
                                <input type="file" name="userfile[` + value + `]">
                                <button type="button" class="mini-upload upload-button" data-id="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->id;?>
" data-target="standart"></button>
                            </label>
                        </div>
                        <span title="` + st_text + `"> ` + st_text + `</span>
                    </div>`;
                        $('.img_forece').append(comp);
                    }
                });
                var valid = [];
                $('.bitrix').each(function (index, value) {
                    valid.push($(value).attr('var-attr'));
                });
                var difference = [];
                $.grep(valid, function (el) {
                    if (jQuery.inArray(el, standart) == -1) difference.push(el);
                });
                difference.forEach(function (element) {
                    $('.bitrix.block_' + element).remove();
                });
            });

            $(document).on('submit', '.userSettings', function (e) {
                e.preventDefault();
                if (social1 && social2 && social3 && social4 && web) {

                    var formData = new FormData($(this)[0]);
                    $.ajax({
                        type: 'POST',
                        url: site_url + 'profile/save/',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            toastr.success('Profile update successful !');
                            window.location = '';
                        }
                    });
                } else {
                    toastr.error('Form has errors');
                }
            });


            $(document).on('click', '#save-and-add-product', function(e){
                e.preventDefault();
                if (social1 && social2 && social3 && social4 && web) {

                    var formData = new FormData($(".userSettings")[0]);
                    $.ajax({
                        type: 'POST',
                        url: site_url + 'profile/save/',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            toastr.success('Profile update successful !');
                            window.location = site_url+'/product';
                        }
                    });
                } else {
                    toastr.error('Form has errors');
                }
            })

            $(document).on('submit', '.changeCompanyName', function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: site_url + 'profile/changeCompanyName/',
                    data: $(this).serialize(),
                    cache: false,
                    success: function (data) {
                        console.log(data);
                        if (data == 'true') {
                            $('#changeCompanyName').modal('hide');
                            toastr.success('Your succestion send successfuly');
                        } else if (data == 'same') {
                            var err = 'Account already exists on the system with that company name.  Please enter a different company name.';
                            toastr.error(err);
                        } else {
                            $('#changeCompanyName').modal('hide');
                            toastr.error('You are not permision change company name');
                        }
                    }
                });
                e.preventDefault();
                return false;
            });
            $(document).on('submit', '.changePassword', function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: site_url + 'profile/changePassword/',
                    data: $(this).serialize(),
                    cache: false,
                    success: function (data) {
                        var obj = JSON.parse(data);
                        $('#changePassword').modal('hide');
                        if (obj.type == 'success') {
                            $('#changePassword').modal('hide');
                            toastr.success(obj.message);
                        } else {
                            toastr.error(obj.message);
                        }
                    }
                });
                e.preventDefault();
                return false;
            });
            $(document).on('submit', '.comfirmAccount', function (e) {
                e.preventDefault();
                var formData = new FormData($(this)[0]);
                $.ajax({
                    type: 'POST',
                    url: site_url + 'profile/comfirmAccount/',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        var obj = JSON.parse(data);
                        if (obj.type == 'success') {
                            $('#comfirmAccount').modal('hide');
                            $('.left-button-area button').removeAttr('onclick').addClass('send-us-certifcate').text('Send your information');
                            toastr.success(obj.message);
                        } else {
                            toastr.error(obj.message);
                        }
                    }
                });
                e.preventDefault();
                return false;
            });
            $(document).on('click', '.userphotos-change', function () {
                $('input.userphotos').click();
            })
            
            $(document).on('submit', '.userphotos_form', function (e) {
                e.preventDefault();
                var formData = new FormData($(this)[0]);
                $.isLoading({text: ""});
                $.ajax({
                    type: 'POST',
                    url: site_url + 'profile/userphotos/',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        console.log(data);
                        if (data == 'false') {
                            toastr.warning('This profile image not upload. Please refresh page or <a target="_blank" href="' + site_url + 'contact">Contact us</a>');
                        } else {
                            toastr.success('Profile update successful !');
                            if ($('.round-image img').attr('src', site_url + 'uploads/catalog/users/' + data)) {
                                $.isLoading("hide");
                            }
                        }
                    }
                });
                e.preventDefault();
                return false;
            });

            $(document).on('change', '.userphotos', function (e) {
                e.preventDefault();
                $('.userphotos_form').submit();
                e.preventDefault();
                return false;
            });
            $(document).on('click', '.choose-certifcate', function () {
                $('.certifcate-input').click();
            });
            $(document).on('change', '.certifcate-input', function () {
                var filename = $(this).val().replace(/C:\\fakepath\\/i, '')
                $('.choose-certifcate').removeClass('btn-danger').addClass('btn-success').text('Selected - ' + filename);

            })
        });

        $(document).on("change", 'input[name="facebook"]', function () {
            var value = $(this).val();
            if (value.substring(0, 24) != 'https://www.facebook.com' && value != '' && value.substring(0, 18) != 'https://www.fb.com') {
                $(this).parent().addClass("has-error has-feedback");
                $(this).next().removeClass("glyphicon glyphicon-ok form-control-feedback");
                $(this).next().addClass("glyphicon glyphicon-remove form-control-feedback");
                social1 = false;
            } else {
                $(this).parent().removeClass("has-feedback");
                $(this).parent().removeClass("has-error");
                $(this).next().removeClass("glyphicon glyphicon-remove form-control-feedback");
                social1 = true;
            }

        });
        $(document).on("change", 'input[name="twitter"]', function () {
            var value = $(this).val();
            if (value.substring(0, 19) != 'https://twitter.com' && value != '' && value.substring(0, 23) != 'https://www.twitter.com') {
                $(this).parent().addClass("has-error has-feedback");
                $(this).next().removeClass("glyphicon glyphicon-ok form-control-feedback");
                $(this).next().addClass("glyphicon glyphicon-remove form-control-feedback");
                social2 = false;
            } else {
                $(this).parent().removeClass("has-feedback");
                $(this).parent().removeClass("has-error");
                $(this).next().removeClass("glyphicon glyphicon-remove form-control-feedback");
                social2 = true;
            }

        });

        $(document).on("change", 'input[name="youtube"]', function () {
            var value = $(this).val();
            if (value.substring(0, 23) != 'https://www.youtube.com' && value != '' && value.substring(0, 16) != 'https://youtu.be') {
                $(this).parent().addClass("has-error has-feedback");
                $(this).next().removeClass("glyphicon glyphicon-ok form-control-feedback");
                $(this).next().addClass("glyphicon glyphicon-remove form-control-feedback");
                social3 = false;
            } else {
                $(this).parent().removeClass("has-feedback");
                $(this).parent().removeClass("has-error");
                $(this).next().removeClass("glyphicon glyphicon-remove form-control-feedback");
                social3 = true;
            }

        });
        $(document).on("change", 'input[name="linkedin"]', function () {
            var value = $(this).val();
            if (value.substring(0, 24) != 'https://www.linkedin.com' && value != '') {
                $(this).parent().addClass("has-error has-feedback");
                $(this).next().removeClass("glyphicon glyphicon-ok form-control-feedback");
                $(this).next().addClass("glyphicon glyphicon-remove form-control-feedback");
                social4 = false;
            } else {
                $(this).parent().removeClass("has-feedback");
                $(this).parent().removeClass("has-error");
                $(this).next().removeClass("glyphicon glyphicon-remove form-control-feedback");
                social4 = true;
            }

        });


        function validURL(str) {
            var pattern = new RegExp('^(https?:\\/\\/)?' + // protocol
                '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|' + // domain name
                '((\\d{1,3}\\.){3}\\d{1,3}))' + // OR ip (v4) address
                '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*' + // port and path
                '(\\?[;&a-z\\d%_.~+=-]*)?' + // query string
                '(\\#[-a-z\\d_]*)?$', 'i'); // fragment locator
            return !!pattern.test(str);
        }

        $(document).on("change", 'input[name="website"]', function () {
            var value = $(this).val();
            if (!validURL(value) && value != '') {
                $(this).parent().addClass("has-error has-feedback");
                $(this).next().removeClass("glyphicon glyphicon-ok form-control-feedback");
                $(this).next().addClass("glyphicon glyphicon-remove form-control-feedback");
                web = false;
            } else {
                $(this).parent().removeClass("has-feedback");
                $(this).parent().removeClass("has-error");
                $(this).next().removeClass("glyphicon glyphicon-remove form-control-feedback");
                web = true;
            }

        });


        var somethingChanged = false;
        $('#profile .btn-group> select').on('change', function () {
            somethingChanged = true;
            console.log($(this));
        });
        $('#profile input[type="text"]').on('keyup', function () {
            somethingChanged = true;
            console.log($(this));
        });
        $('#profile textarea').on('keyup', function () {
            somethingChanged = true;
            console.log($(this));
        });
        $(window).bind('beforeunload', function (e) {
            if ($(e.target.activeElement).attr('type') != 'submit' && somethingChanged) {
                return 'You have unsaved changes; are you sure you want to leave this page?';
            }
        });


        // File preview on upload
        /*document.getElementById("company_logo").onchange = function () {
            var reader = new FileReader();

            reader.onload = function (e) {
                // get loaded data and render thumbnail.
                document.getElementById("company_logo_wrapper").style.backgroundImage = "url('"+e.target.result+"')";
            };

            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        };*/

        /*document.getElementById("company_banner").onchange = function () {
            var reader = new FileReader();

            reader.onload = function (e) {
                // get loaded data and render thumbnail.
                document.getElementById("company_cover_wrapper").style.backgroundImage = "url('"+e.target.result+"')";
            };

            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        };*/


        
    <?php echo '</script'; ?>
>


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->
<?php echo '<script'; ?>
 src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
$( function() {
    // Single Select
    $( "#company-name" ).autocomplete({
        source: function( request, response ) {
            // Fetch data
            $.ajax({
                url: site_url+"search-company?term="+request.term,
                // type: 'post',
                dataType: "json",
                success: function( data ) {
                    response( data );
                }
            });
        },
    });

    $("#company-date").datepicker({
        dateFormat: "dd-mm-yy",
        changeMonth: true,
        changeYear: true,
        yearRange: '1940:2020',
    });
});

<?php echo '</script'; ?>
>



<?php
}
}
/* {/block 'content'} */
}
