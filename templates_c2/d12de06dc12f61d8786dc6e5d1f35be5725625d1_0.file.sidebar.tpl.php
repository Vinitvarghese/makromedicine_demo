<?php
/* Smarty version 3.1.30, created on 2020-10-27 16:46:48
  from "/home/makromed/public_html/demo/templates/default/profile/sidebar.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f9816b8ad9fd8_49507346',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd12de06dc12f61d8786dc6e5d1f35be5725625d1' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/default/profile/sidebar.tpl',
      1 => 1603802542,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f9816b8ad9fd8_49507346 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="n_side_section">
    <form class="userSettings" action="<?php echo base_url();?>
profile/save" enctype="multipart/form-data"
          method="post">
        <div class="n_top_data">
        <a href="#" id="menu_hide">Hide</a>

            <?php if ($_smarty_tpl->tpl_vars['UserData']->value->checked == 0 && !empty($_smarty_tpl->tpl_vars['UserData']->value->verification_code)) {?>
                <span class="verify_acc full_width">Verify Your Account <i>!</i></span>
                <div class="ad_pro_n full_width mb_30">
                    <a href="<?php echo base_url('authentication/confirm/');
echo $_smarty_tpl->tpl_vars['UserData']->value->verification_code;?>
" class="red_verify" >Verify Account</a>
                </div>
                <!-- /.ad_pro -->
            <?php }?>

            <div class="n_profile_img img_fit">
                <img src="<?php echo $_smarty_tpl->tpl_vars['user_images']->value;?>
" alt="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->fullname;?>
" id="n_profile_img_uploaded" />
                <?php if (isset($_smarty_tpl->tpl_vars['active_menu']->value) && $_smarty_tpl->tpl_vars['active_menu']->value == 2) {?>
                <span class="over_n"></span>
                <!--<a href="#" class="n_pro_close"><img
                            src="<?php echo base_url('templates/default/assets/images/icons/n_close.png');?>
"></a>-->
                <a href="#" class="change_btn_n userphotos-change-dup">Change</a>
                <?php }?>
            </div><!-- /.n_profile_img -->
            <h2>
                <?php echo $_smarty_tpl->tpl_vars['UserData']->value->fullname;?>

                <span>
                <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->position)) {
echo $_smarty_tpl->tpl_vars['UserData']->value->position_name;
}?>
            </span>
            </h2>
            <hr>
            <?php if (isset($_smarty_tpl->tpl_vars['settings']->value) && $_smarty_tpl->tpl_vars['settings']->value == 1) {?>
                <h6><?php echo $_smarty_tpl->tpl_vars['user_followers']->value;?>
<span>Followers</span></h6>
                <h6><?php echo $_smarty_tpl->tpl_vars['user_following']->value;?>
<span>Following</span></h6>
            <?php } else { ?>
                <h6><?php echo $_smarty_tpl->tpl_vars['user_followers']->value;?>
<span>Followers</span></h6>
                <h6><?php echo $_smarty_tpl->tpl_vars['user_following']->value;?>
<span>Following</span></h6>
                
            <?php }?>
        </div><!-- /.n_top_data -->

        <div class="n_navigation">
            <ul>
                <li>
                    <a href="<?php echo site_url_multi('/');?>
profile/" <?php if (isset($_smarty_tpl->tpl_vars['active_menu']->value) && $_smarty_tpl->tpl_vars['active_menu']->value == 1) {?> class="active" <?php }?>><img
                                src="<?php echo base_url('templates/default/assets/images/icons/pf_icon.png');?>
"/><span>Profile View</span></a>
                </li>
                <li>
                    <a href="javascript:" <?php if (isset($_smarty_tpl->tpl_vars['active_menu']->value) && $_smarty_tpl->tpl_vars['active_menu']->value == 20) {?> class="active" <?php }?>>
                        <img src="<?php echo base_url('templates/default/assets/images/icons/ms_icon.png');?>
"/><span>Chat</span></a>
                </li>
                <li>
                    <a href="<?php echo site_url_multi('/');?>
profile/accounts/" <?php if (isset($_smarty_tpl->tpl_vars['active_menu']->value) && $_smarty_tpl->tpl_vars['active_menu']->value == 2) {?> class="active" <?php }?>>
                        <img src="<?php echo base_url('templates/default/assets/images/icons/st_icon.png');?>
"/><span>Settings</span></a>
                </li>
            </ul>
            <?php if ($_smarty_tpl->tpl_vars['UserData']->value->page_created == 0 && empty($_smarty_tpl->tpl_vars['UserData']->value->company_name)) {?>
                <span class="create_btn">
                <a href="<?php echo base_url('/');?>
profile/create-page">Create Company</a>
            </span>
                <!-- /.create_btn -->
            <?php } elseif ($_smarty_tpl->tpl_vars['UserData']->value->page_created == 3) {?>
                <span class="create_btn"><a href="<?php echo base_url('/');?>
profile/create-page"><?php echo $_smarty_tpl->tpl_vars['UserData']->value->company_name;?>
</a></span>
                <!-- /.create_btn -->
            <?php } elseif (!empty($_smarty_tpl->tpl_vars['UserData']->value->company_name)) {?>
                <span class="create_btn"><a href="<?php echo site_url_multi('/');?>
pages/<?php echo $_smarty_tpl->tpl_vars['UserData']->value->slug;?>
"><?php echo $_smarty_tpl->tpl_vars['UserData']->value->company_name;?>
</a></span>
                <!-- /.create_btn -->
            <?php }?>

            
            <span class="logout">
            	<a href="<?php echo base_url('/');?>
authentication/logout"><img
                            src="<?php echo base_url('templates/default/assets/images/icons/logout.png');?>
"/> <span>Logout</span></a>
            </span>
        </div><!-- /.n_navigation -->
    </form>
</div><!-- /.n_side_section -->


<div id="viewCert" class="modal fade" role="dialog" style="z-index:9999999;">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Your Certificate</h4>
            </div>
            <div class="modal-body">
                <?php if (isset($_smarty_tpl->tpl_vars['UserData']->value->certificate)) {?>
                    <div class="form-group">
                        <div class="img-st-profil" style="width:100%">
                            <a href="#" onclick="$('#comfirmAccount').modal();">
                                <img src="<?php echo base_url('uploads');?>
/catalog/certifcate/<?php echo $_smarty_tpl->tpl_vars['UserData']->value->certificate;?>
">
                                <div class="overlay"><i class="fa fa-edit"></i>replace image</div>
                            </a>
                        </div>
                    </div>
                <?php }?>
            </div>
        </div>
    </div>
</div>



<?php echo '<script'; ?>
>
    $(document).ready(function () {
        $('.userphotos-change-dup').on('click', function (ev) {
            ev.preventDefault();
            $('.userphotos').trigger('click');
        })
    })
<?php echo '</script'; ?>
>
<?php }
}
