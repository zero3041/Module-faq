<?php
declare(strict_types=1);

namespace Bss\Faq\Model;

use Bss\Faq\Api\Data\FaqCategoryLinkInterface;
use Bss\Faq\Api\Data\FaqCategoryLinkInterfaceFactory;
use Bss\Faq\Api\FaqCategoryLinkRepositoryInterface;
use Bss\Faq\Model\ResourceModel\FaqCategoryLink as FaqCategoryLinkResource;
use Bss\Faq\Model\ResourceModel\FaqCategoryLink\CollectionFactory as FaqCategoryLinkCollectionFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsFactory;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class FaqCategoryLinkRepository
 *
 * Repository for Faq Category Link
 */
class FaqCategoryLinkRepository implements FaqCategoryLinkRepositoryInterface
{
    /**
     * @var FaqCategoryLinkInterfaceFactory
     */
    protected $faqCategoryLinkFactory;
    /**
     * @var FaqCategoryLinkResource
     */
    protected $faqCategoryLinkResource;
    /**
     * @var FaqCategoryLinkCollectionFactory
     */
    protected $faqCategoryLinkCollectionFactory;
    /**
     * @var SearchResultsFactory
     */
    protected $searchResultsFactory;

    /**
     * @param FaqCategoryLinkInterfaceFactory $faqCategoryLinkFactory
     * @param FaqCategoryLinkResource $faqCategoryLinkResource
     * @param FaqCategoryLinkCollectionFactory $faqCategoryLinkCollectionFactory
     * @param SearchResultsFactory $searchResultsFactory
     */
    public function __construct(
        FaqCategoryLinkInterfaceFactory $faqCategoryLinkFactory,
        FaqCategoryLinkResource $faqCategoryLinkResource,
        FaqCategoryLinkCollectionFactory $faqCategoryLinkCollectionFactory,
        SearchResultsFactory $searchResultsFactory
    ) {
        $this->faqCategoryLinkFactory = $faqCategoryLinkFactory;
        $this->faqCategoryLinkResource = $faqCategoryLinkResource;
        $this->faqCategoryLinkCollectionFactory = $faqCategoryLinkCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * Function to save
     *
     * @param FaqCategoryLinkInterface $faqCategoryLink
     * @return FaqCategoryLinkInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(FaqCategoryLinkInterface $faqCategoryLink): FaqCategoryLinkInterface
    {
        try {
            $this->faqCategoryLinkResource->save($faqCategoryLink);
        } catch (\Exception $exception) {
            throw new \Magento\Framework\Exception\CouldNotSaveException(
                __('Could not save the FAQ Category Link: %1', $exception->getMessage())
            );
        }
        return $faqCategoryLink;
    }

    /**
     * Function to get by id
     *
     * @param int $faqId
     * @return mixed
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($faqId)
    {
        $faqCategoryLink = $this->faqCategoryLinkFactory->create();
        $this->faqCategoryLinkResource->load($faqCategoryLink, ['faq_id' => $faqId]);
        if (!$faqCategoryLink->getId()) {
            throw new \Magento\Framework\Exception\NoSuchEntityException(__(
                'FAQ Category Link with FAQ ID "%1" and Category ID "%2" does not exist.',
                $faqId
            ));
        }
        return $faqCategoryLink;
    }

    /**
     * Function to detele
     *
     * @param FaqCategoryLinkInterface $faqCategoryLink
     * @return true
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(FaqCategoryLinkInterface $faqCategoryLink)
    {
        try {
            $this->faqCategoryLinkResource->delete($faqCategoryLink);
        } catch (\Exception $exception) {
            throw new \Magento\Framework\Exception\CouldNotDeleteException(
                __('Could not delete the FAQ Category Link: %1', $exception->getMessage())
            );
        }
        return true;
    }

    /**
     * Function to delete by Id
     *
     * @param int $faqId
     * @return true
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($faqId)
    {
        $faqCategoryLink = $this->getById($faqId);
        return $this->delete($faqCategoryLink);
    }

    /**
     * Function getlist
     *
     * @param SearchCriteriaInterface|FaqCategoryLinkInterface $searchCriteria
     * @return SearchResultsInterface
     */
    public function getList(FaqCategoryLinkInterface $searchCriteria): SearchResultsInterface
    {
        $collection = $this->faqCategoryLinkCollectionFactory->create();

        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                $field = $filter->getField();
                $condition = $filter->getConditionType() ?: 'eq';
                $value = $filter->getValue();
                $collection->addFieldToFilter($field, [$condition => $value]);
            }
        }

        $collection->setCurPage($searchCriteria->getCurrentPage());
        $collection->setPageSize($searchCriteria->getPageSize());

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    /**
     * Delete category links by FAQ ID.
     *
     * @param int $faqId
     * @return void
     * @throws LocalizedException
     */
    public function deleteCategoryLinksByFaqId($faqId)
    {
        $this->faqCategoryLinkResource->deleteCategoryLinksByFaqId($faqId);
    }

    /**
     * Save a category link.
     *
     * @param int $faqId
     * @param array $categoryIdArray
     * @return void
     * @throws CouldNotSaveException
     */
    public function saveCategoryLink($faqId, $categoryIdArray)
    {
        foreach ($categoryIdArray as $categoryId) {
            $categoryLink = $this->faqCategoryLinkFactory->create();
            $categoryLink->setFaqId($faqId);
            $categoryLink->setCategoryId($categoryId);
            $this->save($categoryLink);
        }
    }
}
