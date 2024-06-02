<?php
declare(strict_types=1);

namespace Bss\Faq\Model\ResourceModel\Category;

use Bss\Faq\Model\Faq;
use Bss\Faq\Model\ResourceModel\Faq as FaqCategoryResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 *
 * Internship collection
 */
class Collection extends AbstractCollection
{
    /**
     * Constructor function
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(Faq::class, FaqCategoryResourceModel::class);
    }
}
