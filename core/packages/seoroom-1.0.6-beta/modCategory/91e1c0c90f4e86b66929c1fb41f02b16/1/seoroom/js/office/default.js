Ext.onReady(function() {
	SEOroom.config.connector_url = OfficeConfig.actionUrl;

	var grid = new SEOroom.panel.Home();
	grid.render('office-seoroom-wrapper');

	var preloader = document.getElementById('office-preloader');
	if (preloader) {
		preloader.parentNode.removeChild(preloader);
	}
});