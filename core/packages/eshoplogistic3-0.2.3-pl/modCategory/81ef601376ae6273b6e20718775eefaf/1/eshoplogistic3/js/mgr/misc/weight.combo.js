//author Ivan Klimchuk
let EslWeightUnit = function(config) {
  config = config || {};

  Ext.applyIf(config, {
    store: new Ext.data.ArrayStore({
		id: 0,
		fields: ['key','value'],
		data: [
		  ['kg', 'Килограммы'],
		  ['gm', 'Граммы']
		]
	}),
    name: 'esl_weight_unit',
    hiddenName: 'eshoplogistic3_weight_unit',
    displayField: 'value',
    valueField: 'key',
    mode: 'local',
    triggerAction: 'all',
    editable: false,
    selectOnFocus: false,
    preventRender: false
  });

  EslWeightUnit.superclass.constructor.call(this, config);
};

Ext.extend(EslWeightUnit, MODx.combo.ComboBox);
Ext.reg('eshoplogistic3_weight_unit', EslWeightUnit);