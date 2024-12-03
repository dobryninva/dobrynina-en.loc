{if $data.price.value!}
    {*<p class="eShopLogistic-price">Стоимость доставки: <span>{$data.price.value} {$data.price.unit}</span></p>*}
    <p class="eShopLogistic-time">Срок доставки: <span>{$data.time.text}</span></p>
    <p class="eShopLogistic-service">Транспортная компания: <span>{$data.service.name}</span></p>
    {set $type = ($data.type == 'terminal') ? 'до пункта самовывоза' : 'курьер'}
    <p class="eShopLogistic-type">Тип доставки: <span>{$type}</span></p>
    {if $data.terminal.address?}<p class="eShopLogistic-terminal">Пункт самовывоза: <span>{$data.terminal.address}</span></p>{/if}
    {if $data.comment?}<p class="eShopLogistic-comment">Комментарий: <span>{$data.comment}</span></p>{/if}
{/if}