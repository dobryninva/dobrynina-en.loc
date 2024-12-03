eshoplogistic3.grid.UnloadPlaces = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'eshoplogistic3-grid-unload-places'
    }
    Ext.applyIf(config, {
        url: eshoplogistic3.config.connector_url,
        fields: this.getFields(),
        columns: this.getColumns(),
        tbar: this.getTopBar(),
        sm: new Ext.grid.CheckboxSelectionModel(),
        baseParams: {
            action: 'mgr/order/places',
            order_id: config.order_id
        },
        listeners: {
            rowDblClick: function (grid, rowIndex, e) {
                const row = grid.store.getAt(rowIndex)
                this.updateItem(grid, e, row)
            }
        },
        viewConfig: {
            forceFit: true,
            enableRowBody: true,
            autoFill: true,
            showPreview: true,
            scrollOffset: 0,
            getRowClass: function (rec) {
                return !rec.data.active
                    ? 'eshoplogistic3-grid-row-disabled'
                    : ''
            }
        },
        paging: true,
        remoteSort: true,
        autoHeight: true
    })
    eshoplogistic3.grid.UnloadPlaces.superclass.constructor.call(this, config);

    this.store.on('load', function () {
        if (this._getSelectedIds().length) {
            this.getSelectionModel().clearSelections();
        }
    }, this)
}

Ext.extend(eshoplogistic3.grid.UnloadPlaces, MODx.grid.Grid, {

    getFields: function () {
        return ['article', 'name', 'count', 'price', 'weight', 'width', 'length', 'height', 'actions']
    },

    getColumns: function () {
        return [{
            header: _('eshoplogistic3_unload_place_article'),
            dataIndex: 'article',
            sortable: false,
            width: 80
        }, {
            header: _('eshoplogistic3_unload_place_name'),
            dataIndex: 'name',
            sortable: false,
            width: 100
        }, {
            header: _('eshoplogistic3_unload_place_count'),
            dataIndex: 'count',
            sortable: false,
            width: 50
        }, {
            header: _('eshoplogistic3_unload_place_price'),
            dataIndex: 'price',
            sortable: false,
            width: 80
        }, {
            header: _('eshoplogistic3_unload_place_weight'),
            dataIndex: 'weight',
            sortable: false,
            width: 80
        }, {
            header: _('eshoplogistic3_unload_place_width'),
            dataIndex: 'width',
            sortable: false,
            width: 80
        }, {
            header: _('eshoplogistic3_unload_place_length'),
            dataIndex: 'length',
            sortable: false,
            width: 80
        }, {
            header: _('eshoplogistic3_unload_place_height'),
            dataIndex: 'height',
            sortable: false,
            width: 80
        }, {
            header: _('eshoplogistic3_unload_place_actions'),
            dataIndex: 'actions',
            renderer: eshoplogistic3.utils.renderActions,
            sortable: false,
            width: 100,
            id: 'actions'
        }]
    },

    getTopBar: function () {
        return [{
            text: '<i class="icon icon-plus"></i>&nbsp;' + _('eshoplogistic3_unload_place_create'),
            handler: this.createItem,
            scope: this
        }]
    },

    createItem: function (btn, e) {
        let w = MODx.load({
            xtype: 'eshoplogistic3-place-window-create',
            id: Ext.id(),
            order_id: this.config.order_id,
            listeners: {
                success: {
                    fn: function () {
                        this.refresh()
                    }, scope: this
                }
            }
        });
        w.reset()
        w.setValues({active: true})
        w.show(e.target)
    },

    updateItem: function (btn, e, row) {
        if (typeof(row) !== 'undefined') {
            this.menu.record = row.data
        }
        else if (!this.menu.record) {
            return false
        }

        const id = this.menu.record.article;

        MODx.Ajax.request({
            url: this.config.url,
            params: {
                action: 'mgr/order/places',
                mode: 'get',
                order_id: this.config.order_id,
                id: id
            },
            listeners: {
                success: {
                    fn: function (r) {
                        let w = MODx.load({
                            xtype: 'eshoplogistic3-place-window-update',
                            id: Ext.id(),
                            order_id: this.config.order_id,
                            record: r,
                            listeners: {
                                success: {
                                    fn: function () {
                                        this.refresh()
                                    }, scope: this
                                }
                            }
                        });
                        w.reset();
                        w.setValues(r.object)
                        w.show(e.target)
                    }, scope: this
                }
            }
        })
    },

    getMenu: function (grid, rowIndex) {
        let ids = this._getSelectedIds(),
            row = grid.getStore().getAt(rowIndex),
            menu = eshoplogistic3.utils.getMenu(row.data['actions'], this, ids)
        this.addContextMenuItem(menu)
    },

    _getSelectedIds: function () {
        let ids = [],
            selected = this.getSelectionModel().getSelections()
        for (const i in selected) {
            if (!selected.hasOwnProperty(i)) {
                continue
            }
            ids.push(selected[i]['data']['article'])
        }
        return ids
    },

    removeItem: function () {
        const ids = this._getSelectedIds()
        if (!ids.length) {
            return false
        }

        MODx.msg.confirm({
            title: ids.length > 1
                ? _('eshoplogistic3_places_remove')
                : _('eshoplogistic3_place_remove'),
            text: ids.length > 1
                ? _('eshoplogistic3_places_remove_confirm')
                : _('eshoplogistic3_place_remove_confirm'),
            url: this.config.url,
            params: {
                action: 'mgr/order/places',
                mode : 'remove',
                order_id: this.config.order_id,
                ids: Ext.util.JSON.encode(ids),
            },
            listeners: {
                success: {
                    fn: function () {
                        this.refresh()
                    }, scope: this
                }
            }
        })
        return true
    },

    onClick: function (e) {
        const elem = e.getTarget()
        if (elem.nodeName == 'BUTTON') {
            const row = this.getSelectionModel().getSelected()
            if (typeof(row) != 'undefined') {
                const action = elem.getAttribute('action')
                if (action == 'showMenu') {
                    const ri = this.getStore().find('id', row.id)
                    return this._showMenu(this, ri, e)
                }
                else if (typeof this[action] === 'function') {
                    this.menu.record = row.data
                    return this[action](this, e)
                }
            }
        }
        return this.processEvent('click', e)
    }

})
Ext.reg('eshoplogistic3-grid-unload-places', eshoplogistic3.grid.UnloadPlaces);
