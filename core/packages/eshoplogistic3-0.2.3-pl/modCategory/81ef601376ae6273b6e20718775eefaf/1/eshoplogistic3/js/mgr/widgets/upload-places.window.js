eshoplogistic3.window.CreateForm = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'eshoplogistic3-place-window-create';
    }
    Ext.applyIf(config, {
        title: _('eshoplogistic3_unload_place_create'),
        width: 800,
        autoHeight: true,
        url: eshoplogistic3.config.connector_url,
        baseParams: {
            action: 'mgr/order/places',
            order_id: config.order_id,
            mode: 'create'
        },
        fields: this.getFields(config),
        keys: [{
            key: Ext.EventObject.ENTER, shift: true, fn: function () {
                this.submit()
            }, scope: this
        }]
    });
    eshoplogistic3.window.CreateForm.superclass.constructor.call(this, config);
}

Ext.extend(eshoplogistic3.window.CreateForm, MODx.Window, {
    getFields: function (config) {
        return [{
            layout: 'column',
            items: [{
                columnWidth: .2,
                layout: 'form',
                items: [{
                    xtype: 'textfield',
                    fieldLabel: _('eshoplogistic3_unload_place_article'),
                    name: 'article',
                    id: config.id + '-article',
                    anchor: '99%',
                    allowBlank: false
                }]
            },{
                columnWidth: .5,
                layout: 'form',
                items: [{
                    xtype: 'textfield',
                    fieldLabel: _('eshoplogistic3_unload_place_name'),
                    name: 'name',
                    id: config.id + '-name',
                    anchor: '99%',
                    allowBlank: false
                }]
            }, {
                columnWidth: .2,
                layout: 'form',
                items: [{
                    xtype: 'numberfield',
                    fieldLabel: _('eshoplogistic3_unload_place_price'),
                    name: 'price',
                    id: config.id + '-price',
                    anchor: '99%',
                    allowBlank: false
                }]
            }]
        }, {
            layout: 'column',
            items: [{
                columnWidth: .2,
                layout: 'form',
                items: [{
                    xtype: 'numberfield',
                    fieldLabel: _('eshoplogistic3_unload_place_count'),
                    name: 'count',
                    id: config.id + '-count',
                    anchor: '99%',
                    allowBlank: false
                }]
            }, {
                columnWidth: .2,
                layout: 'form',
                items: [{
                    xtype: 'numberfield',
                    fieldLabel: _('eshoplogistic3_unload_place_weight'),
                    name: 'weight',
                    id: config.id + '-weight',
                    anchor: '99%',
                    allowBlank: false
                }]
            }]
        }, {
            layout: 'column',
            items: [{
                columnWidth: .2,
                layout: 'form',
                items: [{
                    xtype: 'numberfield',
                    fieldLabel: _('eshoplogistic3_unload_place_length'),
                    name: 'length',
                    id: config.id + '-length',
                    anchor: '99%',
                    allowBlank: false
                }]
            }, {
                columnWidth: .2,
                layout: 'form',
                items: [{
                    xtype: 'numberfield',
                    fieldLabel: _('eshoplogistic3_unload_place_width'),
                    name: 'width',
                    id: config.id + '-width',
                    anchor: '99%',
                    allowBlank: false
                }]
            }, {
                columnWidth: .2,
                layout: 'form',
                items: [{
                    xtype: 'numberfield',
                    fieldLabel: _('eshoplogistic3_unload_place_height'),
                    name: 'height',
                    id: config.id + '-height',
                    anchor: '99%',
                    allowBlank: false
                }]
            }]
        }]
    }
})
Ext.reg('eshoplogistic3-place-window-create', eshoplogistic3.window.CreateForm)


eshoplogistic3.window.UpdateForm = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'eshoplogistic3-place-window-update';
    }
    Ext.applyIf(config, {
        title: _('eshoplogistic3_unload_place_update'),
        width: 950,
        autoHeight: true,
        url: eshoplogistic3.config.connector_url,
        baseParams: {
            action: 'mgr/order/places',
            order_id: config.order_id,
            mode: 'update'
        },
        fields: this.getFields(config),
        keys: [{
            key: Ext.EventObject.ENTER, shift: true, fn: function () {
                this.submit()
            }, scope: this
        }]
    });
    eshoplogistic3.window.UpdateForm.superclass.constructor.call(this, config);
}

Ext.extend(eshoplogistic3.window.UpdateForm, MODx.Window, {
    getFields: function (config) {
        return [{
            layout: 'column',
            items: [{
                columnWidth: .2,
                layout: 'form',
                items: [{
                    xtype: 'textfield',
                    fieldLabel: _('eshoplogistic3_unload_place_article'),
                    name: 'article',
                    id: config.id + '-article',
                    anchor: '99%',
                    allowBlank: false
                }]
            },{
                columnWidth: .5,
                layout: 'form',
                items: [{
                    xtype: 'textfield',
                    fieldLabel: _('eshoplogistic3_unload_place_name'),
                    name: 'name',
                    id: config.id + '-name',
                    anchor: '99%',
                    allowBlank: false
                }]
            }, {
                columnWidth: .2,
                layout: 'form',
                items: [{
                    xtype: 'numberfield',
                    fieldLabel: _('eshoplogistic3_unload_place_price'),
                    name: 'price',
                    id: config.id + '-price',
                    anchor: '99%',
                    allowBlank: false
                }]
            }]
        }, {
            layout: 'column',
            items: [{
                columnWidth: .2,
                layout: 'form',
                items: [{
                    xtype: 'numberfield',
                    fieldLabel: _('eshoplogistic3_unload_place_count'),
                    name: 'count',
                    id: config.id + '-count',
                    anchor: '99%',
                    allowBlank: false
                }]
            }, {
                columnWidth: .2,
                layout: 'form',
                items: [{
                    xtype: 'numberfield',
                    fieldLabel: _('eshoplogistic3_unload_place_weight'),
                    name: 'weight',
                    id: config.id + '-weight',
                    anchor: '99%',
                    allowBlank: false
                }]
            }]
        }, {
            layout: 'column',
            items: [{
                columnWidth: .2,
                layout: 'form',
                items: [{
                    xtype: 'numberfield',
                    fieldLabel: _('eshoplogistic3_unload_place_length'),
                    name: 'length',
                    id: config.id + '-length',
                    anchor: '99%',
                    allowBlank: false
                }]
            }, {
                columnWidth: .2,
                layout: 'form',
                items: [{
                    xtype: 'numberfield',
                    fieldLabel: _('eshoplogistic3_unload_place_width'),
                    name: 'width',
                    id: config.id + '-width',
                    anchor: '99%',
                    allowBlank: false
                }]
            }, {
                columnWidth: .2,
                layout: 'form',
                items: [{
                    xtype: 'numberfield',
                    fieldLabel: _('eshoplogistic3_unload_place_height'),
                    name: 'height',
                    id: config.id + '-height',
                    anchor: '99%',
                    allowBlank: false
                }]
            }]
        }]
    }
})

Ext.reg('eshoplogistic3-place-window-update', eshoplogistic3.window.UpdateForm)