<?php
declare(strict_types=1);

namespace Bss\Faq\Block\Index;

use Bss\Faq\Model\Config\DefaultConfig;
use Bss\Faq\Model\ResourceModel\Category\CollectionFactory as FaqCategoryCollectionFactory;
use Bss\Faq\Model\ResourceModel\Faq\CollectionFactory as FaqManageCollectionFactory;
use Bss\Faq\Model\ResourceModel\FaqCategoryLink\CollectionFactory as FaqCategoryLinkCollectionFactory;
use Magento\Cms\Model\Template\FilterProvider;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
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
     * @var FaqCategoryLinkCollectionFactory
     */
    private $faqCategoryLinksFactory;

    /**
     * @param Context $context
     * @param FaqManageCollectionFactory $faqManageCollectionFactory
     * @param FaqCategoryCollectionFactory $faqCategoryCollectionFactory
     * @param FilterProvider $filterProvider
     * @param StoreManagerInterface $storeManager
     * @param FaqCategoryLinkCollectionFactory $faqCategoryLinksFactory
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        FaqManageCollectionFactory $faqManageCollectionFactory,
        FaqCategoryCollectionFactory $faqCategoryCollectionFactory,
        FilterProvider $filterProvider,
        StoreManagerInterface $storeManager,
        FaqCategoryLinkCollectionFactory $faqCategoryLinksFactory,
        array $data = []
    ) {
        $this->faqManageCollectionFactory = $faqManageCollectionFactory;
        $this->faqCategoryCollectionFactory = $faqCategoryCollectionFactory;
        $this->filterProvider = $filterProvider;
        $this->storeManager = $storeManager;
        $this->faqCategoryLinksFactory = $faqCategoryLinksFactory;
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
            $faqCollection = $this->faqManageCollectionFactory->create();
            $faqCollection->getSelect()
                ->join(
                    ['link' => $faqCollection->getTable('faq_category_link')],
                    'main_table.entity_id = link.faq_id',
                    []
                )
                ->where('link.category_id = ?', $category->getId())
                ->where('main_table.status = ?', 1)
                ->order('main_table.sortorder ASC')
                ->limit(3);

            $faqByCategory[$category->getTitle()] = [
                'category' => $category,
                'faqs' => $faqCollection->getItems()
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
    /**
     * Get url detail faq
     *
     * @param int $faqId
     * @return string
     */
    public function getFaqDetailUrl(int $faqId): string
    {
        return $this->getUrl('faq/detail', ['faq_id' => $faqId]);
    }

    /**
     * Get url category
     *
     * @param int $faqId
     * @return string
     */
    public function getCategoryUrl(int $faqId): string
    {
        return $this->getUrl('faq/category', ['c_id' => $faqId]);
    }
}
