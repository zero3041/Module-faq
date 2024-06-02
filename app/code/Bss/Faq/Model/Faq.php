<?php
declare(strict_types=1);

namespace Bss\Faq\Model;

use Magento\Framework\Model\AbstractModel;

/**
 * Class InternShip
 *
 * Model InternShip
 */
class Faq extends AbstractModel
{
    /**
     * Function constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Bss\Faq\Model\ResourceModel\Faq::class);
    }
}
