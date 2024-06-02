<?php
declare(strict_types=1);

namespace Bss\Faq\Model;

use Bss\Faq\Api\Data\CategoryInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * Class Category
 *
 * Model for FAQ Category
 */
class Category extends AbstractModel implements CategoryInterface
{
    /**
     * Initialize category model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Bss\Faq\Model\ResourceModel\Category::class);
    }

    /**
     * Get category ID
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * Set category ID
     *
     * @param int $id
     * @return Category
     */
    public function setId($id): Category
    {
        return $this->setData(self::ENTITY_ID, $id);
    }

    /**
     * Get category title
     *
     * @return string
     */
    public function getTitle(): string
    {
        return (string) $this->getData(self::TITLE);
    }

    /**
     * Set category title
     *
     * @param string $title
     * @return Category
     */
    public function setTitle(string $title): Category
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * Get category status
     *
     * @return int
     */
    public function getStatus(): int
    {
        return (int) $this->getData(self::STATUS);
    }

    /**
     * Set category status
     *
     * @param int $status
     * @return Category
     */
    public function setStatus(int $status): Category
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * Get category image URL
     *
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->getData(self::IMAGE);
    }

    /**
     * Set category image URL
     *
     * @param string|null $image
     * @return Category
     */
    public function setImage(?string $image): Category
    {
        return $this->setData(self::IMAGE, $image);
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
     * @return Category
     */
    public function setCreatedAt(string $createdAt): Category
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
     * @return Category
     */
    public function setUpdatedAt(string $updatedAt): Category
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }
}
