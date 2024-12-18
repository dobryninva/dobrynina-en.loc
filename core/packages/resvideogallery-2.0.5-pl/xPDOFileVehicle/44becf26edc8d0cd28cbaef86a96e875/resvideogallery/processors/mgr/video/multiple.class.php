<?php

class ResVideoGalleryMultipleProcessor extends modProcessor {

	/**
	 * @return array|string
	 */
	public function process() {
		if (!$method = $this->getProperty('method', false)) {
			return $this->failure();
		}
		$ids = $this->modx->fromJSON($this->getProperty('ids'));
		if (empty($ids)) {
			return $this->success();
		}

		foreach ($ids as $id) {
			/** @var modProcessorResponse $response */
			$response = $this->modx->runProcessor('mgr/video/' . $method,
				array('id' => $id),
				array('processors_path' => MODX_CORE_PATH . 'components/resvideogallery/processors/')
			);
			if ($response && $response->isError()) {
				return $response->getResponse();
			}
		}

		return $this->success();
	}

}

return 'ResVideoGalleryMultipleProcessor';