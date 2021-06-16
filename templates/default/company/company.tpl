{extends file=$layout}
{block name=content}



    <link rel="stylesheet" href="{base_url('templates/default/assets/css/prefix-style.css')}" media="all">


    {include file='../_partial/approve_waiting_line.tpl'}


    <div class="n_content_area full_width">

        <div class="container-fluid">
            <div class="row">
                {include file='../company/public-company-sidebar.tpl'}

                <div class="n_right_section decrease_padding_20 start_with_text">
                    <div class="with_buttons full_width">
                        {*<h2>INTEREST</h2>*}
                        <!--<a href="#" class="n_green_col">Add Products</a>-->
                    </div>
                    {if !empty($UserData->company_banner)}
                    <div class="banner_image_n img_fit full_width">

                        <img src="{site_url()}uploads/catalog/users/{str_replace([site_url(), 'uploads/catalog/users/'], ['', ''], $UserData->company_banner)}" alt="img" height="313" />
                    </div><!-- /.banner_image_n -->
                    {/if}

                    <div class="full_width need_padding_here">
                        <div class="cmother full_width pr-s-n">
                            <h2>COMPANY INFORMATION</h2>
                            {*<a href="#" class="write_message_n">Write Message</a>*}
                        </div>

                        <div class="full_width max-arrange">
                            <div class="drt_form full_width">
                                <div class="full_width">
                                    {if !empty($company->company_name)}
                                    <div class="fst_col">
                                        <label>Company Name <span>{$company->company_name}</span></label>
                                    </div><!-- /.fst_col -->
                                    {/if}

                                    {if !empty($company->establishment_date)}
                                    <div class="snd_col">
                                        <label>Establishment date <span>{$company->establishment_date}</span></label>
                                    </div><!-- /.snd_col -->
                                    {/if}

                                </div><!-- /.full_width -->
                                <div class="full_width">
                                    {if !empty($company->group_name)}
                                    <div class="fst_col">
                                        <label>Field of activity <span>{$company->group_name}</span></label>
                                    </div><!-- /.fst_col -->
                                    {/if}

                                    {if !empty($company->website)}
                                    <div class="snd_col">
                                        <label>Website <span>{$company->website}</span></label>
                                    </div><!-- /.snd_col -->
                                    {/if}


                                </div><!-- /.full_width -->

                                <div class="full_width">

                                    {if !empty($company->standart)}
                                    <div class="fst_col">
                                        <label>Standard <span>{$company->standart}</span></label>
                                    </div><!-- /.fst_col -->
                                    {/if}

                                </div><!-- /.full_width -->


                            </div><!-- /.drt_form -->

                            <div class="n_personal_info full_width">
                                {if !empty($company->company_info)}
                                    <h3>ABOUT COMPANY</h3>
                                    <p>{$company->company_info}</p>
                                {/if}

                                {if !empty($company->tags)}
                                    <h3>Tags</h3>
                                    <div class="tags_nn full_width">
                                        {$tag_list=explode(',', $company->tags)}
                                        {foreach $tag_list as $tag}
                                            <a href="javascript:void(0)">{$tag}</a>
                                        {/foreach}
                                    </div><!-- /.tags_nn -->
                                {/if}

                            </div><!-- /.personal_info -->



                            <div class="n_contact_info full_width">
                                <h3>CONTACT INFO</h3>

                                <div class="drt_form full_width">
                                    <div class="full_width">
                                        {if !empty($company->phone)}
                                        <div class="fst_col">
                                            <label>Phone Number <span>{$company->phone}</span> </label>
                                        </div><!-- /.fst_col -->
                                        {/if}

                                        {if !empty($company->fullname)}
                                            <div class="snd_col">
                                                <label>Contact Person Name <span class="get_underline">{$company->fullname}</span></label>
                                            </div><!-- /.snd_col -->
                                        {/if}


                                    </div><!-- /.full_width -->

                                    <div class="full_width">

                                        <div class="snd_col">


                                            {if $person_type}
                                                <label>Person Type
                                                    {foreach $person_type as $key => $value}
                                                        {if $value->id == $company->position } <span class="get_underline">{$value->name}</span> {break} {/if}
                                                    {/foreach}
                                                </label>
                                            {/if}

                                        </div><!-- /.snd_col -->

                                    </div><!-- /.full_width -->

                                    <div class="full_width">

                                        {if $company->country_id > 0}
                                        <div class="fst_col">
                                            <label>Country <span>{get_country_name($company->country_id)}</span></label>
                                        </div><!-- /.fst_col -->
                                        {/if}

                                        {if !empty($company->email) and $is_loggedin}
                                        <div class="snd_col">
                                            <label>E-mail <span>{$company->email}</span></label>
                                        </div><!-- /.snd_col -->
                                        {/if}
                                    </div><!-- /.full_width -->

                                    <div class="full_width">
                                        {if $company->company_address}
                                        <div class="fst_col">
                                            <label>Address <span>{$company->company_address}</span></label>

                                            {if !empty($company->company_lat) && !empty($company->company_lng)}
                                                <div class="map__">
                                                    <iframe width="265" height="265"  src="https://maps.google.com/maps?q={$company->company_address}&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                                                </div>
                                            {/if}
                                        </div><!-- /.fst_col -->
                                        {/if}

                                        {if $is_loggedin}
                                            <div class="snd_col al_blk">
                                                <hr class="thrx">
                                                {if !empty($company->fullname)}
                                                    <label>Contact Person Name <span>{$company->fullname}</span></label>
                                                {/if}

                                                {if $person_type}
                                                    <label>Person Type
                                                    {foreach $person_type as $key => $value}
                                                        {if $value->id == $company->position } <span class="get_underline">{$value->name}</span> {break} {/if}
                                                    {/foreach}
                                                    </label>
                                                {/if}

                                                {if !empty($company->email)}
                                                    <label>E-mail <span>{$company->email}</span></label>
                                                {/if}
                                            </div><!-- /.snd_col -->
                                        {/if}

                                    </div><!-- /.full_width -->

                                    <div class="n_social_block full_width">

                                        {if !empty($company->company_facebook)}
                                            <a href="{$company->company_facebook}" target="_blank"><img src="{base_url('templates/default/assets/images/icons/n_face.png')}" alt="facebook"></a>
                                        {/if}

                                        {if  !empty($company->company_twitter)}
                                            <a href="{$company->company_twitter}" target="_blank"><img src="{base_url('templates/default/assets/images/icons/n_twit.png')}" alt="twitter"></a>
                                        {/if}

                                        {if  !empty($company->company_youtube)}
                                            <a href="{$company->company_youtube}" target="_blank"><img src="{base_url('templates/default/assets/images/icons/n_tube.png')}" alt="youtube"></a>
                                        {/if}

                                        {if  !empty($company->company_linkedin)}
                                            <a href="{$company->company_linkedin}" target="_blank"><img src="{base_url('templates/default/assets/images/icons/n_in.png')}" alt="linkedin"></a>
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
    <div class="clearfix"></div>



{/block}
