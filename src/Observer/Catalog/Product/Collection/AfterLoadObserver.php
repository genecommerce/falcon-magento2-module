<?php

namespace Hatimeria\Reagento\Observer\Catalog\Product\Collection;

use Hatimeria\Reagento\Helper\Product as HatimeriaProductHelper;
use Hatimeria\Reagento\Helper\Stock as HatimeriaStockHelper;
use Magento\Catalog\Model\Product as Product;
use Magento\Catalog\Model\ResourceModel\Product\Collection as ProductCollection;
use Magento\Catalog\Model\ResourceModel\Product\Compare\Item\Collection as CompareProductItemCollection;
use Magento\Catalog\Model\ResourceModel\Product\Link\Product\Collection as ProductLinkCollection;
use Magento\ConfigurableProduct\Model\ResourceModel\Product\Type\Configurable\Product\Collection as ConfigurableProductCollection;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * @package Hatimeria\Reagento\Observer
 */
class AfterLoadObserver implements ObserverInterface
{
    /** @var HatimeriaProductHelper */
    protected $productHelper;

    /** @var HatimeriaStockHelper */
    protected $stockHelper;

    /** @var ScopeConfigInterface */
    protected $scopeConfig;

    /**
     * @param HatimeriaProductHelper $productHelper
     * @param HatimeriaStockHelper $stockHelper
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        HatimeriaProductHelper $productHelper,
        HatimeriaStockHelper $stockHelper,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->productHelper = $productHelper;
        $this->stockHelper = $stockHelper;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @param EventObserver $observer
     */
    public function execute(EventObserver $observer)
    {
        /** @var ProductCollection $collection */
        $collection = $observer->getEvent()->getCollection();

        // hey, let's extend basic product collection class but do not redefine event prefixes
        // so every event will be fired for us as well
        // cause it's better than require developer to make 3 entries in xml events file
        if (
            $collection instanceof ProductLinkCollection
            || $collection instanceof CompareProductItemCollection
            || $collection instanceof ConfigurableProductCollection
        ) {
            return;
        }

        $addEmptyProductLinks = $this->scopeConfig->getValue(
            'reagento/catalog/disable_product_links',
            ScopeInterface::SCOPE_STORE,
            $collection->getStoreId()
        );
        foreach ($collection as $item) {
            /** @var Product $item */
            if ($addEmptyProductLinks ) {
                $item->setProductLinks([]);   //improve speed when building output array
            }
            $this->productHelper->ensurePriceForConfigurableProduct($item);
            $this->productHelper->calculateCatalogDisplayPrice($item);
            $this->productHelper->addProductImageAttribute($item, 'product_list_image', 'thumbnail_url');
        }

        $this->stockHelper->addStockDataToCollection($collection);
    }
}
