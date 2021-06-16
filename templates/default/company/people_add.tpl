{extends file=$layout}
{block name=content}
    <link rel="stylesheet" href="{base_url('templates/default/assets/css/prefix-style.css')}" media="all">
    {include file='../_partial/approve_waiting_line.tpl'}
    <div class="n_content_area full_width">
        <a href="#" id="openMenu" class="pages-menu-float">Menu</a>
        <div class="container-fluid">
            <div class="row">
                {include file='../company/sidebar.tpl'}
                {* <div class="n_right_section start_with_text news_page"> *}
                <div class="n_right_section start_with_text employee_l employee_l2">

                    <div class=" full_width direction_column">
                        <div class="flex align_center ">
                            <h2>Employee Adding</h2>
                        </div>

                        <div class="full_width flex add_new_employee_s">
                            <div class=" ">
                                <h2>Find Employee :</h2>
                                <p class="page_quantity hidden" >result : <span class="blocked_user_count">0</span></p>
                            </div><!-- /.with_buttons -->

                            <form class="" onsubmit="return false;">
                                <div class="full_width flex new_search_box new_search_box2 align_center ">
                                    <button type="submit" class="new_search_user_btn"></button>
                                    <input type="text" name="" placeholder="Write Name…" class="new_search_user_input search_new_employee" />
                                </div>
                            </form>
                        </div>

                    </div>

                    <div class="full_width">
                        <ul class="full_width flex flex_wrap user_list add_new_employee_list">

                        </ul>
                    </div>

                    {if $approval_waiting_users|@count gt 0}
                        <div class="with_buttons flex direction_column full_width awaiting_box">
                            <h2>Awaiting reply</h2>
                            <p class="page_quantity">Quantity : {count($approval_waiting_users)}</p>
                        </div>

                        <div class="full_width">
                            <ul class="full_width flex flex_wrap user_list column_4 awaiting_employee_list add_new_employee_list_h_select">

                                {foreach $approval_waiting_users as $waiting_user}

                                    <li>
                                        <a href="{site_url_multi('/')}users/{$waiting_user.slug_user}" target="_blank" class="full_width flex user_list_top">
                                            <img src="{$waiting_user.photo}" class="full_width " />
                                        </a>

                                        <a href="{site_url_multi('/')}users/{$waiting_user.slug_user}" target="_blank" class="full_width flex direction_column user_list_middle user_list_middle_aw">
                                            <h4>{$waiting_user.name}</h4>
                                            <p>{$waiting_user.country_name}</p>
                                            <p class="disabled_position position_id">{$waiting_user.position}</p>
                                        </a>

                                        <div class="buttons_lab full_width">
                                            <a href="{site_url_multi('/')}pages/{$UserData->slug}/people/approve/{$waiting_user.rel_main_id}/1" class="done_">
                                                <img src="{base_url('templates/default/assets/images/icons/check_white.png')}"> <span>approve</span>
                                            </a>

                                            <a href="{site_url_multi('/')}pages/{$UserData->slug}/people/approve/{$waiting_user.rel_main_id}/2" class="done_ delete_people_btn"  data-name="{$waiting_user.name}" data-image="{$waiting_user.photo}">
                                                <img src="{base_url('templates/default/assets/css/icons/trash_icon.svg')}" alt="delete">
                                            </a>
                                        </div>
                                    </li>
                                {/foreach}

                            </ul>
                        </div>


                    {/if}
                </div><!-- /.right_section -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->

    </div>
    <!-- /.n_content_area -->



    <div id="people_modal" class="modal fade " role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content people_modal">
                <div class="modal-header" style="background: none;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><img src="{base_url('templates/default/assets/images/icons/close_n.png')}"/></span></button>
                </div>
                <div class="modal-body">

                    <div class=" for_small img_fit ">
                        <img id="modal_img" src="" alt="img">
                    </div>

                    <h3 id="modal_title"></h3>
                    <p></p>
                    <div class="mod_center_inp_textarea">
                        <button type="button" class="close close_modal_btn" data-dismiss="modal" aria-label="Close" >No</button>
                        <a href="" id="modal_yes_btn" class="yes_modal_btn">Yes</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var ajax_req;

        $(document).ready(function () {

            $(".search_new_employee").keyup(function (e) {
                var value=$(this).val().trim();

                $('.add_new_employee_list').html('');
                $('.page_quantity').addClass('hidden');

                if (value.length >= 3){


                    if (ajax_req){
                        ajax_req.abort();
                    }

                    ajax_req=$.ajax({
                        url :  redirect_url+'pages/{$UserData->slug}/search_employee',
                        type : 'POST',
                        data : { search_employee : true, name : value},
                        dataType : 'json',
                        cache : false,
                        success : function (res) {
                            if (res.data && res.data.length > 0){
                                var li_counter=0,
                                    li='';

                                for(item of res.data){

                                    li +='<li>' +
                                        '<a href="'+item.user_slug+'" target="_blank" class="full_width flex user_list_top">' +
                                        '<img src="'+item.user_image+'" class="full_width " />' +
                                        '</a>' +
                                        ' <a href="'+item.user_slug+'" target="_blank" class="full_width flex direction_column user_list_middle">' +
                                        '<h4>'+item.fullname+'</h4>' +
                                        '<p>'+item.country_name+'</p>'+
                                        '</a>' +
                                        '<select class="position_id ">';
                                            for(option of res.position_list){
                                                li +='<option value="'+option.id+'">'+option.name+'</option>';
                                            }
                                    li +='</select>' +
                                        '<button type="button" class="block_unblock_user_btn send_request_to_employee" data-id="'+item.id+'">Send Request</button>' +
                                        '</li>';

                                    li_counter++;
                                }

                                $('.add_new_employee_list').html(li);

                                $('.blocked_user_count').text(li_counter);
                                $('.page_quantity').removeClass('hidden');

                            }
                        }
                    });

                }else{

                }
            });

            

        });

        {if !empty($UserData->lat) || !empty($UserData->lng)}
        var json_lat = {$UserData->lat};
        var json_lng = {$UserData->lng};
        var json_title = '{$UserData->adress}';
        {literal}
        {/literal}
        {else}
        var json_title = '{$UserData->company_name}';
        {literal}
        {/literal}
        {/if}
    </script>
{/block}
