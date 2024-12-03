eshoplogistic3.panel.Log = function (config) {

    config = config || {};

    Ext.applyIf(config, {
        id: 'eshoplogistic3-panel-log',
        cls: 'container form-with-labels',
        labelAlign: 'left',
        autoHeight: true,
        labelWidth: 200,
        items: [{
            layout: 'form',
            cls: 'main-wrapper',
            border: false,
            items: this.getFields()
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
            text: '<i class="icon icon-trash-o"></i> ' + _('eshoplogistic3_log_clear'),
            handler: function() {
                this.clear()
            }, scope: this
        }, {
            text: '<i class="icon icon-download"></i> ' + _('eshoplogistic3_log_download'),
            handler: function() {
                location.href = eshoplogistic3.config.connector_url + "?action=mgr/downloadlog&HTTP_MODAUTH=" + MODx.siteId;
            }, scope: this
        }],
        /*listeners: {
            render: {
                fn: this.setData, scope: this
            }
        }*/
    });

    eshoplogistic3.panel.Log.superclass.constructor.call(this, config)
}

Ext.extend(eshoplogistic3.panel.Log, MODx.FormPanel, {

    clear: function() {
        MODx.Ajax.request({
            url: eshoplogistic3.config.connector_url,
            params: {
                action: 'mgr/clearlog'
            },
            listeners: {
                success: {
                    fn:function() {
                        this.setData()
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
                action: 'mgr/getlog'
            },
            listeners: {
                success: {
                    fn:function(response) {
                        form.setValues({
                            eshoplogistic3_log_content: response.object.content
                        })
                        el.unmask()
                    }, scope: this
                },
                failure: {
                    fn: function (response) {
                        Ext.Msg.alert(_('eshoplogistic3_data_fail'), response.message)
                        el.unmask()
                    }, scope: this
                }
            }
        })
    },


    getFields: function() {
        return [{
            hideLabel: true,
            xtype: 'textarea',
            name: 'eshoplogistic3_log_content',
            id: 'eshoplogistic3_log_content',
            height: 400,
            width: '100%'
        }]
    }

})

Ext.reg('eshoplogistic3-form-log', eshoplogistic3.panel.Log)
