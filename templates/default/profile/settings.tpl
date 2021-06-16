{extends file=$layout}
{block name=content}
    <link rel="stylesheet" href="{base_url('templates/default/assets/css/prefix-style.css')}" media="all">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">


    <div class="n_content_area full_width">
<a href="#" id="openMenu" class="accounts-menu-float">Menu</a>

        <div class="container-fluid">
            <div class="all_modals full_width">






                <div id="changePassword" class="modal fade" role="dialog" >
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

                                    <a href="#" class="fr_pass"  data-dismiss="modal" onclick="$('#forgetPasswordAuth').modal();">Forgot your password?</a>
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
            {* {if (($UserData->status neq 1  && $user['group_id'] eq 2 ) && (  $user['group_id'] eq 3 ||  $user['group_id'] eq 4))}
                <div class="alert alert-warning" style="margin-top: 10px;margin-bottom:0">
                    Please <a href="javascript:;" onclick="$('#comfirmAccount').modal();">upload a
                        certificate.</a> After the confirmation of certificate your account will be approved and
                    your products will appear on the top rank of the search list.
                </div>
            {/if} *}

            <form class="userphotos_form" action="{base_url()}profile/userphotos" method="post">
                <input type="file" style="display:none;" accept="image/*" name="userphotos" class="userphotos"/>
            </form>

            <div class="row">

                    {include file='../profile/sidebar.tpl'}

                    <div class="n_right_section start_with_text">
                        <div class="with_buttons full_width">
                            <h2>PROFILE INFORMATION</h2>
                            <a href="#" onclick="$('#changePassword').modal();">Change password</a>
                            
                        </div><!-- /.with_buttons -->

                        <div class="full_width max-arrange">
                            <form class="userSettings userSettingsCenter" action="{base_url()}profile/save" enctype="multipart/form-data"
                                  method="post">

                                <input type="hidden" name="apply_company" id="apply_company" value="0" />

                            <div class="n_like_form full_width">
                                <div class="n_first_block">
                                    {$explode_fullname=explode(' ', trim($UserData->fullname))}
                                    <input type="hidden" class="fullname" name="fullname" value="{$UserData->fullname}" />

                                    <div class="full_width">
                                        <label>Name <sup>*</sup></label>
                                        <input type="text" name="name" class="name append_value_onchange onlyalphabet"
                                            data-group="name,surname" data-target="fullname" data-glue=" "
                                            value="{trim($explode_fullname[0])}" required
                                            {if (isset($confirm_data->id) && $confirm_data->status==1 ) && isset($confirm_data->name)}  readonly {/if} />
                                        <input type="hidden" name="group_id" value="{$UserData->user_groups_id}">
                                    </div>
                                    <!-- /.full_width -->

                                    <div class="full_width">
                                        <label>Surname <sup>*</sup></label>
                                        <input type="text" name="surname"
                                            class="surname append_value_onchange onlyalphabet" data-group="name,surname"
                                            data-target="fullname" data-glue=" "
                                            value="{if isset($explode_fullname[1]) } {trim($explode_fullname[1])} {/if}"
                                            required {if (isset($confirm_data->id) && $confirm_data->status==1 ) && isset($confirm_data->surname)} readonly {/if} />
                                    </div><!-- /.full_width -->

                                    <div class="full_width date_of_brth flex direction_column">
                                        <label>Date of Birth</label>

                                        <div class="flex ">
                                            <div class="flex">


                                                {$bithday=(!empty($UserData->brith_day)) ? explode('-', $UserData->brith_day) : ['',date('Y'), '']}


                                                <input type="number" name="b_day"
                                                       class="form_input day_input "
                                                       value="{$bithday[0]}" min="1" max="31" maxlength="2" placeholder="Day" />

                                                <select class="form_input month_input " name="b_month" >
                                                    <option value="">Month</option>
                                                    {foreach $month_list as $k => $v}

                                                        <option value="{{$k}}" {if $k==$bithday[1]}selected{/if} >{{$v}}</option>
                                                    {/foreach}

                                                </select>

                                                <input type="number" min="1900" name="b_year"  max="{date('Y')}" minlength="4" maxlength="4"
                                                       class="form_input year_input "
                                                       value="{$bithday[2]}" placeholder="Year">

                                            </div>

                                            <div class="drop_cstm adj" >
                                                <input type="hidden" value="{$UserData->display_dob}" name="display_dob" id="datesetValInput">
                                                <button type="button" id="datesetVal" class="setVal"><span>
                                                    {if $UserData->display_dob == 1}
                                                        <img src="{base_url('templates/default/assets/images/icons/earth_.png')}"
                                                             alt="Public">
                                                {else}
                                                <img src="{base_url('templates/default/assets/images/icons/lock_.png')}"
                                                     alt="Private">
                                                    {/if}
                                                    </span>
                                                    <img src="{base_url('templates/default/assets/images/icons/drp_arw.png')}"/>
                                                </button>
                                                <div class="drop_down_select_ getVal" id="dategetVal">
                                                    <h1>Who should see this ?</h1>
                                                    <ul>
                                                        <li data-display="0">
                                                            <img src="{base_url('templates/default/assets/images/icons/lock_.png')}"
                                                                 alt="img"> <span class="data">
                                                <h3>Private</h3>
                                                <p>Only you can see</p>
                                                </span></li>
                                                        <li data-display="1">
                                                            <img src="{base_url('templates/default/assets/images/icons/earth_.png')}"
                                                                 alt="Public"> <span class="data">
                                                <h3>Public</h3>
                                                <p>Anyone can see</p>
                                                </span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="full_width">
                                        <label>E-mail <sup>*</sup></label>
                                        <input type="text" value="{$UserData->email}" name="email" id="company-mail" readonly/>

                                        <div class="drop_cstm adj" >
                                            <input type="hidden" value="{$UserData->display_email}" name="display_email" id="emailsetValInput">

                                            <button type="button" id="emailsetVal2" class="setVal"><span>
                                                    <img class="emailsetValIcon"
                                                            {if $UserData->display_email == 1}
                                                                src="{base_url('templates/default/assets/images/icons/earth_.png')}"
                                                                alt="Public"
                                                            {else}
                                                                src="{base_url('templates/default/assets/images/icons/lock_.png')}"
                                                                alt="Private"
                                                            {/if}
                                                            alt="Public"></span>
                                                <img src="{base_url('templates/default/assets/images/icons/drp_arw.png')}" />
                                            </button>
                                            <div class="drop_down_select_ getVal" id="emailgetVal2">
                                                <h1>Who should see this ?</h1>
                                                <ul>
                                                    <li data-display="0">
                                                        <img src="{base_url('templates/default/assets/images/icons/lock_.png')}" alt="img"> <span class="data">
                                                <h3>Private</h3>
                                                <p>Only you can see</p>
                                                </span></li>
                                                    <li data-display="1">
                                                        <img src="{base_url('templates/default/assets/images/icons/earth_.png')}" alt="Public"> <span class="data">
                                                <h3>Public</h3>
                                                <p>Anyone can see</p>
                                                </span></li>
                                                </ul>
                                            </div>
                                        </div>



                                    </div><!-- /.full_width -->



                                    <div class="full_width flex">

                                        <div class="flex align_center">

                                            <div class="flex direction_column">

                                                <label>Phone Number <sup>*</sup></label>
                                                <input type="hidden" name="country_code" class="dial-up"
                                                       value="{if empty($company->code)}{$UserData->country_code}{else}{$UserData->country_code}{/if}">

                                                <div class="flex">

                                                    <input type="tel" name="phone" id="phone"
                                                           class="  inputmask phone"
                                                           value="{$UserData->phone}"
                                                           data-co="{$UserData->country_code}" required>
                                                </div>

                                            </div>


                                            <div class="drop_cstm adj" >

                                                <input type="hidden" value="{$UserData->display_phone}" name="display_phone" id="phonesetValInput">

                                                <button type="button" id="phonesetVal2" class="setVal"><span>
                                                    <img
                                                            {if $UserData->display_phone == 1}
                                                                src="{base_url('templates/default/assets/images/icons/earth_.png')}"
                                                                alt="Public"
                                                            {else}
                                                                src="{base_url('templates/default/assets/images/icons/lock_.png')}"
                                                                alt="Private"
                                                            {/if}
                                                         alt="Public">
                                                </span>
                                                    <img src="{base_url('templates/default/assets/images/icons/drp_arw.png')}" />
                                                </button>
                                                <div class="drop_down_select_ getVal" id="phonegetVal2">
                                                    <h1>Who should see this ?</h1>
                                                    <ul>
                                                        <li data-display="0">
                                                            <img src="{base_url('templates/default/assets/images/icons/lock_.png')}" alt="img"> <span class="data">
                                                <h3>Private</h3>
                                                <p>Only you can see</p>
                                                </span></li>
                                                        <li data-display="1">
                                                            <img src="{base_url('templates/default/assets/images/icons/earth_.png')}" alt="Public"> <span class="data">
                                                <h3>Public</h3>
                                                <p>Anyone can see</p>
                                                </span></li>
                                                    </ul>
                                                </div>
                                            </div>

                                        </div>



                                    </div><!-- /.full_width -->



                                </div><!-- /.n_first_block -->

                                <div class="n_second_block">

                                    <div class="full_width">
                                        <label>Your Address</label>
                                        <input id="pac-input" type="text" name="address" value="{$UserData->adress}" />
                                    </div><!-- /.full_width -->

                                    <div class="full_width map_2">
                                        <div class="full_width" style="height: 135px;" id="map"></div>
                                    </div><!-- map__-->

                                    <div class="full_width" >
                                        <label>Country <sup>*</sup></label>

                                        <select class="selectpicker form-control show-menu-arrow mylos company-country"
                                                name="country_id" data-live-search="true"
                                                data-selected-text-format="count > 1" title="Country" >
                                            {if $countrys}{foreach $countrys as $key => $value}
                                                <option value="{$value->id}" data-name="{$value->code}"
                                                        {if $value->id == $UserData->country_id }selected{/if}>{$value->name}</option>
                                            {/foreach}{/if}
                                        </select>
                                    </div><!-- /.full_width -->






                                </div><!-- /.n_second_block -->
                            </div><!-- /.n_like_form -->

                            <hr class="thrx">

                            <div class="full_width n_txt n_like_form">
                                <label>Personal Info</label>
                                <textarea name="personal_info" id="personal_info">{$UserData->personal_info}</textarea>
                            </div>

                            <div class="comon_h3 full_width social_info_box">
                                <h3>work experience</h3>
                            </div><!-- /.personal_info -->

                            <div class="n_like_form full_width">
                                <div class="n_first_block p-right">
                                    <label>Experience</label>
                                    <select class="form_input full_width " name="work_experience">
                                        {foreach $work_experiences as $k => $v}

                                            <option value="{{$k}}" {if $k==$UserData->work_experience}selected{/if} >{{$v}}</option>
                                        {/foreach}

                                    </select>

                                    <hr class="thrx">
                                </div>
                            </div>


                            <div class="n_like_form full_width">

                                {if !empty($work_history)}

                                    {foreach $work_history as $k => $v}
                                        <div class="companies_cloned_box">

                                            <div class="flex full_width companies_clone_title align_center">
                                                <div class="flex align_center delete_add_work_place">
                                                    <button type="button"
                                                        class="add_remove_work_place add_new_work_place "></button>
                                                    <button type="button"
                                                        class="add_remove_work_place remove_work_place "></button>
                                                </div>
                                                <input type="hidden" name="rel_main_id[]" class="rel_main_id" value="{$v['rel_main_id']}"  />
                                                <h3>Place of work <span class="work_place_counter">{$k+1}</span></h3>

                                                <input type="hidden" name="appllied_company[]" value="{$v['company_id']}" class="appllied_company" />
                                                <input type="hidden" name="until_now[]" value="{if empty($v['end_date']) || $v['end_date']=='0000-00-00'} 1 {else} 0 {/if}" class="until_now" />

                                                <div class="drop_cstm adj" >
                                                    <input type="hidden" value="{$v['display_company']}" name="show_place_work[]" >
                                                    <button type="button" id="datesetVal" class="setVal"><span>
                                                {if $v['display_company'] == 1}
                                                    <img src="{base_url('templates/default/assets/images/icons/earth_.png')}"
                                                         alt="Public">
                                            {else}
                                            <img src="{base_url('templates/default/assets/images/icons/lock_.png')}"
                                                 alt="Private">
                                                {/if}
                                                </span>
                                                        <img src="{base_url('templates/default/assets/images/icons/drp_arw.png')}"/>
                                                    </button>
                                                    <div class="drop_down_select_ getVal" id="dategetVal">
                                                        <h1>Who should see this ?</h1>
                                                        <ul>
                                                            <li data-display="0">
                                                                <img src="{base_url('templates/default/assets/images/icons/lock_.png')}"
                                                                     alt="img"> <span class="data">
                                            <h3>Private</h3>
                                            <p>Only you can see</p>
                                            </span></li>
                                                            <li data-display="1">
                                                                <img src="{base_url('templates/default/assets/images/icons/earth_.png')}"
                                                                     alt="Public"> <span class="data">
                                            <h3>Public</h3>
                                            <p>Anyone can see</p>
                                            </span></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="full_width   ">
                                                <label>Industry <sup>*</sup></label>
                                                <select class="selectpicker show-menu-arrow required" name="industry_ids[]"
                                                    data-live-search="true" data-selected-text-format="count > 1"
                                                    title="Industry">
                                                    {if $industries}
                                                        {foreach $industries as $key => $value}
                                                            <option value="{$value->id}"
                                                        {if $value->id==$v['industry_id']} selected {/if}>{$value->name}</option>
                                                        {/foreach}
                                                    {/if}
                                                </select>
                                            </div>


                                            <div class="full_width">
                                                <label>Company Name <sup>*</sup></label>
                                                <div class="full_width flex">
                                                    <input type="text" name="company_names[]" value="{$v['company_name']}" class="company_names" readonly />
                                                    <a href="#" class="change_company_name_btn" data-id="{$v['company_id']}" >Change</a>
                                                </div>

                                            </div>

                                            <div class="full_width">
                                                <label>Country <sup>*</sup></label>

                                                <select class="selectpicker form-control show-menu-arrow mylos company-country required"
                                                        name="country_ids[]" data-live-search="true"
                                                        data-selected-text-format="count > 1" title="Country" required  >
                                                    {if $countrys}{foreach $countrys as $key => $value}
                                                        <option value="{$value->id}" {if $value->id==$v['company_country_id']} selected {/if}  data-name="{$value->code}" >{$value->name}</option>
                                                    {/foreach}{/if}
                                                </select>
                                                {*<input type="hidden" name="country_ids[]" value="{$v['company_country_id']}" class="remove_item_after_clone" />*}
                                            </div>

                                            <div class="full_width">
                                                <label>Your Position <sup>*</sup></label>

                                                <select class="selectpicker form-control show-menu-arrow mylos add_new_person_type required"
                                                        name="positions[]"  data-live-search="true"
                                                        data-selected-text-format="count > 1" title="Position" required >
                                                    {if $person_type}{foreach $person_type as $key => $value}
                                                        <option value="{$value->id}" {if $value->id==$v['position']} selected {/if} >{$value->name}</option>
                                                    {/foreach}{/if}
                                                </select>

                                            </div><!-- /.full_width -->

                                            <div class="full_width date_of_brth flex direction_column">
                                                <label>Date From <sup>*</sup></label>

                                                {$from_date=(!empty($v['start_date']) && $v['start_date']!="0000-00-00") ? explode('-', $v['start_date']) : ['',date('Y'), '']}

                                                <div class="flex ">
                                                    <div class="flex">

                                                        <input type="number" name="from_days[]"
                                                               class="form_input day_input " value="{$from_date[2]}"
                                                               min="1" max="31" maxlength="2"  placeholder="Day" required />

                                                        <select class="form_input month_input " name="from_month[]" required>
                                                            <option value="">Month</option>
                                                            {foreach $month_list as $k => $v}
                                                                <option value="{{$k}}" {if $k==$from_date[1]}selected{/if}  >{{$v}}</option>
                                                            {/foreach}

                                                        </select>

                                                        <input type="number"
                                                               class="form_input year_input " name="from_years[]" value="{$from_date[0]}"
                                                               min="1900"  max="{date('Y')}" minlength="4" maxlength="4" placeholder="Year" required >

                                                    </div>


                                                </div>
                                            </div>

                                            <div class="full_width date_of_brth flex direction_column">
                                                <label>Date To <sup>*</sup></label>

                                                {$to_date=(!empty($v['end_date']) && $v['end_date']!="0000-00-00") ? explode('-', $v['end_date']) : ['',date('Y'), '']}

                                                <div class="flex ">
                                                    <div class="flex">

                                                        <input type="number" name="to_days[]" value="{$to_date[2]}"
                                                               class="form_input day_input  to_date_input" {if empty($v['end_date']) || $v['end_date']=='0000-00-00'} style="display: none" {else} required {/if}
                                                               min="1" max="31" maxlength="2" placeholder="Day" >

                                                        <select class="form_input month_input  to_date_input"  name="to_month[]" {if empty($v['end_date']) || $v['end_date']=='0000-00-00'} style="display: none" {else} required  {/if} >
                                                            <option value="" >Month</option>
                                                            {foreach $month_list as $k => $v}
                                                                <option value="{{$k}}" {if $k==$to_date[1]}selected{/if} >{{$v}}</option>
                                                            {/foreach}

                                                        </select>

                                                        <input type="number"
                                                               class="form_input year_input  to_date_input" name="to_years[]" value="{$to_date[0]}" {if empty($v['end_date']) || $v['end_date']=='0000-00-00'} style="display: none" {else} required  {/if}
                                                               min="1900"  max="{date('Y')}" minlength="4" maxlength="4" placeholder="Year" />

                                                    </div>


                                                </div>
                                            </div>

                                            <div class="full_width n_checkbox">
                                                <label class="new_checkbox flex align_center" >
                                                    <input type="checkbox" name="" {if empty($v['end_date']) || $v['end_date']=='0000-00-00'}checked{/if} value="1" class="work_place_until_now">
                                                    <span>Until now</span>
                                                </label>
                                            </div>



                                        </div>
                                    {/foreach}
                                {else}
                                    <div class="companies_cloned_box">

                                        <div class="flex full_width companies_clone_title align_center">
                                            <div class="flex align_center delete_add_work_place">
                                                <button type="button"
                                                    class="add_remove_work_place add_new_work_place "></button>
                                                <button type="button"
                                                    class="add_remove_work_place remove_work_place "></button>
                                            </div>

                                            <h3>Place of work <span class="work_place_counter">1</span></h3>

                                            <input type="hidden" name="appllied_company[]" class="appllied_company" />
                                            <input type="hidden" name="until_now[]" value="0" class="until_now" />

                                            <div class="drop_cstm adj" >
                                                <input type="hidden" value="0" name="show_place_work[]" >
                                                <button type="button" id="datesetVal" class="setVal"><span>
                                                {if $UserData->display_dob == 1}
                                                    <img src="{base_url('templates/default/assets/images/icons/earth_.png')}"
                                                         alt="Public">
                                            {else}
                                            <img src="{base_url('templates/default/assets/images/icons/lock_.png')}"
                                                 alt="Private">
                                                {/if}
                                                </span>
                                                    <img src="{base_url('templates/default/assets/images/icons/drp_arw.png')}"/>
                                                </button>
                                                <div class="drop_down_select_ getVal" id="dategetVal">
                                                    <h1>Who should see this ?</h1>
                                                    <ul>
                                                        <li data-display="0">
                                                            <img src="{base_url('templates/default/assets/images/icons/lock_.png')}"
                                                                 alt="img"> <span class="data">
                                            <h3>Private</h3>
                                            <p>Only you can see</p>
                                            </span></li>
                                                        <li data-display="1">
                                                            <img src="{base_url('templates/default/assets/images/icons/earth_.png')}"
                                                                 alt="Public"> <span class="data">
                                            <h3>Public</h3>
                                            <p>Anyone can see</p>
                                            </span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="full_width   ">
                                            <label>Industry <sup>*</sup></label>
                                            <select class="selectpicker show-menu-arrow " name="industry_ids[]"
                                                data-live-search="true" data-selected-text-format="count > 1"
                                                title="Industry">
                                                {if $industries}
                                                    {foreach $industries as $key => $value}
                                                        <option value="{$value->id}" >{$value->name}</option>
                                                        {/foreach}
                                                    {/if}
                                            </select>
                                        </div>


                                        <div class="full_width">
                                            <label>Company Name <sup>*</sup></label>
                                            <input type="text" name="company_names[]" class="company_names "  />

                                        </div>

                                        <div class="full_width">
                                            <label>Country <sup>*</sup></label>

                                            <select class="selectpicker form-control show-menu-arrow mylos company-country "
                                                    name="country_ids[]" data-live-search="true"
                                                    data-selected-text-format="count > 1" title="Country"  >
                                                {if $countrys}{foreach $countrys as $key => $value}
                                                    <option value="{$value->id}"  data-name="{$value->code}" >{$value->name}</option>
                                                {/foreach}{/if}
                                            </select>
                                        </div>

                                        <div class="full_width">
                                            <label>Your Position <sup>*</sup></label>

                                            <select class="selectpicker form-control show-menu-arrow mylos add_new_person_type "
                                                    name="positions[]"  data-live-search="true"
                                                    data-selected-text-format="count > 1" title="Position"  >
                                                {if $person_type}{foreach $person_type as $key => $value}
                                                    <option value="{$value->id}" >{$value->name}</option>
                                                {/foreach}{/if}
                                            </select>

                                        </div><!-- /.full_width -->

                                        <div class="full_width date_of_brth flex direction_column">
                                            <label>Date From <sup>*</sup></label>

                                            <div class="flex ">
                                                <div class="flex">

                                                    <input type="number" name="from_days[]"
                                                           class="form_input day_input "
                                                           min="1" max="31" maxlength="2" placeholder="Day"  />

                                                    <select class="form_input month_input " name="from_month[]" >
                                                        <option value="">Month</option>
                                                        {foreach $month_list as $k => $v}
                                                            <option value="{{$k}}"  >{{$v}}</option>
                                                        {/foreach}

                                                    </select>

                                                    <input type="number"
                                                           class="form_input year_input " name="from_years[]"
                                                           min="1900"  max="{date('Y')}" minlength="4" maxlength="4"  placeholder="Year"  />

                                                </div>


                                            </div>
                                        </div>

                                        <div class="full_width date_of_brth flex direction_column">
                                            <label>Date To <sup>*</sup></label>

                                            <div class="flex ">
                                                <div class="flex">

                                                    <input type="number" name="to_days[]"
                                                           class="form_input day_input  to_date_input"
                                                           min="1" max="31" maxlength="2" placeholder="Day" />

                                                    <select class="form_input month_input  to_date_input" name="to_month[]" >
                                                        <option value="">Month</option>
                                                        {foreach $month_list as $k => $v}
                                                            <option value="{{$k}}" >{{$v}}</option>
                                                        {/foreach}

                                                    </select>

                                                    <input type="number"
                                                           class="form_input year_input  to_date_input" name="to_years[]"
                                                           min="1900"  max="{date('Y')}" minlength="4" maxlength="4" placeholder="Year" />

                                                </div>


                                            </div>
                                        </div>

                                        <div class="full_width n_checkbox">
                                            <label class="new_checkbox flex align_center" >
                                                <input type="checkbox" name=""  value="1" class="work_place_until_now">
                                                <span>Until now</span>
                                            </label>
                                        </div>



                                    </div>
                                {/if}


                            </div>




                            <div class="comon_h3 full_width social_info_box">
                                <h3>SOCIAL INFORMATION</h3>
                            </div><!-- /.personal_info -->
                            <div class="full_width n_like_form">
                                <div class="n_first_block">
                                    <div class="full_width">
                                        <label>Facebook</label>
                                        <input type="text" name="facebook" value="{$UserData->facebook}" />
                                    </div><!-- /.full_width -->
                                    <div class="full_width">
                                        <label>Youtube</label>
                                        <input type="text" name="youtube" value="{$UserData->youtube}"/>
                                    </div><!-- /.full_width -->
                                </div><!-- /.n_first_block -->

                                <div class="n_second_block">
                                    <div class="full_width">
                                        <label>Twitter</label>
                                        <input type="text" name="twitter" value="{$UserData->twitter}"/>
                                    </div><!-- /.full_width -->
                                    <div class="full_width">
                                        <label>Linkedin</label>
                                        <input type="text" name="linkedin" value="{$UserData->linkedin}"/>
                                    </div><!-- /.full_width -->
                                </div><!-- /.n_first_block -->
                            </div><!-- /.full_width -->

                            <div class="btn_wrap flex justify_center align_center full_width">
                                <a href="{site_url_multi('/')}profile" class="flex n_cancel">Cancel</a>
                                <input type="submit" value="Save" class="n_save">
                            </div><!-- /.btn_wrap -->
                            </form>
                        </div><!-- /.max_arrange -->

                    </div><!-- /.n_right_section -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->

    </div>
    <!-- /.n_content_area -->


    <script type="text/javascript">
        function addPhone(count, target) {
            var component = `<div class="form-group label_"` + count + ` style="border-top:1px solid #ddd;padding-top: 20px;">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="company-status" class="round"> Full Name </label>
                    <input type="text" name="` + target + `[fullname][` + count + `][]" id="company-status" class="form-control mylos" >
                </div>
                <div class="form-group copiered_` + target + `">
                    <label for="company-phone" class="round"> Phone </label>
                    <input type="hidden" name="` + target + `[code][` + count + `][]" class="dial-code" value="{$UserData->country_code}">
                    <input type="phone" name="` + target + `[phone][` + count + `][]" id="phone" class="form-control inputmask phone mylos"  value="">
                </div>
            </div>
            <div class="col-md-4 no-padding">
                <div class="form-group">
                    <label for="company-status" class="round"> Email </label>
                    <input type="text" name="` + target + `[email][` + count + `][]" id="company-status" class="form-control mylos" >
                </div>
                <div class="form-group">
                    <label for="company-ext" class="fill"> Type </label>
                    <select class="selectpicker form-control show-menu-arrow mylos" name="` + target + `[phone_type][` + count + `][]" data-live-search="true" data-selected-text-format="count > 1" title="Type">
                        {if $phone_type}{foreach $phone_type as $key => $value}
                        <option value="{$value->id}">{$value->name}</option>
                        {/foreach}{/if}
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <div class="form-group has-suggestion">
                        <label for="company-ext" class="fill">Person Type </label>
                        <select class="selectpicker form-control show-menu-arrow mylos" name="` + target + `[person_type][` + count + `][]" data-live-search="true" data-selected-text-format="count > 1" title="Person Type">
                            {if $person_type}{foreach $person_type as $key => $value}
                            <option value="{$value->id}">{$value->name}</option>
                            {/foreach}{/if}
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-9 no-padding">
                        <label for="company-ext" class="fill"> Ext </label>
                        <input type="text" name="` + target + `[ext][` + count + `][]" id="company-ext" class="form-control mylos">
                    </div>
                    <div class="col-md-3 no-padding" style="padding-top:20px;padding-right:10px;">
                        <button type="button" style="height: 31px;" class="btn btn-danger btn-bix pull-right remove-item-phone" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"> <i class="fa fa-trash"></i> </button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>`;
            return component;
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFH8I3kyiSc5ZOCMFnRoKyDipc3yTFoKQ&libraries=places&callback=initAutocomplete"
            async defer></script>
    <script>
        {if $get_confirm_status eq false}
        {if $UserData->status eq 0}
            // $('#comfirmAccount').modal();
        {/if}
        {/if}
        {if !empty($UserData->lat) || !empty($UserData->lng)}
        var json_lat = {$UserData->lat};
        var json_lng = {$UserData->lng};
        var json_title = '{$UserData->adress}';
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
                    /* markers.push(new google.maps.Marker({
                        map: map,
                        icon: icon,
                        title: place.name,
                        position: place.geometry.location
                    })); */
                    $('.lat').val(place.geometry.location.lat());
                    $('.lng').val(place.geometry.location.lng());
                    if (place.geometry.viewport) {
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                // map.fitBounds(bounds);
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
                            /*markers.push(new google.maps.Marker({
                                map: map,
                                icon: icon,
                                title: place.name,
                                position: place.geometry.location
                            }));*/
                            $('.lat').val(place.geometry.location.lat());
                            $('.lng').val(place.geometry.location.lng());
                            if (place.geometry.viewport) {
                                bounds.union(place.geometry.viewport);
                            } else {
                                bounds.extend(place.geometry.location);
                            }
                        });
                        // map.fitBounds(bounds);
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
                var attr = $(this).attr('data-id');
                var user_id = $(this).attr('user-id');
                $.ajax({
                    type: 'POST',
                    url: site_url + 'profile/deleteimg/',
                    data: {'value': attr, 'user_id': user_id},
                    cache: false,
                    success: function (data) {
                        if (data == 'true') {
                            $('.bitrix.block_' + attr).remove();
                            $('.standart option[value="' + attr + '"]').removeAttr('selected');
                            $('.selectpicker').selectpicker();
                            toastr.success('This image delete successful !');
                        } else {
                            toastr.danger('Can not delete this image !');
                        }
                    }
                });
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
            $(document).on('click', '.responsible-btn', function () {
                count = count + 1;
                var target = $(this).attr('data-target');
                var component = addPhone(count, target);
                var dial_codes = $('.dial-codes').val();
                $('.responsible-' + target + '-inner').append(component);
                $('.selectpicker').selectpicker();
                //    $('.inputmask.phone').inputmask({"mask": "99 999-99-99"});
                phoneInput();
            });
            {/literal}
            $(document).on('click', '.remove-item-phone', function () {
                $(this).parent().parent().parent().parent().remove();
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
                                <input type="file" name="userfile[` + value + `]" accept="image/gif, image/jpg, image/png, image/jpeg">
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
                    var has_error=false;

                    $(this).find('input.required, textarea.required, select.required, .company_names').each(function () {
                        var val_=$.trim($(this).val());

                        if(val_.length == 0){
                            has_error=true;
                        }

                    });



                    if(!has_error){
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

                    }else {
                        toastr.error('Please, fill all required fields');
                    }

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
                            $('#comfirmAccount').modal('hide');
                            $('.left-button-area button').removeAttr('onclick').addClass('send-us-certifcate').text('Send your information');
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
                            $('#n_profile_img_uploaded').attr('src', site_url + 'uploads/catalog/users/' + data);
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

        $(document).on("change", 'input[name="facebook"]', function () {
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
        $(document).on("change", 'input[name="twitter"]', function () {
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

        $(document).on("change", 'input[name="youtube"]', function () {
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
        $(document).on("change", 'input[name="linkedin"]', function () {
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


        var somethingChanged = false;
        $('#profile .btn-group> select').on('change', function () {
            somethingChanged = true;
        });
        $('#profile input[type="text"]').on('keyup', function () {
            somethingChanged = true;
        });
        $('#profile textarea').on('keyup', function () {
            somethingChanged = true;
        });
        $(window).bind('beforeunload', function (e) {
            if ($(e.target.activeElement).attr('type') != 'submit' && somethingChanged) {
                return 'You have unsaved changes; are you sure you want to leave this page?';
            }
        });

        {/literal}
    </script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(document).ready(function(ev) {
            var comName = $('.company-input-box').val();
            if(comName.length < 2) {
                $('.company-warning-box').fadeIn();
            } else { 
                $('.company-warning-box').fadeOut();
            }

            $('.company-input-box').on('change', function(ev) {
                var comName_1 = $('.company-input-box').val();
                    if(comName.length > 2) {
                    $('.company-warning-box').fadeOut();
                }
            });




            $("#company-date").datepicker({
                dateFormat: "dd-mm-yy",
                changeMonth: true,
                changeYear: true,
                yearRange: '1940:2020',
            });
        });

        $(function(){

            /**/
            $('.setVal').on('click',function(e){
                e.preventDefault();
                e.stopPropagation();

                var bu=$(this),
                    parent=bu.parents('.drop_cstm'),
                    drop_down=parent.find('.drop_down_select_');

                $('.drop_cstm').not(parent).removeClass('top_index');
                $('.drop_down_select_').not(drop_down).removeClass('active');

                drop_down.toggleClass('active');
                parent.toggleClass('top_index');

            });

            $('.getVal ul li').on('click', function(e){
                e.preventDefault();

                var bu=$(this),
                    parent=bu.parents('.drop_cstm'),
                    drop_down=parent.find('.drop_down_select_'),
                    img_src=bu.find('img').attr('src'),
                    display=bu.data('display');


                parent.find('.setVal span img').attr('src', img_src);

                drop_down.removeClass('active');
                parent.removeClass('top_index');

                parent.find("input[type='hidden']").val(display);

            });


            $('*').click(function (e) {

                if(
                    !$(e.target).is('.drop_cstm') && !$(e.target).is('.drop_cstm *')
                ){
                    $('.drop_cstm').removeClass('top_index');
                    $('.drop_down_select_').removeClass('active');
                }

            });

            /**/
            function clonedWorkPlaceCounter(){
                $('.companies_cloned_box').each(function (index, item) {
                    let num=index+1;
                    $(item).find('.work_place_counter').text(num);

                });
            }

            clonedWorkPlaceCounter();

            /**/

            function findCompanyForWorkExperience() {
                $(".company_names").each(function () {
                    var bu=$(this),
                        parent=bu.parents('.companies_cloned_box'),
                        appllied_company=parent.find('.appllied_company');


                    bu.autocomplete({
                        source: site_url + "/search-company/",
                        minLength: 2,
                        'open': function (e, ui) {
                            $('.ui-autocomplete');
                        },
                        select: function (event, ui) {

                            if(ui["item"] !== undefined) {

                                if(confirm("Are you sure?")){
                                    var selected_item=ui["item"];

                                    appllied_company.val(selected_item.id);

                                }
                            }

                        }
                    }).keyup(function () {
                        var bu2=$(this),
                            parent2=bu2.parents('.companies_cloned_box'),
                            appllied_company2=parent2.find('.appllied_company');

                        if(bu2.val().trim().length < 3){
                            appllied_company2.val('');
                        }

                    });

                })
            }

            findCompanyForWorkExperience();

            $(document).on('click', '.add_new_work_place', function () {
                var bu=$(this),
                    parent=bu.parents('.companies_cloned_box'),
                    cloned=parent.clone();

                $(cloned).insertAfter('.companies_cloned_box:last');

                var last_cloned=$('.companies_cloned_box:last');

                last_cloned.find('input:not(:checkbox), textarea, select').val('');
                last_cloned.find('input:checkbox').prop('checked', false);
                last_cloned.find('input').prop('readonly', false);
                last_cloned.find('.to_date_input').show();
                last_cloned.find('.change_company_name_btn').remove();


                last_cloned.find("div.bootstrap-select").each(function () {
                    var bu=$(this),
                        selectpicker=bu.find("select.selectpicker").clone(),
                        full_width=bu.parents('.full_width:first');

                    full_width.append(selectpicker);

                    bu.remove();

                    full_width.find("select.selectpicker").selectpicker();
                });

                clonedWorkPlaceCounter();

                findCompanyForWorkExperience();

            });

            var removed_company;

            $(document).on('click', '.remove_work_place',  function () {

                var bu=$(this),
                    parent=$(this).parents('.companies_cloned_box'),
                    rel_main_id=$.trim(parent.find('.appllied_company').val());

                if($('.companies_cloned_box').length == 1){
                    parent.find('input:not(:checkbox), textarea, select').val('');
                    parent.find('input:checkbox').prop('checked', false);
                    parent.find('.to_date_input').show();

                    parent.find("div.bootstrap-select").each(function () {
                        var bu=$(this),
                        selectpicker=bu.find("select.selectpicker").clone(),
                        full_width=bu.parents('.full_width:first');

                        full_width.append(selectpicker);

                        bu.remove();

                        full_width.find("select.selectpicker").selectpicker();
                    });

                }

                if(rel_main_id.length==0){
                    parent.remove();
                }

                if(rel_main_id.length > 0){
                    $('#remove_company').addClass('active');
                    $('#removed_company_id').val(rel_main_id);

                    removed_company=parent;
                    
                }

            });


            /**/
            $('.delete_company_modal_btn').click(function () {
                var bu=$(this);

                var form_data=new FormData($('#remove_company_form')[0]);


                $.ajax({
                    url :  redirect_url+'profile/settings',
                    type : 'POST',
                    data : form_data,
                    dataType : 'json',
                    cache : false,
                    contentType: false,
                    processData: false,
                    success : function (res) {
                        if (res.type=="success"){

                            bu.parents('.custom_modal').find(".hide_custom_modal_btn:first").trigger("click");

                            removed_company.remove();

                            toastr.success(res.message);

                            var rel_main_id=$('#removed_company_id').val();


                            $('.my_company_li_'+rel_main_id).remove();

                            document.getElementById('remove_company_form').reset();

                            setTimeout(function(){
                                window.location.href=window.location.href;
                            }, 1500)


                        }else{
                            toastr.error(res.message);
                        }
                    }
                });

            });

            $(document).on('change', '.work_place_until_now', function () {

                var bu=$(this),
                    parent=bu.parents('.companies_cloned_box'),
                    status=bu.prop('checked');

                if(status){
                    parent.find('.to_date_input').val('').hide();
                    parent.find('.until_now').val(1);
                }else{
                    parent.find('.to_date_input').show();
                    parent.find('.until_now').val(0);
                }

            });



            $('#advan_n').on('click', function(e){
                if( $(this).hasClass('active') ){
                    $(this).removeClass('active');
                    $('#show_content_n').slideUp(300);
                }
                else {
                    $(this).addClass('active');
                    $('#show_content_n').slideDown(300);
                }
            });
            $('.rm_items').on('click', function(e){
                e.preventDefault();
                $(this).closest('.upl_items').remove();
            });
            $(window).on('load',function(){
                $('#acntVerfication').modal('show');
            });
        });
    </script>
{/block}
