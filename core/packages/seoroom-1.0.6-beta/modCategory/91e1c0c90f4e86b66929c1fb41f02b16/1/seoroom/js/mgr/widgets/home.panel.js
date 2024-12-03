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
			html: '<h2>' + _('seoroom') + '</h2>',
			cls: '',
			style: {margin: '15px 0'}
		}, {
			xtype: 'modx-tabs',
			defaults: {border: false, autoHeight: true},
			border: true,
			hideMode: 'offsets',
			items: [{
				title: 'Счетчики',
				layout: 'anchor',
				items: [{
					html: '<p><b>[[$seo.counters]]</b> - Вывод всех счетчиков</p><p><b>[[$seo.counter.name]]</b> - Вывод одного счетчика, где name имя счетчика. <span style="color: blue;">Обязательно на английском без пробелов, допустимые символы: a-zA-Z0-9_-</span></p>',
					cls: 'panel-desc'
				}, {
					xtype: 'seoroom-grid-items',
					cls: 'main-wrapper'
				}]
			},{
                title: 'robots.txt',
                items: [{
                    html: '<p>Содержимое файла robots.txt, <a href="/robots.txt" target="_blank">посмотреть</a></p>',
                    cls: 'panel-desc'
                }, {
                    xtype: 'seoroom-form-robots',
                    cls: 'main-wrapper'
                }]
            },{
                title: '.htaccess',
                items: [{
                    html: '<p>Содержимое файла .htaccess</p>',
                    cls: 'panel-desc'
                }, {
                    xtype: 'seoroom-form-htaccess',
                    cls: 'main-wrapper'
                }]
            }]
		}]
	});
	SEOroom.panel.Home.superclass.constructor.call(this, config);
};
Ext.extend(SEOroom.panel.Home, MODx.Panel);
Ext.reg('seoroom-panel-home', SEOroom.panel.Home);
