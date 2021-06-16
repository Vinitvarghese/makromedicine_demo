{extends file=$layout}
{block name=content}



    <style>
        .not-active,.not-active td{
            background-color: #FFCDD2!important;
        }
        #example_wrapper{
            max-width: 1326px;
            margin: 0 auto;
        }
        .dataTables_paginate{
            float:right!important;
        }
        .tables-data .table-search-not{
            width:100%;

        }
        .tables-data .table > thead.is-fixed {
            border: none;
        }
        .tables-data .table > thead.is-fixed > tr > th{
            border-bottom: 1px solid rgb(184, 184, 184)!important;
            background: #e9e9e9!important;
        }
        td:nth-child(1) {
            min-width: 39px!important;
            max-width: 39px!important;
            width: 39px!important;
        }
        .nine{
            max-width: 85px!important;
            width: 85px!important;
        }

        .tables-data .table > thead.is-fixed > tr > th:nth-child(1){
            min-width: 39px;
            width: 39px;
            border-left: 1px solid rgb(184, 184, 184)!important;;
        }
        .tables-data .table > thead.is-fixed > tr > th:nth-child(2){
            min-width: 158px;
            width: 158px;
        }
        .tables-data .table > thead.is-fixed > tr > th:nth-child(3){
            min-width: 189px;
            width: 189px;
        }
        .tables-data .table > thead.is-fixed > tr > th:nth-child(4){
            min-width: 199px;
            width: 199px;
        }
        .tables-data .table > thead.is-fixed > tr > th:nth-child(5){
            min-width: 157px;
            width: 157px;
        }
        .tables-data .table > thead.is-fixed > tr > th:nth-child(6){
            min-width: 89px;
            width: 89px;
        }
        .tables-data .table > thead.is-fixed > tr > th:nth-child(7){
            min-width: 189px;
            width: 189px;
        }
        .tables-data .table > thead.is-fixed > tr > th:nth-child(8){
            min-width: 189px;
            width: 189px;
        }
        .tables-data .table > thead.is-fixed > tr > th:nth-child(9){
            min-width: 86px;
            width: 120px;
        }
        .tables-data .table > thead > tr > th .form-control{
            border: 0;
        }

        #example_wrapper {
            max-width: 1170px;
            margin: 0 auto;
            padding: 0 15px;
        }
        .tables-data .table > thead > tr > th .btn-default:hover, .tables-data .table > thead > tr > th .btn-default:focus, .tables-data .table > thead > tr > th .btn-default:active, .tables-data .table > thead > tr > th .btn-default.active, .tables-data .table > thead > tr > th .open > .dropdown-toggle.btn-default{
            padding: 10px 6px!important;
        }
        .bootstrap-select.btn-group .dropdown-toggle .filter-option{
            margin: 0;
        }
        .tables-data .table > thead > tr > th .form-control,
        .tables-data .table > thead > tr > th a{
            font-size: 10px;
        }

        .six a{
            line-height: 0.5;
        }
        .six center{
            padding: 6px 0;
        }
    </style>

    

    <div class="wrap margin-top-100 col-md-12">
        <div class="container-fuild">
            <div class="row">
                
            <a href="{site_url_multi( 'pages' )}/{$UserData->slug}/products" class="left_menu_btn" >Menu</a>

                <div class="clearfix"></div>
                <div class="col-md-12 no-padding add-product-nav" id="addProductNav">
                    <div class="product_center">
                        <div class="full_width flex align_center add_edit_product_top_in">
                            <h1>My products</h1>
                        </div>
                    </div>
                </div>


                {include file='../_partial/approve_waiting_line.tpl'}

                <div class="clearfix"></div>
                <div class="container" id="add-product">

                    <div class="clearfix"></div>
                    <h2 class="add-pr-heading" id="section1">1. Add Products </h2>
                    <div class="col-md-12 no-padding add-product collapse in" id="collapseExample">
                        <div class="col-md-12 no-padding panel-add">
                            <form class="n_content_area" role="form" method="POST" action="{site_url_multi('product')}/{$UserData->slug}/add"  enctype="multipart/form-data">
                                <input type="hidden" name="request" value="add">

                                <div class="no-padding search-tool" style="display:none;">
                                    <div class="col-md-12 malecule">
                                        <div class="search-module">
                                            <div class="search-inner"></div>
                                            <input type="text" class="module-search" id="for-search" placeholder="Search">

                                        </div>
                                        <div class="col-md-12 no-padding discom">

                                            <ul class="list-chemical periodic collapse in" id="chemical">
                                                {if $chemichal}{foreach from=$chemichal item=chemical}
                                                    <li data-txt="{$chemical->meaning}" data-no="{$chemical->atc_code}" data-formula="" data-target="chemical" data-id="{$chemical->id}">
                                                        <span class="ischeck"></span>
                                                        <a href="#{$chemical->atc_code}" >
                                                            <div class="lib-span" data-toggle="tooltip" data-placement="bottom" title="{$chemical->atc_code} | {$chemical->meaning}">{$chemical->atc_code} </div>
                                                            <div class="lib-span2"> | {$chemical->meaning}</div>
                                                        </a>
                                                        <div class="clearfix"></div>
                                                    </li>
                                                {/foreach}{/if}
                                            </ul>
                                            <ul class="list-herbal periodic collapse" id="herbal">
                                                {if $herbals} {foreach from=$herbals item=herbal}
                                                    <li data-txt="{$herbal->name}" data-no="" data-formula="" data-target="herbal" data-id="{$herbal->id}"> <span class="ischeck"></span><a href="#"   title="{$herbal->name}">{$herbal->name}</a> </li>
                                                {/foreach}{/if}
                                            </ul>
                                            <ul class="list-animal periodic collapse" id="animal">
                                                {if $animals} {foreach from=$animals item=animal}
                                                    <li data-txt="{$animal->name}" data-no="" data-formula="" data-target="animal" data-id="{$animal->id}"> <span class="ischeck"></span><a href="#" data-toggle="tooltip" data-placement="right" title="{$animal->name}">{$animal->name}</a> </li>
                                                {/foreach}{/if}
                                            </ul>
                                            <ul class="list-casNumber periodic collapse" id="casNumber">
                                                {if $cas_numbers} {foreach from=$cas_numbers item=cas_number}
                                                    <li data-txt="{htmlentities($cas_number->chemical_name)}" data-no="{$cas_number->cas_no}" data-formula="{$cas_number->molecular_formula}" data-target="casNumber" data-id="{$cas_number->id}">
                                                        <span class="ischeck"></span>
                                                        <a href="#{$cas_number->cas_no}"  data-toggle="tooltip" data-placement="bottom" title="{str_replace('"','',$cas_number->chemical_name)}">
                                                            <div class="lib-span3"  >{$cas_number->cas_no} </div>
                                                            <div class="lib-span4">{$cas_number->chemical_name}</div>
                                                            <div class="lib-span5">{$cas_number->molecular_formula}</div>
                                                        </a>
                                                        <div class="clearfix"></div>
                                                    </li>
                                                {/foreach}{/if}
                                            </ul>
                                            <ul class="list-dossageForm periodic collapse" id="dossageForm">
                                                {if $dossageforms} {foreach from=$dossageforms item=dossageform}
                                                    <li data-txt="{$dossageform->name}" data-no="" data-formula="" data-target="dossageForm" data-id="{$dossageform->id}"> <span class="ischeck"></span><a href="#" data-toggle="tooltip" data-placement="right" title="{$dossageform->name}">{$dossageform->name}</a> </li>
                                                {/foreach}{/if}
                                            </ul>
                                            <ul class="list-dossageForm periodic collapse" id="medicalClassification">
                                                {if $medicals} {foreach from=$medicals item=medical}
                                                    <li data-txt="{$medical->name}" data-no="" data-formula="" data-target="medicalClassification" data-id="{$medical->id}"> <span class="ischeck"></span><a href="#" data-toggle="tooltip" data-placement="right" title="{$medical->name}">{$medical->name}</a> </li>
                                                {/foreach}{/if}
                                            </ul>
                                            <!--    <button type="button" class="btn btn-default show-sug mt-10" data-toggle="modal" data-type="chemical" data-target="#suggestionModal" style="display:block">+ Add your suggestion</button> -->
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 no-padding specilation">
                                    <div class=" add-frist">
                                        {if isset($message)}
                                            <script> toastr.warning(`{$message.message}`); </script>
                                        {/if}

                                        <div class="form-group" style="margin-bottom: 0!important">

                                            <ul class="full_width flex add_edit_p_top">
                                                <li>
                                                    <label>Product type</label>
                                                    <select name="pr_type" class="form-control mylos selectpicker show-menu-arrow product_type_select" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" title="Please Select Type">
                                                        {if $product_type}{foreach $product_type as $key=>$type}
                                                            <option value="{$type->id}">{$type->name}</option>
                                                        {/foreach}{/if}
                                                    </select>
                                                </li>
                                                <li class="brandName">
                                                    <label>Brand name</label>
                                                    <input type="text" name="title" class="form-control mylos brandname" placeholder="Brand name" disabled="disabled">
                                                </li>
                                                <li class="country">
                                                    <label>Country</label>
                                                    <select name="country" class="form-control mylos selectpicker company-country show-menu-arrow" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1">
                                                        {if $countrys}{foreach $countrys as $key=>$country}
                                                            <option value="{$country->id}" data-name="{$country->code}" {if $UserData->country_id eq $country->id} selected="selected" {else if empty($UserData->country_id)} {if $country->id == $ip_country->id } selected="selected" {/if} {/if}>{$country->name}</option>
                                                        {/foreach}{/if}
                                                    </select>
                                                </li>
                                            </ul>



                                            <div class="col-md-12 no-padding content_add">
                                                <div class="full_width flex direction_column">
                                                    <label>2. Ingredients - Ingredients and dosages</label>
                                                    <ul class="add_btns_top flex" >
                                                        <li><button type="button" class="target chemical" data-widget="" data-target="#chemical" >ATC Code +</button></li>
                                                        <li><button type="button" class="target herbal" data-widget="" data-target="#herbal" >Herbal +</button></li>
                                                        <li><button type="button" class="target animal" data-widget="" data-target="#animal">Biological + </button></li>
                                                        <li><button type="button" class="target casNumber" data-widget="" data-target="#casNumber">CAS Number +</button></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>

                                            <div class="clearfix row" style="margin: 0">

                                                <div class="col-md-12 frist-inner"></div>
                                            </div>

                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="clearfix"></div>

                                    <div class="two-column">
                                        <h2 class="add-pr-heading forcontent" id="section3">3. Packaging - <span>Dosage form and pack size</span></h2>
                                        <div class="term-inner">
                                            <div class="form-group">
                                                <div class="col-md-12 no-padding">
                                                    <div class="col-md-1 no-padding dossage-limit" >
                                                        <button type="button" class="dossage dossageForm btn-dossage" data-widget=""  data-target="#dossageForm">Add +</button>
                                                    </div>
                                                    <div class="col-md-12 no-padding dossageForm-inner" >

                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <div id="div_timer"></div>
                                    </div>

                                    <div class="three-column pr_bottom">
                                        <h2 class="add-pr-heading forcontent">4. Add Medical Classifiction - <span>Therapeutic use area</span></h2>
                                        <div class=" term-inner">
                                            <div class="form-group">
                                                <div class="col-md-12 no-padding">

                                                    <div class="col-md-12 no-padding medical-limit" >
                                                        <button type="button" class="dossage medicalClassifictionForm btn-medicalClassifiction" data-widget=""  data-target="#medicalClassification">Add +</button>
                                                    </div>
                                                    <div class="col-md-12 no-padding medicalClassifiction-inner"></div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>

                                        <h2 class="add-pr-heading forcontent" id="section4">5. General Information</h2>
                                        <div class=" term-inner detailsBottom">


                                            <div class="full_width">

                                                <ul class="full_width flex add_edit_p_top add_edit_p_top2">
                                                    <li>
                                                        <label>Additional information</label>
                                                        <textarea class="form-control mylos add_p_description" placeholder="" name="description" rows="4"></textarea>
                                                    </li>

                                                    <li>
                                                        <label>&nbsp;</label>
                                                        <div class="full_width pr_upload">
                                                            <div class="new_upload_btn flex align_center">
                                                                {* <button type="button" class="upload_file_btn">
                                                                    <svg width="11" height="18" viewBox="0 0 11 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M5.5 18C2.46694 18 0 15.477 0 12.375V4.5C0 4.08595 0.328577 3.75005 0.733289 3.75005C1.13813 3.75005 1.46671 4.08595 1.46671 4.5V12.375C1.46671 14.6497 3.27583 16.5 5.5 16.5C7.72417 16.5 9.53329 14.6497 9.53329 12.375V4.12495C9.53329 2.67751 8.38199 1.50005 6.96671 1.50005C5.55129 1.50005 4.4 2.67751 4.4 4.12495V11.625C4.4 12.2452 4.89347 12.75 5.5 12.75C6.10653 12.75 6.6 12.2452 6.6 11.625V4.5C6.6 4.08595 6.92858 3.75005 7.33329 3.75005C7.73813 3.75005 8.06671 4.08595 8.06671 4.5V11.625C8.06671 13.0725 6.91528 14.25 5.5 14.25C4.08472 14.25 2.93329 13.0725 2.93329 11.625V4.12495C2.93329 1.85023 4.74241 0 6.96671 0C9.19088 0 11 1.85023 11 4.12495V12.375C11 15.477 8.53306 18 5.5 18Z" fill="white"></path>
                                                                    </svg>
                                                                </button> *}
                                                                <label>Add Photo / Documents</label>
                                                            </div>

                                                            <div class="col-md-12 no-padding img-full-right-block img_forece">

                                                                <div class="inner-img flex flex_wrap">



                                                                    <div class="img-upload-group add bitrix add_more_img" var-attr="">
                                                                        <div class="reload-form-upload">
                                                                            <label>
                                                                                <button type="button" class="add-button-photos" data-target="">Add More</button>
                                                                            </label>
                                                                        </div>
                                                                    </div>


                                                                </div>


                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>

                                                <ul class="n_content_area full_width flex add_edit_p_top add_edit_p_top2 add_edit_p_top3">
                                                    <li >
                                                        <label >Min Order Quantity</label>
                                                        <input type="number" class="form-control "  name="moq">
                                                    </li>

                                                    <li >
                                                        <label >Shelf Life ( Month )</label>
                                                        <input type="number" class="form-control "  name="shelf_life">
                                                    </li>

                                                    <li >
                                                        <label >Storage</label>
                                                        <select class="selectpicker show-menu-arrow pils storage-select" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="storage">
                                                            <option value="1">Do not store over 30 C</option>
                                                            <option value="2">Do not store over 25 C</option>
                                                            <option value="3">Do not store over 15 C</option>
                                                            <option value="4">Do not store over 8 C</option>
                                                            <option value="5">Do not store below 8 C</option>
                                                            <option value="6">Protect from moisture</option>
                                                            <option value="7">Protect from light</option>
                                                            <option value="8">Other</option>
                                                        </select>
                                                    </li>

                                                    <li >
                                                        <label >Dossier Format</label>
                                                        <div class="flex dossier_format">
                                                            <label class="new_checkbox flex align_center">
                                                                <input type="checkbox" name="ctd" value="1" class="work_place_until_now">
                                                                <span>CTD</span>
                                                            </label>

                                                            <label class="new_checkbox flex align_center">
                                                                <input type="checkbox" name="be" value="1" class="work_place_until_now">
                                                                <span>BE</span>
                                                            </label>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>


                                        </div>

                                        <div class="full_width flex align_center justify_end form_add_product_btns">
                                            <a href="{site_url_multi('/')}pages/{$UserData->slug}/products"  class="close-product-btn" >Cancel</a>
                                            <button type="submit" class="submit-product-btn " >Save</button>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>

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
                            <input type="file" name="certifcate" style="display:none;" class="certifcate-input"/>
                            <button type="button" class="btn btn-danger choose-certifcate">Choose Certifcate</button>
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


    <!-- Modal -->
    <div class="modal fade" id="plusModal" tabindex="-1" role="dialog" aria-labelledby="infoAddLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="infoAddLabel">Additional Data</h4>
                </div>
                <div class="modal-body">
                    You can expand this row by clicking "+" button and add more data about current content.
                </div>
            </div>
        </div>
    </div>

    <script>
        function addHerbal(count, data_txt, data_no, data_formula, data_target, data_id) {
            var component =
                `<div class="form-group vared herbalRow label_` + data_id + `">
                <div class="col-md-2 no-padding label_add_prod">
                    <label data-txt='(Herbal)'>Ingredient ` + count + `</label>
                    <input type="hidden" name="herbals[` + count + `][id]" value="` + data_id + `">

                    <button type="button" class="btn remove-item remove-c-row" data-toggle="tooltip" data-placement="top" data-cid="`+data_id+`" title="" ></button>
                </div>
                 <div class="col-md-12 no-padding add-c-row">
                     <div class="input-group add-c-name">
                        <span class="input-group-addon beautiful" >Herbal</span>
                        <input type="text" class="form-control fix-inputgroup" title="`+data_txt+`" value="` + data_txt + `" readonly disabled>
                    </div>



                    <div class="input-group add-c-count" >
                        <span class="input-group-addon beautiful" >Quantity</span>
                        <input type="text" class="form-control mylos"  name="herbals[` + count + `][mdoza]" required>
                    </div>
                            <div class="input-group add-c-unit">
                                <span class="input-group-addon ">Dose Unit</span>
                                <select class="selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1"  name="herbals[` + count + `][vdoza]" required>
                                    <option value="">-</option>
                                    {if $unit}{foreach $unit as $key=>$value}
                                        <option value="{$value->id}" data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
                                    {/foreach}{/if}
                                </select>
                            </div>
                            <div class="input-group add-c-unit">
                                <span class="input-group-addon ">Herb part</span>
                                <select class="selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="herbals[` + count + `][part]">
                                    <option class="bs-title-option" value="">-</option>
                                    {if $herb_parts}{foreach $herb_parts as $key=>$herb_part}
                                      <option value="{$herb_part->id}" data-code="{$herb_part->name}" title="{$herb_part->name}">{$herb_part->name}</option>
                                    {/foreach}{/if}
                                </select>
                            </div>
                            <div class="input-group add-c-unit">
                            <span class="input-group-addon ">Herb form</span>
                                <select class=" selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="herbals[` + count + `][form]">
                                    <option class="bs-title-option" value="">-</option>
                                    {if $herb_forms}{foreach $herb_forms as $key=>$herb_form}
                                    <option value="{$herb_form->id}" data-code="{$herb_form->name}" title="{$herb_form->name}">{$herb_form->name}</option>
                                    {/foreach}{/if}
                               </select>
                            </div>

                    </div>

                </div>

            </div>
            `;
            return component;
        }
        function addAnimal(count, data_txt, data_no, data_formula, data_target, data_id) {
            var component =
                `<div class="form-group vared animalRow label_` + data_id + `">
                <div class="col-md-2 no-padding label_add_prod">
                    <label data-txt='(Biological)'>Ingredient ` + count + `</label>
                    <input type="hidden" name="animals[` + count + `][id]" value="` + data_id + `">

                    <button type="button"  data-cid="`+data_id+`" class="btn remove-item remove-c-row" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"></button>
                </div>
                <div class="col-md-12 no-padding add-c-row">
                    <div class="input-group add-c-name">
                        <span class="input-group-addon beautiful" >Animal</span>
                        <input type="text" class="form-control fix-inputgroup" title="`+data_txt+`" value="` + data_txt + `" readonly disabled>
                    </div>

                    <div class="input-group add-c-count">
                        <span class="input-group-addon beautiful" >Quantity</span>
                        <input type="text" class="form-control mylos"  name="animals[` + count + `][mdoza]" required>
                    </div>
                    <div class="input-group add-c-count">
                        <span class="input-group-addon ">Dose unit</span>
                        <select class=" selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1"  name="animals[` + count + `][vdoza]" required>
                            <option value="">-</option>
                            {if $unit}{foreach $unit as $key=>$value}
                            <option value="{$value->id}" data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
                            {/foreach}{/if}
                        </select>
                    </div>
                    <div class="input-group add-c-unit">
                        <span class="input-group-addon ">Animal part</span>
                        <select class=" selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="animals[` + count + `][part]">
                            <option class="bs-title-option" value="">-</option>
                            {if $animal_parts}{foreach $animal_parts as $key=>$animal_part}
                            <option value="{$animal_part->id}" data-code="{$animal_part->name}" title="{$animal_part->name}">{$animal_part->name}</option>
                            {/foreach}{/if}
                        </select>
                    </div>
                    <div class="input-group add-c-unit">
                    <span class="input-group-addon ">Animal form</span>
                        <select class=" selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="animals[` + count + `][form]">
                            <option class="bs-title-option" value="">-</option>
                            {if $animal_forms}{foreach $animal_forms as $key=>$animal_form}
                            <option value="{$animal_form->id}" data-code="{$animal_form->name}" title="{$animal_form->name}">{$animal_form->name}</option>
                            {/foreach}{/if}
                        </select>
                    </div>


                </div>

            </div>`;
            return component;
        }
        function addChermical(count, data_txt, data_no, data_formula, data_target, data_id) {
            var component =
                `<div class="form-group vared chemicalRow label_`+data_id+`">
                <div class="col-md-2 no-padding label_add_prod">
                    <label data-txt='(Atc code)'>Ingredient ` + count + ` (Atc code)</label>
                    <input type="hidden" name="atc_codes[` + count + `][id]" value="` + data_id + `">

                    <button type="button" class="btn remove-item remove-c-row" data-cid="`+data_id+`" data-toggle="tooltip" data-placement="top" ></button>
                </div>
                <div class="col-md-12 no-padding add-c-row">
                    <div class="input-group add-c-code">
                        <span class="input-group-addon beautiful" >ATC Code</span>
                        <input type="text" class="form-control fix-inputgroup" value="`+data_no+`" readonly disabled>
                    </div>
                    <div class="input-group add-c-name">
                        <span class="input-group-addon beautiful" >Name</span>
                        <input type="text" class="form-control fix-inputgroup" title="`+data_txt+`" value="`+data_txt+`" readonly disabled>
                    </div>
                    <div class="input-group add-c-count" >
                        <span class="input-group-addon beautiful">Quantity</span>
                        <input type="text" class="form-control mylos" value="1"  name="atc_codes[` + count + `][mdoza]" required>
                    </div>
                    <div class="input-group add-c-unit">
                    <span class="input-group-addon dose_unit">Dose Unit</span>
                        <select class="  selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1"  name="atc_codes[` + count + `][vdoza]" required>
                            <option value="">-</option>
                            {if $unit}{foreach $unit as $key=>$value}
                            <option value="{$value->id}" data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
                            {/foreach}{/if}
                        </select>
                    </div>
                            <div class='flex'>
                                <button type="button" class="plus_item" data-id="` + count + `" data-type="atc_codes"></button>
                                <button type="button" class="minus_item"></button>
                            </div>
                              <div class="extra-mg"></div>



                    `;
            if($('select[name="pr_type"]').val() != 3){
                component+= `<div class="input-group" >
                                <span class="input-group-addon dose_unit" >Purity</span>
                                <div class="flex" >
                            
                                    <select class="selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="atc_codes[` + count + `][purity_unit]" >
                                        {if $puritys}{foreach $puritys as $key=>$purity}
                                        <option value="{$purity->id}" data-code="{$purity->code}"> {$purity->code} </option>
                                        {/foreach}{/if}
                                    </select>
                                
                                    <input type="text" class="form-control" placeholder="purity (%)"
                                        name="atc_codes[` + count + `][purity]" style="margin-left: 10px;" >
                                </div>
                            </div>`;
            }
            component+=`</div>

            </div></div>`;
            return component;
        }
        function addDossageForm(count, data_txt, data_no, data_formula, data_target, data_id) {
            var component =
                `<div class="form-group label_` + data_id + `" >
                <div class="col-md-12 no-padding add-c-row no_border_bg">
                    <div class="input-group add-c-name ">
                        <span class="input-group-addon beautiful" >Dosage form</span>
                        <input type="text" class="form-control fix-inputgroup" title="`+data_txt+`" style="width:100%" value="` + data_txt + `" readonly disabled>
                        <input type="hidden" name="packing_types[` + count + `][id]" value="` + data_id + `">
                    </div>

                    <div class="input-group add-c-count">
                        <span class="input-group-addon beautiful" >Quantity</span>
                        <input type="text" class="form-control mylos" value="1" name="packing_types[` + count + `][mdoza]" required>
                    </div>
                    <div class="input-group add-c-unit">
                        <span class="input-group-addon ">Packing</span>
                        <select class="selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1"  name="packing_types[` + count + `][vdoza]" title="-" required>
                            {if $drug_types}{foreach $drug_types as $key=>$value}
                            <option value="{$value->id}">{$value->name}</option>
                            {/foreach}{/if}
                        </select>
                    </div>
                    <div >
                        <button type="button" class="plus_item" data-id="` + count + `" data-type="packing_types"></button>
                        <button type="button" class="minus_item"></button>
                    </div>
                    <div class="extra-mg"></div>

                    <button type="button" class="btn remove-item remove-item-dossage" data-toggle="tooltip" data-placement="top" title="" data-cid="`+data_id+`" > </button>


                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>`;
            return component;
        }
        function addmedicalClassification(count, data_txt, data_no, data_formula, data_target, data_id) {
            var component =
                `<div class="form-group col-md-3 no-padding label_` + data_id + `" >
                <div class="input-group">
                    <input type="text" class="form-control mylos fix-inputgroup" value="` + data_txt + `" readonly>
                    <input type="hidden" value="` + data_id + `" name="classifiction[` + count + `]" readonly>
                    <span class="input-group-btn">
                          <button type="button" class="btn remove-item remove-item-classifiction" data-cid="`+data_id+`" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"></button>
                    </span>
                </div>
            </div>`;
            return component;
        }
        function addCasNumber(count, data_txt, data_no, data_formula, data_target, data_id) {
            data_txt = data_txt.replace('"','');

            var component =
                `<div class="form-group cas-add-row vared casNumberRow label_` + data_id + `">
                <div class="col-md-2 no-padding label_add_prod">
                    <label data-txt='(CAS Number)'>Ingredient ` + count + `</label>
                    <input type="hidden" name="cass[` + count + `][id]" value="` + data_id + `">

                    <button type="button" class="btn remove-item remove-c-row" data-toggle="tooltip" data-placement="top" title="" data-cid="`+data_id+`"> </button>
                </div>
                <div class="col-md-12 no-padding add-c-row">
                    <div class="input-group add-c-code add-cas-code">
                        <span class="input-group-addon beautiful" >CAS No</span>
                        <input type="text" class="form-control fix-inputgroup" title="`+data_no+`" value="`+data_no+`" readonly disabled>
                    </div>
                    <div class="input-group add-c-code add-cas-formula">
                        <span class="input-group-addon beautiful" >Formula</span>
                        <input type="text" class="form-control fix-inputgroup" title="`+data_formula+`" value="`+data_formula+`" readonly disabled>
                    </div>

                    <div class="input-group add-c-name">
                        <span class="input-group-addon beautiful" >Name</span>
                        <input type="text" class="form-control fix-inputgroup" title="`+data_txt+`" value="`+data_txt+`" readonly disabled>
                    </div>

                    <div class="input-group add-c-unit add-c-purity">
                        <span class="input-group-addon ">Purity</span>
                        <select class="selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="cass[` + count + `][purity_unit]" style="z-index:1040;">
                                    {if $puritys}{foreach $puritys as $key=>$purity}
                                    <option value="{$purity->id}" data-code="{$purity->code}"> {$purity->code} </option>
                                    {/foreach}{/if}
                        </select>
                    </div>
                    <div class="input-group add-c-unit add-c-purity">
                    <span class="input-group-addon beautiful" >Purity(%)</span>
                        <input type="text" class="form-control" name="cass[` + count + `][purity]">
                    </div>
                    <div class="input-group add-c-count add-c-purity" >
                            <span class="input-group-addon beautiful">Quantity</span>
                           <input type="text" class="form-control mylos"value="1"  name="cass[` + count + `][mdoza]" required>
                    </div>
                    <div class="input-group add-c-unit" >
                    <span class="input-group-addon ">Dose unit</span>
                       <select class=" selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1"  name="cass[` + count + `][vdoza]" required>
                                <option value="">-</option>
                                {if $unit}{foreach $unit as $key=>$value}
                                <option value="{$value->id}" data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
                                {/foreach}{/if}
                            </select>
                    </div>

                     <div >
                                <button type="button" class="plus_item" data-id="` + count + `" data-type="cass"></button>
                                <button type="button" class="minus_item"></button>
                            </div>
                            <div class="extra-mg" style="margin-left:0;"></div>




                    <div class="extra-mg2" style="margin-left:0"></div>

                </div>
                <div class="clearfix"></div>
            </div>`;
            return component;
        }

        $(document).on('click', '.plus_item', function(e){
            if(!$(e.target).hasClass('fa-info')){
                var data_id = $(this).data('id');
                var data_type = $(this).data('type');
                var component =
                    `<div class="input-group add-c-count">
                <span class="input-group-addon ">Quantity</span>
                <input type="text" class="form-control " name="`+data_type+`[`+data_id+`][mdoza2]" value="">
             </div>
             <div class="input-group add-c-unit">
             <span class="input-group-addon ">Volume unit</span>
                <select class=" selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="` + data_type + `[` + data_id + `][vdoza2]">
                    <option value="">-</option>
                    {if $unit}{foreach $unit as $key=>$value}
                    <option value="{$value->id}" data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
                    {/foreach}{/if}
                </select>
             </div>`;

                var component2 = `<div class="input-group add-c-unit add-c-acode" >
                        <span class="input-group-addon beautiful" >ATC Code</span>
                        <div class="form-inline" >
                             <input type="text" class="form-control mylos tagsinput atc_code_input" name="` + data_type + `[` + data_id + `][atc_code]" data-role="tagsinput" multiple>
                        </div>
                    </div>`;


                $(this).parent().parent().find('div.extra-mg').append(component);
                $(this).parent().parent().find('div.extra-mg2').append(component2);
                var slp =  $('.selectpicker').selectpicker();
                slp.on('shown.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                    $(e.target).parent().siblings('label').css('z-index', 9999999999);

                });
                slp.on('hidden.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                    $(e.target).parent().siblings('label').css('z-index', 555);

                });

                var citynames = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    local: $.map(general, function(city) {
                        return {
                            value: city.value,
                            name: city.name
                        };
                    })
                });

                $('.extra-mg2 input.atc_code_input').tagsinput({
                    typeaheadjs: {
                        name: 'citynames',
                        displayKey: 'name',
                        valueKey: 'name',
                        source: citynames.ttAdapter()
                    }
                });
                $(this).hide();
                $(this).parent().find('.minus_item').show();
            }
        });
        $(document).on('click', '.minus_item', function(e){
            if(!$(e.target).hasClass('fa-info')){
                $(this).parent().parent().find('div.extra-mg').empty();
                $(this).parent().parent().find('div.extra-mg2').empty();
                $(this).hide();
                $(this).parent().find('.plus_item').show();
            }
        });
    </script>
{literal}
    <script type="text/javascript">
        $(document).ready(function(){
            var fin = [];
            $('select.product_type_select').on('change', function(e){
                var selected = $(this).find('option:selected').val();
                if(selected != 0){
                    $.isLoading({text:""});
                    e.preventDefault();
                    $('.brandname').removeAttr('disabled');
                    $('.content_add').show();
                    $('.frist-inner').empty().css('padding','0px');

                    $('.add-product-nav-ul li:nth-child(2)').siblings().removeClass('active');
                    $('.add-product-nav-ul li:nth-child(2)').addClass('active');


                    $.ajax({
                        type:'POST',
                        url: site_url + 'product/type/',
                        data: {'value':selected},
                        cache:false,
                        success:function(data){
                            var obj = jQuery.parseJSON(data);
                            json = {
                                id : obj[0].id,
                                name : obj[0].name,
                                settings : [{
                                    visible : [{
                                        chemical : obj[0].chemical_visible,
                                        herbal : obj[0].herbal_visible,
                                        animal : obj[0].animal_visible,
                                        casNumber : obj[0].casNumber_visible,
                                        dossageForm : obj[0].dossageForm_visible,
                                        medicalClassifiction : obj[0].medicalClassifiction_visible,
                                        moreInfo : obj[0].moreInfo_visible,
                                        brandName : obj[0].brandName_visible,
                                        country : obj[0].country_visible,
                                    }],
                                    multiple : [{
                                        chemical : obj[0].chemical_multiple,
                                        herbal : obj[0].herbal_multiple,
                                        casNumber : obj[0].casNumber_multiple,
                                        dossageForm : obj[0].dossageForm_multiple,
                                        medicalClassifiction : obj[0].medicalClassifiction_multiple
                                    }]
                                }]
                            };
                            $.removeCookie('setting');
                            $.cookie.json = true;
                            $.cookie('setting', json);
                            $.each(json.settings[0].visible[0], function(key, value) {
                                if (value == '1')
                                {
                                    $('.' + key).show();
                                }
                                else
                                {
                                    $('.' + key).hide();
                                }
                            });
                            $.each(json.settings[0].multiple[0], function(key, value) {
                                if (value == '1')
                                {

                                }
                                else
                                {

                                }
                            });
                            setTimeout(function(){$.isLoading("hide"); }, 1000);

                        },
                        error: function(){
                            setTimeout(function(){$.isLoading("hide"); }, 1000);
                        }
                    });
                    e.preventDefault();
                    return false;
                }
                else{
                    $('.brandname').attr('disabled','disabled');
                    $('.content_add').hide();
                }
            });
        });

        function finaly(_this)
        {
            $.isLoading({text: ""});
            $('.btn-dossage').removeClass('active');
            $('.target').removeClass('active');
            _this.addClass('active');
            var target = _this.attr('data-target');
            $('.periodic').removeClass('in');
            $(target).addClass('in');
            var target_str = target.replace('#','');
            $('.search-inner').html('<h2>Select ' +target_str + ' items</h2>').find('h2').animate({marginLeft: "0px"}, 500);
            $('.search-inner').append('<span class="fa fa-times"></span>');
            $('.search-tool').addClass('col-md-3');
            $('.search-tool').show();

            $('body').append('<div class="blackstack"></div>');
            setTimeout(function () { $.isLoading("hide"); }, 200);
            $('.module-search').val('').trigger('keyup');
            //       $('.module-search').css('border', '1px solid red').trigger( "focus" );
        }

        $(document).on('click', '.target , .dossage', function () {

            var cookies = $.cookie('setting');

            var brandname = $('.brandname');

            if(cookies.settings[0].visible[0].brandName == '1')
            {
                //   brandname.attr('required');
                /*  if(brandname.val() == '')
                  {
                      brandname.css('border','1px solid red');
                  }
                  else{*/
                brandname.removeAttr('style');
                finaly($(this));
                // }
            }else{
                finaly($(this));
            }


        });


        $('.storage-select').change(function(){
            var value = $(this).val();
            if(value == 8)
            {
                $('.storage-input').show();
            }
            else
            {
                $('.storage-input').hide();
            }
        });

    </script>
{/literal}
    <script type="text/javascript">
        var fore = 1;
        var count = 1;
        var general = {$parent_cal};
        var come = 0;
        var chemicalcount = 0;
        var herbalcount = 0;
        var animalcount = 0;
        var dossageFormCount = 0;
        var medicalClassificationCount = 0;
        {literal}
        $(document).on('click keydown', '.discom ul.in li', function(e) {
            if (!$(this).hasClass('selected')) {
                e.preventDefault();
                $(this).addClass('selected');
                var data_txt        = $(this).attr('data-txt');
                var data_target     = $(this).attr('data-target');
                var data_id         = $(this).attr('data-id');
                var data_no         = $(this).attr('data-no');
                var data_formula    = $(this).attr('data-formula');
                var cookies         = $.cookie('setting');
                //console.log(cookies);
                $('.frist-inner').prev('.add-pr-heading').remove();
                //$('.frist-inner').before('<h2 class="add-pr-heading forcontent" id="section2">Ingredients - <span>Ingreidents and dosages</span></h2>');


                if(data_target == 'chemical')
                {
                    if(cookies.settings[0].multiple[0].chemical == '1')
                    {
                        var component = addChermical(count, data_txt,data_no, data_formula , data_target, data_id);
                        $('.frist-inner').append(component);
                        var slp =  $('.selectpicker').selectpicker();
                        slp.on('shown.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                            $(e.target).parent().siblings('label').css('z-index', 9999999999);

                        });
                        slp.on('hidden.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                            $(e.target).parent().siblings('label').css('z-index', 555);

                        });
                        $('.bs-searchbox').each(function(){
                            $(this).prop('placeholder','Search');
                        })
                        // $('.search-tool').removeClass('col-md-3');

                        // $('.blackstack').remove();
                        //$('.search-tool').hide();


                        $(".two-column").slideDown( "slow", function(){});

                        $('.add-product-nav-ul li:nth-child(3)').siblings().removeClass('active');
                        $('.add-product-nav-ul li:nth-child(3)').addClass('active');

                        count += 1;
                        chemicalcount +=1;
                    }
                    else
                    {
                        if(chemicalcount < 1)
                        {
                            var component = addChermical(count, data_txt,data_no, data_formula , data_target, data_id);
                            $('.frist-inner').append(component);
                            var slp =  $('.selectpicker').selectpicker();
                            slp.on('shown.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                                $(e.target).parent().siblings('label').css('z-index', 9999999999);

                            });

                            slp.on('hidden.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                                $(e.target).parent().siblings('label').css('z-index', 555);

                            });
                            //   $('.search-tool').removeClass('col-md-3');

                            //   $('.blackstack').remove();
                            //        $('.search-tool').hide();
                            $(".two-column").slideDown( "slow", function(){});
                            $('.add-product-nav-ul li:nth-child(3)').siblings().removeClass('active');
                            $('.add-product-nav-ul li:nth-child(3)').addClass('active');
                            chemicalcount +=1;
                        }
                    }
                    $('.form-group.vared').each(function(index, el) {
                        var ind = index+1;
                        $(el).find('.label_add_prod label').text('Ingredient '+ind+" (Atc code)");
                    });

                }
                else if(data_target == 'herbal')
                {
                    if(cookies.settings[0].multiple[0].herbal == '1')
                    {
                        var component = addHerbal(count, data_txt,data_no, data_formula , data_target, data_id);
                        $('.frist-inner').append(component);
                        var slp =  $('.selectpicker').selectpicker();
                        slp.on('shown.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                            $(e.target).parent().siblings('label').css('z-index', 9999999999);

                        });
                        slp.on('hidden.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                            $(e.target).parent().siblings('label').css('z-index', 555);

                        });
                        /*   $('.search-tool').removeClass('col-md-3');

                           $('.blackstack').remove();
                           $('.search-tool').hide();*/



                        $(".two-column").slideDown( "slow", function(){});
                        $('.add-product-nav-ul li:nth-child(3)').siblings().removeClass('active');
                        $('.add-product-nav-ul li:nth-child(3)').addClass('active');
                        count += 1;
                        herbalcount += 1;
                    }
                    else
                    {
                        if(herbalcount < 1)
                        {
                            var component = addHerbal(count, data_txt,data_no, data_formula , data_target, data_id);
                            $('.frist-inner').append(component);
                            var slp =  $('.selectpicker').selectpicker();
                            slp.on('shown.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                                $(e.target).parent().siblings('label').css('z-index', 9999999999);

                            });
                            slp.on('hidden.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                                $(e.target).parent().siblings('label').css('z-index', 555);

                            });
                            /* $('.search-tool').removeClass('col-md-3');

                             $('.blackstack').remove();
                             $('.search-tool').hide();*/

                            $(".two-column").slideDown( "slow", function(){});
                            $('.add-product-nav-ul li:nth-child(3)').siblings().removeClass('active');
                            $('.add-product-nav-ul li:nth-child(3)').addClass('active');
                            herbalcount += 1;
                        }
                    }

                    $('.form-group.vared').each(function(index, el) {
                        var ind = index+1;
                        $(el).find('.label_add_prod label').text('Ingredient '+ind);
                    });
                }
                else if (data_target == 'animal')
                {
                    if(cookies.settings[0].multiple[0].animal == '1')
                    {
                        var component = addAnimal(count, data_txt,data_no, data_formula , data_target, data_id);
                        $('.frist-inner').append(component);
                        var slp =  $('.selectpicker').selectpicker();
                        slp.on('shown.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                            $(e.target).parent().siblings('label').css('z-index', 9999999999);

                        });
                        slp.on('hidden.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                            $(e.target).parent().siblings('label').css('z-index', 555);

                        });
                        /*   $('.search-tool').removeClass('col-md-3');

                           $('.blackstack').remove();
                           $('.search-tool').hide();*/

                        $(".two-column").slideDown( "slow", function(){});
                        $('.add-product-nav-ul li:nth-child(3)').siblings().removeClass('active');
                        $('.add-product-nav-ul li:nth-child(3)').addClass('active');
                        count += 1;
                        animalcount += 1;

                    }
                    else
                    {
                        if(animalcount < 1)
                        {
                            var component = addAnimal(count, data_txt,data_no, data_formula , data_target, data_id);
                            $('.frist-inner').append(component);
                            var slp =  $('.selectpicker').selectpicker();
                            slp.on('shown.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                                $(e.target).parent().siblings('label').css('z-index', 9999999999);

                            });
                            slp.on('hidden.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                                $(e.target).parent().siblings('label').css('z-index', 555);

                            });
                            /* $('.search-tool').removeClass('col-md-3');

                             $('.blackstack').remove();
                             $('.search-tool').hide();
 */
                            $(".two-column").slideDown( "slow", function(){});
                            $('.add-product-nav-ul li:nth-child(3)').siblings().removeClass('active');
                            $('.add-product-nav-ul li:nth-child(3)').addClass('active');
                            count += 1;
                            animalcount += 1;
                        }
                    }

                    $('.form-group.vared').each(function(index, el) {
                        var ind = index+1;
                        $(el).find('.label_add_prod label').text('Ingredient '+ind);
                    });
                }
                else if (data_target == 'casNumber')
                {
                    if(cookies.settings[0].multiple[0].casNumber == '1')
                    {
                        var component = addCasNumber(count, data_txt,data_no, data_formula , data_target, data_id);
                        $('.frist-inner').append(component);
                        var slp =  $('.selectpicker').selectpicker();
                        slp.on('shown.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                            $(e.target).parent().siblings('label').css('z-index', 9999999999);

                        });
                        slp.on('hidden.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                            $(e.target).parent().siblings('label').css('z-index', 555);

                        });
                        var citynames = new Bloodhound({
                            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
                            queryTokenizer: Bloodhound.tokenizers.whitespace,
                            local: $.map(general, function(city) {
                                return {
                                    value: city.value,
                                    name: city.name
                                };
                            })
                        });
                        $('input.atc_code_input').tagsinput({
                            typeaheadjs: {
                                name: 'citynames',
                                displayKey: 'name',
                                valueKey: 'name',
                                source: citynames.ttAdapter()
                            }
                        });

                        $('.search-tool').removeClass('col-md-3');

                        $('.blackstack').remove();
                        $('.search-tool').hide();

                        $(".two-column").slideDown( "slow", function(){});
                        $('.add-product-nav-ul li:nth-child(3)').siblings().removeClass('active');
                        $('.add-product-nav-ul li:nth-child(3)').addClass('active');
                        count += 1;
                        come += 1;
                    }
                    else
                    {
                        if(come < 1)
                        {
                            var component = addCasNumber(count, data_txt,data_no, data_formula , data_target, data_id);
                            $('.frist-inner').append(component);
                            var slp =  $('.selectpicker').selectpicker();
                            slp.on('shown.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                                $(e.target).parent().siblings('label').css('z-index', 9999999999);

                            });
                            slp.on('hidden.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                                $(e.target).parent().siblings('label').css('z-index', 555);

                            });
                            var citynames = new Bloodhound({
                                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
                                queryTokenizer: Bloodhound.tokenizers.whitespace,
                                local: $.map(general, function(city) {
                                    return {
                                        value: city.value,
                                        name: city.name
                                    };
                                })
                            });
                            $('input.atc_code_input').tagsinput({
                                typeaheadjs: {
                                    name: 'citynames',
                                    displayKey: 'name',
                                    valueKey: 'name',
                                    source: citynames.ttAdapter()
                                }
                            });
                            $('.casNumber').addClass('disabled').prop('disabled',true);
                            $('.search-tool').removeClass('col-md-3');

                            $('.blackstack').remove();
                            $('.search-tool').hide();

                            $(".two-column").slideDown( "slow", function(){});
                            $('.add-product-nav-ul li:nth-child(3)').siblings().removeClass('active');
                            $('.add-product-nav-ul li:nth-child(3)').addClass('active');
                            count += 1;
                            come += 1;
                        }
                    }
                }
                else if (data_target == 'dossageForm')
                {
                    if(cookies.settings[0].multiple[0].casNumber == '1')
                    {
                        var component = addDossageForm(count, data_txt,data_no, data_formula , data_target, data_id);
                        $('.dossageForm-inner').show();
                        $('.dossageForm-inner').append(component);
                        $('.dossage-limit').hide();
                        var slp =  $('.selectpicker').selectpicker();
                        slp.on('shown.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                            $(e.target).parent().siblings('label').css('z-index', 9999999999);

                        });
                        slp.on('hidden.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                            $(e.target).parent().siblings('label').css('z-index', 555);

                        });
                        $('.search-tool').removeClass('col-md-3');

                        $('.blackstack').remove();
                        $('.search-tool').hide();
                        $('.add-product-nav-ul li:nth-child(4)').siblings().removeClass('active');
                        $('.add-product-nav-ul li:nth-child(4)').addClass('active');
                        $(".three-column").slideDown( "slow", function(){});
                        count += 1;
                        dossageFormCount += 1;
                    }
                    else
                    {
                        if(dossageFormCount < 1)
                        {
                            var component = addDossageForm(count, data_txt,data_no, data_formula , data_target, data_id);
                            $('.dossageForm-inner').show();
                            $('.dossageForm-inner').append(component);
                            $('.dossage-limit').hide();
                            var slp =  $('.selectpicker').selectpicker();
                            slp.on('shown.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                                $(e.target).parent().siblings('label').css('z-index', 9999999999);

                            });
                            slp.on('hidden.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                                $(e.target).parent().siblings('label').css('z-index', 555);

                            });
                            $('.search-tool').removeClass('col-md-3');
                            $('.add-product-nav-ul li:nth-child(4)').siblings().removeClass('active');
                            $('.add-product-nav-ul li:nth-child(4)').addClass('active');
                            $(".three-column").slideDown( "slow", function(){});
                            $('.blackstack').remove();
                            $('.search-tool').hide();

                            $(".two-column").slideDown( "slow", function(){});
                            $('.add-product-nav-ul li:nth-child(3)').siblings().removeClass('active');
                            $('.add-product-nav-ul li:nth-child(3)').addClass('active');
                            count += 1;
                            dossageFormCount += 1;
                        }
                    }
                }
                else if (data_target == 'medicalClassification')
                {
                    var component = addmedicalClassification(count, data_txt,data_no, data_formula , data_target, data_id);
                    $('.medicalClassifiction-inner').show();
                    $('.medicalClassifiction-inner').append(component);
                    var slp =  $('.selectpicker').selectpicker();
                    slp.on('shown.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                        $(e.target).parent().siblings('label').css('z-index', 9999999999);

                    });
                    slp.on('hidden.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                        $(e.target).parent().siblings('label').css('z-index', 555);

                    });

                    count += 1;
                }
                else
                {
                    return false;
                }

                e.preventDefault();
                return false;
            }
        });
        $(document).on('click keydown', '.discom ul.in li.selected', function(e) {
            e.preventDefault();
            $(this).removeClass('selected');
            var data_txt        = $(this).attr('data-txt');
            var data_target     = $(this).attr('data-target');
            var data_id         = $(this).attr('data-id');
            var data_no         = $(this).attr('data-no');
            var data_formula    = $(this).attr('data-formula');
            var cookies         = $.cookie('setting');
            $('.label_'+data_id).remove();
            e.preventDefault();
            return false;
        });
        $(document).on('click', '.add-button-photos', function(e) {
            e.preventDefault();
            fore = fore +1;

            if($('.img-upload-group').length < 10){
                comp = `<div class="img-upload-group add bitrix" var-attr="lab_`+fore+`">
                        <div class="reload-form-upload">
                            <label>
                                <input type="file" name="userfile[]" class="userfile" accept="image/gif, image/jpg, image/png, image/jpeg">
                                <button type="button" class="mini-upload upload-button" data-id="" data-target="">UPLOAD</button>
                            </label>
                        </div>
                    </div>`;

                $(comp).insertBefore('.add_more_img');
            }

            e.preventDefault();
            return false;
        });
       
        {/literal}
    </script>

    <script type="text/javascript">
        $(document).ready(function (){


            $('.product_type').on('change', function(){
                var search = [];
                $.each($('.product_type option:selected'), function(){
                    search.push($(this).val());
                });
                search = search.join('|');
                regExSearch = '^\\s' + search +'\\s*$';
                table.column(1).search(search, true, false).draw();
            });

            $('.select_content').on('change', function(){
                var search = [];
                $.each($('.select_content option:selected'), function(){
                    search.push($(this).val());
                });
                search = search.join('|');
                regExSearch = '^\\s' + search +'\\s*$';
                table.column(3).search(search, true, false).draw();
            });
            $('.select_dossage').on('change', function(){
                var search = [];
                $.each($('.select_dossage option:selected'), function(){
                    search.push($(this).val());
                });
                search = search.join('|');
                regExSearch = '^\\s' + search +'\\s*$';
                table.column(4).search(search, true, false).draw();
            });
            $('.select_country').on('change', function(){
                var search = [];
                $.each($('.select_country option:selected'), function(){
                    search.push($(this).val());
                });
                search = search.join('|');
                regExSearch = '^\\s' + search +'\\s*$';
                table.column(5).search(search, true, false).draw();
            });
            $('.select_medical').on('change', function(){
                var search = [];
                $.each($('.select_medical option:selected'), function(){
                    search.push($(this).val());
                });
                search = search.join('|');
                regExSearch = '^\\s' + search +'\\s*$';
                table.column(6).search(search, true, false).draw();
            });
            $('.select_company').on('change', function(){
                var search = [];
                $.each($('.select_company option:selected'), function(){
                    search.push($(this).val());
                });
                search = search.join('|');
                regExSearch = '^\\s' + search +'\\s*$';
                table.column(7).search(search, true, false).draw();
            });
            $('.brand_name').on('change', function(){
                var  search = $(this).val();
                table.column(2).search(search, true, false).draw();
            });
        });


    </script>

    <script>
        {literal}

        var top_offset1 = 72;
        var top_offset2 = 107;
        var top_offset3 = 242;
        var top_offset33 = 247;
        if ($(".searchTable").length){


        }


        var somethingChanged = false;
        $('#add-product select').on('change',function(){
            somethingChanged = true;
            console.log($(this));
        });
        $('#add-product input[type="text"]').on('keyup',function(){
            somethingChanged = true;
            console.log($(this));
        });

        $(window).bind('beforeunload', function(e){
            if ($(e.target.activeElement).attr('type') != 'submit' && somethingChanged){
                return 'You have unsaved changes; are you sure you want to leave this page?';
            }
        });
        $('.bootstrap-select.btn-group').on('click',function(){
            if($(this).hasClass('open')){
                $(this).prev('label').css('z-index','99999999999');
            }
            else{
                $(this).prev('label').css('z-index','555');
            }
        })

        {/literal}
    </script>
{literal}
    <script>
        // When the user scrolls the page, execute myFunction
        window.onscroll = function() {myFunction()};

        var eTop = $('#addProductNav').offset().top; //get the offset top of the element


        // Get the navbar
        var navbar = $("#addProductNav");

        // Get the offset position of the navbar
        var sticky = eTop - $(window).scrollTop();


        // Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
        function myFunction() {
            if (window.pageYOffset >= sticky) {
                navbar.addClass("isfixed")
            } else {
                navbar.removeClass("isfixed");
            }
        }

        $('#addProductNav li a').click(function(e) {
            e.preventDefault();
            var targetUrl = $(this).attr('href');
            $(this).parent().siblings().removeClass('active');
            $(this).parent().addClass('active');
            $('html, body').animate({
                scrollTop: $(targetUrl).offset().top-85
            }, 800);
        });


        $(document).on('click', '.remove-item', function(e) {
            if(!e.handle){
                e.handle=true;
                var id = $(this).data('cid');
                var that = $(this);
                if(confirm('Are you sure?')){

                    var parentrow = that.parent().parent();
                    parentrow.remove();

                    if(that.parent().parent().hasClass('cas-add-row')){
                        $('.casNumber').removeAttr('disabled').removeClass('disabled');
                        come--;
                    }

                    $('.search-tool li[data-id="'+id+'"]').removeClass('selected');

                    $('.form-group.vared').each(function(index, el) {
                        var ind = index+1;
                        $(el).find('.label_add_prod label').text('Ingredient '+ind);
                    });

                }
            }
        });

        $(document).on('click','.search-inner .fa-times', function(){
            $('.search-tool').removeClass('col-md-3');
            $('.blackstack').remove();
            $('.search-tool').hide();
        });


        $(document).on('submit','.comfirmAccount', function(e){
            e.preventDefault();
            var formData = new FormData($(this)[0]);
            $.ajax({
                type:'POST',
                url:site_url+'profile/comfirmAccount/',
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                success:function(data){
                    var obj = JSON.parse(data);
                    if(obj.type == 'success')
                    {
                        $('#comfirmAccount').modal('hide');
                        $('.left-button-area button').removeAttr('onclick').addClass('send-us-certifcate').text('Send your information');
                        toastr.success(obj.message);
                    }
                    else
                    {
                        toastr.error(obj.message);
                    }
                }
            });
            e.preventDefault();
            return false;
        });

        $(document).ready(function() {
            if($('.dataTables_paginate>span').length == 0){
                $('.dataTables_paginate').hide();
                /*$('#return-to-pages ').on('click', function(){
                    window.location ='https://demo.makromedicine.com/profile/create-page';
                })*/
            }
        });




    </script>
{/literal}
{/block}
