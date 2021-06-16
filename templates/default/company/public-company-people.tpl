{extends file=$layout}
{block name=content}
<link rel="stylesheet" href="{base_url('templates/default/assets/css/prefix-style.css')}" media="all">
{include file='../_partial/approve_waiting_line.tpl'}
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
                {if !empty($approved_users)}

                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 for_small img_fit text-center">
                        <img src="{$owner.photo}" alt="img">
                        <h5>{$owner.name}</h5>
                        <span class="gray_anch">{$owner.position}</span>
                    </div>

            
                    {foreach $approved_users as $approved_user}
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 for_small img_fit text-center">
                            <img src="{$approved_user.photo}" alt="img">
                            <h5>{$approved_user.name}</h5>
                            <span class="gray_anch">{$approved_user.position}</span>
                        </div>
                    {/foreach}
                {else}
                    <p class="col-lg-12 text-center flex result_not_found">Result not found</p>
                {/if}
                </div>
                
            </div>






            </div><!-- /.right_section -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->

</div><!-- /.n_content_area -->
{/block}
