eshoplogistic3.window.Edit = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'eshoplogistic3-window-delivery-edit';
    }
    Ext.applyIf(config, {
        title: _('eshoplogistic3-delivery-edit'),
        width: 900,
        autoHeight: true,
        url: eshoplogistic3.config.connector_url,
        fields: this.getFields(config),
        keys: [{
            key: Ext.EventObject.ENTER, shift: true, fn: function () {
                this.submit()
            }, scope: this
        }],
        beforeLoad: function () {
            document.getElementById('eShopLogisticWidgetBlock').style.display = 'none'
        },
        beforeDestroy: function () {
            const root = document.getElementById('eShopLogisticWidgetBlock')
            if(root) {
                document.body.appendChild(document.getElementById('eShopLogisticWidgetBlock'))
            }
        },
        buttons: [{
            text: _('eshoplogistic3_delivery_edit_close'),
            handler: function() {
                this.hide()
            }, scope: this
        }, {
            text: '<i class="icon icon-edit"></i> ' + _('eshoplogistic3_order_delivery_edit'),
            cls: 'primary-button',
            handler: function() {
                this.submit(config)
            }, scope: this
        }],
        listeners: {
            render: {
                fn: this.setData, scope: this
            }
        }
    })

    eshoplogistic3.window.Edit.superclass.constructor.call(this, config);

    this.on('hide', function() {
        let w = this;
        window.setTimeout(function() {
            w.close()
        }, 300)
    })
};
Ext.extend(eshoplogistic3.window.Edit, MODx.Window, {

    submit: function (config) {
        const el = this.getEl(),
            _self = this,
            fieldData = Ext.getCmp('esl_widget_delivery_data'),
            settlementData = Ext.getCmp('esl_widget_delivery_settlement_data')

        el.mask(_('loading'),'x-mask-loading')

        MODx.Ajax.request({
            url: eshoplogistic3.config.connector_url,
            params: {
                action: 'mgr/order/delivery',
                order_id: config.order_id,
                data: fieldData.getValue(),
                settlement: settlementData.getValue()
            },
            listeners: {
                success: {
                    fn:function(response) {
                        Ext.Msg.alert(_('eshoplogistic3_delivery_edit_success'), response.message)
                        el.unmask()
                       setTimeout(function () {
                           window.location.reload()
                        }, 1500)
                    }, scope: this
                },
                failure: {
                    fn: function (response) {
                        Ext.Msg.alert(_('eshoplogistic3_delivery_edit_fail'), response.message)
                        el.unmask()
                    }, scope: this
                }
            }
        })
    },

    setData: function() {

        const  el = this.getEl(),
            _self = this,
            offersField = Ext.getCmp('esl_widget_delivery_offers'),
            keyField = Ext.getCmp('esl_widget_delivery_key'),
            widgetButton = Ext.getCmp('eslWidgetRun'),
            widgetInfo = Ext.getCmp('esl_widget_delivery_info')

        MODx.Ajax.request({
            url: eshoplogistic3.config.connector_url,
            params: {
                action: 'mgr/order/getwidgetdata',
                order_id: this.config.order_id
            },
            listeners: {
                success: {
                    fn:function(response) {
                        offersField.setValue(response.offers)
                        keyField.setValue(response.key)
                        el.unmask()
                    }, scope: this
                },
                failure: {
                    fn: function (response) {
                        widgetButton.hide()
                        //Ext.Msg.alert(_('eshoplogistic3_data_fail'),response.message)
                        widgetInfo.setValue(response.message)
                        el.unmask()
                    }, scope: this
                }
            }
        })
    },

    getFields: function (config) {
        let fields = [{
            xtype: 'textfield',
            name: 'delivery_widget_settlement_data',
            id: 'esl_widget_delivery_settlement_data',
            hidden: true,
            width: '100%'
        },{
                xtype: 'textfield',
                name: 'delivery_widget_data',
                id: 'esl_widget_delivery_data',
                hidden: true,
                width: '100%'
            }, {
                html: '<div class="delivery-edit-info">'+_('eshoplogistic3_delivery_edit_info')+'</div>'
            }, {
                html: '<div id="widgetContainer"></div>'
            }, {
                xtype: 'textfield',
                name: 'delivery_widget_key',
                id: 'esl_widget_delivery_key',
                hidden: true,
                width: '100%'
            }, {
                xtype: 'textfield',
                name: 'delivery_widget_offers',
                id: 'esl_widget_delivery_offers',
                hidden: true,
                width: '100%'
            }, {
                xtype: "button",
                id: "eslWidgetRun",
                type: "button",
                cls: 'x-btn-noicon primary-button',
                style:'padding: 8px 20px 10px',
                text: 'Запуск виджета'
            }, {
                layout: 'column',
                items: [
                    {
                        columnWidth: .4,
                        layout: 'form',
                        items: [{
                            fieldLabel: _('eshoplogistic3_delivery_edit_settlement'),
                            id: "esl_widget_delivery_settlement",
                            xtype: 'textfield',
                            anchor: '90%',
                            readOnly: true
                        }]
                    }, {
                        columnWidth: .3,
                        layout: 'form',
                        items: [{
                            fieldLabel: _('eshoplogistic3_delivery_edit_service'),
                            xtype: 'textfield',
                            id: "esl_widget_delivery_service",
                            anchor: '90%',
                            readOnly: true
                        }]
                    }, {
                        columnWidth: .3,
                        layout: 'form',
                        items: [{
                            fieldLabel: _('eshoplogistic3_delivery_edit_type'),
                            xtype: 'textfield',
                            id: "esl_widget_delivery_type",
                            anchor: '90%',
                            readOnly: true
                        }]
                    }
                ]
            }, {
            layout: 'column',
            items: [
                {
                    columnWidth: .2,
                    layout: 'form',
                    items: [{
                        fieldLabel: _('eshoplogistic3_delivery_edit_price'),
                        id: "esl_widget_delivery_price",
                        xtype: 'textfield',
                        anchor: '90%',
                        readOnly: true
                    }]
                }, {
                    columnWidth: .2,
                    layout: 'form',
                    items: [{
                        fieldLabel: _('eshoplogistic3_delivery_edit_time'),
                        xtype: 'textfield',
                        id: "esl_widget_delivery_time",
                        anchor: '90%',
                        readOnly: true
                    }]
                }, {
                    columnWidth: .6,
                    layout: 'form',
                    items: [{
                        fieldLabel: _('eshoplogistic3_delivery_edit_pvz'),
                        xtype: 'textfield',
                        id: "esl_widget_delivery_pvz",
                        anchor: '90%',
                        readOnly: true
                    }]
                }
            ]
        }

            /*, {
                layout: 'column',
                items: [{
                    columnWidth: .4,
                    layout: 'form',
                    items: [{
                        fieldLabel: _('eshoplogistic3_search'),
                        xtype: 'eshoplogistic3-combo-settlement',
                        anchor: '90%',
                        allowBlank: false
                    }]
                }, {
                    columnWidth: .2,
                    layout: 'form',
                    items: [{
                        fieldLabel: _('eshoplogistic3_deliveryservice'),
                        xtype: 'eshoplogistic3-combo-service',
                        anchor: '90%',
                        allowBlank: false
                    }]
                }, {
                    columnWidth: .3,
                    layout: 'form',
                    items: [{
                        fieldLabel: _('eshoplogistic3_deliverytype'),
                        xtype: 'eshoplogistic3-combo-deliverytype',
                        anchor: '90%',
                        allowBlank: false
                    }]
                }, {
                    columnWidth: .1,
                    layout: 'form',
                    items: [{
                        xtype: "button",
                        type: "submit",
                        cls: 'x-btn-noicon primary-button',
                        style:'margin-top: 30px;padding: 8px 20px 10px',
                        text: '<i class="icon icon-arrow-right"></i>', //_('eshoplogistic3_get_delivery_data'),
                        handler: function () {
                            console.log('run')
                        }
                    }]
                }]
            }, {
                layout: 'column',
                items: [{
                    columnWidth: .3,
                    layout: 'form',
                    items: [{
                        xtype: 'textfield',
                        fieldLabel: _('eshoplogistic3_get_delivery_price'),
                        name: 'delivery_price',
                        disabled: true,
                        id: config.id + '-delivery_price',
                        anchor: '90%',
                        allowBlank: true
                    }]
                }, {
                    columnWidth: .3,
                    layout: 'form',
                    items: [{
                        xtype: 'textfield',
                        fieldLabel: _('eshoplogistic3_get_delivery_time'),
                        name: 'delivery_time',
                        disabled: true,
                        id: config.id + '-delivery_time',
                        anchor: '90%',
                        allowBlank: true
                    }]
                }, {
                    columnWidth: .4,
                    layout: 'form',
                    items: [{
                        xtype: 'eshoplogistic3-combo-deliveryterminal',
                        fieldLabel: _('eshoplogistic3_get_delivery_terminal'),
                        anchor: '90%',
                        allowBlank: true
                    }]
                }]
            }*/
        ]
        return fields
    },


});
Ext.reg('eshoplogistic3-window-delivery-edit', eshoplogistic3.window.Edit);