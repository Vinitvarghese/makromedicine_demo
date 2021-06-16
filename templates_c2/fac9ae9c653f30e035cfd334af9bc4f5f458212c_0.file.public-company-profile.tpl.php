<?php
/* Smarty version 3.1.30, created on 2020-10-27 18:19:03
  from "/home/makromed/public_html/demo/templates/default/company/public-company-profile.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f982c5761e7f7_98290549',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fac9ae9c653f30e035cfd334af9bc4f5f458212c' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/default/company/public-company-profile.tpl',
      1 => 1603802538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../company/public-company-sidebar.tpl' => 1,
  ),
),false)) {
function content_5f982c5761e7f7_98290549 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_6460122195f982c5761de26_86174844', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['layout']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, true);
}
/* {block 'content'} */
class Block_6460122195f982c5761de26_86174844 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<link rel="stylesheet" href="<?php echo base_url('templates/default/assets/css/prefix-style.css');?>
" media="all">
<div class="n_content_area full_width" >
    <a href="#" id="openMenu" class="public-menu-float">Menu</a>

    <div class="container-fluid">
        <div class="row">
            <?php $_smarty_tpl->_subTemplateRender("file:../company/public-company-sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

            <div class="n_right_section decrease_padding_20 start_with_text">
                <div class="banner_image_n img_fit full_width">
                    <?php if ($_smarty_tpl->tpl_vars['company_banner']->value) {?>
                        <img src="<?php echo $_smarty_tpl->tpl_vars['company_banner']->value;?>
" alt="<?php echo $_smarty_tpl->tpl_vars['user']->value->company_name;?>
" style="max-height: 220px; object-fit: cover;" />
                    <?php } else { ?>
                        <img src="<?php echo base_url('templates/default/assets/images/bnnr.png');?>
" style="max-height: 220px; object-fit: cover;" alt="<?php echo $_smarty_tpl->tpl_vars['user']->value->company_name;?>
" />
                    <?php }?>
                </div><!-- /.banner_image_n -->

                <div class="full_width need_padding_here">
                    <div class="cmother full_width pr-s-n">
                        <h2>COMPANY INFORMATION</h2>
                        
                    </div>
                    <div class="full_width max-arrange">
                        <div class="drt_form full_width">
                            <div class="full_width">
                                <div class="fst_col">
                                    <label>Company Name <span><?php echo $_smarty_tpl->tpl_vars['user']->value->company_name;?>
</span></label>
                                </div><!-- /.fst_col -->
                                <div class="snd_col">
                                    <label>Establishment date <span><?php echo $_smarty_tpl->tpl_vars['user']->value->establishment_date;?>
</span></label>
                                </div><!-- /.snd_col -->
                            </div><!-- /.full_width -->
                            <div class="full_width">
                                <div class="fst_col">
                                    <label>Field of activity <span><?php echo $_smarty_tpl->tpl_vars['selected_product_type_names']->value;?>
</span></label>
                                </div><!-- /.fst_col -->
                                <div class="snd_col">
                                    <label>Website <span><?php echo $_smarty_tpl->tpl_vars['user']->value->website;?>
</span></label>
                                </div><!-- /.snd_col -->
                            </div><!-- /.full_width -->
                            <?php if ($_smarty_tpl->tpl_vars['get_standart']->value) {?>
                                <div class="full_width">
                                    <div class="fst_col">
                                        <label>Standart
                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['get_standart']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
                                                <span><?php echo $_smarty_tpl->tpl_vars['value']->value['st_name'];?>
</span>
                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                        </label>
                                    </div><!-- /.fst_col -->

                                </div><!-- /.full_width -->
                            <?php }?>
                        </div><!-- /.drt_form -->

                        <div class="n_personal_info n_personal_info2 full_width">
                            <?php if (!empty($_smarty_tpl->tpl_vars['user']->value->company_info)) {?>
                                <h3>ABOUT COMPANY</h3>
                                <?php echo $_smarty_tpl->tpl_vars['user']->value->company_info;?>

                            <?php }?>
                            <?php if (!empty(trim($_smarty_tpl->tpl_vars['tags']->value))) {?>
                                <div class="tags_nn full_width">
                                    
                                    <?php echo $_smarty_tpl->tpl_vars['tags']->value;?>

                                </div><!-- /.tags_nn -->
                            <?php }?>
                        </div><!-- /.personal_info -->



                        <div class="n_contact_info full_width">
                            <h3>CONTACT INFO</h3>
                            <?php if ($_smarty_tpl->tpl_vars['company_info']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['company_info']->value, 'company');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['company']->value) {
?>
                                <div class="drt_form full_width">
                                    <div class="full_width">
                                        <div class="fst_col">
                                            <label>Phone Number <span><?php echo $_smarty_tpl->tpl_vars['company']->value->phone;?>
 <i>
                                                    <?php if ($_smarty_tpl->tpl_vars['phone_type']->value) {?>
                                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['phone_type']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
                                                            <?php if ($_smarty_tpl->tpl_vars['value']->value->id == $_smarty_tpl->tpl_vars['company']->value->phone_type) {?> <?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
 <?php break 1;?> <?php }?>
                                                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                                    <?php }?>
                                                </i></span> </label>
                                        </div><!-- /.fst_col -->
                                        <div class="snd_col">
                                            <label>Contact Person Name <span class="get_underline"><?php echo $_smarty_tpl->tpl_vars['company']->value->fullname;?>
</span></label>
                                        </div><!-- /.snd_col -->
                                    </div><!-- /.full_width -->
                                    <div class="full_width">
                                        <div class="fst_col">
                                            <label>Ext <span><?php echo $_smarty_tpl->tpl_vars['company']->value->ext;?>
</span></label>
                                        </div><!-- /.fst_col -->
                                        <div class="snd_col">
                                            <label>Person Type
                                                <?php if ($_smarty_tpl->tpl_vars['person_type']->value) {?>
                                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['person_type']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
                                                        <?php if ($_smarty_tpl->tpl_vars['value']->value->id == $_smarty_tpl->tpl_vars['company']->value->person_type) {?> <span class="get_underline"><?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
 </span><?php break 1;?> <?php }?>
                                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                                <?php }?>
                                            </span></label>
                                        </div><!-- /.snd_col -->
                                    </div><!-- /.full_width -->
                                    <div class="full_width">
                                        <div class="fst_col">
                                            <label>Country <span><?php echo get_country_name($_smarty_tpl->tpl_vars['user']->value->country_id);?>
</span></label>
                                        </div><!-- /.fst_col -->
                                        <div class="snd_col">
                                            <label>E-mail <span><?php echo $_smarty_tpl->tpl_vars['company']->value->email;?>
</span></label>
                                        </div><!-- /.snd_col -->
                                    </div><!-- /.full_width -->

                                    <div class="full_width">
                                        <?php if (!empty($_smarty_tpl->tpl_vars['user']->value->company_address)) {?>
                                            <div class="fst_col">
                                                <label>Address <span><?php echo $_smarty_tpl->tpl_vars['user']->value->company_address;?>
</span></label>
                                                <div class="map__">
                                                    <iframe width="265" height="265"  src="https://maps.google.com/maps?q=<?php echo $_smarty_tpl->tpl_vars['user']->value->company_address;?>
&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>

                                                </div>
                                            </div><!-- /.fst_col -->
                                        <?php }?>
                                    </div><!-- /.full_width -->
                                </div><!-- /.contact_info -->
                                <hr style="background-color: rgba(33, 135, 197, 0.6);"/>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                            <div class="drt_form full_width">
                                <div class="n_social_block full_width">
                                    <?php if (!empty($_smarty_tpl->tpl_vars['user']->value->company_facebook)) {?>
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['user']->value->company_facebook;?>
"><img src="<?php echo base_url('templates/default/assets/images/icons/n_face.png');?>
" alt="facebook"></a>
                                    <?php }?>
                                    <?php if (!empty($_smarty_tpl->tpl_vars['user']->value->company_twitter)) {?>
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['user']->value->company_twitter;?>
"><img src="<?php echo base_url('templates/default/assets/images/icons/n_twit.png');?>
" alt="twitter"></a>
                                    <?php }?>
                                    <?php if (!empty($_smarty_tpl->tpl_vars['user']->value->company_linkedin)) {?>
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['user']->value->company_linkedin;?>
"><img src="<?php echo base_url('templates/default/assets/images/icons/n_in.png');?>
" alt="linkedin"></a>
                                    <?php }?>
                                    <?php if (!empty($_smarty_tpl->tpl_vars['user']->value->company_youtube)) {?>
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['user']->value->company_youtube;?>
"><img src="<?php echo base_url('templates/default/assets/images/icons/n_tube.png');?>
" alt="youtube"></a>
                                    <?php }?>
                                </div><!-- /.social_block -->
                            </div>
                        </div><!-- /.max_arrange -->
                    </div><!-- /.need_padding_here -->
                </div><!-- /.right_section -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->

    </div><!-- /.n_content_area -->
</div>
    <div class="clearfix"></div>



    
    <?php
}
}
/* {/block 'content'} */
}
