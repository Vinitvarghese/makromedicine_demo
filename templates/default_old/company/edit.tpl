{extends file=$layout}
{block name=content}
    <link rel="stylesheet" href="{base_url('templates/default/assets/css/prefix-style.css')}" media="all">
    {literal}
    <style>
        .steps { display: block !important;}
        .intl-tel-input.allow-dropdown input {
            border: 1px solid rgba(177, 177, 177, 1);
            border-radius: 6px;
            font-size: 14px;
            color: rgba(70, 70, 70, 1);
            float: left;
        }
    </style>
    {/literal}


    <div class="n_content_area full_width">
<a href="#" id="openMenu" class="accounts-menu-float">Menu</a>
        <div class="container-fluid">
            <div class="all_modals full_width">
                <div id="changePassword" class="modal fade" role="dialog" style="z-index:999999999999999;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true"><img src="{base_url('templates/default/assets/images/icons/close_n.png')}"/></span></button>
                            </div>
                            <div class="modal-body">
                                <h3>CHANGE PASSWORD</h3>
                                <form class="changePassword" action="{base_url()}profile/changePassword" method="post">
                                    <div class="mod_center_inp change_pss">
                                        <div class="full_width relative">
                                            <label>Current Password</label>
                                            <input type="password" name="current_password"/>
                                            <span class="eye_im"><img src="{base_url('templates/default/assets/images/icons/eye_bar.png')}"/></span>
                                        </div>
                                        <div class="full_width relative">
                                            <label>New Password</label>
                                            <input type="password" name="new_password" />
                                            <span class="eye_im"><img src="{base_url('templates/default/assets/images/icons/eye.png')}"/></span>
                                        </div>
                                        <div class="full_width relative">
                                            <label>Confirm Password</label>
                                            <input type="password" name="re_password" />
                                            <span class="eye_im"><img src="{base_url('templates/default/assets/images/icons/eye.png')}"/></span>
                                        </div>

                                        {*<a href="#" class="fr_pass">Forgot your password?</a>*}
                                    </div><!-- /.mod_center_inp -->


                                    <div class="like_btn_n fnt_normal full_width">
                                        <button type="submit" class="send_n">Save</button>
                                        <button type="button" class="back_n" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
               


            </div>

            {*{if $UserData->status neq 1 && ($user['group_id'] eq 2 ||  $user['group_id'] eq 3 ||  $user['group_id'] eq 4)}
                <div class="row" style="margin-bottom: 1em">
                    <div class="col-sm-12">
                        <div class="alert alert-warning" style="margin-top: 10px;margin-bottom:0">
                            Please <a href="javascript:;" onclick="$('#comfirmAccount').modal();">upload a
                                certificate.</a> After the confirmation of certificate your account will be approved and
                            your products will appear on the top rank of the search list.
                        </div>
                    </div>
                </div>
            {/if}*}
            <div class="row">
                {include file='../company/sidebar.tpl'}
                <div class="n_right_section start_with_text">
                    <div class="with_buttons full_width">
                        <h2>COMPANY INFORMATION</h2>
                    </div><!-- /.with_buttons -->

                    {*<h3 class="french">ЗАПОЛНЕННОСТЬ ПРОФИЛЯ</h3>
                    <div class="n_gray_box full_width">
                        <ul>
                            <li><span>1. Заполните профиль информацией,</span><span>2. Добавьте продукты</span></li>
                            <li>От степени заполнения профиля зависит количество доступных вам функций сайта</li>
                        </ul>
                    </div><!-- /.n_gray_box -->*}
                    {$percent=0}
                    {$percentage_list=[
                        1 => [
                            'title' => 'Company general info',
                            'key_list' => [
                                'company_name' => 0, 'country_id' => 0, 'company_logo' => 0, 'company_banner' => 0, 'status' => 0
                            ],
                            'filled' => false
                        ],
                        2 => [
                            'title' => 'Company special info',
                            'key_list' => [
                                'establishment_date'  => 0, 'standart'  => 0, 'company_address'  => 0, 'product_type'  => 0
                            ],
                            'filled' => false
                        ],
                        3 => [
                            'title' => 'About company',
                            'key_list' => [
                                'company_info'  => 0, 'company_facebook'  => 0, 'company_twitter'  => 0, 'company_linkedin'  => 0, 'company_youtube'  => 0, 'website'  => 0
                            ],
                            'filled' => false
                        ],
                        4 => [
                            'title' => 'Employeers',
                            'key_list' => [

                            ],
                            'filled' => false
                        ],
                        5 => [
                            'title' => 'Products',
                            'key_list' => [

                            ],
                            'filled' => false
                        ]
                    ]}

                    {$translate_list=[
                        'company_name' => 'Company Name',
                        'country_id' => 'Country',
                        'company_logo' => 'Company logo',
                        'company_banner' => 'Cover photo',
                        'status' => 'Status',
                        'establishment_date' => 'Establishment date',
                        'standart' => 'Standard',
                        'company_address' => 'Address',
                        'product_type' => 'Field of activity',
                        'company_info' => 'About Company',
                        'company_facebook' => 'Facebook',
                        'company_twitter' => 'Twitter',
                        'company_linkedin' => 'Linkedin',
                        'company_youtube' => 'Youtube',
                        'website' => 'Website'
                    ]}

                    {foreach $percentage_list as $k => $v}
                        {if $k==4 || $k==5} {continue} {/if}

                        {foreach $v['key_list'] as $key => $item }
                            {if !empty($UserData->{$key})}
                                {$percentage_list[$k]['key_list'][$key] = 6.25}
                                {$percentage_list[$k]['filled']=true}
                                {$percent = $percent + 6.25}
                            {else}
                                {$percentage_list[$k]['filled']=false}
                            {/if}
                        {/foreach}

                    {/foreach}


                    <style>
                        @keyframes loading-1 {
                            0% {
                                -webkit-transform: rotate(0deg);
                                transform: rotate(0deg);
                            }
                            100% {
                                -webkit-transform: rotate(180deg);
                                transform: rotate({$val1}deg);
                            }
                        }

                        @keyframes loading-2 {
                            0% {
                                -webkit-transform: rotate(0deg);
                                transform: rotate(0deg);
                            }
                            100% {
                                -webkit-transform: rotate(144deg);
                                transform: rotate({$val2}deg);
                            }
                        }
                    </style>
                    <div class="n_diagram_detail full_width">
                        <div class="n_diagram">
                            <div class="progress blue">
                    <span class="progress-left">
                        <span class="progress-bar"></span>
                    </span>
                                <span class="progress-right">
                        <span class="progress-bar"></span>
                    </span>
                                <div class="progress-value">{$percent|round:0}%</div>
                            </div>
                        </div><!-- /.n_diagram -->
                        <div class="n_list_sys">
                            <ul>

                                {foreach $percentage_list as $k => $v}
                                    <li>
                                        {$icon = ($v['filled']) ? 'gren' : 'redd' }
                                        <div class=" user_i_top">
                                            <img src="{base_url()}templates/default/assets/images/icons/{$icon}.png"/>
                                            <span>{$v['title']}</span>

                                            <i class="fa fa-plus"></i>
                                        </div>

                                        <div class=" user_i_bottom">
                                            {foreach $v['key_list'] as $key => $item }
                                                {$icon2 = ($item > 0) ? 'gren' : 'redd' }
                                                <p>
                                                    <img src="{base_url()}templates/default/assets/images/icons/{$icon2}.png"/>
                                                    <span>{$translate_list[$key]}</span>
                                                </p>
                                            {/foreach}
                                        </div>
                                    </li>
                                {/foreach}


                            </ul>
                        </div><!-- /.n_list_sys -->
                        <hr>
                    </div><!-- /.n_diagram_detail -->

                    <div class="full_width max-arrange">

                        <form class="userSettings userSettingsCenter" action="{base_url()}profile/save" enctype="multipart/form-data"
                              method="post">
                              <div class="n_like_form full_width step2 steps">


                                  <div class="upload_logo_c_photo_area">

                                      <div class="upload_img_area">
                                          <div class="upload-btn-wrapper">
                                              <button class="btn">Add Logo</button>
                                              <input type="file" accept="image/gif, image/jpg, image/png, image/jpeg" name="company_logo" id="company_logo"
                                                     value="{$UserData->company_logo}"
                                                     class="form-control mylos company_logo">
                                          </div>

                                          <div class="add_logo_n" id="company_logo_wrapper" data-image="{site_url()}uploads/catalog/users/{str_replace([site_url(), 'uploads/catalog/users/'], ['', ''], $UserData->company_logo)}">

                                          </div>
                                      </div>



                                    <div class="upload_img_area">
                                        <div class="upload-btn-wrapper cov">
                                            <button class="btn">Add Cover Photo</button>
                                            <input type="file" accept="image/gif, image/jpg, image/png, image/jpeg" name="company_banner" id="company_banner"
                                                   value="{$UserData->company_banner}"
                                                   class="company_banner">
                                        </div>

                                        <div class="add_cover_n" id="company_cover_wrapper" data-image="{site_url()}uploads/catalog/users/{str_replace([site_url(), 'uploads/catalog/users/'], ['', ''], $UserData->company_banner)}">

                                        </div>
                                    </div>
                                  </div>

                            </div><!-- /.n_like_form -->
                            <div class="n_like_form full_width step1 steps">
                                <div class="n_first_block">
                                    <div class="full_width" style="position: relative">
                                        <label>Company Name <sup>*</sup></label>
                                        {if !empty($UserData->company_name)}
                                            <input type="text" name="company_name" id="company-name"
                                                   class="readonly"
                                                   disabled
                                                   placeholder="{$UserData->company_name}"
                                                   value="{$UserData->company_name}" disabled>
                                            <input type="hidden" name="company_name"
                                                   value="{$UserData->company_name}">
                                        {else}
                                            <input type="text" name="company_name" id="company-name"
                                                   class="readonly" placeholder="" value="">
                                        {/if}

                                        {if $UserData->position==1}
                                            <span style="position:absolute; top: 32px;right: 93px;"> <a
                                                        href="#changeCompanyName"
                                                        onclick="$('#changeCompanyName').modal();">Change</a> </span>
                                        {/if}

                                    </div><!-- /.full_width -->
                                    <div class="full_width sel_full">
                                        <label>Status <sup>*</sup></label>
                                        <select name="group_id" class="n_select">
                                            <option value="2" {if $user['group_id'] eq 2} selected="selected" {/if} >
                                                Manufacturer
                                            </option>
                                            <option value="3" {if $user['group_id'] eq 3} selected="selected" {/if}>
                                                Distributor
                                            </option>
                                            <option value="4" {if $user['group_id'] eq 4} selected="selected" {/if}>
                                                Agent
                                            </option>
                                            <option value="5" {if $user['group_id'] eq 5} selected="selected" {/if} {if  $user['group_id'] eq 2 ||  $user['group_id'] eq 3 ||  $user['group_id'] eq 4} disabled {/if}>
                                                Manager
                                            </option>
                                            <option value="6" {if $user['group_id'] eq 6} selected="selected" {/if} {if  $user['group_id'] eq 2 ||  $user['group_id'] eq 3 ||  $user['group_id'] eq 4} disabled {/if}>
                                                User
                                            </option>
                                        </select>
                                    </div><!-- /.full_width -->
                                    <div class="full_width sel_full">
                                        <label>Field of activity <sup>*</sup></label>
                                        <select class="selectpicker"
                                                name="product_type[]" multiple data-live-search="true"
                                                data-selected-text-format="count > 1" title="Field of activity">
                                            {if $product_type}{foreach $product_type as $key => $value}
                                                <option {if $selected_product_type}{if in_array($value->id, $selected_product_type)} selected {/if}{/if}
                                                        value="{$value->id}">{$value->name}</option>
                                            {/foreach}{/if}
                                        </select>
                                    </div><!-- /.full_width -->
                                    <div class="full_width sel_full">
                                        <label>Standard </label>
                                            <select name="standart[]"
                                                    class="selectpicker standart"
                                                    multiple data-live-search="true"
                                                    data-selected-text-format="count > 1" title="Standard">
                                                {if $standarts}
                                                    {foreach $standarts as $key => $value}
                                                        <option value="{$value->id}" {if $selected_standart}{if in_array($value->id, $selected_standart)} selected {/if}{/if}>{$value->name}</option>
                                                    {/foreach}
                                                {/if}
                                            </select>
                                            <div class="img-full-right-block img_forece" id="img_forece">

                                                {if $get_standart}
                                                    {foreach $get_standart as $num => $row}
                                                        <div class="img-upload-group bitrix block_{$row['standart_id']}" var-attr="{$row['standart_id']}" >
                                                            <div class="reload-form-upload">
                                                                <label>
                                                                    <input type="file" accept="image/gif, image/jpg, image/png, image/jpeg" name="userfile[{$row['standart_id']}]">
                                                                    <button type="button" class="mini-upload upload-button" data-id="{$row['standart_id']}" data-target="standart"></button>
                                                                </label>
                                                            </div><div class="reload-form-cover-mini">
                                                                <img src="{base_url()}{DIR_IMAGE}catalog/standart/{$row['name']}" title="{$row['st_name']}" alt="{$row['st_name']}">
                                                                <button type="button" class="remove-image" data-id="{$row['standart_id']}" user-id="{$UserData->id}" >  </button>
                                                            </div>
                                                            <span title="{$row['st_name']}"> {$row['st_name']}</span>
                                                        </div>
                                                    {/foreach}
                                                {/if}

                                            </div>
                                    </div><!-- /.full_width -->

                                    <div class="full_width date_of_brth">
                                        <label>Establishment date <sup>*</sup></label>
                                        <input type="text" name="establishment_date" id="company-date"
                                               class="" required placeholder="Establishment date"
                                               value="{$UserData->establishment_date}">
                                    </div><!-- /.full_width -->

                                    <div class="full_width">
                                        <label>Website</label>
                                        <input type="text" name="website"
                                                placeholder="" value="{$UserData->website}">
                                    </div><!-- /.full_width -->

                                </div><!-- /.n_first_block -->

                                <div class="n_second_block">
                                    <div class="full_width">
                                        <label>Country <sup>*</sup></label>
                                        <select class="selectpicker company-country"
                                                name="country_id" data-live-search="true"
                                                data-selected-text-format="count > 1" title="Country">
                                            {if $countrys}{foreach $countrys as $key => $value}
                                                <option value="{$value->id}" data-name="{$value->code}"
                                                        {if $value->id eq $UserData->country_id}selected="selected"{/if}>{$value->name}</option>
                                            {/foreach}{/if}
                                        </select>
                                    </div><!-- /.full_width -->
                                    <div class="full_width">
                                        <label>Address</label>
                                        <input type="text" name="company_address" id="pac-input"
                                               class="my-address controls"
                                               autocomplete="false" placeholder="Search your address"
                                               value="{$UserData->company_address}"/>
                                        <input type="hidden" name="company_lat" class="company_lat"
                                               value="{$UserData->company_lat}"/>
                                        <input type="hidden" name="company_lng" class="company_lng"
                                               value="{$UserData->company_lng}"/>
                                    </div><!-- /.full_width -->

                                    <div class="full_width map__ map__2">
                                        <div  id="map"></div>
                                    </div><!-- map__-->

                                    <div class="full_width">
                                        <label>Tags</label>
                                        <input type="text" name="tags[]" id="company-tags"
                                               class="tagsinput" value="{$tags}">
                                    </div><!-- /.full_width -->

                                </div><!-- /.n_second_block -->
                            </div><!-- /.n_like_form -->
                            <hr style="background-color: #B1B1B1;" />
                            <div class="n_like_form full_width step2 steps">
                                <div class="full_width text_stl">
                                    <label>About Company</label>
                                    <textarea name="company_info" id="company-info">{$UserData->company_info}</textarea>
                                </div><!-- /.full_width -->
                            </div><!-- /.n_like_form -->

                            <div class="n_like_form full_width step3 steps">
                                <div class="responsible-company-inner">
                                {if $company_info}{foreach $company_info as $secret=>$company}
                                    <div class="form-group clone_line"
                                         style="border-top:1px solid #ddd;padding-top: 20px;">
                                        <div class="col-md-6" style="padding-left: 0;">
                                            <div class="form-group">
                                                <label for="company-status" class="round"> Full
                                                    Name </label>
                                                <input type="text" name="company[fullname][][]"
                                                       id="company-status" class="form-control mylos"
                                                       value="{$company->fullname}">
                                            </div>
                                            <div class="form-group">
                                                <div class="list_of_person_type">
                                                    <div class="form-group has-suggestion">
                                                        <label for="company-ext" class="fill">Person
                                                            Type </label>
                                                        <select class="selectpicker form-control show-menu-arrow mylos mb-20 add_new_person_type"
                                                                name="company[person_type][][]"
                                                                data-live-search="true"
                                                                data-selected-text-format="count > 1"
                                                                title="Person Type">
                                                            {if $person_type}{foreach $person_type as $key => $value}
                                                                <option value="{$value->id}" {if $company->person_type eq $value->id} selected {/if}>{$value->name}</option>
                                                            {/foreach}{/if}
                                                        </select>
                                                    </div>
                                                </div>




                                            </div>
                                            <div class="form-group">
                                                <label for="company-status" class="round"> Email </label>
                                                <input type="text" name="company[email][][]"
                                                       id="company-status" class="form-control mylos"
                                                       value="{$company->email}">
                                            </div>

                                            
                                        </div>
                                        <div class="col-md-6" style="padding-right: 0;">
                                            <div class="form-group copiered_company">
                                                <label for="company-phone" class="round"> Phone </label>
                                                <input type="hidden" name="company[code][][]"
                                                    class="dial-up"
                                                    value="{if empty($company->code)}{$company->code}{else}{$company->code}{/if}">
                                                <input type="phone" name="company[phone][][]" id="phone"
                                                    class="form-control inputmask mylos {if empty($company->code)} phones {else} phones {/if}"
                                                    value="{$company->phone}"
                                                    data-co="{$UserData->country_code}">
                                            </div>
                                            <div class="form-group">
                                                <div>
                                                    <div class="col-md-5 no-padding" style="padding-right: 10px;">
                                                        <label for="company-ext" class="fill"> Type </label>
                                                        <select class="selectpicker form-control show-menu-arrow mylos"
                                                                name="company[phone_type][][]"
                                                                data-live-search="true"
                                                                data-selected-text-format="count > 1" title="Type">
                                                            {if $phone_type}{foreach $phone_type as $key => $value}
                                                                <option value="{$value->id}" {if $company->phone_type eq $value->id} selected {/if}>{$value->name}</option>
                                                            {/foreach}{/if}
                                                        </select>
                                                    </div>
                                                    <div class="col-md-7 no-padding">
                                                        <label for="company-ext" class="fill"> Ext </label>
                                                        <input type="text" name="company[ext][][]"
                                                            id="company-ext" class="form-control mylos"
                                                            value="{$company->ext}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                {/foreach}

                                {else}
                                    <div class="form-group clone_line"
                                         style="border-top:1px solid #ddd;padding-top: 20px;">
                                        <div class="col-md-6" style="padding-left: 0;">
                                            <div class="form-group">
                                                <label for="company-status" class="round"> Full
                                                    Name </label>
                                                <input type="text" name="company[fullname][][]"
                                                       id="company-status" class="form-control mylos"
                                                       value="{$UserData->fullname}">
                                            </div>
                                            <div class="form-group">
                                                <div class="list_of_person_type">
                                                    <div class="form-group has-suggestion">
                                                        <label for="company-ext" class="fill">Person
                                                            Type </label>
                                                        <select class="selectpicker form-control show-menu-arrow mylos mb-20 add_new_person_type"
                                                                name="company[person_type][][]"
                                                                data-live-search="true"
                                                                data-selected-text-format="count > 1"
                                                                title="Person Type">
                                                            {if $person_type}{foreach $person_type as $key => $value}
                                                                <option value="{$value->id}" {($UserData->position==$value->id) ? 'selected' : ''} >{$value->name}</option>
                                                            {/foreach}{/if}
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <label for="company-status" class="round"> Email </label>
                                                <input type="text" name="company[email][][]"
                                                       id="company-status" class="form-control mylos"
                                                       value="{$UserData->email}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 " style="padding-right: 0;">
                                            <div class="form-group copiered_company" style="margin-bottom: 20px !important;">
                                                <label for="company-phone" class="round"> Phone </label>
                                                <input type="hidden" name="company[code][][]"
                                                    class="dial-code" value="{$UserData->country_code}">
                                                <input type="phone" name="company[phone][][]" id="phone"
                                                    class="form-control inputmask phone mylos"
                                                    value="{$UserData->phone}"
                                                    data-co="{$UserData->country_code}">
                                            </div>
                                            <div class="form-group">
                                                <div>
                                                        <div class="col-md-5 no-padding" style="padding-right: 10px;">
                                                            <label for="company-ext" class="fill"> Phone Type </label>
                                                            <select class="selectpicker form-control show-menu-arrow mylos"
                                                                    name="company[phone_type][][]"
                                                                    data-live-search="true"
                                                                    data-selected-text-format="count > 1" title="Type">
                                                                {if $phone_type}{foreach $phone_type as $key => $value}
                                                                    <option value="{$value->id}">{$value->name}</option>
                                                                {/foreach}{/if}
                                                            </select>                                                        
                                                        </div>
                                                        <div class="col-md-7 no-padding">
                                                            <label for="company-ext" class="fill"> Ext </label>
                                                            <input type="text" name="company[ext][][]"
                                                                id="company-ext" class="form-control mylos"
                                                                value="">                                                        
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                {/if}
                                </div>
                                <div class="full_width admoreplus">
                                    <div class="col-md-5 no-padding">
                                        <a href="#" class="confirm-btn responsible-btn" data-target="company">Add More +</a>
                                    </div>
                                </div><!-- /.admoreplus -->

                                <hr class="thrx">

                                <div class="full_width n_like_form">
                                    <div class="n_first_block">
                                        <div class="full_width">
                                            <label>Facebook</label>
                                            <input type="text" name="company_facebook" id="company-status"
                                                   value="{$UserData->company_facebook}">
                                        </div><!-- /.full_width -->
                                        <div class="full_width">
                                            <label>Youtube</label>
                                            <input type="text" name="company_youtube" id="company-status"
                                                   value="{$UserData->company_youtube}">
                                        </div><!-- /.full_width -->
                                    </div><!-- /.n_first_block -->

                                    <div class="n_second_block">
                                        <div class="full_width">
                                            <label>Twitter</label>
                                            <input type="text" name="company_twitter" id="company-activity"
                                                   value="{$UserData->company_twitter}">
                                        </div><!-- /.full_width -->
                                        <div class="full_width">
                                            <label>Linkedin</label>
                                            <input type="text" name="company_linkedin" id="company-activity"
                                                   value="{$UserData->company_linkedin}">
                                        </div><!-- /.full_width -->
                                    </div><!-- /.n_first_block -->
                                </div><!-- /.full_width -->
                            </div><!-- /.n_like_form -->

                            <div class="btn_wrap full_width">
                                <div class="btn_wrap hasfull full_width">
                                    <input id="submit_btn" type="submit" class="n_save">
                                </div><!-- /.btn_wrap -->
                            </div><!-- /.btn_wrap -->
                        </form>
                    </div><!-- /.max_arrange -->
                </div><!-- /.n_right_section -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.n_content_area -->

<!--
    <script>
        $(document).ready(function () {
           $('.step-selector').on('click', function(ev){
               ev.preventDefault();
               $('.step-selector').removeClass('active');
               $(this).addClass('active');
               var currentStep = $(this).attr('data-step');
               $('.steps').fadeOut();
               $('.'+currentStep).fadeIn();
           });

           // Next Prev click
            $("#company_prev").on('click', function(ev){
                ev.preventDefault();
                var currentStep = $(".step-selector.active").attr("data-step");
                var currentStepCount = parseInt($(".step-selector.active").attr("data-step-count"));
                var nextStep = currentStepCount+1;
                if(nextStep <= 4) {
                    $('.step-selector').removeClass('active');
                    $('.sel'+nextStep).addClass('active');
                    $('.steps').fadeOut();
                    $('.step'+nextStep).fadeIn();
                }
            });
            $("#company_next").on('click', function(ev){
                ev.preventDefault();
                var currentStep = $(".step-selector.active").attr("data-step");
                var currentStepCount = parseInt($(".step-selector.active").attr("data-step-count"));
                var previousStep = currentStepCount-1;
                if(previousStep > 0) {
                    $('.step-selector').removeClass('active');
                    $('.sel'+previousStep).addClass('active');
                    $('.steps').fadeOut();
                    $('.step'+previousStep).fadeIn();
                }
            });
        });
    </script>
    -->




    <div class="clearfix"></div>
    <div class="">
        <div class="container">
          
            <div id="changeCompanyName" class="modal fade" role="dialog" style="z-index:999999999999999;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form class="changeCompanyName" action="{base_url()}profile/changeCompanyName" method="post">
                            <input type="hidden" name="company_id" value="{{$UserData->company_id}}" />
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title data-title">Please enter new company name</h4>
                            </div>
                            <div class="modal-body data-response">
                                <div class="form-group">
                                    <label for="company-date">New Company Name </label>
                                    <input type="text" name="new_company_name" class="form-control mylos"
                                           placeholder="New Company Name" required>
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




            {*        {if  $user['group_id'] eq 2 ||  $user['group_id'] eq 3 ||  $user['group_id'] eq 4}*}

    </div>
    <div class="clearfix"></div>
    {if isset($smarty.get.same_comp)}
        <script>
            var err = 'Account already exists on the system with that company name.  Please enter a different company name.';
            $(document).ready(function () {
                toastr.error(err);
            });
        </script>
    {/if}
    <script type="text/javascript">
        function addPhone(count, target) {
            var component = `<div class="form-group clone_line label_"` + count + ` style="border-top:1px solid #ddd;padding-top: 20px;">
            <div class="col-md-6" style="padding-left: 0;">
                <div class="form-group">
                    <label for="company-status" class="round"> Full Name </label>
                    <input type="text" name="` + target + `[fullname][` + count + `][]" id="company-status" class="form-control mylos" required >
                </div>
                <div class="form-group">
                    <div class="list_of_person_type">
                        <div class="form-group has-suggestion">
                            <label for="company-ext" class="fill">Person Type </label>
                            <select class="selectpicker form-control show-menu-arrow mylos mb-20 add_new_person_type" name="` + target + `[person_type][` + count + `][]" data-live-search="true" data-selected-text-format="count > 1" title="Person Type">
                                {if $person_type}{foreach $person_type as $key => $value}
                                <option value="{$value->id}">{$value->name}</option>
                                {/foreach}{/if}
                            </select>
                        </div>
                    </div>

                </div>    
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-9">
                            <label for="company-status" class="round"> Email</label>
                            <input type="text" name="` + target + `[email][` + count + `][]" id="company-status" class="form-control mylos" required>
                        </div>
                        <div class="col-md-3 no-padding">
                            <label class="round">&nbsp;</label>
                            <button type="button" class="btn btn-success " >Invite</button>
                        </div>
                    </div>

                </div>
                <div class="form-group">
                    <div class="col-md-4 no-padding" >
                        <button type="button"  class="btn btn-danger remove-item-phone" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"> Delete</button>
                    </div>
                </div>                                           
            </div>
            <div class="col-md-6 " style="padding-right: 0;">
                <div class="form-group copiered_` + target + `">
                    <label for="company-phone" class="round"> Phone </label>
                    <input type="hidden" name="` + target + `[code][` + count + `][]" class="dial-code" value="{$UserData->country_code}">
                    <input type="phone" name="` + target + `[phone][` + count + `][]"  class="form-control inputmask phone mylos" data-co="{$UserData->country_code}" required >
                </div>            
                <div class="form-group">
                    <div>
                        <div class="col-md-5 no-padding" style="padding-right: 10px;">
                            <label for="company-ext" class="fill"> Phone Type </label>
                            <select class="selectpicker form-control show-menu-arrow mylos" name="` + target + `[phone_type][` + count + `][]" data-live-search="true" data-selected-text-format="count > 1" title="Type">
                                {if $phone_type}{foreach $phone_type as $key => $value}
                                <option value="{$value->id}">{$value->name}</option>
                                {/foreach}{/if}
                            </select>
                        </div>
                        <div class="col-md-7 no-padding">
                            <label for="company-ext" class="fill"> Ext </label>
                            <input type="text" name="` + target + `[ext][` + count + `][]" id="company-ext" class="form-control mylos">
                        </div>
                    </div>
                </div>

            </div>
            <div class="clearfix"></div>
        </div>`;
            return component;
        }
    </script>


{literal}
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(document).ready(function (ev) {
            $("#company-name").autocomplete({
                source: "https://makromedicine.com/demo/search-company/",
                // source: availableTags,
                minLength: 2
            });

            $("#company-date").datepicker({
                dateFormat: "dd-mm-yy",
                changeMonth: true,
                changeYear: true,
                yearRange: '1940:2020',
            });
        });
    </script>
{/literal}


    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFH8I3kyiSc5ZOCMFnRoKyDipc3yTFoKQ&libraries=places&callback=initAutocomplete"
            async defer></script>
    <script>
        {if $get_confirm_status eq false}
        {if $UserData->status eq 0}
        // $('#comfirmAccount').modal();

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
                    var myLatLng = {lat: parseFloat(reg[0]), lng: parseFloat(reg[1])};
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

        var social1 = true;
        var social2 = true;
        var social3 = true;
        var social4 = true;
        var web = true;



        $(document).ready(function () {


            {literal}
            $(document).on('click', '.send-us-certifcate', function () {
                toastr.info('Your information has been sent successfully. We will send your information but after checking.');
            });
            $(document).on('click', '.remove-image', function (e) {
                e.preventDefault();

                var ask=confirm('Are you sure?');

                if(ask){
                    var attr = $(this).attr('data-id');
                    var user_id = $(this).attr('user-id');
                    $.ajax({
                        type: 'POST',
                        url: site_url + 'profile/deleteimg/',
                        data: {'value' : attr, 'user_id': user_id},
                        cache: false,
                        success: function (data) {
                            if (data == 'true') {
                                $('.bitrix.block_' + attr).remove();
                                $('.standart option[value="' + attr + '"]').removeAttr('selected').prop('selected', false);
                                $('.standart').selectpicker('refresh');
                                toastr.success('This image delete successful !');

                            } else {
                                toastr.danger('Can not delete this image !');
                            }
                        }
                    });
                }

                e.preventDefault();
                return false;
            });
            $(document).on('click', '.upload-btn-box', function (e) {
                e.preventDefault();
                $(this).parent().find('input[type="file"]').trigger('click');
                e.preventDefault();
                return false;
            });

            var count = 0;
            $(document).on('click', '.responsible-btn', function (ev) {
                ev.preventDefault();
                count = count + 1;
                var target = $(this).attr('data-target');
                var component = addPhone(count, target);
                var dial_codes = $('.dial-codes').val();
                $('.responsible-' + target + '-inner').append(component);
                $('.selectpicker').selectpicker('refresh');




                //    $('.inputmask.phone').inputmask({"mask": "99 999-99-99"});
                $('.phone').intlTelInput({
                    {/literal}
                    {if isset($UserData->country_code) && !empty($UserData->country_code)}
                        initialCountry: '{$UserData->country_code}',
                    {else}
                    {literal}
                    initialCountry: "auto",
                    geoIpLookup: function (callback) {
                        $.get("https://ipinfo.io", function () {
                        }, "jsonp").always(function (resp) {
                            var countryCode = resp.country;
                            callback(countryCode);
                        });
                    }
                    {/literal}
                    {/if}
                    {literal}
                });
            });
            {/literal}
            $(document).on('click', '.remove-item-phone', function () {
                if( confirm("Are you sure?") ){
                    $(this).parent().parent().parent().parent().remove();
                }
            });
            var general = {$tag_maps};
            var citynames = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                local: $.map(general, function (city) {
                    return {
                        value: city.value,
                        name: city.name
                    };
                })
            });
            $('input.tagsinput').tagsinput({
                typeaheadjs: {
                    name: 'citynames',
                    displayKey: 'name',
                    valueKey: 'name',
                    source: citynames.ttAdapter()
                }
            });
            $('.standart').change(function (e) {
                var standart = $(this).val();
                // var st_text = $(this).find('option:selected').text();
                $.each(standart, function (index, value) {
                    if (!$('.img_forece .bitrix').hasClass("block_" + value)) {
                        var st_text = $('.standart').find('option[value="' + value + '"]').text();
                        var comp = `<div class="img-upload-group bitrix block_` + value + `" var-attr="` + value + `">
                        <div class="reload-form-upload">
                            <label>
                                <input type="file" accept="image/gif, image/jpg, image/png, image/jpeg" name="userfile[` + value + `]">
                                <button type="button" class="mini-upload upload-button" data-id="{$UserData->id}" data-target="standart"></button>
                            </label>
                        </div>
                        <span title="` + st_text + `"> ` + st_text + `</span>
                    </div>`;
                        $('.img_forece').append(comp);
                    }
                });
                var valid = [];
                $('.bitrix').each(function (index, value) {
                    valid.push($(value).attr('var-attr'));
                });
                var difference = [];
                $.grep(valid, function (el) {
                    if (jQuery.inArray(el, standart) == -1) difference.push(el);
                });
                difference.forEach(function (element) {
                    $('.bitrix.block_' + element).remove();
                });


            });



            $(document).on('submit', '.userSettings', function (e) {
                e.preventDefault();
                if (social1 && social2 && social3 && social4 && web) {

                    var formData = new FormData($(this)[0]);
                    $.ajax({
                        type: 'POST',
                        url: site_url + 'profile/save/',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            toastr.success('Profile update successful !');
                            window.location.href = window.location.href;
                        }
                    });
                } else {
                    toastr.error('Form has errors');
                }
            });


            $(document).on('click', '#save-and-add-product', function(e){
                e.preventDefault();
                if (social1 && social2 && social3 && social4 && web) {

                    var formData = new FormData($(".userSettings")[0]);
                    $.ajax({
                        type: 'POST',
                        url: site_url + 'profile/save/',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            toastr.success('Profile update successful !');
                            window.location = "{site_url_multi('/')}product";
                        }
                    });
                } else {
                    toastr.error('Form has errors');
                }
            });

            $(document).on('submit', '.changeCompanyName', function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: site_url + 'profile/changeCompanyName/',
                    data: $(this).serialize(),
                    cache: false,
                    success: function (data) {
                        console.log(data);
                        if (data == 'true') {
                            $('#changeCompanyName').modal('hide');
                            toastr.success('Your succestion send successfuly');
                        } else if (data == 'same') {
                            var err = 'Account already exists on the system with that company name.  Please enter a different company name.';
                            toastr.error(err);
                        } else {
                            $('#changeCompanyName').modal('hide');
                            toastr.error('You are not permision change company name');
                        }
                    }
                });
                e.preventDefault();
                return false;
            });

            $(document).on('submit', '.changePassword', function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: site_url + 'profile/changePassword/',
                    data: $(this).serialize(),
                    cache: false,
                    success: function (data) {
                        var obj = JSON.parse(data);
                        $('#changePassword').modal('hide');
                        if (obj.type == 'success') {
                            $('#changePassword').modal('hide');
                            toastr.success(obj.message);
                        } else {
                            toastr.error(obj.message);
                        }
                    }
                });
                e.preventDefault();
                return false;
            });

            $(document).on('click', '.userphotos-change', function () {
                $('input.userphotos').click();
            });
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

        $(document).on("change", 'input[name="company_facebook"]', function () {
            var value = $(this).val();
            if (value.substring(0, 24) != 'https://www.facebook.com' && value != '' && value.substring(0, 18) != 'https://www.fb.com') {
                $(this).parent().addClass("has-error has-feedback");
                $(this).next().removeClass("glyphicon glyphicon-ok form-control-feedback");
                $(this).next().addClass("glyphicon glyphicon-remove form-control-feedback");
                social1 = false;
            } else {
                $(this).parent().removeClass("has-feedback");
                $(this).parent().removeClass("has-error");
                $(this).next().removeClass("glyphicon glyphicon-remove form-control-feedback");
                social1 = true;
            }

        });
        $(document).on("change", 'input[name="company_twitter"]', function () {
            var value = $(this).val();
            if (value.substring(0, 19) != 'https://twitter.com' && value != '' && value.substring(0, 23) != 'https://www.twitter.com') {
                $(this).parent().addClass("has-error has-feedback");
                $(this).next().removeClass("glyphicon glyphicon-ok form-control-feedback");
                $(this).next().addClass("glyphicon glyphicon-remove form-control-feedback");
                social2 = false;
            } else {
                $(this).parent().removeClass("has-feedback");
                $(this).parent().removeClass("has-error");
                $(this).next().removeClass("glyphicon glyphicon-remove form-control-feedback");
                social2 = true;
            }

        });

        $(document).on("change", 'input[name="company_youtube"]', function () {
            var value = $(this).val();
            if (value.substring(0, 23) != 'https://www.youtube.com' && value != '' && value.substring(0, 16) != 'https://youtu.be') {
                $(this).parent().addClass("has-error has-feedback");
                $(this).next().removeClass("glyphicon glyphicon-ok form-control-feedback");
                $(this).next().addClass("glyphicon glyphicon-remove form-control-feedback");
                social3 = false;
            } else {
                $(this).parent().removeClass("has-feedback");
                $(this).parent().removeClass("has-error");
                $(this).next().removeClass("glyphicon glyphicon-remove form-control-feedback");
                social3 = true;
            }

        });
        $(document).on("change", 'input[name="company_linkedin"]', function () {
            var value = $(this).val();
            if (value.substring(0, 24) != 'https://www.linkedin.com' && value != '') {
                $(this).parent().addClass("has-error has-feedback");
                $(this).next().removeClass("glyphicon glyphicon-ok form-control-feedback");
                $(this).next().addClass("glyphicon glyphicon-remove form-control-feedback");
                social4 = false;
            } else {
                $(this).parent().removeClass("has-feedback");
                $(this).parent().removeClass("has-error");
                $(this).next().removeClass("glyphicon glyphicon-remove form-control-feedback");
                social4 = true;
            }

        });


        function validURL(str) {
            var pattern = new RegExp('^(https?:\\/\\/)?' + // protocol
                '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|' + // domain name
                '((\\d{1,3}\\.){3}\\d{1,3}))' + // OR ip (v4) address
                '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*' + // port and path
                '(\\?[;&a-z\\d%_.~+=-]*)?' + // query string
                '(\\#[-a-z\\d_]*)?$', 'i'); // fragment locator
            return !!pattern.test(str);
        }

        $(document).on("change", 'input[name="website"]', function () {
            var value = $(this).val();
            if (!validURL(value) && value != '') {
                $(this).parent().addClass("has-error has-feedback");
                $(this).next().removeClass("glyphicon glyphicon-ok form-control-feedback");
                $(this).next().addClass("glyphicon glyphicon-remove form-control-feedback");
                web = false;
            } else {
                $(this).parent().removeClass("has-feedback");
                $(this).parent().removeClass("has-error");
                $(this).next().removeClass("glyphicon glyphicon-remove form-control-feedback");
                web = true;
            }

        });


       /* var somethingChanged = false;
        $('#profile .btn-group> select').on('change', function () {
            somethingChanged = true;
            console.log($(this));
        });
        $('#profile input[type="text"]').on('keyup', function () {
            somethingChanged = true;
            console.log($(this));
        });
        $('#profile textarea').on('keyup', function () {
            somethingChanged = true;
            console.log($(this));
        });

        $(window).bind('beforeunload', function (e) {
            if ($(e.target.activeElement).attr('type') != 'submit' && somethingChanged) {
                return 'You have unsaved changes; are you sure you want to leave this page?';
            }
        });*/


        // File preview on upload
        /*document.getElementById("company_logo").onchange = function () {
            var reader = new FileReader();

            reader.onload = function (e) {
                // get loaded data and render thumbnail.
                document.getElementById("company_logo_wrapper").style.backgroundImage = "url('"+e.target.result+"')";
            };

            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        };*/

        /*document.getElementById("company_banner").onchange = function () {
            var reader = new FileReader();

            reader.onload = function (e) {
                // get loaded data and render thumbnail.
                document.getElementById("company_cover_wrapper").style.backgroundImage = "url('"+e.target.result+"')";
            };

            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        };*/




        {/literal}
    </script>

{literal}
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!--<link rel="stylesheet" href="/resources/demos/style.css">
<script>
$( function() {
    // Single Select
    $( "#company-name" ).autocomplete({
        source: function( request, response ) {
            // Fetch data
            $.ajax({
                url: site_url+"search-company?term="+request.term,
                // type: 'post',
                dataType: "json",
                success: function( data ) {
                    response( data );
                }
            });
        },
    });
});

</script>-->
{/literal}


{/block}
