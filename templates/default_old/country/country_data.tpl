{extends file=$layout}
{block name=content}
<div class="wrap margin-top-100 col-md-12">
    <div class="container-fuild">
        <div class="row">
            <div class="clearfix"></div>
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
                                    <input type="text" name="brand_name" class="form-control brand_name" placeholder="Brand Name">
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
                                  <th class="seven">
                                    <select class="form-control selectpicker show-menu-arrow select_medical" multiple data-live-search="true" multiple data-actions-box="true" data-selected-text-format="count > 0" title="Medical Classification"></select>
                                  </th>
                                  <th class="eight">
                                    <select class="form-control selectpicker show-menu-arrow select_company" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Company"></select>
                                  </th>
                                  <th class="nine" style="min-width:70px!important"><a href="#" style="margin-left:8px">Actions </a></th>
                                  <th class="ten" style="min-width:108px!important"><a href="#" style="margin-left:8px">Operations</a></th>
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
                                      <td class="closed_tb two">
                                        <p>{get_product_type_name($product->pr_type)}</p>
                                      </td>
                                      <td class="closed_tb three">
                                        <span><p>{$product->title}</p></span>
                                      </td>
                                      <td class="closed_tb content four">
                                          <span>
                                          {if count($atc_code) > 0}
                                              {foreach $atc_code as $atc}
                                                  <b>{get_atc_code_no($atc->id)}</b>
                                                  <span>({$atc->mdoza} {get_unit_name($atc->vdoza)})</span>
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
                                          {$var = json_decode($product->packing_type)}
                                          {if count($var) > 0}
                                              {$f = json_decode(json_encode($var[0]))}
                                              <b>{get_packing_type_name($f->id)}</b>
                                              <span>({if $f->mdoza2 neq 0}{$f->mdoza2}{/if} {get_unit_name($f->vdoza2)} {if $f->mdoza neq 0}{$f->mdoza}{/if} {get_drug_type_code($f->vdoza)})</span>
                                          {/if}
                                        </span>
                                      </td>
                                      <td class="closed_tb six">
                                          <center>
                                              <a href="#" title="{get_country_name($product->country)}">
                                                  <img src="{base_url('templates/default/assets/img/country/')}{get_country_code($product->country)}.png" alt="{get_country_name($product->country)}" class="table-img">
                                                  <p style="font-size:10px;color:#555;">{get_country_name($product->country)}</p>
                                              </a>
                                          </center>
                                      </td>
                                      <td class="closed_tb seven">
                                        <span>
                                          {if !empty($product->medical_cl)} {foreach get_selected_medical($product->medical_cl) as $key=>$value}
                                          <b>{$value->name}</b>
                                          {/foreach} {else} {/if}
                                        </span>
                                      </td>
                                      <td class="closed_tb eight">
                                        <span>
                                        {if isset($company->company_name)}{$company->company_name}{/if}
                                        </span>
                                      </td>
                                      <td class="closed_tb nine">
                                          <center>
                                              <a type="button" class="btn btn-info btn-circle btn-lg" data-target="{$product->id}"  target="_blank" href="{site_url_multi('product/view/')}{$product->id}-{$product->alias}"><i class="fa fa-info"></i></a>
                                         </center>
                                      </td>
                                      <td class="closed_tb ten">
                                          <div class="btn-group" style="width:100px;margin-left:8px;">
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
        </div>
    </div>
</div>
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
          var select = $(".select_medical");
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
        this.api().columns([7]).every( function () {
          var element = [];
          var column = this;
          var select = $(".select_company");
          column.data().unique().sort().each( function ( d, j ) {
            var f = $.trim(d);
            var mar = $(f);
            $.each(mar, function(res,req){
              var pass = $(req).text();
              element.push($.trim(pass));
            });
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
{/block}
