Ext.ComponentMgr.onAvailable('minishop2-window-order-update', function () {
    this.fields.items.push({
        xtype: 'eshoplogistic3-order-delivery-panel',
        title: _('eshoplogistic3_order_delivery_tab'),
        order_id: this.record.id || 0
    });
});