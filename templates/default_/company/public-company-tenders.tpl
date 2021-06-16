{extends file=$layout}
{block name=content}
    <link rel="stylesheet" href="{base_url('templates/default/assets/css/prefix-style.css')}" media="all">
    <div class="n_content_area full_width">
        <a href="#" id="openMenu" class="public-menu-float">Menu</a>

    <div class="container-fluid">
        <div class="row">
            {include file='../company/public-company-sidebar.tpl'}
            <div class="n_right_section start_with_text news_page">
                <div class="with_buttons full_width">
                    <h2>Tenders</h2>
                </div>
                <div class="full_width news_tiles">
                    <div class="jumbotron" style="background-color: rgba(255, 210, 0, 1);">
                        <div class="container">
                            <h1><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Under Construction</h1>
                            <p>This page is under construction.</p>
                        </div>
                    </div>
                </div>

            </div><!-- /.right_section -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->

</div><!-- /.n_content_area -->
{/block}