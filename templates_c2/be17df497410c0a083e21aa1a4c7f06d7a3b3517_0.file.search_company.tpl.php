<?php
/* Smarty version 3.1.30, created on 2020-10-29 13:02:10
  from "/home/makromed/public_html/demo/templates/default/search/search_company.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f9a8512f3d894_40807973',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'be17df497410c0a083e21aa1a4c7f06d7a3b3517' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/default/search/search_company.tpl',
      1 => 1603718930,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f9a8512f3d894_40807973 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_13337362765f9a8512f3c900_79936676', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['layout']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, true);
}
/* {block 'content'} */
class Block_13337362765f9a8512f3c900_79936676 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


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
                    <form class="searchTable" action="<?php echo base_url('home/search_table');?>
" method="post">
                        <div class="col-md-12 no-padding tables-data">
                            <table class="table responsive table-striped no-padding display table-search-not"  id="example" >
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
                                            <?php if ($_smarty_tpl->tpl_vars['groups']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['groups']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
if ($_smarty_tpl->tpl_vars['value']->value->id != 6) {?>
                                                <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
" <?php if (in_array($_smarty_tpl->tpl_vars['value']->value->id,$_smarty_tpl->tpl_vars['search_status']->value)) {?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
</option>
                                            <?php }
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                                        </select>
                                    </th>
                                    <th class=""><p class="col_padding">Products</p></th>

                                    <th class="">
                                        <select name="pr_type[]" class="form-control selectpicker show-menu-arrow product_type" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Product Type">
                                            <?php if ($_smarty_tpl->tpl_vars['product_types']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product_types']->value, 'product_type');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['product_type']->value) {
?>
                                                <option value="<?php echo $_smarty_tpl->tpl_vars['product_type']->value->id;?>
" <?php if (in_array($_smarty_tpl->tpl_vars['product_type']->value->id,$_smarty_tpl->tpl_vars['pr_type']->value)) {?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['product_type']->value->name;?>
</option>
                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                                        </select>
                                    </th>
                                    <th class="">
                                        <select name="standart[]" style="display: none"
                                                class="selectpicker show-menu-arrow product_standart" multiple
                                                data-live-search="true" data-actions-box="true"
                                                data-selected-text-format="count > 0" title="Standard">
                                            <?php if ($_smarty_tpl->tpl_vars['standarts']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['standarts']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
                                                <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
" <?php if (in_array($_smarty_tpl->tpl_vars['value']->value->id,$_smarty_tpl->tpl_vars['search_standart']->value)) {?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
</option>
                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                                        </select>
                                    </th>

                                    <th class="">
                                        <select name="country_id[]" class="form-control selectpicker show-menu-arrow select_country" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Country">
                                            <?php if ($_smarty_tpl->tpl_vars['countrys']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['countrys']->value, 'countryd');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['countryd']->value) {
?>
                                                <option value="<?php echo $_smarty_tpl->tpl_vars['countryd']->value->id;?>
" <?php if ($_smarty_tpl->tpl_vars['event_country']->value) {?> <?php if (in_array($_smarty_tpl->tpl_vars['countryd']->value->id,$_smarty_tpl->tpl_vars['event_country']->value)) {?> selected="selected" <?php }?> <?php }?>><?php echo $_smarty_tpl->tpl_vars['countryd']->value->name;?>
</option>
                                             <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
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
    <?php echo '<script'; ?>
 type="text/javascript">
        <?php if (isset($_POST['country'])) {?>
        var countrypost = <?php echo $_POST['country'];?>
;
        
        window.onload = function(e){
            setTimeout(function(){
                // $('select.select_country').selectpicker('val', [countrypost]);
                // $('.select_country').trigger('change');
                $('.main_event_continent').trigger('change');
                // console.log("exe");
            },3000);

        }
        
        <?php }?>
    <?php echo '</script'; ?>
>

    <?php echo '<script'; ?>
>
        


        
        var table;
        var cs_group_id = [];
        var cs_tender_continent = [];
        var cs_country = <?php echo $_smarty_tpl->tpl_vars['dt_event_country']->value;?>
;
        var cs_user_groups_id = <?php echo $_smarty_tpl->tpl_vars['dt_search_status']->value;?>
;
        var cs_pr_type = <?php echo $_smarty_tpl->tpl_vars['dt_pr_type']->value;?>
;
        var cs_standart = <?php echo $_smarty_tpl->tpl_vars['dt_search_standart']->value;?>
;

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
                            data.search['country_id'] = cs_country;
                            data.search['product_type'] = cs_pr_type;
                            data.search['standart'] = cs_standart;
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

    <?php echo '</script'; ?>
>
<?php
}
}
/* {/block 'content'} */
}
