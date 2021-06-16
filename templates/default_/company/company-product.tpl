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
                <div class="with_buttons full_width">
                    <h2>Products</h2>
                    {if $user.id && $user.id == $UserData->id}
                        <a href="{base_url('/product')}" class="add-new-interest n_green_col">Add Product</a>
                    {/if}
                </div>
                <div class="full_width">
                    <div class="row">
                        {* <form class="searchTable" action="{base_url('home/search_table')}" method="post"> *}
                        <div class="scroll_table_n full_width lst_tbl adj_colapse">
                            {* <table class="table table-striped no-padding display table-search-not"  id="example" > *}
                            <table id="example" >
                                    {* <thead> *}
                                    <tbody>
                                    <tr>
                                        {* <th class="one"></th> *}
                                        <th class="two">
                                            {* <select class="form-control selectpicker show-menu-arrow product_type" multiple data-live-search="true" data-selected-text-format="count > 0" data-actions-box="true" title="Product Type"></select> *}
                                            Product Type
                                        </th>
                                        <th class="three">
                                            {* <input type="text" name="brand_name" class="form-control brand_name" placeholder="Brand Name"> *}
                                            Brand Name
                                        </th>
                                        <th class="four">
                                            {* <select class="form-control selectpicker show-menu-arrow select_content" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Content"></select> *}
                                            Content
                                        </th>
                                        <th class="five">
                                            {* <select class="form-control selectpicker show-menu-arrow select_dossage" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Dosage form"></select> *}
                                            Dosage Form
                                        </th>
                                        {* <th class="six">
                                            <select class="form-control selectpicker show-menu-arrow select_country" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Country"></select>
                                        </th> *}
                                        <th class="seven">
                                            {* <select class="form-control selectpicker show-menu-arrow select_medical" multiple data-live-search="true" multiple data-actions-box="true" data-selected-text-format="count > 0" title="Medical Classification"></select> *}
                                            Medical Classification
                                        </th>
                                        {* <th class="eight">
                                            <select class="form-control selectpicker show-menu-arrow select_company" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Company"></select>
                                        </th> *}
                                        <th class="nine" style="min-width:70px!important"><a href="#" style="margin-left:8px"></a></th>
                                        {* <th class="ten" style="min-width:108px!important"><a href="#" style="margin-left:8px">Operations</a></th> *}
                                    </tr>
                                    {* </thead>
                                    <tbody> *}
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
                                                            {* <td class="closed_tb one"></td> *}
                                                            <td class="closed_tb two">
                                                                <p style="display:inline-block;">{get_product_type_name($product->pr_type)}</p>
                                                            </td>
                                                            <td class="closed_tb three">
                                                                <p>{$product->title}</p>
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
                                                            {* <td class="closed_tb six">
                                                                <center>
                                                                    <a href="#" title="{get_country_name($product->country)}">
                                                                        <img src="{base_url('templates/default/assets/img/country/')}{get_country_code($product->country)}.png" alt="{get_country_name($product->country)}" class="table-img">
                                                                        <p style="font-size:10px;color:#555;">{get_country_name($product->country)}</p>
                                                                    </a>
                                                                </center>
                                                            </td> *}
                                                            <td class="closed_tb seven">
                                        <span>
                                          {if !empty($product->medical_cl)} {foreach get_selected_medical($product->medical_cl) as $key=>$value}
                                              <b>{$value->name}</b>
                                          {/foreach} {else} {/if}
                                        </span>
                                                            </td>
                                                            {* <td class="closed_tb eight">
                                        <span>
                                        {if isset($company->company_name)}{$company->company_name}{/if}
                                        </span>
                                                            </td> *}
                                                            <td class="closed_tb nine">
                                                                <center>
                                                                    <a type="button" class="btn btn-info btn-circle btn-lg" data-target="{$product->id}"  href="{site_url_multi('product/view/')}{$product->id}{if $product->alias}-{$product->alias}{/if}"><i class="fa fa-info"></i></a>
                                                                </center>
                                                            </td>
                                                            {* <td class="closed_tb ten">
                                                                <div class="btn-group" style="width:100px;margin-left:8px;">
                                                                    {if !empty($company->email)}<a href="mailto:{$company->email}" class="btn btn-success btn-bix"> <i class="fa fa-envelope-o"></i> </a>{/if}
                                                                    {if !empty($company->website)}<a href="{$company->website}" target="_blank" class="btn btn-info btn-bix"> <i class="fa fa-globe"></i></a>{/if}
                                                                    {if !empty($company->slug)}<a href="{base_url("company/")}{$company->slug}" class="btn btn-danger btn-bix" ><i class="fa fa-user"></i></a>{/if}
                                                                </div>
                                                            </td> *}
                                                        </tr>
                                                    {/if}
                                                {/if}
                                            {/if}
                                        {/foreach}
                                    {/if}
                                    </tbody>
                                </table>
                        </div>
                        {* </form> *}
                        {* <table>
                            <tbody>
                            <tr>
                                <th valign="bottom">Product type</th>
                                <th valign="middle">Brand name</th>
                                <th valign="middle">Content</th>
                                <th valign="middle">Dosage form</th>
                                <th valign="middle">Medical Classification</th>
                            </tr>
                            </tbody>
                        </table> *}
                    </div>
                    {*<div class="n_pagination full_width">
                        <a href="#" class="prev"><img src="{base_url('templates/default/assets/images/icons/page_prev.png')}"></a>
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#">4</a>
                        <a href="#" class="next"><img src="{base_url('templates/default/assets/images/icons/page_next.png')}"></a>
                    </div>*}
                </div>

            </div><!-- /.right_section -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->

</div><!-- /.n_content_area -->

{*<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<link rel="stylesheet" href="{base_url('templates/default/assets/css/custom.css')}" media="all">
<div class="clearfix"></div>
<div class="wrap margin-top-100 col-md-12">
    <div class="container">
        <div class="row">
            <div class="clearfix"></div>
            <div class="col-md-12" id="profile">
                <div class="col-md-12 no-padding">
                    <div class="col-md-12 profile-right no-padding">
                        <div class="right-content">

                            <div class="container main-secction">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12 image-section">
                                        {if $UserData->company_banner}
                                            <img src="{$company_banner}" />
                                        {else}
                                            <img src="https://picsum.photos/1170/250"/>
                                        {/if}
                                    </div>
                                    <div class="row user-left-part">
                                        {include file='../company/sidebar.tpl'}
                                        <div class="col-md-9 col-sm-9 col-xs-12 pull-right profile-right-section" style="height:520px; overflow:scroll;">
                                            <div class="row profile-right-section-row"70%
                                            >
                                                <section class="our-webcoderskull padding-lg">
                                                    <div class="scrollbar" id="style-1">
                                                        <div class="force-overflow">
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
                                                                                            <p>{$product->title}</p>
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
                                                                                                <a type="button" class="btn btn-info btn-circle btn-lg" data-target="{$product->id}"  href="{site_url_multi('product/view/')}{$product->id}{if $product->alias}-{$product->alias}{/if}"><i class="fa fa-info"></i></a>
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
                                                    </div>
                                                </section>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                            </div>

                            <!--main info end-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>*}
    <script>
        {if !empty($UserData->lat) || !empty($UserData->lng)}
        var json_lat = {$UserData->lat};
        var json_lng = {$UserData->lng};
        var json_title = '{$UserData->adress}';
        {literal}
        {/literal}
        {else}
        var json_title = '{$UserData->company_name}';
        {literal}
        {/literal}
        {/if}
    </script>
    {/block}
