{extends file=$layout}
{block name=content}
    <div class="wrap margin-top-100 col-md-12">
        <div class="container">
            <div class="row">
                <div class="clearfix"></div>
                {if $news_list}
                    <div class="col-md-12" id="blog">
                        <div class="col-md-12 no-padding">
                            <div class="row">
                                {foreach from=$news_list item=news}
                                <div class="col-md-4 item-block">
                                    <div class="blog-item">
                                        <div class="blog-img">
                                            <img src="{base_url('uploads')}/{$news->image}" alt="">
                                        </div>
                                        <span class="news-date">{$news->created_at}</span>
                                        <div class="blog-title">
                                            <h2>{short_title($news->title, '...', 10)}</h2>
                                        </div>
                                        <div class="blog-content">
                                            <p>{mb_substr(strip_tags($news->description),0,145, 'UTF-8')} ...</p>
                                             <a class="blog-read" href="{base_url('news/')}{$news->slug}">Read More</a>
                                        </div>
                                    </div>
                                </div>
                                {/foreach}
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    {$pagination}
                                </div>
                            </div>
                        </div>
                    </div>
                {/if}
            </div>
        </div>
    </div>
{/block}
