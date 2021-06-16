{extends file=$layout}
{block name=content}
    <div class="wrap margin-top-100 col-md-12">
        <div class="container">
            <div class="row">
                <div class="clearfix"></div>
                {if $blog_list}
                    <div class="col-md-12" id="blog">
                        <div class="col-md-12 no-padding">
                            <div class="row">
                                {foreach from=$blog_list item=blog}
                                <div class="col-md-4 item-block">
                                    <div class="blog-item">
                                        <div class="blog-img">
                                        {if $blog->image neq NULL}
                                        <img src="{base_url('uploads/')}{$blog->image}" alt="{$blog->title}">
                                        {else}
                                        <img src="{base_url('uploads/catalog/')}nophoto.png" alt="{$blog->title}" style="height: 240px;object-fit: contain;">
                                        {/if}
                                        </div>
                                        <span class="news-date">{$blog->created_at}</span>
                                        <div class="blog-title">
                                            <h2>{short_title($blog->title, '...', 11)}</h2>
                                        </div>
                                        <div class="blog-content">
                                            <p style="width:100%">{mb_substr(str_replace('&nbsp;',' ', strip_tags($blog->description)), 0, 120 , 'UTF-8')} ...</p>
                                            <a class="blog-read" href="{base_url('blog/')}{$blog->slug}">Read More</a>
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
