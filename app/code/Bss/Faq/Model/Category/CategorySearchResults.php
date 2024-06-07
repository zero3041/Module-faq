<?php
declare(strict_types=1);

namespace Bss\Faq\Model\Category;

use Bss\Faq\Api\Data\CategorySearchResultsInterface;
use Magento\Framework\Api\SearchResults;

/**
 * Class CategorySearchResults
 *
 * Search results for a category
 */
class CategorySearchResults extends SearchResults implements CategorySearchResultsInterface
{
}
