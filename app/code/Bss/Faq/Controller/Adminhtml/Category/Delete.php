<?php
declare(strict_types=1);

namespace Bss\Faq\Controller\Adminhtml\Category;

use Bss\Faq\Api\CategoryRepositoryInterface;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class Delete
 *
 * Delete an item
 */
class Delete extends \Magento\Backend\App\Action implements HttpPostActionInterface
{
    /**
     * @var CategoryRepositoryInterface
     */
    protected $categoryRepository;

    /**
     * Function constructor
     *
     * @param Context $context
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(
        Context $context,
        CategoryRepositoryInterface $categoryRepository
    ) {
        parent::__construct($context);
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Delete page
     *
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $selectedIds = $this->getRequest()->getParam('selected');
        if (empty($selectedIds)) {
            $this->messageManager->addErrorMessage(__('No categories selected for deletion.'));
            return $this->_redirect('*/*/');
        }

        try {
            foreach ($selectedIds as $categoryId) {
                $this->categoryRepository->deleteById($categoryId);
            }
            $this->messageManager->addSuccessMessage(__('Categories deleted successfully.'));
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, __('Something went wrong while deleting the categories.'));
        }

        return $this->_redirect('*/*/');
    }
}
