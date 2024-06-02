<?php
declare(strict_types=1);

namespace Bss\Faq\Controller\Adminhtml\Category;

use Bss\Faq\Model\CategoryFactory;
use Bss\Faq\Model\CategoryRepository;
use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class Save
 *
 * Category Save
 */
class Save extends Action implements HttpPostActionInterface
{
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * @var CategoryFactory
     */
    protected $categoryFactory;

    /**
     * Save constructor.
     * @param Action\Context $context
     * @param CategoryFactory $categoryFactory
     * @param DataPersistorInterface $dataPersistor
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(
        Action\Context $context,
        CategoryFactory $categoryFactory,
        DataPersistorInterface $dataPersistor,
        CategoryRepository $categoryRepository
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->categoryFactory = $categoryFactory;
        $this->categoryRepository = $categoryRepository;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();

        if ($data) {
            try {
                if (isset($data['entity_id']) && !empty($data['entity_id'])) {
                    // Update existing category
                    $model = $this->categoryRepository->getById($data['entity_id']);
                } else {
                    // Create new category
                    $model = $this->categoryFactory->create();
                }

                $model->setData($data);
                $this->categoryRepository->save($model);
                $this->messageManager->addSuccessMessage(__('Category saved successfully.'));
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage(
                    $e,
                    __('Something went wrong while saving the category.')
                );
            }

            $this->dataPersistor->set('bss_faq_category', $data);
            if (isset($data['entity_id']) && !empty($data['entity_id'])) {
                return $resultRedirect->setPath('*/*/edit', ['entity_id' => $data['entity_id']]);
            } else {
                return $resultRedirect->setPath('*/*/new');
            }
        }

        return $resultRedirect->setPath('*/*/');
    }
}
