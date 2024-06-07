<?php
declare(strict_types=1);

namespace Bss\Faq\Block\Detail;

use Bss\Faq\Model\CategoryRepository;
use Bss\Faq\Model\FaqRepository;
use Magento\Catalog\Model\Session;
use Magento\Cms\Model\Template\FilterProvider;
use Magento\Framework\Escaper;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

/**
 * Class Detail
 *
 * Detail Faq
 */
class Detail extends Template
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
     * @var \Magento\Catalog\Model\Session
     */
    private $_catalogSession;

    /**
     * @param Context $context
     * @param FaqRepository $faqRepository
     * @param CategoryRepository $categoryRepository
     * @param FilterProvider $filterProvider
     * @param Escaper $escaper
     * @param Session $catalogSession
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        FaqRepository $faqRepository,
        CategoryRepository $categoryRepository,
        FilterProvider $filterProvider,
        Escaper $escaper,
        \Magento\Catalog\Model\Session $catalogSession,
        array $data = []
    ) {
        $this->faqRepository = $faqRepository;
        $this->categoryRepository = $categoryRepository;
        $this->escaper = $escaper;
        $this->faqId = $context->getRequest()->getParam('faq_id');
        $this->filterProvider = $filterProvider;
        $this->_catalogSession = $catalogSession;
        parent::__construct($context, $data);
    }

    /**
     * Get object data FAQ
     *
     * @return \Bss\Faq\Api\Data\FaqInterface
     * @throws NoSuchEntityException
     */
    public function getFaqData()
    {
        return $this->faqRepository->getById($this->faqId);
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
     * Get Url feedback
     *
     * @return string
     */
    public function getAjaxUrl()
    {
        return $this->getUrl('faq/detail/feedback', ['faq_id' => $this->faqId]);
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
     * Get catalog session
     *
     * @return \Magento\Catalog\Model\Session
     */
    public function getCatalogSession()
    {
        return $this->_catalogSession;
    }
}
