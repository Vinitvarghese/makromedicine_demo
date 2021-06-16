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
                    <div class="with_buttons full_width with_buttons with_buttons2 with_buttons3">
                        <h2>Company Info</h2>

                        <ul class="full-width company_list company_list_1">
                            <li>
                                <div class="product_info_img">
                                    <img src="{site_url()}uploads/catalog/users/{str_replace([site_url(), 'uploads/catalog/users/'], ['', ''], $UserData->company_logo)}" alt="{$company->company_logo}" />
                                </div>
                            </li>
                            <li>
                                <h4>Brand Name</h4>
                                <p><u>{$company->company_name}</u></p>
                            </li>

                            {if $company->country_id > 0}
                                <li>
                                    <h4>Country</h4>
                                    <p>{get_country_name($company->country_id)}</p>
                                </li>
                            {/if}

                            {if !empty($company->company_address)}
                                <li>
                                    <h4>Address</h4>
                                    <p>{$company->company_address}</p>
                                </li>
                            {/if}
                        </ul>
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
                                <a href="{site_url_multi('product/')}{$UserData->slug}/delete/{$product->id}" class="product_delete_btn product_delete_btn_2">
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
                                <li>
                                    <h4>Product Type</h4>
                                    <p>{get_product_type_name($product->pr_type)}</p>
                                </li>


                                {$atc_code = json_decode($product->atc_code)}
                                {$herbal = json_decode($product->herbal)}
                                {$animals = json_decode($product->animal)}
                                {$casNumbers = json_decode($product->cas)}

                                <li>
                                    <h4>Content</h4>
                                    <p>
                                    {if count($atc_code) > 0}
                                        {foreach $atc_code as $atc}
                                            {get_atc_code_no($atc->id)} {$atc->mdoza} {get_unit_name($atc->vdoza)}
                                        {/foreach}
                                    {/if}
                                        {if count($herbal) > 0}
                                            {foreach $herbal as $herb}
                                                {get_herbal_name($herb->id)} {$herb->mdoza} {get_unit_name($herb->vdoza)}
                                            {/foreach}
                                        {/if}
                                        {if count($animals) > 0}
                                            {foreach $animals as $animal}
                                                {get_animal_name($animal->id)} {$animal->mdoza} {get_unit_name($animal->vdoza)}
                                            {/foreach}
                                        {/if}
                                        {if count($casNumbers) > 0}
                                            {foreach $casNumbers as $casss}
                                                {get_cas_name($casss->id)} {$casss->mdoza} {get_unit_name($casss->vdoza)}
                                            {/foreach}
                                        {/if}
                                  </p>
                                </li>

                                {$var = json_decode($product->packing_type)}

                                {if count($var) > 0}
                                    <li>
                                        <h4>Dossage form</h4>
                                        <p>
                                            {$f = json_decode(json_encode($var[0]))}
                                            {get_packing_type_name($f->id)} {if $f->mdoza2 neq 0}{$f->mdoza2}{/if} {get_unit_name($f->vdoza2)} {if $f->mdoza neq 0}{$f->mdoza}{/if} {get_drug_type_code($f->vdoza)}
                                        </p>
                                    </li>
                                {/if}

                                {if !empty($product->medical_cl)}
                                    <li>
                                        <h4>Medical Classification</h4>
                                        <p>
                                            {foreach get_selected_medical($product->medical_cl) as $key=>$value} {$value->name}, {/foreach}
                                        </p>
                                    </li>
                                {/if}

                            </ul>
                        </div>

                    </div>


                    {if !empty($product->description)}
                        <div class="full_width product_info_bottom">
                            <h2>Description</h2>
                            {$product->description}

                        </div>
                    {/if}


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

                </div><!-- /.right_section -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->

    </div><!-- /.n_content_area -->


{/block}
