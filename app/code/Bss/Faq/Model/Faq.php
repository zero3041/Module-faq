<?php
declare(strict_types=1);

namespace Bss\Faq\Model;

use Bss\Faq\Api\Data\FaqInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * Class InternShip
 *
 * Model InternShip
 */
class Faq extends AbstractModel implements FaqInterface
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
    /**
     * Get faq ID
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * Set faq ID
     *
     * @param int $id
     * @return Faq
     */
    public function setId($id): Faq
    {
        return $this->setData(self::ENTITY_ID, $id);
    }

    /**
     * Get category ID
     *
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->getData(self::CATEGORY_ID);
    }

    /**
     * Set category ID
     *
     * @param int $id
     * @return mixed
     */
    public function setCategoryId(int $id)
    {
        return $this->setData(self::CATEGORY_ID, $id);
    }

    /**
     * Get faq title
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->getData(self::TITLE);
    }

    /**
     * Set faq title
     *
     * @param string $title
     * @return mixed
     */
    public function setTitle(string $title)
    {
        return $this->setData(self::TITLE, $title);
    }
    /**
     * Get content
     *
     * @return mixed
     */
    public function getContent()
    {
        return $this->getData(self::CONTENT);
    }

    /**
     * Set view
     *
     * @param string $content
     * @return mixed
     */
    public function setContent($content)
    {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * Get view
     *
     * @return mixed
     */
    public function getView()
    {
        return $this->getData(self::VIEW);
    }

    /**
     * Set view
     *
     * @param int $view
     * @return mixed
     */
    public function setView(int $view)
    {
        return $this->setData(self::VIEW, $view);
    }

    /**
     * Get like
     *
     * @return mixed
     */
    public function getLike()
    {
        return $this->getData(self::LIKE);
    }

    /**
     * Set like
     *
     * @param int $like
     * @return mixed
     */
    public function setLike(int $like)
    {
        return $this->setData(self::LIKE, $like);
    }

    /**
     * Get dislike
     *
     * @return mixed
     */
    public function getDislike()
    {
        return $this->getData(self::DISLIKE);
    }

    /**
     * Set dislike
     *
     * @param int $dislike
     * @return mixed
     */
    public function setDislike(int $dislike)
    {
        return $this->setData(self::DISLIKE, $dislike);
    }

    /**
     * Get creation date
     *
     * @return string
     */
    public function getCreatedBy(): string
    {
        return $this->getData(self::CREATE_BY);
    }

    /**
     * Set creation date
     *
     * @param string $createdBy
     * @return mixed
     */
    public function setCreatedBy(string $createdBy)
    {
        return $this->setData(self::CREATE_BY, $createdBy);
    }

    /**
     * Get category status
     *
     * @return int
     */
    public function getStatus(): int
    {
        return $this->getData(self::STATUS);
    }

    /**
     * Set category status
     *
     * @param int $status
     * @return mixed
     */
    public function setStatus(int $status)
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * Get faq order
     *
     * @return int
     */
    public function getSortOder(): int
    {
        return $this->getData(self::SORTORDER);
    }

    /**
     * Set faq order
     *
     * @param int $sortOder
     * @return mixed
     */
    public function setSortOder(int $sortOder)
    {
        return $this->setData(self::SORTORDER, $sortOder);
    }

    /**
     * Get creation date
     *
     * @return string
     */
    public function getCreatedAt(): string
    {
        return (string) $this->getData(self::CREATED_AT);
    }

    /**
     * Set creation date
     *
     * @param string $createdAt
     * @return mixed
     */
    public function setCreatedAt(string $createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * Get last update date
     *
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return (string) $this->getData(self::UPDATED_AT);
    }

    /**
     * Set last update date
     *
     * @param string $updatedAt
     * @return mixed
     */
    public function setUpdatedAt(string $updatedAt)
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }
}
