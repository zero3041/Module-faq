<?php
declare(strict_types=1);

namespace Bss\Faq\Block\Category;

use Bss\Faq\Model\CategoryRepository;
use Bss\Faq\Model\FaqRepository;
use Bss\Faq\Model\ResourceModel\Category\CollectionFactory as FaqCategoryCollectionFactory;
use Bss\Faq\Model\ResourceModel\Faq\CollectionFactory as FaqManageCollectionFactory;
use Bss\Faq\Model\ResourceModel\FaqCategoryLink\CollectionFactory as FaqCategoryLinkCollectionFactory;
use Magento\Cms\Model\Template\FilterProvider;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

/**
 * Class Category
 *
 * Category listing block
 */
class Category extends Template
{
    /**
     * @var FaqRepository
     */
    protected $faqRepository;
    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * @var mixed
     */
    protected $faqId;
    /**
     * @var FilterProvider
     */
    private $filterProvider;
    /**
     * @var FaqCategoryCollectionFactory
     */
    private $faqCategoryCollectionFactory;
    /**
     * @var FaqManageCollectionFactory
     */
    protected $faqManageCollectionFactory;
    /**
     * @var SortOrderBuilder
     */
    protected $sortOrderBuilder;
    /**
     * @var FaqCategoryLinkCollectionFactory
     */
    private $faqCategoryLinkCollectionFactory;

    /**
     * @param Context $context
     * @param FaqRepository $faqRepository
     * @param CategoryRepository $categoryRepository
     * @param FilterProvider $filterProvider
     * @param SortOrderBuilder $sortOrderBuilder
     * @param FaqCategoryCollectionFactory $faqCategoryCollectionFactory
     * @param FaqManageCollectionFactory $faqManageCollectionFactory
     * @param FaqCategoryLinkCollectionFactory $faqCategoryLinkCollectionFactory
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        FaqRepository $faqRepository,
        CategoryRepository $categoryRepository,
        FilterProvider $filterProvider,
        SortOrderBuilder $sortOrderBuilder,
        FaqCategoryCollectionFactory $faqCategoryCollectionFactory,
        FaqManageCollectionFactory $faqManageCollectionFactory,
        FaqCategoryLinkCollectionFactory $faqCategoryLinkCollectionFactory,
        array $data = []
    ) {
        $this->faqRepository = $faqRepository;
        $this->categoryRepository = $categoryRepository;
        $this->faqId = $context->getRequest()->getParam('c_id');
        $this->filterProvider = $filterProvider;
        $this->faqCategoryCollectionFactory = $faqCategoryCollectionFactory;
        $this->faqManageCollectionFactory = $faqManageCollectionFactory;
        $this->sortOrderBuilder = $sortOrderBuilder;
        $this->faqCategoryLinkCollectionFactory = $faqCategoryLinkCollectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * Get object data FAQ
     *
     * @return \Bss\Faq\Model\ResourceModel\Faq\Collection
     */
    public function getFaqListByCategory()
    {
        $page = ($this->getRequest()->getParam('p')) ? $this->getRequest()->getParam('p') : 1;
        $pageSize = ($this->getRequest()->getParam('limit')) ? $this->getRequest()->getParam('limit') : 2;
        $faqCategoryLink = $this->faqCategoryLinkCollectionFactory
            ->create()
            ->addFieldToFilter('category_id', $this->faqId);

        $faqIds = [];
        foreach ($faqCategoryLink as $faqLink) {
            $faqIds[] = $faqLink->getFaqId();
        }

        $faqCollection = $this->faqManageCollectionFactory->create()
            ->addFieldToFilter('status', 1)
            ->addFieldToFilter('entity_id', ['in' => $faqIds])
            ->setOrder('sortorder', 'ASC')
            ->setPageSize($pageSize)
            ->setCurPage($page);
        return $faqCollection;
    }

    /**
     * Layout category paginate
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $this->pageConfig->getTitle()->set($this->getFaqCategoryTitle($this->faqId));
        if ($this->getFaqListByCategory()) {
            $pager = $this->getLayout()->createBlock(
                \Magento\Theme\Block\Html\Pager::class,
                'test.news.pager'
            )->setAvailableLimit([ 2 => 2, 5 => 5, 10 => 10])->setShowPerPage(true)->setCollection(
                $this->getFaqListByCategory()
            );
            $this->setChild('pager', $pager);
            $this->getFaqListByCategory()->load();
        }
        return $this;
    }

    /**
     * Get paginate html
     *
     * @return string
     */
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }

    /**
     * Get category name
     *
     * @param int $faq
     * @return array|string
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getFaqCategoryTitle($faq)
    {
        $category = $this->categoryRepository->getById($faq)->getTitle();
        return $category;
    }

    /**
     * Filter content
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
     * Get url detail faq
     *
     * @param int $faqId
     * @return string
     */
    public function getFaqDetailUrl(int $faqId): string
    {
        return $this->getUrl('faq/detail', ['faq_id' => $faqId]);
    }
}
