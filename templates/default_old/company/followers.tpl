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
                        <h2>Followers</h2>
                        <p class="page_quantity">Quantity : 57</p>
                    </div>
                    <div class="full_width employes_page">
                        <div class="row">

                            <div class="col-md-12">
                                <form class="search_user_form flex">
                                    <button type="submit" class="search_user_btn">
                                        <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M0 5.5C0 2.46738 2.46738 0 5.5 0C8.53279 0 11 2.46738 11 5.5C11 8.53279 8.53279 11 5.5 11C2.46738 11 0 8.53279 0 5.5ZM1.01539 5.50002C1.01539 7.97282 3.0272 9.98464 5.5 9.98464C7.9728 9.98464 9.98462 7.9728 9.98462 5.5C9.98462 3.0272 7.9728 1.01539 5.5 1.01539C3.0272 1.01539 1.01539 3.02723 1.01539 5.50002Z" fill="#2187C5"/>
                                            <path d="M12.8484 12.1171L9.88294 9.15155C9.68087 8.94948 9.35362 8.94948 9.15155 9.15155C8.94948 9.35345 8.94948 9.68104 9.15155 9.88294L12.1171 12.8485C12.2181 12.9495 12.3503 13 12.4828 13C12.615 13 12.7474 12.9495 12.8484 12.8485C13.0505 12.6466 13.0505 12.319 12.8484 12.1171Z" fill="#2187C5"/>
                                        </svg>

                                    </button>
                                    <input type="text" class="search_user_input" placeholder="Write Name…">
                                </form>
                            </div>



                            {if isset($approved_users) && $approved_users|@count gt 0}
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


                </div><!-- /.right_section -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->

    </div>
    <!-- /.n_content_area -->





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
