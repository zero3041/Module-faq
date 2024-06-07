<?php
declare(strict_types=1);

namespace Bss\Faq\Api;

use Bss\Faq\Api\Data\FaqCategoryLinkInterface;
use Magento\Framework\Api\SearchResultsInterface;

interface FaqCategoryLinkRepositoryInterface
{
    /**
     * Function save
     *
     * @param FaqCategoryLinkInterface $faqCategoryLink
     * @return mixed
     */
    public function save(FaqCategoryLinkInterface $faqCategoryLink);

    /**
     * Function get Id
     *
     * @param int $faqId
     * @return mixed
     */
    public function getById($faqId);

    /**
     * Function get List
     *
     * @param FaqCategoryLinkInterface $faqCategoryLink
     * @return mixed
     */
    public function delete(FaqCategoryLinkInterface $faqCategoryLink);

    /**
     * Function delete
     *
     * @param int $faqId
     * @return mixed
     */
    public function deleteById($faqId);

    /**
     * Function delete by id
     *
     * @param FaqCategoryLinkInterface $searchCriteria
     * @return SearchResultsInterface
     */
    public function getList(FaqCategoryLinkInterface $searchCriteria): SearchResultsInterface;
    /**
     * Delete category links by FAQ ID.
     *
     * @param int $faqId
     * @return void
     */
    public function deleteCategoryLinksByFaqId($faqId);

    /**
     * Save a category link.
     *
     * @param int $faqId
     * @param int $categoryId
     * @return void
     */
    public function saveCategoryLink($faqId, $categoryId);
}
