<?php
declare(strict_types=1);

namespace Bss\Faq\Api;

use Bss\Faq\Api\Data\CategoryInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Class CategoryRepositoryInterface
 *
 * Interface for category repositories
 */
interface CategoryRepositoryInterface
{
    /**
     * Function save
     *
     * @param CategoryInterface $category
     * @return mixed
     */
    public function save(CategoryInterface $category);

    /**
     * Function get Id
     *
     * @param int $categoryId
     * @return mixed
     */
    public function getById($categoryId);

    /**
     * Function get List
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return mixed
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Function delete
     *
     * @param CategoryInterface $category
     * @return mixed
     */
    public function delete(CategoryInterface $category);

    /**
     * Function delete by id
     *
     * @param int $categoryId
     * @return mixed
     */
    public function deleteById($categoryId);
}
