{extends file=$layout}
{block name=content}
    <link rel="stylesheet" href="{base_url('templates/default/assets/css/prefix-style.css')}" media="all">

    <div class="wrap margin-top-100 col-md-12">
        <div class="container">

                <div class="row">
                    <div class="full_width flex justify_between align_center all_news_list_top">

                        <div class="flex align_center">
                            <h2>News</h2>
                            <ul class="flex all_news_list_tabs">
                                <li><a href="{site_url_multi('/')}news" class="{if $news_type=='site_news'} active {/if}">Site news</a> </li>
                                <li><a href="{site_url_multi('/')}news?news_type=all_companies" class="{if $news_type=='all_companies'} active {/if}">All companies</a> </li>
                                {if $is_loggedin}
                                    <li><a href="{site_url_multi('/')}news?news_type=following_companies" class="{if $news_type=='following_companies'} active {/if}">Following companies</a> </li>
                                    <li><a href="{site_url_multi('/')}news?news_type=my_companies" class="{if $news_type=='my_companies'} active {/if}">My companies</a> </li>
                                {/if}

                            </ul>
                        </div>

                        <span>{$total_rows} news</span>

                    </div>
                </div>

                <div class="row all_news_list flex flex_wrap">
                    {if $news_list}
                        {foreach from=$news_list item=newsitem }
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                {if $newsitem->date|date_format:"%d/%m/%y" == date("d/m/y")}
                                    <span class="day_n">Today</span>
                                {elseif $newsitem->date|date_format:"%d/%m/%y" == date('d/m/y',strtotime("-1 day"))}
                                    <span class="day_n">Yesterday</span>
                                {else}
                                    <span class="day_n">{date('d M Y', strtotime($newsitem->date))}</span>
                                {/if}

                                <div class="full_width news_img">
                                    {if $newsitem->date|date_format:"%d/%m/%y" == date("d/m/y")}
                                        <span class="abs_right_n">new</span>
                                    {/if}
                                    <a href="{$newsitem->link}" target="_blank">
                                        <img src="{$newsitem->image}" alt="news" />
                                    </a>
                                </div>
                                <div class="full_width flex direction_column">
                                    <a href="{$newsitem->link}" target="_blank" class="heading_nn">{$newsitem->title}</a>
                                    <p>{strip_tags($newsitem->description)|truncate:200}</p>

                                    {if !empty($newsitem->company_name)}
                                        <a href="{$newsitem->company_link}" target="_blank" class="flex align_center news_list_company_info">
                                            <img src="{$newsitem->company_logo}" />
                                            <span>{$newsitem->company_name}</span>
                                        </a>
                                    {/if}
                                </div>
                            </div>
                        {/foreach}
                    {/if}
                </div>

                {$pagination}

        </div>
    </div>
{/block}
