<?php
declare(strict_types=1);

namespace Bss\Faq\Block\Search;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template;

/**
 * Class Search form
 *
 * Show form for search
 */
class SearchForm extends Template
{
    /**
     * Returns action url for search form
     *
     * @return string
     * @throws NoSuchEntityException
     */
    public function getFormAction()
    {
        return $this->_storeManager
            ->getStore()
            ->getUrl('faq/search/', ['_secure' => $this->_storeManager->getStore()->isCurrentlySecure()]);
    }
    /**
     * Get Text search from url
     *
     * @return string
     */
    public function getTextSearch()
    {
        return ($this->getRequest()->getParam('s')) ? $this->getRequest()->getParam('s') : '';
    }
}
