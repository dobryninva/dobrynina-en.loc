SEOroom.window.CreateItem = function (config) {
	config = config || {};
	if (!config.id) {
		config.id = 'seoroom-item-window-create';
	}
	Ext.applyIf(config, {
		title: _('seoroom_item_create'),
		width: 550,
		autoHeight: true,
		url: SEOroom.config.connector_url,
		action: 'mgr/item/create',
		fields: this.getFields(config),
		keys: [{
			key: Ext.EventObject.ENTER, shift: true, fn: function () {
				this.submit()
			}, scope: this
		}]
	});
	SEOroom.window.CreateItem.superclass.constructor.call(this, config);
};
Ext.extend(SEOroom.window.CreateItem, MODx.Window, {

	getFields: function (config) {
		return [{
			xtype: 'textfield',
			fieldLabel: _('seoroom_item_name'),
			name: 'name',
			id: config.id + '-name',
			anchor: '99%',
			allowBlank: false,
		}, {
			xtype: 'textarea',
			fieldLabel: _('seoroom_item_description'),
			name: 'content',
			id: config.id + '-description',
			height: 150,
			anchor: '99%'
		}];
	},

	loadDropZones: function() {
	}

});
Ext.reg('seoroom-item-window-create', SEOroom.window.CreateItem);

SEOroom.window.UpdateItem = function (config) {
	config = config || {};
	if (!config.id) {
		config.id = 'seoroom-item-window-update';
	}
	Ext.applyIf(config, {
		title: _('seoroom_item_update'),
		width: 550,
		autoHeight: true,
		url: SEOroom.config.connector_url,
		action: 'mgr/item/update',
		fields: this.getFields(config),
		keys: [{
			key: Ext.EventObject.ENTER, shift: true, fn: function () {
				this.submit()
			}, scope: this
		}]
	});
	SEOroom.window.UpdateItem.superclass.constructor.call(this, config);
};
Ext.extend(SEOroom.window.UpdateItem, MODx.Window, {

	getFields: function (config) {
		return [{
			xtype: 'hidden',
			name: 'id',
			id: config.id + '-id'
		}, {
			xtype: 'textfield',
			fieldLabel: _('seoroom_item_name'),
			name: 'name',
			id: config.id + '-name',
			anchor: '99%',
			allowBlank: false
		}, {
			xtype: 'textarea',
			fieldLabel: _('seoroom_item_description'),
			name: 'content',
			id: config.id + '-description',
			anchor: '99%',
			height: 150
		}];
	},

	loadDropZones: function() {
	}

});
Ext.reg('seoroom-item-window-update', SEOroom.window.UpdateItem);