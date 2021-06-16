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
                        <h2>employees</h2>
                    </div>
                    <div class="full_width employes_page">
                        <div class="row">

                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 for_small img_fit text-center">
                                <img src="{$owner.photo}" alt="img">
                                <h5>{$owner.name}</h5>
                                <span class="gray_anch">{$owner.position}</span>
                            </div>


                            {if $approved_users|@count gt 0}
                                {foreach $approved_users as $approved_user}
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 for_small img_fit text-center">
                                        <img src="{$approved_user.photo}" alt="img">
                                        <h5>{$approved_user.name}</h5>
                                        <span class="gray_anch">{$approved_user.position}</span>
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
                                        <h5>{$waiting_user.name}</h5>
                                        <span class="gray_anch">{$waiting_user.position}</span>
                                        <div class="buttons_lab full_width">
                                            <a href="{site_url_multi('/')}pages/{$UserData->slug}/people/approve/{$waiting_user.id}/1" class="done_">
                                            <img src="{base_url('templates/default/assets/images/icons/Path.png')}"> <span>done</span></a>
                                            <a href="{site_url_multi('/')}pages/{$UserData->slug}/people/approve/{$waiting_user.id}/2">
                                            <img src="{base_url('templates/default/assets/images/icons/del_n.png')}" alt="delete"></a>
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
