<?php
declare(strict_types=1);

namespace Bss\Faq\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Internship
 *
 * Resource Model Internship
 */
class Category extends AbstractDb
{
    /**
     * Function constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('faq_category', 'entity_id');
    }
}
