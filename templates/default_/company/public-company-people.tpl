{extends file=$layout}
{block name=content}
<link rel="stylesheet" href="{base_url('templates/default/assets/css/prefix-style.css')}" media="all">
<div class="n_content_area full_width">
<a href="#" id="openMenu" class="public-menu-float">Menu</a>

    <div class="container-fluid">
        <div class="row">
            {include file='../company/public-company-sidebar.tpl'}
            <div class="n_right_section start_with_text employee_l">
                <div class="with_buttons full_width">
                    <h2>EMPLOYEES</h2>
                    <!--<a href="#" class="n_green_col">Add Products</a>-->
                </div>

                <div class="full_width employes_page">
                <div class="row">
                {if $owner|@count gt 0}
                    {foreach $owner as $ow}
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 for_small img_fit text-center">
                        <img src="{$ow.photo}" alt="img">
                        <h5>{$ow.name}</h5>
                        <span class="gray_anch">{$ow.position}</span>
                    </div>
                {/foreach}
            {/if}
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






            </div><!-- /.right_section -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->

</div><!-- /.n_content_area -->
{/block}
