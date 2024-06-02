<?php
declare(strict_types=1);

namespace Bss\Faq\Controller\Adminhtml\Faq;

use Magento\Framework\App\Action\HttpGetActionInterface;

/**
 * Class Index
 *
 * Create page manage
 */
class Index implements HttpGetActionInterface
{
    /**
     * @var bool|\Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory = false;

    /**
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Create a new page manage
     *
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend((__('Manage FAQs')));

        return $resultPage;
    }
}
