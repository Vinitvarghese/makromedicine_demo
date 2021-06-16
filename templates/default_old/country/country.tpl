{extends file=$layout}
{block name=content}
<div class="wrap margin-top-100 col-md-12">
    <div class="container-fuild">
        <div class="row">
            <div class="clearfix"></div>
            <div class="col-md-12">
                <form class="searchTable" action="{base_url('home/search_table')}" method="post">
                  <div class="col-md-12 no-padding tables-data">
                      <table class="table table-striped no-padding table-search-not">
                          <thead>
                              <tr>
                                  <th class="one"></th>
                                  <th class="two">
                                    <select name="pr_type[]" class="form-control selectpicker show-menu-arrow product_type" multiple data-live-search="true" data-selected-text-format="count > 0" data-actions-box="true" title="Product Type">
                                     {if $product_types}{foreach from=$product_types item=product_type}
                                     <option value="{$product_type->id}">{$product_type->name}</option>
                                     {/foreach}{/if}
                                    </select>
                                  </th>
                                  <th class="three">
                                    <input type="text" name="brand_name" class="form-control brand_name" placeholder="Brand Name">
                                  </th>
                                  <th class="four">
                                    <select name="content" class="form-control selectpicker show-menu-arrow select_content" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Content">
                                    <option value="">Content</option>
                                    </select>
                                  </th>
                                  <th class="five">
                                    <select name="dossage[]" class="form-control selectpicker show-menu-arrow select_dossage" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Dosage form">
                                    {if $dossageforms}{foreach from=$dossageforms item=dossageform}
                                    <option value="{$dossageform->id}">{$dossageform->name}</option>
                                    {/foreach}{/if}
                                    </select>
                                  </th>
                                  <th class="six">
                                    <select name="country_id[]" class="form-control selectpicker show-menu-arrow select_country" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Country">
                                    {if $countrys}{foreach from=$countrys item=country}
                                    {if $country->id eq $country_id}
                                    <option value="{$country->id}" {if $country->id eq $country_id} selected="selected" {/if}>{$country->name}</option>
                                    {/if}
                                    {/foreach}{/if}
                                    </select>
                                  </th>
                                  <th class="seven">
                                    <select name="medical[]" class="form-control selectpicker show-menu-arrow select_medical" multiple data-live-search="true" multiple data-actions-box="true" data-selected-text-format="count > 0" title="Medical Classification">
                                    {if $medicals}{foreach from=$medicals item=medical}
                                    <option value="{$medical->id}">{$medical->name}</option>
                                    {/foreach}{/if}
                                    </select>
                                  </th>
                                  <th class="eight">
                                    <select name="company[]" class="form-control selectpicker show-menu-arrow select_company" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Company">
                                    {if $companies}{foreach from=$companies item=company}
                                    {if $company->country_id eq $country_id}
                                    <option value="{$company->id}">{$company->company_name}</option>
                                    {/if}
                                    {/foreach}{/if}
                                    </select>
                                  </th>
                                  <th class="nine" style="min-width:54px!important;"><a href="#" style="margin-left: 8px;">Actions </a></th>
                                  <th class="ten" style="min-width:92px!important;"><a href="#" style="margin-left: 8px;">Operations</a></th>
                              </tr>
                          </thead>
                          <tbody>
                              {if $products}
                                  {foreach from=$products item=product}
                                  {$company = get_company_name($product->user_id)}
                                  {$atc_code = json_decode($product->atc_code)}
                                  {$herbal = json_decode($product->herbal)}
                                  {$animals = json_decode($product->animal)}
                                  {$casNumbers = json_decode($product->cas)}
                                  {if count($atc_code) > 0 || count($herbal) > 0 || count($animals) > 0 || count($casNumbers) > 0}
                                  {if isset($company->company_name)}
                                  {if !empty(trim($company->company_name))}
                                  <tr>
                                      <td class="closed_tb one"></td>
                                      <td class="closed_tb two">{get_product_type_name($product->pr_type)}</td>
                                      <td class="closed_tb three">{$product->title}</td>
                                      <td class="closed_tb content four">
                                          <span>
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
                                          </span>
                                      </td>
                                      <td class="closed_tb five">
                                        <span>
                                          {$var = json_decode($product->packing_type)}
                                          {if count($var) > 0}
                                              {$f = json_decode(json_encode($var[0]))}
                                              {get_packing_type_name($f->id)} {if $f->mdoza2 neq 0}{$f->mdoza2}{/if} {get_unit_name($f->vdoza2)} {if $f->mdoza neq 0}{$f->mdoza}{/if} {get_drug_type_code($f->vdoza)}
                                          {/if}
                                        </span>
                                      </td>
                                      <td class="closed_tb six">
                                          <center>
                                              <a href="#" data-toggle="tooltip" data-placement="top" title="{get_country_name($product->country)}">
                                                  <img src="{base_url('templates/default/assets/img/country/')}{get_country_code($product->country)}.png" alt="{get_country_name($product->country)}" class="table-img">
                                              </a>
                                          </center>
                                      </td>
                                      <td class="closed_tb seven">
                                        <span>
                                          {if !empty($product->medical_cl)} {foreach get_selected_medical($product->medical_cl) as $key=>$value} {$value->name}, {/foreach} {else} {/if}
                                        </span>
                                      </td>
                                      <td class="closed_tb eight">
                                        <span>
                                        {if isset($company->company_name)}{$company->company_name}{/if}
                                        </span>
                                      </td>
                                      <td class="closed_tb nine">
                                          <center>
                                              <button type="button" class="btn btn-info btn-more-info-product btn-circle btn-lg" data-id="{$product->id}"><i class="fa fa-info"></i></button>
                                          </center>
                                      </td>
                                      <td class="closed_tb ten">
                                          <div class="btn-group" style="width:100px;">
                                              {if !empty($company->email)}<a href="mailto:{$company->email}" class="btn btn-success btn-bix"> <i class="fa fa-envelope-o"></i> </a>{/if}
                                              {if !empty($company->website)}<a href="{$company->website}" target="_blank" class="btn btn-info btn-bix"> <i class="fa fa-globe"></i></a>{/if}
                                              {if !empty($company->slug)}<a href="{base_url("company/")}{$company->slug}" class="btn btn-danger btn-bix" ><i class="fa fa-user"></i></a>{/if}
                                          </div>
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
            <div class="col-md-12" style="margin-top:15px;margin-bottom:15px">
                <div class="container">
                  <center>{$pagination}</center>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  {literal}
  $('.searchTable').submit(function(e){
    e.preventDefault();
    $.ajax({
        type:'POST',
        url:site_url+'home/search_table/',
        data: $(this).serialize(),
        cache:false,
        success:function(data){
          console.log(data);
          if (data != false) {
            var obj = $.parseJSON(data);
            var component = ``;
            $.each(obj, function(index, value){
              component += `<tr>
                  <td class="closed_tb one"></td>
                  <td class="closed_tb two">`+value.pr_type+`</td>
                  <td class="closed_tb three">`+value.title+`</td>
                  <td class="closed_tb content four">
                      <span>`+value.content+`</span>
                  </td>
                  <td class="closed_tb five">
                    <span>`+value.packing+`</span>
                  </td>
                  <td class="closed_tb six">
                      <center>
                          <a href="#" data-toggle="tooltip" data-placement="top" title="`+value.country+`">
                              <img src="`+value.country_img+`" alt="`+value.country+`" class="table-img">
                          </a>
                      </center>
                  </td>
                  <td class="closed_tb seven">
                    <span>`+value.medical+`</span>
                  </td>
                  <td class="closed_tb eight">
                    <span>`+value.company_name+`</span>
                  </td>
                  <td class="closed_tb nine">
                      <center>
                          <button type="button" class="btn btn-info btn-more-info-product btn-circle btn-lg" data-id="`+value.id+`"><i class="fa fa-info"></i></button>
                      </center>
                  </td>
                  <td class="closed_tb ten">
                      <div class="btn-group" style="width:100px;">
                          <a href="mailto:`+value.email+`" class="btn btn-success btn-bix"> <i class="fa fa-envelope-o"></i> </a>
                          <a href="`+value.website+`" target="_blank" class="btn btn-info btn-bix"> <i class="fa fa-globe"></i></a>
                          <a href="`+value.slug+`" class="btn btn-danger btn-bix" ><i class="fa fa-user"></i></a>
                      </div>
                  </td>
              </tr> `;
            });
            $('.table-search-not tbody').html(component);
            //$.isLoading("hide");
          }else{
            $('.table-search-not tbody').empty();
            //$.isLoading("hide");
          }

        }
    });
    e.preventDefault();
    return false;
  });
  {/literal}
  $('.product_type').change(function(){
    $('.searchTable').submit();
  });
  $('.select_company').change(function(){
    $('.searchTable').submit();
  });
  $('.select_dossage').change(function(){
    $('.searchTable').submit();
  });
  $('.select_country').change(function(){
    $('.searchTable').submit();
  });
  $('.brand_name').change(function() {
    $('.searchTable').submit();
  });
  $('.select_medical').change(function() {
    $('.searchTable').submit();
  });
  $('.select_content').change(function() {
    $('.searchTable').submit();
  });
</script>
{/block}
