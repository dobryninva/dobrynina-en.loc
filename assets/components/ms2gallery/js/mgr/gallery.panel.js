ms2Gallery.panel.Gallery = function (config) {
    config = config || {};

    Ext.apply(config, {
        border: false,
        id: 'ms2gallery-page',
        baseCls: 'x-panel ms2gallery',
        items: [{
            border: false,
            style: {padding: '10px 5px'},
            xtype: 'ms2gallery-page-toolbar',
            id: 'ms2gallery-page-toolbar',
            record: config.record,
        }, {
            border: false,
            style: {padding: '5px'},
            layout: 'anchor',
            items: [{
                border: false,
                xtype: 'ms2gallery-images-panel',
                id: 'ms2gallery-images-panel',
                cls: 'modx-pb-view-ct',
                resource_id: config.record.id,
                pageSize: parseInt(config.pageSize || MODx.config.ms2gallery_page_size)
            }]
        }]
    });
    ms2Gallery.panel.Gallery.superclass.constructor.call(this, config);

    this.on('show', function () {
        this.initialize();
    });
};
Ext.extend(ms2Gallery.panel.Gallery, MODx.Panel, {
    errors: '',
    progress: null,

    initialize: function () {
        if (this.initialized) {
            return;
        }
        this._initUploader();

        var el = document.getElementById(this.id);
        el.addEventListener('dragenter', function () {
            if (!this.className.match(/drag-over/)) {
                this.className += ' drag-over';
            }
        }, false);
        el.addEventListener('dragleave', function () {
            this.className = this.className.replace(' drag-over', '');
        }, false);
        el.addEventListener('drop', function () {
            this.className = this.className.replace(' drag-over', '');
        }, false);

        this.initialized = true;
    },

    _initUploader: function () {
        var params = {
            action: 'mgr/gallery/upload',
            id: this.record.id,
            source: this.record.source,
            ctx: 'mgr',
            HTTP_MODAUTH: MODx.siteId
        };
        var config = {
            url: ms2Gallery.config.connector_url + '?' + Ext.urlEncode(params),
            browse_button: 'ms2gallery-resource-upload-btn',
            container: this.id,
            drop_element: this.id,
            multipart: true,
        }
        if (ms2Gallery.config.media_source.allowedFileTypes) {
            config.filters = [{
                title: "Image files",
                extensions: ms2Gallery.config.media_source.allowedFileTypes || 'jpg,jpeg,png,gif'
            }]
        }
        if (ms2Gallery.config.media_source.maxUploadSize) {
            config.max_file_size = ms2Gallery.config.media_source.maxUploadSize
        }
        if (ms2Gallery.config.media_source.maxUploadWidth && ms2Gallery.config.media_source.maxUploadHeight) {
            config.resize = {
                width: ms2Gallery.config.media_source.maxUploadWidth,
                height: ms2Gallery.config.media_source.maxUploadHeight
            }
        }

        this.uploader = new plupload.Uploader(config);

        var uploaderEvents = ['FilesAdded', 'FileUploaded', 'QueueChanged', /*'UploadFile',*/ 'UploadProgress', 'UploadComplete'];
        Ext.each(uploaderEvents, function (v) {
            var fn = 'on' + v;
            this.uploader.bind(v, this[fn], this);
        }, this);

        this.uploader.init();
    },

    onFilesAdded: function () {
        this.updateList = true;
    },

    removeFile: function (id) {
        this.updateList = true;
        var f = this.uploader.getFile(id);
        this.uploader.removeFile(f);
    },

    onQueueChanged: function (up) {
        if (this.updateList) {
            if (this.uploader.files.length > 0) {
                this.progress = Ext.MessageBox.progress(_('please_wait'));
                this.uploader.start();
            }
            else if (this.progress) {
                this.progress.hide();
            }
            up.refresh();
        }
    },

    /*
     onUploadFile: function (uploader, file) {
     this.updateFile(file);
     },
     */

    onUploadProgress: function (uploader, file) {
        if (this.progress) {
            this.progress.updateText(file.name);
            this.progress.updateProgress(file.percent / 100);
        }
    },

    onUploadComplete: function () {
        if (this.progress) {
            this.progress.hide();
        }
        if (this.errors.length > 0) {
            this.fireAlert();
        }
        this.resetUploader();

        var panel = Ext.getCmp('ms2gallery-images-panel');
        if (panel) {
            panel.view.getStore().reload();
            if (typeof(miniShop2) != 'undefined') {
                MODx.Ajax.request({
                    url: miniShop2.config.connector_url,
                    params: {
                        action: 'mgr/product/get',
                        id: this.record.id
                    },
                    listeners: {
                        success: {
                            fn: function (r) {
                                panel.view.updateThumb(r.object['thumb']);
                            }
                        }
                    }
                });
            }
        }
    },

    onFileUploaded: function (uploader, file, xhr) {
        var r = Ext.util.JSON.decode(xhr.response);
        if (!r.success) {
            this.addError(file.name, r.message);
        }
    },

    resetUploader: function () {
        this.uploader.files = {};
        this.uploader.destroy();
        this.errors = '';
        this._initUploader();
    },

    addError: function (file, message) {
        this.errors += file + ': ' + message + '<br/>';
    },

    fireAlert: function () {
        MODx.msg.alert(_('ms2_errors'), this.errors);
    },

    /*
     updateFile: function(file) {
     this.uploadGrid.updateFile(file);
     },
     */

});
Ext.reg('ms2gallery-page', ms2Gallery.panel.Gallery);