<?php
declare(strict_types=1);

namespace Bss\Faq\Block\Category;

use Bss\Faq\Model\CategoryRepository;
use Bss\Faq\Model\FaqRepository;
use Bss\Faq\Model\ResourceModel\Category\CollectionFactory as FaqCategoryCollectionFactory;
use Bss\Faq\Model\ResourceModel\Faq\CollectionFactory as FaqManageCollectionFactory;
use Magento\Cms\Model\Template\FilterProvider;
use Magento\Framework\Escaper;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
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
     * @var Escaper
     */
    protected $escaper;
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
    private $faqManageCollectionFactory;

    /**
     * @param Context $context
     * @param FaqRepository $faqRepository
     * @param CategoryRepository $categoryRepository
     * @param FilterProvider $filterProvider
     * @param Escaper $escaper
     * @param FaqCategoryCollectionFactory $faqCategoryCollectionFactory
     * @param FaqManageCollectionFactory $faqManageCollectionFactory
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        FaqRepository $faqRepository,
        CategoryRepository $categoryRepository,
        FilterProvider $filterProvider,
        Escaper $escaper,
        FaqCategoryCollectionFactory $faqCategoryCollectionFactory,
        FaqManageCollectionFactory $faqManageCollectionFactory,
        array $data = []
    ) {
        $this->faqRepository = $faqRepository;
        $this->categoryRepository = $categoryRepository;
        $this->escaper = $escaper;
        $this->faqId = $context->getRequest()->getParam('c_id');
        $this->filterProvider = $filterProvider;
        $this->faqCategoryCollectionFactory = $faqCategoryCollectionFactory;
        $this->faqManageCollectionFactory = $faqManageCollectionFactory;
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
        $faqCollection = $this->faqManageCollectionFactory->create()
            ->addFieldToFilter('category_id', $this->faqId)
            ->addFieldToFilter('status', 1)
            ->setOrder('sortorder', 'ASC');
        $faqCollection->setPageSize($pageSize);
        $faqCollection->setCurPage($page);
        return $faqCollection;
    }

    /**
     * Layout category paginate
     *
     * @throws NoSuchEntityException
     * @throws LocalizedException
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
        $category = $this->categoryRepository->getById($faq);
        return $this->escaper->escapeHtml($category->getTitle());
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
