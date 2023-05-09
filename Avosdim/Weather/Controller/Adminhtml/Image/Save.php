<?php

namespace Avosdim\Weather\Controller\Adminhtml\Image;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Avosdim\Weather\Model\ListingiconFactory;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;

class Save extends Action
{
    const ADMIN_RESOURCE = "Avosdim_Weather::image_edit";

    /**
     * @var DataPersistorInterface
     */
    private DataPersistorInterface $dataPersistor;

    /**
     * @param Context $context
     * @param ListingiconFactory $listingiconFactory
     * @param DataPersistorInterface $dataPersistor
     */
    public function __construct(
        Context                    $context,
        private listingiconFactory $listingiconFactory,
        DataPersistorInterface     $dataPersistor
    )
    {
        parent::__construct($context);
        $this->dataPersistor = $dataPersistor;
    }

    /**
     * @return ResponseInterface|Redirect|ResultInterface
     */
    public function execute(): ResponseInterface|Redirect|ResultInterface
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $iconModel = $this->listingiconFactory->create();
            $id = $this->getRequest()->getParam('image_id');
            if (empty($data['image_id'])) {
                $data['image_id'] = null;
            }
            if ($id) {
                $iconModel->load($id);
            }
            // get le cookie image_path pour avoir le chemin de l'image
            if (isset($_COOKIE['image_path'])) {
                if ($_COOKIE['image_path']) {
                    $this->messageManager->addSuccessMessage(__($_COOKIE['image_path'] . " is the new path of your icon for " . $data['image_name']));
                    $data['path'] = $_COOKIE['image_path'];
                    $data['original_path'] = false;
                }
            }
            $iconModel->setData($data);
            try {
                $iconModel->save();
                $this->messageManager->addSuccessMessage(__('Record SucessFully Updated'));
                $this->dataPersistor->clear('avosdim_weather_image');

                return $resultRedirect->setPath('*/*/edit', ['id' => $iconModel->getId() ?? $id]);
            } catch (Exception $exception) {
                $this->messageManager->addExceptionMessage($exception, __('Something Went to Wrong While save data'));
            }
            $this->dataPersistor->set('avosdim_weather_image', $data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
        }
        return $resultRedirect->setPath('*/*/index');
    }
}
