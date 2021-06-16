<div class="n_side_section color_change_green">
<div class="userSettings">
    <div class="n_top_data">
        <a href="#" id="menu_hide">Hide</a>

        <div class="n_profile_img img_fit">
            <img src="{$UserData->company_logo}"/>

            {if isset($get_confirm_status) && !empty($get_confirm_status)}
                {if $get_confirm_status->status == 1}
                    <a href="#" class="n_pro_tick"><img
                                src="{base_url('templates/default/assets/images/icons/tck_.png')}"/></a>
                {/if}
            {/if}


            {if $is_loggedin && $logged_user_id!=$UserData->admin_id}
                <button type="button" class="open_close_block_menu_btn"></button>
                <ul class="flex direction_column open_close_block_menu_list">
                    <li><a href="#" class="block_user_or_company_btn" data-id="{$UserData->company_id}" data-image="{$UserData->company_logo}" data-name="{$UserData->company_name}" data-type="company">Block profile</a> </li>
                    <li><a href="#" class="complain_user_or_company_btn" data-id="{$UserData->company_id}" data-image="{$UserData->company_logo}" data-name="{$UserData->company_name}" data-type="company">Report profile</a> </li>
                </ul>
            {/if}

        </div>
        <!-- /.n_profile_img -->
        <h2>{$UserData->company_name}</h2>

        <h3>Company status</h3>
        {foreach $groups as $k => $v}
            {if  $UserData->user_groups_id==$v->id}<p class="company_status_txt">{$v->name}</p>{/if}
        {/foreach}





        {if $is_loggedin && $logged_user_id!=$UserData->admin_id }
            {if $check_follow > 0}
                <a id="follow-button" data-id="{$company->id}"  class="create_btn_a">Following</a>
            {else}
                <a id="follow-button" class="create_btn_a {if $is_loggedin eq false} triggerSignup{/if}" data-id="{$company->id}" >+ Follow</a>
            {/if}
        {/if}

        <br/>
        <hr>
        <br/>

        {$check_rate=($logged_user_id==$UserData->admin_id) ? $company_star_rate_count :  $company_rate}


        <div class="rate_only {if $check_rate >= 1} rated {else} not_rated {/if}">

            <button type="button" class="rating_start  give_rating_btn_1 {if $check_rate >= 1 } active {/if} {if $logged_user_id!=$UserData->admin_id} give_rating_btn {/if}" {if $is_loggedin} data-id="1"  data-profile_id="{$UserData->company_id}" data-user_id="{$logged_user_id}" {/if} >
                <svg  role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" ><path fill="currentColor" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z" class=""></path></svg>
            </button>

            <button type="button" class="rating_start give_rating_btn_2 {if $check_rate >= 2 } active {/if} {if $logged_user_id!=$UserData->admin_id } give_rating_btn {/if}"  {if $is_loggedin}data-id="2"  data-profile_id="{$UserData->company_id}" data-user_id="{$logged_user_id}" {/if} >
                <svg  role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" ><path fill="currentColor" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z" class=""></path></svg>
            </button>

            <button type="button" class="rating_start give_rating_btn_3 {if $check_rate >= 3 } active {/if} {if $logged_user_id!=$UserData->admin_id } give_rating_btn {/if}"  {if $is_loggedin} data-id="3"  data-profile_id="{$UserData->company_id}" data-user_id="{$logged_user_id}" {/if} >
                <svg  role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" ><path fill="currentColor" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z" class=""></path></svg>
            </button>

            <button type="button" class="rating_start give_rating_btn_4 {if $check_rate >= 4 } active {/if} {if $logged_user_id!=$UserData->admin_id} give_rating_btn {/if}"  {if $is_loggedin} data-id="4"  data-profile_id="{$UserData->company_id}" data-user_id="{$logged_user_id}" {/if} >
                <svg  role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" ><path fill="currentColor" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z" class=""></path></svg>
            </button>

            <button type="button" class="rating_start give_rating_btn_5 {if $check_rate >= 5 } active {/if} {if $logged_user_id!=$UserData->admin_id } give_rating_btn {/if}"  {if $is_loggedin} data-id="5"  data-profile_id="{$UserData->company_id}" data-user_id="{$logged_user_id}" {/if} >
                <svg  role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" ><path fill="currentColor" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z" class=""></path></svg>
            </button>

        </div>


        <hr>

    </div><!-- /.n_top_data -->


    <div class="n_navigation">
        <ul>
            <li>
                <a href="{site_url_multi('/')}companies/{$company->slug}" {if isset($active_menu) and $active_menu == 1} class="active" {/if}><img
                            src="{base_url('templates/default/assets/images/icons/comp_n.png')}"/><span>Company Information</span></a>
            </li>
            <li>
                <a href="{site_url_multi('/')}companies/{$company->slug}/news" {if isset($active_menu) and $active_menu == 2} class="active" {/if}><img
                            src="{base_url('templates/default/assets/images/icons/news_icon.png')}"/><span>News</span></a>
            </li>
            <li>
                <a href="{site_url_multi('/')}companies/{$company->slug}/interests" {if isset($active_menu) and $active_menu == 3} class="active" {/if}><img
                            src="{base_url('templates/default/assets/images/icons/interest.png')}"/><span>Interest</span></a>
            </li>
            <li>
                <a href="{site_url_multi('/')}companies/{$company->slug}/products" {if isset($active_menu) and $active_menu == 4} class="active" {/if}><img
                            src="{base_url('templates/default/assets/images/icons/prod_n.png')}"/><span>Product</span></a>
            </li>
            <li><a href="{site_url_multi('/')}companies/{$company->slug}/tenders" {if isset($active_menu) and $active_menu == 5} class="active" {/if}><img
                            src="{base_url('templates/default/assets/images/icons/tender.png')}"/><span>Tender</span></a>
            </li>
            <li><a href="{site_url_multi('/')}companies/{$company->slug}/chats" {if isset($active_menu) and $active_menu == 6} class="active" {/if}><img
                            src="{base_url('templates/default/assets/images/icons/ms_icon.png')}"/><span>Chat</span></a>
            </li>
            <li>
                <a href="{site_url_multi('/')}companies/{$company->slug}/people" {if isset($active_menu) and $active_menu == 7} class="active" {/if}><img
                            src="{base_url('templates/default/assets/images/icons/pf_icon.png')}"/><span>Employees </span></a>
            </li>
            {*            <li><a href="#"><img src="images/icons/st_icon.png" /><span>Settings</span></a></li>*}
        </ul>


    </div><!-- /.n_navigation -->
    </div>

    <button type="button" class="go_up"></button>
</div><!-- /.n_side_section -->

{if $is_loggedin && $logged_user_id!=$UserData->admin_id}
    <script>
        $(document).ready(function () {
            $("#follow-button").click(function(){
                var bu=$(this),
                    company_id=bu.data('id');

                if ($("#follow-button").text() == "+ Follow"){
                    $.ajax({
                        type:'POST',
                        url:site_url+'follow/follow/',
                        data: { 'follow' : true, 'company_id' :  company_id},
                        cache:true,
                        success:function(data){
                            $("#follow-button").text("Following");
                            toastr.success('Follow successful !');

                        }
                    });
                }else{
                    $.ajax({
                        type:'POST',
                        url:site_url+'follow/unfollow/',
                        data: { unfollow : true, 'company_id' :  company_id},
                        cache:true,
                        success:function(data){
                            $("#follow-button").text("+ Follow");
                            toastr.warning('Unfollow successful !');

                        }
                    });

                }
            });

            /**/
            $('.give_rating_btn').click(function () {
                var bu=$(this),
                    id=bu.data('id'),
                    profile_id=bu.data('profile_id'),
                    user_id=bu.data('user_id'),
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
                        data : { profile_id : profile_id, user_id : user_id, rate : id, action : action },
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

        });
    </script>
{/if}


