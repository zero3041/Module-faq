<?php
declare(strict_types=1);

namespace Bss\Faq\Controller\Adminhtml\Faq;

use Bss\Faq\Api\FaqRepositoryInterface;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class Delete
 *
 * Delete an item
 */
class MassDelete extends \Magento\Backend\App\Action implements HttpPostActionInterface
{
    /**
     * @var FaqRepositoryInterface
     */
    protected $faqRepository;

    /**
     * Function constructor
     *
     * @param Context $context
     * @param FaqRepositoryInterface $faqRepository
     */
    public function __construct(
        Context $context,
        FaqRepositoryInterface $faqRepository
    ) {
        parent::__construct($context);
        $this->faqRepository = $faqRepository;
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
            $this->messageManager->addErrorMessage(__('No faq selected for deletion.'));
            return $this->_redirect('*/*/');
        }

        try {
            foreach ($selectedIds as $categoryId) {
                $this->faqRepository->deleteById($categoryId);
            }
            $this->messageManager->addSuccessMessage(__('Faq deleted successfully.'));
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, __('Something went wrong while deleting the faq.'));
        }

        return $this->_redirect('*/*/');
    }
}
