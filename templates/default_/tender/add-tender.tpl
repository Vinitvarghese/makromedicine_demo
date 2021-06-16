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
/* .two,.three,.four,.six,.seven,.eight,.nine{
    max-width: 150px!important;
    width: 150px!important;
} */
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

</style>
    <div class="wrap margin-top-100 col-md-12">
        <div class="container-fuild">
            <div class="row">
               <div class="container no-padding" style="width: 1326px">
                    {if $UserData->status neq 1}
                <div class="alert alert-danger" style="margin-top: 10px;margin-bottom:0">
                    Please upload a certificate. After the confirmation of certificate your account will be approved and your products will appear on the top rank of the search list.
                </div>
              {/if}
               </div>
                <div class="clearfix"></div>
                <div class="col-md-12" id="add-product">
                    <div class="col-md-12 no-padding add-product collapse {if isset($message)} in {/if}" id="collapseExample">
                        <div class="col-md-12 no-padding panel-add">
                            <form class="" role="form" method="POST" action="{site_url_multi('tender/add')}"  enctype="multipart/form-data">
                                <input type="hidden" name="request" value="add">
                                <div class="no-padding search-tool" style="display:none;">
                                    <div class="col-md-12 malecule">
                                        <div class="search-module">
                                            <input type="text" class="module-search" id="for-search" placeholder="Search">
                                            <div class="search-inner"></div>
                                        </div>
                                        <div class="col-md-12 no-padding discom">
                                            <ul class="list-chemical periodic collapse in" id="chemical">
                                                {if $chemichal}{foreach from=$chemichal item=chemical}
                                                <li data-txt="{$chemical->meaning}" data-no="{$chemical->atc_code}" data-formula="" data-target="chemical" data-id="{$chemical->id}">
                                                    <a href="#{$chemical->atc_code}" >
                                                        <div class="lib-span" data-toggle="tooltip" data-placement="right" title="{$chemical->atc_code} | {$chemical->meaning}">{$chemical->atc_code} </div>
                                                        <div class="lib-span2"> | {$chemical->meaning}</div>
                                                    </a>
                                                    <div class="clearfix"></div>
                                                </li>
                                                {/foreach}{/if}
                                            </ul>
                                            <ul class="list-herbal periodic collapse" id="herbal">
                                                {if $herbals} {foreach from=$herbals item=herbal}
                                                    <li data-txt="{$herbal->name}" data-no="" data-formula="" data-target="herbal" data-id="{$herbal->id}"> <a href="#"   title="{$herbal->name}">{$herbal->name}</a> </li>
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
                                                    <a href="#{$cas_number->cas_no}"  data-toggle="tooltip" data-placement="bottom" title="{str_replace('"','',$cas_number->chemical_name)}">
                                                        <div class="lib-span3" >{$cas_number->cas_no} </div>
                                                        <div class="lib-span4"> | {mb_substr($cas_number->chemical_name, 0, 14, 'UTF-8')}</div>
                                                    </a>
                                                    <div class="clearfix"></div>
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
                                        {if isset($message)}
                                            <script> toastr.warning(`{$message.message}`); </script>
                                        {/if}
                                        <div class="form-group">

                                            <div class="col-md-5 no-padding">


                                                <div class="col-md-4 no-padding" style="margin-bottom:15px;">
                                                    <label>Product type</label>
                                                </div>
                                                <div class="col-md-7 no-padding" style="margin-bottom:15px;">
                                                    <select name="pr_type" class="form-control mylos selectpicker show-menu-arrow product_type_select" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" title="Please Select Type">
                                                        {if $product_type}{foreach $product_type as $key=>$type}
                                                        <option value="{$type->id}">{$type->name}</option>
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
                                                        <option value="{$continent->id}">{$continent->name}</option>
                                                        {/foreach}{/if}
                                                    </select>
                                                </div>

                                                <div class="clearfix"></div>

                                                <div class="col-md-4 no-padding" style="margin-bottom:15px;">
                                                    <label>Start date</label>
                                                </div>
                                                <div class="col-md-7 no-padding" style="margin-bottom:15px;">
                                                    <input type="date" name="tenderstart" class="form-control mylos tenderstart" placeholder="Select start date">
                                                </div>

                                                <div class="clearfix"></div>

                                                <div class="col-md-4 no-padding" style="margin-bottom:15px;">
                                                    <label>Tender name</label>
                                                </div>
                                                <div class="col-md-7 no-padding" style="margin-bottom:15px;">
                                                    <input type="text" name="title" class="form-control mylos tendername" placeholder="Tender name">
                                                </div>


                                            </div>


                                            <div class="col-md-6 no-padding">

                                                <div class="col-md-2 col-lg-2 no-padding" style="margin-bottom:15px;">
                                                    <label>Trade term</label>
                                                </div>
                                                <div class="col-md-4 no-padding" style="margin-bottom:15px;">
                                                    <select name="trade_term" class="form-control mylos selectpicker show-menu-arrow trade_term_select" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" title="Please Select trade term">
                                                        {if $trade_term}{foreach $trade_term as $key=>$term}
                                                        <option value="{$term->id}">{$term->short_name}</option>
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
                                                            <option value="{$country->id}" data-name="{$country->code}" {if $UserData->country_id eq $country->id} selected="selected" {else if empty($UserData->country_id)} {if $country->id == $ip_country->id } selected="selected" {/if} {/if}>{$country->name}</option>
                                                        {/foreach}{/if}
                                                    </select>
                                                </div>

                                                <div class="clearfix"></div>

                                                <div class="col-md-2 col-lg-2 no-padding" style="margin-bottom:15px;">
                                                    <label>End date</label>
                                                </div>
                                                <div class="col-md-4 no-padding" style="margin-bottom:15px;">
                                                    <input type="date" name="tenderend" class="form-control mylos tenderend" placeholder="Select end date">
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
                                    <div class="clearfix"></div>
                                    <div class="two-column">

                                        <div class="col-md-12 term-inner">
                                            <div class="form-group">
                                                <div class="col-md-12 no-padding">
                                                    <div class="col-md-2 no-padding label_add_prod">
                                                        <label>Add Dosage Form</label>
                                                    </div>
                                                    <div class="col-md-1 no-padding dossage-limit" style="width:40px;">
                                                        <button type="button" class="dossage dossageForm btn-dossage" data-widget=""  data-target="#dossageForm">+</button>
                                                    </div>
                                                    <div class="col-md-8 no-padding dossageForm-inner" >

                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <div id="div_timer"></div>

                                        <div class="col-md-12 term-inner">
                                            <div class="form-group">
                                                <div class="col-md-12 no-padding">
                                                    <div class="col-md-2 no-padding label_add_prod">
                                                        <label>Dossier Format</label>
                                                    </div>
                                                    <div class="col-md-2 no-padding">
                                                        <input type="checkbox" id="BE" name="be" value="1">
                                                        <label for="BE">BE</label>
                                                        <input type="checkbox" id="CTD" name="ctd" value="1">
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
                                                            <input type="text" class="form-control mylos" placeholder="{translate('moq')}" name="moq">
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
                                                            <input type="text" class="form-control mylos storage-input" placeholder="Storage" name="storage" style="display:none;">
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>


                                        <!-- <div class="col-md-12 term-inner">
                                            <div class="form-group">
                                                <div class="col-md-12 no-padding">
                                                    <div class="form-group" style="padding-bottom:0px;">
                                                        <div class="col-md-2 no-padding label_add_prod">
                                                            <label>Add Photo</label>
                                                        </div>
                                                        <div class="col-md-10 no-padding">
                                                             <div class="col-md-12 no-padding img-full-right-block img_forece">
                                                                <div class="inner-img">
                                                                    <div class="img-upload-group add bitrix" var-attr="lab_1">
                                                                        <div class="reload-form-upload">
                                                                            <label>
                                                                                <input type="file" name="userfile[]" class="userfile">
                                                                                <button type="button" class="mini-upload upload-button" data-id="" data-target=""></button>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div> -->



                                        <div class="col-md-12 no-padding term-inner moreInfo">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <div class="form-group" style="padding-bottom:0px;">
                                                        <div class="col-md-2 no-padding label_add_prod">
                                                            <button type="button" class="btn-moders moreInfo" data-toggle="collapse" data-target="#more-information" aria-expanded="false" aria-controls="more-information" style="width:auto">Add more information</button>
                                                        </div>
                                                        <div class="col-md-6 no-padding">
                                                            <div class="col-md-12 no-padding more-information collapse" id="more-information">
                                                                <textarea name="description" placeholder="demo" data-validation-error-msg=" " data-validation="alphanumeric " class="ckeditor" id="CKeditor" style="visibility: hidden; display: none;"> </textarea>
                                                            </div>
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
                                                    <button type="submit" class="submit-product-btn pull-right" style="margin-top:0px;border-radius:0px;">Save</button>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-12 no-padding" style="clear:both;width: 1326px;margin: 0 auto;float: none; padding: 0;">
                      
                        <button type="button" class="add-product-btn" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">ADD NEW TENDER</button>
                        <button type="button" class="close-product-btn" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style="display:none;">CLOSE</button>
                    </div>
                </div>
                <div class="col-md-12">
                    <form class="searchTable" action="{base_url('home/search_table')}" method="post">
                      <div class="col-md-12 no-padding tables-data">
                          <table class="table table-striped no-padding display table-search-not"  id="example" >
                              <thead>
                                  <tr>
                                      <th class="one"></th>
                                      <th class="two">
                                        <select class="form-control selectpicker show-menu-arrow product_type" multiple data-live-search="true" data-selected-text-format="count > 0" data-actions-box="true" title="Product Type"></select>
                                      </th>
                                      <th class="three">
                                        <input type="text" name="tender_name" class="form-control tender_name" placeholder="Tender Name">
                                      </th>
                                      <th class="four">
                                        <select class="form-control selectpicker show-menu-arrow select_content" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Content"></select>
                                      </th>
                                      <th class="five">
                                        <select class="form-control selectpicker show-menu-arrow select_dossage" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Dosage form"></select>
                                      </th>
                                      <th class="six">
                                        <select class="form-control selectpicker show-menu-arrow select_country" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Country"></select>
                                      </th>
                                      <th class="six_one">
                                        <select class="form-control selectpicker show-menu-arrow select_continent" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Continent"></select>
                                      </th>
                                      <th class="seven">
                                        <input type="date" name="startdate" class="form-control startdate" placeholder="Start date">
                                      </th>
                                      <th class="eight">
                                        <input type="date" name="enddate" class="form-control enddate" placeholder="End date">
                                      </th>
                                      <th class="nine">
                                        <select class="form-control selectpicker show-menu-arrow trade_term" multiple data-live-search="true" data-selected-text-format="count > 0" data-actions-box="true" title="Trade term"></select>
                                      </th>
                                      <th class="ten" style="min-width:108px!important"><a href="#" style="margin-left:8px">Operations</a></th>
                                  </tr>
                              </thead>
                              <tbody>
                                  {if $tenders}
                                      {foreach from=$tenders item=tender}
                                      {$company = get_company_name($tender->user_id)}
                                      {$atc_code = json_decode($tender->atc_code)}
                                      {$herbal = json_decode($tender->herbal)}
                                      {$animals = json_decode($tender->animal)}
                                      {$casNumbers = json_decode($tender->cas)}
                                      {if count($atc_code) > 0 || count($herbal) > 0 || count($animals) > 0 || count($casNumbers) > 0}
                                      {if isset($company->company_name)}
                                      {if !empty(trim($company->company_name))}
                                      <tr {if $tender->checked == 0 } class="not-active" {/if}>
                                          <td class="closed_tb one" style="width: 39px"></td>
                                          <td class="closed_tb two">
                                            <p>{get_product_type_name($tender->pr_type)}</p>
                                          </td>
                                          <td class="closed_tb three">
                                            <a href="{site_url_multi('trend/view/')}{$tender->id}{if $tender->alias}-{$tender->alias}{/if}" target="_blank"> <p>{$tender->title}</p></a>
                                          </td>
                                          <td class="closed_tb content four">
                                              <span>
                                              {if count($atc_code) > 0}
                                                  {foreach $atc_code as $atc}
                                                      <b>{get_atc_code_no($atc->id)}</b>
                                                      <span>({$atc->mdoza} {get_unit_name($atc->vdoza)} {if !is_null($atc->mdoza2) and $atc->mdoza2!=''} / {$atc->mdoza2} {get_unit_name($atc->vdoza2)}{/if})</span>
                                                  {/foreach}
                                              {/if}
                                              {if count($herbal) > 0}
                                                  {foreach $herbal as $herb}
                                                      <b>{get_herbal_name($herb->id)}</b>
                                                      <span>({$herb->mdoza} {get_unit_name($herb->vdoza)})</span>
                                                  {/foreach}
                                              {/if}
                                              {if count($animals) > 0}
                                                  {foreach $animals as $animal}
                                                      <b>{get_animal_name($animal->id)}</b>
                                                      <span>{$animal->mdoza} {get_unit_name($animal->vdoza)}</span>
                                                  {/foreach}
                                              {/if}
                                              {if count($casNumbers) > 0}
                                                  {foreach $casNumbers as $casss}
                                                      <b>{get_cas_name($casss->id)}</b>
                                                      <span>{$casss->mdoza} {get_unit_name($casss->vdoza)}</span>
                                                  {/foreach}
                                              {/if}
                                              </span>
                                          </td>
                                          <td class="closed_tb five">
                                            <span>
                                              {$var = json_decode($tender->packing_type)}
                                              {if count($var) > 0}
                                                  {$f = json_decode(json_encode($var[0]))}
                                                  <b>{get_packing_type_name($f->id)}</b>
                                                  <span>({if $f->mdoza2 neq 0}{$f->mdoza2}{/if} {get_unit_name($f->vdoza2)} {if $f->mdoza neq 0}{$f->mdoza}{/if} {get_drug_type_code($f->vdoza)})</span>
                                              {/if}
                                            </span>
                                          </td>
                                          <td class="closed_tb six">
                                              <center>
                                                  <a href="#" data-toggle="tooltip" data-placement="top" title="{get_country_name($tender->country)}">
                                                      <img src="{base_url('templates/default/assets/img/country/')}{get_country_code($tender->country)}.png" alt="{get_country_name($tender->country)}" class="table-img">
                                                      <p style="font-size:10px;color:#555;">{get_country_name($tender->country)}</p>
                                                  </a>
                                              </center>
                                          </td>
                                          <td class="closed_tb six_one">
                                              <center>
                                                  <a href="#" data-toggle="tooltip" data-placement="top" title="{get_continent_name($tender->continent)}">
                                                      <p style="font-size:10px;color:#555;">{get_continent_name($tender->continent)}</p>
                                                  </a>
                                              </center>
                                          </td>

                                          <td class="closed_tb seven">
                                            <p class="hidden">{date('Y-m-d', strtotime($tender->startdate))}</p>
                                            <span>
                                            {date('d M Y', strtotime($tender->startdate))}
                                            </span>
                                          </td>

                                          <td class="closed_tb eight">
                                            <p class="hidden">{date('Y-m-d', strtotime($tender->enddate))}</p>
                                            <span>
                                            {date('d M Y', strtotime($tender->enddate))}
                                            </span>
                                          </td>

                                          <td class="closed_tb nine">
                                            <span>
                                            {get_trade_term_name($tender->trade_term)}
                                            </span>
                                          </td>

                                          <td class="closed_tb ten">
                                            <center>
                                              <div class="btn-group" style="width:100px;">
                                                  <button type="button" class="btn btn-success btn-bix" data-toggle="tooltip" data-placement="top" title="Copy" onclick="window.location='{base_url("tender/copy/")}{$tender->id}'"> <i class="fa fa-copy"></i> </button>
                                                  <button type="button" class="btn btn-info btn-bix" data-toggle="tooltip" data-placement="top" title="Edit" onclick="window.location='{base_url("tender/update/")}{$tender->id}'"> <i class="fa fa-pencil"></i> </button>
                                                  <button type="button" class="btn btn-danger btn-bix remove-trash" data-toggle="tooltip" data-placement="top" title="Delete" onclick="if(confirm('Are you sure?')) window.location='{base_url("tender/delete/")}{$tender->id}'"> <i class="fa fa-trash"></i> </button>
                                              </div>
                                            </center>
                                          </td>
                                      </tr>
                                      {/if}
                                      {/if}
                                      {/if}
                                  {/foreach}
                              {/if}
                              </tbody>
                          </table>
                      </div>
                    </form>
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
                        <input type="text" class="form-control fix-inputgroup" title="`+data_txt+`" value="` + data_txt + `" reaadonly disabled>
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
                                <input type="text" class="form-control mylos"  name="herbals[` + count + `][mdoza]">
                            </div>
                            <div style="margin-left:5px;float:left">
                                <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1"  name="herbals[` + count + `][vdoza]">
                                    <option value="">Dose unit</option>
                                    {if $unit}{foreach $unit as $key=>$value}
                                        <option value="{$value->id}" data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
                                    {/foreach}{/if}
                                </select>
                            </div>
                            <div style="float:left;">
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
                    <input type="text" class="form-control fix-inputgroup" title="`+data_txt+`" value="` + data_txt + `" reaadonly disabled>
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
                            <input type="text" class="form-control mylos"  name="animals[` + count + `][mdoza]">
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
                        <span class="input-group-addon beautiful" style="width:101px;">Name</span>
                        <input type="text" class="form-control fix-inputgroup" title="`+data_txt+`" value="`+data_txt+`" reaadonly disabled>
                    </div>
                </div>
                <div class="col-md-1 hidden-xs" style="border-right:1px solid rgb(209, 209, 209);">
                    <button type="button" class="btn btn-danger btn-bix pull-right remove-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"> <i class="fa fa-trash"></i> </button>
                </div>
                <div class="col-md-6">
                    <div class="input-group" style="margin-bottom:5px;">
                        <span class="input-group-addon beautiful" style="width: 95px;height: 32px;">Quantity</span>
                        <div class="form-inline" style="">
                            <div style="width:76px;float:left;">
                                <label></label>
                                <input type="text" class="form-control mylos"  name="atc_codes[` + count + `][mdoza]">
                            </div>
                            <div style="float:left;">
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
                            <div style="width:44%;float:left;" class="extra-mg"></div>
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
                                <input type="text" class="form-control" placeholder="purity (%)" name="atc_codes[` + count + `][purity]" style="border-radius:4px!important">
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
                        <input type="text" class="form-control fix-inputgroup" title="`+data_txt+`" style="width:100%" value="` + data_txt + `" reaadonly disabled>
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
                            <div style="width:78px;float:left;">
                                <label></label>
                                <input type="text" class="form-control mylos" name="packing_types[` + count + `][mdoza]">
                            </div>
                            <div style="width:85px;float:left;">
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
                            <div style="width:40%;float:left;" class="extra-mg"></div>
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
                        <input type="text" class="form-control fix-inputgroup" title="`+data_no+`" value="`+data_no+`" reaadonly disabled>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon beautiful" style="width:101px;">Formula</span>
                        <input type="text" class="form-control fix-inputgroup" title="`+data_formula+`" value="`+data_formula+`" reaadonly disabled>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon beautiful" style="width:101px;">Name</span>
                        <input type="text" class="form-control fix-inputgroup" title="`+data_txt+`" value="`+data_txt+`" reaadonly disabled>
                    </div>
                </div>
                <div class="col-md-1 hidden-xs" style="border-right:1px solid rgb(209, 209, 209);">
                    <button type="button" class="btn btn-danger btn-bix pull-right remove-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil"> <i class="fa fa-trash"></i> </button>
                </div>
                <div class="col-md-6">
                    <div class="input-group" style="margin-bottom:5px;">
                        <span class="input-group-addon beautiful" style="width: 95px;height: 36px;">Purity</span>
                        <div class="form-inline purity-dt" style="height:34px">
                            <div class="form-group">
                                <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="cass[` + count + `][purity_unit]" style="z-index:1040;">
                                    {if $puritys}{foreach $puritys as $key=>$purity}
                                    <option value="{$purity->id}" data-code="{$purity->code}"> {$purity->code} </option>
                                    {/foreach}{/if}
                                </select>
                            </div>
                            <div class="form-group" style="width: 125px;margin-left: -5px!important;">
                                <label></label>
                                <input type="text" class="form-control" placeholder="purity (%)" name="cass[` + count + `][purity]">
                            </div>
                        </div>
                    </div>
                    <div class="input-group" style="margin-bottom:5px;">
                        <span class="input-group-addon beautiful" style="width: 95px;height: 36px;">Quantity</span>
                        <div class="form-inline" style="">
                            <div style="width:50px;float:left;">
                                <label></label>
                                <input type="text" class="form-control mylos"  name="cass[` + count + `][mdoza]">
                            </div>
                            <div style="float:left;width: 125px;">
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
                            <div style="width:44%;float:left;" class="extra-mg"></div>
                        </div>
                    </div>
                    <div class="input-group" style="width: 740px;margin-bottom:5px;">
                        <span class="input-group-addon beautiful" style="width:95px;height: 36px;">ATC Code</span>
                        <div class="form-inline" style="">
                             <input type="text" class="form-control mylos tagsinput atc_code_input" name="" data-role="tagsinput" multiple>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>`;
            return component;
        }
        $(document).on('click', '.plus_item', function(){
            var data_id = $(this).data('id');
            var data_type = $(this).data('type');
            var component =
            `<div class="col-sm-4 no-padding">
                <input type="text" class="form-control mylos" name="`+data_type+`[`+data_id+`][mdoza2]" value="1">
             </div>
             <div class="col-sm-8 no-padding">
                <select class="form-control mylos selectpicker show-menu-arrow pils" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" name="` + data_type + `[` + data_id + `][vdoza2]">
                    <option value="">Volume unit</option>
                    {if $unit}{foreach $unit as $key=>$value}
                    <option value="{$value->id}" data-code="{$value->short_name}" data-subtext="{$value->name}">{$value->short_name}</option>
                    {/foreach}{/if}
                </select>
             </div>`;
            $(this).parent().parent().find('div.extra-mg').append(component);
            $('.selectpicker').selectpicker();
            $(this).hide();
            $(this).parent().find('.minus_item').show();
        });
        $(document).on('click', '.minus_item', function(){
            $(this).parent().parent().find('div.extra-mg').empty();
            $(this).hide();
            $(this).parent().find('.plus_item').show();
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
                    $('.frist-inner').empty();
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
                                <input type="file" name="userfile[]" class="userfile">
                                <button type="button" class="mini-upload upload-button" data-id="" data-target=""></button>
                            </label>
                        </div>
                    </div>`;
            $('.img-full-right-block .inner-img').append(comp);
            e.preventDefault();
            return false;
        });*/

        /*$(document).on('change','.userfile',function(){
               fore = fore +1;
               console.log(11);
            comp = `<div class="img-upload-group add bitrix" var-attr="lab_`+fore+`">
                        <div class="reload-form-upload">
                            <label>
                                <input type="file" name="userfile[]" class="userfile">
                                <button type="button" class="mini-upload upload-button" data-id="" data-target=""></button>
                            </label>
                        </div>
                    </div>`;
            $('.img-full-right-block .inner-img').append(comp);
        })*/

        {/literal}
    </script>

    <script type="text/javascript">
    $(document).ready(function (){
      var table = $('#example').DataTable({
          dom: 'lrtip',
          bPaginate: true,
          bLengthChange: false,
          pageLength: 100,
          bFilter: true,
          bInfo: false,
          ordering: false,
          bAutoWidth: false,
          columnDefs: [ {
            targets  : 'no-sort',
            orderable:  false,
            className: 'mdl-data-table__cell--non-numeric'
          }],
          fnDrawCallback: function( oSettings ) {
            $("td.content > span").each(function() {
                if (checkOverflowDubli($(this).parent()) && $(this).parent().siblings("td:first-child").find('.fa-plus').length==0) {
                    $(this).parent().siblings("td:first-child").append('<i class="fa fa-plus open_table"></i>');
                }
            });
            $("td.three > span").each(function() {
                if (checkOverflowDubli($(this).parent()) && $(this).parent().siblings("td:first-child").find('.fa-plus').length==0) {
                    $(this).parent().siblings("td:first-child").append('<i class="fa fa-plus open_table"></i>');
                }
            });
          },
          initComplete: function () {
            // Product Type
            this.api().columns([1]).every( function () {
              var element = [];
              var column = this;
              var select = $(".product_type");
              column.data().unique().sort().each( function ( d, j ) {
                var mar = $(d).text();
                element.push($.trim(mar));
              });
              element = $.uniqueSort(element);
              $.each( element, function ( index, value ) {
                 select.append( '<option value="'+value+'">'+value+'</option>' )
              });
            });

            // Content
            this.api().columns([3]).every( function () {
              var element = [];
              var column = this;
              var select = $(".select_content");
              column.data().unique().sort().each( function ( d, j ) {
                var mar = $(d).find('b');
                $.each(mar, function(res,req){
                  var pass = $.trim($(req).text());
                  element.push($.trim(pass));
                });
              });
              element = $.uniqueSort(element);
              $.each( element, function ( index, value ) {
                 select.append( '<option value="'+value+'">'+value+'</option>' )
              });
            });

            this.api().columns([4]).every( function () {
              var element = [];
              var column = this;
              var select = $(".select_dossage");
              column.data().unique().sort().each( function ( d, j ) {
                var mar = $(d).find('b');
                $.each(mar, function(res,req){
                  var pass = $.trim($(req).text());
                  element.push($.trim(pass));
                });
              });
              element = $.uniqueSort(element);
              $.each( element, function ( index, value ) {
                 select.append( '<option value="'+value+'">'+value+'</option>' )
              });
            });
            this.api().columns([5]).every( function () {
              var element = [];
              var column = this;
              var select = $(".select_country");
              column.data().unique().sort().each( function ( d, j ) {
                var mar = $(d).find('p');
                $.each(mar, function(res,req){
                  var pass = $.trim($(req).text());
                  element.push($.trim(pass));
                });
              });
              element = $.uniqueSort(element);
              $.each( element, function ( index, value ) {
                 select.append( '<option value="'+value+'">'+value+'</option>' )
              });
            });
            this.api().columns([6]).every( function () {
              var element = [];
              var column = this;
              var select = $(".select_continent");
              column.data().unique().sort().each( function ( d, j ) {
                var mar = $(d).find('p');
                $.each(mar, function(res,req){
                  var pass = $.trim($(req).text());
                  element.push($.trim(pass));
                });
              });
              element = $.uniqueSort(element);
              $.each( element, function ( index, value ) {
                 select.append( '<option value="'+value+'">'+value+'</option>' )
              });
            });
            this.api().columns([9]).every( function () {
              var element = [];
              var column = this;
              var select = $(".trade_term");
              column.data().unique().sort().each( function ( d, j ) {
                var mar = $(d).text();
                element.push($.trim(mar));
              });
              element = $.uniqueSort(element);
              $.each( element, function ( index, value ) {
                 select.append( '<option value="'+value+'">'+value+'</option>' )
              });
            });
            $(".selectpicker").selectpicker();
         }
      });

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
      $('.select_continent').on('change', function(){
        var search = [];
        $.each($('.select_continent option:selected'), function(){
              search.push($(this).val());
        });
        search = search.join('|');
        regExSearch = '^\\s' + search +'\\s*$';
        table.column(5).search(search, true, false).draw();
      });
      $('.tender_name').on('change', function(){
        var  search = $(this).val();
        table.column(2).search(search, true, false).draw();
      });
      $('.startdate').on('change', function(){
        var  search = $(this).val();
        console.log(search);
        table.column(7).search(search, true, false).draw();
      });
      $('.enddate').on('change', function(){
        var  search = $(this).val();
        table.column(8).search(search, true, false).draw();
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

$(document).scroll(function() {

    var y = $(this).scrollTop();
    var w = $(window).width();
   
    if (w >= 768 && !$('.add-product').hasClass('in')) {
        if (y > top_offset1) {
            $(".header .bottom-menu:first-child").addClass("is-fixed");
        } else {
            $(".header .bottom-menu:first-child").removeClass("is-fixed");
        }

         if (y > top_offset2) {
            $(".header .bottom-menu.advanced-menu").addClass("is-fixed");
        } else {
            $(".header .bottom-menu.advanced-menu").removeClass("is-fixed");
        }
       
         if ((y > top_offset33 && !$(".header .bottom-menu.advanced-menu").hasClass('is-shown')) || (y > top_offset3 && $(".header .bottom-menu.advanced-menu").hasClass('is-shown'))) {
            $('.searchTable #example thead').addClass("is-fixed");
            $('.searchTable #example tbody').css('border-top','35px solid #ddd');
           if($(".header .bottom-menu.advanced-menu").css('display') != 'none') {
             $('.searchTable #example thead').css('top','70px');
              $(".header .bottom-menu.advanced-menu").css('top','35px');
            }
        } else {
            $('.searchTable #example thead').removeClass("is-fixed");
            $('.searchTable #example tbody').css('border-top','none');
            $('.searchTable #example thead').css('top','35px');
              $(".header .bottom-menu.advanced-menu").css('top','35px');
        }


    }
});
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


  {/literal}
</script>

{/block}
