{extends file=$layout}
{block name=content}
    <link rel="stylesheet" href="{base_url('templates/default/assets/css/prefix-style.css')}" media="all">
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
                            <div class="ad_pro_n add_enp_btn">
                                <a href="#">Add Employee</a>
                            </div>
                        </div>
                        <p class="page_quantity">Quantity : 57</p>
                    </div>
                    <div class="full_width employes_page">
                        <div class="row">

                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 for_small img_fit text-center">
                                <img src="{$admin_data.photo}" alt="img">
                                <h5 class="people_name people_name2 full_width">{$admin_data.name}</h5>
                                <span class="people_position_name people_position_name2">{$admin_data.position}</span>

                            </div>


                            {if $approved_users|@count gt 0}
                                {foreach $approved_users as $approved_user}
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 for_small img_fit text-center people_box">
                                        <img src="{$approved_user.photo}" alt="img">
                                        <h5 class="people_name people_name2 full_width">{$approved_user.name}</h5>
                                        <span class="people_position_name people_position_name2">{$approved_user.position}</span>

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

                                                <a href="javascript:" class="done_ edit_people_group_done">
                                                    <img src="{base_url('templates/default/assets/images/icons/check_white.png')}">
                                                    <span>done</span>
                                                </a>
                                            {/if}

                                            {if $permission_list[7]->delete == 1}
                                                <a href="{site_url_multi('/')}pages/{$UserData->slug}/people/approve/{$approved_user.rel_main_id}/2" class="delete_people_btn" data-name="{$approved_user.name}" data-image="{$approved_user.photo}">
                                                    <img src="{base_url('templates/default/assets/images/icons/del_n.png')}" alt="delete">
                                                </a>
                                            {/if}
                                        </div>

                                    </div>
                                {/foreach}
                            {/if}

                        </div>
                    </div>
                    {if $approval_waiting_users|@count gt 0}
                        <div class="with_buttons full_width">
                            <h2>Approval Waiting</h2>
                        </div>
                        <div class="full_width news_tiles">
                            <div class="row">

                                {foreach $approval_waiting_users as $waiting_user}

                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 for_small img_fit text-center">
                                        <img src="{$waiting_user.photo}" alt="img">
                                        <h5 class="people_name people_name2 full_width">{$waiting_user.name}</h5>

                                        <span class="people_position_name">{$waiting_user.position}</span>

                                        <div class="buttons_lab full_width">
                                            <a href="{site_url_multi('/')}pages/{$UserData->slug}/people/approve/{$waiting_user.rel_main_id}/1" class="done_">
                                                <img src="{base_url('templates/default/assets/images/icons/check_white.png')}"> <span>approve</span>
                                            </a>

                                            <a href="{site_url_multi('/')}pages/{$UserData->slug}/people/approve/{$waiting_user.rel_main_id}/2" class="delete_people_btn"  data-name="{$waiting_user.name}" data-image="{$waiting_user.photo}">
                                                <img src="{base_url('templates/default/assets/images/icons/del_n.png')}" alt="delete">
                                            </a>
                                        </div>
                                    </div>
                                {/foreach}

                            </div>
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
