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
    table > tbody > tr > td:not(:first-child){
        padding-left: 0 !important;
        padding-right: 0 !important;
    }

    table > tbody > tr > td{
        vertical-align: middle !important;
    }

    table tr td p{
        border-bottom: 1px solid #ccc;
        padding-bottom: 3px;
        height: 27px;
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
    <table class="table table-responsive table-striped table-hover">
        <thead>
        <tr>
            <th width="50">ID</th>
            <th width="200">Permission name</th>
            <th width="200">Roles</th>
            <th>Add</th>
            <th>View</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
            {foreach $permission_list as $k => $v}
                <tr>
                    <td>{$v->id}</td>
                    <td>{$v->name}</td>
                    <td>
                        {foreach $roles as $role}
                            <p>{$role->name}</p>
                        {/foreach}
                    </td>
                    <td>
                        {foreach $roles as $role}
                            <p><input type="checkbox" name="permission[{$v->id}][{$role->id}][]" class="update_user_permission" value="{$role_and_permission[$v->id][$role->id]['id']}"  data-column="add"  {if $role_and_permission[$v->id][$role->id]['add']==1}checked{/if} /></p>
                        {/foreach}
                    </td>
                    <td>
                        {foreach $roles as $role}
                            <p><input type="checkbox" name="permission[{$v->id}][{$role->id}][]" class="update_user_permission" value="{$role_and_permission[$v->id][$role->id]['id']}" data-column="view" {if $role_and_permission[$v->id][$role->id]['view']==1}checked{/if} /></p>
                        {/foreach}
                    </td>
                    <td>
                        {foreach $roles as $role}
                            <p><input type="checkbox" name="permission[{$v->id}][{$role->id}][]" class="update_user_permission" value="{$role_and_permission[$v->id][$role->id]['id']}" data-column="edit" {if $role_and_permission[$v->id][$role->id]['edit']==1}checked{/if} /></p>
                        {/foreach}
                    </td>
                    <td>
                        {foreach $roles as $role}
                            <p><input type="checkbox" name="permission[{$v->id}][{$role->id}][]" class="update_user_permission" value="{$role_and_permission[$v->id][$role->id]['id']}" data-column="delete" {if $role_and_permission[$v->id][$role->id]['delete']==1}checked{/if} /></p>
                        {/foreach}
                    </td>
                </tr>
            {/foreach}
        </tbody>
    </table>
    {form_close()}

</div>


<script type="text/javascript">
    {literal}


    $('.update_user_permission').on('change', function(){
        var bu=$(this),
            id=bu.val(),
            column=bu.data('column'),
            checked=( bu.prop("checked")) ? 1 : 0;

        $.ajax({
            url: ci_custom_home_url+'en/admin/permissions',
            method : "post",
            dataType: 'json',
            cache : false,
            data: {update_permission : true, id : id, column : column, checked : checked},
            succces : function () {

            }
        });
    });

    {/literal}
</script>

{/block}
