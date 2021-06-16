{extends file=$layout}
{block name=content}
    <style>
        .column_process .bootstrap-select:not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn){
            width: auto;
            min-width: 115px;
        }
        .column_process .bootstrap-select > .btn.btn-default, .column_process .bootstrap-select > .btn.btn-default.disabled{
            padding: 5px;
            background: transparent;
        }
        .btn-copy-link{
            font-size: 11px;
            padding: 3px 6px;
        }

        .is_red{
            background-color: red !important;
        }
    </style>
    <div class="panel panel-white">
        <div class="panel-heading">
            <h5 class="panel-title">{$title}</h5>
            <div class="heading-elements">
                <a class="btn btn-default heading-btn pull-right table-toolbar-button"><i class="icon-gear"></i></a>

            </div>
        </div>
        {if isset($message) && !empty($message)}
            <div class="panel-body">
                <div class="alert alert-success no-border">
                    {$message}
                </div>
            </div>
        {/if}

        {form_open_multipart(current_url(), 'class="form-horizontal" id="form-list"')}
        <table class="table table-responsive table-striped table-hover table-xxs">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Company name</th>
                    <th>Country</th>
                    <th>Address</th>
                    <th>Establishment date</th>
                    <th>Approve status</th>
                    <th>Users and roles</th>
                    <th>Operation</th>
                </tr>
            </thead>
            <tbody>
                {foreach $companies as $k => $v}
                    {$exp_users=explode(',', $v->users)}
                    {$exp_user_role_ids=explode(',', $v->role_ids)}
                    {$exp_role_main_id=explode(',', $v->role_main_id)}
                    <tr class=" {if $v->status==0} is_red {/if} " >
                        <td>{$v->id}</td>
                        <td>{$v->company_name}</td>
                        <td>{$v->country_name}</td>
                        <td>{$v->company_address}</td>
                        <td>{$v->establishment_date}</td>
                        <td>

                            <select class="approve_status" data-company="{$v->id}" >
                                <option value="1" {if $v->status==1} selected {/if}  >Approved</option>
                                <option value="0" {if $v->status==0} selected {/if}  >Not approved</option>
                            </select>
                        </td>
                        <td>
                            {foreach $exp_users as $index =>  $user}
                                <p>
                                    {$user} -
                                    <select name="" class="change_user_position_on_page" data-role-man-id="{$exp_role_main_id[$index]}">
                                        {foreach $user_page_roles as $role}
                                            <option value="{$role->id}" {if isset($exp_user_role_ids[$index]) && $role->id==$exp_user_role_ids[$index]}selected{/if} >{$role->name}</option>
                                        {/foreach}
                                    </select>
                                    {if isset($exp_role_main_id[$index])}
                                        <button type="button" class="apply_user_position"
                                            data-role-man-id="{$exp_role_main_id[$index]}">Apply</button>
                                        <button type="button" class="remove_user_from_page"
                                            data-role-man-id="{$exp_role_main_id[$index]}">X</button>
                                    {/if}
                                    
                                </p>
                            {/foreach}
                        </td>
                        
                        <td>
                            {* <ul class="icons-list">
                                <li><a href="{site_url_multi($full_url)}/edit/{$v->id}" data-popup="tooltip" title="" data-original-title="Edit"><i class="icon-pencil7"></i></a></li>
                                <li><a href="{site_url_multi($full_url)}/delete/{$v->id}" class="delete" data-popup="tooltip" title="" data-original-title="Delete"><i class="icon-trash"></i></a></li>
                            </ul> *}
                        </td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
        {form_close()}

    </div>


    <script type="text/javascript">
        {literal}


        $('.apply_user_position').on('click', function(){
            var bu=$(this),
                p=bu.parents('p'),
                change_user_position_on_page=p.find('.change_user_position_on_page'),
                role_id=change_user_position_on_page.val(),
                role_main_id=change_user_position_on_page.data('role-man-id');

            $.ajax({
                url: ci_custom_home_url+'en/admin/companies',
                method : "post",
                dataType: 'json',
                cache : false,
                data: {role_id : role_id, role_main_id : role_main_id},
                success : function () {
                    alert("Updated");
                }
            });
        });

        $('.approve_status').change(function () {
            if (confirm("Are you sure?")){
                var bu=$(this),
                    company_id=bu.data('company'),
                    tr=bu.parents('tr');

                $.ajax({
                    url: ci_custom_home_url+'en/admin/companies',
                    method : "post",
                    dataType: 'json',
                    cache : false,
                    data: {updateApproveStatus : true, company_id : company_id, approved_st : bu.val()},
                    success : function () {
                        /*if(bu.val()==1){
                            tr.removeClass('is_red')
                        }else{
                            tr.addClass('is_red')
                        }
                        */

                        window.location.href=window.location.href
                    }
                });
            }
        });

        $('.remove_user_from_page').click(function () {
            if (confirm("Are you sure?")){
                var bu=$(this),
                    role_main_id=bu.data('role-man-id'),
                    p=bu.parents("p");

                $.ajax({
                    url: ci_custom_home_url+'en/admin/companies',
                    method : "post",
                    dataType: 'json',
                    cache : false,
                    data: {removeUserFromPage : true, role_main_id : role_main_id},
                    success : function () {
                        p.remove();
                    }
                });
            }
        });

        {/literal}
    </script>

{/block}
