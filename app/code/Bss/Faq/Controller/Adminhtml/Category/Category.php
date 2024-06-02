<?php
declare(strict_types=1);

namespace Bss\Faq\Controller\Adminhtml\Category;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;

/**
 * Class Category
 * Abstract Category
 */
abstract class Category extends Action implements HttpPostActionInterface, HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'Bss_Faq::manage_categories';
}
