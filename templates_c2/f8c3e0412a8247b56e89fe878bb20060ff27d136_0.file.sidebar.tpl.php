<?php
/* Smarty version 3.1.30, created on 2020-10-28 15:20:17
  from "/home/makromed/public_html/demo/templates/default/company/sidebar.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f9953f11fa101_07841641',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f8c3e0412a8247b56e89fe878bb20060ff27d136' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/default/company/sidebar.tpl',
      1 => 1603802538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f9953f11fa101_07841641 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="n_side_section color_change">
<div class="userSettings">
    <div class="n_top_data">
    <a href="#" id="menu_hide">Hide</a>
        <?php if ($_smarty_tpl->tpl_vars['get_confirm_status']->value == false) {?>
            <?php if ($_smarty_tpl->tpl_vars['UserData']->value->status == 0) {?>
                <span class="verify_acc full_width">Verify Your Account <i>!</i></span>
                <div class="ad_pro_n full_width mb_30">
                    <a href="#" class="red_verify" id="verify_account_modal">Verify Account</a>
                </div>
                <!-- /.ad_pro -->
            <?php }?>
        <?php }?>
        <div class="n_profile_img img_fit">
            <?php if ($_smarty_tpl->tpl_vars['UserData']->value->company_logo) {?>
                <img src="<?php echo $_smarty_tpl->tpl_vars['company_logo']->value;?>
"/>
            <?php } else { ?>
                <img src="<?php echo base_url('templates/default/assets/images/bloomberg.png');?>
" alt="img"/>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['get_confirm_status']->value == false) {?>
                <?php if ($_smarty_tpl->tpl_vars['UserData']->value->status > 0) {?>
                    
                    <a href="#" class="n_pro_tick"><img
                                src="<?php echo base_url('templates/default/assets/images/icons/tck_.png');?>
"/></a>
                <?php }?>
            <?php }?>
        </div><!-- /.n_profile_img -->
        <h2><?php echo $_smarty_tpl->tpl_vars['UserData']->value->company_name;?>
</h2>
        <?php if ($_smarty_tpl->tpl_vars['get_confirm_status']->value == false) {?>
            <?php if ($_smarty_tpl->tpl_vars['UserData']->value->status > 0) {?>
                <h3><span>Verified</span></h3>
            <?php } else { ?>
                <h3><span>Not Verified</span></h3>
            <?php }?>
        <?php } else { ?>
            <h3><span>Not Verified</span></h3>
        <?php }?>
        
        <!--<hr>-->
        <!--<h4>Give Rate:<span class="rate"><img src="images/icons/star_n.png" /></span></h4>-->
        <hr>
        <h6><?php echo $_smarty_tpl->tpl_vars['user_following']->value;?>
<span>Followers</span></h6>
        <h6><?php echo $_smarty_tpl->tpl_vars['user_followers']->value;?>
<span>Following</span></h6>
        <hr>
        <?php if ($_smarty_tpl->tpl_vars['user']->value['id'] && $_smarty_tpl->tpl_vars['user']->value['id'] == $_smarty_tpl->tpl_vars['UserData']->value->id) {?>
            <div class="ad_pro_n full_width">
                <a href="<?php echo base_url('/product');?>
">Add Products</a>
            </div>
            <!-- /.ad_pro -->
        <?php }?>

        <!--<span class="verify_acc full_width">Verify Your Account <i>!</i></span>
        <div class="ad_pro_n full_width">
            <a href="#" class="red_verify">Verify Account</a>
            <a href="#">Add Products</a>
        </div>--><!-- /.ad_pro -->

    </div><!-- /.n_top_data -->


    <div class="n_navigation">
        <ul>
            <li><a <?php if (isset($_smarty_tpl->tpl_vars['active_menu']->value) && $_smarty_tpl->tpl_vars['active_menu']->value == 1) {?> class="active" <?php }?>
                        href="<?php echo site_url_multi('/');?>
pages/<?php echo $_smarty_tpl->tpl_vars['UserData']->value->slug;?>
"><img
                            src="<?php echo base_url('templates/default/assets/images/icons/comp_n.png');?>
"/><span>Company Information</span></a>
            </li>
            <li><a <?php if (isset($_smarty_tpl->tpl_vars['active_menu']->value) && $_smarty_tpl->tpl_vars['active_menu']->value == 2) {?> class="active" <?php }?>
                        href="<?php echo base_url('/');?>
pages/<?php echo $_smarty_tpl->tpl_vars['UserData']->value->slug;?>
/news"><img
                            src="<?php echo base_url('templates/default/assets/images/icons/news_icon.png');?>
"/><span>News</span></a>
            </li>
            <li><a <?php if (isset($_smarty_tpl->tpl_vars['active_menu']->value) && $_smarty_tpl->tpl_vars['active_menu']->value == 3) {?> class="active" <?php }?>
                        href="<?php echo site_url_multi('/');?>
pages/<?php echo $_smarty_tpl->tpl_vars['UserData']->value->slug;?>
/interests"><img
                            src="<?php echo base_url('templates/default/assets/images/icons/interest.png');?>
"/><span>Interest</span></a>
            </li>
            <li><a <?php if (isset($_smarty_tpl->tpl_vars['active_menu']->value) && $_smarty_tpl->tpl_vars['active_menu']->value == 4) {?> class="active" <?php }?>
                        href="<?php echo site_url_multi('/');?>
pages/<?php echo $_smarty_tpl->tpl_vars['UserData']->value->slug;?>
/products"><img
                            src="<?php echo base_url('templates/default/assets/images/icons/prod_n.png');?>
"/><span>Product</span></a>
            </li>
            <li><a <?php if (isset($_smarty_tpl->tpl_vars['active_menu']->value) && $_smarty_tpl->tpl_vars['active_menu']->value == 5) {?> class="active" <?php }?> href="#"><img
                            src="<?php echo base_url('templates/default/assets/images/icons/tender.png');?>
"/><span>Tender</span></a>
            </li>
            <li><a <?php if (isset($_smarty_tpl->tpl_vars['active_menu']->value) && $_smarty_tpl->tpl_vars['active_menu']->value == 6) {?> class="active" <?php }?> href="#"><img
                            src="<?php echo base_url('templates/default/assets/images/icons/ms_icon.png');?>
"/><span>Chat</span></a>
            </li>
            <li><a <?php if (isset($_smarty_tpl->tpl_vars['active_menu']->value) && $_smarty_tpl->tpl_vars['active_menu']->value == 7) {?> class="active" <?php }?>
                        href="<?php echo base_url('/');?>
pages/<?php echo $_smarty_tpl->tpl_vars['UserData']->value->slug;?>
/people"><img
                            src="<?php echo base_url('templates/default/assets/images/icons/pf_icon.png');?>
"/><span>Employees </span></a>
            </li>
            <li><a <?php if (isset($_smarty_tpl->tpl_vars['active_menu']->value) && $_smarty_tpl->tpl_vars['active_menu']->value == 8) {?> class="active" <?php }?>
                        href="<?php echo base_url('/');?>
profile/edit-page"><img
                            src="<?php echo base_url('templates/default/assets/images/icons/st_icon.png');?>
"/><span>Settings</span></a>
            </li>
            <li><a target="_blank" <?php if (isset($_smarty_tpl->tpl_vars['active_menu']->value) && $_smarty_tpl->tpl_vars['active_menu']->value == 9) {?> class="active" <?php }?>
                        href="<?php echo base_url('/');?>
companies/<?php echo $_smarty_tpl->tpl_vars['UserData']->value->slug;?>
"> <span>View my company</span></a>
            </li>
        </ul>

        <span class="personal-account full_width">
            	<a href="<?php echo site_url_multi('/');?>
profile"><img src="<?php echo base_url('templates/default/assets/images/icons/personal_arrow.png');?>
"/>PERSONAL ACCOUNT</a>
            </span>
        <span class="logout">
            	<a href="<?php echo base_url('/');?>
authentication/logout"><img
                            src="<?php echo base_url('templates/default/assets/images/icons/logout.png');?>
"/> <span>Logout</span></a>
            </span>
    </div><!-- /.n_navigation -->
    </div>
</div><!-- /.n_side_section -->


<div class="all_modals">
    
    <?php if ($_smarty_tpl->tpl_vars['get_confirm_status']->value == false) {?>
        <?php if ($_smarty_tpl->tpl_vars['UserData']->value->status == 0) {?>
            <div id="comfirmAccount" class="modal fade forGot" role="dialog"
                 style="z-index:999999999999999;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form class="comfirmAccount" enctype="multipart/form-data" action="<?php echo base_url();?>
profile/comfirmAccount"  method="post">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><img src="<?php echo base_url('templates/default/assets/images/icons/close_n.png');?>
" /></span></button>
                            </div>
                            <div class="modal-body data-response confirm_account_body">
                                <h3>Account Verification</h3>
                                <p>Введите необходимые документы, для подтверждения подлинности
                                    компании. Ваш аккаунт будет верифицирован после подтверждения модераторами.</p>

                                <div class="mod_center_inp change_pss">

                                    <div class="form-group upload_file_box" >
                                        <div class="upload_file_btn" >
                                            <input type="file" name="certifcate" required  />
                                            <svg width="11" height="18" viewBox="0 0 11 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5.5 18C2.46694 18 0 15.477 0 12.375V4.5C0 4.08595 0.328577 3.75005 0.733289 3.75005C1.13813 3.75005 1.46671 4.08595 1.46671 4.5V12.375C1.46671 14.6497 3.27583 16.5 5.5 16.5C7.72417 16.5 9.53329 14.6497 9.53329 12.375V4.12495C9.53329 2.67751 8.38199 1.50005 6.96671 1.50005C5.55129 1.50005 4.4 2.67751 4.4 4.12495V11.625C4.4 12.2452 4.89347 12.75 5.5 12.75C6.10653 12.75 6.6 12.2452 6.6 11.625V4.5C6.6 4.08595 6.92858 3.75005 7.33329 3.75005C7.73813 3.75005 8.06671 4.08595 8.06671 4.5V11.625C8.06671 13.0725 6.91528 14.25 5.5 14.25C4.08472 14.25 2.93329 13.0725 2.93329 11.625V4.12495C2.93329 1.85023 4.74241 0 6.96671 0C9.19088 0 11 1.85023 11 4.12495V12.375C11 15.477 8.53306 18 5.5 18Z" fill="white"/>
                                            </svg>
                                        </div>
                                        <textarea name="info" class="form-control " required placeholder="You can write something…" minlength="10"></textarea>
                                    </div>
                                </div>
                                <div class="mod_center_inp_textarea">
                                    <button type="button" class="close close_modal_btn" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="yes_modal_btn">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php }?>
    <?php }?>
</div>

<?php echo '<script'; ?>
>

    $("#verify_account_modal").on('click', function(){
        $('#comfirmAccount').modal();
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
<?php echo '</script'; ?>
><?php }
}
