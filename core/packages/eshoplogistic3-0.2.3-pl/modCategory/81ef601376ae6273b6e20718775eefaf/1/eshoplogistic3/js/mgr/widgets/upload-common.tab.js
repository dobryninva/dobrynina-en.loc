eshoplogistic3.panel.UnloadCommon = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'eshoplogistic3-upload-common-panel';
    }
    Ext.applyIf(config, {
        layout: 'form',
        cls: 'main-wrapper',
        defaults: {msgTarget: 'under', border: false},
        anchor: '100% 100%',
        border: false,
        items: this.getFields(config),
        listeners: {
            afterrender: function() {
                this.setData(),
                this.getPlaces(config)
            }
        },
    });

    eshoplogistic3.panel.UnloadCommon.superclass.constructor.call(this, config)
}

Ext.extend(eshoplogistic3.panel.UnloadCommon, MODx.Panel, {

    setData: function() {
        Ext.getCmp('esl-unload-terminal-code').setValue(this.config.data.terminal.code)
        Ext.getCmp('esl-unload-terminal-address').setValue(this.config.data.terminal.address)
        Ext.getCmp('esl-unload-price').setValue(this.config.data.price)
    },

    getFields: function (config) {
        let fields = [{
            layout: 'column',
            items: [{
                columnWidth: .3,
                layout: 'form',
                items: [{
                    fieldLabel: _('eshoplogistic3_delivery_type'),
                    xtype: 'eshoplogistic3-combo-delivery-type',
                    anchor: '90%',
                    allowBlank: false,
                    value: config.data.type
                }],
            }, {
                columnWidth: .2,
                layout: 'form',
                items: [{
                    xtype: 'textfield',
                    fieldLabel: _('eshoplogistic3_unload_terminal_code'),
                    name: 'terminal-code',
                    id: 'esl-unload-terminal-code',
                    anchor: '99%',
                    allowBlank: true
                }]
            }, {
                columnWidth: .5,
                layout: 'form',
                items: [{
                    xtype: 'textfield',
                    fieldLabel: _('eshoplogistic3_unload_terminal_address'),
                    name: 'terminal-address',
                    id: 'esl-unload-terminal-address',
                    anchor: '99%',
                    allowBlank: true
                }]
            }]
        }, {
            layout: 'column',
            items: [{
                columnWidth: .3,
                layout: 'form',
                items: [{
                    fieldLabel: _('eshoplogistic3_unload_payment-type'),
                    xtype: 'eshoplogistic3-combo-payment-type',
                    anchor: '90%',
                    allowBlank: false
                }],
            }, {
                columnWidth: .2,
                layout: 'form',
                items: [{
                    fieldLabel: _('eshoplogistic3_unload_price'),
                    xtype: 'numberfield',
                    id: 'esl-unload-price',
                    anchor: '90%',
                    allowBlank: false
                }],
            }]
        }, {
            layout: 'column',
            items: [{
                columnWidth: 1,
                layout: 'form',
                items: [{
                    xtype: 'textarea',
                    fieldLabel: _('eshoplogistic3_upload_common_comment'),
                    name: 'comment',
                    id: config.id + '-comment',
                    anchor: '99%',
                    allowBlank: true
                }]
            }]
        }]

        if(typeof config.data.tariff == 'object') {
            fields.push({
                layout: 'column',
                items: [{
                    columnWidth: 1,
                    layout: 'form',
                    items: [{
                        fieldLabel: _('eshoplogistic3_unload_tariff'),
                        xtype: 'eshoplogistic3-combo-tariff',
                        anchor: '90%',
                        order_type: config.data.order_type,
                        tariff: config.data.tariff,
                        service: config.data.service.code,
                        allowBlank: false
                    }]
                }]
            })
        }

        if(config.data.service.code == 'delline') {
            fields.push({
                layout: 'column',
                items: [{
                    columnWidth: 0.2,
                    layout: 'form',
                    items: [{
                        xtype: 'datefield',
                        format: 'Y-m-d',
                        fieldLabel: _('eshoplogistic3_delline_produce_date'),
                        name: 'produce_date',
                        id: 'esl-unload-produce_date',
                        anchor: '99%',
                        allowBlank: true
                    }]
                }, {
                    columnWidth: 0.4,
                    layout: 'form',
                    items: [{
                        fieldLabel: _('eshoplogistic3_delline_counterparty'),
                        xtype: 'eshoplogistic3-combo-counterparty',
                        service: 'delline',
                        anchor: '90%',
                        allowBlank: false
                    }]
                }, {
                    columnWidth: 0.4,
                    layout: 'form',
                    items: [{
                        fieldLabel: _('eshoplogistic3_delline_contact'),
                        xtype: 'eshoplogistic3-combo-contact',
                        service: 'delline',
                        anchor: '90%',
                        allowBlank: false
                    }]
                }]
            })
        }

        if(typeof config.data.boxberry_order_type == 'number' && typeof config.data.boxberry_packing_type == 'number') {
            fields.push({
                layout: 'column',
                items: [{
                    columnWidth: 0.5,
                    layout: 'form',
                    items: [{
                        fieldLabel: _('eshoplogistic3_boxberry_order_type'),
                        xtype: 'eshoplogistic3-combo-order-type-boxberry',
                        anchor: '90%',
                        order_type: config.data.boxberry_order_type,
                        allowBlank: false
                    }]
                }, {
                    columnWidth: 0.5,
                    layout: 'form',
                    items: [{
                        fieldLabel: _('eshoplogistic3_boxberry_boxberry_packing_type'),
                        xtype: 'eshoplogistic3-combo-packing-type-boxberry',
                        anchor: '90%',
                        packing_type: config.data.boxberry_packing_type,
                        allowBlank: false
                    }]
                }]
            })
        }

        return fields
    },
    
    
    getPlaces: function (config) {
        MODx.Ajax.request({
            url: eshoplogistic3.config.connector_url,
            params: {
                action: 'mgr/order/places',
                mode: 'get',
                order_id: config.order_id,
                id: id
            },
            listeners: {
                success: {
                    fn: function (r) {
                        console.log(r)
                    }, scope: this
                }
            }
        })
    }

})

Ext.reg('eshoplogistic3-upload-common-panel', eshoplogistic3.panel.UnloadCommon)