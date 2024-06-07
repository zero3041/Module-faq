<?php
declare(strict_types=1);

namespace Bss\Faq\Ui\Component\Listing\Column;

use Magento\Framework\Escaper;
use Magento\Ui\Component\Listing\Columns\Column;

/**
 * Class FaqCategoryList
 *
 * Convert a list
 */
class FaqCategoryList extends Column
{
    /**
     * @var CategoryList
     */
    protected $categoryNameList;
    /**
     * @var Escaper
     */
    protected $escaper;

    /**
     * Function contractor
     *
     * @param \Magento\Framework\View\Element\UiComponent\ContextInterface $context
     * @param \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory
     * @param CategoryList $categoryNameList
     * @param Escaper $escaper
     * @param array $components
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        CategoryList $categoryNameList,
        Escaper $escaper,
        array $components = [],
        array $data = []
    ) {
        $this->categoryNameList = $categoryNameList;
        $this->escaper = $escaper;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Convert datasource
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $faqId = $item['entity_id'];
                $categories = $this->categoryNameList->getCategoryNamesByFaqId($faqId);
                $item[$this->getData('name')] = $this->escaper->escapeHtml($categories);
            }
        }

        return $dataSource;
    }
}
