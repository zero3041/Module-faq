<?php
declare(strict_types=1);

namespace Bss\Faq\Model\FaqCategoryLink;

use Bss\Faq\Api\Data\FaqCategoryLinkSearchResultsInterface;
use Magento\Framework\Api\SearchResults;

/**
 * Class FaqCategoryLinkSearchResults
 *
 * Search results for a Faq Category Link SearchResults
 */
class FaqCategoryLinkSearchResults extends SearchResults implements FaqCategoryLinkSearchResultsInterface
{
}
