{extends file=$layout}
{block name=content}
    <link rel="stylesheet" href="{base_url('templates/default/assets/css/prefix-style.css')}" media="all">
    <div class="n_content_area full_width">
    <a href="#" id="openMenu" class="pages-menu-float">Menu</a>

        <div class="container-fluid">
            <div class="row">
                <div class="all_modals">
                    {*{if  $user['group_id'] eq 2 ||  $user['group_id'] eq 3 ||  $user['group_id'] eq 4}*}
                    {if $get_confirm_status eq false}
                        {if $UserData->status eq 0}
                            <div id="comfirmAccount" class="modal fade forGot" role="dialog"
                                 style="z-index:999999999999999;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form class="comfirmAccount" action="{base_url()}profile/comfirmAccount"
                                              method="post">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;
                                                </button>
                                                {*<h4 class="modal-title data-title">Comfirm Account</h4>*}
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><img src="{base_url('templates/default/assets/images/icons/close_n.png')}" /></span></button>
                                            </div>
                                            <div class="modal-body data-response">
                                                <h3>CONFIRM ACCOUNT</h3>
                                                <div class="mod_center_inp change_pss">
                                                    <div class="form-group" style="text-align: center;">
                                                        <input type="file" name="certifcate" style="display:none;"
                                                               class="certifcate-input"/>
                                                        <button type="button" class="btn btn-danger choose-certifcate">
                                                            Choose
                                                            Certifcate
                                                        </button>
                                                    </div>
                                                    <div class="form-group" style="text-align: center;">
                                                        <label for="company-date">Information</label>
                                                        <textarea type="text" name="info"
                                                                  class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                <div class="like_btn_n fnt_normal full_width">
                                                    <button type="submit" class="btn btn-success">Save</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
{*                                            <div class="modal-footer">*}
{*                                                <button type="submit" class="btn btn-success">Save</button>*}
{*                                                <button type="button" class="btn btn-default" data-dismiss="modal">*}
{*                                                    Close*}
{*                                                </button>*}
{*                                            </div>*}
                                        </form>
                                    </div>
                                </div>
                            </div>
                        {/if}
                    {/if}
                </div>
                {include file='../company/sidebar.tpl'}
                <div class="n_right_section decrease_padding_20 start_with_text">
                    {*<div class="with_buttons full_width">
                        <h2>INTEREST</h2>
                        <!--<a href="#" class="n_green_col">Add Products</a>-->
                    </div>*}
                    <div class="banner_image_n img_fit full_width">
                        {if $UserData->company_banner}
                            <img src="{$UserData->company_banner}" style="max-height: 220px; object-fit: cover;" alt="img"/>
                        {else}
                            <img src="{base_url('templates/default/assets/images/bnnr.png')}" style="max-height: 220px; object-fit: cover;" alt="img"/>
                        {/if}
                    </div><!-- /.banner_image_n -->

                    <div class="full_width need_padding_here">
                        <div class="cmother full_width pr-s-n with_buttons">
                            <h2>COMPANY INFORMATION</h2>
                            <a href="{base_url('/')}profile/edit-page">Edit Info</a>
                        </div>
                        <div class="full_width max-arrange">
                            <div class="drt_form full_width">
                                <div class="full_width">
                                    <div class="fst_col">
                                        <label>Company Name <span>{$UserData->company_name}</span></label>
                                    </div><!-- /.fst_col -->
                                    <div class="snd_col">
                                        <label>Establishment date <span>{$UserData->establishment_date}</span></label>
                                    </div><!-- /.snd_col -->
                                </div><!-- /.full_width -->
                                <div class="full_width">
                                    <div class="fst_col">
                                        <label>Field of activity <span>{$selected_product_type_names}</span></label>
                                    </div><!-- /.fst_col -->
                                    {if !empty($UserData->website)}
                                        <div class="snd_col">
                                            <label>Website <span>{$UserData->website}</span></label>
                                        </div>
                                        <!-- /.snd_col -->
                                    {/if}
                                </div><!-- /.full_width -->
                                {if $get_standart}
                                    <div class="full_width">
                                        <div class="fst_col">
                                            <label>Standard
                                                {foreach $get_standart as $key=>$value}
                                                    <span>{$value.st_name}</span>
                                                    ,
                                                {/foreach}
                                            </label>
                                        </div><!-- /.fst_col -->
                                    </div>
                                    <!-- /.full_width -->
                                {/if}
                            </div><!-- /.drt_form -->

                            <div class="n_personal_info full_width">
                                <h3>ABOUT COMPANY</h3>
                                <p>{$UserData->company_info}</p>

                                <div class="tags_nn full_width">
                                    {if !empty(trim($tags))}
                                        {$tags}
                                    {/if}
                                </div><!-- /.tags_nn -->
                            </div><!-- /.personal_info -->


                            <div class="n_contact_info full_width">
                                <h3>CONTACT INFO</h3>
                                <div class="drt_form full_width">
                                    {if $company_info}{foreach $company_info as $secret=>$company}
                                        <div class="full_width">
                                            <div class="fst_col">
                                                <label>Phone Number <span>{$company->phone}
                                                    <i>
                                                        {if $phone_type}
                                                            {foreach $phone_type as $key => $value}
                                                                {if $value->id == $company->phone_type } {$value->name} {break} {/if}
                                                            {/foreach}
                                                        {/if}
                                                    </i>
                                                </span>
                                                </label>
                                            </div><!-- /.fst_col -->
                                            <div class="snd_col">
                                                <label>Contact Person Name <span
                                                            class="get_underline">{$company->fullname}</span></label>
                                            </div><!-- /.snd_col -->
                                        </div>
                                        <!-- /.full_width -->
                                        <div class="full_width">
                                            <div class="fst_col">
                                                <label>Ext <span>{$company->ext}</span></label>
                                            </div><!-- /.fst_col -->
                                            <div class="snd_col">
                                                <label>Person Type<span class="get_underline">
                                                    {if $person_type}
                                                        {foreach $person_type as $key => $value}
                                                            {if $value->id == $company->person_type } {$value->name} {break} {/if}
                                                        {/foreach}
                                                    {/if}
                                                </span></label>
                                            </div><!-- /.snd_col -->
                                        </div>
                                        <!-- /.full_width -->
                                        <div class="full_width">
                                            <div class="fst_col">
                                                <label>City, Country
                                                    <span>{get_country_name($UserData->country_id)}</span></label>
                                            </div><!-- /.fst_col -->
                                            <div class="snd_col">
                                                <label>E-mail <span>{$company->email}</span></label>
                                            </div><!-- /.snd_col -->
                                        </div>
                                        <!-- /.full_width -->
                                    {/foreach}{/if}

                                    <div class="full_width">
                                        {if !empty($UserData->company_adress)}
                                            <div class="fst_col">
                                                <label>Address <span>{$UserData->company_adress}</span></label>
                                                <div class="map__">
                                                    <img src="{base_url('templates/default/assets/images/map__.png')}"/>
                                                </div>
                                            </div>
                                            <!-- /.fst_col -->
                                        {/if}
                                        <div class="snd_col al_blk">
                                            <hr class="thrx">
                                            {if !empty($UserData->full_name)}
                                                <label>Contact Person Name <span>{$UserData->full_name}</span></label>
                                            {/if}
                                            {if !empty($UserData->position)}
                                                <label>Person Type <span>{$UserData->position_name}</span></label>
                                            {/if}
                                            {if !empty($UserData->email)}
                                                <label>E-mail <span>{$UserData->email}</span></label>
                                            {/if}
                                        </div><!-- /.snd_col -->
                                    </div><!-- /.full_width -->

                                    <div class="n_social_block full_width">
                                        {if !empty($UserData->company_facebook)}
                                        <a href="{$UserData->company_facebook}"><img
                                                    src="{base_url('templates/default/assets/images/icons/n_face.png')}"
                                                    alt="facebook"></a>
                                        {/if}
                                        {if !empty($UserData->company_twitter)}
                                            <a href="{$UserData->company_twitter}"><img
                                                        src="{base_url('templates/default/assets/images/icons/n_twit.png')}"
                                                        alt="facebook"></a>
                                        {/if}
                                        {if !empty($UserData->company_youtube)}
                                            <a href="{$UserData->company_youtube}"><img
                                                        src="{base_url('templates/default/assets/images/icons/n_tube.png')}"
                                                        alt="facebook"></a>
                                        {/if}
                                        {if !empty($UserData->company_linkedin)}
                                            <a href="{$UserData->company_linkedin}"><img
                                                        src="{base_url('templates/default/assets/images/icons/n_in.png')}"
                                                        alt="facebook"></a>
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
    {*
        <style>
            #map {
                top: 0 !important;
                margin-bottom: 2px;
            }
        </style>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
        <script src="//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
        <div class="clearfix"></div>
        <div class="wrap margin-top-100 col-md-12">
            <div class="container">

                {if  $user['group_id'] eq 2 ||  $user['group_id'] eq 3 ||  $user['group_id'] eq 4}
                    <div id="comfirmAccount" class="modal fade" role="dialog" style="z-index:999999999999999;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form class="comfirmAccount" action="{base_url()}profile/comfirmAccount" method="post">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title data-title">Comfirm Account</h4>
                                    </div>
                                    <div class="modal-body data-response">
                                        <div class="form-group">
                                            <input type="file" name="certifcate" style="display:none;"
                                                   class="certifcate-input"/>
                                            <button type="button" class="btn btn-danger choose-certifcate">Choose
                                                Certifcate
                                            </button>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group">
                                            <label for="company-date">Information</label>
                                            <textarea type="text" name="info" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Save</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                {/if}

                <div class="row">
                    <div class="clearfix"></div>
                    <div class="col-md-12" id="profile">
                        <div class="col-md-12 no-padding">
                            <form
                                    class="userphotos_form"
                                    action="https://makromedicine.com/profile/userphotos"
                                    method="post"
                            >
                                <input
                                        type="file"
                                        style="display:none;"
                                        name="userphotos"
                                        class="userphotos"
                                />
                            </form>
                            <form
                                    class="userSettings"
                                    action="https://makromedicine.com/profile/save"
                                    enctype="multipart/form-data"
                                    method="post"
                            >
                                <!--main info start-->
                                <div class="col-md-12 profile-right no-padding">
                                    <div class="right-content">
                                        <div class="container main-secction">
                                            <div class="row">
                                                <div
                                                        class="col-md-12 col-sm-12 col-xs-12 image-section"
                                                >
                                                    {if $UserData->company_banner}
                                                        <img src="{$company_banner}" />
                                                    {else}
                                                        <img src="https://picsum.photos/1170/250"/>
                                                    {/if}
                                                </div>
                                                <div class="row user-left-part">
                                                    {include file='../company/sidebar.tpl'}
                                                    <div
                                                            class="col-md-9 col-sm-9 col-xs-12 pull-right profile-right-section"
                                                            style="height:520px; overflow:hidden; overflow-y:scroll;"
                                                    >
                                                        <div class="row profile-right-section-row">
                                                            <div
                                                                    class="col-md-12 col-sm-10 col-xs-10 profile-header"
                                                            >
                                                                <div class="row">
                                                                    <h1>{$UserData->company_name}</h1>
                                                                    <br/>
                                                                    <button
                                                                            type="submit"
                                                                            name="submit"
                                                                            class=""
                                                                            style="background-color:#DCDCDC; font-size:12px; color:black;"
                                                                    >
                                                                        Follow (101)
                                                                    </button>

                                                                    <hr/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <div class="row">
                                                                            <h1 class="main-info-title">
                                                                                <u>Company Information</u>
                                                                            </h1>
                                                                        </div>
                                                                        <!-- Tab panes -->
                                                                        <div
                                                                                class="tab-content"
                                                                                style="margin-top:10px;"
                                                                        >
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <label>Field of Activity</label>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <p>{$selected_product_type_names}</p>
                                                                                </div>
                                                                            </div>
                                                                            {if $get_standart}
                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <label>Standard</label>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <p>
                                                                                            {foreach $get_standart as $key=>$value}
                                                                                                <span>{$value.st_name}</span>
                                                                                                ,
                                                                                            {/foreach}
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            {/if}
                                                                            {if !empty(trim($tags))}
                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <label>Tags</label>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <p>{$tags}</p>
                                                                                    </div>
                                                                                </div>
                                                                            {/if}
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <label>Establishment Date</label>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <p>{$UserData->establishment_date}</p>
                                                                                </div>
                                                                            </div>
                                                                            {if !empty($UserData->company_adress)}
                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <label>Address</label>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <p>{$UserData->company_adress}</p>
                                                                                    </div>
                                                                                </div>
                                                                            {/if}
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <label>Country</label>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <p>{get_country_name($UserData->country_id)}</p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <label></label>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div style="height: 213px;top: 21px;" id="map"></div>
                                                                                </div>
                                                                            </div>
                                                                            {if !empty($UserData->website)}
                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <label>Website</label>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <p>
                                                                                            <a href="{$UserData->website}"
                                                                                            >{$UserData->website}</a
                                                                                            >
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            {/if}

                                                                            {if !empty($UserData->company_info)}
                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <label>Company Info</label>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <p>
                                                                                            {$UserData->company_info}
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            {/if}
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-8">
                                                                        <div class="row">
                                                                            <h1
                                                                                    class="main-info-title"
                                                                                    style="margin-top:20px;"
                                                                            >
                                                                                <u>Company Contact Information</u>
                                                                            </h1>
                                                                        </div>
                                                                        <!-- Tab panes -->
                                                                        <div
                                                                                class="tab-content"
                                                                                style="margin-top:10px;"
                                                                        >
                                                                            {if $company_info}{foreach $company_info as $secret=>$company}
                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <label>Full Name</label>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <label>{$company->fullname}</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <label>Email</label>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <label>{$company->email}</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <label>Phone</label>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <label>{$company->phone}</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <label>Type</label>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <label>
                                                                                            {if $phone_type}
                                                                                                {foreach $phone_type as $key => $value}
                                                                                                    {if $value->id == $company->phone_type } {$value->name} {break} {/if}
                                                                                                {/foreach}
                                                                                            {/if}
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <label>Person Type</label>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <label>
                                                                                        {if $person_type}
                                                                                                {foreach $person_type as $key => $value}
                                                                                                    {if $value->id == $company->person_type } {$value->name} {break} {/if}
                                                                                                {/foreach}
                                                                                            {/if}
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <label>Extention</label>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <label>{$company->ext}</label>
                                                                                    </div>
                                                                                </div>
                                                                            {/foreach}{/if}
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <div class="row">
                                                                            <h1
                                                                                    class="main-info-title"
                                                                                    style="margin-top:20px;"
                                                                            >
                                                                                <u>Company Media Details</u>
                                                                            </h1>
                                                                        </div>
                                                                        <!-- Tab panes -->
                                                                        <div
                                                                                class="tab-content"
                                                                                style="margin-top:10px;"
                                                                        >
                                                                            <div class="row">
                                                                                {if !empty($UserData->company_facebook)}
                                                                                <a href="{$UserData->company_facebook}"
                                                                                ><img src="{base_url('templates/default/assets/img/sys/social-media/facebook.png')}"
                                                                                      width="30" height="30"/></a
                                                                                >
                                                                                {/if}&nbsp;&nbsp;&nbsp;
                                                                                {if !empty($UserData->company_twitter)}
                                                                                    <a href="{$UserData->company_twitter}"
                                                                                    ><img src="{base_url('templates/default/assets/img/sys/social-media/twitter.png')}"
                                                                                          width="30" height="30"
                                                                                        /></a>
                                                                                {/if}
                                                                                {if !empty($UserData->company_linkedin)}
                                                                                    <a href="{$UserData->company_linkedin}"
                                                                                    ><img src="{base_url('templates/default/assets/img/sys/social-media/linkedin.png')}"
                                                                                          width="60" height="30"
                                                                                        /></a>
                                                                                {/if}
                                                                                {if !empty($UserData->company_youtube)}
                                                                                    <a href="{$UserData->company_youtube}"
                                                                                    ><img src="{base_url('templates/default/assets/img/sys/social-media/youtube.png')}"
                                                                                          width="30" height="30"
                                                                                        /></a>
                                                                                {/if}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>
                                    </div>

                                    <!--main info end-->
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        *}
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXX757Qw5m5_tjb2VxaeyRZ34T-IID2ok&libraries=places&callback=initAutocomplete"
            async defer></script>
    <script>
        {if $get_confirm_status eq false}
        {if $UserData->status eq 0}
        // $('#comfirmAccount').modal();
        $("#verify_account_modal").on('click', function () {
            $('#comfirmAccount').modal();
        });
        {/if}
        {/if}

        {if !empty($UserData->company_lat) || !empty($UserData->company_lng)}
        var json_lat = {$UserData->company_lat};
        var json_lng = {$UserData->company_lng};
        var json_title = '{$UserData->company_address}';
        {literal}
        function initAutocomplete() {
            var myLatLng = {lat: json_lat, lng: json_lng};
            var map = new google.maps.Map(document.getElementById('map'), {
                center: myLatLng,
                zoom: 15,
                mapTypeId: 'roadmap'
            });
            var image = {
                url: 'https://maps.gstatic.com/mapfiles/place_api/icons/geocode-71.png',
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(25, 25)
            };
            var beachMarker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                icon: image
            });
            var input = document.getElementById('pac-input');
            var searchBox = new google.maps.places.SearchBox(input);
            map.addListener('bounds_changed', function () {
                searchBox.setBounds(map.getBounds());
            });
            var markers = [];
            searchBox.addListener('places_changed', function () {

                var places = searchBox.getPlaces();
                if (places.length == 0) {
                    return;
                }
                markers.forEach(function (marker) {
                    marker.setMap(null);
                });

                markers = [];
                var bounds = new google.maps.LatLngBounds();
                places.forEach(function (place) {
                    if (!place.geometry) {
                        console.log("Returned place contains no geometry");
                        return;
                    }
                    var icon = {
                        url: place.icon,
                        size: new google.maps.Size(71, 71),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(17, 34),
                        scaledSize: new google.maps.Size(25, 25)
                    };
                    markers.push(new google.maps.Marker({
                        map: map,
                        icon: icon,
                        title: place.name,
                        position: place.geometry.location
                    }));
                    $('.company_lat').val(place.geometry.location.lat());
                    $('.company_lng').val(place.geometry.location.lng());
                    if (place.geometry.viewport) {
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                map.fitBounds(bounds);
            });
        }
        {/literal}
        {else}
        var json_title = '{$UserData->company_name}';
        {literal}
        function initAutocomplete() {
            $.ajax({
                url: "https://ipinfo.io/?callback=",
                type: "GET",
                dataType: 'json',
                cache: true,
                success: function (data, status, error) {
                    var reg = data.loc.split(',');
                    var myLatLng = {lat: '', lng: ''};
                    var map = new google.maps.Map(document.getElementById('map'), {
                        center: myLatLng,
                        zoom: 15,
                        mapTypeId: 'roadmap'
                    });
                    var image = {
                        url: 'https://maps.gstatic.com/mapfiles/place_api/icons/geocode-71.png',
                        size: new google.maps.Size(71, 71),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(17, 34),
                        scaledSize: new google.maps.Size(25, 25)
                    };
                    var beachMarker = new google.maps.Marker({
                        position: myLatLng,
                        map: map,
                        icon: image
                    });
                    var input = document.getElementById('pac-input');
                    var searchBox = new google.maps.places.SearchBox(input);
                    map.addListener('bounds_changed', function () {
                        searchBox.setBounds(map.getBounds());
                    });
                    var markers = [];
                    searchBox.addListener('places_changed', function () {
                        var places = searchBox.getPlaces();
                        if (places.length == 0) {
                            return;
                        }
                        markers.forEach(function (marker) {
                            marker.setMap(null);
                        });
                        markers = [];
                        var bounds = new google.maps.LatLngBounds();
                        places.forEach(function (place) {
                            if (!place.geometry) {
                                console.log("Returned place contains no geometry");
                                return;
                            }
                            var icon = {
                                url: place.icon,
                                size: new google.maps.Size(71, 71),
                                origin: new google.maps.Point(0, 0),
                                anchor: new google.maps.Point(17, 34),
                                scaledSize: new google.maps.Size(25, 25)
                            };
                            markers.push(new google.maps.Marker({
                                map: map,
                                icon: icon,
                                title: place.name,
                                position: place.geometry.location
                            }));
                            $('.company_lat').val(place.geometry.location.lat());
                            $('.company_lng').val(place.geometry.location.lng());
                            if (place.geometry.viewport) {
                                bounds.union(place.geometry.viewport);
                            } else {
                                bounds.extend(place.geometry.location);
                            }
                        });
                        map.fitBounds(bounds);
                    });
                }
            });
        }
        {/literal}
        {/if}
        $(document).ready(function () {

            if ($('a.image-link').length) {
                $('a.image-link').magnificPopup({
                    type: 'image',
                    mainClass: 'mfp-with-zoom',
                    gallery: {
                        enabled: true
                    },
                    zoom: {
                        enabled: true
                    }
                });
            }

            $(document).on('mouseenter', '.userphotos-change img,.camera-icon', function () {
                $('.camera-icon').css('opacity', 1);
            })
            $(document).on('mouseleave', '.userphotos-change img,.camera-icon', function () {
                $('.camera-icon').css('opacity', 0);
            })

            $(document).on('click', '.userphotos-change,.camera-icon', function () {
                $('input.userphotos').click();
            })
            {literal}
            $(document).on('submit', '.userphotos_form', function (e) {
                e.preventDefault();
                var formData = new FormData($(this)[0]);
                $.isLoading({text: ""});
                $.ajax({
                    type: 'POST',
                    url: site_url + 'profile/userphotos/',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        console.log(data);
                        if (data == 'false') {
                            toastr.warning('This profile image not upload. Please refresh page or <a target="_blank" href="' + site_url + 'contact">Contact us</a>');
                        } else {
                            toastr.success('Profile update successful !');
                            if ($('.round-image img').attr('src', site_url + 'uploads/catalog/users/' + data)) {
                                $.isLoading("hide");
                            }
                        }
                    }
                });
                e.preventDefault();
                return false;
            });
            $(document).on('submit', '.comfirmAccount', function (e) {
                e.preventDefault();
                var formData = new FormData($(this)[0]);
                $.ajax({
                    type: 'POST',
                    url: site_url + 'profile/comfirmAccount/',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        var obj = JSON.parse(data);
                        if (obj.type == 'success') {
                            $('.modal').modal('hide');

                            toastr.success(obj.message);
                            setTimeout(function () {
                                location.reload();
                            }, 2000);
                        } else {
                            toastr.error(obj.message);
                        }
                    }
                });
                e.preventDefault();
                return false;
            });
            {/literal}
            $(document).on('change', '.userphotos', function (e) {
                e.preventDefault();
                $('.userphotos_form').submit();
                e.preventDefault();
                return false;
            });
            $(document).on('click', '.choose-certifcate', function () {
                $('.certifcate-input').click();
            });
            $(document).on('change', '.certifcate-input', function () {
                var filename = $(this).val().replace(/C:\\fakepath\\/i, '')
                $('.choose-certifcate').removeClass('btn-danger').addClass('btn-success').text('Selected - ' + filename);

            })
        });
    </script>
{/block}
