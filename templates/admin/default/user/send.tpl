{extends file=$layout}
{block name=content}
<div class="panel panel-white">
	<div class="panel-heading">
		<h5 class="panel-title text-semibold">{$title} <a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
		<div class="heading-elements"></div>
	</div>

	{if validation_errors()}
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-danger no-border">
				<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
				{$message}
		    </div>
		</div>
	</div>
	{/if}

	{form_open(current_url(), 'class="form-horizontal has-feedback", id="form-save"')}
	<ul class="nav nav-lg nav-tabs nav-tabs-bottom nav-tabs-toolbar no-margin">
		<li class="active"><a href="#general" data-toggle="tab"><i class="icon-menu7 position-left"></i> {translate("tab_general", true)}</a></li>
	</ul>

	<div class="tab-content">
		<div class="tab-pane active" id="general">
			<div class="panel-body">
				{foreach from=$form_field.general key=key item=value}
				<div class="form-group {if form_error($form_field.general[{$key}].name)}has-error{/if}">
					{form_label($form_field.general[{$key}].label, $key, ['class' => 'control-label col-md-2'])}
					<div class="col-md-10">
					{form_element($form_field.general[{$key}])}
					{form_error($form_field.general[{$key}].name)}
					</div>
					{if $form_field.general[{$key}].name == 'email'}
					<div class="col-md-10 col-md-offset-2" style="margin-top:15px;">
					<p>Other emails:</p>
						{foreach $user_other_data as $p_info}
							<p>{$p_info}</p>
						{/foreach}
					</div>
					
					{if isset($oldemail)}
					<div class="col-md-10 col-md-offset-2" style="margin-top:15px;">
					<p>Old email:</p>
						{$oldemail}
					</div>
					{/if}
					{/if}

				</div>
				{/foreach}
			</div>
		</div>
	</div>
	{form_close()}
</div>
{literal}
<script type="text/javascript">
  $(document).on('change','#user_id', function(){
    var value = $(this).val();
    $.ajax({
			url: "/admin/user/get_email/",
			type: "post",
			data: {'value':value},
			success: function (data) {
        if(data != false)
        {
          $('#email').val(data);
        }
        else
        {
          $('#email').remove();
        }
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});
  });
</script>
{/literal}
{/block}
