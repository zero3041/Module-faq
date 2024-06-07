<?php
declare(strict_types=1);

namespace Bss\Faq\Controller\Adminhtml\Faq;

use Bss\Faq\Model\FaqFactory;
use Bss\Faq\Model\ResourceModel\Faq as FaqResource;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultFactory;

/**
 * Class Delete
 *
 * Delete an item
 */
class Delete extends \Magento\Backend\App\Action implements HttpPostActionInterface
{
    /**
     * @var JsonFactory
     */
    protected $jsonFactory;
    /**
     * @var FaqFactory
     */
    protected $faqFactory;
    /**
     * @param Context $context
     * @param JsonFactory $jsonFactory
     * @param FaqFactory $faqFactory
     */
    /**
     * @var FaqResource
     */
    protected $faqResource;
    /**
     * @param Context $context
     * @param JsonFactory $jsonFactory
     * @param FaqFactory $faqFactory
     * @param FaqResource $faqResource
     */
    public function __construct(
        Context $context,
        JsonFactory $jsonFactory,
        FaqFactory $faqFactory,
        FaqResource $faqResource
    ) {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->faqFactory = $faqFactory;
        $this->faqResource = $faqResource;
    }
    /**
     * Delete item from collection
     *
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|(\Magento\Framework\Controller\Result\Redirect&\Magento\Framework\Controller\ResultInterface)|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $selected = $this->getRequest()->getParam('selected', []);
        foreach ($selected as $id) {
            try {
                $faq = $this->faqFactory->create();
                $this->faqResource->load($faq, $id);
                $this->faqResource->delete($faq);
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $this->_redirect('*/*/index');
            }
        }
        $this->messageManager->addSuccessMessage(__('Selected items have been deleted.'));
        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setUrl($this->_redirect->getRefererUrl());
    }
}
