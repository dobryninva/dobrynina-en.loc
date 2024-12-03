var mssetincart = function (config) {
	config = config || {};
	mssetincart.superclass.constructor.call(this, config);
};
Ext.extend(mssetincart, Ext.Component, {
	page: {}, window: {}, grid: {}, tree: {}, panel: {}, combo: {}, config: {}, view: {}, tools: {}
});
Ext.reg('mssetincart', mssetincart);

mssetincart = new mssetincart();