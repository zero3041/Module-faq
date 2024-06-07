<?php
declare(strict_types=1);

namespace Bss\Faq\Controller\Detail;

use Bss\Faq\Model\FaqFactory;
use Bss\Faq\Model\ResourceModel\Faq as FaqResourceModel;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\ForwardFactory;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Exception\AlreadyExistsException;

/**
 * Class Feedback
 *
 * Feed response
 */
class Feedback implements HttpPostActionInterface
{
    /**
     * @var JsonFactory
     */
    protected $resultJsonFactory;

    /**
     * @var ForwardFactory
     */
    protected $resultForwardFactory;

    /**
     * @var FaqResourceModel
     */
    protected $faqResourceModel;

    /**
     * @var FaqFactory
     */
    protected $faqFactory;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @param Context $context
     * @param JsonFactory $resultJsonFactory
     * @param ForwardFactory $resultForwardFactory
     * @param FaqResourceModel $faqResourceModel
     * @param FaqFactory $faqFactory
     */
    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory,
        ForwardFactory $resultForwardFactory,
        FaqResourceModel $faqResourceModel,
        FaqFactory $faqFactory
    ) {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->resultForwardFactory = $resultForwardFactory;
        $this->faqResourceModel = $faqResourceModel;
        $this->faqFactory = $faqFactory;
        $this->request = $context->getRequest();
    }

    /**
     * Ajax action
     *
     * @return \Magento\Framework\Controller\Result\Json|\Magento\Framework\Controller\Result\Forward
     * @throws AlreadyExistsException
     */
    public function execute()
    {
        $result = $this->resultJsonFactory->create();
        if ($this->request->isAjax()) {
            $type = $this->request->getParam('type');
            $faqId = (int) $this->request->getParam('faq_id');

            $faqModel = $this->faqFactory->create();
            $this->faqResourceModel->load($faqModel, $faqId);
            if ($faqModel->getId()) {
                if ($type == '1') {
                    $faqModel->setLike($faqModel->getLike() + 1);
                } elseif ($type == '0') {
                    $faqModel->setDislike($faqModel->getDislike() + 1);
                }
                $this->faqResourceModel->save($faqModel);
            }

            return $result->setData(['status' => 'success']);
        }

        $resultForward = $this->resultForwardFactory->create();
        return $resultForward->forward('noroute');
    }
}
