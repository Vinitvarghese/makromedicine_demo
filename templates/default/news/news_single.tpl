{extends file=$layout}
{block name=content}
    <div class="wrap margin-top-100 col-md-12">
        <div class="container">
            <div class="row">
                <div class="clearfix"></div>
                <div class="col-md-12" id="blog-single">
                    <div class="col-md-12 no-padding">
                        <div class="row">
                            <div class="col-md-12 col-xs-12">
                                <div class="blog-fullimg">
                                    <img src="{base_url('uploads')}/{$news->image}" alt="{$news->title}">
                                </div>
                            </div>
                            <div class="col-md-12 col-xs-12">
                                <h1 class="blog-title-mor">{$news->title}</h1>
                               
                                <span class="blog-tiles"><i class="fa fa-calendar fa-fw"></i>{$data_format}</span>
                                <span class="blog-tiles"><i class="fa fa-eye fa-fw"></i>{$news->views}</span>
                            </div>
                            <div class="col-md-12 col-xs-12 blog-description">
                                <p>{$news->description}</p>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-12 col-xs-12 blog-footer">
                                <div class="col-md-6">
                                    {$var = explode(',', $news->meta_keyword)}
                                    <p> TAG:  {if is_array($var)}{foreach $var as $value}<a href="">{$value}</a>{/foreach}{/if} </p>
                                </div>
                                <div class="col-md-6">
                                    <div class="pull-right">
                                        <div class="addthis_inline_share_toolbox_8nyn"></div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{/block}
