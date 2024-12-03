<?php

class msSetInCartOnDocFormPrerender extends msSetInCartPlugin
{
    public function run()
    {
        $mode = $this->modx->getOption('mode', $this->scriptProperties, modSystemEvent::MODE_NEW, true);
        if ($mode == modSystemEvent::MODE_NEW) {
            return;
        }

        /** @var modResource $resource */
        $resource = $this->modx->getOption('resource', $this->scriptProperties, null, true);
        if (
            !$resource
            OR
            !$this->msSetInCart->isWorkingClassKey($resource)
            OR
            !$this->msSetInCart->isWorkingTemplates($resource)
        ) {
            return;
        }

        $this->msSetInCart->loadControllerJsCss($this->modx->controller, array(
            'css'    => true,
            'config' => true,
            'tools'  => true,
            'link'   => true,
        ));
    }
}