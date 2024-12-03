eshoplogistic3.panel.UnloadReceiver = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'eshoplogistic3-upload-receiver-panel';
    }
    Ext.applyIf(config, {
        layout: 'form',
        cls: 'main-wrapper',
        defaults: { msgTarget: 'under', border: false },
        anchor: '100% 100%',
        border: false,
        items: this.getFields(config),
        listeners: {
            afterrender: function() {
                this.setData()
            }
        }
    })

    eshoplogistic3.panel.UnloadReceiver.superclass.constructor.call(this, config)
};

Ext.extend(eshoplogistic3.panel.UnloadReceiver, MODx.Panel, {

    setData: function() {
        Ext.getCmp('esl-unload-receiver-name').setValue(this.config.data.receiver.name)
        Ext.getCmp('esl-unload-receiver-email').setValue(this.config.data.receiver.email)
        Ext.getCmp('esl-unload-receiver-phone').setValue(this.config.data.receiver.phone)
        Ext.getCmp('esl-unload-receiver-region').setValue(this.config.data.receiver.address.region)
        Ext.getCmp('esl-unload-receiver-city').setValue(this.config.data.receiver.address.city)
        Ext.getCmp('esl-unload-receiver-street').setValue(this.config.data.receiver.address.street)
        Ext.getCmp('esl-unload-receiver-house').setValue(this.config.data.receiver.address.house)
        Ext.getCmp('esl-unload-receiver-room').setValue(this.config.data.receiver.address.room)
		Ext.getCmp('esl-unload-receiver-index').setValue(this.config.data.receiver.address.index)
        Ext.getCmp('esl-unload-sender-region').setValue(this.config.data.sender.address.region)
        Ext.getCmp('esl-unload-sender-city').setValue(this.config.data.sender.address.city)
        Ext.getCmp('esl-unload-sender-street').setValue(this.config.data.sender.address.street)
        Ext.getCmp('esl-unload-sender-house').setValue(this.config.data.sender.address.house)
        Ext.getCmp('esl-unload-sender-room').setValue(this.config.data.sender.address.room)
        Ext.getCmp('esl-unload-sender-terminal').setValue(this.config.data.sender.terminal)
        Ext.getCmp('esl-unload-sender-index').setValue(this.config.data.sender.address.index)
    },

    getFields: function (config) {

        let fields =  [{
            layout: 'column',
            items: [{
                columnWidth: 1,
                layout: 'form',
                items: [{html: '<h3>' + _('eshoplogistic3_unload_receiver_text') + '</h3>'}]
            }]
        }, {
            layout: 'column',
            items: [{
                columnWidth: .4,
                layout: 'form',
                items: [{
                    fieldLabel: _('eshoplogistic3_name'),
                    xtype: 'textfield',
                    anchor: '90%',
                    allowBlank: false,
                    name: 'receiver-name',
                    id: 'esl-unload-receiver-name',
                }]
            }, {
                columnWidth: .3,
                layout: 'form',
                items: [{
                    xtype: 'textfield',
                    fieldLabel: _('eshoplogistic3_email'),
                    name: 'receiver-email',
                    id: 'esl-unload-receiver-email',
                    anchor: '99%',
                    allowBlank: true
                }]
            }, {
                columnWidth: .3,
                layout: 'form',
                items: [{
                    xtype: 'textfield',
                    fieldLabel: _('eshoplogistic3_phone'),
                    name: 'receiver-phone',
                    id: 'esl-unload-receiver-phone',
                    anchor: '99%',
                    allowBlank: false
                }]
            }]
        }, {
            layout: 'column',
            items: [{
                columnWidth: 1,
                layout: 'form',
                items: [{
                    html: '<h5>' + _('eshoplogistic3_unload_receiver_address_text') + '</h5>',
                    style: 'margin-top: 15px'
                }]
            }]
        }, {
            layout: 'column',
            items: [{
                columnWidth: .3,
                layout: 'form',
                items: [{
                    fieldLabel: _('eshoplogistic3_region'),
                    xtype: 'textfield',
                    anchor: '90%',
                    allowBlank: true,
                    name: 'receiver-region',
                    id: 'esl-unload-receiver-region',
                }]
            }, {
                columnWidth: .3,
                layout: 'form',
                items: [{
                    xtype: 'textfield',
                    fieldLabel: _('eshoplogistic3_city'),
                    name: 'receiver-city',
                    id: 'esl-unload-receiver-city',
                    anchor: '99%',
                    allowBlank: true
                }]
            }, {
                columnWidth: .4,
                layout: 'form',
                items: [{
                    xtype: 'textfield',
                    fieldLabel: _('eshoplogistic3_street'),
                    name: 'receiver-street',
                    id: 'esl-unload-receiver-street',
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
                    fieldLabel: _('eshoplogistic3_house'),
                    xtype: 'textfield',
                    anchor: '90%',
                    allowBlank: true,
                    name: 'receiver-house',
                    id: 'esl-unload-receiver-house',
                }]
            }, {
                columnWidth: .3,
                layout: 'form',
                items: [{
                    xtype: 'textfield',
                    fieldLabel: _('eshoplogistic3_room'),
                    name: 'receiver-room',
                    id: 'esl-unload-receiver-room',
                    anchor: '99%',
                    allowBlank: true
                }]
            }, {
                columnWidth: .3,
                layout: 'form',
                items: [{
                    xtype: 'textfield',
                    fieldLabel: _('eshoplogistic3_index'),
                    name: 'receiver-index',
                    id: 'esl-unload-receiver-index',
                    anchor: '99%',
                    allowBlank: true
                }]
            }]
        }, {
            layout: 'column',
            items: [{
                columnWidth: 1,
                items: [{
                    html: '<hr>',
                    style: 'margin-top: 25px'
                }]
            }]
        }, {
            layout: 'column',
            items: [{
                columnWidth: 1,
                layout: 'form',
                items: [{
                    fieldLabel: _('eshoplogistic3_unload_pick_up'),
                    xtype: 'eshoplogistic3-combo-pick_up',
                    anchor: '90%',
                    pick_up: config.data.pick_up ? 0 : 1,
                    allowBlank: false
                }]
            }]
        }, {
            layout: 'column',
            id: 'esl_pick_up_row_0',
            items: [{
                columnWidth: 1,
                layout: 'form',
                items: [{
                    html: '<h3>' + _('eshoplogistic3_unload_pick_up_terminal_text') + '</h3>',
                    style: 'margin-top: 25px'
                }]
            }]
        }, {
            layout: 'column',
            id: 'esl_pick_up_row_1',
            items: [{
                columnWidth: .4,
                layout: 'form',
                items: [{
                    xtype: 'textfield',
                    fieldLabel: _('eshoplogistic3_unload_pick_up_terminal'),
                    name: 'sender-terminal',
                    id: 'esl-unload-sender-terminal',
                    anchor: '99%',
                    allowBlank: true
                }]
            }]
        }, {
            layout: 'column',
            hidden: true,
            id: 'esl_pick_up_row_2',
            items: [{
                columnWidth: 1,
                layout: 'form',
                items: [{
                    html: '<h3>' + _('eshoplogistic3_unload_sender_text') + '</h3>',
                    style: 'margin-top: 25px'
                }]
            }]
        }, {
            layout: 'column',
            hidden: true,
            id: 'esl_pick_up_row_3',
            items: [{
                columnWidth: .3,
                layout: 'form',
                items: [{
                    fieldLabel: _('eshoplogistic3_region'),
                    xtype: 'textfield',
                    anchor: '90%',
                    allowBlank: true,
                    name: 'sender-region',
                    id: 'esl-unload-sender-region',
                }]
            }, {
                columnWidth: .3,
                layout: 'form',
                items: [{
                    xtype: 'textfield',
                    fieldLabel: _('eshoplogistic3_city'),
                    name: 'sender-city',
                    id: 'esl-unload-sender-city',
                    anchor: '99%',
                    allowBlank: true
                }]
            }, {
                columnWidth: .4,
                layout: 'form',
                items: [{
                    xtype: 'textfield',
                    fieldLabel: _('eshoplogistic3_street'),
                    name: 'sender-street',
                    id: 'esl-unload-sender-street',
                    anchor: '99%',
                    allowBlank: true
                }]
            }]
        }, {
            layout: 'column',
            hidden: true,
            id: 'esl_pick_up_row_4',
            items: [{
                columnWidth: .3,
                layout: 'form',
                items: [{
                    fieldLabel: _('eshoplogistic3_house'),
                    xtype: 'textfield',
                    anchor: '90%',
                    allowBlank: true,
                    name: 'sender-house',
                    id: 'esl-unload-sender-house',
                }]
            }, {
                columnWidth: .3,
                layout: 'form',
                items: [{
                    xtype: 'textfield',
                    fieldLabel: _('eshoplogistic3_room'),
                    name: 'sender-room',
                    id: 'esl-unload-sender-room',
                    anchor: '99%',
                    allowBlank: true
                }]
            }, {
                columnWidth: .3,
                layout: 'form',
                items: [{
                    xtype: 'textfield',
                    fieldLabel: _('eshoplogistic3_index'),
                    name: 'sender-index',
                    id: 'esl-unload-sender-index',
                    anchor: '99%',
                    allowBlank: true
                }]
            }]
        }]

        return fields
    }

})

Ext.reg('eshoplogistic3-upload-receiver-panel', eshoplogistic3.panel.UnloadReceiver);