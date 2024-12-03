mssetincart.grid.ProductLinks = function (config) {
	config = config || {};

	Ext.applyIf(config, {
		url: mssetincart.config['connector_url'],
		id: 'minishop2-grid-product-link',
		baseParams: {
			action: 'mgr/product/productlink/getlist',
			master: config.record.id,
			sort: 'name',
			dir: 'ASC',
		},
		multi_select: true,
	});

	config.listeners = this.getListeners(config);
	mssetincart.grid.ProductLinks.superclass.constructor.call(this, config);
};
Ext.extend(mssetincart.grid.ProductLinks, miniShop2.grid.Default, {

	getFields: function () {
		return [
			'link', 'type', 'name', 'master', 'slave', 'description',
			'master_pagetitle', 'slave_pagetitle',
			'count', 'price',
			'actions'
		];
	},

	getColumns: function () {

		var columns = [];
		var add = {
			name: {
				width: 30,
				hidden: false,
				sortable: true
			},
			type: {
				header: _('ms2_type'),
				width: 30,
				sortable: true,
				renderer: this._renderType
			},
			master_pagetitle: {
				header: _('ms2_link_master'),
				width: 45,
				sortable: true,
				renderer: this._renderMaster,
				scope: this,
			},
			slave_pagetitle: {
				header: _('ms2_link_slave'),
				width: 45,
				sortable: true,
				renderer: this._renderSlave,
				scope: this,
			},
			price: {
				header: _('ms2_cost'),
				width: 20,
				sortable: true,
				/*editor: {
				 xtype: 'textfield',
				 allowBlank: false
				 }*/
			},
			count: {
				width: 20,
				sortable: true,
				/*editor: {
				 xtype: 'numberfield',
				 decimalPrecision: 0,
				 allowBlank: true
				 }*/
			},
			actions: {
				width: 20,
				sortable: false,
				id: 'actions',
				renderer: miniShop2.utils.renderActions,

			}
		};

		var fields = this.getFields();
		fields.filter(function (field) {
			if (add[field]) {
				Ext.applyIf(add[field], {
					header: _('ms2_link_' + field) || _('ms2_' + field) || '',
					dataIndex: field
				});
				columns.push(add[field]);
			}
		});

		return columns;
	},

	getTopBar: function () {
		return [{
			text: '<i class="icon icon-plus"></i> ' + _('ms2_btn_create'),
			handler: this.createLink,
			scope: this
		},
			'->',
			{
				xtype: 'mssetincart-combo-link',
				width: 190,
				name: 'link',
				value: '',
				listeners: {
					select: {
						fn: this._filterByCombo,
						scope: this
					},
					afterrender: {
						fn: this._filterByCombo,
						scope: this
					}
				}
			},
			this.getSearchField()
		];
	},

	getListeners: function () {
		return {
			rowDblClick: function (grid, rowIndex, e) {
				var row = grid.store.getAt(rowIndex);
				this.updateLink(grid, e, row);
			},
		};
	},

	createLink: function (btn, e) {
		var record = {
			master: btn.scope.record.id,
			price: '',
			count: 1,
		};

		var w = MODx.load({
			xtype: 'mssetincart-window-product-link',
			baseParams: {
				action: 'mgr/product/productlink/create',
				master: btn.scope.record.id
			},
			record: record,
			update: false,
			listeners: {
				success: {
					fn: function (r) {
						this.refresh();
					}, scope: this
				}
			}
		});
		w.reset();
		w.setValues(record);
		w.show(e.target);

	},

	updateLink: function (btn, e, row) {
		if (typeof(row) != 'undefined') {
			this.menu.record = row.data;
		}
		else if (!this.menu.record) {
			return false;
		}

		var record = {
			link: this.menu.record.link || '',
			master: this.menu.record.master || '',
			slave: this.menu.record.slave || '',
		};

		MODx.Ajax.request({
			url: this.config.url,
			params: {
				action: 'mgr/product/productlink/get',
				query: Ext.util.JSON.encode(record)
			},
			listeners: {
				success: {
					fn: function (r) {
						var record = r.object;
						var w = MODx.load({
							xtype: 'mssetincart-window-product-link',
							title: _('ms2_menu_update'),
							action: 'mgr/product/productlink/update',
							record: record,
							update: true,
							listeners: {
								success: {
									fn: function () {
										this.refresh();
									}, scope: this
								}
							}
						});
						w.reset();
						w.setValues(record);
						w.show(e.target);
					}, scope: this
				}
			}
		});
	},


	linkAction: function (method) {
		var ids = this._getSelectedIds();
		if (!ids.length) {
			return false;
		}
		MODx.Ajax.request({
			url: this.config.url,
			params: {
				action: 'mgr/product/productlink/multiple',
				method: method,
				ids: Ext.util.JSON.encode(ids),
			},
			listeners: {
				success: {
					fn: function () {
						this.refresh();
					}, scope: this
				},
				failure: {
					fn: function (response) {
						MODx.msg.alert(_('error'), response.message);
					}, scope: this
				},
			}
		})
	},

	removeLink: function () {
		var ids = this._getSelectedIds();

		Ext.MessageBox.confirm(
			_('ms2_menu_remove_title'),
			ids.length > 1
				? _('ms2_menu_remove_multiple_confirm')
				: _('ms2_menu_remove_confirm'),
			function (val) {
				if (val == 'yes') {
					this.linkAction('remove');
				}
			}, this
		);
	},

	_renderType: function (value) {
		return _('ms2_link_' + value);
	},

	_renderMaster: function (value, cell, row) {
		return row.data.master == this.record.id
			? value
			: miniShop2.utils.productLink(value, row.data.master);
	},

	_renderSlave: function (value, cell, row) {
		return row.data.slave == this.record.id
			? value
			: miniShop2.utils.productLink(value, row.data.slave);
	},

	_getSelectedIds: function () {
		var ids = [];
		var selected = this.getSelectionModel().getSelections();

		for (var i in selected) {
			if (!selected.hasOwnProperty(i)) {
				continue;
			}
			ids.push({
				link: selected[i]['data']['link'],
				master: selected[i]['data']['master'],
				slave: selected[i]['data']['slave'],
			});
		}

		return ids;
	},

	_filterByCombo: function (cb) {
		this.getStore().baseParams[cb.name] = cb.value;
		this.getBottomToolbar().changePage(1);
	},

});
Ext.reg('minishop2-product-links', mssetincart.grid.ProductLinks);