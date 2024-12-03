eshoplogistic3.panel.Statistics = function (config) {

    config = config || {};

    Ext.applyIf(config, {
        id: 'eshoplogistic3-panel-statistics',
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
        }],
        listeners: {
            render: {
                fn: this.setData, scope: this
            }
        }
    });

    eshoplogistic3.panel.Statistics.superclass.constructor.call(this, config)
}

Ext.extend(eshoplogistic3.panel.Statistics, MODx.FormPanel, {

    setData: function() {
        const form = this.getForm(),
            el = this.getEl(),
            _self = this

        el.mask(_('loading'),'x-mask-loading')
        MODx.Ajax.request({
            url: eshoplogistic3.config.connector_url,
            params: {
                action: 'mgr/statistics'
            },
            listeners: {
                success: {
                    fn:function(response) {
                        form.setValues({
                            eshoplogistic3_statistics_tariff: response.results.tariff,
                            eshoplogistic3_statistics_limit: response.results.limit,
                            eshoplogistic3_statistics_sum: response.results.sum,
                            eshoplogistic3_statistics_widget: response.results.widget,
                            eshoplogistic3_statistics_api: response.results.api
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


    getFields: function(config) {
        let fields = [];
        const tmp = {
            tariff: { xtype: 'displayfield', value: '?', disabled: true, width: 250 },
            limit: { xtype: 'displayfield', value: '?', disabled: true, width: 250 },
            sum: { xtype: 'displayfield', value: '?', disabled: true, width: 250 },
            widget: { xtype: 'displayfield', value: '?', disabled: true, width: 250 },
            api: { xtype: 'displayfield', value: '?', disabled: true, width: 250 }
        }

        for (const i in tmp) {
            if (!tmp.hasOwnProperty(i)) {
                continue
            }
            let field = tmp[i];
            Ext.applyIf(field, {
                name: i,
                id: 'eshoplogistic3_statistics_' + i,
                xtype: 'textfield',
                style: 'opacity: 1',
                fieldLabel: _('eshoplogistic3_statistics_' + i)
            })
            fields.push(field)
        }
        return fields
    }

})

Ext.reg('eshoplogistic3-form-statistics', eshoplogistic3.panel.Statistics)
