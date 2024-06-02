<?php
declare(strict_types=1);

namespace Bss\Faq\Controller\Adminhtml\Category;

use Bss\Faq\Model\CategoryFactory;
use Bss\Faq\Model\ResourceModel\Category as CategoryResource;
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
     * @var CategoryFactory
     */
    protected $categoryFactory;
    /**
     * @param Context $context
     * @param JsonFactory $jsonFactory
     * @param CategoryFactory $categoryFactory
     */
    /**
     * @var CategoryResource
     */
    protected $categoryResource;
    /**
     * @param Context $context
     * @param JsonFactory $jsonFactory
     * @param CategoryFactory $categoryFactory
     * @param CategoryResource $categoryResource
     */
    public function __construct(
        Context $context,
        JsonFactory $jsonFactory,
        CategoryFactory $categoryFactory,
        CategoryResource $categoryResource
    ) {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->categoryFactory = $categoryFactory;
        $this->categoryResource = $categoryResource;
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
                $internship = $this->categoryFactory->create();
                $this->categoryResource->load($internship, $id);
                $this->categoryResource->delete($internship);
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $this->_redirect('*/*/index');
            }
        }
        $this->messageManager->addSuccessMessage(__('Selected items have been deleted.'));
        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setUrl($this->_redirect->getRefererUrl());
    }
}
