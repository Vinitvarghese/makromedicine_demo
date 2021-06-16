{extends file=$layout}
{block name=content}

<style>
  .wrap {
    min-height: 1200px;
    background-color: #f1f1f1;
}
#example_filter{
  display: none;
}
.paging_simple_numbers{
  margin: 20px auto;
    float: right;
    width: 1326px;
    display: block;
    float: none!important;
}
.three p{
      text-overflow: ellipsis;
    overflow: hidden;
}
.tables-data .table > thead.is-fixed {
  border: none;
}
.tables-data .table > thead.is-fixed > tr > th{
  border-bottom: 1px solid rgb(184, 184, 184)!important;
  background: #e9e9e9!important;
}
.tables-data .table > thead.is-fixed > tr > th:nth-child(1){
  min-width: 39px;
  width: 39px;
  border-left: 1px solid rgb(184, 184, 184)!important;;
}
.tables-data .table > thead.is-fixed > tr > th:nth-child(2){
  min-width: 161px;
  width: 160px;
}
.tables-data .table > thead.is-fixed > tr > th:nth-child(3){
  min-width: 191px;
  width: 191px;
}
.tables-data .table > thead.is-fixed > tr > th:nth-child(4){
  min-width: 204px;
  width: 191px;
}
.tables-data .table > thead.is-fixed > tr > th:nth-child(5){
  min-width: 160px;
  width: 160px;
}
.tables-data .table > thead.is-fixed > tr > th:nth-child(6){
  min-width: 92px;
  width: 92px;
}
.tables-data .table > thead.is-fixed > tr > th:nth-child(7){
     min-width: 191px;
    width: 191px;
}
.tables-data .table > thead.is-fixed > tr > th:nth-child(8){
      min-width: 193px;
    width: 160px;
}
.tables-data .table > thead.is-fixed > tr > th:nth-child(9){
     min-width: 86px;
    width: 120px;
}
.tables-data .table > thead > tr > th .form-control{
    border: 0;
  }

  .dataTables_wrapper .dataTables_processing {
    position: absolute;
    top: 60px;
    left: 0;
    right: 0;
    width: 1325px;
    height: 40px;
    margin-left: auto;
    margin-right: auto;
    margin-top: -25px;
    padding-top: 0;
    text-align: center;
    font-size: 18px;
    height: 80px;
    z-index: 9;
    padding: 28px 0;

  }

  .closed_tb span{
    word-break: break-word;
  }

</style>
<div class="wrap margin-top-100 col-md-12">
    <div class="container-fuild">
        <div class="row">
            <div class="clearfix"></div>
            <div class="col-md-12 search-table-wrp">
                <form class="searchTable" action="{base_url('home/search_table')}" method="post">
                  <div class="col-md-12 no-padding tables-data">
                      <table class="table responsive table-striped no-padding display table-search-not"  id="example" >
                          <thead>
                              <tr>
                                  <th class="one"></th>
                                  <th class="two">
                                    <select class="form-control selectpicker show-menu-arrow product_type" multiple data-live-search="true" data-selected-text-format="count > 0" data-actions-box="true" title="Product Type"></select>
                                     <span class="mobile-responsive">Product Type</span>
                                  </th>
                                  <th class="three" data-priority="1">
                                    <input type="text" name="brand_name" class="form-control brand_name" placeholder="Brand Name">
                                     <span class="mobile-responsive">Brand Name</span>
                                  </th>
                                  <th class="four">
                                    <select class="form-control selectpicker show-menu-arrow select_content" multiple data-live-search="true" data-selected-text-format="count > 0" title="Content"></select>
                                     <span class="mobile-responsive">Content</span>
                                  </th>
                                  <th class="five">
                                    <select class="form-control selectpicker show-menu-arrow select_dossage" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Dosage form"></select>
                                     <span class="mobile-responsive">Dosage Form</span>
                                  </th>
                                  <th class="six">
                                    <select class="form-control selectpicker show-menu-arrow select_country" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Country"></select>
                                     <span class="mobile-responsive">Country</span>
                                  </th>
                                  <th class="seven">
                                    <select class="form-control selectpicker show-menu-arrow select_medical" multiple data-live-search="true" multiple data-actions-box="true" data-selected-text-format="count > 0" title="Medical Classification"></select>
                                     <span class="mobile-responsive">Medical Classification</span>
                                  </th>
                                  <th class="eight">
                                    <select class="form-control selectpicker show-menu-arrow select_company" multiple data-live-search="true" data-actions-box="true" data-selected-text-format="count > 0" title="Company"></select>
                                     <span class="mobile-responsive">Company</span>
                                  </th>
                                
                                  <th class="ten" ><a href="#" style="margin-left:8px">Operations</a></th>
                              </tr>
                          </thead>
                          <tbody>
                          
                          </tbody>
                      </table>
                  </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  {if isset($smarty.post.country)} 
    var countrypost = {$smarty.post.country};
  {literal}
  window.onload = function(e){
  setTimeout(function(){
     $('select.select_country').selectpicker('val', [countrypost]);
    $('.select_country').trigger('change');
  },1000);
   
  }
  {/literal}
    {/if}
</script>

<script>
  {literal}

   var top_offset1 = 72;
 var top_offset2 = 107;
 var top_offset3 = 132;
 var top_offset33 = 97;
if ($(".searchTable").length){

$(document).scroll(function() {

    var y = $(this).scrollTop();
     var w = $(window).width();
   
    if (w >= 768) {
        if (y > top_offset1) {
            $(".header .bottom-menu:first-child").addClass("is-fixed");
        } else {
            $(".header .bottom-menu:first-child").removeClass("is-fixed");
        }

         if (y > top_offset2) {
            $(".header .bottom-menu.advanced-menu").addClass("is-fixed");
        } else {
            $(".header .bottom-menu.advanced-menu").removeClass("is-fixed");
        }
       
         if ((y > top_offset33 && !$(".header .bottom-menu.advanced-menu").hasClass('is-shown')) || (y > top_offset3 && $(".header .bottom-menu.advanced-menu").hasClass('is-shown'))) {
          console.log(y+' 1');
            $('.searchTable #example thead').addClass("is-fixed");
            $('.searchTable #example tbody').css('border-top','70px solid #ddd');
           if($(".header .bottom-menu.advanced-menu").css('display') != 'none') {
             $('.searchTable #example thead').css('top','70px');
              $(".header .bottom-menu.advanced-menu").css('top','70px');
            }
        } else {
           console.log(y+' 2');
            $('.searchTable #example thead').removeClass("is-fixed");
            $('.searchTable #example tbody').css('border-top','none');
            $('.searchTable #example thead').css('top','35px');
              $(".header .bottom-menu.advanced-menu").css('top','35px');
        }


    }
});
}

  {/literal}
</script>
{/block}
