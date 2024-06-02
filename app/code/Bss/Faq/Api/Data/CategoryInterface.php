<?php
declare(strict_types=1);

namespace Bss\Faq\Api\Data;

/**
 * Interface CategoryInterface
 *
 * Categories interface
 */
interface CategoryInterface
{
    public const ENTITY_ID = 'entity_id';

    public const TITLE = 'title';

    public const STATUS = 'status';

    public const IMAGE = 'image';

    public const CREATED_AT = 'created_at';

    public const UPDATED_AT = 'updated_at';

    /**
     * Get category ID
     *
     * @return mixed
     */
    public function getId();

    /**
     * Set category ID
     *
     * @param int $id
     * @return mixed
     */
    public function setId(int $id);

    /**
     * Get category title
     *
     * @return string
     */
    public function getTitle(): string;

    /**
     * Set category title
     *
     * @param string $title
     * @return mixed
     */
    public function setTitle(string $title);

    /**
     * Get category status
     *
     * @return int
     */
    public function getStatus(): int;

    /**
     * Set category status
     *
     * @param int $status
     * @return mixed
     */
    public function setStatus(int $status);

    /**
     * Get category image URL
     *
     * @return string|null
     */
    public function getImage(): ?string;

    /**
     * Set category image URL
     *
     * @param string|null $image
     * @return mixed
     */
    public function setImage(?string $image);

    /**
     * Get creation date
     *
     * @return string
     */
    public function getCreatedAt(): string;

    /**
     * Set creation date
     *
     * @param string $createdAt
     * @return mixed
     */
    public function setCreatedAt(string $createdAt);

    /**
     * Get last update date
     *
     * @return string
     */
    public function getUpdatedAt(): string;

    /**
     * Set last update date
     *
     * @param string $updatedAt
     * @return mixed
     */
    public function setUpdatedAt(string $updatedAt);
}
