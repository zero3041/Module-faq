<?php
declare(strict_types=1);

namespace Bss\Faq\Model\Category\Source;

use Bss\Faq\Model\ResourceModel\Category\CollectionFactory;
use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class CategoryName
 *
 * Create array of categories id, name
 */
class CategoryName implements OptionSourceInterface
{
    /**
     * @var CollectionFactory
     */
    protected $categoryCollectionFactory;

    /**
     * Constructor
     *
     * @param CollectionFactory $categoryCollectionFactory
     */
    public function __construct(CollectionFactory $categoryCollectionFactory)
    {
        $this->categoryCollectionFactory = $categoryCollectionFactory;
    }

    /**
     * Get available category names
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options = [];
        $collection = $this->categoryCollectionFactory->create();

        foreach ($collection as $category) {
            $options[] = [
                'value' => $category->getId(),
                'label' => $category->getTitle(),
            ];
        }

        return $options;
    }
}
