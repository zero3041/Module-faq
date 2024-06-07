<?php
declare(strict_types=1);

namespace Bss\Faq\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface CategorySearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get categories list.
     *
     * @return \Bss\Faq\Api\Data\CategoryInterface[]
     */
    public function getItems();

    /**
     * Set categories list.
     *
     * @param \Bss\Faq\Api\Data\CategoryInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
