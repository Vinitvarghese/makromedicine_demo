{extends file=$layout} {block name=content}
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
     table-layout:fixed;
    }
</style>
<div class="wrap margin-top-100 col-md-12">
    <div class="container-fuild">
        <div class="row">
            <div class="clearfix"></div>
            <div class="col-md-12" id="add-product">
                <div class="col-md-12 no-padding add-product {if isset($message)} in {/if}" id="collapseExample">
                    <div class="col-md-12 no-padding panel-add">
                        <form class="editProductForm" role="form" method="POST" action="{site_url_multi('tender/add')}">
                            <input type="hidden" name="request" value="update">
                            <input type="hidden" name="tender_id" value="{$tender->id}">
                            <div class="no-padding search-tool" style="display:none;">
                                <div class="col-md-12 malecule">
                                    <div class="search-module">
                                        <input type="text" class="module-search" placeholder="Search">
                                        <div class="search-inner"></div>
                                    </div>
                                    <div class="col-md-12 no-padding discom">
                                        <ul class="list-chemical periodic collapse" id="chemical">
                                            {if $chemichal}{foreach from=$chemichal item=chemical}
                                            <li data-txt="{$chemical->meaning}" data-no="{$chemical->atc_code}" data-formula="" data-target="chemical" data-id="{$chemical->id}">
                                                <a href="#{$chemical->atc_code}">
                                                    <div class="lib-span" data-toggle="tooltip" data-placement="right" title="{$chemical->atc_code} | {$chemical->meaning}">{$chemical->atc_code} </div>
                                                    <div class="lib-span2"> | {mb_substr($chemical->meaning, 0, 15, 'UTF-8')}</div>
                                                </a>
                                            </li>
                                            {/foreach}{/if}
                                        </ul>
                                        <ul class="list-herbal periodic collapse" id="herbal">
                                            {if $herbals} {foreach from=$herbals item=herbal}
                                            <li data-txt="{$herbal->name}" data-no="" data-formula="" data-target="herbal" data-id="{$herbal->id}"> <a href="#" data-toggle="tooltip" data-placement="right" title="{$herbal->name}">{$herbal->name}</a> </li>
                                            {/foreach}{/if}
                                        </ul>
                                        <ul class="list-animal periodic collapse" id="animal">
                                            {if $animals} {foreach from=$animals item=animal}
                                            <li data-txt="{$animal->name}" data-no="" data-formula="" data-target="animal" data-id="{$animal->id}"> <a href="#" data-toggle="tooltip" data-placement="right" title="{$animal->name}">{$animal->name}</a> </li>
                                            {/foreach}{/if}
                                        </ul>
                                        <ul class="list-casNumber periodic collapse" id="casNumber">
                                            {if $cas_numbers} {foreach from=$cas_numbers item=cas_number}
                                            <li data-txt="{htmlentities($cas_number->chemical_name)}" data-no="{$cas_number->cas_no}" data-formula="{$cas_number->molecular_formula}" data-target="casNumber" data-id="{$cas_number->id}">
                                                <a href="#{$cas_number->cas_no}" title="{htmlentities($cas_number->chemical_name)}">
                                                    <div class="lib-span3" data-toggle="tooltip" data-placement="right" title="{$cas_number->chemical_name}">{$cas_number->cas_no} </div>
                                                    <div class="lib-span4"> | {mb_substr($cas_number->chemical_name, 0, 14, 'UTF-8')}</div>
                                                </a>
                                            </li>
                                            {/foreach}{/if}
                                        </ul>
                                        <ul class="list-dossageForm periodic collapse" id="dossageForm">
                                            {if $dossageforms} {foreach from=$dossageforms item=dossageform}
                                            <li data-txt="{$dossageform->name}" data-no="" data-formula="" data-target="dossageForm" data-id="{$dossageform->id}"> <a href="#" data-toggle="tooltip" data-placement="right" title="{$dossageform->name}">{$dossageform->name}</a> </li>
                                            {/foreach}{/if}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 no-padding specilation">
                                <div class="col-md-12 add-frist">
                                    
                                    <div class="form-group">

                                        <div class="col-md-5 no-padding">

                                            <div class="col-md-4 no-padding" style="margin-bottom:15px;">
                                                <label>Product type</label>
                                            </div>
                                            <div class="col-md-7 no-padding" style="margin-bottom:15px;">
                                                <select name="pr_type" class="form-control mylos selectpicker show-menu-arrow product_type_select" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" title="Please Select Type">
                                                    {if $product_type}{foreach $product_type as $key=>$type}
                                                    <option value="{$type->id}" {if $tender->pr_type eq $type->id}selected="selected"{/if} >{$type->name}</option>
                                                    {/foreach}{/if}
                                                </select>
                                            </div>

                                            <div class="clearfix"></div>

                                            <div class="col-md-4 no-padding" style="margin-bottom:15px;">
                                                <label>Continent</label>
                                            </div>
                                            <div class="col-md-7 no-padding" style="margin-bottom:15px;">
                                                <select name="continent" class="form-control mylos selectpicker show-menu-arrow continent_select" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" title="Please Select Continent">
                                                    {if $continents}{foreach $continents as $key=>$continent}
                                                    <option value="{$continent->id}" {if $tender->continent eq $continent->id}selected="selected"{/if} >{$continent->name}</option>
                                                    {/foreach}{/if}
                                                </select>
                                            </div>

                                            <div class="clearfix"></div>

                                            <div class="col-md-4 no-padding" style="margin-bottom:15px;">
                                                <label>Start date</label>
                                            </div>
                                            <div class="col-md-7 no-padding" style="margin-bottom:15px;">
                                                <input type="date" name="tenderstart" class="form-control mylos tenderstart" placeholder="Select start date" value="{date('Y-m-d', strtotime($tender->startdate))}">
                                            </div>

                                            <div class="clearfix"></div>

                                            <div class="col-md-4 no-padding" style="margin-bottom:15px;">
                                                <label>Tender name</label>
                                            </div>
                                            <div class="col-md-7 no-padding" style="margin-bottom:15px;">
                                                <input type="text" name="title" class="form-control mylos tendername" placeholder="Tender name" value="{$tender->title}">
                                            </div>


                                        </div>

                                        <div class="col-md-6 no-padding">

                                            <div class="col-md-2 col-lg-2 no-padding" style="margin-bottom:15px;">
                                                <label>Trade term</label>
                                            </div>
                                            <div class="col-md-4 no-padding" style="margin-bottom:15px;">
                                                <select name="trade_term" class="form-control mylos selectpicker show-menu-arrow trade_term_select" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" title="Please Select trade term">
                                                    {if $trade_term}{foreach $trade_term as $key=>$term}
                                                    <option value="{$term->id}" {if $tender->trade_term eq $term->id}selected="selected"{/if} >{$term->short_name}</option>
                                                    {/foreach}{/if}
                                                </select>
                                            </div>

                                            <div class="clearfix"></div>

                                            <div class="col-md-2 col-lg-2 no-padding" style="margin-bottom:15px;">
                                            <label>Country</label>
                                            </div>
                                            <div class="col-md-4 no-padding" style="margin-bottom:15px;">
                                                <select name="country" class="form-control mylos selectpicker company-country show-menu-arrow" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1">
                                                    {if $countrys}{foreach $countrys as $key=>$country}
                                                        <option value="{$country->id}" data-name="{$country->code}" {if $tender->country eq $country->id}selected="selected"{/if} >{$country->name}</option>
                                                    {/foreach}{/if}
                                                </select>
                                            </div>

                                            <div class="clearfix"></div>

                                            <div class="col-md-2 col-lg-2 no-padding" style="margin-bottom:15px;">
                                                <label>End date</label>
                                            </div>
                                            <div class="col-md-4 no-padding" style="margin-bottom:15px;">
                                                <input type="date" name="tenderend" class="form-control mylos tenderend" placeholder="Select end date" value="{date('Y-m-d', strtotime($tender->startdate))}">
                                            </div>


                                        </div>

                                        <div class="clearfix row" style="margin-bottom: 20px;">
                                             <div class="col-md-12 frist-inner"></div>
                                        </div>
                                        <div class="col-md-9 no-padding content_add">
                                            <div class="col-md-2 no-padding">
                                                <label>Add new content</label>
                                            </div>
                                            <div class="col-md-10">
                                                <button type="button" class="target chemical" data-widget="" data-target="#chemical" >ATC Code +</button>
                                                <button type="button" class="target herbal" data-widget="" data-target="#herbal" >Herbal +</button>
                                                <button type="button" class="target animal" data-widget="" data-target="#animal">Animal + </button>
                                                <button type="button" class="target casNumber" data-widget="" data-target="#casNumber">CAS Number +</button>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="clearfix"></div>

                                </div>
                                <div class="col-md-12 frist-inner">
                                    {assign var=count value=1} {assign var=atc_codes value=json_decode($tender->atc_code)} {if !empty($atc_codes)} {foreach from=$atc_codes item=atc_code}
                                    <div class="form-group vared label_{$atc_code->id}">
                                        <div class="col-md-2 no-padding label_add_prod">
                                            <label>Ingredient {$count}</label>
                                            <input type="hidden" name="atc_codes[{$count}][id]" value="{$atc_code->id}">
                                        </div>
                                        <div class="col-md-3 no-padding">
                                            <div class="input-group">
                                                <span class="input-group-addon beautiful" style="width:101px;">Atc code</span>
                                                <input type="text" class="form-control fix-inputgroup" value="{get_atc_code_name($atc_code->id)}" reaadonly disabled>
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-addon beautiful" style="width:101px;">NAME</span>
                                                <input type="text" class="form-control fix-inputgroup" value="{get_atc_code_no($atc_code->id)}" reaadonly disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-1" style="border-right:1px solid rgb(209, 209, 209);">
                                            <button type="button" class="btn btn-danger btn-bix pull-right remove-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"> <i class="fa fa-trash"></i> </button>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group" style="margin-bottom:5px;">
                                                <span class="input-group-addon beautiful" style="width: 95px;height: 32px;">Quantity</span>
                                                <div class="form-inline" style="">
                                                    <div style="width:82px;float:left;">
                                                        <label></label>
                                                        <input type="text" class="form-control mylos" placeholder="Quantity" name="atc_codes[{$count}][mdoza]" value="{$atc_code->mdoza}">
                                                    </div>
                                                    <div style="width:95px;float:left;">
                                                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="atc_codes[{$count}][vdoza]">
                                                            <option value="">Dose unit</option>
                                                            {if $unit} {foreach from=$unit key=$ey item=value}
                                                            <option value="{$value->id}" {if $atc_code->vdoza eq $value->id}selected="selected"{/if} data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
                                                            {/foreach} {/if}
                                                        </select>
                                                    </div>
                                                    <div style="width:20px;float:left;">
                                                        {if $atc_code->mdoza2}
                                                        <button type="button" class="plus_item" data-id="{$count}" data-type="chemicals" style="display: none;">+</button>
                                                        <button type="button" class="minus_item" style="display:block !important">-</button>
                                                        {else}
                                                        <button type="button" class="plus_item" data-id="{$count}" data-type="chemicals">+</button>
                                                        <button type="button" class="minus_item" style="display: none;">-</button>
                                                        {/if}
                                                    </div>
                                                    
                                                        {if $atc_code->mdoza2}
                                                        <div style="width:45%;float:left;" class="extra-mg">
                                                        <div class="col-sm-6 no-padding">
                                                            <input type="text" class="form-control mylos" placeholder="Quantity" name="atc_codes[{$count}][mdoza2]" value="{$atc_code->mdoza2}">
                                                        </div>
                                                        <div class="col-sm-6 no-padding">
                                                            <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="atc_codes[{$count}][vdoza2]">
                                                                <option value="">Volume unit</option>
                                                                {if $unit} {foreach from=$unit key=key item=value}
                                                                <option value="{$value->id}" {if $atc_code->vdoza2 eq $value->id }selected="selected"{/if} data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
                                                                {/foreach} {/if}
                                                            </select>
                                                        </div>
                                                         </div>
                                                        {else}
                                                             <div style="width:45%;float:left;display: none;" class="extra-mg">
                                                        <div class="col-sm-6 no-padding">
                                                            <input type="text" class="form-control mylos" placeholder="Quantity" name="atc_codes[{$count}][mdoza2]" >
                                                        </div>
                                                        <div class="col-sm-6 no-padding">
                                                            <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="atc_codes[{$count}][vdoza2]">
                                                                <option value="">Volume unit</option>
                                                                {if $unit} {foreach from=$unit key=key item=value}
                                                                <option value="{$value->id}" data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
                                                                {/foreach} {/if}
                                                            </select>
                                                        </div>
                                                         </div>
                                                        {/if}
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="clearfix"></div>
                                    {assign var=count value=$count+1} {/foreach} {/if} {assign var=herbals value=json_decode($tender->herbal)} {if !empty($herbals)} {foreach from=$herbals item=$herbal}
                                    <div class="form-group vared label_{$herbal->id}">
                                        <div class="col-md-2 no-padding label_add_prod">
                                            <label>Ingredient {$count}</label>
                                            <input type="hidden" name="herbals[{$count}][id]" value="{$herbal->id}">
                                        </div>
                                        <div class="col-md-3 no-padding">
                                            <div class="input-group">
                                                <span class="input-group-addon beautiful" style="width:101px;">Herbal</span>
                                                <input type="text" class="form-control fix-inputgroup" value="{get_herbal_name($herbal->id)}" reaadonly disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-1" style="border-right:1px solid rgb(209, 209, 209);">
                                            <button type="button" class="btn btn-danger btn-bix pull-right remove-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"> <i class="fa fa-trash"></i> </button>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group" style="margin-bottom:5px;">
                                                <span class="input-group-addon beautiful" style="width: 95px;height: 32px;">Quantity</span>
                                                <div class="form-inline" style="">
                                                    <div style="width:82px;float:left;">
                                                        <label></label>
                                                        <input type="text" class="form-control mylos" placeholder="Quantity" name="herbals[{$count}][mdoza]" value="{$herbal->mdoza}">
                                                    </div>
                                                    <div style="width:95px;float:left;">
                                                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="herbals[{$count}][vdoza]">
                                                            <option value="">Dose unit</option>
                                                            {if $unit} {foreach from=$unit key=key item=value}
                                                            <option value="{$value->id}" {if $herbal->vdoza eq $value->id}selected="selected"{/if} data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
                                                            {/foreach} {/if}
                                                        </select>
                                                    </div>
                                                    <div style="width:95px;float:left;">
                                                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="herbals[{$count}][part]">
                                                            <option class="bs-title-option" value="">Herb part</option>
                                                            {if $herb_parts} {foreach from=$herb_parts key=key item=herb_part}
                                                            <option value="{$herb_part->id}" {if $herbal->part eq $herb_part->id}selected="selected"{/if} data-code="{$herb_part->name}" title="{$herb_part->name}">{$herb_part->name}</option>
                                                            {/foreach} {/if}
                                                        </select>
                                                    </div>
                                                    <div style="width:95px;float:left;">
                                                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="herbals[{$count}][form]">
                                                            <option class="bs-title-option" value="">Herb form</option>
                                                            {if $herb_forms} {foreach from=$herb_forms key=key item=herb_form}
                                                            <option value="{$herb_form->id}" {if $herbal->form eq $herb_form->id}selected="selected"{/if} data-code="{$herb_form->name}" title="{$herb_form->name}">{$herb_form->name}</option>
                                                            {/foreach} {/if}
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="clearfix"></div>

                                    {assign var=count value=$count+1} {/foreach} {/if} {assign var=animals value=json_decode($tender->animal)} {if !empty($animals)} {foreach from=$animals item=animal}
                                    <div class="form-group vared label_{$animal->id}">
                                        <div class="col-md-2 no-padding label_add_prod">
                                            <label>Ingredient {$count}</label>
                                            <input type="hidden" name="animals[{$count}][id]" value="{$animal->id}">
                                        </div>
                                        <div class="col-md-3 no-padding">
                                            <div class="input-group">
                                                <span class="input-group-addon beautiful" style="width:101px;">Animal</span>
                                                <input type="text" class="form-control fix-inputgroup" value="{get_animal_name($animal->id)}" reaadonly disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-1" style="border-right:1px solid rgb(209, 209, 209);">
                                            <button type="button" class="btn btn-danger btn-bix pull-right remove-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"> <i class="fa fa-trash"></i> </button>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group" style="margin-bottom:5px;">
                                                <span class="input-group-addon beautiful" style="width: 95px;height: 32px;">Quantity</span>
                                                <div class="form-inline" style="">
                                                    <div style="width:82px;float:left;">
                                                        <label></label>
                                                        <input type="text" class="form-control mylos" placeholder="Quantity" name="animals[{$count}][mdoza]" value="{$animal->mdoza}">
                                                    </div>
                                                    <div style="width:95px;float:left;">
                                                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="animals[{$count}][vdoza]">
                                                            <option value="">Dose unit</option>
                                                            {if $unit} {foreach from=$unit key=key item=value}
                                                            <option value="{$value->id}" {if $animal->vdoza eq $value->id}selected="selected"{/if} data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
                                                            {/foreach} {/if}
                                                        </select>
                                                    </div>
                                                    <div style="width:95px;float:left;">
                                                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="animals[{$count}][part]">
                                                            <option class="bs-title-option" value="">Animal part</option>
                                                            {if $animal_parts} {foreach from=$animal_parts key=key item=animal_part}
                                                            <option value="{$animal_part->id}" {if $animal->part eq $animal_part->id}selected="selected"{/if} data-code="{$animal_part->name}" title="{$animal_part->name}">{$animal_part->name}</option>
                                                            {/foreach} {/if}
                                                        </select>
                                                    </div>
                                                    <div style="width:95px;float:left;">
                                                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="animals[{$count}][form]">
                                                            <option class="bs-title-option" value="">Animal form</option>
                                                            {if $animal_forms} {foreach from=$animal_forms key=key item=animal_form}
                                                            <option value="{$animal_form->id}" {if $animal->form eq $animal_form->id}selected="selected"{/if} data-code="{$animal_form->name}" title="{$animal_form->name}">{$animal_form->name}</option>
                                                            {/foreach} {/if}
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="clearfix"></div>

                                    {assign var=count value=$count+1} {/foreach} {/if} {assign var=cass value=json_decode($tender->cas)} {if !empty($cass)} {foreach from=$cass item=cas}
                                    <div class="form-group cas-add-row vared label_{$cas->id}">
                                        <div class="col-md-2 no-padding label_add_prod">
                                            <label>Ingredient {$count}</label>
                                            <input type="hidden" name="cass[{$count}][id]" value="{$cas->id}">
                                        </div>
                                        <div class="col-md-3 no-padding">
                                            <div class="input-group">
                                                <span class="input-group-addon beautiful" style="width:101px;">CAS No</span>
                                                <input type="text" class="form-control fix-inputgroup" value="{get_cas_no($cas->id)}" reaadonly disabled>
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-addon beautiful" style="width:101px;">Formula</span>
                                                <input type="text" class="form-control fix-inputgroup" value="{get_cas_formula($cas->id)}" reaadonly disabled>
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-addon beautiful" style="width:101px;">Name</span>
                                                <input type="text" class="form-control fix-inputgroup" value="{get_cas_name($cas->id)}" reaadonly disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-1" style="border-right:1px solid rgb(209, 209, 209);">
                                            <button type="button" class="btn btn-danger btn-bix pull-right remove-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"> <i class="fa fa-trash"></i> </button>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group" style="margin-bottom:5px;">
                                                <span class="input-group-addon beautiful" style="width: 95px;height: 32px;">Purity</span>
                                                <div class="form-inline" style="height:34px">
                                                    <div class="form-group">
                                                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="cass[{$count}][purity_unit]" style="z-index:1040;">
                                                            {if $puritys} {foreach from=$puritys key=key item=purity}
                                                            <option value="{$purity->id}" {if $cas->purity_unit eq $purity->id}selected="selected"{/if} data-code="{$purity->code}"> {$purity->code} </option>
                                                            {/foreach} {/if}
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label></label>
                                                        <input type="text" class="form-control" placeholder="purity (%)" name="cass[{$count}][purity]" value="{$cas->purity}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="input-group" style="margin-bottom:5px;">
                                                <span class="input-group-addon beautiful" style="width: 95px;height: 32px;">Quantity</span>
                                                <div class="form-inline" style="">
                                                    <div style="width:82px;float:left;">
                                                        <label></label>
                                                        <input type="text" class="form-control mylos" placeholder="Quantity" name="cass[{$count}][mdoza]" value="{$cas->mdoza}">
                                                    </div>
                                                    <div style="width:95px;float:left;">
                                                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="cass[{$count}][vdoza]">
                                                            <option value="">Dose unit</option>
                                                            {if $unit} {foreach from=$unit key=key item=value}
                                                            <option value="{$value->id}" {if $cas->vdoza eq $value->id}selected="selected"{/if} data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
                                                            {/foreach} {/if}
                                                        </select>
                                                    </div>
                                                    <div style="width:20px;float:left;">
                                                        {if $cas->mdoza2}
                                                        <button type="button" class="minus_item" style="display:block !important">-</button>
                                                        <button type="button" class="plus_item" data-id="`+count+`" data-type="cass" style="display: none;">+</button>
                                                        {else}
                                                        <button type="button" class="plus_item" data-id="`+count+`" data-type="cass">+</button>
                                                          <button type="button" class="minus_item" style="display:none">-</button>
                                                        {/if}
                                                    </div>
                                                    <div style="width:45%;float:left;" class="extra-mg">
                                                        {if $cas->mdoza2}
                                                        <div class="col-sm-6 no-padding">
                                                            <input type="text" class="form-control mylos" placeholder="Quantity" name="cass[{$count}][mdoza2]" value="{$cas->mdoza2}">
                                                        </div>
                                                        <div class="col-sm-6 no-padding">
                                                            <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="cass[{$count}][vdoza2]">
                                                                <option value="">Volume unit</option>
                                                                {if $unit} {foreach from=$unit key=key item=value}
                                                                <option value="{$value->id}" {if $cas->vdoza2 eq $value->id }selected="selected"{/if} data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
                                                                {/foreach} {/if}
                                                            </select>
                                                        </div>
                                                        {/if}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="input-group" style="width: 740px;margin-bottom:5px;">
                                                <span class="input-group-addon beautiful" style="width:85px;height: 32px;">ATC Code</span>
                                                <div class="form-inline" style="">
                                                    <input type="text" class="form-control mylos tagsinput atc_code_input" placeholder="ATC CODE" name="" data-role="tagsinput" multiple>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="clearfix"></div>
                                    {assign var=count value=$count+1} {/foreach} {/if}

                                </div>
                                <div class="col-md-12 term-inner">
                                    <div class="form-group">
                                        <div class="col-md-12 no-padding">
                                            <div class="col-md-2 no-padding label_add_prod">
                                                <label>Add Dosage Form</label>
                                            </div>
                                            <div class="col-md-1 no-padding dossage-limit" style="width:40px;display:none;">
                                                <button type="button" class="dossage dossageForm btn-dossage" data-widget="" data-target="#dossageForm" >+</button>
                                            </div>
                                            <div class="col-md-8 no-padding dossageForm-inner">
                                                {assign var=countx value=1} {assign var=packing_types value=json_decode($tender->packing_type)} {if !empty($packing_types)} {foreach from=$packing_types item=packing_type}
                                                <div class="form-group label_{$packing_type->id}">
                                                    <div class="col-md-5 no-padding">
                                                        <div class="input-group">
                                                            <span class="input-group-addon beautiful" style="width:101px;">Dossage</span>
                                                            <input type="text" class="form-control fix-inputgroup" style="width:100%" value="{get_packing_type_name($packing_type->id)}" reaadonly disabled>
                                                            <input type="hidden" name="packing_types[{$countx}][id]" value="{$packing_type->id}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1" style="border-right:1px solid rgb(209, 209, 209);">
                                                        <button type="button" class="btn btn-danger btn-bix pull-right remove-item-dossage" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"> <i class="fa fa-trash"></i> </button>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="input-group" style="margin-bottom:5px;">
                                                            <span class="input-group-addon beautiful" style="width: 95px;height: 32px;">Quantity</span>
                                                            <div class="form-inline" style="">
                                                                <div style="width:82px;float:left;">
                                                                    <label></label>
                                                                    <input type="text" class="form-control mylos" placeholder="Quantity" name="packing_types[{$countx}][mdoza]" value="{$packing_type->mdoza}">
                                                                </div>
                                                                <div style="width:95px;float:left;">
                                                                    <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="packing_types[{$countx}][vdoza]" title="Packing">
                                                                        {if $drug_types} {foreach $drug_types as $key=>$value}
                                                                        <option {if $packing_type->vdoza eq $value->id}selected="selected"{/if} value="{$value->id}">{$value->name}</option>
                                                                        {/foreach} {/if}
                                                                    </select>
                                                                </div>
                                                                <div style="width:20px;float:left;">
                                                                    {if $packing_type->mdoza2}
                                                                    <button type="button" class="minus_item" style="display:block !important">-</button>
                                                                     <button type="button" class="plus_item" data-id="{$countx}" data-type="packing_types" style="display: none;">+</button>
                                                                    {else}
                                                                    <button type="button" class="plus_item" data-id="{$countx}" data-type="packing_types">+</button>
                                                                     <button type="button" class="minus_item" style="display:none">-</button>
                                                                    {/if}
                                                                </div>
                                                                <div style="width:45%;float:left;" class="extra-mg">
                                                                    {if $packing_type->mdoza2}
                                                                    <div class="col-sm-6 no-padding">
                                                                        <input type="text" class="form-control mylos" placeholder="Quantity" name="packing_types[{$countx}][mdoza2]" value="{$packing_type->mdoza2}">
                                                                    </div>
                                                                    <div class="col-sm-6 no-padding">
                                                                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="packing_types[{$countx}][vdoza2]">
                                                                            <option value="">Volume unit</option>
                                                                            {if $unit} {foreach from=$unit key=key item=value}
                                                                            <option value="{$value->id}" {if $packing_type->vdoza2 eq $value->id }selected="selected"{/if} data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
                                                                            {/foreach} {/if}
                                                                        </select>
                                                                    </div>
                                                                    {/if}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="clearfix"></div>
                                                {assign var=countx value=$countx+1} {/foreach} {/if}
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="col-md-12 term-inner">
                                    <div class="form-group">
                                        <div class="col-md-12 no-padding">
                                            <div class="col-md-2 no-padding label_add_prod">
                                                <label>Dossier Format</label>
                                            </div>
                                            <div class="col-md-2 no-padding">
                                                <input type="checkbox" id="BE" name="be" value="1" {if $tender->be eq 1}checked="checked"{/if} >
                                                <label for="BE">BE</label>
                                                <input type="checkbox" id="CTD" name="ctd" value="1" {if $tender->ctd eq 1}checked="checked"{/if} >
                                                <label for="CTD" style="margin-left:15px;">CTD</label>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="col-md-12 term-inner">
                                    <div class="form-group">
                                        <div class="col-md-12 no-padding">
                                            <div class="form-group">
                                                <div class="col-md-2 no-padding label_add_prod">
                                                    <label>Order Quantity</label>
                                                </div>
                                                <div class="col-md-2 no-padding">
                                                    <input type="text" class="form-control mylos" placeholder="Moq" name="moq" value="{$tender->moq}">
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-2 no-padding label_add_prod">
                                                    <label>Storage</label>
                                                </div>
                                                  <div class="col-md-2 no-padding">
                                                            <select class="form-control mylos selectpicker show-menu-arrow pils storage-select" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="storage">
                                                                <option value="1">Do not store over 30 C</option>
                                                                <option value="2">Do not store over 25 C</option>
                                                                <option value="3">Do not store over 15 C</option>
                                                                <option value="4">Do not store over 8 C</option>
                                                                <option value="5">Do not store below 8 C</option>
                                                                <option value="6">Protect from moisture</option>
                                                                <option value="7">Protect from light</option>
                                                                <option value="8">Other</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input type="text" class="form-control mylos storage-input" placeholder="Storage" name="storage" style="display:none;" value="{$tender->storage}">
                                                        </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="col-md-12 no-padding term-inner">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <div class="form-group" style="padding-bottom:0px;">
                                               
                                                    <div class="col-md-12 no-padding term-inner moreInfo">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <div class="form-group" style="padding-bottom:0px;">
                                                        <div class="col-md-2 no-padding label_add_prod">
                                                            <button type="button" class="btn-moders moreInfo" data-toggle="collapse" data-target="#more-information" aria-expanded="false" aria-controls="more-information" style="width:auto">Add more information</button>
                                                        </div>
                                                        <div class="col-md-6 no-padding">
                                                            <div class="col-md-12 no-padding more-information collapse" id="more-information">
                                                                <textarea name="description" placeholder="demo" data-validation-error-msg=" " data-validation="alphanumeric " class="ckeditor" id="CKeditor" {if $tender->description == '' || is_null($tender->description)}style="visibility: hidden; display: none;"{/if}>{$tender->description}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                              
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                     <button type="submit" class="submit-product-btn pull-right" style="margin-top:0px;border-radius:0px;margin-right: 20px">Save</button>
                                <div class="clearfix" style="margin-bottom: 30px; "></div>
                                </div>
                               
                            </div>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function addHerbal(count, data_txt, data_no, data_formula, data_target, data_id) {
        var component =
        `<div class="form-group vared label_` + data_id + `">
            <div class="col-md-2 no-padding label_add_prod">
                <label>Ingredient ` + count + `</label>
                <input type="hidden" name="herbals[` + count + `][id]" value="` + data_id + `">
            </div>
            <div class="col-md-3 no-padding">
                <div class="input-group">
                    <span class="input-group-addon beautiful" style="width:101px;">Herbal</span>
                    <input type="text" class="form-control fix-inputgroup" value="` + data_txt + `" reaadonly disabled>
                </div>
            </div>
            <div class="col-md-1 hidden-xs" style="border-right:1px solid rgb(209, 209, 209);">
                <button type="button" class="btn btn-danger btn-bix pull-right remove-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"> <i class="fa fa-trash"></i> </button>
            </div>
            <div class="col-md-6">
                <div class="input-group" style="margin-bottom:5px;">
                    <span class="input-group-addon beautiful" style="width: 95px;height: 32px;">Quantity</span>
                    <div class="form-inline" style="">
                        <div style="width:82px;float:left;">
                            <label></label>
                            <input type="text" class="form-control mylos" placeholder="Quantity"  name="herbals[` + count + `][mdoza]">
                        </div>
                        <div style="width:95px;float:left;">
                            <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1"  name="herbals[` + count + `][vdoza]">
                                <option value="">Dose unit</option>
                                {if $unit}{foreach $unit as $key=>$value}
                                    <option value="{$value->id}" data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
                                {/foreach}{/if}
                            </select>
                        </div>
                        <div style="width:95px;float:left;">
                            <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="herbals[` + count + `][part]">
                                <option class="bs-title-option" value="">Herb part</option>
                                {if $herb_parts}{foreach $herb_parts as $key=>$herb_part}
                                  <option value="{$herb_part->id}" data-code="{$herb_part->name}" title="{$herb_part->name}">{$herb_part->name}</option>
                                {/foreach}{/if}
                            </select>
                        </div>
                        <div style="width:95px;float:left;">
                            <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="herbals[` + count + `][form]">
                                <option class="bs-title-option" value="">Herb form</option>
                                {if $herb_forms}{foreach $herb_forms as $key=>$herb_form}
                                <option value="{$herb_form->id}" data-code="{$herb_form->name}" title="{$herb_form->name}">{$herb_form->name}</option>
                                {/foreach}{/if}
                           </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>`;
        return component;
    }
    function addAnimal(count, data_txt, data_no, data_formula, data_target, data_id) {
    var component =
    `<div class="form-group vared label_` + data_id + `">
        <div class="col-md-2 no-padding label_add_prod">
            <label>Ingredient ` + count + `</label>
            <input type="hidden" name="animals[` + count + `][id]" value="` + data_id + `">
        </div>
        <div class="col-md-3 no-padding">
            <div class="input-group">
                <span class="input-group-addon beautiful" style="width:101px;">Animal</span>
                <input type="text" class="form-control fix-inputgroup" value="` + data_txt + `" reaadonly disabled>
            </div>
        </div>
        <div class="col-md-1 hidden-xs" style="border-right:1px solid rgb(209, 209, 209);">
            <button type="button" class="btn btn-danger btn-bix pull-right remove-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"> <i class="fa fa-trash"></i> </button>
        </div>
        <div class="col-md-6">
            <div class="input-group" style="margin-bottom:5px;">
                <span class="input-group-addon beautiful" style="width: 95px;height: 32px;">Quantity</span>
                <div class="form-inline" style="">
                    <div style="width:82px;float:left;">
                        <label></label>
                        <input type="text" class="form-control mylos" placeholder="Quantity"  name="animals[` + count + `][mdoza]">
                    </div>
                    <div style="width:95px;float:left;">
                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1"  name="animals[` + count + `][vdoza]">
                            <option value="">Dose unit</option>
                            {if $unit}{foreach $unit as $key=>$value}
                                    <option value="{$value->id}" data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
                            {/foreach}{/if}
                        </select>
                    </div>
                    <div style="width:95px;float:left;">
                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="animals[` + count + `][part]">
                            <option class="bs-title-option" value="">Animal part</option>
                            {if $animal_parts}{foreach $animal_parts as $key=>$animal_part}
                                    <option value="{$animal_part->id}" data-code="{$animal_part->name}" title="{$animal_part->name}">{$animal_part->name}</option>
                            {/foreach}{/if}
                        </select>
                    </div>
                    <div style="width:95px;float:left;">
                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="animals[` + count + `][form]">
                            <option class="bs-title-option" value="">Animal form</option>
                            {if $animal_forms}{foreach $animal_forms as $key=>$animal_form}
                                    <option value="{$animal_form->id}" data-code="{$animal_form->name}" title="{$animal_form->name}">{$animal_form->name}</option>
                            {/foreach}{/if}
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>`;
    return component;
    }
    function addChermical(count, data_txt, data_no, data_formula, data_target, data_id) {
        var component =
        `<div class="form-group vared label_`+data_id+`">
            <div class="col-md-2 no-padding label_add_prod">
                <label>Ingredient ` + count + `</label>
                <input type="hidden" name="atc_codes[` + count + `][id]" value="` + data_id + `">
            </div>
            <div class="col-md-3 no-padding">
                <div class="input-group">
                    <span class="input-group-addon beautiful" style="width:101px;">Atc code</span>
                    <input type="text" class="form-control fix-inputgroup" value="`+data_no+`" reaadonly disabled>
                </div>
                <div class="input-group">
                    <span class="input-group-addon beautiful" style="width:101px;">NAME</span>
                    <input type="text" class="form-control fix-inputgroup" value="`+data_txt+`" reaadonly disabled>
                </div>
            </div>
            <div class="col-md-1 hidden-xs" style="border-right:1px solid rgb(209, 209, 209);">
                <button type="button" class="btn btn-danger btn-bix pull-right remove-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"> <i class="fa fa-trash"></i> </button>
            </div>
            <div class="col-md-6">
                <div class="input-group" style="margin-bottom:5px;">
                    <span class="input-group-addon beautiful" style="width: 95px;height: 32px;">Quantity</span>
                    <div class="form-inline" style="">
                        <div style="width:82px;float:left;">
                            <label></label>
                            <input type="text" class="form-control mylos" placeholder="Quantity"  name="atc_codes[` + count + `][mdoza]">
                        </div>
                        <div style="width:95px;float:left;">
                            <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1"  name="atc_codes[` + count + `][vdoza]">
                                <option value="">Dose unit</option>
                                {if $unit}{foreach $unit as $key=>$value}
                                <option value="{$value->id}" data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
                                {/foreach}{/if}
                            </select>
                        </div>
                        <div style="width:20px;float:left;">
                            <button type="button" class="plus_item" data-id="` + count + `" data-type="atc_codes">+</button>
                            <button type="button" class="minus_item">-</button>
                        </div>
                        <div style="width:45%;float:left;" class="extra-mg"></div>
                    </div>
                </div>`;
                 if($('select[name="pr_type"]').val() != 3){
                   component+= `<div class="input-group" style="margin-bottom:5px;">
                    <span class="input-group-addon beautiful" style="width: 95px;height: 32px;">Purity</span>
                    <div class="form-inline" style="height:34px">
                        <div class="form-group">
                            <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="atc_codes[` + count + `][purity_unit]" style="z-index:1040;">
                                {if $puritys}{foreach $puritys as $key=>$purity}
                                <option value="{$purity->id}" data-code="{$purity->code}"> {$purity->code} </option>
                                {/foreach}{/if}
                            </select>
                        </div>
                        <div class="form-group">
                            <label></label>
                            <input type="text" class="form-control" placeholder="purity (%)" name="atc_codes[` + count + `][purity]">
                        </div>
                    </div>
                </div>`;
                }
                component+=`</div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>`;
        return component;
    }
    function addDossageForm(count, data_txt, data_no, data_formula, data_target, data_id) {
        var component =
        `<div class="form-group label_` + data_id + `" style="padding-bottom: 0px;">
            <div class="col-md-5 no-padding">
                <div class="input-group">
                    <span class="input-group-addon beautiful" style="width:101px;">Dossage</span>
                    <input type="text" class="form-control fix-inputgroup" style="width:100%" value="` + data_txt + `" reaadonly disabled>
                    <input type="hidden" name="packing_types[` + count + `][id]" value="` + data_id + `">
                </div>
            </div>
            <div class="col-md-1 hidden-xs" style="border-right:1px solid rgb(209, 209, 209);">
                <button type="button" class="btn btn-danger btn-bix pull-right remove-item-dossage" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"> <i class="fa fa-trash"></i> </button>
            </div>
            <div class="col-md-6">
                <div class="input-group" style="margin-bottom:5px;">
                    <span class="input-group-addon beautiful" style="width: 95px;height: 32px;">Quantity</span>
                    <div class="form-inline" style="">
                        <div style="width:82px;float:left;">
                            <label></label>
                            <input type="text" class="form-control mylos" placeholder="Quantity"  name="packing_types[` + count + `][mdoza]">
                        </div>
                        <div style="width:95px;float:left;">
                            <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1"  name="packing_types[` + count + `][vdoza]" title="Packing">
                                {if $drug_types}{foreach $drug_types as $key=>$value}
                                    <option value="{$value->id}">{$value->name}</option>
                                {/foreach}{/if}
                            </select>
                        </div>
                        <div style="width:20px;float:left;">
                            <button type="button" class="plus_item" data-id="` + count + `" data-type="packing_types">+</button>
                            <button type="button" class="minus_item">-</button>
                        </div>
                        <div style="width:33%;float:left;" class="extra-mg"></div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>`;
        return component;
    }
    function addCasNumber(count, data_txt, data_no, data_formula, data_target, data_id) {
        var component =
        `<div class="form-group cas-add-row vared label_` + data_id + `">
            <div class="col-md-2 no-padding label_add_prod">
                <label>Ingredient ` + count + `</label>
                <input type="hidden" name="cass[` + count + `][id]" value="` + data_id + `">
            </div>
            <div class="col-md-3 no-padding">
                <div class="input-group">
                    <span class="input-group-addon beautiful" style="width:101px;">CAS No</span>
                    <input type="text" class="form-control fix-inputgroup" value="`+data_no+`" reaadonly disabled>
                </div>
                <div class="input-group">
                    <span class="input-group-addon beautiful" style="width:101px;">Formula</span>
                    <input type="text" class="form-control fix-inputgroup" value="`+data_formula+`" reaadonly disabled>
                </div>
                <div class="input-group">
                    <span class="input-group-addon beautiful" style="width:101px;">Name</span>
                    <input type="text" class="form-control fix-inputgroup" value="`+data_txt+`" reaadonly disabled>
                </div>
            </div>
            <div class="col-md-1 hidden-xs" style="border-right:1px solid rgb(209, 209, 209);">
                <button type="button" class="btn btn-danger btn-bix pull-right remove-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"> <i class="fa fa-trash"></i> </button>
            </div>
            <div class="col-md-6">
                <div class="input-group" style="margin-bottom:5px;">
                    <span class="input-group-addon beautiful" style="width: 95px;height: 32px;">Purity</span>
                    <div class="form-inline" style="height:34px">
                        <div class="form-group">
                            <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="cass[` + count + `][purity_unit]" style="z-index:1040;">
                                {if $puritys}{foreach $puritys as $key=>$purity}
                                <option value="{$purity->id}" data-code="{$purity->code}"> {$purity->code} </option>
                                {/foreach}{/if}
                            </select>
                        </div>
                        <div class="form-group">
                            <label></label>
                            <input type="text" class="form-control" placeholder="purity (%)" name="cass[` + count + `][purity]">
                        </div>
                    </div>
                </div>
                <div class="input-group" style="margin-bottom:5px;">
                    <span class="input-group-addon beautiful" style="width: 95px;height: 32px;">Quantity</span>
                    <div class="form-inline" style="">
                        <div style="width:82px;float:left;">
                            <label></label>
                            <input type="text" class="form-control mylos" placeholder="Quantity"  name="cass[` + count + `][mdoza]">
                        </div>
                        <div style="width:95px;float:left;">
                            <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1"  name="cass[` + count + `][vdoza]">
                                <option value="">Dose unit</option>
                                {if $unit}{foreach $unit as $key=>$value}
                                <option value="{$value->id}" data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
                                {/foreach}{/if}
                            </select>
                        </div>
                        <div style="width:20px;float:left;">
                            <button type="button" class="plus_item" data-id="` + count + `" data-type="cass">+</button>
                            <button type="button" class="minus_item">-</button>
                        </div>
                        <div style="width:45%;float:left;" class="extra-mg"></div>
                    </div>
                </div>
                <div class="input-group" style="width: 740px;margin-bottom:5px;">
                    <span class="input-group-addon beautiful" style="width:85px;height: 32px;">ATC Code</span>
                    <div class="form-inline" style="">
                         <input type="text" class="form-control mylos tagsinput atc_code_input" placeholder="ATC CODE" name="" data-role="tagsinput" multiple>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>`;
        return component;
    }
    $(document).on('click', '.plus_item', function() {
        var data_id = $(this).data('id');
        var data_type = $(this).data('type');
        var component =
        `<div class="col-sm-6 no-padding">
            <input type="text" class="form-control mylos" placeholder="Quantity" name="` + data_type + `[` + data_id + `][mdoza2]" value="1">
         </div>
         <div class="col-sm-6 no-padding">
            <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="` + data_type + `[` + data_id + `][vdoza2]">
                <option value="">Volume unit</option>
                {if $unit}{foreach $unit as $key=>$value}
                <option value="{$value->id}" data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
                {/foreach}{/if}
            </select>
         </div>`;
        $(this).hide();
        $('.selectpicker').selectpicker();
        $(this).parent().find('.minus_item').show();
        $(this).parents('.input-group').find('div.extra-mg').show();
    });
    $(document).on('click', '.minus_item', function() {
        $(this).hide();
        $(this).parent().find('.plus_item').show();
        $(this).parent().parent().find('div.extra-mg').hide();
    });
    {literal}
    function getChemical(param) {
        return $.ajax({
            type:'POST',
            url:site_url+'product/get_chemical/',
            data: {'chemical_id':param},
            async: false
        });
    }
    function getHerbal(param) {
        return $.ajax({
            type:'POST',
            url:site_url+'product/get_herbal/',
            data: {'herbal_id':param},
            async: false
        });
    }
    function getAnimal(param) {
        return $.ajax({
            type:'POST',
            url:site_url+'product/get_animal/',
            data: {'animal_id':param},
            async: false
        });
    }
    function getCasNumber(param) {
        return $.ajax({
            type:'POST',
            url:site_url+'product/get_cas_number/',
            data: {'cas_number_id':param},
            async: false
        });
    }
    function getPackingType(param) {
        return $.ajax({
            type:'POST',
            url:site_url+'product/get_packing_type/',
            data: {'packing_type_id':param},
            async: false
        });
    }
    function getProductType(param) {
        return $.ajax({
            type:'POST',
            url:site_url+'product/get_product_type/',
            data: {'product_type_id':param},
            async: false
        });
    }
    function getUnitName(param) {
        return $.ajax({
            type:'POST',
            url:site_url+'product/volume_unit/',
            data: {'unit_id':param},
            async: false
        });
    }
    {/literal}
</script>

    {literal}
    <script type="text/javascript">
        $(document).ready(function(){
            var fin = [];
           if($('.cas-add-row').length){
            $('.casNumber').addClass('disabled').prop('disabled',true);
           }
                var selected =$('select.product_type_select').find('option:selected').val();
                if(selected != 0){
                    $.isLoading({text:""});
                  
                    $('.brandname').removeAttr('disabled');
                    $('.content_add').show();
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
                                        moreInfo : obj[0].moreInfo_visible,
                                        brandName : obj[0].brandName_visible,
                                        country : obj[0].country_visible,
                                    }],
                                    multiple : [{
                                        chemical : obj[0].chemical_multiple,
                                        herbal : obj[0].herbal_multiple,
                                        casNumber : obj[0].casNumber_multiple,
                                        dossageForm : obj[0].dossageForm_multiple,
                                    }]
                                }]
                            };
                            $.removeCookie('setting');
                            $.cookie.json = true;
                            $.cookie('setting', json);
                            $.each(json.settings[0].visible[0], function(key, value) {
                                if (value == '1'){$('.' + key).show();}
                                else{$('.' + key).hide();}
                            });
                            setTimeout(function(){$.isLoading("hide"); }, 1000);

                        },
                        error: function(){
                            setTimeout(function(){$.isLoading("hide"); }, 1000);
                        }
                    });
                  
                }
                else{
                    $('.brandname').attr('disabled','disabled');
                    $('.content_add').hide();
                }
          
        });

        $('select.product_type_select').trigger('change');

        function finaly(_this)
        {
            $.isLoading({text: ""});
            $('.btn-dossage').removeClass('active');
            $('.target').removeClass('active');
            _this.addClass('active');
            var target = _this.attr('data-target');
            $('.periodic').removeClass('in');
            $(target).addClass('in');
            $('.search-inner').html('<span style="color:red;margin-left:-300px;">Select ' +target + ' items</span>').find('span').animate({marginLeft: "0px"}, 500);
            $('.search-tool').addClass('col-md-3');
            $('.search-tool').show();
            $('.specilation').removeClass('col-md-12');
            $('.specilation').addClass('col-md-9');
            $('.specilation').append('<div class="blackstack" style="position: absolute; top: 0; right: 0; bottom: 0; left: 0; z-index: 1040; background-color: #000;opacity:.6;"></div>');
            setTimeout(function () { $.isLoading("hide"); }, 200);
            $('.module-search').val('');
            $('.module-search').css('border', '1px solid red').trigger( "focus" );
        }

        $(document).on('click', '.target , .dossage', function () {
            var cookies = $.cookie('setting');
            var brandname = $('.brandname');
            console.log(cookies);
            if(cookies.settings[0].visible[0].brandName == '1')
            {
                brandname.attr('required');
                if(brandname.val() == '')
                {
                    brandname.css('border','1px solid red');
                }
                else{
                    brandname.removeAttr('style');
                    finaly($(this));
                }
            }else{
                finaly($(this));
            }
        });

    </script>
{/literal}
<script type="text/javascript">
    var fore = 0;
    var count = {$count};
    var general = {$parent_cal};
    var come = 0;
    var chemicalcount = 0;
    var herbalcount = 0;
    var animalcount = 0;
    var dossageFormCount = 0;
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
                if(data_target == 'chemical')
                {
                    if(cookies.settings[0].multiple[0].chemical == '1')
                    {
                        var component = addChermical(count, data_txt,data_no, data_formula , data_target, data_id);
                        $('.frist-inner').append(component);
                        $('.selectpicker').selectpicker();
                        $('.search-tool').removeClass('col-md-3');
                        $('.specilation').addClass('col-md-12');
                        $('.specilation').removeClass('col-md-9');
                        $('.blackstack').remove();
                        $('.search-tool').hide();

                        $(".two-column").slideDown( "slow", function(){});
                        count += 1;
                        chemicalcount +=1;
                    }
                    else
                    {
                        if(chemicalcount < 1)
                        {
                            var component = addChermical(count, data_txt,data_no, data_formula , data_target, data_id);
                            $('.frist-inner').append(component);
                            $('.selectpicker').selectpicker();
                            $('.search-tool').removeClass('col-md-3');
                            $('.specilation').addClass('col-md-12');
                            $('.specilation').removeClass('col-md-9');
                            $('.blackstack').remove();
                            $('.search-tool').hide();
                            $(".two-column").slideDown( "slow", function(){});
                            chemicalcount +=1;
                        }
                    }
                }
                else if(data_target == 'herbal')
                {
                    if(cookies.settings[0].multiple[0].herbal == '1')
                    {
                        var component = addHerbal(count, data_txt,data_no, data_formula , data_target, data_id);
                        $('.frist-inner').append(component);
                        $('.selectpicker').selectpicker();
                        $('.search-tool').removeClass('col-md-3');
                        $('.specilation').addClass('col-md-12');
                        $('.specilation').removeClass('col-md-9');
                        $('.blackstack').remove();
                        $('.search-tool').hide();

                        $(".two-column").slideDown( "slow", function(){});
                        count += 1;
                        herbalcount += 1;
                    }
                    else
                    {
                        if(herbalcount < 1)
                        {
                            var component = addHerbal(count, data_txt,data_no, data_formula , data_target, data_id);
                            $('.frist-inner').append(component);
                            $('.selectpicker').selectpicker();
                            $('.search-tool').removeClass('col-md-3');
                            $('.specilation').addClass('col-md-12');
                            $('.specilation').removeClass('col-md-9');
                            $('.blackstack').remove();
                            $('.search-tool').hide();

                            $(".two-column").slideDown( "slow", function(){});
                            herbalcount += 1;
                        }
                    }
                }
                else if (data_target == 'animal')
                {
                    if(cookies.settings[0].multiple[0].animal == '1')
                    {
                        var component = addAnimal(count, data_txt,data_no, data_formula , data_target, data_id);
                        $('.frist-inner').append(component);
                        $('.selectpicker').selectpicker();
                        $('.search-tool').removeClass('col-md-3');
                        $('.specilation').addClass('col-md-12');
                        $('.specilation').removeClass('col-md-9');
                        $('.blackstack').remove();
                        $('.search-tool').hide();

                        $(".two-column").slideDown( "slow", function(){});
                        count += 1;
                        animalcount += 1;
                    }
                    else
                    {
                        if(animalcount < 1)
                        {
                            var component = addAnimal(count, data_txt,data_no, data_formula , data_target, data_id);
                            $('.frist-inner').append(component);
                            $('.selectpicker').selectpicker();
                            $('.search-tool').removeClass('col-md-3');
                            $('.specilation').addClass('col-md-12');
                            $('.specilation').removeClass('col-md-9');
                            $('.blackstack').remove();
                            $('.search-tool').hide();

                            $(".two-column").slideDown( "slow", function(){});
                            count += 1;
                            animalcount += 1;
                        }
                    }
                }
                else if (data_target == 'casNumber')
                {
                    if(cookies.settings[0].multiple[0].casNumber == '1')
                    {
                        var component = addCasNumber(count, data_txt,data_no, data_formula , data_target, data_id);
                        $('.frist-inner').append(component);
                        $('.selectpicker').selectpicker();
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
                        $('.specilation').addClass('col-md-12');
                        $('.specilation').removeClass('col-md-9');
                        $('.blackstack').remove();
                        $('.search-tool').hide();

                        $(".two-column").slideDown( "slow", function(){});
                        count += 1;
                        come += 1;
                    }
                    else
                    {
                        if(come < 1)
                        {
                            var component = addCasNumber(count, data_txt,data_no, data_formula , data_target, data_id);
                            $('.frist-inner').append(component);
                            $('.selectpicker').selectpicker();
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
                            $('.specilation').addClass('col-md-12');
                            $('.specilation').removeClass('col-md-9');
                            $('.blackstack').remove();
                            $('.search-tool').hide();

                            $(".two-column").slideDown( "slow", function(){});
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
                        $('.selectpicker').selectpicker();
                        $('.search-tool').removeClass('col-md-3');
                        $('.specilation').addClass('col-md-12');
                        $('.specilation').removeClass('col-md-9');
                        $('.blackstack').remove();
                        $('.search-tool').hide();

                        $(".two-column").slideDown( "slow", function(){});
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
                            $('.selectpicker').selectpicker();
                            $('.search-tool').removeClass('col-md-3');
                            $('.specilation').addClass('col-md-12');
                            $('.specilation').removeClass('col-md-9');
                            $('.blackstack').remove();
                            $('.search-tool').hide();

                            $(".two-column").slideDown( "slow", function(){});
                            count += 1;
                            dossageFormCount += 1;
                        }
                    }
                }
                else
                {
                    return false;
                }

                e.preventDefault();
                return false;
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
    /*$(document).on('click', '.add-button-photos', function(e) {
        e.preventDefault();
        fore = fore +1;
        comp = `<div class="img-upload-group add bitrix" var-attr="lab_`+fore+`">
                    <div class="reload-form-upload">
                        <label>
                            <input type="file" name="userfile[`+fore+`]">
                            <button type="button" class="mini-upload upload-button" data-id="" data-target=""></button>
                        </label>
                    </div>
                </div>`;
        $('.img-full-right-block .inner-img').append(comp);
        e.preventDefault();
        return false;
    });
    $(document).on('click','.remove-image.product', function(e){
        var data_id = $(this).attr('data-id');
        e.preventDefault();
        $.ajax({
            type:'POST',
            url:site_url+'product/delete_image/',
            data: {'image_id': data_id},
            success:function(data){
                if(data == 'true')
                {
                    $('.lab_'+data_id).remove();
                    toastr.success('This image delete success');
                }
                else
                {
                    toastr.danger('Does not delete images');
                }
            }
        });
        e.preventDefault();
        return false;
    });*/
    {/literal}
</script>
{if isset($message)}<script>toastr.warning(`{$message.message}`);</script>{/if}
{/block}
