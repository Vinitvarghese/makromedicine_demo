{extends file=$layout}
{block name=content}
<style>

  table.dataTable.no-footer{
        table-layout: fixed;
    width: 100%;
    max-width: 100%;
  }
</style>
<div class="clearfix"></div>
<div class="wrap margin-top-100 col-md-12">
    <div class="container">
        <div class="row">
            <div class="clearfix"></div>
            <div class="col-md-12" id="profile">
              <div id="myModal" class="modal fade" role="dialog" style="z-index:999999999999999;">
                 <div class="modal-dialog">
                     <div class="modal-content">
                         <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">REGİSTRATİON</h4>
                         </div>
                         <div class="modal-body">
                            <p>Register to view more options</p>
                         </div>
                         <div class="modal-footer">
                            <button type="button" class="btn btn-info" onclick="window.location='{base_url()}'">Register</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                         </div>
                     </div>
                 </div>
              </div>
                <div class="col-md-12 no-padding">
                    <div class="col-md-3 no-padding profile-left">
                        <div class="left-sidebar">
                            <div class="round-image">
                                <img src="{$company_images}" alt="">
                            </div>
                            <div class="followers">
                                <h4>FOLLOWERS: <a href="#" data-user-id="{$company->id}" class="my_followers"><span>{$user_followers}</span></a> </h4>
                                <h4>FOLLOWING: <a href="#" data-user-id="{$company->id}" class="my_following"><span>{$user_following}</span></a> </h4>
                            </div>
                            <div class="profile-menu">
                              <center>
                                <div class="btn-group">
                                  {if $is_loggedin neq false}
                                  <button type="button" class="btn btn-warning" onclick="window.location='{base_url('messages/')}{$company->id}'"> <i class="fa fa-envelope-o"></i> </button>
                                  {/if}
                                  {if $check_follow > 0}
                                  <button type="button" id="follow-button" class="btn btn-success" user-id="{$company->id}" {if $is_loggedin eq false} follow-status="0" {else} follow-status="1" {/if}>Following</button>
                                  {else}
                                  <button type="button" id="follow-button" class="btn btn-info {if $is_loggedin eq false} triggerSignup{/if}" user-id="{$company->id}" {if $is_loggedin eq false} follow-status="0" {else} follow-status="1" {/if} >+ Follow</button>
                                  {/if}
                                </div>
                              </center>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 profile-right no-padding-right">
                        <form class="userSettings" action="{base_url()}profile/save" enctype="multipart/form-data" method="post">
                            <div class="right-content">
                                <div class="col-md-12">
                                    <h1 class="main-info-title">PROFILE VIEW</h1>
                                </div>
                                <div class="col-md-12 no-padding right-content-inner">
                                  {if !empty($company->company_name)}
                                  <div class="form-group">
                                      <div class="col-md-3">
                                          <label for="">Company Name</label>
                                      </div>
                                      <div class="col-md-9">
                                          <p>{$company->company_name}</p>
                                      </div>
                                      <div class="clearfix"></div>
                                  </div>
                                  {/if}
                                    {if !empty($company->group_name)}
                                  <div class="form-group">
                                      <div class="col-md-3">
                                          <label for="">Company Status</label>
                                      </div>
                                      <div class="col-md-9">
                                          <p>{$company->group_name}</p>
                                      </div>
                                      <div class="clearfix"></div>
                                  </div>
                                  {/if}
                                  {if !empty($company->establishment_date)}
                                  <div class="form-group">
                                      <div class="col-md-3">
                                          <label for="">Establishment date</label>
                                      </div>
                                      <div class="col-md-9">
                                          <p>{$company->establishment_date}</p>
                                      </div>
                                      <div class="clearfix"></div>
                                  </div>
                                  {/if}
                                  {if !empty($company->tags)}
                                  <div class="form-group">
                                      <div class="col-md-3">
                                          <label for="">Tags</label>
                                      </div>
                                      <div class="col-md-9">
                                          <p>{$company->tags}</p>
                                      </div>
                                      <div class="clearfix"></div>
                                  </div>
                                  {/if}
                                  {if !empty($company->company_info)}
                                  <div class="form-group">
                                      <div class="col-md-3">
                                          <label for="">Company Info</label>
                                      </div>
                                      <div class="col-md-9">
                                          <p>{$company->company_info}</p>
                                      </div>
                                      <div class="clearfix"></div>
                                  </div>
                                  {/if}
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="right-content">
                                <div class="col-md-12">
                                    <h1 class="main-info-title">Contact Information</h1>
                                </div>
                                <div class="col-md-12 no-padding right-content-inner">
                                  {if !empty($company->phone)}
                                  <div class="form-group">
                                      <div class="col-md-3">
                                          <label for="">Phone</label>
                                      </div>
                                      <div class="col-md-9">
                                          <p>{$company->phone}</p>
                                      </div>
                                      <div class="clearfix"></div>
                                  </div>
                                  {/if}
                                   {if !empty($company->email) and $is_loggedin}
                                  <div class="form-group">
                                      <div class="col-md-3">
                                          <label for="">E-mail</label>
                                      </div>
                                      <div class="col-md-9">
                                          <p>{$company->email}</p>
                                      </div>
                                      <div class="clearfix"></div>
                                  </div>
                                  {/if}
                                  {if !empty($company->adress)}
                                  <div class="form-group">
                                      <div class="col-md-3">
                                          <label for="">Address</label>
                                      </div>
                                      <div class="col-md-9">
                                          <p>{$company->adress}</p>
                                      </div>
                                      <div class="clearfix"></div>
                                  </div>
                                  {/if}
                                  {if !empty($company->lat) && !empty($company->lng)}
                                  <div class="form-group">
                                      <div class="col-md-3">
                                          <label for="">Map</label>
                                      </div>
                                      <div class="col-md-9">
                                          <div id="map"></div>
                                      </div>
                                      <div class="clearfix"></div>
                                  </div>
                                  {/if}
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                         
                             <div class="right-content">
                                <div class="col-md-12">
                                    <h1 class="main-info-title" id="company_products">Products</h1>
                                </div>

                                          <div class="col-md-12 no-padding right-content-inner">
                                    <table class="table table-striped no-padding table-search-not" id="companyTable">
                                      <thead>
                                        <tr>
                                          
                                <th class="column_type two no-sort">Product type </th>

                                <th class="column_name three no-sort" >Brand name</a></th>

                                <th class="column_content four no-sort">Content </th>

                                <th class="column_form five no-sort" >Dosage form</th>

                       
                                <th class="column_medical seven no-sort" >Medical Classification </th>

                               
                                </tr>
                                      </thead>
                                    <tbody>
                                      {if $products}
                                          {foreach from=$products item=product}

                                           {$atc_code = json_decode($product->atc_code)}
                                          {$herbal = json_decode($product->herbal)}
                                          {$animals = json_decode($product->animal)}
                                          {$casNumbers = json_decode($product->cas)}

                                          {$defaultname = ''}
                                        {if count($atc_code) > 0}

                                            {foreach $atc_code as $atc}
                                            {$defaultname=get_atc_code_name($atc->id)}-
                                           
                                            {/foreach}

                                        {else if count($herbal) > 0}

                                            {foreach $herbal as $herb}

                                                {$defaultname = get_herbal_name($herb->id)}- 

                                            {/foreach}

                                         {else if count($animals) > 0}

                                            {foreach $animals as $animal}

                                               {$defaultname = get_animal_name($animal->id)} -
                                            {/foreach}


                                          {else if count($casNumbers) > 0}

                                            {foreach $casNumbers as $casss}
                                                
                                             {$casformule = get_cas_formula($casss->id)}
                                             {$casname = get_cas_name($casss->id)}
                                             {if $casformule && $casformule !='' && !empty($casformule) && !is_null($casformule)}
                                            
                                                {$defaultname = "`$defaultname`-`$casformule`"}
                                             
                                              {else}
                                                {$defaultname = "`$defaultname`-`$casname`"}
                                              
                                             {/if}
                                  
                                            {/foreach}

                                        {/if}
                                        {$defaultname = ltrim($defaultname,'-')}
                                              <tr>
                                                <td class="closed_tb two"><p>{get_product_type_name($product->pr_type)}</p></td>
                                                <td class="closed_tb three"><a href="{site_url_multi('product/view/')}{$product->id}{if $product->alias}-{$product->alias}{/if}">{if $product->title}{$product->title}{else}{$defaultname}{/if}</a></td>
                                                <td class="closed_tb four">
                                                   <span>
                                       

                                        {if count($atc_code) > 0}

                                            {foreach $atc_code as $atc}
                                            {$atccodename=get_atc_code_name($atc->id)}
                                            {assign var="sturl" value="search/?title=&button=&search_type=3&atc_classifiction%5B%5D=`$atccodename`&event_type=&start=&end="}
                                               <a href="{base_url($sturl)}"><b> {get_atc_code_no($atc->id)}</b></a> {$atc->mdoza} {get_unit_name($atc->vdoza)}
                                            {/foreach}

                                        {/if}



                                     

                                        {if count($herbal) > 0}

                                            {foreach $herbal as $herb}

                                                {get_herbal_name($herb->id)} {$herb->mdoza} {get_unit_name($herb->vdoza)}

                                            {/foreach}

                                        {/if}



                                        

                                        {if count($animals) > 0}

                                            {foreach $animals as $animal}

                                                {get_animal_name($animal->id)} {$animal->mdoza} {get_unit_name($animal->vdoza)}

                                            {/foreach}

                                        {/if}



                                        

                                        {if count($casNumbers) > 0}

                                            {foreach $casNumbers as $casss}
                                              
                                               {assign var="sturl" value="search/?title=&button=&search_type=3&casno%5B%5D=`$casss->id`&event_type=&start=&end="}

                                           <a href="{base_url($sturl)}"><b>{get_cas_name($casss->id)}</b></a>
                                {$unitname=$casss->mdoza} {get_unit_name($casss->vdoza)}
                                {if trim($unitname)!='' && trim($unitname)!='0'}
                                <span>{$unitname}</span><br>
                                {/if}

                                            {/foreach}

                                        {/if}
                                        </span>
                                                </td>
                                         <td class="closed_tb five">

                                        {$var = json_decode($product->packing_type)}

                                        {if count($var) > 0}

                                            {$f = json_decode(json_encode($var[0]))}

                                            {get_packing_type_name($f->id)} {if $f->mdoza2 neq 0}{$f->mdoza2}{/if} {get_unit_name($f->vdoza2)} {if $f->mdoza neq 0}{$f->mdoza}{/if} {get_drug_type_code($f->vdoza)}

                                        {/if}

                                    </td>


                                    <td class="closed_tb seven">
                                      <span>
                                      {if !empty($product->medical_cl)} {foreach get_selected_medical($product->medical_cl) as $key=>$value} {$value->name}, {/foreach} {/if}
                                      </span>
                                    </td>

                                  
                                              </tr>     
                                          {/foreach}
                                      {/if}
                                      </tbody>
                                  </table>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXX757Qw5m5_tjb2VxaeyRZ34T-IID2ok" type="text/javascript"></script>
<script>
    var lat = {if $company->lat} {$company->lat} {else} 40.9540 {/if};
    var lng = {if $company->lng} {$company->lng} {else} 40.9540 {/if};
    var company_name =  "{$company->company_name}";
    {literal}
    function initMap(getId)
    {
        if(document.getElementById(getId))
        {
            let locations = [
               [company_name, lat , lng, 1 ]
            ];
            let map = new google.maps.Map(document.getElementById(getId), {
                zoom: 12,
                center: {lat: locations[0][1], lng: locations[0][2]}
            });
            for(let i = 0; i < locations.length ; i++)
            {
                let marker = new google.maps.Marker({
                    position:{lat: locations[i][1], lng: locations[i][2]},
                    map:map,
                    animation: google.maps.Animation.DROP
                });
                marker.addListener('click', toggleBounce);
            }
        }
    }
    function toggleBounce() {
        if (marker.getAnimation() !== null){
            marker.setAnimation(null);
        }else{
            marker.setAnimation(google.maps.Animation.BOUNCE);
        }
    }
    initMap("map");
    google.maps.event.addDomListener(window, "load", initMap);
    $(document).ready(function(){
        $("#follow-button").click(function(){
            var user_id       = $(this).attr('user-id');
            var follow_status = $(this).attr('follow-status');
            if(follow_status == 1)
            {
                if ($("#follow-button").text() == "+ Follow"){
                    $.ajax({
                        type:'POST',
                        url:site_url+'follow/follow/',
                        data: {'user_id':user_id},
                        cache:true,
                        success:function(data){
                          $("#follow-button").removeClass('btn-info');
                          $("#follow-button").addClass('btn-success');
                          $("#follow-button").text("Following");
                          toastr.success('Follow successful !');
                          window.location = '';
                        }
                    });
                }else{
                  $.ajax({
                      type:'POST',
                      url:site_url+'follow/unfollow/',
                      data: {'user_id':user_id},
                      cache:true,
                      success:function(data){
                        $("#follow-button").addClass('btn-info');
                        $("#follow-button").removeClass('btn-success');
                        $("#follow-button").text("+ Follow");
                        toastr.warning('Unfollow successful !');
                        window.location = '';
                      }
                  });

                }
            }
            else
            {
              //  $("#myModal").modal();
            }
        });
   });
   {/literal}
</script>


<script>
  {literal}
  $(document).ready(function() {
    
    var table = $('#companyTable').DataTable({
        dom: 'lrtip',
        bPaginate: true,
        bLengthChange: false,
        pageLength: 15,
        bFilter: true,
        bInfo: false,
        ordering: false,
       
    });

  });

  {/literal}
</script>
{/block}
