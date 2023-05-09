<?php

namespace Avosdim\Weather\Controller\Adminhtml\Image;

use Exception;
use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Avosdim\Weather\Model\ImageUploader;

class Upload extends Action
{
    public ImageUploader $imageUploader;

    public function __construct(
        Context       $context,
        ImageUploader $imageUploader
    )
    {
        parent::__construct($context);
        $this->imageUploader = $imageUploader;
    }

    /**
     * @return bool
     */
    public function _isAllowed(): bool
    {
        return $this->_authorization->isAllowed('Avosdim_Weather::image');
    }

    public function execute()
    {
        try {
            $id = $this->getRequest()->getParam('image_id');
            $imageName = $this->getRequest()->getParam('image_name');
            $result = $this->imageUploader->saveFileToTmpDir('image', $id, $imageName);
            $result['cookie'] = [
                'name' => $this->_getSession()->getName(),
                'value' => $this->_getSession()->getSessionId(),
                'lifetime' => $this->_getSession()->getCookieLifetime(),
                'path' => $this->_getSession()->getCookiePath(),
                'domain' => $this->_getSession()->getCookieDomain(),
            ];
        } catch (Exception $e) {
            $result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
        }
        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($result);
    }
}
