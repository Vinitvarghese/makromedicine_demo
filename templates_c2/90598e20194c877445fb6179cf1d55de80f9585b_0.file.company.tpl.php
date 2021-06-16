<?php
/* Smarty version 3.1.30, created on 2020-10-27 16:44:05
  from "/home/makromed/public_html/demo/templates/default/company/company.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f981615216079_79457593',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '90598e20194c877445fb6179cf1d55de80f9585b' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/default/company/company.tpl',
      1 => 1603802538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../company/public-company-sidebar.tpl' => 1,
  ),
),false)) {
function content_5f981615216079_79457593 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_4568794915f981615214ef8_63989195', 'content');
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['layout']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, true);
}
/* {block 'content'} */
class Block_4568794915f981615214ef8_63989195 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>




    <link rel="stylesheet" href="<?php echo base_url('templates/default/assets/css/prefix-style.css');?>
" media="all">
    <style>
        .rate_only{
            display: flex;
            justify-content: center;
        }

        .rating_start{
            border: 0;
            border-radius: 0;
            background-color: transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            cursor: pointer;
            outline: none;
            margin: 0 3px;
        }

        .rating_start svg{
            width: 32px;
            height: 32px;
        }

        .rating_start path{
            fill: #fff;
        }

        .rating_start.active path{
            fill: rgba(255, 210, 0, 1);
        }
    </style>

    <div class="n_content_area full_width">

        <div class="container-fluid">
            <div class="row">
                <?php $_smarty_tpl->_subTemplateRender("file:../company/public-company-sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


                <div class="n_right_section decrease_padding_20 start_with_text">
                    <div class="with_buttons full_width">
                        
                        <!--<a href="#" class="n_green_col">Add Products</a>-->
                    </div>
                    <?php if (!empty($_smarty_tpl->tpl_vars['company']->value->company_banner)) {?>
                    <div class="banner_image_n img_fit full_width">

                        <img src="<?php echo $_smarty_tpl->tpl_vars['company']->value->company_banner;?>
" alt="img" height="313" />
                    </div><!-- /.banner_image_n -->
                    <?php }?>

                    <div class="full_width need_padding_here">
                        <div class="cmother full_width pr-s-n">
                            <h2>COMPANY INFORMATION</h2>
                            
                        </div>

                        <div class="full_width max-arrange">
                            <div class="drt_form full_width">
                                <div class="full_width">
                                    <?php if (!empty($_smarty_tpl->tpl_vars['company']->value->company_name)) {?>
                                    <div class="fst_col">
                                        <label>Company Name <span><?php echo $_smarty_tpl->tpl_vars['company']->value->company_name;?>
</span></label>
                                    </div><!-- /.fst_col -->
                                    <?php }?>

                                    <?php if (!empty($_smarty_tpl->tpl_vars['company']->value->establishment_date)) {?>
                                    <div class="snd_col">
                                        <label>Establishment date <span><?php echo $_smarty_tpl->tpl_vars['company']->value->establishment_date;?>
</span></label>
                                    </div><!-- /.snd_col -->
                                    <?php }?>

                                </div><!-- /.full_width -->
                                <div class="full_width">
                                    <?php if (!empty($_smarty_tpl->tpl_vars['company']->value->group_name)) {?>
                                    <div class="fst_col">
                                        <label>Field of activity <span><?php echo $_smarty_tpl->tpl_vars['company']->value->group_name;?>
</span></label>
                                    </div><!-- /.fst_col -->
                                    <?php }?>

                                    <?php if (!empty($_smarty_tpl->tpl_vars['company']->value->website)) {?>
                                    <div class="snd_col">
                                        <label>Website <span><?php echo $_smarty_tpl->tpl_vars['company']->value->website;?>
</span></label>
                                    </div><!-- /.snd_col -->
                                    <?php }?>


                                </div><!-- /.full_width -->

                                <div class="full_width">

                                    <?php if (!empty($_smarty_tpl->tpl_vars['company']->value->standart)) {?>
                                    <div class="fst_col">
                                        <label>Standard <span><?php echo $_smarty_tpl->tpl_vars['company']->value->standart;?>
</span></label>
                                    </div><!-- /.fst_col -->
                                    <?php }?>

                                </div><!-- /.full_width -->


                            </div><!-- /.drt_form -->

                            <div class="n_personal_info full_width">
                                <?php if (!empty($_smarty_tpl->tpl_vars['company']->value->company_info)) {?>
                                    <h3>ABOUT COMPANY</h3>
                                    <p><?php echo $_smarty_tpl->tpl_vars['company']->value->company_info;?>
</p>
                                <?php }?>

                                <?php if (!empty($_smarty_tpl->tpl_vars['company']->value->tags)) {?>
                                    <h3>Tags</h3>
                                    <div class="tags_nn full_width">
                                        <?php $_smarty_tpl->_assignInScope('tag_list', explode(',',$_smarty_tpl->tpl_vars['company']->value->tags));
?>
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tag_list']->value, 'tag');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['tag']->value) {
?>
                                            <a href="javascript:void(0)"><?php echo $_smarty_tpl->tpl_vars['tag']->value;?>
</a>
                                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                    </div><!-- /.tags_nn -->
                                <?php }?>

                            </div><!-- /.personal_info -->



                            <div class="n_contact_info full_width">
                                <h3>CONTACT INFO</h3>

                                <div class="drt_form full_width">
                                    <div class="full_width">
                                        <?php if (!empty($_smarty_tpl->tpl_vars['company']->value->phone)) {?>
                                        <div class="fst_col">
                                            <label>Phone Number <span><?php echo $_smarty_tpl->tpl_vars['company']->value->phone;?>
</span> </label>
                                        </div><!-- /.fst_col -->
                                        <?php }?>

                                        <?php if (!empty($_smarty_tpl->tpl_vars['company']->value->fullname)) {?>
                                            <div class="snd_col">
                                                <label>Contact Person Name <span class="get_underline"><?php echo $_smarty_tpl->tpl_vars['company']->value->fullname;?>
</span></label>
                                            </div><!-- /.snd_col -->
                                        <?php }?>


                                    </div><!-- /.full_width -->

                                    <div class="full_width">

                                        <div class="snd_col">


                                            <?php if ($_smarty_tpl->tpl_vars['person_type']->value) {?>
                                                <label>Person Type
                                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['person_type']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
                                                        <?php if ($_smarty_tpl->tpl_vars['value']->value->id == $_smarty_tpl->tpl_vars['company']->value->position) {?> <span class="get_underline"><?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
</span> <?php break 1;?> <?php }?>
                                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                                </label>
                                            <?php }?>

                                        </div><!-- /.snd_col -->

                                    </div><!-- /.full_width -->

                                    <div class="full_width">

                                        <?php if ($_smarty_tpl->tpl_vars['company']->value->country_id > 0) {?>
                                        <div class="fst_col">
                                            <label>Country <span><?php echo get_country_name($_smarty_tpl->tpl_vars['company']->value->country_id);?>
</span></label>
                                        </div><!-- /.fst_col -->
                                        <?php }?>

                                        <?php if (!empty($_smarty_tpl->tpl_vars['company']->value->email) && $_smarty_tpl->tpl_vars['is_loggedin']->value) {?>
                                        <div class="snd_col">
                                            <label>E-mail <span><?php echo $_smarty_tpl->tpl_vars['company']->value->email;?>
</span></label>
                                        </div><!-- /.snd_col -->
                                        <?php }?>
                                    </div><!-- /.full_width -->

                                    <div class="full_width">
                                        <?php if ($_smarty_tpl->tpl_vars['company']->value->company_address) {?>
                                        <div class="fst_col">
                                            <label>Address <span><?php echo $_smarty_tpl->tpl_vars['company']->value->company_address;?>
</span></label>

                                            <?php if (!empty($_smarty_tpl->tpl_vars['company']->value->company_lat) && !empty($_smarty_tpl->tpl_vars['company']->value->company_lng)) {?>
                                                <div class="map__">
                                                    <iframe width="265" height="265"  src="https://maps.google.com/maps?q=<?php echo $_smarty_tpl->tpl_vars['company']->value->company_address;?>
&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                                                </div>
                                            <?php }?>
                                        </div><!-- /.fst_col -->
                                        <?php }?>

                                        <?php if ($_smarty_tpl->tpl_vars['is_loggedin']->value) {?>
                                            <div class="snd_col al_blk">
                                                <hr class="thrx">
                                                <?php if (!empty($_smarty_tpl->tpl_vars['company']->value->fullname)) {?>
                                                    <label>Contact Person Name <span><?php echo $_smarty_tpl->tpl_vars['company']->value->fullname;?>
</span></label>
                                                <?php }?>

                                                <?php if ($_smarty_tpl->tpl_vars['person_type']->value) {?>
                                                    <label>Person Type
                                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['person_type']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
                                                        <?php if ($_smarty_tpl->tpl_vars['value']->value->id == $_smarty_tpl->tpl_vars['company']->value->position) {?> <span class="get_underline"><?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
</span> <?php break 1;?> <?php }?>
                                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                                    </label>
                                                <?php }?>

                                                <?php if (!empty($_smarty_tpl->tpl_vars['company']->value->email)) {?>
                                                    <label>E-mail <span><?php echo $_smarty_tpl->tpl_vars['company']->value->email;?>
</span></label>
                                                <?php }?>
                                            </div><!-- /.snd_col -->
                                        <?php }?>

                                    </div><!-- /.full_width -->

                                    <div class="n_social_block full_width">

                                        <?php if (!empty($_smarty_tpl->tpl_vars['company']->value->company_facebook)) {?>
                                            <a href="<?php echo $_smarty_tpl->tpl_vars['company']->value->company_facebook;?>
" target="_blank"><img src="<?php echo base_url('templates/default/assets/images/icons/n_face.png');?>
" alt="facebook"></a>
                                        <?php }?>

                                        <?php if (!empty($_smarty_tpl->tpl_vars['company']->value->company_twitter)) {?>
                                            <a href="<?php echo $_smarty_tpl->tpl_vars['company']->value->company_twitter;?>
" target="_blank"><img src="<?php echo base_url('templates/default/assets/images/icons/n_twit.png');?>
" alt="twitter"></a>
                                        <?php }?>

                                        <?php if (!empty($_smarty_tpl->tpl_vars['company']->value->company_youtube)) {?>
                                            <a href="<?php echo $_smarty_tpl->tpl_vars['company']->value->company_youtube;?>
" target="_blank"><img src="<?php echo base_url('templates/default/assets/images/icons/n_tube.png');?>
" alt="youtube"></a>
                                        <?php }?>

                                        <?php if (!empty($_smarty_tpl->tpl_vars['company']->value->company_linkedin)) {?>
                                            <a href="<?php echo $_smarty_tpl->tpl_vars['company']->value->company_linkedin;?>
" target="_blank"><img src="<?php echo base_url('templates/default/assets/images/icons/n_in.png');?>
" alt="linkedin"></a>
                                        <?php }?>

                                    </div><!-- /.social_block -->
                                </div><!-- /.contact_info -->
                            </div><!-- /.max_arrange -->
                        </div><!-- /.need_padding_here -->
                    </div><!-- /.right_section -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->

        </div><!-- /.n_content_area -->
    </div>
    <div class="clearfix"></div>

    <?php if ($_smarty_tpl->tpl_vars['is_loggedin']->value) {?>
        <?php echo '<script'; ?>
>
            $('.give_rating_btn').click(function () {
                var bu=$(this),
                    id=bu.data('id'),
                    rate_only=bu.parents('.rate_only'),
                    action=1;

                if(id >= 1 && id <=5){

                    if(id==1){
                        $('.give_rating_btn').not(bu).removeClass('active');

                        bu.toggleClass('active');

                        if(!bu.hasClass('active')){

                            action=0;

                            rate_only.removeClass('rated').addClass('not_rated');

                        }else{
                            rate_only.addClass('rated').removeClass('not_rated');
                        }


                    }else{
                        $('.give_rating_btn').removeClass('active');

                        for(let i=1; i<=id; i++){
                            $('.give_rating_btn_'+i).addClass('active');
                        }


                        rate_only.addClass('rated').removeClass('not_rated');
                    }

                    

                    $.ajax({
                       url : site_url + 'company/give_rating',
                       method : 'post',
                       data : { profile_id : <?php echo $_smarty_tpl->tpl_vars['company']->value->id;?>
, user_id : <?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
, rate : id, action : action },
                       dataType : 'json',
                       cache : false,
                       success : function (res) {

                       }
                    });
                }


            }).hover(function(){
                var bu=$(this),
                    id=bu.data('id'),
                    rate_only=bu.parents('.rate_only');

                if(rate_only.hasClass('not_rated')){
                    $('.give_rating_btn').removeClass('active');

                    for(let i=1; i<=id; i++){
                        $('.give_rating_btn_'+i).addClass('active');
                    }
                }


            }, function(){
                var bu=$(this),
                    id=bu.data('id'),
                    rate_only=bu.parents('.rate_only');

                if(rate_only.hasClass('not_rated')){
                    $('.give_rating_btn').removeClass('active');
                }

            });
        <?php echo '</script'; ?>
>
    <?php }?>

<?php
}
}
/* {/block 'content'} */
}
