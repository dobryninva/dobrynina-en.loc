SEOroom.panel.Home = function (config) {
	config = config || {};
	Ext.apply(config, {
		baseCls: 'modx-formpanel',
		layout: 'anchor',
		/*
		 stateful: true,
		 stateId: 'seoroom-panel-home',
		 stateEvents: ['tabchange'],
		 getState:function() {return {activeTab:this.items.indexOf(this.getActiveTab())};},
		 */
		hideMode: 'offsets',
		items: [{
			xtype: 'modx-tabs',
			defaults: {border: false, autoHeight: true},
			border: false,
			hideMode: 'offsets',
			items: [{
				title: _('seoroom_items'),
				layout: 'anchor',
				items: [{
					html: _('seoroom_intro_msg'),
					cls: 'panel-desc',
				}, {
					xtype: 'seoroom-grid-items',
					cls: 'main-wrapper',
				}]
			}]
		}]
	});
	SEOroom.panel.Home.superclass.constructor.call(this, config);
};
Ext.extend(SEOroom.panel.Home, MODx.Panel);
Ext.reg('seoroom-panel-home', SEOroom.panel.Home);
