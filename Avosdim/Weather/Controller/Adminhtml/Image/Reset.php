<?php

namespace Avosdim\Weather\Controller\Adminhtml\Image;

use AllowDynamicProperties;
use Avosdim\Weather\Model\ImageFactory;
use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Avosdim\Weather\Model\ListingiconFactory;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Magento\Ui\Component\MassAction\Filter;
use Avosdim\Weather\Model\ResourceModel\Listingicon\CollectionFactory;
use Avosdim\Weather\Model\ResourceModel\Image as ResourcePost;
use Magento\Framework\Registry;


#[AllowDynamicProperties] class Reset extends Action
{
    const ADMIN_RESOURCE = "Avosdim_Weather::image_edit";

    /**
     * @var DataPersistorInterface
     */
    private DataPersistorInterface $dataPersistor;

    /**
     * @param Context $context
     * @param Filter $filter
     * @param ListingiconFactory $listingiconFactory
     * @param DataPersistorInterface $dataPersistor
     * @param CollectionFactory $collectionFactory
     * @param ImageFactory $imageFactory
     * @param ResourcePost $resourcePost
     * @param Registry $registry
     */
    public function __construct(
        Context                    $context,
        Filter                     $filter,
        private listingiconFactory $listingiconFactory,
        DataPersistorInterface     $dataPersistor,
        CollectionFactory          $collectionFactory,
        ImageFactory               $imageFactory,
        ResourcePost               $resourcePost,
        Registry                   $registry
    )
    {
        parent::__construct($context);
        $this->filter = $filter;
        $this->dataPersistor = $dataPersistor;
        $this->collectionFactory = $collectionFactory;
        $this->imageFactory = $imageFactory;
        $this->resourcePost = $resourcePost;
        $this->registry = $registry;
    }

    /**
     * @return ResultInterface|ResponseInterface|Redirect
     */
    public function execute(): ResultInterface|ResponseInterface|Redirect
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('id');
        $image = $this->imageFactory->create()->load($id);
        $path = $image->getData('original_path');
        if (!$path){
            $image->setData('original_path', true);
            try {
                $image->save();
            } catch (Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            }
        }
        $originalPath = $image->getData('original_path');
        return $resultRedirect->setPath('*/*/');
    }
}
