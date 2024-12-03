eshoplogistic3.panel.Home = function (config) {

    config = config || {};

    Ext.apply(config, {
        baseCls: 'modx-formpanel',
        layout: 'anchor',
        hideMode: 'offsets',
        items: [{
            html: '<h2>' + _('eshoplogistic3') + '</h2>',
            cls: '',
            style: {margin: '15px 0'}
        }, {
            xtype: 'modx-tabs',
            defaults: {border: false, autoHeight: true},
            border: true,
            hideMode: 'offsets',
            items: [{
                title: _('eshoplogistic3_info'),
                layout: 'anchor',
                items: [{
                    xtype: 'eshoplogistic3-form-info',
                    cls: 'main-wrapper'
                }]
            }, {
                title: _('eshoplogistic3_statistics'),
                layout: 'anchor',
                items: [{
                    html: _('eshoplogistic3_statistics_intro'),
                    border: false,
                    bodyCssClass: 'panel-desc'
                }, {
                    xtype: 'eshoplogistic3-form-statistics',
                    cls: 'main-wrapper'
                }]
            }, {
                title: _('eshoplogistic3_log'),
                layout: 'anchor',
                items: [{
                    html: _('eshoplogistic3_log_intro'),
                    border: false,
                    bodyCssClass: 'panel-desc'
                }, {
                    xtype: 'eshoplogistic3-form-log',
                    cls: 'main-wrapper'
                }],
                listeners:{
                    'activate':{
                        fn:function(tab) {
                            Ext.getCmp('eshoplogistic3-panel-log').setData();
                        }
                    }
                }
            }]
        }]
    })
    eshoplogistic3.panel.Home.superclass.constructor.call(this, config)
}

Ext.extend(eshoplogistic3.panel.Home, MODx.Panel)
Ext.reg('eshoplogistic3-panel-home', eshoplogistic3.panel.Home)
