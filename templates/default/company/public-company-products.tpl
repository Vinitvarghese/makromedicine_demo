{extends file=$layout}
{block name=content}
    <link rel="stylesheet" href="{base_url('templates/default/assets/css/prefix-style.css')}" media="all">
    {include file='../_partial/approve_waiting_line.tpl'}
    <div class="n_content_area products_container full_width">
    <a href="#" id="openMenu" class="public-menu-float">Menu</a>
        <div class="container-fluid">
            <div class="row">
                {include file='../company/public-company-sidebar.tpl'}
                <div class="n_right_section products start_with_text">
                    <div class="tabl_n full_width pr-s-n">
                        <h2>PRODUCTS</h2>
                        <form action="{site_url_multi('companies')}/{$company->slug}/products/" method="get" class="input_n_search">
                            <input type="text" name="query" value="{set_value('query')}" placeholder="Product Search…"/>
                            <button type="submit"><img
                                        src="{base_url('templates/default/assets/images/icons/search.png')}"/></button>
                        </form><!-- /.input_n_search -->
                    </div><!-- /.with_buttons -->

                    <div class="full_width" id="show_content_n">
                        <div class="items_here">
                            <label>Product type</label>
                            <select>
                                <option>Product type</option>
                            </select>
                        </div><!-- /.items_here -->
                        <div class="items_here">
                            <label>Brand name</label>
                            <select>
                                <option>Brand name</option>
                            </select>
                        </div><!-- /.items_here -->
                        <div class="items_here">
                            <label>Content</label>
                            <select>
                                <option>Content</option>
                            </select>
                        </div><!-- /.items_here -->
                        <div class="items_here">
                            <label>Dosage form</label>
                            <select>
                                <option>Dosage form</option>
                            </select>
                        </div><!-- /.items_here -->
                        <div class="items_here">
                            <label>Medical Classification</label>
                            <select>
                                <option>Medical Classification</option>
                            </select>
                        </div><!-- /.items_here -->
                    </div><!-- /.show_content -->

                    <div class="scroll_table_n full_width">
                    {if $products}
                        <table>
                            <thead>
                            <tr>
                                <th valign="bottom">Product type</th>
                                <th valign="middle">Brand name</th>
                                <th valign="middle">Content</th>
                                <th valign="middle">Dosage form</th>
                                <th valign="middle">Medical Classification</th>
                                <th valign="middle">Operation</th>
                            </tr>
                            </thead>
                            <tbody>
                            
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
                                <td valign="bottom">{get_product_type_name($product->pr_type)}</td>
                                <td valign="middle">{$product->title}</td>
                                <td valign="middle">
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
                                <td valign="middle">
                                    {$var = json_decode($product->packing_type)}
                                    {if count($var) > 0}
                                        {$f = json_decode(json_encode($var[0]))}
                                        <b>{get_packing_type_name($f->id)}</b>
                                        <span>({if $f->mdoza2 neq 0}{$f->mdoza2}{/if} {get_unit_name($f->vdoza2)} {if $f->mdoza neq 0}{$f->mdoza}{/if} {get_drug_type_code($f->vdoza)})</span>
                                    {/if}
                                </td>
                                <td valign="middle">
                                    {if !empty($product->medical_cl)} {foreach get_selected_medical($product->medical_cl) as $key=>$value}
                                        <b>{$value->name}</b>
                                    {/foreach} {else} {/if}



                                </td>
                                <td class="operation_column" >
                                    <div class="flex align_center justify_end operation_btns">
                                        <a href="{site_url_multi('companies/')}{$UserData->slug}/product/{$product->id}"
                                            >
                                            <svg width="23" height="23" viewBox="0 0 23 23" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M18.6875 23H4.3125C1.93059 23 0 21.0694 0 18.6875V4.3125C0 1.93059 1.93059 0 4.3125 0H18.6875C21.0694 0 23 1.93059 23 4.3125V18.6875C23 21.0694 21.0694 23 18.6875 23Z"
                                                    fill="#2187C5" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M12.903 18.7841H9.69995V8.47412H12.903V18.7841Z" fill="white" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M11.28 7.21091C10.267 7.21091 9.59302 6.49291 9.61502 5.60691C9.59402 4.67991 10.267 3.98291 11.301 3.98291C12.334 3.98291 12.99 4.67991 13.011 5.60691C13.01 6.49291 12.332 7.21091 11.28 7.21091Z"
                                                    fill="white" />
                                            </svg>
                                        </a>

                                        {if isset($logged_user_id) && $logged_user_id==$product->user_id}
                                            {if $permission_list[4]->edit == 1}
                                                <a
                                                    href="{site_url_multi('product/')}{$UserData->slug}/update/{$product->id}">
                                                    <svg width="23" height="23" viewBox="0 0 23 23" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M18.6875 23H4.3125C1.93059 23 0 21.0694 0 18.6875V4.3125C0 1.93059 1.93059 0 4.3125 0H18.6875C21.0694 0 23 1.93059 23 4.3125V18.6875C23 21.0694 21.0694 23 18.6875 23Z"
                                                            fill="#2187C5" />
                                                        <path
                                                            d="M6.71179 14.4448L14.7716 6.38477L17.371 8.98412L9.31115 17.0442L6.71179 14.4448Z"
                                                            fill="white" />
                                                        <path
                                                            d="M5.39673 18.3589L8.26928 17.5632L6.19238 15.4863L5.39673 18.3589Z"
                                                            fill="white" />
                                                        <path
                                                            d="M18.0897 5.01823C17.5504 4.48025 16.6773 4.48025 16.138 5.01823L15.5526 5.60366L18.152 8.20302L18.7374 7.61759C19.2756 7.07832 19.2756 6.20525 18.7374 5.66597L18.0897 5.01823Z"
                                                            fill="white" />
                                                    </svg>
                                                </a>
                                            {/if}

                                            {if $permission_list[4]->delete == 1}
                                                <a href="{site_url_multi('product/')}{$UserData->slug}/delete/{$product->id}"
                                                    class="product_delete_btn">
                                                    <svg width="23" height="23" viewBox="0 0 23 23" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M18.6875 23H4.3125C1.93059 23 0 21.0694 0 18.6875V4.3125C0 1.93059 1.93059 0 4.3125 0H18.6875C21.0694 0 23 1.93059 23 4.3125V18.6875C23 21.0694 21.0694 23 18.6875 23Z"
                                                            fill="#CD4444" />
                                                        <path
                                                            d="M10.8061 6.13871H12.9435V6.49837H13.7155V6.08836C13.7155 5.69045 13.392 5.3667 12.9943 5.3667H10.7553C10.3576 5.3667 10.0341 5.69045 10.0341 6.08836V6.49837H10.8061V6.13871Z"
                                                            fill="white" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M8.25138 9.55713H15.4981C15.6966 9.55713 15.8529 9.72652 15.8368 9.9245L15.231 17.4158C15.1972 17.8341 14.8484 18.1562 14.4293 18.1562H9.32002C8.90094 18.1562 8.55211 17.8341 8.51835 17.4159L7.9125 9.9245C7.8965 9.72652 8.05282 9.55713 8.25138 9.55713ZM9.98187 17.3579C9.98987 17.3579 9.99797 17.3576 10.0061 17.3572C10.2188 17.344 10.3807 17.1609 10.3675 16.9481L9.98792 10.7981C9.97484 10.5852 9.79091 10.4237 9.57889 10.4366C9.36617 10.4496 9.2043 10.6328 9.21737 10.8456L9.59703 16.9956C9.60962 17.2003 9.7795 17.3579 9.98187 17.3579ZM12.265 16.9719C12.265 17.185 12.0922 17.3578 11.879 17.3578C11.6658 17.3578 11.493 17.185 11.493 16.9719V10.8218C11.493 10.6086 11.6658 10.4358 11.879 10.4358C12.0921 10.4358 12.265 10.6086 12.265 10.8218V16.9719ZM14.1696 16.9946L14.5321 10.8445C14.5446 10.6317 14.3822 10.449 14.1694 10.4365C13.956 10.4239 13.7739 10.5862 13.7614 10.7991L13.399 16.9492C13.3864 17.162 13.5488 17.3447 13.7616 17.3572C13.7693 17.3576 13.777 17.3578 13.7846 17.3578C13.9874 17.3578 14.1576 17.1997 14.1696 16.9946Z"
                                                            fill="white" />
                                                        <path
                                                            d="M16.8329 8.36588L16.5794 7.60597C16.5126 7.40565 16.325 7.27051 16.1138 7.27051H7.63563C7.42448 7.27051 7.23684 7.40565 7.1701 7.60597L6.9166 8.36588C6.86771 8.51244 6.93133 8.66192 7.05008 8.73647C7.09848 8.76682 7.15575 8.78506 7.21869 8.78506H16.5308C16.5938 8.78506 16.6511 8.76682 16.6994 8.73637C16.8182 8.66182 16.8818 8.51234 16.8329 8.36588Z"
                                                            fill="white" />
                                                    </svg>
                                                </a>
                                            {/if}
                                        {/if}
                                    </div>
                                </td>
                            </tr>
                            {/if}
                            {/if}
                            {/if}
                            {/foreach}
                            
                            </tbody>
                        </table>

                        {$pagination}

                        {else}
                            <p class="text-center flex result_not_found">Result not found</p>
                        {/if}
                    </div><!-- /.scroll_table_n -->

                    {*<div class="n_pagination full_width">
                        <a href="#" class="prev"><img src="images/icons/page_prev.png" /></a>
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#">4</a>
                        <a href="#" class="next"><img src="images/icons/page_next.png" /></a>
                    </div><!-- /.pagination -->*}


                </div><!-- /.n_right_section -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->

    </div>
    <!-- /.n_content_area -->
    <script type="text/javascript">
        $(document).ready(function () {
            var table = $('#example').DataTable({
                dom: 'lrtip',
                bPaginate: true,
                bLengthChange: false,
                pageLength: 100,
                bFilter: true,
                bInfo: false,
                ordering: false,
                bAutoWidth: false,
                columnDefs: [{
                    targets: 'no-sort',
                    orderable: false,
                    className: 'mdl-data-table__cell--non-numeric'
                }],
                fnDrawCallback: function (oSettings) {
                    $("td.content > span").each(function () {
                        if (checkOverflowDubli($(this).parent()) && $(this).parent().siblings("td:first-child").find('.fa-plus').length == 0) {
                            $(this).parent().siblings("td:first-child").append('<i class="fa fa-plus open_table"></i>');
                        }
                    });
                    $("td.three > span").each(function () {
                        if (checkOverflowDubli($(this).parent()) && $(this).parent().siblings("td:first-child").find('.fa-plus').length == 0) {
                            $(this).parent().siblings("td:first-child").append('<i class="fa fa-plus open_table"></i>');
                        }
                    });
                },
                initComplete: function () {
                    // Product Type
                    this.api().columns([1]).every(function () {
                        var element = [];
                        var column = this;
                        var select = $(".product_type");
                        column.data().unique().sort().each(function (d, j) {
                            var mar = $(d).text();
                            element.push($.trim(mar));
                        });
                        element = $.uniqueSort(element);
                        $.each(element, function (index, value) {
                            select.append('<option value="' + value + '">' + value + '</option>')
                        });
                    });

                    // Content
                    this.api().columns([3]).every(function () {
                        var element = [];
                        var column = this;
                        var select = $(".select_content");
                        column.data().unique().sort().each(function (d, j) {
                            var mar = $(d).find('b');
                            $.each(mar, function (res, req) {
                                var pass = $.trim($(req).text());
                                element.push($.trim(pass));
                            });
                        });
                        element = $.uniqueSort(element);
                        $.each(element, function (index, value) {
                            select.append('<option value="' + value + '">' + value + '</option>')
                        });
                    });

                    this.api().columns([4]).every(function () {
                        var element = [];
                        var column = this;
                        var select = $(".select_dossage");
                        column.data().unique().sort().each(function (d, j) {
                            var mar = $(d).find('b');
                            $.each(mar, function (res, req) {
                                var pass = $.trim($(req).text());
                                element.push($.trim(pass));
                            });
                        });
                        element = $.uniqueSort(element);
                        $.each(element, function (index, value) {
                            select.append('<option value="' + value + '">' + value + '</option>')
                        });
                    });

                    this.api().columns([5]).every(function () {
                        var element = [];
                        var column = this;
                        var select = $(".select_country");
                        column.data().unique().sort().each(function (d, j) {
                            var mar = $(d).find('p');
                            $.each(mar, function (res, req) {
                                var pass = $.trim($(req).text());
                                element.push($.trim(pass));
                            });
                        });
                        element = $.uniqueSort(element);
                        $.each(element, function (index, value) {
                            select.append('<option value="' + value + '">' + value + '</option>')
                        });
                    });

                    this.api().columns([6]).every(function () {
                        var element = [];
                        var column = this;
                        var select = $(".select_medical");
                        column.data().unique().sort().each(function (d, j) {
                            var mar = $(d).find('b');
                            $.each(mar, function (res, req) {
                                var pass = $.trim($(req).text());
                                element.push($.trim(pass));
                            });
                        });
                        element = $.uniqueSort(element);
                        $.each(element, function (index, value) {
                            select.append('<option value="' + value + '">' + value + '</option>')
                        });
                    });
                    this.api().columns([7]).every(function () {
                        var element = [];
                        var column = this;
                        var select = $(".select_company");
                        column.data().unique().sort().each(function (d, j) {
                            var f = $.trim(d);
                            var mar = $(f);
                            $.each(mar, function (res, req) {
                                var pass = $(req).text();
                                element.push($.trim(pass));
                            });
                        });
                        element = $.uniqueSort(element);
                        $.each(element, function (index, value) {
                            select.append('<option value="' + value + '">' + value + '</option>')
                        });
                    });
                    $(".selectpicker").selectpicker();
                }
            });

            $('.product_type').on('change', function () {
                var search = [];
                $.each($('.product_type option:selected'), function () {
                    search.push($(this).val());
                });
                search = search.join('|');
                regExSearch = '^\\s' + search + '\\s*$';
                table.column(1).search(search, true, false).draw();
            });

            $('.select_content').on('change', function () {
                var search = [];
                $.each($('.select_content option:selected'), function () {
                    search.push($(this).val());
                });
                search = search.join('|');
                regExSearch = '^\\s' + search + '\\s*$';
                table.column(3).search(search, true, false).draw();
            });
            $('.select_dossage').on('change', function () {
                var search = [];
                $.each($('.select_dossage option:selected'), function () {
                    search.push($(this).val());
                });
                search = search.join('|');
                regExSearch = '^\\s' + search + '\\s*$';
                table.column(4).search(search, true, false).draw();
            });
            $('.select_country').on('change', function () {
                var search = [];
                $.each($('.select_country option:selected'), function () {
                    search.push($(this).val());
                });
                search = search.join('|');
                regExSearch = '^\\s' + search + '\\s*$';
                table.column(5).search(search, true, false).draw();
            });
            $('.select_medical').on('change', function () {
                var search = [];
                $.each($('.select_medical option:selected'), function () {
                    search.push($(this).val());
                });
                search = search.join('|');
                regExSearch = '^\\s' + search + '\\s*$';
                table.column(6).search(search, true, false).draw();
            });
            $('.select_company').on('change', function () {
                var search = [];
                $.each($('.select_company option:selected'), function () {
                    search.push($(this).val());
                });
                search = search.join('|');
                regExSearch = '^\\s' + search + '\\s*$';
                table.column(7).search(search, true, false).draw();
            });
            $('.brand_name').on('change', function () {
                var search = $(this).val();
                table.column(2).search(search, true, false).draw();
            });
        });
    </script>
    {*<link rel="stylesheet" href="{base_url('templates/default/assets/css/custom.css')}" media="all">
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
                                        {if $company_banner}
                                            <img src="{$company_banner}" />
                                        {else}
                                            <img src="https://picsum.photos/1170/250"/>
                                        {/if}
                                    </div>
                                    <div class="row user-left-part">
                                        <form class="userSettings" action="{base_url('profile/')}interests" enctype="multipart/form-data" method="post">
                                            {include file='../company/public-company-sidebar.tpl'}
                                        <div class="col-md-9 col-sm-9 col-xs-12 pull-right profile-right-section">
                                            <div class="right-content">
                                                <div class="col-md-12">
                                                    <h1 class="main-info-title">Products</h1>
                                                </div>
                                                <div class="col-md-12 right-content-inner" style="overflow: scroll">
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
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
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
    </script>*}
{/block}
