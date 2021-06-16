{extends file=$layout}
{block name=content}
    <link rel="stylesheet" href="{base_url('templates/default/assets/css/prefix-style.css')}" media="all">
    <div class="n_content_area full_width products_container">
        <a href="#" id="openMenu" class="pages-menu-float">Menu</a>
        <div class="container-fluid">
            <div class="row">
                {include file='../company/sidebar.tpl'}
                {* <div class="n_right_section start_with_text news_page"> *}
                <div class="n_right_section decrease_padding start_with_text">
                    <div class=" full_width   ">

                        <div class="flex direction_column">
                            <a href="{site_url_multi( 'pages' )}/{$UserData->slug}/products"
                                class="flex align_center product_info_go_back">
                                <svg width="18" height="13" viewBox="0 0 18 13" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M16.5017 6.0461H2.63347L6.78226 1.86149C6.97712 1.66418 6.97712 1.34478 6.78226 1.14798C6.58739 0.950674 6.27194 0.950674 6.07758 1.14798L1.14391 6.14299C0.95203 6.33728 0.95203 6.66222 1.14391 6.8565L6.07762 11.852C6.27248 12.0493 6.58793 12.0493 6.7823 11.852C6.97716 11.6547 6.97716 11.3353 6.7823 11.1385L2.63347 7.05527H16.5017C16.7768 7.05527 17 6.8292 17 6.55069C17 6.27218 16.7768 6.0461 16.5017 6.0461Z"
                                        fill="#2187C5" stroke="#2187C5" stroke-width="0.8" />
                                </svg>

                                <span>Product</span>
                            </a>

                            <h2>Company Info</h2>
                        </div>

                        <div class="flex align_center product_info_top">

                            <div class="product_info_top_sides product_info_left_side">
                                <div class="product_info_img">
                                    {if isset($get_confirm_status) && !empty($get_confirm_status)}
                                        {if $get_confirm_status->status == 1}
                                            <a href="#" class="n_pro_tick"><img
                                                    src="{base_url('templates/default/assets/images/icons/tck_.png')}" /></a>
                                        {/if}
                                    {/if}

                                    <img src="{$UserData->company_logo}" alt="{$company->company_logo}" />
                                </div>
                            </div>

                            <div class="product_info_top_sides product_info_right_side flex direction_column ">

                                <div class=" flex product_info_top_right">
                                    <ul class=" company_list company_list_1">
                                        <li class="product_info_company_name">
                                            <h4>Company Name</h4>
                                            <p>{$company->company_name}</p>
                                        </li>
                                    </ul>
                                </div>

                                <div class="full_width flex justify_between product_info_bottom_right">

                                    <ul class=" company_list company_list_1 company_list_1111">

                                        {if $company->company_country_id > 0}
                                            <li>
                                                <h4>Continent</h4>
                                                <p>{get_continent_name_by_country($company->company_country_id)}</p>
                                            </li>
                                        {/if}

                                        <li>
                                            <h4>Status</h4>
                                            {foreach $groups as $k => $v}
                                                {if  $user['group_id']==$v->id}<p>{$v->name}</p>{/if}
                                            {/foreach}
                                        </li>

                                        {if $company->company_country_id > 0}

                                            <li>
                                                <h4>Country</h4>
                                                <p>{get_country_name($company->company_country_id)}</p>
                                            </li>
                                        {/if}


                                        <li>
                                            <h4>Field of activity</h4>
                                            <p>{$selected_product_type_names}</p>
                                        </li>
                                    </ul>

                                    {if $get_standart}
                                        <ul class=" company_list company_list_1">
                                            <li>
                                                <h4>Standart</h4>

                                                <div class="img-full-right-block img_forece" id="img_forece">

                                                    {foreach $get_standart as $num => $row}
                                                        <div class="img-upload-group bitrix block_{$row['standart_id']}"
                                                            var-attr="{$row['standart_id']}">
                                                            <div class="reload-form-cover-mini">
                                                                {$src=(preg_match('/pdf/', $row['name'])) ? base_url('templates/default/assets/img/sys/pdf.png') : "{base_url('uploads/catalog/standart/')}{$row['name']}"}
                                                                <img src="{$src}"
                                                                    class=" {if preg_match('/pdf/', $row['name'])} pdf-icon-st {/if} "
                                                                    title="{$row['st_name']}" alt="{$row['st_name']}">
                                                            </div>
                                                            <span title="{$row['st_name']}"> {$row['st_name']}</span>
                                                        </div>
                                                    {/foreach}

                                                </div>
                                            </li>
                                        </ul>
                                    {/if}

                                </div>



                            </div>

                        </div>




                    </div>

                    <div class="with_buttons full_width with_buttons with_buttons2 with_buttons3">
                        <h2>Product Info</h2>
                        {if $user.id && $product->user_id == $UserData->id}

                            {if $permission_list[4]->edit == 1}
                                <a href="{site_url_multi('product/')}{$UserData->slug}/update/{$product->id}">
                                    Edit Info
                                </a>
                            {/if}

                            {if $permission_list[4]->delete == 1}
                                <a href="{site_url_multi('product/')}{$UserData->slug}/delete/{$product->id}"
                                    class="product_delete_btn product_delete_btn_2">
                                    Delete
                                </a>
                            {/if}
                        {/if}
                    </div>

                    <div class="full_width product_info_middle">

                        <div class="product_middle_sides product_middle_left">

                            {if !empty($product_images)}

                                <div class="pr_images_big">
                                    {foreach $product_images as $k => $v}
                                        <a data-fancybox="gallery" href="{base_url('uploads/catalog/product/')}{$v['image']}">
                                            <img src="{base_url('uploads/catalog/product/')}{$v['image']}" />
                                        </a>
                                        {break}
                                    {/foreach}
                                </div>

                                <ul class="product_gallery_images">
                                    {foreach $product_images as $k => $v}
                                        <li>
                                            <a data-fancybox="gallery" href="{base_url('uploads/catalog/product/')}{$v['image']}">
                                                <img src="{base_url('uploads/catalog/product/')}{$v['image']}" />
                                            </a>
                                        </li>
                                    {/foreach}
                                </ul>

                            {/if}


                        </div>
                        <div class="product_middle_sides product_middle_right">
                            <ul class="full-width company_list company_list_2">
                                {if !empty($product->title)}
                                    <li>
                                        <h4>Brand Name</h4>
                                        <p>{$product->title}</p>
                                    </li>
                                {/if}

                                <li>
                                    <h4>Product Type</h4>
                                    <p>{get_product_type_name($product->pr_type)}</p>
                                </li>


                                {$atc_code = json_decode($product->atc_code)}
                                {$herbal = json_decode($product->herbal)}
                                {$animals = json_decode($product->animal)}
                                {$casNumbers = json_decode($product->cas)}
                                {$cass=(!empty($casNumbers)) ? $casNumbers[0] : []}

                                <li>
                                    <h4 class="content_h4">Content:</h4>

                                    {if count($atc_code) > 0}
                                        <div class="flex product_lines product_atc_line">
                                            <h3>ATC Code:</h3>
                                            <p>
                                                {foreach $atc_code as $atc}
                                                    {get_atc_code_no($atc->id)} {$atc->mdoza} {get_unit_name($atc->vdoza)}
                                                {/foreach}
                                            </p>
                                        </div>

                                    {/if}

                                    {if count($herbal) > 0}
                                        <div class="flex product_lines product_herbal_line">
                                            <h3>Herbal:</h3>
                                            <p>
                                                {foreach $herbal as $herb}
                                                    {get_herbal_name($herb->id)} {$herb->mdoza} {get_unit_name($herb->vdoza)}
                                                {/foreach}
                                            </p>
                                        </div>
                                    {/if}
                                    {if count($animals) > 0}
                                        <div class="flex product_lines product_bio_line">
                                            <h3>Biological:</h3>
                                            <p>
                                                {foreach $animals as $animal}
                                                    {get_animal_name($animal->id)} {$animal->mdoza} {get_unit_name($animal->vdoza)}
                                                {/foreach}
                                            </p>
                                        </div>
                                    {/if}
                                    {if count($casNumbers) > 0}
                                        <div class="flex product_lines product_cas_line direction_column">
                                            <div class="flex">
                                                <h3>CAS№: </h3>
                                                <p>{get_cas_no($cass->id)}</p>
                                            </div>

                                            <div class="flex">
                                                <h3>Formula:</h3>
                                                <p>{get_cas_formula($cass->id)}</p>
                                            </div>

                                            <div class="flex">
                                                <h3>Name:</h3>
                                                <p>{get_cas_name($cass->id)}</p>
                                            </div>

                                            <div class="flex">
                                                <h3>Purity:</h3>
                                                <p>
                                                    {foreach from=$puritys key=key item=purity}
                                                        {if $cass->purity_unit eq $purity->id} {$purity->code}{$cass->purity}%{/if}
                                                    {/foreach}
                                                </p>
                                            </div>

                                            <div class="flex">
                                                <h3>Dose Unit:</h3>
                                                <p>
                                                    {foreach $unit as $key=>$value}
                                                        {if $cass->vdoza eq $value->id} {$cass->mdoza}{$value->short_name} {/if}
                                                    {/foreach}
                                                </p>
                                            </div>
                                        </div>
                                    {/if}

                                </li>

                                {$var = json_decode($product->packing_type)}

                                {if count($var) > 0}
                                    <li>
                                        <h4>Dossage form</h4>
                                        <p>
                                            {$f = json_decode(json_encode($var[0]))}
                                            {get_packing_type_name($f->id)} {if $f->mdoza2 neq 0}{$f->mdoza2}{/if}
                                            {get_unit_name($f->vdoza2)} {if $f->mdoza neq 0}{$f->mdoza}{/if}
                                            {get_drug_type_code($f->vdoza)}
                                        </p>
                                    </li>
                                {/if}

                                {if !empty($product->medical_cl)}
                                    <li>
                                        <h4>Medical Classification</h4>
                                        <p>
                                            {foreach get_selected_medical($product->medical_cl) as $key=>$value} {$value->name},
                                            {/foreach}
                                        </p>
                                    </li>
                                {/if}

                            </ul>
                        </div>

                    </div>





                    <div class="full_width product_info_bottom">
                        <ul class="full-width company_list  company_list_3">
                            {if $product->moq!=0}
                                <li>
                                    <h4>Min Order Quantity</h4>
                                    <p>{$product->moq}</p>
                                </li>
                            {/if}

                            {if $product->shelf_life!=0}
                                <li>
                                    <h4>Shelf Life ( Month )</h4>
                                    <p>{$product->shelf_life}</p>
                                </li>
                            {/if}


                            {if $product->storage!=0}
                                <li>
                                    <h4>Storage</h4>
                                    <p>
                                        {if $product->storage==1}
                                            Do not store over 30 C
                                        {elseif $product->storage==2}
                                            Do not store over 25 C
                                        {elseif $product->storage==3}
                                            Do not store over 15 C
                                        {elseif $product->storage==4}
                                            Do not store over 8 C
                                        {elseif $product->storage==5}
                                            Do not store below 8 C
                                        {elseif $product->storage==6}
                                            Protect from moisture
                                        {elseif $product->storage==7}
                                            Protect from light
                                        {else}
                                            Other
                                        {/if}
                                    </p>
                                </li>
                            {/if}

                            {if $product->be==1 || $product->ctd==1}
                                <li>
                                    <h4>Dossier Format</h4>
                                    <p>
                                        {if $product->be==1}
                                            BE
                                        {/if}

                                        {if $product->ctd==1}
                                            CTD
                                        {/if}
                                    </p>
                                </li>
                            {/if}

                        </ul>
                    </div>

                    {if !empty($product->description)}
                        <div class="full_width product_info_bottom product_description">
                            <h2>Description</h2>
                            <p>{$product->description}</p>

                        </div>
                    {/if}

                </div><!-- /.right_section -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->

    </div><!-- /.n_content_area -->


{/block}