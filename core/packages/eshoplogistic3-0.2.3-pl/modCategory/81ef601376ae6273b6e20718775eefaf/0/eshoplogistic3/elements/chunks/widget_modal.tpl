<button data-esl-widget data-title="Быстрый заказ с доставкой" class="my-3 btn btn-primary">Быстрый заказ с доставкой</button>
<div id="eShopLogisticWidgetModal" {if $widget_controller?}data-controller="{$widget_controller}"{/if}
     data-key="{$widget_key}"
     data-lazy-load="true"
     data-ip="{$.server.REMOTE_ADDR}"
     data-offers='{$offers}'>
</div>
<script src="https://api.esplc.ru/widgets/modal/app.js"></script>