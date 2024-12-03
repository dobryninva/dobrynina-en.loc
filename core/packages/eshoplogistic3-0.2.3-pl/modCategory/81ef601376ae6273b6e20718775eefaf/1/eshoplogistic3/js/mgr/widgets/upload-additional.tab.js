eshoplogistic3.grid.UnloadAdditional = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'eshoplogistic3-grid-unload-additional'
    }
    Ext.applyIf(config, {
        url: eshoplogistic3.config.connector_url,
        fields: this.getFields(),
        columns: this.getColumns(),
        tbar: this.getTopBar(),
        sm: new Ext.grid.CheckboxSelectionModel(),
        baseParams: {
            action: 'mgr/order/additional',
            order_id: config.order_id,
            service: config.data.service.code,
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
    eshoplogistic3.grid.UnloadAdditional.superclass.constructor.call(this, config);

    this.store.on('load', function () {
        if (this._getSelectedIds().length) {
            this.getSelectionModel().clearSelections();
        }
    }, this)
}

Ext.extend(eshoplogistic3.grid.UnloadAdditional, MODx.grid.Grid, {

    getFields: function () {
        return ['type', 'code', 'name', 'count', 'actions']
    },

    getColumns: function () {
        return [{
            header: _('eshoplogistic3_unload_additional_type'),
            dataIndex: 'type',
            sortable: false,
            width: 60
        }, {
            header: _('eshoplogistic3_unload_additional_code'),
            dataIndex: 'code',
            sortable: false,
            width: 80
        }, {
            header: _('eshoplogistic3_unload_additional_name'),
            dataIndex: 'name',
            sortable: false,
            width: 250
        }, {
            header: _('eshoplogistic3_unload_additional_count'),
            dataIndex: 'count',
            sortable: false,
            width: 40
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
            text: '<i class="icon icon-plus"></i>&nbsp;' + _('eshoplogistic3_unload_additional_create'),
            handler: this.createItem,
            scope: this
        }]
    },

    createItem: function (btn, e) {
        let w = MODx.load({
            xtype: 'eshoplogistic3-additional-window-create',
            id: Ext.id(),
            data: this.config.data,
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

        MODx.Ajax.request({
            url: this.config.url,
            params: {
                action: 'mgr/order/additional',
                mode: 'get',
                order_id: this.config.order_id,
                service: this.config.data.service.code,
                id: this.menu.record.code
            },
            listeners: {
                success: {
                    fn: function (r) {
                        let w = MODx.load({
                            xtype: 'eshoplogistic3-additional-window-update',
                            id: Ext.id(),
                            order_id: this.config.order_id,
                            data: this.config.data,
                            service: this.config.data.service.code,
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
            ids.push(selected[i]['data']['code'])
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
                ? _('eshoplogistic3_additionals_remove')
                : _('eshoplogistic3_additional_remove'),
            text: ids.length > 1
                ? _('eshoplogistic3_additionals_remove_confirm')
                : _('eshoplogistic3_additional_remove_confirm'),
            url: this.config.url,
            params: {
                action: 'mgr/order/additional',
                mode : 'remove',
                order_id: this.config.order_id,
                service: this.config.data.service.code,
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
Ext.reg('eshoplogistic3-grid-unload-additional', eshoplogistic3.grid.UnloadAdditional);
