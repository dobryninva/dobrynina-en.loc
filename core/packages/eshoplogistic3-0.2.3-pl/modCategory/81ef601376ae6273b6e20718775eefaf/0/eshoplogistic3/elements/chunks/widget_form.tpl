<div id="eShopLogisticWidgetForm" class="eshoplogistic-widget-calculate"
     {if $widget_controller?}data-controller="{$widget_controller}"{/if}
    {*data-from="Москва" data-dimensions="25*15*10" data-price="1500" data-weight="1"*}
     data-lazy-load="false"
     data-ip="{$.server.REMOTE_ADDR}"
     data-title="Расчёт доставки"
     data-key="{$widget_key}">
</div>
<script src="https://api.esplc.ru/widgets/form/app.js"></script>