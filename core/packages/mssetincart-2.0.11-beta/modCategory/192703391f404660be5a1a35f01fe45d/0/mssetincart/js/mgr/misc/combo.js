Ext.namespace('mssetincart.combo');

mssetincart.combo.Link = function (config) {
	config = config || {};

	Ext.applyIf(config, {
		name: 'link',
		hiddenName: 'link',
		displayField: 'name',
		valueField: 'id',
		fields: ['id', 'name'],
		pageSize: 10,
		editable: true,
		emptyText: _('ms2_combo_select'),
		url: miniShop2.config['connector_url'],
		baseParams: {
			action: 'mgr/settings/link/getlist',
			combo: true
		}
	});
	mssetincart.combo.Link.superclass.constructor.call(this, config);
};
Ext.extend(mssetincart.combo.Link, MODx.combo.ComboBox);
Ext.reg('mssetincart-combo-link', mssetincart.combo.Link);


mssetincart.combo.Product = function (config) {
	config = config || {};
	Ext.applyIf(config, {
		fieldLabel: _('ms2_product_name'),
		fields: ['id', 'pagetitle', 'parents'],
		valueField: 'id',
		displayField: 'pagetitle',
		name: 'product',
		hiddenName: 'product',
		allowBlank: false,
		url: miniShop2.config['connector_url'],
		baseParams: {
			action: 'mgr/product/getlist',
			combo: true,
			id: config.value
		},
		tpl: new Ext.XTemplate('\
            <tpl for=".">\
                <div class="x-combo-list-item minishop2-product-list-item">\
                    <tpl if="parents">\
                        <span class="parents">\
                            <tpl for="parents">\
                                <nobr><small>{pagetitle} / </small></nobr>\
                            </tpl>\
                        </span><br/>\
                    </tpl>\
                    <span><small>({id})</small> <b>{pagetitle}</b></span>\
                </div>\
            </tpl>', {compiled: true}
		),
		pageSize: 5,
		emptyText: _('ms2_combo_select'),
		editable: true,
	});
	mssetincart.combo.Product.superclass.constructor.call(this, config);
};
Ext.extend(mssetincart.combo.Product, MODx.combo.ComboBox);
Ext.reg('mssetincart-combo-product', mssetincart.combo.Product);
