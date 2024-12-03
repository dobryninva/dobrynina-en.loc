SEOroom.page.Home = function (config) {
	config = config || {};
	Ext.applyIf(config, {
		components: [{
			xtype: 'seoroom-panel-home', renderTo: 'seoroom-panel-home-div'
		}]
	});
	SEOroom.page.Home.superclass.constructor.call(this, config);
};

Ext.extend(SEOroom.page.Home, MODx.Component);
Ext.reg('seoroom-page-home', SEOroom.page.Home);