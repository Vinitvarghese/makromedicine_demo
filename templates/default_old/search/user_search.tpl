{extends file=$layout}
{block name=content}
<div class="wrap margin-top-100 col-md-12">
    <div class="container-fuild" style="width: 1324px;     margin: 0 auto;">
        <div class="row">
            <div class="clearfix"></div>
            <div class="col-md-12" style="padding-top:25px;padding-bottom:15px;">
              <div class="col-md-3 no-padding">
                <select class="selectpicker show-menu-arrow search_country_user" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 1" title="Country" style="width:100%;">
                   {if $countrys}{foreach from=$countrys item=country}
                   <option value="{$country->code}" data-group="{$group_id}" {if $country_id eq $country->id} selected="selected" {/if}>{$country->name}</option>
                   {/foreach}{/if}
                </select>
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12">
                <div class="col-md-12 no-padding ">
                  <table class="table table-bordered "  >
                    <thead>
                      <tr role="row">
                        <td rowspan="1" colspan="1" class="align-text white-back"></td>
                        <td colspan="6" class="align-text blue-back">WHO IS SEARCHING</td>
                        <td colspan="3" class="align-text red-back">SEARCHING FOR WHAT</td>
                      </tr>
                      <tr role="row">
                        <td></td>
                        <td class="align-text">Company</td>
                        <td class="align-text">Company person</td>
                        <td class="align-text">Country</td>
                        <td class="align-text align-width">Email</td>
                        <td class="align-text align-width">Phone</td>
                        <td class="align-text align-width">Website</td>
                        <td class="align-text">Product Type</td>
                        <td class="align-text">Status</td>
                        <td class="align-text">Standard</td>
                      </tr>
                    </thead>
                    <tbody>
                      {if isset($get_user) && !empty($get_user)}{foreach from=$get_user item=company}
                      <tr role="row">
                        <td class="closed_tb"><i class="fa fa-plus open_table"></i></td>
                        <td class="closed_tb align-text align-name"><a href="'{base_url("company/")}{$company->slug}">{$company->company_name}</a></td>
                        <td class="closed_tb align-text">{$company->fullname}</td>
                        <td class="closed_tb align-text align-width">
                          <center>
                              <a href="#" data-toggle="tooltip" data-placement="top" title="{get_country_name($company->country_id)}">
                                  <img src="{base_url('templates/default/assets/img/country/')}{get_country_code($company->country_id)}.png" alt="{get_country_name($company->country_id)}" class="table-img">
                              </a>
                          </center>
                        </td>
                        <td class="closed_tb align-text align-width"><a href="mailto:{$company->email}"><i class="fa fa-envelope"></i></a></td>
                        <td class="closed_tb align-text align-width"><a href="tel:{$company->phone}"><i class="fa fa-phone"></i></a></td>
                        <td class="closed_tb align-text align-width"><a href="{$company->website}" target="_blank"><i class="fa fa-globe"></i></a></td>
                        <td class="closed_tb ">
                          <span>
                            {if isset($pr)}
                              {foreach $pr.{$company->id} as $value}
                              {if !empty(get_product_type_name($value.product_type_id))}{get_product_type_name($value.product_type_id)},{/if}
                              {/foreach}
                            {/if}
                          </span>
                        </td>
                        <td class="closed_tb align-text">
                          <span>
                            {if isset($user_groups)}
                              {foreach $user_groups.{$company->id} as $value}
                              {if !empty(get_group_name($value.group_id))}{get_group_name($value.group_id)},{/if}
                              {/foreach}
                            {/if}
                          </span>
                        </td>
                        <td class="closed_tb align-text">
                          <span>
                            {if isset($user_standarts)}
                              {foreach $user_standarts.{$company->id} as $value}
                              {if !empty(get_standart_name($value.standart_id))}{get_standart_name($value.standart_id)},{/if}
                              {/foreach}
                            {/if}
                          </span>
                        </td>
                      </tr>
                      {/foreach}
                      {/if}
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
{literal}
<script>
  $(document).ready(function(){
     $('.search_country_user').change(function(){
       var value = $(this).val();
       var group_id = $(this).find(':selected').attr('data-group');
       window.location = site_url+'search/groups/'+value+'/'+group_id+'/';
     });
  });
</script>
{/literal}
{/block}
