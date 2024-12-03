<div id="eShopLogisticWidgetBlock" {if $widget_controller?}data-controller="{$widget_controller}"{/if}
     data-key="{$widget_key}"
     data-lazy-load="true"
     data-ip="{$.server.REMOTE_ADDR}"
     data-offers='{$offers}'>
</div>
<script src="https://api.esplc.ru/widgets/block/app.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // активация виджета при переходе на вкладку «Доставка»
        document.getElementById('pills-product-2-tab').addEventListener('click', event => {
            document.getElementById('eShopLogisticWidgetBlock').dispatchEvent(new CustomEvent('eShopLogisticWidgetBlock:loadApp'))
        })
    })
</script>