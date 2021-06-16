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
            {if $company_logo}
                <img src="{$company_logo}"/>
            {else}
                <img src="{base_url('templates/default/assets/images/bloomberg.png')}" alt="img"/>
            {/if}
            {if $get_confirm_status eq false}
            {if $user->status gt 0}
            <a href="#" class="n_pro_tick"><img src="{base_url('templates/default/assets/images/icons/tck_.png')}"/></a>
            {/if}
            {/if}
        </div><!-- /.n_profile_img -->
        <h2>{$user->company_name}</h2>
        {if $get_confirm_status eq false}
        {if $user->status gt 0} 
            <h3>Company status<span>Verified</span></h3>
        {/if}
        {/if}
        {* <span class="create_btn">           *}
            {if $check_follow > 0}
                <a href="#" user-id="{$company->id}" {if $is_loggedin eq false} follow-status="0" {else} follow-status="1" {/if} class="create_btn_a">Following</a>
            {else}
                <a id="follow-button" class="create_btn_a {if $is_loggedin eq false} triggerSignup{/if}" user-id="{$company->id}" {if $is_loggedin eq false} follow-status="0" {else} follow-status="1" {/if} >Follow</a>
            {/if}
        {* </span> *}
        <hr>
        <h4>Give Rate:</h4> <br/>

        <span class="rate_only {if $company_rate >= 1} rated {else} not_rated {/if}">
            {if $is_loggedin }   
                <button type="button" class="rating_start give_rating_btn_1 {if $is_loggedin && $company_rate >= 1 } active {/if} {if $is_loggedin eq false} triggerSignup {else} give_rating_btn {/if}" {if $is_loggedin} data-id="1"  data-profile_id="{$company->id}" data-user_id="{$UserData->id}" {/if} >
                    {$normal_star}
                </button>

                <button type="button" class="rating_start give_rating_btn_2 {if $is_loggedin && $company_rate >= 2 } active {/if} {if $is_loggedin eq false} triggerSignup {else} give_rating_btn {/if}"  {if $is_loggedin}data-id="2"  data-profile_id="{$company->id}" data-user_id="{$UserData->id}" {/if} >
                    {$normal_star}
                </button>

                <button type="button" class="rating_start give_rating_btn_3 {if $is_loggedin && $company_rate >= 3 } active {/if} {if $is_loggedin eq false} triggerSignup {else} give_rating_btn {/if}"  {if $is_loggedin} data-id="3"  data-profile_id="{$company->id}" data-user_id="{$UserData->id}" {/if} >
                    {$normal_star}
                </button>

                <button type="button" class="rating_start give_rating_btn_4 {if $is_loggedin && $company_rate >= 4 } active {/if} {if $is_loggedin eq false} triggerSignup {else} give_rating_btn {/if}"  {if $is_loggedin} data-id="4"  data-profile_id="{$company->id}" data-user_id="{$UserData->id}" {/if} >
                    {$normal_star}
                </button>

                <button type="button" class="rating_start give_rating_btn_5 {if $is_loggedin && $company_rate >= 5 } active {/if} {if $is_loggedin eq false} triggerSignup {else} give_rating_btn {/if}"  {if $is_loggedin} data-id="5"  data-profile_id="{$company->id}" data-user_id="{$UserData->id}" {/if} >
                    {$normal_star}
                </button>
            {else}
                <button type="button" class="rating_start {if $company_star_rate_count >= 1 } active {/if}   triggerSignup" >
                   {$normal_star}
                </button>

                <button type="button" class="rating_start {if $company_star_rate_count >= 2 } active {/if} triggerSignup" >
                    {$normal_star}
                </button>

                <button type="button" class="rating_start {if $company_star_rate_count >= 3 } active {/if} triggerSignup" >
                    {$normal_star}
                </button>

                <button type="button" class="rating_start {if $company_star_rate_count >= 4 } active {/if} triggerSignup" >
                    {$normal_star}
                </button>

                <button type="button" class="rating_start {if $company_star_rate_count >= 5 } active {/if} triggerSignup " >
                    {$normal_star}
                </button>
            {/if}
        </span>

        <p style="color: #fff; margin-bottom: 10px;">
            {$company_rate_total} users rated
            {if $is_loggedin } 
                ( {$company_star_rate_count}/5 )
            {/if}
        </p>
        <hr>
        <h6>{$user_following}<span>Followers</span></h6>
        <hr>

    </div><!-- /.n_top_data -->


    <div class="n_navigation">
        <ul>
            <li>
                <a href="{site_url_multi('/')}companies/{$user->slug}" {if isset($active_menu) and $active_menu == 1} class="active" {/if}><img
                            src="{base_url('templates/default/assets/images/icons/comp_n.png')}"/><span>Company Information</span></a>
            </li>
            <li>
                <a href="{base_url('/')}companies/{$user->slug}/news" {if isset($active_menu) and $active_menu == 2} class="active" {/if}><img
                            src="{base_url('templates/default/assets/images/icons/news_icon.png')}"/><span>News</span></a>
            </li>
            <li>
                <a href="{site_url_multi('/')}companies/{$user->slug}/interests" {if isset($active_menu) and $active_menu == 3} class="active" {/if}><img
                            src="{base_url('templates/default/assets/images/icons/interest.png')}"/><span>Interest</span></a>
            </li>
            <li>
                <a href="{site_url_multi('/')}companies/{$user->slug}/products" {if isset($active_menu) and $active_menu == 4} class="active" {/if}><img
                            src="{base_url('templates/default/assets/images/icons/prod_n.png')}"/><span>Product</span></a>
            </li>
            <li><a href="{site_url_multi('/')}companies/{$user->slug}/tenders" {if isset($active_menu) and $active_menu == 5} class="active" {/if}><img
                            src="{base_url('templates/default/assets/images/icons/tender.png')}"/><span>Tender</span></a>
            </li>
            <li><a href="{site_url_multi('/')}companies/{$user->slug}/chats" {if isset($active_menu) and $active_menu == 6} class="active" {/if}><img
                            src="{base_url('templates/default/assets/images/icons/ms_icon.png')}"/><span>Chat</span></a>
            </li>
            <li>
                <a href="{site_url_multi('/')}companies/{$user->slug}/people" {if isset($active_menu) and $active_menu == 7} class="active" {/if}><img
                            src="{base_url('templates/default/assets/images/icons/pf_icon.png')}"/><span>Employees </span></a>
            </li>
            {*            <li><a href="#"><img src="images/icons/st_icon.png" /><span>Settings</span></a></li>*}
        </ul>

        {if $user}
            <span class="logout">
            	<a href="{base_url('/')}authentication/logout"><img
                            src="{base_url('templates/default/assets/images/icons/logout.png')}"/> <span>Logout</span></a>
            </span>
        {/if}
    </div><!-- /.n_navigation -->
    </div>
</div><!-- /.n_side_section -->


 
{literal}

<script>

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

</script>
<script>


$(document).scroll(function() {
var top_offset1 = 72;
var top_offset2 = 107;
var top_offset3 = 242;
var top_offset33 = 247;
var y = $(this).scrollTop();
var w = $(window).width();

if (w >= 768 && !$('.add-product').hasClass('in')) {
if (y > top_offset1) {
    $(".header .bottom-menu:first-child").addClass("is-fixed");
} else {
    $(".header .bottom-menu:first-child").removeClass("is-fixed");
}

 if (y > top_offset2) {
    $(".header .bottom-menu.advanced-menu").addClass("is-fixed");
} else {
    $(".header .bottom-menu.advanced-menu").removeClass("is-fixed");
}

 if ((y > top_offset33 && !$(".header .bottom-menu.advanced-menu").hasClass('is-shown')) || (y > top_offset3 && $(".header .bottom-menu.advanced-menu").hasClass('is-shown'))) {
    $('.searchTable #example thead').addClass("is-fixed");
    $('.searchTable #example tbody').css('border-top','35px solid #ddd');
   if($(".header .bottom-menu.advanced-menu").css('display') != 'none') {
     $('.searchTable #example thead').css('top','70px');
      $(".header .bottom-menu.advanced-menu").css('top','35px');
    }
} else {
    $('.searchTable #example thead').removeClass("is-fixed");
    $('.searchTable #example tbody').css('border-top','none');
    $('.searchTable #example thead').css('top','35px');
      $(".header .bottom-menu.advanced-menu").css('top','35px');
}


}
});
</script>

    {/literal}

