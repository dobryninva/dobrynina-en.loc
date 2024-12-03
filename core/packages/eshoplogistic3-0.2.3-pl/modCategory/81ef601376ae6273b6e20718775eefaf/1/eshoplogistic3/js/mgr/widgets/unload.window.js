eshoplogistic3.window.Unload = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'eshoplogistic3-window-delivery-unload';
    }
    Ext.applyIf(config, {
        title: _('eshoplogistic3_delivery_unload'),
        width: 1100,
        autoHeight: true,
        url: eshoplogistic3.config.connector_url,
        action: 'mgr/order/unload',
        fields: this.getFields(config),
        loadMask: true,
        keys: [{
            key: Ext.EventObject.ENTER, shift: true, fn: function () {
                this.submit(false)
            }, scope: this
        }],
        buttons: [{
            text: _('cancel'),
            scope: this,
            handler: function() { config.closeAction !== 'close' ? this.hide() : this.close(); }
        },{
            text: _('eshoplogistic3_delivery_unload_button_text'),
            cls: 'primary-button',
            scope: this,
            handler: function () {
                this._submit()
            }
        }]
    })

    eshoplogistic3.window.Unload.superclass.constructor.call(this, config);

    this.on('hide', function() {
        let w = this;
        window.setTimeout(function() {
            w.close()
        }, 300)
    })
};

Ext.extend(eshoplogistic3.window.Unload, MODx.Window, {

    _submit: function () {
        const _self = this,
            form = this.fp.getForm(),
            el = this.getEl()

        el.mask(_('loading'), 'x-mask-loading');

        MODx.msg.confirm({
            title: _('eshoplogistic3_delivery_unload_confirm_title'),
            text:_('eshoplogistic3_delivery_unload_confirm_text'),
            url: _self.url,
            params: {
                action: 'mgr/order/unload',
                order_id: this.config.order_id,
                data: JSON.stringify(form.getValues())
            },
            listeners: {
                success: {
                    fn: function (frm) {
                        el.unmask()
                        Ext.Msg.alert(_('eshoplogistic3_delivery_success'), frm.message)
                        setTimeout(function () {
                            //_self.hide()
                            location.reload()
                        }, 1500)
                    }
                },
                failure: {
                    fn: function () {
                        el.unmask()
                    }
                }
            }
        })
    },

    getFields: function (config) {
        let fields = [{
            xtype: 'modx-tabs',
            deferredRender: false,
            border: false,
            bodyStyle: 'padding:5px 10px;',
            style: 'margin-top: 10px',
            bodyBorder: 1,
            items: [{
                title: _('eshoplogistic3_delivery_unload_common'),
                layout: 'form',
                id: 'eshoplogistic3-upload-common-tab',
                items: [{
                    xtype: 'eshoplogistic3-upload-common-panel',
                    cls: 'main-wrapper',
                    order_id: config.order_id,
                    data: config.data
                }]
            }, {
                title: _('eshoplogistic3_delivery_unload_receiver'),
                layout: 'form',
                id: 'eshoplogistic3-upload-receiver-tab',
                items: [{
                    xtype: 'eshoplogistic3-upload-receiver-panel',
                    cls: 'main-wrapper',
                    order_id: config.order_id,
                    data: config.data
                }]
            }, {
                title: _('eshoplogistic3_delivery_unload_places'),
                layout: 'form',
                id: 'eshoplogistic3-upload-places-tab',
                items: [{
                    xtype: 'eshoplogistic3-grid-unload-places',
                    cls: 'main-wrapper',
                    order_id: config.order_id
                }]
            }, {
                title: _('eshoplogistic3_delivery_unload_additional'),
                layout: 'form',
                id: 'eshoplogistic3-upload-additional-tab',
                items: [{
                    xtype: 'eshoplogistic3-grid-unload-additional',
                    cls: 'main-wrapper',
                    order_id: config.order_id,
                    data: config.data
                }]
            }]
        }]

        return fields
    }

});
Ext.reg('eshoplogistic3-window-delivery-unload', eshoplogistic3.window.Unload);