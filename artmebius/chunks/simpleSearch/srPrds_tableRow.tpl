<tr class="prds_block shk-item">
  <td class="prds_title">
    <a class="item_link" href="[[+link]]" title="[[+pagetitle:replace=`"=='`]]" [[+link_attributes]]>[[+menutitle:default=`[[+pagetitle]]`]]</a>
  </td>
[[-
  <td class="prds_prop prds_units">[[+units]]</td>
-]]
  <td class="prds_prop prds_price"><span class="price_value shk-price">[[+price:num_format]]</span> <span class="price_currency fa fa-rub">[[-++shk3.currency]]</span></td>
  <td class="prds_buy">
    [[+template:is=`10`:then=`
    <form action="[[~[[*id]]]]" method="post" class="orderSubmitForm">
      <button type="submit" class="btn-link">Купить</button>
      <input type="hidden" name="shk-id" value="[[+id]]" />
      <input type="hidden" name="shk-name" value="[[+pagetitle:replace=`"=='`]]" />
    </form>
    `]]
    [[-<a href="javascript:void(0);" data-toggle="modal" data-target="#orderProduct" data-title="[[+menutitle:default=`[[+pagetitle]]`]]" class="btn-modal">Заказать</a>]]
  </td>
</tr>