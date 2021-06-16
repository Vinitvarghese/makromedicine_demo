{extends file=$layout}
{block name=content}
<link rel="stylesheet" href="{base_url('templates/default/assets/css/prefix-style.css')}" media="all">
{include file='../_partial/approve_waiting_line.tpl'}
<div class="n_content_area full_width">
<a href="#" id="openMenu" class="pages-menu-float">Menu</a>
    <div class="container-fluid">
        <div class="row">
            {include file='../company/sidebar.tpl'}
            <div class="n_right_section start_with_text news_page">
                <div class="with_buttons full_width">
                    <h2>Edit news {$title}</h2>
                </div>
                <div class="news_adding_section full_width">
                <form method="post" enctype="multipart/form-data">
                    
                <h4 class="title_1">Arcticle Title</h4>
                <input type="text" name="title" value="{$news.title}" required>
                
                <hr>
                
                <div class="upload_img full_width img_fit">
                    <div id="my-file-preview" style="background-image: url('{base_url('uploads/news/')}{$news.image}');"></div>
                    <div class="input-file-container">  
                        <input class="input-file" id="my-file" accept="image/gif, image/jpg, image/png, image/jpeg" name="news_image" type="file">
                        <label tabindex="0" for="my-file" class="input-file-trigger">Add Photo</label>
                    </div>
                </div><!-- /.upload_img -->
                
                <label class="text_label">Text</label>
                
                <textarea name="description" class="big_area">{$news.description}</textarea>
                
                

                
                <div class="btn_wrap hasfull full_width">
                    <button type="submit" name="submit" class="n_save">Save</button>
                </div>
    

                </form>
                </div>
            </div><!-- /.right_section -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->

</div><!-- /.n_content_area -->
{literal}
    <script>

        // File preview on upload
        document.getElementById("my-file").onchange = function () {
            var reader = new FileReader();

            reader.onload = function (e) {
                console.log(e.target);
                // get loaded data and render thumbnail.
                document.getElementById("my-file-preview").style.backgroundImage = "url('"+e.target.result+"')";
            };

            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        };

        document.getElementById("my-file2").onchange = function () {
            var reader = new FileReader();

            reader.onload = function (e) {
                // get loaded data and render thumbnail.
                document.getElementById("my-file2-preview").style.backgroundImage = "url('"+e.target.result+"')";
            };

            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        };

    </script>
{/literal}


    {/block}
