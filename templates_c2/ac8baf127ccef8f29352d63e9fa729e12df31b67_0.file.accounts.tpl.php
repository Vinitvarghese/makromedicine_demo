<?php
/* Smarty version 3.1.30, created on 2020-10-27 16:47:14
  from "/home/makromed/public_html/demo/templates/default/profile/accounts.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f9816d229b723_22769700',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ac8baf127ccef8f29352d63e9fa729e12df31b67' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/default/profile/accounts.tpl',
      1 => 1603802541,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../profile/sidebar.tpl' => 1,
  ),
),false)) {
function content_5f9816d229b723_22769700 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1162471235f9816d229a289_26923292', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['layout']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, true);
}
/* {block 'content'} */
class Block_1162471235f9816d229a289_26923292 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <link rel="stylesheet" href="<?php echo base_url('templates/default/assets/css/prefix-style.css');?>
" media="all">
    <div class="n_content_area full_width">
<a href="#" id="openMenu" class="accounts-menu-float">Menu</a>

        <div class="container-fluid">

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
">
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

            <?php if ($_smarty_tpl->tpl_vars['UserData']->value->status != 1) {?>
                <div class="alert alert-warning" style="margin-top: 10px;margin-bottom:10px">
                    Please <a href="javascript:;" onclick="$('#comfirmAccount').modal();">upload a certificate.</a>
                    After the confirmation of certificate your account will be approved and your products will appear on
                    the top rank of the search list.
                </div>
            <?php }?>
            <form class="userphotos_form" action="<?php echo base_url();?>
profile/userphotos" method="post">
                <input type="file" style="display:none;" name="userphotos" class="userphotos"/>
            </form>

            <div class="row">
                <?php $_smarty_tpl->_subTemplateRender("file:../profile/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

                <div class="n_right_section start_with_text">
                    <div class="with_buttons full_width pr-s-n">
                        <h2>COMPANY NAME CHANGE NOTIFICATIONS</h2>
                    </div><!-- /.with_buttons -->

                    <form class="userSettings userSettingsFlex" action="<?php echo base_url();?>
profile/accounts" enctype="multipart/form-data"
                          method="post">
                        <div class="n_checkbox full_width mbm38">
                            <div class="check_con full_width">
                                <input type="hidden" name="ntf_comp_email" value="0"/>
                                <input type="checkbox" name="ntf_comp_email" id="forget-me-change-mail" value="1"
                                       <?php if ($_smarty_tpl->tpl_vars['account_settings']->value['ntf_comp_email'] == 1) {?>checked="checked"<?php }?> />
                                <label for="forget-me-change-mail"></label>
                                <label for="forget-me-change-mail">Get notifications via E-mail</label>
                            </div><!-- /.check_con -->
                            <div class="check_con full_width">
                                <input type="hidden" name="ntf_comp_sms" value="0"/>
                                <input type="checkbox" name="ntf_comp_sms" id="forget-me-change-sms" value="1"
                                       <?php if ($_smarty_tpl->tpl_vars['account_settings']->value['ntf_comp_sms'] == 1) {?>checked="checked"<?php }?> />
                                <label for="forget-me-change-sms"></label>
                                <label for="forget-me-change-sms">Get notifications via SMS</label>
                            </div><!-- /.check_con -->
                        </div><!-- /.n_checkbox -->

                        <div class="with_buttons full_width pr-s-n">
                            <h2>CERTIFICATE CONFIRM NOTIFICATIONS</h2>
                        </div><!-- /.with_buttons -->

                        <div class="n_checkbox full_width mbm38">
                            <div class="check_con full_width">
                                <input type="hidden" name="ntf_cert_email" value="0"/>
                                <input type="checkbox" name="ntf_cert_email" id="forget-me-noty-mail" value="1"
                                       <?php if ($_smarty_tpl->tpl_vars['account_settings']->value['ntf_cert_email'] == 1) {?>checked="checked"<?php }?> />
                                <label for="forget-me-noty-mail"></label>
                                <label for="forget-me-noty-mail">Get notifications via E-mail</label>
                            </div><!-- /.check_con -->
                            <div class="check_con full_width">
                                <input type="hidden" name="ntf_cert_sms" value="0"/>
                                <input type="checkbox" name="ntf_cert_sms" id="forget-me-noty-sms" value="1"
                                       <?php if ($_smarty_tpl->tpl_vars['account_settings']->value['ntf_cert_sms'] == 1) {?>checked="checked"<?php }?> />
                                <label for="forget-me-noty-sms"></label>
                                <label for="forget-me-noty-sms">Get notifications via SMS</label>
                            </div><!-- /.check_con -->
                        </div><!-- /.n_checkbox -->

                        <div class="with_buttons full_width pr-s-n">
                            <h2>PASSWORD NOTIFICATIONS</h2>
                        </div><!-- /.with_buttons -->

                        <div class="n_checkbox full_width mbm38">
                            <div class="check_con full_width">
                                <input type="hidden" name="ntf_pass_email" value="0"/>
                                <input type="checkbox" name="ntf_pass_email" id="forget-me-pass-mail" value="1"
                                       <?php if ($_smarty_tpl->tpl_vars['account_settings']->value['ntf_pass_email'] == 1) {?>checked="checked"<?php }?> />
                                <label for="forget-me-pass-mail"></label>
                                <label for="forget-me-pass-mail">Get notifications via E-mail</label>
                            </div><!-- /.check_con -->
                            <div class="check_con full_width">
                                <input type="hidden" name="ntf_pass_sms" value="0"/>
                                <input type="checkbox" name="ntf_pass_sms" id="forget-me-pass-sms" value="1"
                                       <?php if ($_smarty_tpl->tpl_vars['account_settings']->value['ntf_pass_sms'] == 1) {?>checked="checked"<?php }?> />
                                <label for="forget-me-pass-sms"></label>
                                <label for="forget-me-pass-sms">Get notifications via SMS</label>
                            </div><!-- /.check_con -->
                        </div><!-- /.n_checkbox -->

                        <div class="btn2_ full_width">
                            
                            <input type="submit" class="btn-save confirm-btn" value="Save">
                        </div><!-- /.btn2_ -->
                    </form>


                </div><!-- /.n_right_section -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->

    </div>
    <!-- /.n_content_area -->

    
    <?php echo '<script'; ?>
 type="text/javascript">
        $(document).ready(function () {
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
            });
        });
    <?php echo '</script'; ?>
>
<?php
}
}
/* {/block 'content'} */
}
