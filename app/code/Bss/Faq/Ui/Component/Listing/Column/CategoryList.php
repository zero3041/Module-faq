<?php
declare(strict_types=1);

namespace Bss\Faq\Ui\Component\Listing\Column;

use Bss\Faq\Model\ResourceModel\Category\CollectionFactory as CategoryCollectionFactory;
use Bss\Faq\Model\ResourceModel\FaqCategoryLink\CollectionFactory as CategoryLinkCollectionFactory;
use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class CategoryList
 *
 * Category List Column
 */
class CategoryList implements OptionSourceInterface
{
    /**
     * @var CategoryCollectionFactory
     */
    protected $categoryCollectionFactory;
    /**
     * @var CategoryLinkCollectionFactory
     */
    protected $categoryLinkCollectionFactory;

    /**
     * @param CategoryCollectionFactory $categoryCollectionFactory
     * @param CategoryLinkCollectionFactory $categoryLinkCollectionFactory
     */
    public function __construct(
        CategoryCollectionFactory $categoryCollectionFactory,
        CategoryLinkCollectionFactory $categoryLinkCollectionFactory
    ) {
        $this->categoryCollectionFactory = $categoryCollectionFactory;
        $this->categoryLinkCollectionFactory = $categoryLinkCollectionFactory;
    }

    /**
     * Set column
     *
     * @return array
     */
    public function toOptionArray()
    {
        $categoryCollection = $this->categoryCollectionFactory->create();
        $categoryCollection->addFieldToSelect(['entity_id', 'title']);

        $options = [];
        foreach ($categoryCollection as $category) {
            $options[] = [
                'value' => $category->getEntityId(),
                'label' => $category->getTitle()
            ];
        }

        return $options;
    }

    /**
     * Get name category
     *
     * @param int $faqId
     * @return string
     */
    public function getCategoryNamesByFaqId($faqId)
    {
        $categoryLinks = $this->categoryLinkCollectionFactory->create()
            ->addFieldToFilter('faq_id', $faqId);

        $categoryIds = $categoryLinks->getColumnValues('category_id');

        if (empty($categoryIds)) {
            return '';
        }

        $categoryCollection = $this->categoryCollectionFactory->create()
            ->addFieldToFilter('entity_id', ['in' => $categoryIds]);

        $categoryNames = [];
        foreach ($categoryCollection as $category) {
            $categoryNames[] = $category->getTitle();
        }

        return implode(', ', $categoryNames);
    }
}
