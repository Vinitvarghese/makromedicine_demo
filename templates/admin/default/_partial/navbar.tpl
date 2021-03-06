<!-- Second navbar -->
	<div class="navbar navbar-default" id="navbar-second">
		<ul class="nav navbar-nav no-border visible-xs-block">
			<li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-menu7"></i></a></li>
		</ul>

		<div class="navbar-collapse collapse" id="navbar-second-toggle">
			<ul class="nav navbar-nav">
				{foreach from=$sidebar_menus item=$menu}
					<li class="{if $menu.active eq 1}active{/if} {if $menu.parent}dropdown{/if}">
						<a href="{$menu.href}" {if $menu.parent}class="dropdown-toggle" data-toggle="dropdown"{/if} target="{$menu.target}">
							<i class="{$menu.icon} position-left"></i> {$menu.name} {if $menu.parent}<span class="caret"></span>{/if}
						</a>
						{if $menu.parent}
							<ul class="dropdown-menu width-250">
								{foreach from=$menu.parent item=$sub_menu}
									<li {if $sub_menu.active eq 1}class="active"{/if}>
										<a href="{$sub_menu.href}"><i class="{$sub_menu.icon} position-left"></i> {$sub_menu.name}{if $sub_menu.parent}<span class="caret"></span>{/if}</a>
									
									{if $sub_menu.parent}
									<ul class="dropdown-menu dropdown-submenu">
										{foreach from=$sub_menu.parent item=$sub_menu2}
										<li {if $sub_menu2.active eq 1}class="active"{/if}>
											<a href="{$sub_menu2.href}" {var_dump($sub_menu2.sug_count)}><i class="{$sub_menu2.icon} position-left"></i> {$sub_menu2.name} {if isset($sub_menu2.sug_count) and $sub_menu2.sug_count>0} ({$sub_menu2.sug_count}){/if}</a>
										</li>
										{/foreach}
									</ul>
									{/if}

									</li>

								{/foreach}
							</ul>
						{/if}
					</li>
				{/foreach}
			</ul>
		</div>
	</div>
	<!-- /second navbar -->