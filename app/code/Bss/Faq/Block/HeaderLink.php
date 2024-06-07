<?php
declare(strict_types=1);

namespace Bss\Faq\Block;

use Bss\Faq\Model\Config\DefaultConfig;
use Magento\Framework\View\Element\Html\Link;
use Magento\Store\Model\ScopeInterface;

/**
 * Class HeaderLink
 *
 * Show faq link header
 */
class HeaderLink extends Link
{
    /**
     * Render header link HTML
     *
     * @return string
     */
    public function _toHtml()
    {
        $isEnable = $this->_scopeConfig->isSetFlag(
            DefaultConfig::CONFIG_PATH_IS_ENABLE,
            ScopeInterface::SCOPE_STORE
        );
        $isHeaderLinkEnable = $this->_scopeConfig->isSetFlag(
            DefaultConfig::CONFIG_PATH_HEADER_LINK,
            ScopeInterface::SCOPE_STORE
        );
        if (!$isEnable || !$isHeaderLinkEnable) {
            return '';
        }
        return parent::_toHtml();
    }
}
