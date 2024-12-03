SEOroom.form.Robots = function(config){

    var self = this;
    config = config || {};
    if (!config.id) {
        config.id = 'seoroom-form-robots';
    }

    Ext.applyIf(config, {
        file: 'robots.txt',
        labelAlign: 'top',
        frame:true,
        bodyStyle:'padding:5px',
        anchor:'100% 100%',
        items: [{
            xtype:'textarea',
            name: 'content_file',
            style: {
                width: '100%',
                'min-height': '340px'
            },
            listeners: {
                'render': function(){
                    this.getEl().on('keyup', function(){
                        self.buttons[0].addClass('primary-button');
                    });
                }
            }
        }],
        buttons: [{
            text: 'Save',
            name: 'save_robots',
            handler: function(b, e){
                self.saveFile(config, self);
            }
        },{
            text: 'Cancel',
            id: 'cancel_robots',
            handler: function(b, e){
                self.getText(config, self);
                self.buttons[0].removeClass('primary-button');
            }
        }]
    });

    this.getText(config, this);
    SEOroom.form.Robots.superclass.constructor.call(this, config);

};

Ext.extend(SEOroom.form.Robots, MODx.FormPanel, {

    saveFile: function(config, self){

        MODx.Ajax.request({
            url: SEOroom.config.connector_url,
            params: {
                action: 'mgr/files/update',
                file: config.file,
                content: self.find('name', 'content_file')[0].getValue()
            },
            listeners: {
                success: {
                    fn: function (r) {

                        var html = '';

                        if (r.success !== false) {
                            html = '<p style="text-align:center;" >Файл успешно изменен</p>';
                            self.buttons[0].removeClass('primary-button');
                        }else{
                            html = '<p style="text-align:center; color:red">Ошибка изменения файла: ' + r.message + '</p>';
                        }

                        var win = new Ext.Window({
                            title : 'Информация',
                            width : 400,
                            height: 100,
                            html : html
                        });

                        win.show();
                        win.center();

                    },
                    scope: this
                }
            }
        });

    },

    getText: function(config, self) {

        MODx.Ajax.request({
            url: SEOroom.config.connector_url,
            params: {
                action: 'mgr/files/get',
                file: config.file
            },
            listeners: {
                success: {
                    fn: function (r) {
                        if (r.success !== false) {
                            self.find('name', 'content_file')[0].setValue(r.object.content);
                        }
                    },
                    scope: this
                }
            }
        });
    }

});

Ext.reg('seoroom-form-robots', SEOroom.form.Robots);