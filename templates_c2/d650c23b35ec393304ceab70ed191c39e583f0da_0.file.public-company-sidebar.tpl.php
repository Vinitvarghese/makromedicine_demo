<?php
/* Smarty version 3.1.30, created on 2020-10-27 16:44:05
  from "/home/makromed/public_html/demo/templates/default/company/public-company-sidebar.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f981615245869_77858516',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd650c23b35ec393304ceab70ed191c39e583f0da' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/default/company/public-company-sidebar.tpl',
      1 => 1603802537,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f981615245869_77858516 (Smarty_Internal_Template $_smarty_tpl) {
?>
<style>
    .n_top_data h3 span { padding-bottom: 0;}
    .create_btn_a {
        margin: 15px auto;
        color: rgba(33, 135, 197, 1);
        font-size: 16px;
        text-align: center;
        min-width: 171px;
        max-width: 171px;
        height: 38px;
        display: block;
        background: rgba(246, 246, 246, 1);
        border-radius: 18px;
        padding: 12px 15px;
    }
</style>
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


<div class="n_side_section color_change_green">
<div class="userSettings">
    <div class="n_top_data">
        <a href="#" id="menu_hide">Hide</a>
        <div class="n_profile_img img_fit">
            <?php if ($_smarty_tpl->tpl_vars['company_logo']->value) {?>
                <img src="<?php echo $_smarty_tpl->tpl_vars['company_logo']->value;?>
"/>
            <?php } else { ?>
                <img src="<?php echo base_url('templates/default/assets/images/bloomberg.png');?>
" alt="img"/>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['get_confirm_status']->value == false) {?>
            <?php if ($_smarty_tpl->tpl_vars['company']->value->status > 0) {?>
            <a href="#" class="n_pro_tick"><img src="<?php echo base_url('templates/default/assets/images/icons/tck_.png');?>
"/></a>
            <?php }?>
            <?php }?>
        </div><!-- /.n_profile_img -->
        <h2><?php echo $_smarty_tpl->tpl_vars['company']->value->company_name;?>
</h2>
        <?php if ($_smarty_tpl->tpl_vars['get_confirm_status']->value == false) {?>
        <?php if ($_smarty_tpl->tpl_vars['company']->value->status > 0) {?>
            <h3>Company status<span>Verified</span></h3>
        <?php }?>
        <?php }?>
        
            <?php if ($_smarty_tpl->tpl_vars['check_follow']->value > 0) {?>
                <a id="follow-button" user-id="<?php echo $_smarty_tpl->tpl_vars['company']->value->id;?>
" <?php if ($_smarty_tpl->tpl_vars['is_loggedin']->value == false) {?> follow-status="0" <?php } else { ?> follow-status="1" <?php }?> class="create_btn_a">Following</a>
            <?php } else { ?>
                <a id="follow-button" class="create_btn_a <?php if ($_smarty_tpl->tpl_vars['is_loggedin']->value == false) {?> triggerSignup<?php }?>" user-id="<?php echo $_smarty_tpl->tpl_vars['company']->value->id;?>
" <?php if ($_smarty_tpl->tpl_vars['is_loggedin']->value == false) {?> follow-status="0" <?php } else { ?> follow-status="1" <?php }?> >+ Follow</a>
            <?php }?>
        
        <hr>
        <h4>Give Rate:</h4> <br/>

        <span class="rate_only <?php if ($_smarty_tpl->tpl_vars['company_rate']->value >= 1) {?> rated <?php } else { ?> not_rated <?php }?>">
            <?php if ($_smarty_tpl->tpl_vars['is_loggedin']->value) {?>
                <button type="button" class="rating_start give_rating_btn_1 <?php if ($_smarty_tpl->tpl_vars['is_loggedin']->value && $_smarty_tpl->tpl_vars['company_rate']->value >= 1) {?> active <?php }?> <?php if ($_smarty_tpl->tpl_vars['company']->value->id != $_smarty_tpl->tpl_vars['UserData']->value->id) {?> give_rating_btn <?php }?>" <?php if ($_smarty_tpl->tpl_vars['is_loggedin']->value) {?> data-id="1"  data-profile_id="<?php echo $_smarty_tpl->tpl_vars['company']->value->id;?>
" data-user_id="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->id;?>
" <?php }?> >
                    <?php echo $_smarty_tpl->tpl_vars['normal_star']->value;?>

                </button>

                <button type="button" class="rating_start give_rating_btn_2 <?php if ($_smarty_tpl->tpl_vars['is_loggedin']->value && $_smarty_tpl->tpl_vars['company_rate']->value >= 2) {?> active <?php }?> <?php if ($_smarty_tpl->tpl_vars['company']->value->id != $_smarty_tpl->tpl_vars['UserData']->value->id) {?> give_rating_btn <?php }?>"  <?php if ($_smarty_tpl->tpl_vars['is_loggedin']->value) {?>data-id="2"  data-profile_id="<?php echo $_smarty_tpl->tpl_vars['company']->value->id;?>
" data-user_id="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->id;?>
" <?php }?> >
                    <?php echo $_smarty_tpl->tpl_vars['normal_star']->value;?>

                </button>

                <button type="button" class="rating_start give_rating_btn_3 <?php if ($_smarty_tpl->tpl_vars['is_loggedin']->value && $_smarty_tpl->tpl_vars['company_rate']->value >= 3) {?> active <?php }?> <?php if ($_smarty_tpl->tpl_vars['company']->value->id != $_smarty_tpl->tpl_vars['UserData']->value->id) {?> give_rating_btn <?php }?>"  <?php if ($_smarty_tpl->tpl_vars['is_loggedin']->value) {?> data-id="3"  data-profile_id="<?php echo $_smarty_tpl->tpl_vars['company']->value->id;?>
" data-user_id="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->id;?>
" <?php }?> >
                    <?php echo $_smarty_tpl->tpl_vars['normal_star']->value;?>

                </button>

                <button type="button" class="rating_start give_rating_btn_4 <?php if ($_smarty_tpl->tpl_vars['is_loggedin']->value && $_smarty_tpl->tpl_vars['company_rate']->value >= 4) {?> active <?php }?> <?php if ($_smarty_tpl->tpl_vars['company']->value->id != $_smarty_tpl->tpl_vars['UserData']->value->id) {?> give_rating_btn <?php }?>"  <?php if ($_smarty_tpl->tpl_vars['is_loggedin']->value) {?> data-id="4"  data-profile_id="<?php echo $_smarty_tpl->tpl_vars['company']->value->id;?>
" data-user_id="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->id;?>
" <?php }?> >
                    <?php echo $_smarty_tpl->tpl_vars['normal_star']->value;?>

                </button>

                <button type="button" class="rating_start give_rating_btn_5 <?php if ($_smarty_tpl->tpl_vars['is_loggedin']->value && $_smarty_tpl->tpl_vars['company_rate']->value >= 5) {?> active <?php }?> <?php if ($_smarty_tpl->tpl_vars['company']->value->id != $_smarty_tpl->tpl_vars['UserData']->value->id) {?> give_rating_btn <?php }?>"  <?php if ($_smarty_tpl->tpl_vars['is_loggedin']->value) {?> data-id="5"  data-profile_id="<?php echo $_smarty_tpl->tpl_vars['company']->value->id;?>
" data-user_id="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->id;?>
" <?php }?> >
                    <?php echo $_smarty_tpl->tpl_vars['normal_star']->value;?>

                </button>
            <?php } else { ?>
                <button type="button" class="rating_start <?php if ($_smarty_tpl->tpl_vars['company_star_rate_count']->value >= 1) {?> active <?php }?>   triggerSignup" >
                   <?php echo $_smarty_tpl->tpl_vars['normal_star']->value;?>

                </button>

                <button type="button" class="rating_start <?php if ($_smarty_tpl->tpl_vars['company_star_rate_count']->value >= 2) {?> active <?php }?> triggerSignup" >
                    <?php echo $_smarty_tpl->tpl_vars['normal_star']->value;?>

                </button>

                <button type="button" class="rating_start <?php if ($_smarty_tpl->tpl_vars['company_star_rate_count']->value >= 3) {?> active <?php }?> triggerSignup" >
                    <?php echo $_smarty_tpl->tpl_vars['normal_star']->value;?>

                </button>

                <button type="button" class="rating_start <?php if ($_smarty_tpl->tpl_vars['company_star_rate_count']->value >= 4) {?> active <?php }?> triggerSignup" >
                    <?php echo $_smarty_tpl->tpl_vars['normal_star']->value;?>

                </button>

                <button type="button" class="rating_start <?php if ($_smarty_tpl->tpl_vars['company_star_rate_count']->value >= 5) {?> active <?php }?> triggerSignup " >
                    <?php echo $_smarty_tpl->tpl_vars['normal_star']->value;?>

                </button>
            <?php }?>
        </span>

        <p style="color: #fff; margin-bottom: 10px;">
            <?php echo $_smarty_tpl->tpl_vars['company_rate_total']->value;?>
 users rated
            <?php if ($_smarty_tpl->tpl_vars['is_loggedin']->value) {?> 
                ( <?php echo $_smarty_tpl->tpl_vars['company_star_rate_count']->value;?>
/5 )
            <?php }?>
        </p>
        <hr>
        <h6><?php echo $_smarty_tpl->tpl_vars['user_following']->value;?>
<span>Followers</span></h6>
        <hr>

    </div><!-- /.n_top_data -->


    <div class="n_navigation">
        <ul>
            <li>
                <a href="<?php echo site_url_multi('/');?>
companies/<?php echo $_smarty_tpl->tpl_vars['company']->value->slug;?>
" <?php if (isset($_smarty_tpl->tpl_vars['active_menu']->value) && $_smarty_tpl->tpl_vars['active_menu']->value == 1) {?> class="active" <?php }?>><img
                            src="<?php echo base_url('templates/default/assets/images/icons/comp_n.png');?>
"/><span>Company Information</span></a>
            </li>
            <li>
                <a href="<?php echo base_url('/');?>
companies/<?php echo $_smarty_tpl->tpl_vars['company']->value->slug;?>
/news" <?php if (isset($_smarty_tpl->tpl_vars['active_menu']->value) && $_smarty_tpl->tpl_vars['active_menu']->value == 2) {?> class="active" <?php }?>><img
                            src="<?php echo base_url('templates/default/assets/images/icons/news_icon.png');?>
"/><span>News</span></a>
            </li>
            <li>
                <a href="<?php echo site_url_multi('/');?>
companies/<?php echo $_smarty_tpl->tpl_vars['company']->value->slug;?>
/interests" <?php if (isset($_smarty_tpl->tpl_vars['active_menu']->value) && $_smarty_tpl->tpl_vars['active_menu']->value == 3) {?> class="active" <?php }?>><img
                            src="<?php echo base_url('templates/default/assets/images/icons/interest.png');?>
"/><span>Interest</span></a>
            </li>
            <li>
                <a href="<?php echo site_url_multi('/');?>
companies/<?php echo $_smarty_tpl->tpl_vars['company']->value->slug;?>
/products" <?php if (isset($_smarty_tpl->tpl_vars['active_menu']->value) && $_smarty_tpl->tpl_vars['active_menu']->value == 4) {?> class="active" <?php }?>><img
                            src="<?php echo base_url('templates/default/assets/images/icons/prod_n.png');?>
"/><span>Product</span></a>
            </li>
            <li><a href="<?php echo site_url_multi('/');?>
companies/<?php echo $_smarty_tpl->tpl_vars['company']->value->slug;?>
/tenders" <?php if (isset($_smarty_tpl->tpl_vars['active_menu']->value) && $_smarty_tpl->tpl_vars['active_menu']->value == 5) {?> class="active" <?php }?>><img
                            src="<?php echo base_url('templates/default/assets/images/icons/tender.png');?>
"/><span>Tender</span></a>
            </li>
            <li><a href="<?php echo site_url_multi('/');?>
companies/<?php echo $_smarty_tpl->tpl_vars['company']->value->slug;?>
/chats" <?php if (isset($_smarty_tpl->tpl_vars['active_menu']->value) && $_smarty_tpl->tpl_vars['active_menu']->value == 6) {?> class="active" <?php }?>><img
                            src="<?php echo base_url('templates/default/assets/images/icons/ms_icon.png');?>
"/><span>Chat</span></a>
            </li>
            <li>
                <a href="<?php echo site_url_multi('/');?>
companies/<?php echo $_smarty_tpl->tpl_vars['company']->value->slug;?>
/people" <?php if (isset($_smarty_tpl->tpl_vars['active_menu']->value) && $_smarty_tpl->tpl_vars['active_menu']->value == 7) {?> class="active" <?php }?>><img
                            src="<?php echo base_url('templates/default/assets/images/icons/pf_icon.png');?>
"/><span>Employees </span></a>
            </li>
            
        </ul>

        <?php if ($_smarty_tpl->tpl_vars['user']->value) {?>
            <span class="logout">
            	<a href="<?php echo base_url('/');?>
authentication/logout"><img
                            src="<?php echo base_url('templates/default/assets/images/icons/logout.png');?>
"/> <span>Logout</span></a>
            </span>
        <?php }?>
    </div><!-- /.n_navigation -->
    </div>
</div><!-- /.n_side_section -->


 


<?php echo '<script'; ?>
>

$(document).ready(function(){

    $('.give_rating_btn').click(function () {
        var bu=$(this),
            id=bu.data('id'),
            profile_id=bu.data('profile_id'),
            user_id=bu.data('user_id')
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
               data : { profile_id : profile_id, user_id :user_id, rate : id, action : action },
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

   

    $("#follow-button").click(function(){
        var user_id       = $(this).attr('user-id');
        var follow_status = $(this).attr('follow-status');

        if(follow_status == 1)
        {
            if ($("#follow-button").text() == "+ Follow"){
                $.ajax({
                    type:'POST',
                    url:site_url+'follow/follow/',
                    data: {'user_id':user_id},
                    cache:true,
                    success:function(data){
                      $("#follow-button").text("Following");
                      toastr.success('Follow successful !');
                      window.location = '';
                    }
                });
            }else{
              $.ajax({
                  type:'POST',
                  url:site_url+'follow/unfollow/',
                  data: {'user_id':user_id},
                  cache:true,
                  success:function(data){
                    $("#follow-button").text("Follow");
                    toastr.warning('Unfollow successful !');
                    window.location = '';
                  }
              });

            }
        }
        else
        {
        }
    });
});

<?php echo '</script'; ?>
>


    

<?php }
}
