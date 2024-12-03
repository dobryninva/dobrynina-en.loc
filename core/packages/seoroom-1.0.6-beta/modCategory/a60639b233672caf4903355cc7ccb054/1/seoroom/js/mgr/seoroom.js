var SEOroom = function (config) {
	config = config || {};
	SEOroom.superclass.constructor.call(this, config);
};
Ext.extend(SEOroom, Ext.Component, {
	page: {}, window: {}, grid: {}, tree: {}, panel: {}, combo: {}, config: {}, view: {}, utils: {}, form: {}
});
Ext.reg('seoroom', SEOroom);

SEOroom = new SEOroom();