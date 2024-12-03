eshoplogistic3.window.AdditionalCreateForm = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'eshoplogistic3-additional-window-create';
    }
    Ext.applyIf(config, {
        title: _('eshoplogistic3_unload_additional_create'),
        width: 800,
        autoHeight: true,
        url: eshoplogistic3.config.connector_url,
        baseParams: {
            action: 'mgr/order/additional',
            order_id: config.order_id,
            service: config.data.service.code,
            mode: 'create'
        },
        fields: this.getFields(config),
        keys: [{
            key: Ext.EventObject.ENTER, shift: true, fn: function () {
                this.submit()
            }, scope: this
        }]
    })

    eshoplogistic3.window.AdditionalCreateForm.superclass.constructor.call(this, config)

    this.on('hide', function() {
        let w = this;
        window.setTimeout(function() {
            w.close()
        }, 300)
    })
}

Ext.extend(eshoplogistic3.window.AdditionalCreateForm, MODx.Window, {
    getFields: function (config) {
        return [{
            layout: 'column',
            items: [{
                columnWidth: .2,
                layout: 'form',
                items: [{
                    xtype: 'eshoplogistic3-combo-additional-type',
                    fieldLabel: _('eshoplogistic3_unload_additional_type'),
                    name: 'type',
                    order_id: config.order_id,
                    service: config.data.service.code,
                    id: 'eshoplogistic3-combo-additional-type',
                    anchor: '99%',
                    allowBlank: false
                }]
            },{
                columnWidth: .6,
                layout: 'form',
                items: [{
                    xtype: 'eshoplogistic3-combo-additional',
                    fieldLabel: _('eshoplogistic3_unload_additional_name'),
                    name: 'code',
                    id: 'eshoplogistic3-combo-additional-item',
                    order_id: config.order_id,
                    service: config.data.service.code,
                    anchor: '99%',
                    allowBlank: false
                }]
            }, {
                columnWidth: .2,
                layout: 'form',
                items: [{
                    xtype: 'numberfield',
                    fieldLabel: _('eshoplogistic3_unload_additional_count'),
                    name: 'count',
                    id: config.id + '-count',
                    anchor: '99%',
                    allowBlank: false
                }]
            }]
        }]
    }
})
Ext.reg('eshoplogistic3-additional-window-create', eshoplogistic3.window.AdditionalCreateForm)


eshoplogistic3.window.AdditionalUpdateForm = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'eshoplogistic3-additional-window-update';
    }
    Ext.applyIf(config, {
        title: _('eshoplogistic3_unload_additional_update'),
        width: 600,
        autoHeight: true,
        url: eshoplogistic3.config.connector_url,
        baseParams: {
            action: 'mgr/order/additional',
            order_id: config.order_id,
            service: config.data.service.code,
            mode: 'update'
        },
        fields: this.getFields(config),
        keys: [{
            key: Ext.EventObject.ENTER, shift: true, fn: function () {
                this.submit()
            }, scope: this
        }]
    });
    eshoplogistic3.window.AdditionalUpdateForm.superclass.constructor.call(this, config);
}
Ext.extend(eshoplogistic3.window.AdditionalUpdateForm, MODx.Window, {
    getFields: function (config) {
        return [{
            xtype: 'hidden',
            name: 'code',
            id: config.id + '-code',
        }, {
            layout: 'column',
            items: [{
                columnWidth: .6,
                layout: 'form',
                items: [{
                    xtype: 'textfield',
                    fieldLabel: _('eshoplogistic3_unload_additional_name'),
                    name: 'name',
                    id: config.id + '-name',
                    anchor: '99%',
                    readOnly: true
                }]
            }, {
                columnWidth: .2,
                layout: 'form',
                items: [{
                    xtype: 'numberfield',
                    fieldLabel: _('eshoplogistic3_unload_additional_count'),
                    name: 'count',
                    id: config.id + '-count',
                    anchor: '99%',
                    allowBlank: false
                }]
            }]
        }]
    }
})

Ext.reg('eshoplogistic3-additional-window-update', eshoplogistic3.window.AdditionalUpdateForm)