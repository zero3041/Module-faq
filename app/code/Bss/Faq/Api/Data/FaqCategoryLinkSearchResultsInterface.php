<?php
declare(strict_types=1);

namespace Bss\Faq\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface FaqCategoryLinkSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get categories list.
     *
     * @return \Bss\Faq\Api\Data\FaqCategoryLinkInterface[]
     */
    public function getItems();

    /**
     * Set categories list.
     *
     * @param \Bss\Faq\Api\Data\FaqCategoryLinkInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
