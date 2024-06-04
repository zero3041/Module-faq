<?php
declare(strict_types=1);

namespace Bss\Faq\Block\Search;

use Bss\Faq\Model\ResourceModel\Faq\CollectionFactory;
use Magento\Cms\Model\Template\FilterProvider;
use Magento\Framework\View\Element\Template;

/**
 * Class Search
 *
 * Search page faq
 */
class Search extends Template
{
    /**
     * @var CollectionFactory
     */
    protected $faqCollectionFactory;
    /**
     * @var FilterProvider
     */
    private $filterProvider;

    /**
     * @param Template\Context $context
     * @param CollectionFactory $faqCollectionFactory
     * @param FilterProvider $filterProvider
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        CollectionFactory $faqCollectionFactory,
        FilterProvider $filterProvider,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->faqCollectionFactory = $faqCollectionFactory;
        $this->filterProvider = $filterProvider;
    }

    /**
     * Get data search
     *
     * @return array|\Bss\Faq\Model\ResourceModel\Faq\Collection
     */
    public function getSearchResults()
    {
        $query = $this->getRequest()->getParam('s');
        if (!$query) {
            return [];
        }

        $faqCollection = $this->faqCollectionFactory->create();
        $faqCollection->addFieldToFilter(
            ['title', 'content'],
            [
                ['like' => '%' . $query . '%'],
                ['like' => '%' . $query . '%']
            ]
        );

        return $faqCollection;
    }

    /**
     * Convert data
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
}
