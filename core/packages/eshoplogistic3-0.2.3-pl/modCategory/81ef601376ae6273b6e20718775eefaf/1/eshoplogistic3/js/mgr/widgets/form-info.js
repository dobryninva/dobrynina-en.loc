eshoplogistic3.panel.Info = function (config) {

    config = config || {};

    Ext.applyIf(config, {
        id: 'eshoplogistic3-panel-info',
        cls: 'container form-with-labels',
        labelAlign: 'left',
        autoHeight: true,
        labelWidth: 200,
        items: [{
            layout: 'form',
            cls: 'main-wrapper',
            border: false,
            items: this.getFields(config)
        },{
            html: '<hr />',
            border: false
        }],
        buttonAlign: 'left',
        buttons: [{
            text: '<i class="icon icon-refresh"></i> ' + _('eshoplogistic3_info_data_refresh'),
            handler: function() {
                this.setData()
            }, scope: this
        }, {
            text: '<i class="icon icon-trash-o"></i> ' + _('eshoplogistic3_info_cache_clear'),
            handler: function() {
                this.clearCache()
            }, scope: this
        }],
        listeners: {
            render: {
                fn: this.setData, scope: this
            }
        }
    });

    eshoplogistic3.panel.Info.superclass.constructor.call(this, config)
}

Ext.extend(eshoplogistic3.panel.Info, MODx.FormPanel, {

    clearCache: function() {
        const form = this.getForm(),
            el = this.getEl(),
            _self = this

        MODx.Ajax.request({
            url: eshoplogistic3.config.connector_url,
            params: {
                action: 'mgr/clearcache'
            },
            listeners: {
                success: {
                    fn:function(response) {
                        form.setValues({
                            eshoplogistic3_info_cache_size: response.results.cache_size
                        })
                        el.unmask()
                    }, scope: this
                }
            }
        })
    },

    setData: function() {
        const form = this.getForm(),
            el = this.getEl(),
            _self = this

        el.mask(_('loading'),'x-mask-loading')
        MODx.Ajax.request({
            url: eshoplogistic3.config.connector_url,
            params: {
                action: 'mgr/info'
            },
            listeners: {
                success: {
                    fn:function(response) {
                        form.setValues({
                            eshoplogistic3_info_active: response.results.active,
                            eshoplogistic3_info_balance: response.results.balance,
                            eshoplogistic3_info_free_days: response.results.free_days,
                            eshoplogistic3_info_services: response.results.services,
                            eshoplogistic3_info_cache_size: response.results.cache_size
                        })
                        el.unmask()
                    }, scope: this
                },
                failure: {
                    fn: function (response) {
                        Ext.Msg.alert(_('eshoplogistic3_data_fail'),response.message)
                        el.unmask()
                    }, scope: this
                }
            }
        })
    },

    getFields: function() {
        let fields = [];
        const tmp = {
            active: { xtype: 'displayfield', value: '?', disabled: true, width: 20 },
            balance: { xtype: 'displayfield', value: '?', disabled: true, width: 250 },
            free_days: { xtype: 'displayfield', value: '?', disabled: true, width: 80 },
            services: { xtype: 'displayfield', value: '?', disabled: true, width: '100%' },
            cache_size: { xtype: 'displayfield', value: '0', disabled: true, width: '100%' },
        }

        for (const i in tmp) {
            if (!tmp.hasOwnProperty(i)) {
                continue
            }
            let field = tmp[i];
            Ext.applyIf(field, {
                name: i,
                id: 'eshoplogistic3_info_' + i,
                xtype: 'textfield',
                style: 'opacity: 1',
                fieldLabel: _('eshoplogistic3_info_' + i)
            })
            fields.push(field)
        }
        return fields
    }

})

Ext.reg('eshoplogistic3-form-info', eshoplogistic3.panel.Info)
