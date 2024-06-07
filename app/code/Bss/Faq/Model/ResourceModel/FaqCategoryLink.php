<?php
declare(strict_types=1);

namespace Bss\Faq\Model\ResourceModel;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class FaqCategoryLink
 *
 * Faq Category Link represents
 */
class FaqCategoryLink extends AbstractDb
{
    /**
     * Function constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('faq_category_link', null);
    }

    /**
     * Function to delete
     *
     * @param int $faqId
     * @throws LocalizedException
     */
    public function deleteCategoryLinksByFaqId($faqId)
    {
        $connection = $this->getConnection();
        $connection->delete($this->getMainTable(), ['faq_id = ?' => $faqId]);
    }
}
