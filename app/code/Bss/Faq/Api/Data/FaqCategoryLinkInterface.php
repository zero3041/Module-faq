<?php
declare(strict_types=1);

namespace Bss\Faq\Api\Data;

/**
 * Class FaqCategoryLinkInterface
 * Interface for faq categories
 */
interface FaqCategoryLinkInterface
{
    public const FAQ_ID = 'faq_id';
    public const CATEGORY_ID = 'category_id';

    /**
     * Get faq id in category faq
     *
     * @return mixed
     */
    public function getFaqId();

    /**
     * Set faq id in category faq
     *
     * @param int $faqId
     * @return mixed
     */
    public function setFaqId($faqId);

    /**
     * Get category id in category faq
     *
     * @return mixed
     */
    public function getCategoryId();

    /**
     * Set category id in category faq
     *
     * @param int $categoryId
     * @return mixed
     */
    public function setCategoryId($categoryId);
}
