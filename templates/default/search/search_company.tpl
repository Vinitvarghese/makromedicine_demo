{extends file=$layout}
{block name=content}

    <style>
        .wrap {
            min-height: 1200px;
            background-color: #f1f1f1;
        }
        #example_filter{
            display: none;
        }
        .paging_simple_numbers{
            margin: 20px auto;
            float: right;
            width: 1326px;
            display: block;
            float: none!important;
        }
        .three p{
            text-overflow: ellipsis;
            overflow: hidden;
        }
        .tables-data .table > thead.is-fixed {
            border: none;
        }
        .tables-data .table > thead.is-fixed > tr > th{
            border-bottom: 1px solid rgb(184, 184, 184)!important;
            background: #e9e9e9!important;
        }
        .tables-data .table > thead.is-fixed > tr > th:nth-child(1){
            min-width: 39px;
            width: 39px;
            border-left: 1px solid rgb(184, 184, 184)!important;;
        }
        .tables-data .table > thead.is-fixed > tr > th:nth-child(2){
            min-width: 161px;
            width: 160px;
        }
        .tables-data .table > thead.is-fixed > tr > th:nth-child(3){
            min-width: 191px;
            width: 191px;
        }
        .tables-data .table > thead.is-fixed > tr > th:nth-child(4){
            min-width: 204px;
            width: 191px;
        }
        .tables-data .table > thead.is-fixed > tr > th:nth-child(5){
            min-width: 160px;
            width: 160px;
        }
        .tables-data .table > thead.is-fixed > tr > th:nth-child(6){
            min-width: 92px;
            width: 92px;
        }
        .tables-data .table > thead.is-fixed > tr > th:nth-child(7){
            min-width: 191px;
            width: 191px;
        }
        .tables-data .table > thead.is-fixed > tr > th:nth-child(8){
            min-width: 193px;
            width: 160px;
        }
        .tables-data .table > thead.is-fixed > tr > th:nth-child(9){
            min-width: 86px;
            width: 120px;
        }
        .tables-data .table > thead > tr > th .form-control{
            border: 0;
        }

        .dataTables_wrapper .dataTables_processing {
            position: absolute;
            top: 60px;
            left: 0;
            right: 0;
            width: 1325px;
            height: 40px;
            margin-left: auto;
            margin-right: auto;
            margin-top: -25px;
            padding-top: 0;
            text-align: center;
            font-size: 18px;
            height: 80px;
            z-index: 9;
            padding: 28px 0;

        }

        .closed_tb span{
            word-break: break-word;
        }

        #example th, #example td {
            vertical-align: middle !important;
        }

        #example th p, #example td p {
            padding-left: 15px !important;
        }

        #example td center p {
            padding-left: 0 !important;
         }

    </style>
    <div class="wrap margin-top-100 col-md-12">
        <div class="container-fuild">
            <div class="row">
                <div class="clearfix"></div>
                <div class="col-md-12 search-table-wrp-3">
                    <form class="searchTable" action="{base_url('home/search_table')}" method="post">
                        <div class="col-md-12 no-padding tables-data">
                            <table class="table responsive table-striped no-padding display table-search-not search_company_table"  id="example" >
                                <thead>
                                <tr>
                                    <th class="one"><p>No</p></th>
                                    <th class="">
                                        <p class="col_padding">Logo</p>
                                    </th>
                                    <th class="">
                                        <p>Company</p>
                                    </th>
                                    <th class="">
                                        <select name="group_id[]" class="selectpicker show-menu-arrow product_status_type" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Status">
                                            {if $groups}{foreach $groups as $key => $value}{if $value->id neq 6}
                                                <option value="{$value->id}" {if in_array($value->id, $search_status)} selected="selected" {/if}>{$value->name}</option>
                                            {/if}{/foreach}{/if}
                                        </select>
                                    </th>
                                    <th class=""><p class="col_padding">Products</p></th>

                                    <th class="">
                                        <select name="pr_type[]" class="form-control selectpicker show-menu-arrow product_type" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Product Type">
                                            {if $product_types}{foreach from=$product_types item=product_type}
                                                <option value="{$product_type->id}" {if in_array($product_type->id,$pr_type)} selected="selected" {/if}>{$product_type->name}</option>
                                            {/foreach}{/if}
                                        </select>
                                    </th>
                                    <th class="">
                                        <select name="standart[]" style="display: none"
                                                class="selectpicker show-menu-arrow product_standart" multiple
                                                data-live-search="true" data-actions-box="true"
                                                data-selected-text-format="count > 0" title="Standard">
                                            {if $standarts}{foreach $standarts as $key => $value}
                                                <option value="{$value->id}" {if in_array($value->id, $search_standart)} selected="selected" {/if}>{$value->name}</option>
                                            {/foreach}{/if}
                                        </select>
                                    </th>

                                    <th class="">
                                        <select name="country_id[]" class="form-control selectpicker show-menu-arrow select_country" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Country">
                                            {if $countrys}{foreach from=$countrys item=countryd}
                                                <option value="{$countryd->id}" {if $event_country} {if in_array($countryd->id,$event_country)} selected="selected" {/if} {/if}>{$countryd->name}</option>
                                             {/foreach}{/if}
                                        </select>
                                    </th>
                                    <th class="five"><p>Operations</p></th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        {if isset($smarty.post.country)}
        var countrypost = {$smarty.post.country};
        {literal}
        window.onload = function(e){
            setTimeout(function(){
                // $('select.select_country').selectpicker('val', [countrypost]);
                // $('.select_country').trigger('change');
                $('.main_event_continent').trigger('change');
                // console.log("exe");
            },3000);

        }
        {/literal}
        {/if}
    </script>

    <script>
        {literal}


        {/literal}
        var table;
        var cs_group_id = [];
        var cs_tender_continent = {$dt_event_continent};
        var cs_country = {$dt_event_country};
        var cs_user_groups_id = {$dt_search_status};
        var cs_pr_type = {$dt_pr_type};
        var cs_standart = {$dt_search_standart};
        var cs_company_ids = {$company_ids};

        /*$(window).load(function () {
            setTimeout(function(){
                $('.main_event_continent').trigger('change');
                console.log("exe");
            },1000);
        });*/

        $(document).ready(function() {
            if ($(".search-table-wrp-3").length) {
                table = $("#example").DataTable({
                    processing: true,
                    serverSide: true,
                    iDisplayLength: 20,
                    ajax: {
                        url: ci_custom_home_url+"search/get_formatted_results_company",
                        type: "POST",
                        dataType: "json",
                        data: function(data) {
                            data.search['user_groups_id'] = cs_user_groups_id;
                            data.search['continent_id'] = cs_tender_continent;
                            data.search['country_id'] = cs_country;
                            data.search['product_type'] = cs_pr_type;
                            data.search['standart'] = cs_standart;
                            data.search['company_ids'] = cs_company_ids;
                        },
                        dataSrc: function(jsonData) {
                            return jsonData.data;
                        }
                    },
                    search: {
                        search: getAllUrlParams().title ? getAllUrlParams().title : ""
                    },
                    columnDefs: [
                        {
                            targets: [0, 1, 2, 3, 4, 5, 6, 7, 8], //first column / numbering column
                            orderable: false //set not orderable
                        }
                    ],
                    columns: [
                        {
                            className: "closed_tb one"
                        },
                        {
                            className: "closed_tb "
                        },
                        {
                            className: "closed_tb "
                        },
                        {
                            className: "closed_tb "
                        },
                        {
                            className: "closed_tb "
                        },
                        {
                            className: "closed_tb "
                        },
                        {
                            className: "closed_tb "
                        },
                         {
                            className: "closed_tb "
                        },
                        {
                            className: "closed_tb ten"
                        }
                    ]
                });
            }

            setTimeout(function(){
                $('.main_event_continent').trigger('change');
                console.log("exe");
            },1000);
        });

        $(".select_country").on("changed.bs.select", function(
            e,
            clickedIndex,
            isSelected,
            previousValue
        ) {
            getFilterData();
            table.ajax.reload();
        });

        $(".product_status_type").on("changed.bs.select", function(
            e,
            clickedIndex,
            isSelected,
            previousValue
        ) {
            getFilterData();
            table.ajax.reload();
        });

        $(".product_standart").on("changed.bs.select", function(
            e,
            clickedIndex,
            isSelected,
            previousValue
        ) {
            getFilterData();
            table.ajax.reload();
        });

        $(".product_type").on("changed.bs.select", function(
            e,
            clickedIndex,
            isSelected,
            previousValue
        ) {
            getFilterData();
            table.ajax.reload();
        });

        function getFilterData() {
            cs_group_id = [];
            cs_tender_continent = [];
            cs_country = [];
            cs_user_groups_id = [];
            cs_pr_type = [];
            cs_standart = [];

            $.each($(".select_country option:selected"), function() {
                cs_country.push($(this).val());
            });
            $.each($(".product_status_type option:selected"), function() {
                cs_user_groups_id.push($(this).val());
            });
            $.each($(".product_type option:selected"), function() {
                cs_pr_type.push($(this).val());
            });
            $.each($(".product_standart option:selected"), function() {
                cs_pr_type.push($(this).val());
            });
        }

    </script>
{/block}
