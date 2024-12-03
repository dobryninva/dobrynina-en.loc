eshoplogistic3.panel.OrderDelivery = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'eshoplogistic3-order-delivery-panel';
    }
    Ext.applyIf(config, {
        layout: 'form',
        cls: 'main-wrapper',
        defaults: {msgTarget: 'under', border: false},
        anchor: '100% 100%',
        border: false,
        url: eshoplogistic3.config.connector_url,
        items: this.getFields(config),
        buttonAlign: 'left',
        buttons: [{
            text: '<i class="icon icon-edit"></i> ' + _('eshoplogistic3_order_delivery_edit'),
            handler: function() {
                this.change(config)
            }, scope: this
        }, {
            text: '<i class="icon icon-upload"></i> ' + _('eshoplogistic3_order_unload'),
            id: 'esl-btn-order-unload',
            style: 'display:none',
            handler: function() {
                this.unload(config)
            }, scope: this
        }, {
            text: '<i class="icon icon-print"></i> ' + _('eshoplogistic3_order_print'),
            id: 'esl-button-print_form',
            style: 'display:none',
            handler: function() {
                this.getPrintForm(config)
            }, scope: this
        }],
        listeners: {
            afterrender: function() {
                this.getData(config)
            }
        },
        pageSize:10,
        paging: true,
        remoteSort: true,
        autoHeight: true,
        data: {}
    });
    
    eshoplogistic3.panel.OrderDelivery.superclass.constructor.call(this, config);
};

Ext.extend(eshoplogistic3.panel.OrderDelivery, MODx.Panel, {

    change: function(config) {
        let w = MODx.load({
            xtype: 'eshoplogistic3-window-delivery-edit',
            order_id: config.order_id
        })
        w.reset()
        w.show()
    },

    unload: function(config) {
        if(!this.data.allow_unload ) {
            Ext.Msg.alert(_('eshoplogistic3_order_unload_fail'), _('eshoplogistic3_unload_disabled'))
        } else {
            let w = MODx.load({
                xtype: 'eshoplogistic3-window-delivery-unload',
                order_id: config.order_id,
                data: this.data
            })
            w.reset()
            w.show()
        }
    },

    getPrintForm: function(config) {
        const _self = this
        MODx.Ajax.request({
            url: eshoplogistic3.config.connector_url,
            params: {
                action: 'mgr/order/print',
                order_id: config.order_id,
                service: _self.data.service.code
            },
            listeners: {
                success: {
                    fn: function (response) {
                        Ext.Msg.alert(_('eshoplogistic3_order_print_success'), response.result.message)
                    }, scope: this
                },
                failure: {
                    fn: function (response) {
                        Ext.Msg.alert(_('eshoplogistic3_data_fail'), response.message)
                    }, scope: this
                }
            }
        })
    },



    getData: function(config) {

        const _self = this,
            fields = ['price', 'base_price', 'time', 'service', 'mode', 'type', 'terminal', 'order_id', 'order_number', 'order_state', 'order_state_code', 'order_cost', 'order_tracking']

	    MODx.Ajax.request({
            url: eshoplogistic3.config.connector_url,
            params: {
		        action: 'mgr/order/order',
                order_id: config['order_id'] || 0,
            },
            listeners: {
		        success: {
                    fn: function (response) {

                        _self.data = response.delivery

                        for (var i in fields) {
                            if (!fields.hasOwnProperty(i)) {
                                continue;
                            }
                            if(typeof response.delivery[fields[i]] !== 'undefined') {
                                const elem = Ext.getCmp('eshoplogistic3-order-delivery-' + fields[i])
                                let value = ''
                                if(fields[i] == 'terminal') {
                                    value = response.delivery[fields[i]].text
                                }
                                else if(fields[i] == 'service') {
                                    value = response.delivery[fields[i]].name
                                }
                                else {
                                    value = response.delivery[fields[i]]
                                }

                                if (elem) {

                                    elem.setValue(value)

                                    if(fields[i] == 'order_id' && value !== '-') {
                                        Ext.getCmp('esl-button-print_form').setDisabled(false)
                                    }
                                }
                            }
                        }

                        if(typeof response.delivery.order === 'object') {
                            if (response.delivery.order.create) {
                                Ext.get('esl-btn-order-unload').setStyle({display: 'inline-block', width: 'auto'})
                            }
                            if (response.delivery.order.print) {
                                Ext.get('esl-button-print_form').setStyle({display: 'inline-block', width: 'auto'})
                            }
                        }

                    }, scope: this
		        }
            }
	    })
    },



    orderStatus: function() {
        MODx.Ajax.request({
            url: eshoplogistic3.config.connector_url,
            params: {
                action: 'mgr/order/getstatus',
                order_id: this.config['order_id'] || 0,
            },
            listeners: {
                success: {
                    fn: function (response) {
                        Ext.Msg.alert(_('eshoplogistic3_order_status_message_success'), response.result.message)
                        Ext.getCmp('eshoplogistic3-order-delivery-order_number').setValue(response.result.order_number)
                        Ext.getCmp('eshoplogistic3-order-delivery-order_state').setValue(response.result.order_state)
                        Ext.getCmp('eshoplogistic3-order-delivery-order_state_code').setValue(response.result.order_state_code)
                        Ext.getCmp('eshoplogistic3-order-delivery-order_cost').setValue(response.result.order_cost)
                        Ext.getCmp('eshoplogistic3-order-delivery-order_tracking').setValue(response.result.order_tracking)
                    }
                },
                failure: {
                    fn: function (response) {
                        Ext.Msg.alert(_('eshoplogistic3_data_fail'), response.message)
                    }, scope: this
                }
            }
        })
    },



    getFields: function (config) {
        return [{
            layout: 'column',
            items: [{
                columnWidth: .2,
                layout: 'form',
                items: [{
                    xtype: 'textfield',
                    id: 'eshoplogistic3-order-delivery-price',
                    readOnly: true,
                    anchor: '99%',
                    fieldLabel: _('eshoplogistic3_order_delivery_info_price')
                }]
            }, {
                columnWidth: .2,
                layout: 'form',
                items: [{
                    xtype: 'textfield',
                    id: 'eshoplogistic3-order-delivery-base_price',
                    readOnly: true,
                    anchor: '99%',
                    fieldLabel: _('eshoplogistic3_order_delivery_info_base_price')

                }]
            },{
                columnWidth: .2,
                layout: 'form',
                items: [{
                    xtype: 'textfield',
                    id: 'eshoplogistic3-order-delivery-time',
                    readOnly: true,
                    anchor: '99%',
                    fieldLabel: _('eshoplogistic3_order_delivery_info_time')
                }]
            }]
        }, {
            layout: 'column',
            items: [{
                columnWidth: .5,
                layout: 'form',
                items: [{
                    xtype: 'textfield',
                    id: 'eshoplogistic3-order-delivery-service',
                    readOnly: true,
                    anchor: '99%',
                    fieldLabel: _('eshoplogistic3_order_delivery_info_service')
                }]
            }, {
                columnWidth: .5,
                layout: 'form',
                items: [{
                    xtype: 'textfield',
                    id: 'eshoplogistic3-order-delivery-mode',
                    readOnly: true,
                    anchor: '99%',
                    fieldLabel: _('eshoplogistic3_order_delivery_info_mode')
                }]
            }]
        },{
            layout: 'column',
            items: [{
                columnWidth: 1,
                layout: 'form',
                items: [{
                    xtype: 'textfield',
                    id: 'eshoplogistic3-order-delivery-terminal',
                    readOnly: true,
                    fieldLabel: _('eshoplogistic3_order_delivery_info_pvz'),
                    anchor: '99%'
                }]
            }]
        }, {
            layout: 'column',
            items: [{
                columnWidth: 1,
                layout: 'form',
                items: [{
                    html: '<hr><h4>'+_('eshoplogistic3_order_delivery_order_text')+'</h4>',
                    style: 'margin-top:25px'
                }]
            }]
        }, {
            layout: 'column',
            items: [{
                columnWidth: 0.5,
                layout: 'form',
                items: [{
                    xtype: 'textfield',
                    id: 'eshoplogistic3-order-delivery-order_id',
                    readOnly: true,
                    anchor: '99%',
                    fieldLabel: _('eshoplogistic3_order_delivery_order_id')
                }]
            }, {
                columnWidth: 0.5,
                layout: 'form',
                items: [{
                    xtype: 'textfield',
                    id: 'eshoplogistic3-order-delivery-order_number',
                    readOnly: true,
                    anchor: '99%',
                    fieldLabel: _('eshoplogistic3_order_delivery_order_number')
                }]
            }]
        }, {
            layout: 'column',
            items: [{
                columnWidth: 0.3,
                layout: 'form',
                items: [{
                    xtype: 'textfield',
                    id: 'eshoplogistic3-order-delivery-order_state_code',
                    readOnly: true,
                    anchor: '99%',
                    fieldLabel: _('eshoplogistic3_order_delivery_order_state_code')
                }]
            }, {
                columnWidth: 0.7,
                layout: 'form',
                items: [{
                    xtype: 'textfield',
                    id: 'eshoplogistic3-order-delivery-order_state',
                    readOnly: true,
                    anchor: '99%',
                    fieldLabel: _('eshoplogistic3_order_delivery_order_state')
                }]
            }]
        }, {
            layout: 'column',
            items: [{
                columnWidth: 0.2,
                layout: 'form',
                items: [{
                    xtype: 'textfield',
                    id: 'eshoplogistic3-order-delivery-order_cost',
                    readOnly: true,
                    anchor: '99%',
                    fieldLabel: _('eshoplogistic3_order_delivery_order_cost')
                }]
            }, {
                columnWidth: 0.8,
                layout: 'form',
                items: [{
                    xtype: 'textfield',
                    id: 'eshoplogistic3-order-delivery-order_tracking',
                    readOnly: true,
                    anchor: '99%',
                    fieldLabel: _('eshoplogistic3_order_delivery_order_tracking')
                }]
            }]
        }, {
            layout: 'column',
            items: [{
                columnWidth: 1,
                layout: 'form',
                items: [{
                    xtype: 'button',
                    style: 'margin-top:10px',
                    text: '<i class="icon icon-refresh"></i> ' + _('eshoplogistic3_order_status_update'),
                    handler: function () {
                        this.orderStatus()
                    }, scope: this
                }]
            }]
        }, {
            html: '<hr>',
            style: 'margin-top:25px'
        }]
    }

    
});
Ext.reg('eshoplogistic3-order-delivery-panel', eshoplogistic3.panel.OrderDelivery);
