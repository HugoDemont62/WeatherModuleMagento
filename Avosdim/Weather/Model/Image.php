<?php

declare(strict_types=1);

namespace Avosdim\Weather\Model;

use Avosdim\Weather\Api\Data\ImageInterface as ImageInterface;
use Avosdim\Weather\Model\ResourceModel\Image as ResourcePost;
use Magento\Framework\Model\AbstractModel;

class Image extends AbstractModel implements ImageInterface
{
    const CACHE_TAG = 'avosdim_weather_image';


    /**
     * {@inheritdoc}
     */
    protected $_idFieldName = ImageInterface::ID;

    /**
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(ResourcePost::class);
    }

    /**
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->getData(ImageInterface::PATH);
    }

    /**
     * @param string $path
     *
     * @return ImageInterface
     */
    public function setPath(string $path): ImageInterface
    {
        return $this->setData(ImageInterface::PATH, $path);
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->getData(ImageInterface::CREATED_AT);
    }

    /**
     * @param string $createdAt
     *
     * @return ImageInterface
     */
    public function setCreatedAt(string $createdAt): ImageInterface
    {
        return $this->setData(ImageInterface::CREATED_AT, $createdAt);
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->getData(ImageInterface::UPDATED_AT);
    }

    /**
     * @param string $updatedAt
     *
     * @return ImageInterface
     */
    public function setUpdatedAt(string $updatedAt): ImageInterface
    {
        return $this->setData(ImageInterface::UPDATED_AT, $updatedAt);
    }

    /**
     * @return string
     */
    public function getIdField(): string
    {
        return $this->getId();
    }
}
