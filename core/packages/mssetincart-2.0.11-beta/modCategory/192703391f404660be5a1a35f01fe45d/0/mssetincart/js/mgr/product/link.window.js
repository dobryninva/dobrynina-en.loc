mssetincart.window.productLink = function (config) {
	config = config || {record: {}};
	
	Ext.applyIf(config, {
		url: mssetincart.config['connector_url'],
		title: _('create'),
		width: 500,
		baseParams: {
			action: 'mgr/product/productlink/update',
		},
	});

	mssetincart.window.productLink.superclass.constructor.call(this, config);
};
Ext.extend(mssetincart.window.productLink, miniShop2.window.Default, {

	getFields: function (config) {
		return [{
			xtype: 'hidden',
			name: 'master'
		}, {
			xtype: 'mssetincart-combo-link',
			fieldLabel: _('ms2_link'),
			name: 'link',
			allowBlank: false,
			anchor: '100%',
		}, {
			xtype: 'mssetincart-combo-product',
			fieldLabel: _('ms2_product'),
			name: 'slave',
			hiddenName: 'slave',
			allowBlank: false,
			anchor: '100%',
		}, {
			xtype: 'textfield',
			fieldLabel: _('ms2_cost'),
			name: 'price',
			maskRe: /[0123456789\.\-+%]/,
			allowBlank: true,
			anchor: '100%',
		}, {
			xtype: 'numberfield',
			decimalPrecision: 0,
			fieldLabel: _('ms2_count'),
			name: 'count',
			allowBlank: true,
			anchor: '100%',
		}];
	},

});
Ext.reg('mssetincart-window-product-link', mssetincart.window.productLink);
