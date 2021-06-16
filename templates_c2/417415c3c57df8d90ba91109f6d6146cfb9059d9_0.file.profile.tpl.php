<?php
/* Smarty version 3.1.30, created on 2020-10-27 16:46:48
  from "/home/makromed/public_html/demo/templates/default/profile/profile.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f9816b8ac14d8_93607844',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '417415c3c57df8d90ba91109f6d6146cfb9059d9' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/default/profile/profile.tpl',
      1 => 1603802541,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../profile/sidebar.tpl' => 1,
  ),
),false)) {
function content_5f9816b8ac14d8_93607844 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_9370774935f9816b8abf7d3_60731054', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['layout']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, true);
}
/* {block 'content'} */
class Block_9370774935f9816b8abf7d3_60731054 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <link rel="stylesheet" href="<?php echo base_url('templates/default/assets/css/prefix-style.css');?>
" media="all">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
    <?php echo '<script'; ?>
 src="//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"><?php echo '</script'; ?>
>
    <div class="n_content_area full_width">
        <a href="#" id="openMenu" class="accounts-menu-float">Menu</a>
        <div class="container-fluid">
            <div CHANGE PASSWORDid="changePassword" class="modal fade" role="dialog" style="z-index:999999999999999;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form class="changePassword" action="<?php echo base_url();?>
profile/changePassword" method="post">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title data-title">Change Password</h4>
                            </div>
                            <div class="modal-body data-response">
                                <div class="form-group">
                                    <label for="company-date">New passowrd </label>
                                    <input type="password" name="new_password" class="form-control mylos"
                                           placeholder="New password" required>
                                </div>
                                <div class="form-group">
                                    <label for="company-date">Re new passowrd </label>
                                    <input type="password" name="re_password" class="form-control mylos"
                                           placeholder="Repeat new password" required>
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
            <?php if ($_smarty_tpl->tpl_vars['user']->value['group_id'] == 2 || $_smarty_tpl->tpl_vars['user']->value['group_id'] == 3 || $_smarty_tpl->tpl_vars['user']->value['group_id'] == 4) {?>
                <?php if (empty($_smarty_tpl->tpl_vars['UserData']->value->company_name)) {?>
                    <div id="companyModal" class="modal fade" role="dialog" style="z-index:999999999999999;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form class="addCompanyInformation" action="<?php echo base_url();?>
profile/companyInformation"
                                      method="post">
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
"
                                                 class="avatar img-circle img-thumbnail">
                                        </div>
                                        <div class="form-group">
                                            <label for="company-name"> Company Name </label>
                                            <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->company_name)) {?>
                                                <input type="text" name="company_name" id="company-name"
                                                       class="form-control mylos readonly" placeholder="Company Name"
                                                       value="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->company_name;?>
">
                                            <?php } else { ?>
                                                <input type="text" name="company_name" id="company-name"
                                                       class="form-control mylos readonly" placeholder="Company Name"
                                                       value="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->fullname;?>
">
                                            <?php }?>
                                        </div>
                                        <div class="form-group ">
                                            <label for="company-date"> Establishment date </label>
                                            <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->establishment_date)) {?>
                                                <input type="date" name="establishment_date" id="company-date"
                                                       class="form-control mylos" placeholder="Establishment date"
                                                       value="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->establishment_date;?>
">
                                            <?php } else { ?>
                                                <input type="date" name="establishment_date" id="company-date"
                                                       class="form-control mylos" placeholder="Establishment date"
                                                       value="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->brith_day;?>
">
                                            <?php }?>
                                        </div>
                                        <div class="form-group ">
                                            <label for="company-info">Company Info</label>
                                            <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->establishment_date)) {?>
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
                        <div class="drt_form full_width">
                            <div class="full_width">
                                <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->fullname)) {?>
                                    <div class="fst_col">
                                        <label>Full Name <span><?php echo $_smarty_tpl->tpl_vars['UserData']->value->fullname;?>
</span></label>
                                        
                                    </div>
                                    <!-- /.fst_col -->
                                <?php }?>
                                <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->company_name)) {?>
                                    <div class="snd_col">
                                        <label>Company <span><?php echo $_smarty_tpl->tpl_vars['UserData']->value->company_name;?>
</span></label>
                                    </div>
                                    <!-- /.snd_col -->
                                <?php }?>
                            </div><!-- /.full_width -->
                            <div class="full_width">
                                <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->position)) {?>
                                    <div class="fst_col">
                                        <label>Your Position <span><?php echo $_smarty_tpl->tpl_vars['UserData']->value->position_name;?>
</span></label>
                                    </div>
                                    <!-- /.fst_col -->
                                <?php }?>
                                <div class="snd_col">
                                    <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->brith_day)) {?>
                                        <label>Date of Birth
                                            <span><?php echo $_smarty_tpl->tpl_vars['UserData']->value->brith_day;?>

                                                <div class="drop_cstm" style="right: -25px">
                                                    <button disabled type="button" id="setVal" class="setVal">
                                                        <img
                                                                <?php if ($_smarty_tpl->tpl_vars['UserData']->value->display_dob == 1) {?>
                                                                src="<?php echo base_url('templates/default/assets/images/icons/earth_.png');?>
"
                                                                alt="Public"
                                                                <?php } else { ?>
                                                                src="<?php echo base_url('templates/default/assets/images/icons/lock_.png');?>
"
                                                                alt="Public"
                                                                <?php }?>
                                                        />
                                                    </button>
                                                </div>
                                            </span>
                                        </label>
                                    <?php }?>
                                </div><!-- /.snd_col -->
                            </div><!-- /.full_width -->
                        </div><!-- /.drt_form -->

                        <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->personal_info)) {?>
                            <div class="n_personal_info full_width">
                                <h3>PERSONAL INFO</h3>
                                <p><?php echo $_smarty_tpl->tpl_vars['UserData']->value->personal_info;?>
</p>
                            </div>
                            <!-- /.personal_info -->
                        <?php }?>

                        <div class="n_contact_info full_width">
                            <h3>CONTACT INFO</h3>
                            <div class="drt_form full_width">
                                <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->phone)) {?>
                                    <div class="full_width">
                                        <label>Phone Number
                                            <span><?php echo $_smarty_tpl->tpl_vars['UserData']->value->phone;?>

                            				<div class="drop_cstm" style="right: -25px;">
                                                <button disabled type="button" id="phonesetVal" class="setVal">
                                                    <img
                                                            <?php if ($_smarty_tpl->tpl_vars['UserData']->value->display_phone == 1) {?>
                                                            src="<?php echo base_url('templates/default/assets/images/icons/earth_.png');?>
"
                                                            alt="Public"
                                                            <?php } else { ?>
                                                            src="<?php echo base_url('templates/default/assets/images/icons/lock_.png');?>
"
                                                            alt="Public"
                                                            <?php }?>
                                                    />
                                                </button>
                                            </div>
                                        </span>
                                        </label>
                                    </div>
                                    <!-- /.full_width -->
                                <?php }?>

                                <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->email)) {?>
                                    <div class="full_width">
                                        <label>E-mail
                                            <span><?php echo $_smarty_tpl->tpl_vars['UserData']->value->email;?>

                            				<div class="drop_cstm"style="right: -25px;">
                                                <button disabled type="button" id="emailsetVal" class="setVal">
                                                    <img
                                                            <?php if ($_smarty_tpl->tpl_vars['UserData']->value->display_email == 1) {?>
                                                                src="<?php echo base_url('templates/default/assets/images/icons/earth_.png');?>
"
                                                                alt="Public"
                                                                <?php } else { ?>
                                                                src="<?php echo base_url('templates/default/assets/images/icons/lock_.png');?>
"
                                                                alt="Public"
                                                                <?php }?>
                                                    />
                                                </button>
                                            </div>
                                        </span>
                                        </label>
                                    </div>
                                    <!-- /.full_width -->
                                <?php }?>

                                <div class="full_width">
                                    <label>Country <span><?php echo get_country_name($_smarty_tpl->tpl_vars['UserData']->value->country_id);?>
</span></label>
                                </div><!-- /.full_width -->

                                <div class="full_width">
                                    <label>Address<span><?php echo $_smarty_tpl->tpl_vars['UserData']->value->adress;?>
</span></label>
                                </div><!-- /.full_width -->
                            </div><!-- /.drt_form -->
                            <div class="full_width map__" id="maps">
                                <iframe width="265" height="265"  src="https://maps.google.com/maps?q=<?php echo $_smarty_tpl->tpl_vars['UserData']->value->adress;?>
&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>

                            </div><!-- map__-->

                            <div class="n_social_block full_width">
                                <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->facebook)) {?>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->facebook;?>
"><img
                                                src="<?php echo base_url('templates/default/assets/images/icons/n_face.png');?>
"
                                                alt="Facebook"/></a>
                                <?php }?>
                                <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->twitter)) {?>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->twitter;?>
"><img
                                                src="<?php echo base_url('templates/default/assets/images/icons/n_twit.png');?>
"
                                                alt="Twitter"/></a>
                                <?php }?>
                                <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->youtube)) {?>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->youtube;?>
"><img
                                                src="<?php echo base_url('templates/default/assets/images/icons/n_tube.png');?>
"
                                                alt="YouTube"/></a>
                                <?php }?>
                                <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->linkedin)) {?>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->linkedin;?>
"><img
                                                src="<?php echo base_url('templates/default/assets/images/icons/n_in.png');?>
"
                                                alt="Linkedin"/></a>
                                <?php }?>
                            </div><!-- /.social_block -->
                        </div><!-- /.contact_info -->
                    </div><!-- /.max_arrange -->
                </div><!-- /.n_right_section -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.n_content_area -->

    <?php echo '<script'; ?>
 src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFH8I3kyiSc5ZOCMFnRoKyDipc3yTFoKQ&libraries=places&callback=initAutocomplete"
            async defer><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
>
        <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->lat) || !empty($_smarty_tpl->tpl_vars['UserData']->value->lng)) {?>
        var json_lat = <?php echo $_smarty_tpl->tpl_vars['UserData']->value->lat;?>
;
        var json_lng = <?php echo $_smarty_tpl->tpl_vars['UserData']->value->lng;?>
;
        var json_title = '<?php echo $_smarty_tpl->tpl_vars['UserData']->value->adress;?>
';
        
        function initAutocomplete() {
            var myLatLng = {lat: json_lat, lng: json_lng};
            var map = new google.maps.Map(document.getElementById('maps'), {
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
                    $('.lat').val(place.geometry.location.lat());
                    $('.lng').val(place.geometry.location.lng());
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
                    var map = new google.maps.Map(document.getElementById('maps'), {
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
                            $('.lat').val(place.geometry.location.lat());
                            $('.lng').val(place.geometry.location.lng());
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
        $(document).ready(function () {

            if ($('a.image-link').length) {
                $('a.image-link').magnificPopup({
                    type: 'image',
                    mainClass: 'mfp-with-zoom',
                    gallery: {
                        enabled: true
                    },
                    zoom: {
                        enabled: true
                    }
                });
            }

            $(document).on('mouseenter', '.userphotos-change img,.camera-icon', function () {
                $('.camera-icon').css('opacity', 1);
            })
            $(document).on('mouseleave', '.userphotos-change img,.camera-icon', function () {
                $('.camera-icon').css('opacity', 0);
            })

            $(document).on('click', '.userphotos-change,.camera-icon', function () {
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
                            $('.modal').modal('hide');

                            toastr.success(obj.message);
                            setTimeout(function () {
                                location.reload();
                            }, 2000);
                        } else {
                            toastr.error(obj.message);
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
    <?php echo '</script'; ?>
>
<?php
}
}
/* {/block 'content'} */
}
