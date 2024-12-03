var eshoplogistic3 = function (config) {
    config = config || {};
    eshoplogistic3.superclass.constructor.call(this, config);
};
Ext.extend(eshoplogistic3, Ext.Component, {
    page: {}, window: {}, grid: {}, tree: {}, panel: {}, combo: {}, config: {}, view: {}, utils: {}
});
Ext.reg('eshoplogistic3', eshoplogistic3);

eshoplogistic3 = new eshoplogistic3();