<!-- Main sidebar -->
<div class="sidebar sidebar-main sidebar-fixed">
	<div class="sidebar-content">
		<!-- Main navigation -->
		<div class="sidebar-category sidebar-category-visible">
			<div class="category-content no-padding">
				<ul class="navigation navigation-main navigation-accordion">
					<!-- Main -->
					<li {if $controller eq 'dashboard'}class="active"{/if}><a href="{site_url_multi('admin/dashboard')}"><i class="icon-home4"></i> <span>{translate('sidebar_menu_dashboard', true)}</span></a></li>
					<li {if $controller eq 'extension'}class="active"{/if}><a href="{site_url_multi('admin/extension')}"><i class="icon-puzzle4"></i> <span>{translate('sidebar_menu_extension', true)}</span></a></li>

					{foreach from=$sidebar_menus item=$menu}
						<li {if $menu.active eq 1}class="active"{/if}>
							<a href="{$menu.href}"><i class="{$menu.icon}"></i> <span onclick="window.location='{$menu.href}'">{$menu.name}</span></a>
							{if $menu.parent}
								<ul>
									{foreach from=$menu.parent item=$sub_menu}
										<li {if $sub_menu.active eq 1}class="active"{/if}>
											<a href="{$sub_menu.href}"><i class="{$sub_menu.icon}"></i> <span>{$sub_menu.name}</span></a>
										</li>
									{/foreach}
								</ul>
							{/if}
						</li>
					{/foreach}

					<li {if $controller eq 'filemanager'}class="active"{/if}><a href="{site_url_multi('admin/filemanager')}"><i class="icon-box"></i> <span>{translate('sidebar_menu_filemanager', true)}</span></a></li>
					<li {if $controller eq 'language'}class="active"{/if}><a href="{site_url_multi('admin/language')}"><i class="icon-earth"></i> <span>{translate('sidebar_menu_language', true)}</span></a></li>
					<li>
						<a href="#"><i class="icon-users"></i> <span>{translate('sidebar_menu_user_management', true)}</span></a>
						<ul>
							<li {if $controller eq 'user'}class="active"{/if}><a href="{site_url_multi('admin/user')}">{translate('sidebar_menu_users', true)}</a></li>
							<li {if $controller eq 'group'}class="active"{/if}><a href="{site_url_multi('admin/group')}">{translate('sidebar_menu_group', true)}</a></li>
							<li {if $controller eq 'permission'}class="active"{/if}><a href="{site_url_multi('admin/permission')}">{translate('sidebar_menu_permission', true)}</a></li>
						</ul>
					</li>
					<li {if $controller eq 'setting'}class="active"{/if}><a href="{site_url_multi('admin/setting')}"><i class="icon-cog"></i> <span>{translate('sidebar_menu_setting', true)}</span></a></li>

					<!-- /main -->

				</ul>
			</div>
		</div>
		<!-- /main navigation -->
	</div>
</div>
<!-- /main sidebar -->