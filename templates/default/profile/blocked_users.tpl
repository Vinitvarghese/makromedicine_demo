{extends file=$layout}
{block name=content}
    <link rel="stylesheet" href="{base_url('templates/default/assets/css/prefix-style.css')}" media="all">
    <div class="n_content_area full_width">
        <a href="#" id="openMenu" class="accounts-menu-float">Menu</a>

        <div class="container-fluid">




            <div class="row">
                {include file='../profile/sidebar.tpl'}
                <div class="n_right_section start_with_text">

                    <div class="full_width flex justify_between align_center all_news_list_top">

                        <div class="flex align_center">
                            <h2>Blocked list</h2>
                            <ul class="flex all_news_list_tabs">
                                <li><a href="{site_url_multi('/')}profile/blocked_users?type=2" class=" {if $check_type==2} active {/if} ">Companies</a> </li>
                                    <li><a href="{site_url_multi('/')}profile/blocked_users?type=1"
                                            class=" {if $check_type==1} active {/if} ">Users</a> </li>
                                    </ul>
                        </div>

                        <span class="blocked_user_count">{count($blocked_users)} {if $check_type==1} Users {else} Companies {/if}</span>

                    </div>


                    <form class="full_width" onsubmit="return false;">
                        <div class="full_width flex new_search_box align_center ">
                            <button type="submit" class="new_search_user_btn"></button>
                            <input type="text" name="" placeholder="Write Name…" class="new_search_user_input search_blocked_user" />
                        </div>
                    </form>

                    <ul class="full_width flex flex_wrap user_list blocked_user_list">
                        {if !empty($blocked_users)}
                            {foreach $blocked_users as $k => $v}
                                <li class="blocked_user_{$v->id}">
                                    <a href="{$v->user_slug}" target="_blank" class="full_width flex user_list_top">
                                        <img src="{$v->user_image}" class="full_width " />
                                    </a>

                                    <a href="{$v->user_slug}" target="_blank" class="full_width flex direction_column user_list_middle">
                                        <h4>{$v->fullname}</h4>
                                        <p>{$v->position_name}</p>
                                    </a>

                                    <a href="{$v->company_slug}"  class="full_width flex justify_center user_list_bottom">
                                        <p>{$v->company_name}</p>
                                    </a>

                                    <button type="button" class="block_unblock_user_btn un_block_user" data-id="{$v->id}">Unblock</button>
                                </li>
                            {/foreach}
                        {/if}

                    </ul>

                </div><!-- /.n_right_section -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->

    </div>
    <!-- /.n_content_area -->


    <script type="text/javascript">
        var ajax_req;

        $(document).ready(function () {
            var fore = 1;

            $(document).on('click', '.add-button-photos', function(e) {
                e.preventDefault();
                fore = fore +1;
                comp = `<div class="img-upload-group add bitrix" var-attr="lab_`+fore+`">
                        <div class="reload-form-upload">
                            <label>
                                <input type="file" name="files[]" class="userfile" accept="image/gif, image/jpg, image/png, image/jpeg" required />
                                <button type="button" class="mini-upload upload-button" data-id="" data-target="">UPLOAD</button>
                            </label>
                        </div>
                    </div>`;

                $(comp).insertBefore('.add_more_img');

                e.preventDefault();
                return false;
            });

            $(document).on("click", ".un_block_user", function (e) {

                if (!e.handle){
                    e.handle=true;

                    if (confirm("Are you sure?")){
                        var bu=$(this),
                            id=bu.data("id"),
                            li=bu.parents("li");

                        $.ajax({
                            url :  redirect_url+'profile/blocked_users',
                            type : 'POST',
                            data : { id  : id, unblock_user : true},
                            dataType : 'json',
                            cache : false,
                            success : function (res) {
                                if (res.type=="success"){
                                    li.remove();

                                    $('.blocked_user_count').text($('.user_list li').length);

                                    toastr.success(res.message);
                                }else{
                                    toastr.error(res.message);
                                }
                            }
                        });
                    }
                }

            });

            $(".search_blocked_user").keyup(function (e) {
                var value=$(this).val().trim();

                if (value.length >= 3){
                    $('.blocked_user_list li').hide();

                    if (ajax_req){
                        ajax_req.abort();
                    }

                    ajax_req=$.ajax({
                        url :  redirect_url+'profile/blocked_users',
                        type : 'POST',
                        data : { search_user : value, type : {$check_type}},
                        dataType : 'json',
                        cache : false,
                        success : function (res) {
                            if (res.data && res.data.length > 0){
                                var li_counter=0;
                                for(item of res.data){
                                    $('.blocked_user_list li.blocked_user_'+item.id).show();

                                    li_counter++;
                                }

                                $('.blocked_user_count').text(li_counter);

                            }else{
                                $('.blocked_user_count').text(0);
                            }
                        }
                    });

                }else{
                    $('.blocked_user_list li').show();
                    $('.blocked_user_count').text($('.user_list li').length);
                }
            });

        });
    </script>
{/block}
