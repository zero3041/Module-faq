<?php
declare(strict_types=1);

namespace Bss\Faq\Model;

use Bss\Faq\Api\Data\FaqInterface;
use Bss\Faq\Api\Data\FaqInterfaceFactory;
use Bss\Faq\Api\Data\FaqSearchResultsInterfaceFactory;
use Bss\Faq\Api\FaqRepositoryInterface;
use Bss\Faq\Model\ResourceModel\Faq as FaqResource;
use Bss\Faq\Model\ResourceModel\Faq\CollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class CategoryRepository
 *
 * Repository category
 */
class FaqRepository implements FaqRepositoryInterface
{
    /**
     * @var FaqInterfaceFactory
     */
    protected $faqFactory;

    /**
     * @var FaqResource
     */
    protected $faqResource;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var FaqSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * CategoryRepository constructor.
     *
     * @param FaqInterfaceFactory $faqFactory
     * @param FaqResource $faqResource
     * @param CollectionFactory $collectionFactory
     * @param FaqSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        FaqInterfaceFactory $faqFactory,
        FaqResource $faqResource,
        CollectionFactory $collectionFactory,
        FaqSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->faqFactory = $faqFactory;
        $this->faqResource = $faqResource;
        $this->collectionFactory = $collectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * Save faq
     *
     * @param FaqInterface $faq
     * @return FaqInterface
     * @throws CouldNotSaveException
     */
    public function save(FaqInterface $faq): FaqInterface
    {
        try {
            $this->faqResource->save($faq);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $faq;
    }

    /**
     * Get faq by ID
     *
     * @param int $faqId
     * @return FaqInterface
     * @throws NoSuchEntityException
     */
    public function getById($faqId): FaqInterface
    {
        $faq = $this->faqFactory->create();
        $this->faqResource->load($faq, $faqId);
        if (!$faq->getId()) {
            throw new NoSuchEntityException(__('Category with id "%1" does not exist.', $faqId));
        }
        return $faq;
    }

    /**
     * Get list of faq
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return mixed
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    /**
     * Delete faq
     *
     * @param FaqInterface $faq
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(FaqInterface $faq): bool
    {
        try {
            $this->faqResource->delete($faq);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /**
     * Delete faq by ID
     *
     * @param int $faqId
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($faqId): bool
    {
        $faq = $this->getById($faqId);
        return $this->delete($faq);
    }
}
