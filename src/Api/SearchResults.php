<?php

namespace Hatimeria\Reagento\Api;

use Hatimeria\Reagento\Api\Data\ProductSearchResultsInterface;

class SearchResults extends \Magento\Framework\Api\SearchResults implements ProductSearchResultsInterface
{
    const KEY_FILTERS = 'filters';

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return $this->_get(self::KEY_FILTERS) === null ? [] : $this->_get(self::KEY_FILTERS);
    }

    /**
     * {@inheritdoc}
     */
    public function setFilters(array $items)
    {
        return $this->setData(self::KEY_FILTERS, $items);
    }
}