<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{$title}</title>
    <base href="{base_url()}">
	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{$admin_theme}/global_assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="{$admin_theme}/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="{$admin_theme}/assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="{$admin_theme}/assets/css/components.css?v=3" rel="stylesheet" type="text/css">
	<link href="{$admin_theme}/assets/css/colors.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<script>
		ci_custom_home_url = "{base_url()}";
	</script>
	<!-- Core JS files -->
	<script src="{$admin_theme}/global_assets/js/plugins/loaders/pace.min.js"></script>
	<script src="{$admin_theme}/global_assets/js/core/libraries/jquery.min.js"></script>
	<script src="{$admin_theme}/global_assets/js/core/libraries/bootstrap.min.js"></script>
	<script src="{$admin_theme}/global_assets/js/plugins/loaders/blockui.min.js"></script>
	<script src="{$admin_theme}/global_assets/js/plugins/ui/nicescroll.min.js"></script>
	<script src="{$admin_theme}/global_assets/js/plugins/ui/drilldown.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="{$admin_theme}/global_assets/js/plugins/forms/styling/switchery.min.js"></script>
	<script src="{$admin_theme}/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
	<script src="{$admin_theme}/global_assets/js/plugins/ui/moment/moment.min.js"></script>
	<script src="{$admin_theme}/global_assets/js/plugins/pickers/daterangepicker.js"></script>
	<script src="{$admin_theme}/global_assets/js/plugins/forms/selects/select2.min.js"></script>
	<script src="{$admin_theme}/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script src="{$admin_theme}/global_assets/js/plugins/editors/ckeditor/ckeditor.js"></script>
	<script src="{$admin_theme}/global_assets/js/plugins/forms/selects/bootstrap_select.min.js"></script>
	<script src="{$admin_theme}/global_assets/js/plugins/notifications/sweet_alert.min.js"></script>
	<script src="{$admin_theme}/global_assets/js/plugins/media/fancybox.min.js"></script>
	<script src="{$admin_theme}/global_assets/js/plugins/forms/styling/switchery.min.js"></script>
	<script src="{$admin_theme}/global_assets/js/plugins/forms/styling/switch.min.js"></script>

	<script src="{$admin_theme}/assets/js/app.js"></script>
	<script src="{$admin_theme}/assets/js/common.js?v=8"></script>
	<!-- /theme JS files -->

	<script> var site_url = document.getElementsByTagName('base')[0].href;</script>
</head>

<body>

	<!-- Main navbar -->
	<div class="navbar navbar-inverse">
		<div class="navbar-header">
			<a class="navbar-brand" href="{site_url_multi($admin_url)}">Makromedicine</a>
				<ul class="nav navbar-nav">
				
				<li>
					<a href="{site_url_multi('/admin/company_name')}?status=0" class="hidden-xs" >Confirm name ({$get_new_company_name})</a>
				</li>
				<li class="dropdown">
					<a href="{site_url_multi('/admin/confirm_account')}?status=0" class="hidden-xs" >Confirm account ({$get_comfirm_account})</a>
				</li>
				<li class="dropdown">
					<a href="{site_url_multi('/admin/product')}?checked=0">Confirm product ({$get_confirm_product})</a>
				</li>
				<li class="dropdown">
					<a href="{site_url_multi('/admin/user_standart')}?status=0" class="hidden-xs" >Confirm standart ({$get_user_standart})</a>
				</li>
				<li class="dropdown">
					<a href="{site_url_multi('/admin/user/sender/')}" class="hidden-xs" >Email Sender</a>
				</li>
				<li class="dropdown">
					<a href="{site_url_multi('/admin/suggestion')}" class="hidden-xs" >Suggestions ({$get_suggestion})</a>
				</li>
			</ul>
			<ul class="nav navbar-nav pull-right visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			

			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown language-switch">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<img src="{$admin_theme}/global_assets/images/flags/{$current_lang}.png" class="position-left" alt="{$languages.$current_lang.name}">
						{$languages.$current_lang.name}
						{if isset($languages) && count($languages) > 1}<span class="caret"></span>{/if}
					</a>

					{if isset($languages) && count($languages) > 1}
						<ul class="dropdown-menu">						
								{foreach  from=$languages key=language_slug item=language}
									{if $language.admin == 1}
										{if $language_slug != $current_lang}
											<li><a href="{site_url($language_slug)}/{$admin_url}" class="{$language.code}"><img src="{$admin_theme}/global_assets/images/flags/{$language.code}.png" alt="{$language.name}"> {$language.name}</a></li>
										{/if}
									{/if}
								{/foreach}
						</ul>
					{/if}
				</li>

				

				<li class="dropdown dropdown-user">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<img src="{$admin_theme}/global_assets/images/placeholders/placeholder.jpg" alt="">
						<i class="caret"></i>
					</a>

					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="{site_url_multi($admin_url)}/authentication/logout"><i class="icon-switch2"></i> {translate('header_user_logout', true)}</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->

	{literal}
		<script type="text/javascript">
			$(document).on('mouseenter','.dropdown-menu li', function() {
				console.log('a');
			    if($(this).find('ul').length){
			        $(this).find('ul').show();
			    }
			});
			$(document).on('mouseleave','.dropdown-menu li',function() {
			    if($(this).find('ul').length){
			        $(this).find('ul').hide();
			    }
			});
		</script>
	{/literal}