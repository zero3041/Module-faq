<?php
declare(strict_types=1);

namespace Bss\Faq\Controller\Detail;

use Bss\Faq\Model\FaqRepository;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\ForwardFactory;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 *
 * Create page search results
 */
class Index implements HttpGetActionInterface
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;
    /**
     * @var ForwardFactory
     */
    protected $resultForwardFactory;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var FaqRepository
     */
    protected $faqRepository;

    /**
     * @param PageFactory $resultPageFactory
     * @param ForwardFactory $resultForwardFactory
     * @param RequestInterface $request
     * @param FaqRepository $faqRepository
     */
    public function __construct(
        PageFactory $resultPageFactory,
        ForwardFactory $resultForwardFactory,
        RequestInterface $request,
        FaqRepository $faqRepository
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->resultForwardFactory = $resultForwardFactory;
        $this->request = $request;
        $this->faqRepository = $faqRepository;
    }

    /**
     * Index action
     *
     * @return \Magento\Framework\View\Result\Page
     * @throws AlreadyExistsException
     */
    public function execute()
    {
        $faqId = (int) $this->request->getParam('faq_id');
        $faq = $this->faqRepository->getById($faqId);

        if ($faq->getId()) {
            return $this->resultPageFactory->create();
        }

        $result = $this->resultForwardFactory->create();
        $result->setController('index');
        $result->forward('defaultNoRoute');

        return $result;
    }
}
