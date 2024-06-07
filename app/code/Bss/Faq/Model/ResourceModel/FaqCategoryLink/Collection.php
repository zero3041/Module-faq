<?php
declare(strict_types=1);

namespace Bss\Faq\Model\ResourceModel\FaqCategoryLink;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 *
 * FaqCategoryLink Collection
 */
class Collection extends AbstractCollection
{
    /**
     * Function constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Bss\Faq\Model\FaqCategoryLink::class, \Bss\Faq\Model\ResourceModel\FaqCategoryLink::class);
    }
}
