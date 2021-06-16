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
                <div class="n_right_section start_with_text employee_l">
                    <div class="with_buttons full_width">
                        <div class="flex align_center">
                            <h2>employees</h2>
                            {if $permission_list[7]->add == 1}
                                <div class="ad_pro_n add_enp_btn">
                                    <a href="{site_url_multi('/')}pages/{$UserData->slug}/people_add">Add Employee</a>
                                </div>
                            {/if}

                        </div>
                        <p class="page_quantity">Quantity : {count($approved_users) + 1}</p>
                    </div>
                    <div class="full_width employes_page">
                        <div class="row">

                            <div class="full_width">
                                <ul class="full_width flex flex_wrap user_list column_4 approved_employee_list">

                                <li>
                                    <a href="{site_url_multi('/')}users/{$admin_data.slug_user}"  class="full_width flex user_list_top">
                                        <img src="{$admin_data.photo}" class="full_width " />
                                    </a>

                                    <a href="{site_url_multi('/')}users/{$admin_data.slug_user}" class="full_width flex direction_column user_list_middle user_list_middle_100 user_list_middle_nob">
                                        <h4>{$admin_data.name}</h4>
                                        <p>{$admin_data.role_name}</p>
                                        <p>{$admin_data.position}</p>
                                    </a>

                                </li>


                            {if $approved_users|@count gt 0}

                                    {foreach $approved_users as $approved_user}
                                        <li>
                                            <a href="{site_url_multi('/')}users/{$approved_user.slug_user}" target="_blank"  class="full_width flex user_list_top">
                                                <img src="{$approved_user.photo}" class="full_width " />
                                            </a>

                                            <a href="{site_url_multi('/')}users/{$approved_user.slug_user}" target="_blank" class="full_width flex direction_column user_list_middle user_list_middle_100 user_list_middle_nob">
                                                <h4>{$approved_user.name}</h4>
                                                {* <p>{$approved_user.position}</p> *}
                                            </a>


                                            {if $permission_list[7]->edit == 1}
                                                <select class="gray_anch peop_group group_id" name="group_id" disabled data-id="{$approved_user.rel_main_id}" data-to-user="{$approved_user.id}" data-page-name="{$UserData->company_name}">
                                                    {foreach $user_groups as $group}
                                                        <option value="{$group.id}" {($approved_user.user_page_role_id==$group.id) ? 'selected' : ''} >{$group.name}</option>
                                                    {/foreach}
                                                </select>
                                            {/if}


                                            <div class="buttons_lab full_width">
                                                {if $permission_list[7]->edit == 1}
                                                    <a href="javascript:" class="done_ edit_people_group">
                                                        <img src="{base_url('templates/default/assets/images/icons/edit_icon_white.svg')}">
                                                    </a>

                                                    <a href="javascript:" class="done_ refuse_people_group">
                                                        <span>refuse</span>
                                                    </a>

                                                    <a href="javascript:" class="done_ edit_people_group_done" data-company_id="{$UserData->company_id}">
                                                        <span>confirm</span>
                                                    </a>
                                                {/if}

                                                {if $permission_list[7]->delete == 1}
                                                    <a href="{site_url_multi('/')}pages/{$UserData->slug}/people/approve/{$approved_user.rel_main_id}/2" class="done_ delete_people_btn" data-name="{$approved_user.name}" data-image="{$approved_user.photo}">
                                                        <img src="{base_url('templates/default/assets/css/icons/trash_icon.svg')}" alt="delete">
                                                    </a>
                                                {/if}
                                            </div>

                                        </li>
                                    {/foreach}

                            {/if}

                                </ul>
                            </div>

                        </div>
                    </div>

                    {if $approval_waiting_users|@count gt 0}
                        <div class="with_buttons flex direction_column full_width awaiting_box">
                            <h2>Awaiting reply</h2>
                            <p class="page_quantity">Quantity : {count($approval_waiting_users)}</p>
                        </div>

                        <div class="full_width">
                            <ul
                                class="full_width flex flex_wrap user_list column_4 awaiting_employee_list add_new_employee_list_h_select">

                                {foreach $approval_waiting_users as $waiting_user}

                                    <li>
                                        <a href="{site_url_multi('/')}users/{$waiting_user.slug_user}" target="_blank"
                                            class="full_width flex user_list_top">
                                            <img src="{$waiting_user.photo}" class="full_width " />
                                        </a>

                                        <a href="{site_url_multi('/')}users/{$waiting_user.slug_user}" target="_blank"
                                            class="full_width flex direction_column user_list_middle user_list_middle_aw">
                                            <h4>{$waiting_user.name}</h4>
                                            <p>{$waiting_user.country_name}</p>
                                            <p class="disabled_position position_id">{$waiting_user.position}</p>
                                        </a>

                                        <div class="buttons_lab full_width">
                                            <a href="{site_url_multi('/')}pages/{$UserData->slug}/people/approve/{$waiting_user.rel_main_id}/1"
                                                class="done_">
                                                <img src="{base_url('templates/default/assets/images/icons/check_white.png')}">
                                                <span>approve</span>
                                            </a>

                                            <a href="{site_url_multi('/')}pages/{$UserData->slug}/people/approve/{$waiting_user.rel_main_id}/2"
                                                class="done_ delete_people_btn" data-name="{$waiting_user.name}"
                                                data-image="{$waiting_user.photo}">
                                                <img src="{base_url('templates/default/assets/css/icons/trash_icon.svg')}"
                                                    alt="delete">
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
