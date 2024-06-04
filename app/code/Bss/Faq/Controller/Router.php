<?php
declare(strict_types=1);

namespace Bss\Faq\Controller;

use Bss\Faq\Model\Config\DefaultConfig;
use Magento\Framework\App\Action\Forward;
use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\RouterInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Class Router
 *
 * Custom link
 */
class Router implements RouterInterface
{
    /**
     * @var ActionFactory
     */
    protected $actionFactory;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * Router constructor.
     * @param ActionFactory $actionFactory
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ActionFactory $actionFactory,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->actionFactory = $actionFactory;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Faq router
     *
     * @param RequestInterface $request
     * @return ActionInterface|null
     */
    public function match(RequestInterface $request)
    {
        $isModuleEnabled = $this->scopeConfig->getValue(
            DefaultConfig::CONFIG_PATH_IS_ENABLE,
            ScopeInterface::SCOPE_STORE
        );
        if ($isModuleEnabled) {
            $identifier = trim($request->getPathInfo(), '/');
            $faqUrl = $this->scopeConfig->getValue(DefaultConfig::FAQ_URL_CONFIG_PATH);
            if ($identifier == $faqUrl) {
                $request->setModuleName('faq');
                $request->setControllerName('index');
                $request->setActionName('index');
                return $this->actionFactory->create(
                    Forward::class
                );
            }
        }
        return null;
    }
}
