<?php
declare(strict_types=1);

namespace Bss\Faq\Controller\Adminhtml\Category;

use Bss\Faq\Api\CategoryRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Edit
 *
 * Edit a category
 */
class Edit extends \Magento\Backend\App\Action implements HttpGetActionInterface
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;
    /**
     * @var FaqRepositoryInterface
     */
    protected $categoryRepository;

    /**
     * Function constructor
     *
     * @param Action\Context $context
     * @param PageFactory $resultPageFactory
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory,
        CategoryRepositoryInterface $categoryRepository
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Edit category
     *
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('entity_id');
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Category'));

        if ($id) {
            try {
                $category = $this->categoryRepository->getById($id);
                $resultPage->getConfig()->getTitle()->prepend($category->getTitle());
            } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
                $this->messageManager->addErrorMessage(__('Category does not exist.'));
                return $this->_redirect('*/*/index');
            }
        } else {
            $resultPage->getConfig()->getTitle()->prepend(__('New Faq Category'));
        }

        return $resultPage;
    }
}
