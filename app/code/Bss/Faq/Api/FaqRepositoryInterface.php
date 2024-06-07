<?php
declare(strict_types=1);

namespace Bss\Faq\Api;

use Bss\Faq\Api\Data\FaqInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Class CategoryRepositoryInterface
 *
 * Interface for category repositories
 */
interface FaqRepositoryInterface
{
    /**
     * Function save
     *
     * @param FaqInterface $faq
     * @return mixed
     */
    public function save(FaqInterface $faq);

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
     * @param SearchCriteriaInterface $searchCriteria
     * @return mixed
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Function delete
     *
     * @param FaqInterface $faq
     * @return mixed
     */
    public function delete(FaqInterface $faq);

    /**
     * Function delete by id
     *
     * @param int $faqId
     * @return mixed
     */
    public function deleteById($faqId);
}
