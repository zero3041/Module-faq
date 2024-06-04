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

        if ($data = $this->getRequest()->getPostValue()) {
            $model = $this->categoryFactory->create();
            try {
                if ($id = (int)$this->getRequest()->getParam('entity_id')) {
                    $model = $this->categoryRepository->getById($id);
                    if ($id != $model->getId()) {
                        $this->messageManager->addErrorMessage(__('This Category no longer exists.'));
                        return $resultRedirect->setPath('*/*/');
                    }
                }

                $data = $this->_filterCategoryData($data);
                $model->addData($data);
                $this->categoryRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the Category.'));
                $this->dataPersistor->clear('bss_faq_category');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['entity_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage(
                    $e,
                    __('Something went wrong while saving the Category.')
                );
            }

            $this->dataPersistor->set('bss_faq_category', $data);
            return $resultRedirect->setPath(
                '*/*/edit',
                [
                    'entity_id' => $this->getRequest()->getParam('entity_id')
                ]
            );
        }
        return $resultRedirect->setPath('*/*/');
    }
    /**
     * Filter data img
     *
     * @param array $rawData
     * @return array
     */
    protected function _filterCategoryData(array $rawData)
    {
        $data = $rawData;
        if (isset($data['icon'][0]['name'])) {
            $data['icon'] = $data['icon'][0]['name'];
        } else {
            $data['icon'] = null;
        }

        return $data;
    }
}
