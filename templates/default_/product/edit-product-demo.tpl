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
           <div class="col-md-12 no-padding add-product-nav" id="addProductNav">
                <ul class="add-product-nav-ul">
                    <li class="active"><a href="#section1"><span class="num">1</span><span class="txt">Add Products</span></a></li>
                    <li><a href="#section2"><span class="num">2</span><span class="txt">Ingredients</span></a></li>
                    <li><a href="#section3"><span class="num">3</span><span class="txt">Dosage</span></a></li>
                    <li><a href="#section4"><span class="num">4</span><span class="txt">Information</span></a></li>
                </ul>
            </div>
            <div class="clearfix"></div>
            <div class="container" id="add-product">
                 <div class="clearfix"></div>
                    <h2 class="add-pr-heading" id="section1">Add Products <i class="fa fa-info-circle" data-toggle="modal" data-target="#infoAdd" style="cursor: pointer;"></i></h2>
                <div class="col-md-12 no-padding add-product {if isset($message)} in {/if}" id="collapseExample">
                    <div class="col-md-12 no-padding panel-add">
                        <form class="editProductForm" role="form" method="POST" action="{site_url_multi('product/add')}">
                            <input type="hidden" name="request" value="update">
                            <input type="hidden" name="product_id" value="{$product->id}">
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
                                                        <div class="lib-span4"> | {$cas_number->chemical_name}</div>
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
                                         <div class="col-md-12 add-frist">
                                        {if isset($message)}
                                            <script> toastr.warning(`{$message.message}`); </script>
                                        {/if}
                                        <div class="form-group" style="margin-bottom: 0!important">
                                            <div class="col-md-4 col-xs-12">
                                                <div class="col-md-4 no-padding label-cont" style="margin-bottom:15px;">
                                                    <label>Product type</label>
                                                </div>
                                                <div class="col-md-8 no-padding" style="margin-bottom:15px;">
                                                    <select name="pr_type" class="form-control mylos selectpicker show-menu-arrow product_type_select" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" title="Please Select Type">
                                                        {if $product_type}{foreach $product_type as $key=>$type}
                                                        <option value="{$type->id}" {if $product->pr_type eq $type->id}selected="selected"{/if}>{$type->name}</option>
                                                        {/foreach}{/if}
                                                    </select>
                                                </div>
                                               
                                            </div>
                                            <div class="col-md-4 col-xs-12 brandName">
                                                <div class="col-md-4 no-padding label-cont" >
                                                    <label>Brand name</label>
                                                </div>
                                                <div class="col-md-8 no-padding" >
                                                    <input type="text" name="title" class="form-control mylos brandname" placeholder="Brand name" disabled="disabled" value="{$product->title}">
                                                </div>
                                            </div>
                                            <div class="col-md-4 country col-xs-12">
                                                <div class="col-md-4 no-padding label-cont">
                                                    <label>Country</label>
                                                </div>
                                                <div class="col-md-8 no-padding ">
                                                    <select name="country" class="form-control mylos selectpicker company-country show-menu-arrow" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1">
                                                        {if $countrys}{foreach $countrys as $key=>$country}
                                                            <option value="{$country->id}" data-name="{$country->code}" {if $product->country eq $country->id}selected="selected"{/if}>{$country->name}</option>
                                                        {/foreach}{/if}
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="clearfix row" style="margin: 0">
                                                <h2 class="add-pr-heading forcontent" id="section2">Ingredients - <span>Need to add description for ingredients we talk about</span></h2>
                                                     <div class="col-md-12 frist-inner" style="padding: 20px">
                                    {assign var=count value=1} {assign var=atc_codes value=json_decode($product->atc_code)} {if !empty($atc_codes)} {foreach from=$atc_codes item=atc_code}
                                    <div class="form-group vared label_{$atc_code->id}">
                                        <div class="col-md-2 no-padding label_add_prod">
                                            <label>Ingredient {$count}</label>
                                            <input type="hidden" name="atc_codes[{$count}][id]" value="{$atc_code->id}">
                                        </div>
                                        <div class="col-md-12 no-padding add-c-row">
                                            <div class="input-group add-c-code">
                                                <span class="input-group-addon beautiful" style="width:101px;">Atc code</span>
                                                <input type="text" class="form-control fix-inputgroup" value="{get_atc_code_name($atc_code->id)}" reaadonly disabled>
                                            </div>
                                             <div class="input-group add-c-name">
                                                <span class="input-group-addon beautiful" style="width:101px;">NAME</span>
                                                <input type="text" class="form-control fix-inputgroup" value="{get_atc_code_no($atc_code->id)}" reaadonly disabled>
                                            </div>
                                        
                                            <div class="input-group add-c-count" >
                                                <span class="input-group-addon beautiful" style="width: 95px;">Quantity</span>
                                              
                                                    <div style="width:82px;float:left;">
                                                        <label></label>
                                                        <input type="text" class="form-control mylos" placeholder="Quantity" name="atc_codes[{$count}][mdoza]" value="{$atc_code->mdoza}">
                                                    </div>
                                            </div>
                                                   <div class="input-group add-c-unit">
                                                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="atc_codes[{$count}][vdoza]">
                                                            <option value="">Dose unit</option>
                                                            {if $unit} {foreach from=$unit key=$ey item=value}
                                                            <option value="{$value->id}" {if $atc_code->vdoza eq $value->id}selected="selected"{/if} data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
                                                            {/foreach} {/if}
                                                        </select>
                                                    </div>
                                                    <div style="float:left;">
                                                        {if $atc_code->mdoza2}
                                                        <button type="button" class="plus_item" data-id="{$count}" data-type="chemicals" style="display: none;">+</button>
                                                        <button type="button" class="minus_item" style="display:block !important">-</button>
                                                        {else}
                                                        <button type="button" class="plus_item" data-id="{$count}" data-type="chemicals">+</button>
                                                        <button type="button" class="minus_item" style="display: none;">-</button>
                                                        {/if}
                                                    </div>
                                                    
                                                        {if $atc_code->mdoza2}
                                                        <div class="extra-mg">
                                                        <div class="col-sm-4 no-padding">
                                                            <input type="text" class="form-control mylos" placeholder="Quantity" name="atc_codes[{$count}][mdoza2]" value="{$atc_code->mdoza2}">
                                                        </div>
                                                        <div class="col-sm-8 no-padding">
                                                            <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="atc_codes[{$count}][vdoza2]">
                                                                <option value="">Volume unit</option>
                                                                {if $unit} {foreach from=$unit key=key item=value}
                                                                <option value="{$value->id}" {if $atc_code->vdoza2 eq $value->id }selected="selected"{/if} data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
                                                                {/foreach} {/if}
                                                            </select>
                                                        </div>
                                                         </div>
                                                        {else}
                                                             <div style="display: none;" class="extra-mg">
                                                        <div class="col-sm-4 no-padding">
                                                            <input type="text" class="form-control mylos" placeholder="Quantity" name="atc_codes[{$count}][mdoza2]" >
                                                        </div>
                                                        <div class="col-sm-8 no-padding">
                                                            <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="atc_codes[{$count}][vdoza2]">
                                                                <option value="">Volume unit</option>
                                                                {if $unit} {foreach from=$unit key=key item=value}
                                                                <option value="{$value->id}" data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
                                                                {/foreach} {/if}
                                                            </select>
                                                        </div>
                                                         </div>
                                                        {/if}
                                                        <button type="button" class="btn remove-item remove-c-row" data-cid="{$atc_code->id}" data-toggle="tooltip" data-placement="top" > <img src="{base_url('templates/default/assets/img/times.png')}"></button>
                                                   
                                               
                                           
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="clearfix"></div>
                                    {assign var=count value=$count+1} {/foreach} {/if} {assign var=herbals value=json_decode($product->herbal)} {if !empty($herbals)} {foreach from=$herbals item=$herbal}
                                    <div class="form-group vared herbalRow label_{$herbal->id}">
                                        <div class="col-md-2 no-padding label_add_prod">
                                            <label>Ingredient {$count}</label>
                                            <input type="hidden" name="herbals[{$count}][id]" value="{$herbal->id}">
                                        </div>
                                        <div class="col-md-12 no-padding add-c-row">
                                            <div class="input-group add-c-name">
                                                <span class="input-group-addon beautiful" style="width:101px;">Herbal</span>
                                                <input type="text" class="form-control fix-inputgroup" value="{get_herbal_name($herbal->id)}" reaadonly disabled>
                                            </div>
                                        <div class="input-group add-c-count">
                                               <span class="input-group-addon beautiful" >Quantity</span>
                                               
                                                   <input type="text" class="form-control mylos" placeholder="Quantity" name="herbals[{$count}][mdoza]" value="{$herbal->mdoza}">
                                                </div>   
                                                     <div class="input-group add-c-unit">
                                                          <label for="">Dose Unit</label>
                                                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="herbals[{$count}][vdoza]">
                                                            
                                                            {if $unit} {foreach from=$unit key=key item=value}
                                                            <option value="{$value->id}" {if $herbal->vdoza eq $value->id}selected="selected"{/if} data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
                                                            {/foreach} {/if}
                                                        </select>
                                                    </div>
                                                    <div class="input-group add-c-unit">
                                                            <label for="">Herb part</label>
                                                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="herbals[{$count}][part]">
                                                            
                                                            {if $herb_parts} {foreach from=$herb_parts key=key item=herb_part}
                                                            <option value="{$herb_part->id}" {if $herbal->part eq $herb_part->id}selected="selected"{/if} data-code="{$herb_part->name}" title="{$herb_part->name}">{$herb_part->name}</option>
                                                            {/foreach} {/if}
                                                        </select>
                                                    </div>
                                                   <div class="input-group add-c-unit">
                                                         <label for="">Herb form</label>
                                                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="herbals[{$count}][form]">
                                                            
                                                            {if $herb_forms} {foreach from=$herb_forms key=key item=herb_form}
                                                            <option value="{$herb_form->id}" {if $herbal->form eq $herb_form->id}selected="selected"{/if} data-code="{$herb_form->name}" title="{$herb_form->name}">{$herb_form->name}</option>
                                                            {/foreach} {/if}
                                                        </select>
                                                    </div>
                                               
                                              <button type="button" class="btn remove-item remove-c-row" data-toggle="tooltip" data-placement="top" data-cid="{$herbal->id}" title="" > <img src="{base_url('templates/default/assets/img/times.png')}"></button>
                                            
                                        </div>
                                      
                                    </div>
                                  
                                    {assign var=count value=$count+1} {/foreach} {/if} {assign var=animals value=json_decode($product->animal)} {if !empty($animals)} {foreach from=$animals item=animal}
                                    <div class="form-group vared label_{$animal->id}">
                                        <div class="col-md-2 no-padding label_add_prod">
                                            <label>Ingredient {$count}</label>
                                            <input type="hidden" name="animals[{$count}][id]" value="{$animal->id}">
                                        </div>
                                        <div class="col-md-12 no-padding">
                                                <div class="input-group add-c-name">
                                           
                                                <span class="input-group-addon beautiful" style="width:101px;">Animal</span>
                                                <input type="text" class="form-control fix-inputgroup" value="{get_animal_name($animal->id)}" reaadonly disabled>
                                            </div>
                                       
                                           
                                       
                                             <div class="input-group add-c-count">
                                                <span class="input-group-addon beautiful" style="width: 95px;height: 32px;">Quantity</span>
                                               
                                                       
                                                        <input type="text" class="form-control mylos" placeholder="Quantity" name="animals[{$count}][mdoza]" value="{$animal->mdoza}">
                                                    </div>
                                                       <div class="input-group add-c-count">
                                                            <label for="">Dose unit</label>
                                                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="animals[{$count}][vdoza]">
                                                            <option value="">Dose unit</option>
                                                            {if $unit} {foreach from=$unit key=key item=value}
                                                            <option value="{$value->id}" {if $animal->vdoza eq $value->id}selected="selected"{/if} data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
                                                            {/foreach} {/if}
                                                        </select>
                                                    </div>
                                                      <div class="input-group add-c-unit">
                                                        <label for="">Animal part</label>
                                                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="animals[{$count}][part]">
                                                           
                                                            {if $animal_parts} {foreach from=$animal_parts key=key item=animal_part}
                                                            <option value="{$animal_part->id}" {if $animal->part eq $animal_part->id}selected="selected"{/if} data-code="{$animal_part->name}" title="{$animal_part->name}">{$animal_part->name}</option>
                                                            {/foreach} {/if}
                                                        </select>
                                                    </div>
                                                    < <div class="input-group add-c-unit">
                                                        <label for="">Animal form</label>
                                                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="animals[{$count}][form]">
                                                            <option class="bs-title-option" value="">Animal form</option>
                                                            {if $animal_forms} {foreach from=$animal_forms key=key item=animal_form}
                                                            <option value="{$animal_form->id}" {if $animal->form eq $animal_form->id}selected="selected"{/if} data-code="{$animal_form->name}" title="{$animal_form->name}">{$animal_form->name}</option>
                                                            {/foreach} {/if}
                                                        </select>
                                                    </div>
                                               
                                          
                                            <button type="button" class="btn remove-item remove-c-row" data-toggle="tooltip" data-placement="top" data-cid="{$animal->id}" title="" > <img src="{base_url('templates/default/assets/img/times.png')}"></button>
                                        </div>
                                     
                                    </div>
                                    
                                    {assign var=count value=$count+1} {/foreach} {/if} {assign var=cass value=json_decode($product->cas)} {if !empty($cass)} {foreach from=$cass item=cas}
                                    <div class="form-group cas-add-row vared label_{$cas->id}">
                                        <div class="col-md-2 no-padding label_add_prod">
                                            <label>Ingredient {$count}</label>
                                            <input type="hidden" name="cass[{$count}][id]" value="{$cas->id}">
                                        </div>
                                         <div class="col-md-12 no-padding add-c-row">
                                                <div class="input-group add-c-code add-cas-code">
                                                <span class="input-group-addon beautiful" >CAS No</span>
                                                <input type="text" class="form-control fix-inputgroup" value="{get_cas_no($cas->id)}" reaadonly disabled>
                                            </div>
                                             <div class="input-group add-c-code add-cas-formula">
                                                <span class="input-group-addon beautiful" style="width:101px;">Formula</span>
                                                <input type="text" class="form-control fix-inputgroup" value="{get_cas_formula($cas->id)}" reaadonly disabled>
                                            </div>
                                             
                                        
                                             <div class="input-group add-c-unit add-c-purity">
                                                <label>Purity</label>
                                                  
                                                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="cass[{$count}][purity_unit]" style="z-index:1040;">
                                                            {if $puritys} {foreach from=$puritys key=key item=purity}
                                                            <option value="{$purity->id}" {if $cas->purity_unit eq $purity->id}selected="selected"{/if} data-code="{$purity->code}"> {$purity->code} </option>
                                                            {/foreach} {/if}
                                                        </select>
                                                 
                                            </div>
                                            <div class="input-group add-c-unit add-c-purity">  
                                                <span class="input-group-addon beautiful" >Purity(%)</span> 
                                                <label></label>
                                                <input type="text" class="form-control" placeholder="purity (%)" name="cass[{$count}][purity]" value="{$cas->purity}">
                                            </div>
                                            <div class="input-group add-c-count add-c-purity" >
                                                <span class="input-group-addon beautiful">Quantity</span>
                                                
                                                        <input type="text" class="form-control mylos" placeholder="Quantity" name="cass[{$count}][mdoza]" value="{$cas->mdoza}">
                                             
                                               </div>   
                                                <div class="input-group add-c-unit" >
                                                <label for="">Dose unit</label>
                                                    <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="cass[{$count}][vdoza]">
                                                        <option value="">Dose unit</option>
                                                        {if $unit} {foreach from=$unit key=key item=value}
                                                        <option value="{$value->id}" {if $cas->vdoza eq $value->id}selected="selected"{/if} data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
                                                        {/foreach} {/if}
                                                    </select>
                                                </div>
                                               
                                                <div style="float:left;margin-right: 10px;">
                                                    {if $cas->mdoza2}
                                                    <button type="button" class="minus_item" style="display:block !important">-</button>
                                                    <button type="button" class="plus_item" data-id="{$count}" data-type="cass" style="display: none;">+</button>
                                                    {else}
                                                    <button type="button" class="plus_item" data-id="{$count}" data-type="cass">+</button>
                                                      <button type="button" class="minus_item" style="display:none">-</button>
                                                    {/if}
                                                </div>
                                                <div style="margin-left:0; clear: both;" class="extra-mg">
                                                      <div class="input-group add-c-unit add-c-acode" >
                                                    <span class="input-group-addon beautiful" >ATC Code</span>
                                                    <div class="form-inline" style="">
                                                        <input type="text" class="form-control mylos tagsinput atc_code_input" placeholder="ATC CODE" name="" data-role="tagsinput" multiple>
                                                    </div>
                                                </div>
                                                    {if $cas->mdoza2}
                                                    <div class="col-sm-4 no-padding">
                                                        <input type="text" class="form-control mylos" placeholder="Quantity" name="cass[{$count}][mdoza2]" value="{$cas->mdoza2}">
                                                    </div>
                                                    <div class="col-sm-8 no-padding">
                                                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="cass[{$count}][vdoza2]">
                                                            <option value="">Volume unit</option>
                                                            {if $unit} {foreach from=$unit key=key item=value}
                                                            <option value="{$value->id}" {if $cas->vdoza2 eq $value->id }selected="selected"{/if} data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
                                                            {/foreach} {/if}
                                                        </select>
                                                    </div>
                                                    {else}
                                                      

                                                     <div class="col-sm-4 no-padding">
                                                        <input type="text" class="form-control mylos" placeholder="Quantity" name="cass[{$count}][mdoza2]" value="">
                                                    </div>
                                                    <div class="col-sm-8 no-padding">
                                                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="cass[{$count}][vdoza2]">
                                                            <option value="">Volume unit</option>
                                                            {if $unit} {foreach from=$unit key=key item=value}
                                                            <option value="{$value->id}" data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
                                                            {/foreach} {/if}
                                                        </select>
                                                    </div>

                                                    {/if}
                                                </div>
                                               <button type="button" class="btn remove-item remove-c-row" data-toggle="tooltip" data-placement="top" data-cid="{$cas->id}" title="" > <img src="{base_url('templates/default/assets/img/times.png')}"></button>
                                               <div class="input-group add-c-name">
                                                <span class="input-group-addon beautiful" style="width:101px;">Name</span>
                                                <input type="text" class="form-control fix-inputgroup" value="{get_cas_name($cas->id)}" reaadonly disabled>
                                            </div>
                                             <div class="extra-mg2" style="margin-left:0">
                                                 <div class="input-group add-c-unit add-c-acode" >
                                                    <span class="input-group-addon beautiful" >ATC Code</span>
                                                    <div class="form-inline" style="">
                                                        <input type="text" class="form-control mylos tagsinput atc_code_input" placeholder="ATC CODE" name="" data-role="tagsinput" multiple>
                                                    </div>
                                                </div>
                                             </div>

                                            </div>
                                            
                                       
                                       

                                    </div>
                                  
                                    {assign var=count value=$count+1} {/foreach} {/if}
                                 </div>
                                            </div>
                                            <div class="col-md-9 no-padding content_add">
                                                <div class="pull-left">
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
       
                             </div>
                                    <div class="clearfix"></div>
                                <div class="two-column" style="display: block;">
                               
                                 <h2 class="add-pr-heading forcontent" id="section3">Dosage</h2>
                                        <div class="col-md-12 term-inner">
                                           <div class="form-group">
                                                <div class="col-md-12 no-padding">
                                                   <div class="col-md-1 no-padding dossage-limit" style="width:100px;">
                                                        <button type="button" class="dossage dossageForm btn-dossage" data-widget=""  data-target="#dossageForm">Add</button>
                                                    </div>
                                                    <div class="col-md-12 no-padding dossageForm-inner">
                                                {assign var=countx value=1} {assign var=packing_types value=json_decode($product->packing_type)} {if !empty($packing_types)} {foreach from=$packing_types item=packing_type}
                                                <div class="form-group label_{$packing_type->id}">
                                                   <div class="col-md-12 no-padding add-c-row">
                                                         <div class="input-group add-c-name">
                                                            <span class="input-group-addon beautiful">Dossage</span>
                                                            <input type="text" class="form-control fix-inputgroup" style="width:100%" value="{get_packing_type_name($packing_type->id)}" reaadonly disabled>
                                                            <input type="hidden" name="packing_types[{$countx}][id]" value="{$packing_type->id}">
                                                        </div>
                                                   
                                                       
                                                   
                                                       <div class="input-group add-c-count">
                                                            <span class="input-group-addon beautiful" >Quantity</span>
                                                          
                                                                <input type="text" class="form-control mylos" placeholder="Quantity" name="packing_types[{$countx}][mdoza]" value="{$packing_type->mdoza}">
                                                        </div>
                                                           <div class="input-group add-c-unit">
                                                            <label for="">Packing</label>
                                                                    <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="packing_types[{$countx}][vdoza]" title="Packing">
                                                                        {if $drug_types} {foreach $drug_types as $key=>$value}
                                                                        <option {if $packing_type->vdoza eq $value->id}selected="selected"{/if} value="{$value->id}">{$value->name}</option>
                                                                        {/foreach} {/if}
                                                                    </select>
                                                                </div>
                                                                <div style="float:left;">
                                                                    {if $packing_type->mdoza2}
                                                                    <button type="button" class="minus_item" style="display:block !important">-</button>
                                                                     <button type="button" class="plus_item" data-id="{$countx}" data-type="packing_types" style="display: none;">+</button>
                                                                    {else}
                                                                    <button type="button" class="plus_item" data-id="{$countx}" data-type="packing_types">+</button>
                                                                     <button type="button" class="minus_item" style="display:none">-</button>
                                                                    {/if}
                                                                </div>
                                                                <div style="float:left;" class="extra-mg">
                                                                    {if $packing_type->mdoza2}
                                                                    <div class="col-sm-4 no-padding">
                                                                        <input type="text" class="form-control mylos" placeholder="Quantity" name="packing_types[{$countx}][mdoza2]" value="{$packing_type->mdoza2}">
                                                                    </div>
                                                                    <div class="col-sm-8 no-padding">
                                                                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="packing_types[{$countx}][vdoza2]">
                                                                            <option value="">Volume unit</option>
                                                                            {if $unit} {foreach from=$unit key=key item=value}
                                                                            <option value="{$value->id}" {if $packing_type->vdoza2 eq $value->id }selected="selected"{/if} data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
                                                                            {/foreach} {/if}
                                                                        </select>
                                                                    </div>
                                                                    {else}
                                                                     <div class="col-sm-4 no-padding">
                                                                        <label>Quantity</label>
                                                                        <input type="text" class="form-control mylos"  name="packing_types[{$countx}][mdoza2]" value="{$packing_type->mdoza2}">
                                                                    </div>
                                                                    <div class="col-sm-8 no-padding">
                                                                        <label>Volume Unit</label>
                                                                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="packing_types[{$countx}][vdoza2]">
                                                                            
                                                                            {if $unit} {foreach from=$unit key=key item=value}
                                                                            <option value="{$value->id}"  data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
                                                                            {/foreach} {/if}
                                                                        </select>
                                                                    </div>

                                                                    {/if}
                                                                </div>

                                                                 <button type="button" class="btn remove-item-dossage"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Remove"> <img src="{base_url('templates/default/assets/img/times.png')}"> </button>

                                                           
                                                        </div>
                                                    </div>
                                                  
                                               
                                                {assign var=countx value=$countx+1} {/foreach} {/if}
                                            </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>

                                 </div>
                                    <div class="three-column" style="display: block;">
                                        <h2 class="add-pr-heading forcontent">Add Medical Classifiction - <span>Need to add description for Media Classification we talk about</span></h2>

                                         <div class="col-md-12 term-inner">
                                            <div class="form-group">
                                                <div class="col-md-12 no-padding">
                                                   
                                                    <div class="col-md-1 no-padding medical-limit" style="width:100px;">
                                                        <button type="button" class="dossage medicalClassifictionForm btn-medicalClassifiction" data-widget=""  data-target="#medicalClassification"> Add</button>
                                                    </div>
                                                       <div class="col-md-12 no-padding medicalClassifiction-inner">
                                                {assign var=medical_cls value=explode(',', $product->medical_cl)} {assign var=medical_cl_count value=0} {if !empty($medical_cls)} {foreach from=$medical_cls item=medical_cl}
                                                <div class="form-group col-md-3 no-padding label_{$medical_cl}" style="margin-right:10px!important">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control mylos fix-inputgroup" value="{get_medical_classification_name($medical_cl)}" readonly>
                                                        <input type="hidden" value="{$medical_cl}" name="classifiction[{$medical_cl_count}]" readonly>
                                                       <span class="input-group-btn">
                                                          <button type="button" class="btn remove-item-classifiction" data-cid="{$medical_cl}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"> <img src="{base_url('templates/default/assets/img/times.png')}">  </button>
                                                    </span>
                                                    </div>
                                                </div>
                                                {assign var=medical_cl_count value=$medical_cl_count+1} {/foreach} {/if}
                                            </div>
                                                </div>
                                              
                                            </div>
                                        </div>

                          
                                 <h2 class="add-pr-heading forcontent" id="section4">General Information - <span>Need to add description for general Information we talk about</span></h2>
                                          <div class="col-md-12 term-inner detailsBottom">
                                            <div class="form-group">
                                                    <div class="col-md-4">
                                                     <div class="input-group add-c-count" >
                                                        <span class="input-group-addon beautiful" >Minimale Order Quantity</span>
                                                       <input type="text" class="form-control mylos" placeholder="{translate('moq')}" name="moq" value="{$product->moq}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="input-group add-c-count" >
                                                            <span class="input-group-addon beautiful" >Shelf life</span>
                                                            <input type="text" class="form-control mylos" placeholder="Shelf life" name="shelf_life" value="{$product->shelf_life}">
                                                            <span class="input-group-addon beautiful inp-addon-last" >month</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="input-group add-c-unit" >
                                                            <label>Storage</label>
                                                             <select class="form-control mylos selectpicker show-menu-arrow pils storage-select" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="storage">
                                                                <option value="1" {if $product->storage == "1"}selected{/if}>Do not store over 30 C</option>
                                                                <option value="2" {if $product->storage == "2"}selected{/if}>Do not store over 25 C</option>
                                                                <option value="3" {if $product->storage == "3"}selected{/if}>Do not store over 15 C</option>
                                                                <option value="4" {if $product->storage == "4"}selected{/if}>Do not store over 8 C</option>
                                                                <option value="5" {if $product->storage == "5"}selected{/if}>Do not store below 8 C</option>
                                                                <option value="6" {if $product->storage == "6"}selected{/if}>Protect from moisture</option>
                                                                <option value="7" {if $product->storage == "7"}selected{/if}>Protect from light</option>
                                                                <option value="8" {if $product->storage == "8"}selected{/if}>Other</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="col-md-4">
                                                        <label>Add Photo</label>
                                                        <div class="col-md-12 no-padding img-full-right-block img_forece">
                                                            <div class="inner-img">
                                                            {if $product_images} {foreach from=$product_images item=$product_image}
                                                            <div class="img-upload-group bitrix add lab_{$product_image.image_id}" var-attr="lab_{$product_image.image_id}">
                                                                <div class="reload-form-cover-mini reload-form-upload">
                                                                    <img src="{base_url('uploads')}/catalog/product/{$product_image.image}" title="" alt="" />
                                                                     <input type="file" name="userfile[]" class="userfile">
                                                                    <button type="button" class="mini-upload upload-button" data-id="" data-target="">UPLOAD</button>
                                                                </div>
                                                            </div>
                                                            {/foreach}
                                                            {else}
                                                            <div class="img-upload-group add bitrix" var-attr="lab_1">
                                                                    <div class="reload-form-upload">
                                                                        <label>
                                                                            <input type="file" name="userfile[]" class="userfile">
                                                                            <button type="button" class="mini-upload upload-button" data-id="" data-target="">UPLOAD</button>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            {/if}
                                                        </div>
                                                              
                                                        </div>
                                                    </div> 
                                                    <div class="col-md-4">
                                                        <label>Dossier Format</label>
                                                        <div class="col-md-12 no-padding">
                                                          <input type="checkbox" id="BE" name="be" value="1" {if $product->be eq 1}checked="checked"{/if} >
                                                        <label for="BE">BE</label>
                                                        <input type="checkbox" id="CTD" name="ctd" value="1" {if $product->ctd eq 1}checked="checked"{/if} >
                                                        <label for="CTD" style="margin-left:15px;">CTD</label>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="col-md-12">
                                                        <div class="input-group add-c-count" >
                                                            <span class="input-group-addon beautiful" >Add more information</span>
                                                            <textarea class="form-control mylos" placeholder="" nname="description" rows="4">{$product->description}</textarea>
                                                        </div>   
                                                    </div>
                                            </div>
                                        </div>
                                        <!--------------------------------------->
                                        <!--------------------------------------->
                                        <!--------------------------------------->
                                        <!--------------------------------------->
                                        <!--------------------------------------->
                                        <!--------------------------------------->
 
                                   <div class="col-md-12 no-padding term-inner button-row">
                                            <div class="form-group">
                                                <div class="col-md-12 no-padding">
                                                   
                                                    <button type="submit" class="submit-product-btn pull-right" style="margin-top:0px;border-radius:0px;">Save</button>
                                                     <button type="button" class="close-product-btn" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style="display:none;">CLOSE</button>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
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
            `<div class="form-group vared herbalRow label_` + data_id + `">
                <div class="col-md-2 no-padding label_add_prod">
                    <label>Ingredient ` + count + `</label>
                    <input type="hidden" name="herbals[` + count + `][id]" value="` + data_id + `">
                </div>
                 <div class="col-md-12 no-padding add-c-row">
                     <div class="input-group add-c-name">
                        <span class="input-group-addon beautiful" style="width:101px;">Herbal</span>
                        <input type="text" class="form-control fix-inputgroup" title="`+data_txt+`" value="` + data_txt + `" reaadonly disabled>
                    </div>
               
                
               
                    <div class="input-group add-c-count" style="margin-bottom:5px;">
                        <span class="input-group-addon beautiful" >Quantity</span>
                        <input type="text" class="form-control mylos"  name="herbals[` + count + `][mdoza]" required>
                    </div>
                            <div class="input-group add-c-unit">
                                <label for="">Dose Unit</label>
                                <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1"  name="herbals[` + count + `][vdoza]" required>
                                    <option value="">-</option>
                                    {if $unit}{foreach $unit as $key=>$value}
                                        <option value="{$value->id}" data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
                                    {/foreach}{/if}
                                </select>
                            </div>
                            <div class="input-group add-c-unit">
                                <label for="">Herb part</label>
                                <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="herbals[` + count + `][part]">
                                    <option class="bs-title-option" value="">-</option>
                                    {if $herb_parts}{foreach $herb_parts as $key=>$herb_part}
                                      <option value="{$herb_part->id}" data-code="{$herb_part->name}" title="{$herb_part->name}">{$herb_part->name}</option>
                                    {/foreach}{/if}
                                </select>
                            </div>
                            <div class="input-group add-c-unit">
                            <label for="">Herb form</label>
                                <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="herbals[` + count + `][form]">
                                    <option class="bs-title-option" value="">-</option>
                                    {if $herb_forms}{foreach $herb_forms as $key=>$herb_form}
                                    <option value="{$herb_form->id}" data-code="{$herb_form->name}" title="{$herb_form->name}">{$herb_form->name}</option>
                                    {/foreach}{/if}
                               </select>
                            </div>
                             <button type="button" class="btn remove-item remove-c-row" data-toggle="tooltip" data-placement="top" data-cid="`+data_id+`" title="" > <img src="{base_url('templates/default/assets/img/times.png')}"></button>
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
                    <label>Ingredient ` + count + `</label>
                    <input type="hidden" name="animals[` + count + `][id]" value="` + data_id + `">
                </div>
                <div class="col-md-12 no-padding">
                    <div class="input-group add-c-name">
                        <span class="input-group-addon beautiful" style="width:101px;">Animal</span>
                        <input type="text" class="form-control fix-inputgroup" title="`+data_txt+`" value="` + data_txt + `" reaadonly disabled>
                    </div>
                    
                    <div class="input-group add-c-count">
                        <span class="input-group-addon beautiful" style="width: 95px;height: 32px;">Quantity</span>
                        
                        <input type="text" class="form-control mylos"  name="animals[` + count + `][mdoza]" required>
                    </div>
                    <div class="input-group add-c-count">
                        <label for="">Dose unit</label>
                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1"  name="animals[` + count + `][vdoza]" required>
                            <option value="">-</option>
                            {if $unit}{foreach $unit as $key=>$value}
                            <option value="{$value->id}" data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
                            {/foreach}{/if}
                        </select>
                    </div>
                    <div class="input-group add-c-unit">
                        <label for="">Animal part</label>
                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="animals[` + count + `][part]">
                            <option class="bs-title-option" value="">-</option>
                            {if $animal_parts}{foreach $animal_parts as $key=>$animal_part}
                            <option value="{$animal_part->id}" data-code="{$animal_part->name}" title="{$animal_part->name}">{$animal_part->name}</option>
                            {/foreach}{/if}
                        </select>
                    </div>
                    <div class="input-group add-c-unit">
                    <label for="">Animal form</label>
                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="animals[` + count + `][form]">
                            <option class="bs-title-option" value="">-</option>
                            {if $animal_forms}{foreach $animal_forms as $key=>$animal_form}
                            <option value="{$animal_form->id}" data-code="{$animal_form->name}" title="{$animal_form->name}">{$animal_form->name}</option>
                            {/foreach}{/if}
                        </select>
                    </div>
                    
                    <button type="button"  data-cid="`+data_id+`" class="btn btn-danger btn-bix pull-right remove-item remove-c-row" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"> <i class="fa fa-trash"></i> </button>
                </div>
               
            </div>`;
        return component;
        }
    function addChermical(count, data_txt, data_no, data_formula, data_target, data_id) {
            var component =
            `<div class="form-group vared label_`+data_id+`">
                <div class="col-md-2 no-padding label_add_prod">
                    <label>Ingredient ` + count + `</label>
                    <input type="hidden" name="atc_codes[` + count + `][id]" value="` + data_id + `">
                </div>
                <div class="col-md-12 no-padding add-c-row">
                    <div class="input-group add-c-code">
                        <span class="input-group-addon beautiful" style="width:101px;">Atc code</span>
                        <input type="text" class="form-control fix-inputgroup" value="`+data_no+`" reaadonly disabled>
                    </div>
                    <div class="input-group add-c-name">
                        <span class="input-group-addon beautiful" style="width:101px;">Name</span>
                        <input type="text" class="form-control fix-inputgroup" title="`+data_txt+`" value="`+data_txt+`" reaadonly disabled>
                    </div>
                    <div class="input-group add-c-count" >
                        <span class="input-group-addon beautiful">Quantity</span>
                        <input type="text" class="form-control mylos" value="1"  name="atc_codes[` + count + `][mdoza]" required>
                    </div>
                    <div class="input-group add-c-unit">
                    <label for="">Dose Unit</label>
                                <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1"  name="atc_codes[` + count + `][vdoza]" required>
                                    <option value="">-</option>
                                    {if $unit}{foreach $unit as $key=>$value}
                                    <option value="{$value->id}" data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
                                    {/foreach}{/if}
                                </select>
                            </div>
                            <div style="float:left;">
                                <button type="button" class="plus_item" data-id="` + count + `" data-type="atc_codes">+</button>
                                <button type="button" class="minus_item">-</button>
                            </div>
                              <div class="extra-mg"></div>
                            <button type="button" class="btn remove-item remove-c-row" data-cid="`+data_id+`" data-toggle="tooltip" data-placement="top" > <img src="{base_url('templates/default/assets/img/times.png')}"></button>
                          
                       
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
                                <input type="text" class="form-control" placeholder="purity (%)" name="atc_codes[` + count + `][purity]" style="border-radius:4px!important">
                            </div>
                        </div>
                    </div>`;
                }
                component+=`</div>
               
            </div>`;
            return component;
        }
    function addDossageForm(count, data_txt, data_no, data_formula, data_target, data_id) {
            var component =
            `<div class="form-group label_` + data_id + `" style="padding-bottom: 0px;">
                <div class="col-md-12 no-padding add-c-row">
                    <div class="input-group add-c-name">
                        <span class="input-group-addon beautiful" style="width:101px;">Dossage</span>
                        <input type="text" class="form-control fix-inputgroup" title="`+data_txt+`" style="width:100%" value="` + data_txt + `" reaadonly disabled>
                        <input type="hidden" name="packing_types[` + count + `][id]" value="` + data_id + `">
                    </div>
                    
                    
                    
                    <div class="input-group add-c-count">
                        <span class="input-group-addon beautiful" >Quantity</span>
                        <input type="text" class="form-control mylos" value="1" name="packing_types[` + count + `][mdoza]" required>
                    </div>
                    <div class="input-group add-c-unit">
                    <label for="">Packing</label>
                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1"  name="packing_types[` + count + `][vdoza]" title="-" required>
                            {if $drug_types}{foreach $drug_types as $key=>$value}
                            <option value="{$value->id}">{$value->name}</option>
                            {/foreach}{/if}
                        </select>
                    </div>
                    <div style="float:left;">
                        <button type="button" class="plus_item" data-id="` + count + `" data-type="packing_types">+</button>
                        <button type="button" class="minus_item">-</button>
                    </div>
                    <div class="extra-mg"></div>
                    <button type="button" class="btn remove-item-dossage" data-toggle="tooltip" data-placement="top" title="" data-cid="`+data_id+`" > <img src="{base_url('templates/default/assets/img/times.png')}"> </button>                    
                    
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>`;
            return component;
        }
    function addmedicalClassification(count, data_txt, data_no, data_formula, data_target, data_id) {
            var component =
            `<div class="form-group col-md-3 no-padding label_` + data_id + `" style="margin-right:10px!important">
                <div class="input-group">
                    <input type="text" class="form-control mylos fix-inputgroup" value="` + data_txt + `" readonly>
                    <input type="hidden" value="` + data_id + `" name="classifiction[` + count + `]" readonly>
                    <span class="input-group-btn">
                          <button type="button" class="btn remove-item-classifiction" data-cid="`+data_id+`" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"> <img src="{base_url('templates/default/assets/img/times.png')}">  </button>
                    </span>
                </div>
            </div>`;
            return component;
        }
    function addCasNumber(count, data_txt, data_no, data_formula, data_target, data_id) {
            var component =
            `<div class="form-group cas-add-row vared label_` + data_id + `">
                <div class="col-md-2 no-padding label_add_prod">
                    <label>Ingredient ` + count + `</label>
                    <input type="hidden" name="cass[` + count + `][id]" value="` + data_id + `">
                </div>
                <div class="col-md-12 no-padding add-c-row">
                    <div class="input-group add-c-code add-cas-code">
                        <span class="input-group-addon beautiful" style="width:101px;">CAS No</span>
                        <input type="text" class="form-control fix-inputgroup" title="`+data_no+`" value="`+data_no+`" reaadonly disabled>
                    </div>
                    <div class="input-group add-c-code add-cas-formula">
                        <span class="input-group-addon beautiful" style="width:101px;">Formula</span>
                        <input type="text" class="form-control fix-inputgroup" title="`+data_formula+`" value="`+data_formula+`" reaadonly disabled>
                    </div>
                   
                
               
                    <div class="input-group add-c-unit add-c-purity">
                        <label>Purity</label>
                        <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="cass[` + count + `][purity_unit]" style="z-index:1040;">
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
                    <label for="">Dose unit</label>
                       <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1"  name="cass[` + count + `][vdoza]" required>
                                <option value="">-</option>
                                {if $unit}{foreach $unit as $key=>$value}
                                <option value="{$value->id}" data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
                                {/foreach}{/if}
                            </select>
                    </div>
                    
                     <div style="float:left;margin-right: 10px;">
                                <button type="button" class="plus_item" data-id="` + count + `" data-type="cass">+</button>
                                <button type="button" class="minus_item">-</button>
                            </div>
                            <div class="extra-mg" style="margin-left:0;"><div class="col-sm-4 no-padding">
                <label for="">Quantity</label>
                <input type="text" class="form-control mylos" name="cass[`+data_id+`][mdoza2]" value="">
             </div>
             <div class="col-sm-8 no-padding">
             <label for="">Volume unit</label>
                <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="cass[` + data_id + `][vdoza2]">
                    <option value="">-</option>
                    {if $unit}{foreach $unit as $key=>$value}
                    <option value="{$value->id}" data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
                    {/foreach}{/if}
                </select>
             </div></div>
                      <button type="button" class="btn remove-item remove-c-row" data-toggle="tooltip" data-placement="top" title="" data-cid="`+data_id+`"> <img src="{base_url('templates/default/assets/img/times.png')}"></button>

                       <div class="input-group add-c-name">
                        <span class="input-group-addon beautiful" style="width:101px;">Name</span>
                        <input type="text" class="form-control fix-inputgroup" title="`+data_txt+`" value="`+data_txt+`" reaadonly disabled>
                    </div>

                    <div class="extra-mg2" style="margin-left:0;display:none"><div class="input-group add-c-unit add-c-acode" >
                        <span class="input-group-addon beautiful" >ATC Code</span>
                        <div class="form-inline" style="">
                             <input type="text" class="form-control mylos tagsinput atc_code_input" name="" data-role="tagsinput" multiple>
                        </div>
                    </div></div>

                </div>
                <div class="clearfix"></div>
            </div>`;
            return component;
        }
    $(document).on('click', '.plus_item', function() {
        var data_id = $(this).data('id');
        var data_type = $(this).data('type');
        var component =
        `<div class="col-sm-4 no-padding">
            <input type="text" class="form-control mylos" placeholder="Quantity" name="` + data_type + `[` + data_id + `][mdoza2]" value="1">
         </div>
         <div class="col-sm-8 no-padding">
            <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="` + data_type + `[` + data_id + `][vdoza2]">
                <option value="">Volume unit</option>
                {if $unit}{foreach $unit as $key=>$value}
                <option value="{$value->id}" data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
                {/foreach}{/if}
            </select>
         </div>
         `;
          var component2 = `<div class="input-group add-c-unit add-c-acode" >
                        <span class="input-group-addon beautiful" >ATC Code</span>
                        <div class="form-inline" style="">
                             <input type="text" class="form-control mylos tagsinput atc_code_input" name="" data-role="tagsinput" multiple>
                        </div>
                    </div>`;
        $(this).hide();
        $('.selectpicker').selectpicker();
        $(this).parent().find('.minus_item').show();
        $(this).parents('.add-c-row').find('div.extra-mg').show();
        $(this).parents('.add-c-row').find('div.extra-mg2').show();
    });
    $(document).on('click', '.minus_item', function() {
        $(this).hide();
        $(this).parent().find('.plus_item').show();
        $(this).parents('.add-c-row').find('div.extra-mg').hide();
        $(this).parents('.add-c-row').find('div.extra-mg2').hide();
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
    function getMedicalClass(param) {
        return $.ajax({
            type:'POST',
            url:site_url+'product/get_medical_class/',
            data: {'medical_id':param},
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
            $('.search-tool').show();
             $('body').append('<div class="blackstack"></div>');
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
                  $('.frist-inner').prev('.add-pr-heading').remove();
                $('.frist-inner').before('<h2 class="add-pr-heading forcontent" id="section2">Ingredients - <span>Need to add description for ingredients we talk about</span></h2>');
                $('.frist-inner').css('padding','20px');
                //console.log(cookies);
                if(data_target == 'chemical')
                {
                    if(cookies.settings[0].multiple[0].chemical == '1')
                    {
                        var component = addChermical(count, data_txt,data_no, data_formula , data_target, data_id);
                        $('.frist-inner').append(component);
                        $('.selectpicker').selectpicker();
                       
                    //    $('.blackstack').remove();
                     //   $('.search-tool').hide();
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
                           
                            $('.blackstack').remove();
                            $('.search-tool').hide();
                            $(".two-column").slideDown( "slow", function(){});
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
                    $('.selectpicker').selectpicker();
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
    $(document).on('click', '.add-button-photos', function(e) {
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
    });
    {/literal}
</script>
{if isset($message)}<script>toastr.warning(`{$message.message}`);</script>{/if}

{literal}
<script>
    // When the user scrolls the page, execute myFunction
    window.onscroll = function() {myFunction()};
    var eTop = $('#addProductNav').offset().top; //get the offset top of the element
    // Get the navbar
    var navbar = $("#addProductNav");
    // Get the offset position of the navbar
    var sticky = eTop - $(window).scrollTop();
    console.log(sticky);
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
          $(document).on('click', '.remove-item', function() {
      var id = $(this).data('cid');
      var that = $(this);
      if(confirm('Are you sure?')){
    
          var parentrow = that.parent().parent();
          parentrow.remove();
               if(that.parent().parent().hasClass('cas-add-row')){
            $('.casNumber').removeAttr('disabled').removeClass('disabled');
            come--;
          }
         
          console.log($('.search-tool li[data-id="'+id+'"]').length);
          $('.search-tool li[data-id="'+id+'"]').removeClass('selected');
  
        $('.form-group.vared').each(function(index, el) {
            var ind = index+1;
            $(el).find('label').text('Ingredient '+ind);
        });
             
            }
    });
        $(document).on('click','.search-inner .fa-times', function(){
            $('.search-tool').removeClass('col-md-3');
            $('.blackstack').remove();
            $('.search-tool').hide();
        })
        $(window).scroll(function () { 
    var sctop =  $(window).scrollTop() ;
   if(sctop<160){
        $('.add-product-nav-ul li:nth-child(1)').siblings()
    .removeClass('active');
        $('.add-product-nav-ul li:nth-child(1)').addClass('active');
   }
   else if(sctop>=160 && sctop<425){
        $('.add-product-nav-ul li:nth-child(2)').siblings()
    .removeClass('active');
        $('.add-product-nav-ul li:nth-child(2)').addClass('active');
   }
    else if(sctop>=425 && sctop<615){
        $('.add-product-nav-ul li:nth-child(3)').siblings()
    .removeClass('active');
        $('.add-product-nav-ul li:nth-child(3)').addClass('active');
   }
    else{
        $('.add-product-nav-ul li:nth-child(4)').siblings()
    .removeClass('active');
        $('.add-product-nav-ul li:nth-child(4)').addClass('active');
   }
});
</script>

{/literal}
{/block}
