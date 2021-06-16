{extends file=$layout}
{block name=content}
    <link rel="stylesheet" href="{base_url('templates/default/assets/css/prefix-style.css')}" media="all">
    <style>
    table {
      width: 100%;
      border: none;
      border-top: 1px solid #EEEEEE;
      font-family: arial, sans-serif;
      border-collapse: collapse;
    }

    td,
    th {
      border: 1px solid #EEEEEE;
      border-top: none;
      text-align: left;
      padding: 8px;
      color: #363D41;
      font-size: 14px;
    }

    tr {
      background-color: #fff;
      border: none;
      cursor: pointer;
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      justify-content: flex-start;
    }

    tr:first-child:hover {
      cursor: default;
      background-color: #fff;
    }

    tr:hover {
      background-color: #EEF4FD;
    }

    .expanded-row-content {
      border-top: none;
      display: grid;
      grid-column: 1/-1;
      justify-content: flex-start;
      color: #AEB1B3;
      font-size: 13px;
      background-color: #fff;
    }

    .hide-row {
      display: none;
    }
  </style>

  {include file='../_partial/approve_waiting_line.tpl'}

    <div class="n_content_area interest_container full_width">
    <a href="#" id="openMenu" class="public-menu-float">Menu</a>
        <div class="container-fluid">
            <div class="row">
                {include file='../company/public-company-sidebar.tpl'}
                <div class="n_right_section decrease_padding start_with_text">
                    <div class="with_buttons full_width">
                        <h2>INTEREST</h2>
                        <!--<a href="#" class="n_green_col">Add Products</a>-->
                    </div>
                    
                    <div class="scroll_table_n full_width lst_tbl">
                    {$key=0}
                        {if $interests}
                    <table>
                    <tr>
                      <th>Product type</th>
                      <th>Status</th>
                      <th>Standart</th>
                      <th>Continent</th>
                      <th>Country</th>
                    </tr>
                    {foreach $interests as $key => $your_interests}
                    <tr onClick='toggleRow(this)'>
                      <td>
                        {$product_type_array = explode(',', $your_interests['product_type'])}
                        {if $product_types}{foreach from=$product_types key=k item=product_type}
                            {if $k>1}
                                {break}
                            {/if}
                            {if in_array($product_type->id, $product_type_array)} {$product_type->name}, {/if}
                        {/foreach}{/if}
                      </td>
                      <td>
                        {$status_array = explode(',', $your_interests['status'])}
                        {if $groups}{foreach from=$groups key=k item=group}
                            {if $k>1}
                                {break}
                            {/if}
                            {if in_array($group->id, $status_array)} {$group->name}, {/if}
                        {/foreach}{/if}
                      </td>
                      <td>
                        {$standart_array = explode(',', $your_interests['standart'])}
                        {if $standarts}{foreach from=$standarts key=k item=standart}
                            {if $k > 1}
                                {break}
                            {/if}
                           {if in_array($standart->id, $standart_array)} {$standart->name}, {/if}
                        {/foreach}{/if}
                      </td>
                      <td>
                        {$continent_array = explode(',', $your_interests['continent'])}
                        {if $continents}{foreach from=$continents key=k item=continent}
                            {if $k==1}
                                {break}
                            {/if}
                            {if in_array($continent->code, $continent_array)} {$continent->name}, {/if}
                        {/foreach}...{/if}
                      </td>
                      <td>
                        {$country_array = explode(',', $your_interests['country'])}
                        {if $countrys}{foreach from=$countrys key=k item=country}
                            {if $k==1}
                                {break}
                            {/if}
                            {if in_array($country->id, $country_array)} {$country->name} {/if}
                        {/foreach}...{/if}

                          <i class="fa interest_open_close fa-plus"></i>
                      </td>
                      <td class='expanded-row-content hide-row'>
                        <table>
                            <tr>
                            <td>
                            {$product_type_array = explode(',', $your_interests['product_type'])}
                            {if $product_types}{foreach from=$product_types item=product_type}
                                {if in_array($product_type->id, $product_type_array)} {$product_type->name}, {/if}
                            {/foreach}{/if}
                          </td>
                          <td>
                            {$status_array = explode(',', $your_interests['status'])}
                            {if $groups}{foreach from=$groups item=group}
                                {if in_array($group->id, $status_array)} {$group->name}, {/if}
                            {/foreach}{/if}
                          </td>
                          <td>
                            {$standart_array = explode(',', $your_interests['standart'])}
                            {if $standarts}{foreach from=$standarts item=standart}
                               {if in_array($standart->id, $standart_array)} {$standart->name}, {/if}
                            {/foreach}{/if}
                          </td>
                          <td>
                            {$continent_array = explode(',', $your_interests['continent'])}
                            {if $continents}{foreach from=$continents item=continent}
                                {if in_array($continent->code, $continent_array)} {$continent->name}, {/if}
                            {/foreach}{/if}
                          </td>
                          <td>
                            {$country_array = explode(',', $your_interests['country'])}
                            {if $countrys}{foreach from=$countrys item=country}
                                {if in_array($country->id, $country_array)} {$country->name}, {/if}
                            {/foreach}{/if}
                          </td>
                            </tr>
                        </table>
                      </td>
                    </tr>   
                    {/foreach}             
                  </table>
                {else}
                  <p class="text-center flex result_not_found">Result not found</p>
                {/if}
                    </div>
                </div><!-- /.right_section -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->

    </div><!-- /.n_content_area -->

    <script>
    const toggleRow = (element) => {
      element.getElementsByClassName('expanded-row-content')[0].classList.toggle('hide-row');
      $(element).find('.interest_open_close').toggleClass('fa-plus fa-minus');
    }
  </script>

{/block}
