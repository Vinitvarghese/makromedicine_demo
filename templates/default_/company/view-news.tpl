{extends file=$layout}
{block name=content}
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <link rel="stylesheet" href="{base_url('templates/default/assets/css/custom.css')}" media="all">
    <div class="clearfix"></div>
    <div class="wrap margin-top-100 col-md-12">
        <div class="container">
            <div class="row">
                <div class="clearfix"></div>
                <div class="col-md-12" id="profile">
                    <div class="col-md-12 no-padding">

                            <div class="col-md-12 profile-right no-padding">
                                <div class="right-content">

                                    <div class="container main-secction">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12 image-section">
                                                {if $UserData->company_banner}
                                                    <img src="{$company_banner}" />
                                                {else}
                                                    <img src="https://picsum.photos/1170/250"/>
                                                {/if}
                                            </div>
                                            <div class="row user-left-part">
                                                {include file='../company/sidebar.tpl'}
                                                <div class="col-md-9 col-sm-9 col-xs-12 pull-right profile-right-section"
                                                     style="height:640px; overflow:hidden; overflow-y:scroll;">
                                                    <div class="row profile-right-section-row">
                                                        <!--main news start-->
                                                        <div class="row">
                                                            <div class="col-md-12 col-sm-11 col-xs-11">
                                                                <div class="row mb-2">
                                                                    <div class="col-md-12">
                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="news-title">
                                                                                            <h2>{$news.title}</h2>
                                                                                        </div>
                                                                                        <div class="news-cats">
                                                                                            <ul class="list-unstyled list-inline mb-1">
                                                                                                <li class="list-inline-item">
                                                                                                    <i class="fa fa-folder-o text-danger"></i>
                                                                                                    <a href="#"><small>{$news.date|date_format:"%D"}</small></a>
                                                                                                </li>
                                                                                            </ul>
                                                                                        </div>
                                                                                        <hr>
                                                                                        <div class="news-image">
                                                                                            <img src="{base_url('uploads/news/')}{$news.image}"
                                                                                                 style="width:100%; height:360px;">
                                                                                        </div>
                                                                                        <div class="news-content">
                                                                                            <p>{$news.description}</p>
                                                                                        </div>
                                                                                        <div class="news-image">
                                                                                            <img src="{base_url('uploads/news/')}{$news.image2}"
                                                                                                 style="width:100%; height:360px;">
                                                                                        </div>
                                                                                        <div class="news-content">
                                                                                            <p>{$news.description2}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <!--main news end-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>
                                </div>

                                <!--main info end-->
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <script>
            {if !empty($UserData->lat) || !empty($UserData->lng)}
            {literal}
            {/literal}
            {else}
            {literal}
            {/literal}
            {/if}
            $(document).ready(function () {
                {literal}
                {/literal}
            });
        </script>
{/block}