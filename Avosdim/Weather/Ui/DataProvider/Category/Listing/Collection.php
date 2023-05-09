<?php

namespace Avosdim\Weather\Ui\DataProvider\Category\Listing;


use Avosdim\Weather\Model\Listingicon as Post;
use Avosdim\Weather\Model\ResourceModel\Listingicon\CollectionFactory;
use Magento\Framework\Api\Filter;
use Magento\Framework\Registry;
use Magento\Ui\DataProvider\AbstractDataProvider;

class Collection extends AbstractDataProvider
{
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;
    /**
     * @var Registry
     */
    protected $registry;
    /**
     * @var mixed[]
     */
    protected $loadedData;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param Registry $registry
     * @param array $meta
     * @param array $data
     */
    public function __construct(
    string $name,
    string $primaryFieldName,
    string $requestFieldName,
    CollectionFactory $collectionFactory,
    Registry $registry,
    array $meta = [],
    array $data = []
) {
    parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);

    $this->collectionFactory = $collectionFactory;
    $this->registry = $registry;
}

    /**
     * @return mixed[][]
     */
    public function getData(): array
{
    if (isset($this->loadedData)) {
        return $this->loadedData;
    }

    /** @var Post[] $posts */
    $posts = $this->collectionFactory->create()->getItems();

    foreach ($posts as $post) {
        $this->loadedData[$post->getId()] = $post->getData();
    }

    return $this->loadedData ?? [];
}

    /**
     * @param Filter $filter
     *
     * @return null
     */
    public function addFilter(Filter $filter)
{
    return null;
}
}
