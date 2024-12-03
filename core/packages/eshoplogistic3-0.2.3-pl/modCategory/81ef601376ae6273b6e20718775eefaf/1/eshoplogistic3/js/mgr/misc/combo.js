eshoplogistic3.combo.Settlement = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        id: 'eshoplogistic3-combo-settlement',
        fieldLabel: _('eshoplogistic3_' + config.name || 'combo-settlement'),
        fields: ['id', 'pagetitle', 'parents'],
        valueField: 'id',
        displayField: 'pagetitle',
        name: config.name || 'resource-category',
        hiddenName: config.name || 'resource-category',
        allowBlank: false,
        url: eshoplogistic3.config['connector_url'],
        baseParams: {
            action: 'mgr/order/search',
            combo: true,
            id: config.value
        },
        tpl: new Ext.XTemplate(''
            +'<tpl for="."><div class="x-combo-list-item eshoplogistic3-settlement-list-item">'
            +'<span><b>{settlement}</b>, {type}, {region}</span><tpl if="parents"><div class="parents"><tpl for="parents"><nobr><small>{pagetitle} / </small></nobr></tpl></div></tpl>'
            +'</div></tpl>', {compiled: true}),
        pageSize: 10,
        itemSelector: 'div.eshoplogistic3-settlement-list-item',
        emptyText: _('no'),
        editable: true,
    });
    eshoplogistic3.combo.Settlement.superclass.constructor.call(this, config);
};
Ext.extend(eshoplogistic3.combo.Settlement, MODx.combo.ComboBox);
Ext.reg('eshoplogistic3-combo-settlement', eshoplogistic3.combo.Settlement);


eshoplogistic3.combo.Tariff = function (config) {
    config = config || {};

    Ext.applyIf(config, {
        id: 'eshoplogistic3-combo-tariff',
        fieldLabel: _('eshoplogistic3_' + config.name || 'combo-tariff'),
        displayField: 'name',
        valueField: 'code',
        name: config.name || 'tariff',
        hiddenName: config.name || 'tariff',
        mode: 'remote',
        store: new Ext.data.JsonStore({
            root: 'results',
            autoLoad: true,
            autoSave: false,
            autoSelect:true,
            fields: ['code', 'name'],
            url: eshoplogistic3.config['connector_url'],
            baseParams: {
                action: 'mgr/order/tariff',
                combo: true,
                type: config.order_type,
                service: config.service,
                tariff: config.tariff.code
            },
        }),
        pageSize: 10,
        typeAhead: false,
        editable: false,
        forceSelection: true,
        allowBlank: false,
        emptyText: _('no'),
        listeners: {
            afterrender: function(combo) {
                this.setValue(config.tariff.code)
                this.setRawValue(config.tariff.name)
            }
        }
    })

    eshoplogistic3.combo.Tariff.superclass.constructor.call(this, config)
};
Ext.extend(eshoplogistic3.combo.Tariff, MODx.combo.ComboBox)
Ext.reg('eshoplogistic3-combo-tariff', eshoplogistic3.combo.Tariff)


eshoplogistic3.combo.Counterparty = function (config) {
    config = config || {};

    Ext.applyIf(config, {
        id: 'eshoplogistic3-combo-counterparty',
        fieldLabel: _('eshoplogistic3_' + config.name || 'combo-counterparty'),
        displayField: 'name',
        valueField: 'code',
        name: config.name || 'counterparty',
        hiddenName: config.name || 'counterparty',
        mode: 'remote',
        store: new Ext.data.JsonStore({
            root: 'results',
            autoLoad: true,
            autoSave: false,
            autoSelect:true,
            fields: ['code', 'name'],
            url: eshoplogistic3.config['connector_url'],
            baseParams: {
                action: 'mgr/order/counterparties',
                combo: true,
                type: 'counterparties',
                service: config.service
            }
        }),
        pageSize: 10,
        typeAhead: false,
        editable: false,
        forceSelection: true,
        allowBlank: false,
        emptyText: _('no')
    })

    eshoplogistic3.combo.Counterparty.superclass.constructor.call(this, config)
};
Ext.extend(eshoplogistic3.combo.Counterparty, MODx.combo.ComboBox)
Ext.reg('eshoplogistic3-combo-counterparty', eshoplogistic3.combo.Counterparty)



eshoplogistic3.combo.Contact = function (config) {
    config = config || {};

    Ext.applyIf(config, {
        id: 'eshoplogistic3-combo-contact',
        fieldLabel: _('eshoplogistic3_' + config.name || 'combo-contact'),
        displayField: 'name',
        valueField: 'code',
        name: config.name || 'contact',
        hiddenName: config.name || 'contact',
        mode: 'remote',
        store: new Ext.data.JsonStore({
            root: 'results',
            autoLoad: true,
            autoSave: false,
            autoSelect:true,
            fields: ['code', 'name'],
            url: eshoplogistic3.config['connector_url'],
            baseParams: {
                action: 'mgr/order/counterparties',
                combo: true,
                type: 'contacts',
                service: config.service
            }
        }),
        pageSize: 10,
        typeAhead: false,
        editable: false,
        forceSelection: true,
        allowBlank: false,
        emptyText: _('no')
    })
    eshoplogistic3.combo.Contact.superclass.constructor.call(this, config)
}
Ext.extend(eshoplogistic3.combo.Contact, MODx.combo.ComboBox)
Ext.reg('eshoplogistic3-combo-contact', eshoplogistic3.combo.Contact)



function setTerminal (mode) {
    const terminalCode = Ext.getCmp('esl-unload-terminal-code'),
        terminalAddress = Ext.getCmp('esl-unload-terminal-address')
    if(mode === 'door') {
        terminalCode.hide()
        terminalAddress.hide()
    }
    else {
        terminalCode.show()
        terminalAddress.show()
    }
}


eshoplogistic3.combo.DeliveryType = function(config) {
	config = config || {};
    Ext.applyIf(config, {
        store: new Ext.data.ArrayStore({
            id: 0,
            fields: ['id','value'],
            data: [
                ['door', 'Курьер'],
                ['terminal', 'Пункт самовывоза']
            ]
        }),
        mode: 'local',
		hiddenName: 'delivery_type',
        displayField: 'value',
        valueField: 'id',
        listeners: {
            'afterrender': function(combo){
                const _self = this
                combo.store.data.keys.forEach(function(item, i) {
                    if(item == config.value) {
                        _self.setValue(combo.store.data.keys[i])
                    }
                })
                setTerminal(config.value)
            },
            select: function(combo) {
                setTerminal(combo.value)
            }
        }
    })
    eshoplogistic3.combo.DeliveryType.superclass.constructor.call(this, config)
}
Ext.extend(eshoplogistic3.combo.DeliveryType, MODx.combo.ComboBox)
Ext.reg('eshoplogistic3-combo-delivery-type', eshoplogistic3.combo.DeliveryType)


function setPickupFields (mode) {
    const pickup_rows_0 = Ext.getCmp('esl_pick_up_row_0'),
        pickup_rows_1 = Ext.getCmp('esl_pick_up_row_1'),
        pickup_rows_2 = Ext.getCmp('esl_pick_up_row_2'),
        pickup_rows_3 = Ext.getCmp('esl_pick_up_row_3'),
        pickup_rows_4 = Ext.getCmp('esl_pick_up_row_4')

    if(mode === 0) {
        pickup_rows_2.hide()
        pickup_rows_3.hide()
        pickup_rows_4.hide()
        pickup_rows_0.show()
        pickup_rows_1.show()
    }
    else {
        pickup_rows_2.show()
        pickup_rows_3.show()
        pickup_rows_4.show()
        pickup_rows_0.hide()
        pickup_rows_1.hide()
    }
}

eshoplogistic3.combo.Pickup = function(config) {
    config = config || {};
    Ext.applyIf(config, {
        store: new Ext.data.ArrayStore({
            id: 0,
            fields: ['id','value'],
            data: [
                [0, _('eshoplogistic3_unload_pick_up_no')],
                [1, _('eshoplogistic3_unload_pick_up_yes')]
            ]
        }),
        mode: 'local',
        hiddenName: 'pick_up',
        displayField: 'value',
        valueField: 'id',
        listeners: {
            'afterrender': function(combo){
                this.setValue(config.pick_up ?? 0) //combo.store.data.keys[0]
                setPickupFields(combo.value)
            },
            select: function(combo) {
                setPickupFields(combo.value)
            }
        }
    })
    eshoplogistic3.combo.Pickup.superclass.constructor.call(this, config)
}
Ext.extend(eshoplogistic3.combo.Pickup, MODx.combo.ComboBox)
Ext.reg('eshoplogistic3-combo-pick_up', eshoplogistic3.combo.Pickup)


eshoplogistic3.combo.PaymentType = function(config) {
    config = config || {};
    Ext.applyIf(config, {
        store: new Ext.data.ArrayStore({
            id: 0,
            fields: ['id','value'],
            data: [
                ['already_paid', _('eshoplogistic3_payment_already_paid')],
                ['cash_on_receipt', _('eshoplogistic3_payment_cash_on_receipt')],
                ['card_on_receipt', _('eshoplogistic3_payment_card_on_receipt')],
                ['cashless', _('eshoplogistic3_payment_cashless')]
            ]
        }),
        mode: 'local',
        hiddenName: 'payment_type',
        displayField: 'value',
        valueField: 'id'
    })
    eshoplogistic3.combo.PaymentType.superclass.constructor.call(this, config)
}
Ext.extend(eshoplogistic3.combo.PaymentType, MODx.combo.ComboBox)
Ext.reg('eshoplogistic3-combo-payment-type', eshoplogistic3.combo.PaymentType)


eshoplogistic3.combo.AdditionalType = function(config) {
    Ext.applyIf(config, {
        id: 'eshoplogistic3-combo-additional-type',
        fieldLabel: _('eshoplogistic3_' + config.name || 'combo-additional-type'),
        displayField: 'name',
        valueField: 'code',
        name: config.name || 'additional-type',
        hiddenName: config.name || 'additional-type',
        mode: 'remote',
        store: new Ext.data.JsonStore({
            root: 'results',
            autoLoad: true,
            autoSave: false,
            autoSelect:true,
            fields: ['code', 'name'],
            url: eshoplogistic3.config['connector_url'],
            baseParams: {
                action: 'mgr/order/additional',
                combo: true,
                mode: 'list_type',
                order_id: config.order_id,
                service: config.service
            },
        }),
        pageSize: 10,
        typeAhead: false,
        editable: false,
        forceSelection: true,
        allowBlank: false,
        emptyText: _('no'),
        listeners: {
            select: {
                fn: function (combo, a, b) {
                    const cmp = Ext.getCmp('eshoplogistic3-combo-additional-item')
                    cmp.getStore().baseParams['type'] = combo.getValue()
                    cmp.store.removeAll()
                    cmp.store.load()
                    cmp.reset()
                    cmp.setValue('')
                }, scope: this,
            }
        }
    })
    eshoplogistic3.combo.AdditionalType.superclass.constructor.call(this, config)
}
Ext.extend(eshoplogistic3.combo.AdditionalType, MODx.combo.ComboBox)
Ext.reg('eshoplogistic3-combo-additional-type', eshoplogistic3.combo.AdditionalType)


eshoplogistic3.combo.Additional = function(config) {
    Ext.applyIf(config, {
        id: 'eshoplogistic3-combo-additional',
        fieldLabel: _('eshoplogistic3_' + config.name || 'combo-additional'),
        displayField: 'name',
        valueField: 'code',
        name: config.name || 'additional',
        hiddenName: config.name || 'additional',
        mode: 'remote',
        store: new Ext.data.JsonStore({
            root: 'results',
            autoLoad: true,
            autoSave: false,
            autoSelect:true,
            fields: ['code', 'name'],
            url: eshoplogistic3.config['connector_url'],
            baseParams: {
                action: 'mgr/order/additional',
                combo: true,
                mode: 'list_item',
                order_id: config.order_id,
                service: config.service,
                type: ''
            },
        }),
        pageSize: 10,
        typeAhead: false,
        editable: false,
        forceSelection: true,
        allowBlank: false,
        emptyText: _('no')
    })
    eshoplogistic3.combo.Additional.superclass.constructor.call(this, config)
}
Ext.extend(eshoplogistic3.combo.Additional, MODx.combo.ComboBox)
Ext.reg('eshoplogistic3-combo-additional', eshoplogistic3.combo.Additional)


eshoplogistic3.combo.orderTypeBoxberry = function(config) {
    config = config || {};
    Ext.applyIf(config, {
        store: new Ext.data.ArrayStore({
            id: 0,
            fields: ['id','value'],
            data: [
                [0, _('eshoplogistic3_boxberry_order_type_0')],
                [2, _('eshoplogistic3_boxberry_order_type_2')],
                [3, _('eshoplogistic3_boxberry_order_type_3')],
                [5, _('eshoplogistic3_boxberry_order_type_5')]
            ]
        }),
        mode: 'local',
        hiddenName: 'order_type',
        displayField: 'value',
        valueField: 'id',
        listeners: {
            'afterrender': function(){
                this.setValue(config.order_type)
            }
        }
    })
    eshoplogistic3.combo.orderTypeBoxberry.superclass.constructor.call(this, config)
}
Ext.extend(eshoplogistic3.combo.orderTypeBoxberry, MODx.combo.ComboBox)
Ext.reg('eshoplogistic3-combo-order-type-boxberry', eshoplogistic3.combo.orderTypeBoxberry)

eshoplogistic3.combo.packingTypeBoxberry = function(config) {
    config = config || {};
    Ext.applyIf(config, {
        store: new Ext.data.ArrayStore({
            id: 1,
            fields: ['id','value'],
            data: [
                [1, _('eshoplogistic3_boxberry_packing_type_1')],
                [2, _('eshoplogistic3_boxberry_packing_type_2')]
            ]
        }),
        mode: 'local',
        hiddenName: 'packing_type',
        displayField: 'value',
        valueField: 'id',
        listeners: {
            'afterrender': function(){
                this.setValue(config.packing_type)
            }
        }
    })
    eshoplogistic3.combo.packingTypeBoxberry.superclass.constructor.call(this, config)
}
Ext.extend(eshoplogistic3.combo.packingTypeBoxberry, MODx.combo.ComboBox)
Ext.reg('eshoplogistic3-combo-packing-type-boxberry', eshoplogistic3.combo.packingTypeBoxberry)