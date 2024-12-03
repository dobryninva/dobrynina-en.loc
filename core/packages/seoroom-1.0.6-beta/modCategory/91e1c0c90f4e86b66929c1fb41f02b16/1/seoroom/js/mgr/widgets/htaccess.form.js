SEOroom.form.Htaccess = function(config){

    config = config || {};
    if (!config.id) {
        config.id = 'seoroom-form-htaccess';
    }

    Ext.applyIf(config, {
        file: '.htaccess',
        textarea_name: 'content_htaccess'
    });

    SEOroom.form.Htaccess.superclass.constructor.call(this, config);

};

Ext.extend(SEOroom.form.Htaccess, SEOroom.form.Robots, {});

Ext.reg('seoroom-form-htaccess', SEOroom.form.Htaccess);