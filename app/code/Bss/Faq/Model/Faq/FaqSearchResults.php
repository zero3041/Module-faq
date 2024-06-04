<?php
declare(strict_types=1);

namespace Bss\Faq\Model\Faq;

use Bss\Faq\Api\Data\FaqSearchResultsInterface;
use Magento\Framework\Api\SearchResults;

/**
 * Class CategorySearchResults
 *
 * Search results for a category
 */
class FaqSearchResults extends SearchResults implements FaqSearchResultsInterface
{
}
