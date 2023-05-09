<?php

namespace Avosdim\Weather\Controller\Adminhtml\Image;

use Magento\Backend\App\Action;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Avosdim\Weather\Model\ImageFactory;
use Avosdim\Weather\Model\ResourceModel\Image as ResourcePost;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Backend\Model\View\Result\Redirect;

class Edit extends Action
{
    /**
     * {@inheritdoc}
     */
    public const ADMIN_RESOURCE = 'Avosdim_Weather::image_edit';

    /**
     * @var PageFactory
     */
    protected PageFactory $resultPageFactory;
    /**
     * @var Registry
     */
    protected Registry $registry;
    /**
     * @var ImageFactory
     */
    protected ImageFactory $imageFactory;
    /**
     * @var ResourcePost
     */
    protected ResourcePost $resourcePost;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param Registry $registry
     * @param ImageFactory $imageFactory
     * @param ResourcePost $resourcePost
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Registry $registry,
        ImageFactory $imageFactory,
        ResourcePost $resourcePost
    ) {
        parent::__construct($context);

        $this->resultPageFactory = $resultPageFactory;
        $this->registry = $registry;
        $this->imageFactory = $imageFactory;
        $this->resourcePost = $resourcePost;
    }

    /**
     * {@inheritDoc}
     *
     * @return Page|Redirect
     */
    public function execute(): Redirect|Page
    {
        /** @var int|null $id */
        $id = $this->getRequest()->getParam('image_id');
        $image = $this->imageFactory->create();

        if ($id) {
            $this->resourcePost->load($image, $id);
            if (!$image->getId()) {
                $this->messageManager->addErrorMessage(__('This image no longer exists.'));
                /** @var Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        $this->registry->register('avosdim_weather_image', $image);
        $resultPage = $this->initAction();

        $breadcrumb = __('New image');
        if ($id) {
            $breadcrumb = __('Edit image');
        }
        $resultPage->addBreadcrumb($breadcrumb, $breadcrumb);
        $title = __('Update icon');
        if ($image->getId()) {
            $title = $image->getTitle();
        }
        $pageTitle = $resultPage->getConfig()->getTitle();
        $pageTitle->prepend(__('Image'));
        $pageTitle->prepend($title);

        return $resultPage;
    }

    /**
     * @return Page
     */
    private function initAction(): Page
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Avosdim_Weather::index');
        $resultPage->addBreadcrumb(__('Image'), __('Image'));
        $resultPage->addBreadcrumb(
            __('Manage Image'),
            __('Manage Image')
        );
        return $resultPage;
    }
}
