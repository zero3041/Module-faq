<?php
declare(strict_types=1);

namespace Bss\Faq\Controller\Index;

use Bss\Faq\Helper\Data;
use Bss\Faq\Model\Config\DefaultConfig;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Theme\Block\Html\Title as HtmlTitle;

/**
 * Class Index
 *
 * Created page faq
 */
class Index implements HttpGetActionInterface
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var Data
     */
    protected $helper;

    /**
     * Index constructor.
     * @param Data $helper
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Data $helper,
        PageFactory $resultPageFactory
    ) {
        $this->helper = $helper;
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Execute view action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        if ($this->helper->isEnable()) {
            $pageMainTitle = $resultPage->getLayout()->getBlock('page.main.title');
            $pageTitle = $this->helper->getConfig(DefaultConfig::CONFIG_PATH_PAGE_TITLE);

            if ($pageMainTitle && $pageMainTitle instanceof HtmlTitle) {
                $pageMainTitle->setPageTitle($pageTitle);
            }
        }
        return $resultPage;
    }
}
