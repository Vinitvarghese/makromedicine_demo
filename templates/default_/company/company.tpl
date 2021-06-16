{extends file=$layout}
{block name=content}



    <link rel="stylesheet" href="{base_url('templates/default/assets/css/prefix-style.css')}" media="all">
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
                <div class="n_side_section color_change_green">
                    <div class="n_top_data">
                        <div class="n_profile_img img_fit">
                            <img src="{$company_images}" alt="img" />
                            {if $company->checked==1}
                            <a href="#" class="n_pro_tick">
                                <img src="{base_url('templates/default/assets/images/icons/tck_.png')}" />
                            </a>
                            {/if}
                        </div><!-- /.n_profile_img -->
                        {if !empty($company->company_name)}
                        <h2>{$company->company_name}</h2>
                        {/if}
                        {if !empty($company->group_name)}
                        <h3>Company status<span>{$company->group_name}</span></h3>
                        {/if}

                            <span class="rate_only {if $company_rate >= 1} rated {else} not_rated {/if} ">
                                {if $is_loggedin }   
                                    <button type="button" class="rating_start give_rating_btn_1 {if $company_rate >= 1 } active {/if}  give_rating_btn " data-id="1">
                                        {$normal_star}
                                    </button>

                                    <button type="button" class="rating_start give_rating_btn_2 {if $company_rate >= 2 } active {/if} give_rating_btn " data-id="2">
                                        {$normal_star}
                                    </button>

                                    <button type="button" class="rating_start give_rating_btn_3 {if  $company_rate >= 3 } active {/if}  give_rating_btn " data-id="3">
                                        {$normal_star}
                                    </button>

                                    <button type="button" class="rating_start give_rating_btn_4 {if  $company_rate >= 4 } active {/if} give_rating_btn " data-id="4">
                                        {$normal_star}    
                                    </button>

                                    <button type="button" class="rating_start give_rating_btn_5 {if  $company_rate >= 5 } active {/if} give_rating_btn " data-id="5">
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
                        <hr/>


                        <hr>
                        <br/>
                        <h6 data-user-id="{$company->id}">{$user_followers}<span>Followers</span></h6>
                        <h6 data-user-id="{$company->id}">{$user_following}<span>Following</span></h6>
                        <hr>

                    </div><!-- /.n_top_data -->



                    <div class="n_navigation">

                        <ul>
                            <li><a href="{base_url()}/company/{$company->slug}" class="active"><img src="{base_url('templates/default/assets/images/icons/comp_n.png')}" /><span>Company Information</span></a></li>
                            <li>
                                <a href="{site_url_multi('/')}companies/{$company->slug}/products" {if isset($active_menu) and $active_menu == 4} class="active" {/if}><img
                                            src="{base_url('templates/default/assets/images/icons/prod_n.png')}"/><span>Product</span></a>
                            </li>
                        </ul>

                        {if $is_loggedin neq false}
                            <span class="create_btn">
                                <a href="#" onclick="window.location='{base_url('messages/')}{$company->id}'">Write message</a>
                            </span>
                        {/if}
                        {if $check_follow > 0}
                            <span class="create_btn">
                                <a href="#" id="follow-button" user-id="{$company->id}" {if $is_loggedin eq false} follow-status="0" {else} follow-status="1" {/if}>Following</a>
                            </span>
                        {else}
                            <span class="create_btn">
                                <a href="#"  id="follow-button" class=" {if $is_loggedin eq false} triggerSignup{/if}" user-id="{$company->id}" {if $is_loggedin eq false} follow-status="0" {else} follow-status="1" {/if}>+ Follow</a>
                            </span>
                        {/if}
                        <!-- /.create_btn -->
                        {if $is_loggedin }
                            <span class="logout">
                                <a href="{base_url('/')}authentication/logout">
                                    <img src="{base_url('templates/default/assets/images/icons/logout.png')}" /> <span>Logout</span>
                                </a>
                            </span>
                        {/if}



                    </div><!-- /.n_navigation -->
                </div><!-- /.n_side_section -->
                <div class="n_right_section decrease_padding_20 start_with_text">
                    <div class="with_buttons full_width">
                        {*<h2>INTEREST</h2>*}
                        <!--<a href="#" class="n_green_col">Add Products</a>-->
                    </div>
                    {if !empty($company->company_banner)}
                    <div class="banner_image_n img_fit full_width">

                        <img src="{$company->company_banner}" alt="img" height="313" />
                    </div><!-- /.banner_image_n -->
                    {/if}

                    <div class="full_width need_padding_here">
                        <div class="cmother full_width pr-s-n">
                            <h2>COMPANY INFORMATION</h2>
                            {*<a href="#" class="write_message_n">Write Message</a>*}
                        </div>

                        <div class="full_width max-arrange">
                            <div class="drt_form full_width">
                                <div class="full_width">
                                    {if !empty($company->company_name)}
                                    <div class="fst_col">
                                        <label>Company Name <span>{$company->company_name}</span></label>
                                    </div><!-- /.fst_col -->
                                    {/if}

                                    {if !empty($company->establishment_date)}
                                    <div class="snd_col">
                                        <label>Establishment date <span>{$company->establishment_date}</span></label>
                                    </div><!-- /.snd_col -->
                                    {/if}

                                </div><!-- /.full_width -->
                                <div class="full_width">
                                    {if !empty($company->group_name)}
                                    <div class="fst_col">
                                        <label>Field of activity <span>{$company->group_name}</span></label>
                                    </div><!-- /.fst_col -->
                                    {/if}

                                    {if !empty($company->website)}
                                    <div class="snd_col">
                                        <label>Website <span>{$company->website}</span></label>
                                    </div><!-- /.snd_col -->
                                    {/if}


                                </div><!-- /.full_width -->

                                <div class="full_width">

                                    {if !empty($company->standart)}
                                    <div class="fst_col">
                                        <label>Standard <span>{$company->standart}</span></label>
                                    </div><!-- /.fst_col -->
                                    {/if}

                                </div><!-- /.full_width -->


                            </div><!-- /.drt_form -->

                            <div class="n_personal_info full_width">
                                <h3>ABOUT COMPANY</h3>
                                <p>{$company->company_info}</p>

                                {if !empty($company->tags)}
                                <div class="tags_nn full_width">
                                    <a href="javascript:void(0)">{$company->tags}</a>
                                </div><!-- /.tags_nn -->
                                {/if}

                            </div><!-- /.personal_info -->



                            <div class="n_contact_info full_width">
                                <h3>CONTACT INFO</h3>

                                <div class="drt_form full_width">
                                    <div class="full_width">
                                        {if !empty($company->phone)}
                                        <div class="fst_col">
                                            <label>Phone Number <span>{$company->phone}</span> </label>
                                        </div><!-- /.fst_col -->
                                        {/if}

                                        {if !empty($company->fullname)}
                                            <div class="snd_col">
                                                <label>Contact Person Name <span class="get_underline">{$company->fullname}</span></label>
                                            </div><!-- /.snd_col -->
                                        {/if}


                                    </div><!-- /.full_width -->

                                    <div class="full_width">

                                        <div class="snd_col">


                                            {if $person_type}
                                                <label>Person Type
                                                    {foreach $person_type as $key => $value}
                                                        {if $value->id == $company->position } <span class="get_underline">{$value->name}</span> {break} {/if}
                                                    {/foreach}
                                                </label>
                                            {/if}

                                        </div><!-- /.snd_col -->

                                    </div><!-- /.full_width -->

                                    <div class="full_width">

                                        {if $company->country_id > 0}
                                        <div class="fst_col">
                                            <label>City, Country <span>{get_country_name($company->country_id)}</span></label>
                                        </div><!-- /.fst_col -->
                                        {/if}

                                        {if !empty($company->email) and $is_loggedin}
                                        <div class="snd_col">
                                            <label>E-mail <span>{$company->email}</span></label>
                                        </div><!-- /.snd_col -->
                                        {/if}
                                    </div><!-- /.full_width -->

                                    <div class="full_width">
                                        {if !empty($company->company_address)}
                                        <div class="fst_col">
                                            <label>Address <span>{$company->company_address}</span></label>

                                            {if !empty($company->company_lat) && !empty($company->company_lng)}
                                                <div class="map__">
                                                    <iframe width="265" height="265"  src="https://maps.google.com/maps?q={$company->company_address}&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>

                                                </div>
                                            {/if}
                                        </div><!-- /.fst_col -->
                                        {/if}

                                        {if $is_loggedin}
                                            <div class="snd_col al_blk">
                                                <hr class="thrx">
                                                {if !empty($company->fullname)}
                                                    <label>Contact Person Name <span>{$company->fullname}</span></label>
                                                {/if}

                                                {if $person_type}
                                                    <label>Person Type
                                                    {foreach $person_type as $key => $value}
                                                        {if $value->id == $company->position } <span class="get_underline">{$value->name}</span> {break} {/if}
                                                    {/foreach}
                                                    </label>
                                                {/if}

                                                {if !empty($company->email)}
                                                    <label>E-mail <span>{$company->email}</span></label>
                                                {/if}
                                            </div><!-- /.snd_col -->
                                        {/if}

                                    </div><!-- /.full_width -->

                                    <div class="n_social_block full_width">

                                        {if !empty($company->company_facebook)}
                                            <a href="{$company->company_facebook}" target="_blank"><img src="{base_url('templates/default/assets/images/icons/n_face.png')}" alt="facebook"></a>
                                        {/if}

                                        {if  !empty($company->company_twitter)}
                                            <a href="{$company->company_twitter}" target="_blank"><img src="{base_url('templates/default/assets/images/icons/n_twit.png')}" alt="twitter"></a>
                                        {/if}

                                        {if  !empty($company->company_youtube)}
                                            <a href="{$company->company_youtube}" target="_blank"><img src="{base_url('templates/default/assets/images/icons/n_tube.png')}" alt="youtube"></a>
                                        {/if}

                                        {if  !empty($company->company_linkedin)}
                                            <a href="{$company->company_linkedin}" target="_blank"><img src="{base_url('templates/default/assets/images/icons/n_in.png')}" alt="linkedin"></a>
                                        {/if}

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

    {if $is_loggedin }
        <script>
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
                       data : { profile_id : {$company->id}, user_id : {$user['id']}, rate : id, action : action },
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
        </script>
    {/if}

{/block}