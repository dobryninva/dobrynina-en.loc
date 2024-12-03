<?php

require_once MODX_CORE_PATH . 'components/minishop2/processors/mgr/product/productlink/remove.class.php';

class modMsProductLinkRemoveProcessor extends msProductLinkRemoveProcessor
{
    public $classKey = 'msLink';

}

return 'modMsProductLinkRemoveProcessor';