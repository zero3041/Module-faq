<?php
declare(strict_types=1);

namespace Bss\Faq\Block\Index;

use Bss\Faq\Model\Config\DefaultConfig;
use Bss\Faq\Model\ResourceModel\Category\CollectionFactory as FaqCategoryCollectionFactory;
use Bss\Faq\Model\ResourceModel\Faq\CollectionFactory as FaqManageCollectionFactory;
use Magento\Cms\Model\Template\FilterProvider;
use Magento\Framework\View\Element\Template;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class Index
 *
 * Block FAQ
 */
class Index extends Template
{
    /**
     * @var FaqManageCollectionFactory
     */
    protected $faqManageCollectionFactory;
    /**
     * @var FaqCategoryCollectionFactory
     */
    protected $faqCategoryCollectionFactory;
    /**
     * @var FilterProvider
     */
    private $filterProvider;
    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @param Template\Context $context
     * @param FaqManageCollectionFactory $faqManageCollectionFactory
     * @param FaqCategoryCollectionFactory $faqCategoryCollectionFactory
     * @param FilterProvider $filterProvider
     * @param StoreManagerInterface $storeManager
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        FaqManageCollectionFactory $faqManageCollectionFactory,
        FaqCategoryCollectionFactory $faqCategoryCollectionFactory,
        FilterProvider $filterProvider,
        StoreManagerInterface $storeManager,
        array $data = []
    ) {
        $this->faqManageCollectionFactory = $faqManageCollectionFactory;
        $this->faqCategoryCollectionFactory = $faqCategoryCollectionFactory;
        $this->filterProvider = $filterProvider;
        $this->storeManager = $storeManager;
        parent::__construct($context, $data);
    }

    /**
     * Function to get list faq categories
     *
     * @return array
     */
    public function getFaqListByCategory()
    {
        $faqByCategory = [];
        $categoryCollection = $this->faqCategoryCollectionFactory->create()
            ->addFieldToFilter('status', 1)
            ->setOrder('sortorder', 'ASC');

        foreach ($categoryCollection as $category) {
            $faqCollection = $this->faqManageCollectionFactory->create()
                ->addFieldToFilter('category_id', $category->getId())
                ->addFieldToFilter('status', 1)
                ->setOrder('sortorder', 'ASC');
            $faqByCategory[$category->getTitle()] = [
                'category' => $category,
                'faqs' => $faqCollection
            ];
        }
        return $faqByCategory;
    }
    /**
     * Filter faq content
     *
     * @param string $string
     * @return string
     */
    public function filterOutputHtml($string)
    {
        $output = '';
        try {
            $output = $this->filterProvider->getPageFilter()->filter($string);
        } catch (\Exception $e) {
            $this->_logger->error('Faq filter output error: ' . $e->getMessage());
        }
        return $output;
    }

    /**
     * Function get link image
     *
     * @param string $icon
     * @return string
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getCategoryImageUrl($icon)
    {
        return $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) .
            DefaultConfig::ICON_TMP_PATH . $icon;
    }
}