<?php
/* Smarty version 3.1.30, created on 2020-10-27 16:47:25
  from "/home/makromed/public_html/demo/templates/default/profile/settings.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f9816ddd05d41_12985546',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b6e568ca8f9458e8b4e7063dd4b4e2969b6774a3' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/default/profile/settings.tpl',
      1 => 1603802541,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../profile/sidebar.tpl' => 1,
  ),
),false)) {
function content_5f9816ddd05d41_12985546 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_8321285915f9816ddd03415_99157093', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['layout']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, true);
}
/* {block 'content'} */
class Block_8321285915f9816ddd03415_99157093 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <link rel="stylesheet" href="<?php echo base_url('templates/default/assets/css/prefix-style.css');?>
" media="all">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
    <style>
    .intl-tel-input.allow-dropdown {
        width: 265px !important;
        float: left;
        height: 34px;
        border: 1px solid rgba(177, 177, 177, 1);
        border-radius: 6px;
        padding: 0 15px;
        margin-bottom: 20px;
        font-size: 14px;
        color: rgba(70, 70, 70, 1);
    }
    .phone, .phones { border: 0; outline: none; }
    .phone:focus, .phones:focus { outline: none !important; box-shadow: none !important; }
    </style>

    <div class="n_content_area full_width">
<a href="#" id="openMenu" class="accounts-menu-float">Menu</a>

        <div class="container-fluid">
            <div class="all_modals full_width">
                <div id="createCompany" class="modal fade" role="dialog" style="z-index:999999999999999;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content" style="min-height: 300px;">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true"><img src="<?php echo base_url('templates/default/assets/images/icons/close_n.png');?>
"/></span></button>
                            </div>
                            <div class="modal-body">
                                <h3>ADD NEW COMPANY</h3>
                                <div class="mod_center_inp change_pss" style="width: 90%;">
                                    <div class="full_width relative">
                                        <p class="text-center">Please add Company name in the field. Later you will be redirected to company details page.</p>
                                    </div>
                                </div><!-- /.mod_center_inp -->
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div id="existingCompany" class="modal fade" role="dialog" style="z-index:999999999999999;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content" style="min-height: 300px;">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true"><img src="<?php echo base_url('templates/default/assets/images/icons/close_n.png');?>
"/></span></button>
                            </div>
                            <div class="modal-body">
                                <h3>NOTICE</h3>
                                <div class="mod_center_inp change_pss" style="width: 90%;">
                                    <div class="full_width relative">
                                        <p class="text-center">After registration a request will be send administrator of the page for approval.</p>
                                    </div>
                                </div><!-- /.mod_center_inp -->
                            </div>
                        </div>
                    </div>
                    
                </div>                
                <?php if ($_smarty_tpl->tpl_vars['user']->value['group_id'] == 2 || $_smarty_tpl->tpl_vars['user']->value['group_id'] == 3 || $_smarty_tpl->tpl_vars['user']->value['group_id'] == 4) {?>
                    <?php if (empty($_smarty_tpl->tpl_vars['UserData']->value->company_name)) {?>
                        <div id="companyModal" class="modal fade" role="dialog" style="z-index:999999999999999;">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form class="addCompanyInformation" action="<?php echo base_url();?>
profile/companyInformation"
                                          method="post" autocomplete="off">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title data-title">Please enter company information</h4>
                                        </div>
                                        <div class="modal-body data-body"
                                             style="min-height: 500px;max-height:500px;overflow-y:auto;padding-top:35px;">
                                            <div class="round-image userphotos-change" data-toggle="tooltip"
                                                 data-placement="top" title="Image Upload">
                                                <img src="<?php echo $_smarty_tpl->tpl_vars['user_images']->value;?>
" alt="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->company_name;?>
">
                                            </div>

                                            <div class="form-group">
                                                <label for="company-name"> Company Name </label>
                                                <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->company_name)) {?>
                                                    <input type="text" name="company_name" id="company-name"
                                                           class="form-control mylos readonly"
                                                           placeholder="Company Name"
                                                           value="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->company_name;?>
">
                                                <?php } else { ?>
                                                    <input type="text" name="company_name" id="company-name"
                                                           class="form-control mylos readonly"
                                                           placeholder="Company Name"
                                                           value="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->fullname;?>
">
                                                <?php }?>
                                            </div>
                                            <div class="form-group ">
                                                <label for="company-date"> Establishment date </label>
                                                <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->establishment_date)) {?>
                                                    <input type="text" name="establishment_date" id="company-date"
                                                           class="form-control mylos" placeholder="Establishment date"
                                                           value="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->establishment_date;?>
">
                                                <?php } else { ?>
                                                    <input type="text" name="establishment_date" id="company-date"
                                                           class="form-control mylos" placeholder="Establishment date"
                                                           value="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->brith_day;?>
">
                                                <?php }?>
                                            </div>
                                            <div class="form-group ">
                                                <label for="company-info">Company Info</label>
                                                <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->company_info)) {?>
                                                    <textarea type="text" name="company_info" id="company-info" cols="5"
                                                              rows="12"
                                                              class="form-control mylos"><?php echo $_smarty_tpl->tpl_vars['UserData']->value->company_info;?>
</textarea>
                                                <?php } else { ?>
                                                    <textarea type="text" name="company_info" id="company-info" cols="5"
                                                              rows="12"
                                                              class="form-control mylos"><?php echo $_smarty_tpl->tpl_vars['UserData']->value->personal_info;?>
</textarea>
                                                <?php }?>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Save</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php echo '<script'; ?>
 type="text/javascript">
                            $("#companyModal").modal();
                        <?php echo '</script'; ?>
>
                    <?php }?>
                <?php }?>
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

                                    <a href="#" class="fr_pass"  data-dismiss="modal" onclick="$('#forgetPasswordAuth').modal();">Forgot your password?</a>
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

                
            </div>
            

            <form class="userphotos_form" action="<?php echo base_url();?>
profile/userphotos" method="post">
                <input type="file" style="display:none;" name="userphotos" class="userphotos"/>
            </form>

            <div class="row">

                    <?php $_smarty_tpl->_subTemplateRender("file:../profile/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


                    <div class="n_right_section start_with_text">
                        <div class="with_buttons full_width">
                            <h2>PROFILE INFORMATION</h2>
                            <a href="#" onclick="$('#changePassword').modal();">Change password</a>
                            <a href="#" class="active">Edit Info</a>
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
                            <form class="userSettings" action="<?php echo base_url();?>
profile/save" enctype="multipart/form-data"
                                  method="post">

                            <div class="n_like_form full_width">
                                <div class="n_first_block">
                                    <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->fullname)) {?>
                                        <div class="full_width">
                                            <label>Full Name <sup>*</sup></label>
                                            <input type="text" name="fullname" value="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->fullname;?>
" required/>
                                            <input type="hidden" name="group_id" value="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->user_groups_id;?>
">
                                        </div>
                                        <!-- /.full_width -->
                                    <?php }?>
                                    
                                    
                                    
                                    

                                    <div class="full_width date_of_brth">
                                        <label>Date of Birth <sup>*</sup></label>
                                        <input type="text" name="brith_day" id="company-date"
                                               class="form-control mylos" placeholder="" required
                                               style="width: 265px !important;"
                                               value="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->brith_day;?>
">
                                        
                                        <div class="drop_cstm adj" style="width: 38px;margin-left: 10px;">
                                            <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->display_dob;?>
" name="display_dob" id="datesetValInput">
                                            <button type="button" id="datesetVal" class="setVal"><span>
                                                    <?php if ($_smarty_tpl->tpl_vars['UserData']->value->display_dob == 1) {?>
                                                    <img src="<?php echo base_url('templates/default/assets/images/icons/earth_.png');?>
"
                                                         alt="Public">
                                                <?php } else { ?>
                                                <img src="<?php echo base_url('templates/default/assets/images/icons/lock_.png');?>
"
                                                alt="Private">
                                                <?php }?>
                                                    </span>
                                                <img src="<?php echo base_url('templates/default/assets/images/icons/drp_arw.png');?>
"/>
                                            </button>
                                            <div class="drop_down_select_ getVal" id="dategetVal">
                                                <h1>Who should see this ?</h1>
                                                <ul>
                                                    <li data-display="0">
                                                        <img src="<?php echo base_url('templates/default/assets/images/icons/lock_.png');?>
"
                                                             alt="img"> <span class="data">
                                                <h3>Private</h3>
                                                <p>Only you can see</p>
                                                </span></li>
                                                    <li data-display="1">
                                                        <img src="<?php echo base_url('templates/default/assets/images/icons/earth_.png');?>
"
                                                             alt="Public"> <span class="data">
                                                <h3>Public</h3>
                                                <p>Anyone can see</p>
                                                </span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div><!-- /.full_width -->

                                    
                                    
                                    
                                    

                                    <div class="full_width" style="margin-bottom: 20px">
                                    <label>Country <sup>*</sup></label>
                                    <select class="selectpicker form-control show-menu-arrow mylos company-country"
                                            name="country_id" data-live-search="true"
                                            data-selected-text-format="count > 1" title="Country" required>
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
                                        <label>Your Address</label>
                                        <input id="pac-input" type="text" name="address" value="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->adress;?>
" required/>
                                    </div><!-- /.full_width -->

                                    <div class="full_width map__">
                                        <div style="height: 213px;top: 21px; width:265px;" id="map"></div>
                                    </div><!-- map__-->

                                </div><!-- /.n_first_block -->

                                <div class="n_second_block">
                                    <div class="full_width">
                                        <label>Phone Number <sup>*</sup></label>
                                        <input type="hidden" name="country_code" class="dial-up"
                                            value="<?php if (empty($_smarty_tpl->tpl_vars['company']->value->code)) {
echo $_smarty_tpl->tpl_vars['UserData']->value->country_code;
} else {
echo $_smarty_tpl->tpl_vars['UserData']->value->country_code;
}?>">
                                        <input type="phone" name="phone" id="phone"
                                            class="form-control inputmask mylos <?php if (empty($_smarty_tpl->tpl_vars['UserData']->value->phone)) {?> phones <?php } else { ?> phones <?php }?>"
                                            value="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->phone;?>
"
                                            data-co="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->country_code;?>
" required>


                                        <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->display_phone;?>
" name="display_phone" id="phonesetValInput">

                                        <div class="drop_cstm adj">
                                            <button type="button" id="phonesetVal2" class="setVal"><span>
                                                    <img
                                                            <?php if ($_smarty_tpl->tpl_vars['UserData']->value->display_phone == 1) {?>
                                                                src="<?php echo base_url('templates/default/assets/images/icons/earth_.png');?>
"
                                                                alt="Public"
                                                            <?php } else { ?>
                                                                src="<?php echo base_url('templates/default/assets/images/icons/lock_.png');?>
"
                                                                alt="Private"
                                                            <?php }?>
                                                         alt="Public">
                                                </span>
                                                <img src="<?php echo base_url('templates/default/assets/images/icons/drp_arw.png');?>
" />
                                            </button>
                                            <div class="drop_down_select_ getVal" id="phonegetVal2">
                                                <h1>Who should see this ?</h1>
                                                <ul>
                                                    <li data-display="0">
                                                        <img src="<?php echo base_url('templates/default/assets/images/icons/lock_.png');?>
" alt="img"> <span class="data">
                                                <h3>Private</h3>
                                                <p>Only you can see</p>
                                                </span></li>
                                                    <li data-display="1">
                                                        <img src="<?php echo base_url('templates/default/assets/images/icons/earth_.png');?>
" alt="Public"> <span class="data">
                                                <h3>Public</h3>
                                                <p>Anyone can see</p>
                                                </span></li>
                                                </ul>
                                            </div>
                                        </div>



                                        
                                    </div><!-- /.full_width -->
                                    <div class="full_width">
                                        <label>E-mail <sup>*</sup></label>
                                        <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->email;?>
" name="email" id="company-mail" readonly/>
                                        <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->display_email;?>
" name="display_email" id="emailsetValInput">
                                        <div class="drop_cstm adj">
                                            <button type="button" id="emailsetVal2" class="setVal"><span>
                                                    <img class="emailsetValIcon"
                                                            <?php if ($_smarty_tpl->tpl_vars['UserData']->value->display_email == 1) {?>
                                                                src="<?php echo base_url('templates/default/assets/images/icons/earth_.png');?>
"
                                                                alt="Public"
                                                            <?php } else { ?>
                                                                src="<?php echo base_url('templates/default/assets/images/icons/lock_.png');?>
"
                                                                alt="Private"
                                                            <?php }?>
                                                            alt="Public"></span>
                                                <img src="<?php echo base_url('templates/default/assets/images/icons/drp_arw.png');?>
" />
                                            </button>
                                            <div class="drop_down_select_ getVal" id="emailgetVal2">
                                                <h1>Who should see this ?</h1>
                                                <ul>
                                                    <li data-display="0">
                                                        <img src="<?php echo base_url('templates/default/assets/images/icons/lock_.png');?>
" alt="img"> <span class="data">
                                                <h3>Private</h3>
                                                <p>Only you can see</p>
                                                </span></li>
                                                    <li data-display="1">
                                                        <img src="<?php echo base_url('templates/default/assets/images/icons/earth_.png');?>
" alt="Public"> <span class="data">
                                                <h3>Public</h3>
                                                <p>Anyone can see</p>
                                                </span></li>
                                                </ul>
                                            </div>
                                        </div>


                                       

                                        
                                    </div><!-- /.full_width -->
                                    
                                    
                                    <hr>

                                    <div class="full_width">
                                        <label>Company</label>
                                        <input type="text" name="company_name" value="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->company_name;?>
" class="company-input-box"/>
                                        <label class="alert alert-warning company-warning-box">
                                            <i class="fa fa-exclamation-circle"></i> If you have company please add company.
                                        </label>
                                    </div><!-- /.full_width -->

                                    <div class="full_width" style="margin-bottom: 20px">
                                        <label>Your Position <sup>*</sup></label>
                                        
                                        <select class="selectpicker form-control show-menu-arrow mylos"
                                                name="position" data-live-search="true" required
                                                data-selected-text-format="count > 1" title="Position">
                                            <?php if ($_smarty_tpl->tpl_vars['person_type']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['person_type']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
                                                <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
" <?php if ($_smarty_tpl->tpl_vars['UserData']->value->position == $_smarty_tpl->tpl_vars['value']->value->id) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
</option>
                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                                        </select>
                                    </div><!-- /.full_width -->


                                </div><!-- /.n_second_block -->
                            </div><!-- /.n_like_form -->

                            <hr class="thrx">

                            <div class="full_width n_txt">
                                <label>Personal Info</label>
                                <textarea name="personal_info" id="personal_info"><?php echo $_smarty_tpl->tpl_vars['UserData']->value->personal_info;?>
</textarea>
                            </div>

                            <div class="comon_h3 full_width m30s">
                                <h3>SOCIAL INFORMATION</h3>
                            </div><!-- /.personal_info -->
                            <div class="full_width n_like_form">
                                <div class="n_first_block">
                                    <div class="full_width">
                                        <label>Facebook</label>
                                        <input type="text" name="facebook" value="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->facebook;?>
" />
                                    </div><!-- /.full_width -->
                                    <div class="full_width">
                                        <label>Youtube</label>
                                        <input type="text" name="youtube" value="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->youtube;?>
"/>
                                    </div><!-- /.full_width -->
                                </div><!-- /.n_first_block -->

                                <div class="n_second_block">
                                    <div class="full_width">
                                        <label>Twitter</label>
                                        <input type="text" name="twitter" value="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->twitter;?>
"/>
                                    </div><!-- /.full_width -->
                                    <div class="full_width">
                                        <label>Linkedin</label>
                                        <input type="text" name="linkedin" value="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->linkedin;?>
"/>
                                    </div><!-- /.full_width -->
                                </div><!-- /.n_first_block -->
                            </div><!-- /.full_width -->

                            <div class="btn_wrap full_width">
                                <a href="#" class="n_cancel">Cancel</a>
                                <input type="submit" value="Save" class="n_save">
                            </div><!-- /.btn_wrap -->
                            </form>
                        </div><!-- /.max_arrange -->

                    </div><!-- /.n_right_section -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->

    </div>
    <!-- /.n_content_area -->

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
                    <input type="phone" name="` + target + `[phone][` + count + `][]" id="phone" class="form-control inputmask phone mylos"  value="">
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
                        <select class="selectpicker form-control show-menu-arrow mylos" name="` + target + `[person_type][` + count + `][]" data-live-search="true" data-selected-text-format="count > 1" title="Person Type">
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
                        <input type="text" name="` + target + `[ext][` + count + `][]" id="company-ext" class="form-control mylos">
                    </div>
                    <div class="col-md-3 no-padding" style="padding-top:20px;padding-right:10px;">
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
        <?php }?>
        <?php }?>
        <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->lat) || !empty($_smarty_tpl->tpl_vars['UserData']->value->lng)) {?>
        var json_lat = <?php echo $_smarty_tpl->tpl_vars['UserData']->value->lat;?>
;
        var json_lng = <?php echo $_smarty_tpl->tpl_vars['UserData']->value->lng;?>
;
        var json_title = '<?php echo $_smarty_tpl->tpl_vars['UserData']->value->adress;?>
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
                    /* markers.push(new google.maps.Marker({
                        map: map,
                        icon: icon,
                        title: place.name,
                        position: place.geometry.location
                    })); */
                    $('.lat').val(place.geometry.location.lat());
                    $('.lng').val(place.geometry.location.lng());
                    if (place.geometry.viewport) {
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                // map.fitBounds(bounds);
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
                            /*markers.push(new google.maps.Marker({
                                map: map,
                                icon: icon,
                                title: place.name,
                                position: place.geometry.location
                            }));*/
                            $('.lat').val(place.geometry.location.lat());
                            $('.lng').val(place.geometry.location.lng());
                            if (place.geometry.viewport) {
                                bounds.union(place.geometry.viewport);
                            } else {
                                bounds.extend(place.geometry.location);
                            }
                        });
                        // map.fitBounds(bounds);
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
                            $('.selectpicker').selectpicker();
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
            $(document).on('click', '.responsible-btn', function () {
                count = count + 1;
                var target = $(this).attr('data-target');
                var component = addPhone(count, target);
                var dial_codes = $('.dial-codes').val();
                $('.responsible-' + target + '-inner').append(component);
                $('.selectpicker').selectpicker();
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
                            $('#n_profile_img_uploaded').attr('src', site_url + 'uploads/catalog/users/' + data);
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
        });
        $('#profile input[type="text"]').on('keyup', function () {
            somethingChanged = true;
        });
        $('#profile textarea').on('keyup', function () {
            somethingChanged = true;
        });
        $(window).bind('beforeunload', function (e) {
            if ($(e.target.activeElement).attr('type') != 'submit' && somethingChanged) {
                return 'You have unsaved changes; are you sure you want to leave this page?';
            }
        });

        
    <?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
>
        $(document).ready(function(ev) {
            var comName = $('.company-input-box').val();
            if(comName.length < 2) {
                $('.company-warning-box').fadeIn();
            } else { 
                $('.company-warning-box').fadeOut();
            }

            $('.company-input-box').on('change', function(ev) {
                var comName_1 = $('.company-input-box').val();
                    if(comName.length > 2) {
                    $('.company-warning-box').fadeOut();
                }
            });


            $(".company-input-box").autocomplete({
                source: site_url+"/search-company/",
                // source: availableTags,
                minLength: 2,
                'open': function(e, ui) {
                    $('.ui-autocomplete').append("<li class='ui-menu-item'><div id='ui-id-xxx' class='ui-menu-item-wrapper'><a href='#' data-toggle='modal' data-target='#createCompany'>Add New Company</a></div></li>");
                },
                select: function(event, ui) {
                    if(ui["item"] !== undefined) {
                        $("#existingCompany").modal();
                    }
                }
            });

            $("#company-date").datepicker({
                dateFormat: "dd-mm-yy",
                changeMonth: true,
                changeYear: true,
                yearRange: '1940:2020',
            });
        });

        $(function(){
            $('#setVal').on('click',function(e){
                e.preventDefault();
                e.stopPropagation();
                if( $('.drop_down_select_').hasClass('active') ){
                    $('.drop_cstm').removeClass('top_index');
                    $('.drop_down_select_').removeClass('active');
                }
                $(this).next('#getVal').addClass('active');
                $(this).closest('.drop_cstm').addClass('top_index');

            });
            $('#getVal ul li').on('click', function(e){
                e.preventDefault();
                var $imgSrc = $(this).find('img').attr('src');
                $('#setVal').find('img').attr('src', $imgSrc);
                var data = $(this).data('display');
                $('#setValInput').val(data)
            });

            $('#phonesetVal').on('click',function(e){
                e.preventDefault();
                e.stopPropagation();
                if( $('.drop_down_select_').hasClass('active') ){
                    $('.drop_cstm').removeClass('top_index');
                    $('.drop_down_select_').removeClass('active');
                }
                $(this).next('#phonegetVal').addClass('active');
                $(this).closest('.drop_cstm').addClass('top_index');
            });
            $('#phonegetVal ul li').on('click', function(e){
                e.preventDefault();
                var $imgSrc = $(this).find('img').attr('src');
                $('#phonesetVal').find('img').attr('src', $imgSrc);
                var data = $(this).data('display');
                $('#phonesetValInput').val(data)
            });

            $('#emailsetVal').on('click',function(e){
                e.preventDefault();
                e.stopPropagation();
                if( $('.drop_down_select_').hasClass('active') ){
                    $('.drop_cstm').removeClass('top_index');
                    $('.drop_down_select_').removeClass('active');
                }
                $(this).next('#emailgetVal').addClass('active');
                $(this).closest('.drop_cstm').addClass('top_index');
            });
            $('#emailgetVal ul li').on('click', function(e){
                e.preventDefault();
                var $imgSrc = $(this).find('img').attr('src');
                $('#emailsetVal').find('span img').attr('src', $imgSrc);
                var data = $(this).data('display');
                $('#emailsetValInput').val(data)
            });

            $('#datesetVal').on('click',function(e){
                e.preventDefault();
                e.stopPropagation();
                if( $('.drop_down_select_').hasClass('active') ){
                    $('.drop_cstm').removeClass('top_index');
                    $('.drop_down_select_').removeClass('active');
                }
                $(this).next('#dategetVal').addClass('active');
                $(this).closest('.drop_cstm').addClass('top_index');
            });
            $('#dategetVal ul li').on('click', function(e){
                e.preventDefault();
                var $imgSrc = $(this).find('img').attr('src');
                $('#datesetVal').find('span img').attr('src', $imgSrc);
                var data = $(this).data('display');
                $('#datesetValInput').val(data)
            });

            $('#phonesetVal2').on('click',function(e){
                e.preventDefault();
                e.stopPropagation();
                if( $('.drop_down_select_').hasClass('active') ){
                    $('.drop_cstm').removeClass('top_index');
                    $('.drop_down_select_').removeClass('active');
                }
                $(this).next('#phonegetVal2').addClass('active');
                $(this).closest('.drop_cstm').addClass('top_index');
            });
            $('#phonegetVal2 ul li').on('click', function(e){
                e.preventDefault();
                var $imgSrc = $(this).find('img').attr('src');
                $('#phonesetVal2').find('span img').attr('src', $imgSrc);
                var data = $(this).data('display');
                $('#phonesetValInput').val(data)
            });

            $('#emailsetVal2').on('click',function(e){
                e.preventDefault();
                e.stopPropagation();
                if( $('.drop_down_select_').hasClass('active') ){
                    $('.drop_cstm').removeClass('top_index');
                    $('.drop_down_select_').removeClass('active');
                }
                $(this).next('#emailgetVal2').addClass('active');
                $(this).closest('.drop_cstm').addClass('top_index');
            });
            $('#emailgetVal2 ul li').on('click', function(e){
                e.preventDefault();
                var $imgSrc = $(this).find('img').attr('src');
                $('#emailsetVal2').find('span img').attr('src', $imgSrc);
                var data = $(this).data('display');
                $('#emailsetValInput').val(data)
            });

            $(document).on('click',function(e){
                $('#getVal').removeClass('active');
                $('#phonegetVal').removeClass('active');
                $('#emailgetVal').removeClass('active');
                $('#phonegetVal2').removeClass('active');
                $('#emailgetVal2').removeClass('active');
                $('#dategetVal').removeClass('active');
                $('.drop_cstm').removeClass('top_index');
            });

            $('#advan_n').on('click', function(e){
                if( $(this).hasClass('active') ){
                    $(this).removeClass('active');
                    $('#show_content_n').slideUp(300);
                }
                else {
                    $(this).addClass('active');
                    $('#show_content_n').slideDown(300);
                }
            });
            $('.rm_items').on('click', function(e){
                e.preventDefault();
                $(this).closest('.upl_items').remove();
            });
            $(window).on('load',function(){
                $('#acntVerfication').modal('show');
            });
        });
    <?php echo '</script'; ?>
>
<?php
}
}
/* {/block 'content'} */
}
