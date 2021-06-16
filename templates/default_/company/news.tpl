{extends file=$layout}
{block name=content}

<link rel="stylesheet" href="{base_url('templates/default/assets/css/prefix-style.css')}" media="all">
<div class="n_content_area full_width">
<a href="#" id="openMenu" class="pages-menu-float">Menu</a>

    <div class="container-fluid">
        <div class="row">
            {include file='../company/sidebar.tpl'}
            <div class="n_right_section start_with_text news_page">
                <div class="with_buttons full_width">
                    <h2>news</h2>
                    {if $user.id && $user.id == $UserData->id}
                        <a href="{site_url_multi('/')}profile/pages/{$UserData->slug}/add-news" class="n_green_col">Add News</a>
                    {/if}
                    {*<a href="#" class="n_green_col">Add News</a>*}
                    <span class="news_number">{$total_news} news</span>
                </div>
                <div class="full_width news_tiles">
                    <div class="row">
                        {foreach $news as $newsitem}
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                {if $newsitem.date|date_format:"%d/%m/%y" == date("d/m/y")}
                                    <span class="day_n">Today</span>
                                {elseif $newsitem.date|date_format:"%d/%m/%y" == date('d/m/y',strtotime("-1 day"))}
                                    <span class="day_n">Yesterday</span>
                                {else}
                                    <span class="day_n">{$newsitem.date|date_format:"%d/%m/%y"}</span>
                                {/if}
                                <div class="full_width news_img">
                                    {if $newsitem.date|date_format:"%d/%m/%y" == date("d/m/y")}
                                        <span class="abs_right_n">new</span>
                                    {/if}
                                    <img src="{base_url('uploads/news/')}{$newsitem.image}" alt="news" />
                                </div> 
                                <a href="{site_url_multi('/')}companies/{$slug}/news/{$newsitem.id}" class="heading_nn">{$newsitem.title}</a>
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

                    <div class="n_pagination full_width">

                        {if $prev_page < $num_pages && $prev_page > 0 }
                            <a href="{base_url('/')}pages/{$UserData->slug}/news?page={$prev_page}" class="prev"><img src="{base_url('templates/default/assets/images/icons/page_prev.png')}"></a>
                        {/if}
                        {for $page_item=1 to $num_pages}
                            <a class=" {if $curr_page==$page_item } active {/if} " href="{base_url('/')}pages/{$UserData->slug}/news?page={$page_item}">{$page_item}</a>
                        {/for}
                        {if $next_page <= $num_pages }
                            <a href="{base_url('/')}pages/{$UserData->slug}/news?page={$next_page}" class="next"><img src="{base_url('templates/default/assets/images/icons/page_next.png')}"></a>
                        {/if}
                        
                    </div>
                </div>

            </div><!-- /.right_section -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->

</div><!-- /.n_content_area -->
<script>
    {if !empty($UserData->lat) || !empty($UserData->lng)}
    var json_lat = {$UserData->lat};
    var json_lng = {$UserData->lng};
    var json_title = '{$UserData->adress}';
    {literal}

    {/literal}
    {else}
    var json_title = '{$UserData->company_name}';
    {literal}
    {/literal}
    {/if}

    $(document).on("click", ".remove-item1", function() {
        var news = $(this).data("news");
        var that = $(this);
        if (confirm("Are you sure?")) {
            $.ajax({
                url: "{site_url_multi('/')}profile/pages/{$UserData->slug}/delete-news/"+news,
            }).done(function() {
                window.location = '';
            });
        }
    });

    $(document).ready(function() {

        {literal}
            $('.delete-news-item').on('click', function(ev){
                ev.preventDefault();
                var deleteConfirm = confirm("Press a button!");
                if (deleteConfirm == true) {
                    window.location.href = $(this).attr('href');
                } else {
                }
            })
        {/literal}
    });
</script>

{*<link rel="stylesheet" href="{base_url('templates/default/assets/css/prefix-style.css')}" media="all">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<link rel="stylesheet" href="{base_url('templates/default/assets/css/custom.css')}" media="all">
<div class="clearfix"></div>
<div class="wrap margin-top-100 col-md-12">
    <div class="container">
        <div class="row">
            <div class="col-md-12" id="profile">
                <div class="col-md-12 no-padding" >
                    <form class="userphotos_form" action="https://makromedicine.com/profile/userphotos" method="post">
                        <input type="file" style="display:none;" name="userphotos" class="userphotos"/>
                    </form>
                    <form class="userSettings" action="https://makromedicine.com/profile/save" enctype="multipart/form-data" method="post">


                        <!--main info start-->
                        <div class="col-md-12 profile-right no-padding">
                            <div class="right-content" >

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
                                            <div class="col-md-9 col-sm-9 col-xs-12 pull-right profile-right-section">


                                                <div class="row profile-right-section-row">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <h3><u><b>News</b></u></h3><br>
                                                        </div>
                                                        <div class="col-md-6 col-sm-11 col-xs-11">
                                                            {if $user.id && $user.id == $UserData->id}
                                                            <a href="{site_url_multi('/')}profile/pages/{$UserData->slug}/add-news" class="confirm-btn confirm-btn-anchor">+ Add News</a>
                                                            {/if}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                                            {foreach $news as $newsitem}
                                                            <div class="row mb-2">
                                                                <div class="col-md-12 col-sm-11 col-xs-11">
                                                                    <div class="card" style="margin-bottom:20px;">
                                                                        <div class="card-body">
                                                                            <div class="row">
                                                                                <div class="col-md-3">
                                                                                    <img src="{base_url('uploads/news/')}{$newsitem.image}" style="width:100%;">
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <div class="card-body">
                                                                                        <div class="news-content">
                                                                                            <a href="{site_url_multi('/')}pages/{$UserData->slug}/news/{$newsitem.id}"><h4>{$newsitem.title}</h4></a><br>
                                                                                            <p>{$newsitem.description|truncate:220}</p></br>

                                                                                        </div>
                                                                                        <div class="news-footer">
                                                                                            <div class="news-author">
                                                                                                <ul class="list-inline list-unstyled">
                                                                                                    <li class="list-inline-item text-secondary">
                                                                                                        <i class="fa fa-calendar"></i>
                                                                                                        {$newsitem.date|date_format:"%D"}
                                                                                                    </li>
                                                                                                    {if $user.id && $user.id == $UserData->id}
                                                                                                    <button type="button" data-news="{$newsitem.id}" class="btn btn-danger btn-bix pull-right remove-item1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"> <i class="fa fa-trash"></i> </button>
                                                                                                    {/if}
                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {/foreach}
                                                            
                                                        </div>

                                                    </div>
<div class="row mb-2">
                                                        <div class="col-md-12 col-sm-10 col-xs-10">
                                                            <ul class="pagination">
                                                                {if $prev_page < $num_pages && $prev_page > 0 }
                                                                    <li class="page-item"><a class="page-link" href="{base_url('/')}pages/{$UserData->slug}/news?page={$prev_page}">Previous</a></li>
                                                                {/if}
                                                                {for $page_item=1 to $num_pages}
                                                                    <li class="page-item"><a class="page-link" href="{base_url('/')}pages/{$UserData->slug}/news?page={$page_item}">{$page_item}</a></li>
                                                                {/for}
                                                                {if $next_page <= $num_pages }
                                                                <li class="page-item"><a class="page-link" href="{base_url('/')}pages/{$UserData->slug}/news?page={$next_page}">Next</a></li>
                                                                {/if}
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="clearfix"> </div>
                            </div>

                            <!--main info end-->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXX757Qw5m5_tjb2VxaeyRZ34T-IID2ok&libraries=places&callback=initAutocomplete" async defer></script>
    <script>
        {if !empty($UserData->lat) || !empty($UserData->lng)}
        var json_lat = {$UserData->lat};
        var json_lng = {$UserData->lng};
        var json_title = '{$UserData->adress}';
        {literal}

        {/literal}
        {else}
        var json_title = '{$UserData->company_name}';
        {literal}
        {/literal}
        {/if}

        $(document).on("click", ".remove-item1", function() {
            var news = $(this).data("news");
            var that = $(this);
            if (confirm("Are you sure?")) {
                $.ajax({
                    url: "{site_url_multi('/')}profile/pages/{$UserData->slug}/delete-news/"+news,
                }).done(function() {
                    window.location = '';
                });
            }
        });

        $(document).ready(function() {

            {literal}

            {/literal}
        });
    </script>*}
    {/block}
