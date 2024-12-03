function ResVideoGallery(key, options) {
    this.key = key;
    this.loading = false;
    this.reached = false;
    this.options = {
        lang: 'en',
        results: '.js-rvg-results',
        more: '.js-rvg-more',
        play: '.js-rvg-play',
        tag: '.js-rvg-tag',
        tagClear: '.js-rvg-tag-clear',
        review: 'rvg-photo:',
        loadingClass: 'loading',
        tagActiveClass: 'rvg-tag-active',
        maxWidth: 2560,
        maxHeight: 1440,
    };
    $.extend(true, this.options, options);

    this.tags = [];
    this.gallery = $('#rvg-' + key);
    this.results = $(this.options['results'], this.gallery);
    this.more = $(this.options['more'], this.gallery);

    this.setupPagination();
    this.setupEmbed();
    this.setupPhoto();
    this.setupTags();

}

ResVideoGallery.prototype.load = function (params, callback, append) {
    var self = this;
    if (this.loading) {
        return false;
    } else {
        this.loading = true;
    }

    if (!params || !Object.keys(params).length) {
        params = this.getParams();
    }

    switch (this.options['mode']) {
        case 'button':
        case 'scroll':
            break;
        default:
            window.location.href = window.location.href;
            return;
    }


    params.key = this.key;
    params.action = 'load';
    params.controller = 'video';
    params.pageId = this.options['pageId'];

    this.beforeLoad();
    $.post(this.options['actionUrl'], params, function (response) {
        self.loading = false;
        self.afterLoad();
        if (response['success']) {
            if (append) {
                self.results.append(response['data']['results']);
            } else {
                self.results.html(response['data']['results']);
            }
            self.options['total'] = response['data']['total'];
            self.setupPhoto();
            if (self.options['mode'] == 'button') {
                if (self.isShowBtnMore()) {
                    self.more.show();
                } else {
                    self.more.hide();
                }
            } else if (self.options['mode'] == 'scroll') {
                self.reached = !self.isShowBtnMore();
            }
            if (callback && $.isFunction(callback)) {
                callback.call(this, response, params);
            }
            $(document).trigger('rvg:load', response);
        } else {
            self.Message.error(response['message']);
        }
    }, 'json');
};
ResVideoGallery.prototype.addPage = function () {
    this.options['page'] = parseInt(this.options['page']) + 1;
    this.load(this.getParams(), null, true);
};
ResVideoGallery.prototype.getParams = function () {
    var params = {};
    if (parseInt(this.options['page']) > 0) {
        params[this.options['pageVarKey']] = this.options['page'];
    } else {
        this.Hash.remove(this.options['pageVarKey']);
    }
    if (this.tags.length) {
        params[this.options['tagsVar']] = this.tags.join();
        this.Hash.add(this.options['tagsVar'], params[this.options['tagsVar']]);
    } else {
        this.Hash.remove(this.options['tagsVar']);
    }
    return params;
};
ResVideoGallery.prototype.isShowBtnMore = function () {
    var total = parseInt(this.options['total']),
        limit = parseInt(this.options['limit']),
        page = parseInt(this.options['page']) + 1;
    if (page * limit >= total || limit >= total) {
        return false;
    } else {
        return true;
    }
};
ResVideoGallery.prototype.setupPagination = function () {
    var self = this;
    switch (this.options['mode']) {
        case 'button':
            if (this.isShowBtnMore()) {
                this.more.show();
            }
            this.more.on('click', function (e) {
                e.preventDefault();
                self.addPage();
            });
            break;

        case 'scroll':
            this.more.hide();
            var $window = $(window);
            $window.on('scroll', function () {
                if (!self.reached && $window.scrollTop() > self.gallery.height() - $window.height()) {
                    self.reached = true;
                    self.addPage();
                }
            });
            break;
    }
};
ResVideoGallery.prototype.calculateWindowSize = function () {
    var $w = $(window),
        ratio = $w.height() / $w.width(),
        newWidth = $w.width() - (($w.width() * 20) / 100);
    return {
        width: newWidth,
        height: newWidth * ratio
    };
};
ResVideoGallery.prototype.setupEmbed = function () {
    var self = this;

    $(document).on('click', this.options['play'], function (e) {
        e.preventDefault();
        var $this = $(this),
            id = $this.data('id'),
            size = self.calculateWindowSize();
        //console.log(size);
        if (id) {
            lightcase.start({
                swipe: true,
                href: self.options['actionUrl'],
                type: 'ajax',
                maxWidth: self.options['maxWidth'],
                maxHeight: self.options['maxHeight'],
                ajax: {
                    type: 'post',
                    width: size.width,
                    height: size.height,
                    data: {
                        id: id,
                        key: self.key,
                        action: 'embed',
                        controller: 'video',
                        data_type: 'html'
                    },
                    onBeforeShow: function () {
                        if (typeof (window.Plyr) !== 'function') return;
                        setTimeout(function () {
                            var player = new Plyr('#rvg-html5-player-' + id, {
                               // invertTime: false,
                                i18n: self.options.lang == 'ru' ? plyri18n.ru : plyri18n.en,
                                controls: ['play-large', // 'restart',
                                    // 'rewind',
                                    'play', // 'fast-forward',
                                    'progress', 'current-time', 'duration',
                                    'mute', 'volume', 'captions', 'settings', //'pip',
                                    'airplay',  //'download',
                                    'fullscreen']
                            });
                            player.on('ready', function (e) {
                                window.dispatchEvent(new Event("resize"));
                            });
                        }, lightcase.settings.speedIn + 10);
                    },
                },
            });
        } else {
            console.log("Error video ID not find!");
        }
    });
};
ResVideoGallery.prototype.setupPhoto = function () {
    if (!this.options['photoGallery']) return;
    $('a[data-rel^="' + this.options['review'] + this.key + '"]').lightcase({
        maxWidth: this.options['maxWidth'],
        maxHeight: this.options['maxHeight'],
    });
};
ResVideoGallery.prototype.setupTags = function () {
    var self = this;

    this.gallery.on('click', this.options['tag'], function (e) {
        e.preventDefault();
        var tag = $(this).text();
        $(self.options['tag'] + ':contains("' + tag + '")').each(function () {
            if ($(this).text() === tag)
                $(this).toggleClass(self.options['tagActiveClass']);
        });

        self.tags = [];
        $('.' + self.options['tagActiveClass'], self.gallery).each(function () {
            var tag = $(this).text();
            if ($.inArray(tag, self.tags) == -1) self.tags.push(tag);
        });
        self.options['page'] = 0;
        self.load(null, null, false);
    });

    this.gallery.on('click', this.options['tagClear'], function (e) {
        e.preventDefault();
        $('.' + self.options['tagActiveClass'], self.gallery).removeClass(self.options['tagActiveClass']);
        self.options['page'] = 0;
        self.tags = [];
        self.load(null, null, false);
    });

};
ResVideoGallery.prototype.beforeLoad = function () {
    this.gallery.addClass(this.options['loadingClass']);
    // this.results.css('opacity', .5);
};
ResVideoGallery.prototype.afterLoad = function () {
    this.gallery.removeClass(this.options['loadingClass']);
    //this.results.css('opacity', 1);
};
ResVideoGallery.prototype.Hash = {
    get: function () {
        var vars = {}, hash, splitter, hashes;
        if (!this.oldbrowser()) {
            var pos = window.location.href.indexOf('?');
            hashes = (pos != -1) ? decodeURIComponent(window.location.href.substr(pos + 1)) : '';
            splitter = '&';
        } else {
            hashes = decodeURIComponent(window.location.hash.substr(1));
            splitter = '/';
        }

        if (hashes.length == 0) {
            return vars;
        } else {
            hashes = hashes.split(splitter);
        }

        for (var i in hashes) {
            if (hashes.hasOwnProperty(i)) {
                hash = hashes[i].split('=');
                if (typeof hash[1] == 'undefined') {
                    vars['anchor'] = hash[0];
                } else {
                    vars[hash[0]] = hash[1];
                }
            }
        }
        return vars;
    },
    set: function (vars) {
        var hash = '';
        var i;
        for (i in vars) {
            if (vars.hasOwnProperty(i)) {
                hash += '&' + i + '=' + vars[i];
            }
        }
        if (!this.oldbrowser()) {
            if (hash.length != 0) {
                hash = '?' + hash.substr(1);
                var specialChars = {"%": "%25", "+": "%2B"};
                for (i in specialChars) {
                    if (specialChars.hasOwnProperty(i) && hash.indexOf(i) !== -1) {
                        hash = hash.replace(new RegExp('\\' + i, 'g'), specialChars[i]);
                    }
                }
            }
            window.history.pushState({ResVideoGallery: document.location.pathname + hash}, '', document.location.pathname + hash);
        } else {
            window.location.hash = hash.substr(1);
        }
    },
    add: function (key, val) {
        var hash = this.get();
        hash[key] = val;
        this.set(hash);
    },
    remove: function (key) {
        var hash = this.get();
        delete hash[key];
        this.set(hash);
    },
    clear: function () {
        this.set({});
    },
    oldbrowser: function () {
        return !(window.history && history.pushState);
    }
};
ResVideoGallery.prototype.Message = {
    success: function (message) {
    },
    error: function (message) {
        alert(message);
    }
};

function ResVideoGalleryUpload(key, options) {
    this.key = key;
    this.num = 0;
    this.loading = false;
    this.options = {
        notice: '.js-rvg-form-notice',
        error: '.js-rvg-form-error',
        container: '.js-rvg-form-container',
        set: '.js-rvg-form-video',
        inputUrl: '.js-rvg-form-url',
        thumb: '.js-rvg-form-thumb',
        info: '.js-rvg-form-video-info',
        btnRemove: '.js-rvg-form-btn-remove',
        tpl: '.rvg-tpl-form-video',
        loadingClass: 'rvg-form-loading',
        tagActiveClass: 'rvg-tag-active',
    };
    $.extend(true, this.options, options);
    this.form = $('#rvg-' + this.key);
    this.notice = $(this.options['notice'], this.form);
    this.container = $(this.options['container'], this.form);
    this.tpl = $(this.options['tpl'], this.form).html();
    this.bindEvents();
}

ResVideoGalleryUpload.prototype.beforeLoad = function () {
    this.form.addClass(this.options['loadingClass']);
};
ResVideoGalleryUpload.prototype.afterLoad = function () {
    this.form.removeClass('rvg-form-loading');
};
ResVideoGalleryUpload.prototype.getParams = function (params) {
    params = params || {};
    params.controller = 'upload';
    params.key = this.key;
    return params;

};
ResVideoGalleryUpload.prototype.scrape = function ($this) {
    if ($this.val()) {
        var self = this,
            $set = $this.closest(this.options['set']),
            $error = $(this.options['error'], $set);
        this.beforeLoad();
        this.notice.hide();
        $error.hide();
        $.ajax({
            dataType: 'json',
            type: 'POST',
            cache: false,
            url: this.options['actionUrl'],
            data: this.getParams({action: 'scrape', url: $this.val()}),
            success: function (e) {
                if (e.success == true) {
                    for (var key in e.video) {
                        if (key != 'thumb') {
                            $('.js-rvg-form-' + key, $set).val(e.video[key]);
                        } else {
                            $(self.options['thumb'], $set).attr('src', e.video[key]);
                        }
                    }
                    $(self.options['info'], $set).slideDown();
                    if (!$set.hasClass('rvg-form-scraped')) {
                        $set.addClass('rvg-form-scraped');
                        if (self.options['multiple'] && self.tpl) {
                            self.num++;
                            self.container.append(self.tpl.replace(/%num%/g, self.num));
                        }
                    }
                } else {
                    if (e.message) $error.html(e.message).show();
                }
            },
            complete: function (e) {
                self.afterLoad();
            },
            error: function (e) {
                console.log('error', e);
            }
        });
    }
};
ResVideoGalleryUpload.prototype.submit = function () {
    var self = this;
    this.beforeLoad();
    this.notice.hide();
    var params = this.form.serializeObject();
    params.action = 'upload';

    $.ajax({
        dataType: 'json',
        type: 'POST',
        cache: false,
        url: this.options['actionUrl'],
        data: this.getParams(params),
        success: function (e) {
            if (e.success == true) {
                self.container.find(self.options['set'] + ':not(:first)').remove();
                $(self.options['info'], self.form).css('display', 'none');
                $(self.options['thumb'], self.form).attr('src', '');
                self.form[0].reset();
                self.notice
                    .html(e.message)
                    .show();
                setTimeout(function () {
                    self.notice.slideUp();
                }, 1500);
            } else {
                if (e.message) self.notice.html(e.message).show();
            }
        },
        complete: function (e) {
            self.afterLoad();
        },
        error: function (e) {
            console.log('error', e);
        }
    });
};
ResVideoGalleryUpload.prototype.bindEvents = function () {
    var self = this;
    this.form.on('keydown paste', this.options['inputUrl'], function (e) {
        var $this = $(this);
        if (e.which == 13) e.preventDefault();
        if (e.which == 13 || e.type == 'paste') {
            setTimeout(function () {
                self.scrape($this);
            }, 100)
        }
    });

    this.form.on('click', this.options['btnRemove'], function (e) {
        e.preventDefault();
        var $set = $(this).closest(self.options['set']);
        $set.slideUp({
            complete: function () {
                $set.remove();
            }
        });
    });

    this.form.on('submit', function (e) {
        e.preventDefault();
        self.submit();
    });

};