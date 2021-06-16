{extends file=$layout}
{block name=content}
    <div class="wrap margin-top-100 col-md-12">
      <div class="container">
        <div class="row">
          <div class="clearfix"></div>
          <div class="col-md-12" id="about">
            {if !empty($page->image)}

            <div class="col-md-4 no-padding-left">
              <div class="about-img">
                <img src="{base_url('uploads')}/{$page->image}" alt="">
              </div>
            </div>
            {/if}
            
            <div class="{if !empty($page->image)} col-md-8 {else} col-md-12 {/if}">
              <div class="about-title">
                <h1> {$page->title}</h1>
              </div>
              <div class="about-description">
                  <p>{$page->description}</p>
              </div>
              <div class="about-description">
                <a href="{site_url('/')}search/?title=&button=&search_type=5&event_type=&start=&end=&trade_type=&dossage_type=&start=&end=">Companies List</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
{/block}
