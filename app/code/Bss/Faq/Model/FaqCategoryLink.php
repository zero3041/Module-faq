<?php
declare(strict_types=1);

namespace Bss\Faq\Model;

use Magento\Framework\Model\AbstractModel;

/**
 * Class FaqCategoryLink
 *
 * Model class Faq Category Link
 */
class FaqCategoryLink extends AbstractModel implements \Bss\Faq\Api\Data\FaqCategoryLinkInterface
{
    /**
     * Function constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Bss\Faq\Model\ResourceModel\FaqCategoryLink::class);
    }

    /**
     * Get FaqId
     *
     * @return mixed
     */
    public function getFaqId()
    {
        return $this->getData(self::FAQ_ID);
    }

    /**
     * Set faq id
     *
     * @param int $faqId
     * @return mixed
     */
    public function setFaqId($faqId)
    {
        return $this->setData(self::FAQ_ID, $faqId);
    }

    /**
     * Get category id
     *
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->getData(self::CATEGORY_ID);
    }

    /**
     * Set category id
     *
     * @param int $categoryId
     * @return mixed
     */
    public function setCategoryId($categoryId)
    {
        return $this->setData(self::CATEGORY_ID, $categoryId);
    }
}
