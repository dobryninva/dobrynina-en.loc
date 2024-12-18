(function ($) {
    var a = null,
        mess = function (t, theme) {
            theme = theme || 'ms2-message-error';
            if (typeof ($.fn.jGrowl) == 'function') {
                $.jGrowl(t, {
                    theme: theme,
                    sticky: false
                });
            } else {
                alert(t)
                console.log(t);
            }
        };

    $(document).on('click', '.js-msie-download-price', function (e) {
        e.preventDefault();
        var key = $(this).data('key');
        var xhr = new XMLHttpRequest();
        if (!key) {
            console.log("Error download price. Not set key");
            return;
        }

        xhr.open('POST', 'assets/components/msimportexport/price.php', true);
        xhr.responseType = 'blob';
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function (e) {
            if (this.status == 200) {
                var error = xhr.getResponseHeader('msie-error');
                if (error) {
                    mess(decodeURIComponent(escape(error)));
                    return;
                }
                var filename = '';
                var disposition = xhr.getResponseHeader('Content-Disposition');
                if (disposition && disposition.indexOf('attachment') !== -1) {
                    var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                    var matches = filenameRegex.exec(disposition);
                    if (matches != null && matches[1]) filename = matches[1].replace(/['"]/g, '');
                }
                var blob = new Blob([this.response], {type: xhr.getResponseHeader('Content-Type')});
                var downloadUrl = URL.createObjectURL(blob);
                if (!a) {
                    a = document.createElement('a');
                    document.body.appendChild(a);
                }
                a.href = downloadUrl;
                a.download = filename;
                a.click();
            } else {
                mess('Unable to download price');
            }
        };
        xhr.send($.param({key: key}));
    });
})(jQuery);