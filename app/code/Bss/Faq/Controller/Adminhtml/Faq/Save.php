<?php
declare(strict_types=1);

namespace Bss\Faq\Controller\Adminhtml\Faq;

use Bss\Faq\Api\FaqRepositoryInterface;
use Bss\Faq\Model\FaqFactory;
use Magento\Backend\App\Action;
use Magento\Backend\Model\Auth\Session;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class Save
 *
 * Save Faq
 */
class Save extends Faq
{
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var FaqFactory
     */
    protected $faqFactory;

    /**
     * @var FaqRepositoryInterface
     */
    protected $faqRepository;

    /**
     * @var Session
     */
    protected $authSession;

    /**
     * Save constructor.
     * @param Action\Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param FaqFactory $faqFactory
     * @param FaqRepositoryInterface $faqRepository
     * @param Session $authSession
     */
    public function __construct(
        Action\Context $context,
        DataPersistorInterface $dataPersistor,
        FaqFactory $faqFactory,
        FaqRepositoryInterface $faqRepository,
        Session $authSession
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->faqFactory = $faqFactory;
        $this->faqRepository = $faqRepository;
        $this->authSession = $authSession;
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
            $model = $this->faqFactory->create();
            try {
                if ($id = (int) $this->getRequest()->getParam('entity_id')) {
                    $model = $this->faqRepository->getById($id);
                    if ($id != $model->getId()) {
                        $this->messageManager->addErrorMessage(__('This FAQ no longer exists.'));
                        return $resultRedirect->setPath('*/*/');
                    }
                }
                $currentUserName = $this->getCurrentUserName();
                $data['create_by'] = $currentUserName;
                $model->addData($data);
                $this->faqRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the FAQ.'));
                $this->dataPersistor->clear('prince_faq_faq');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['entity_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the FAQ.'));
            }

            $this->dataPersistor->set('bss_faq_faq', $data);
            return $resultRedirect->setPath('*/*/edit', ['entity_id' => $this->getRequest()->getParam('entity_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }

    /**
     * Function add user to create by
     *
     * @return mixed|string|null
     */
    public function getCurrentUserName()
    {
        return $this->authSession->getUser()->getUsername();
    }
}
