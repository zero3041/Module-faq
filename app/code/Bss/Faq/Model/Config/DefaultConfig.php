<?php
declare(strict_types=1);

namespace Bss\Faq\Model\Config;

/**
 * Class DefaultConfig
 *
 * Data config default
 */
class DefaultConfig
{
    /**
     * FAQ module config paths
     */
    public const CONFIG_PATH_IS_ENABLE = 'faqtab/general/enable';
    /**
     * FAQ module config title
     */
    public const CONFIG_PATH_PAGE_TITLE = 'faqtab/general/page_title';
    /**
     * FAQ module config paths show category
     */
    public const CONFIG_PATH_IS_SHOW_GROUP = 'faqtab/design/category';
    /**
     * FAQ module config paths show title category
     */
    public const CONFIG_PATH_IS_SHOW_GROUP_TITLE = 'faqtab/design/categorytitle';
    /**
     * FAQ module config paths show link faq footer
     */
    public const CONFIG_PATH_FOOTER_LINK = 'faqtab/design/footerlink';
    /**
     * FAQ module config paths show link faq header
     */
    public const CONFIG_PATH_HEADER_LINK = 'faqtab/design/headerlink';
    /**
     * FAQ module config paths change faq url
     */
    public const FAQ_URL_CONFIG_PATH = 'faqtab/seo/faq_url';
    /**
     * Faq group icon image path
     */
    public const ICON_TMP_PATH = 'faq/tmp/icon/';
}
