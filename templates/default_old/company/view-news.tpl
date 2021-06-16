{extends file=$layout}
{block name=content}
    <link rel="stylesheet" href="{base_url('templates/default/assets/css/prefix-style.css')}" media="all">
    <div class="n_content_area full_width">
        <a href="#" id="openMenu" class="public-menu-float">Menu</a>

        <div class="container-fluid">
            <div class="row">
                {include file='../company/sidebar.tpl'}
                <div class="n_right_section start_with_text news_page">
                    <div class="with_buttons full_width">
                        <h2>{$news.title}</h2>

                    </div>
                    <div class="full_width">
                        <a href="{site_url_multi('/')}profile/pages/{$UserData->slug}/edit-news/{$news.id}" class="nbtn">
                            <img src="{base_url('templates/default/assets/images/icons/green_pen.png')}" alt="Edit news">
                        </a>
                        <a class="delete-news-item nbtn" href="{site_url_multi('/')}profile/pages/{$UserData->slug}/delete-news/{$news.id}">
                            <img src="{base_url('templates/default/assets/images/icons/del_n.png')}" alt="delete news" />
                        </a>
                    </div>
                    <div class="full_width news_tiles">
                        <div class="row">

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="new_in_top" >
                                    {if $news.date|date_format:"%D" == date("d/m/Y")}
                                        <span class="day_n ">Date: Today</span>
                                    {elseif $news.date|date_format:"%D" == date('d/m/Y',strtotime("-1 day"))}
                                        <span class="day_n ">Date: Yesterday</span>
                                    {else}
                                        <span class="day_n ">Date: {date('d M Y', strtotime($news.date))}</span>
                                    {/if}

                                    <span class="show_new_read_count">View: {$news.view}</span>
                                </div>

                                <div class="full_width news_img">
                                    {if $news.date|date_format:"%D" == date("d/m/Y")}
                                        <span class="abs_right_n">new</span>
                                    {/if}
                                    <img src="{base_url('uploads/news/')}{$news.image}" alt="news" />
                                </div>
                                <p class="mt-10">{$news.description}</p>

                            </div>

                            {if (!empty($other_news)) }
                                <div class="col-md-12 col-sm-11 col-xs-11 other_news">
                                    <div class="news-title">
                                        <h2>Other news</h2>

                                        <div class="slider_btns">
                                            <button type="button" class="slider_btn slider_left">
                                                <svg width="7" height="9" viewBox="0 0 7 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0 4.5L7 9V0L0 4.5Z" fill="white"/>
                                                </svg>
                                            </button>
                                            <button type="button" class="slider_btn slider_right">
                                                <svg width="7" height="9" viewBox="0 0 7 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7 4.5L0 9V0L7 4.5Z" fill="white"/>
                                                </svg>

                                            </button>
                                        </div>
                                    </div>

                                    <div class="row other_news_slider">
                                        {foreach $other_news as $newsitem}
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                {if $newsitem.date|date_format:"%d/%m/%y" == date("d/m/y")}
                                                    <span class="day_n">Today</span>
                                                {elseif $newsitem.date|date_format:"%d/%m/%y" == date('d/m/y',strtotime("-1 day"))}
                                                    <span class="day_n">Yesterday</span>
                                                {else}
                                                    <span class="day_n">{date('d M Y', strtotime($newsitem.date))}</span>
                                                {/if}

                                                <div class="full_width news_img">
                                                    {if $newsitem.date|date_format:"%d/%m/%y" == date("d/m/y")}
                                                        <span class="abs_right_n">new</span>
                                                    {/if}
                                                    <a href="{site_url_multi('/')}pages/{$slug}/news/{$newsitem.id}" >
                                                        <img src="{base_url('uploads/news/')}{$newsitem.image}" alt="news" />
                                                    </a>
                                                </div>
                                                <a href="{site_url_multi('/')}pages/{$slug}/news/{$newsitem.id}" class="heading_nn">{$newsitem.title}</a>
                                                <p style="width: 100%;">{$newsitem.description|truncate:220}</p>

                                                <a href="{site_url_multi('/')}profile/pages/{$UserData->slug}/edit-news/{$newsitem.id}" class="nbtn">
                                                    <img src="{base_url('templates/default/assets/images/icons/green_pen.png')}" alt="Edit news">
                                                </a>
                                                <a class="delete-news-item nbtn" href="{site_url_multi('/')}profile/pages/{$UserData->slug}/delete-news/{$newsitem.id}">
                                                    <img src="{base_url('templates/default/assets/images/icons/del_n.png')}" alt="delete news" />
                                                </a>
                                            </div>
                                        {/foreach}
                                    </div>

                                </div><!-- end of other news -->
                            {/if}
                        </div>
                    </div>

                </div><!-- /.right_section -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->

    </div><!-- /.n_content_area -->

{/block}
