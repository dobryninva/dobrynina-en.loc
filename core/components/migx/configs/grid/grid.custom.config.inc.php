<?php
$ctx = '{$ctx}';
$val = "' + val + '";

$httpimg = '<img style="height:60px" src="'.$val.'"/>';

$phpthumb = "'+MODx.config.connectors_url+'system/phpthumb.php?h=60&src=images/'+val+'";
$phpthumbimg = '<img src="'.$phpthumb.'" alt="" />';
// для множественных фото
$renderer['this.renderImageFix'] = "
    renderImageFix : function(val, md, rec, row, col, s){
        var source = s.pathconfigs[col];
        if (val !== null) {
            if (val.substr(0,4) == 'http'){
                return '{$httpimg}' ;
            }
            if (val != ''){
                return '{$phpthumbimg}';
            }
            return val;
        }
    }
";