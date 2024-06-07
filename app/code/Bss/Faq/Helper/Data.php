<?php
declare(strict_types=1);

namespace Bss\Faq\Helper;

use Bss\Faq\Model\Config\DefaultConfig;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\Http\Context as AuthContext;
use Magento\Store\Model\ScopeInterface;

/**
 * Class Data
 *
 * Helper class data
 */
class Data extends AbstractHelper
{
    /**
     * @var AuthContext
     */
    protected $authContext;

    /**
     * Data constructor.
     *
     * @param Context $context
     * @param AuthContext $authContext
     */
    public function __construct(
        Context $context,
        AuthContext $authContext
    ) {
        $this->authContext = $authContext;
        parent::__construct($context);
    }

    /**
     * Get config path
     *
     * @param string $config
     * @return mixed
     */
    public function getConfig($config)
    {
        return $this->scopeConfig->getValue(
            $config,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get faq url
     *
     * @return string
     */
    public function getFaqUrl()
    {
        return $this->scopeConfig->getValue(DefaultConfig::FAQ_URL_CONFIG_PATH);
    }

    /**
     * Check is module enabled
     *
     * @return bool
     */
    public function isEnable()
    {
        return $this->scopeConfig->getValue(DefaultConfig::CONFIG_PATH_IS_ENABLE);
    }
}
