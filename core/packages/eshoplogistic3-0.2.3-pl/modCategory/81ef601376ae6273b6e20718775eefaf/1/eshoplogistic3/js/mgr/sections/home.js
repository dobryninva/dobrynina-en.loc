eshoplogistic3.page.Home = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        components: [{
            xtype: 'eshoplogistic3-panel-home',
            renderTo: 'eshoplogistic3-panel-home-div'
        }]
    });
    eshoplogistic3.page.Home.superclass.constructor.call(this, config);
};
Ext.extend(eshoplogistic3.page.Home, MODx.Component);
Ext.reg('eshoplogistic3-page-home', eshoplogistic3.page.Home);