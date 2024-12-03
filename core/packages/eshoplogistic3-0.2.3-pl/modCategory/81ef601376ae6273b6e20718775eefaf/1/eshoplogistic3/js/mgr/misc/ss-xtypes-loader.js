//author Ivan Klimchuk

let TypesListSpec = Ext.ComponentMgr.create(
  Ext.ComponentMgr.types['modx-combo-xtype-spec']
);

const record = new TypesListSpec.initialConfig.store.recordType(
  {d: 'Единицы измерения веса', v: 'eshoplogistic3_weight_unit'}
);

TypesListSpec.initialConfig.store.add(record);

TypesList = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        store: TypesListSpec.initialConfig.store,
        displayField: 'd',
        valueField: 'v',
        mode: 'local',
        name: 'xtype',
        hiddenName: 'xtype',
        triggerAction: 'all',
        editable: false,
        selectOnFocus: false,
        value: 'textfield'
    });
    TypesList.superclass.constructor.call(this, config);
};
Ext.extend(TypesList, Ext.form.ComboBox);
Ext.reg('modx-combo-xtype-spec', TypesList);