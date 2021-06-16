{if isset($UserData->approved) && $UserData->approved==0}
    <div class="col-md-12 no-padding show_alert_if_company_not_approved yellow_verify">
        <div class="product_center full_height">
            <div class="full_width full_height flex align_center ">
                <p>Сonfirmation from administrator is awaiting</p>
            </div>
        </div>
    </div>
{/if}