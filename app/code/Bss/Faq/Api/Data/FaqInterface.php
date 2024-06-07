<?php
declare(strict_types=1);

namespace Bss\Faq\Api\Data;

/**
 * Interface FaqInterface
 *
 * Faq interface
 */
interface FaqInterface
{
    public const ENTITY_ID = 'entity_id';

    public const CATEGORY_ID = 'category_id';

    public const TITLE = 'title';

    public const CONTENT = 'content';

    public const VIEW = 'view';

    public const LIKE = 'like';

    public const DISLIKE = 'dislike';

    public const CREATE_BY = 'create_by';

    public const STATUS = 'status';

    public const SORTORDER = 'sortorder';

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
     * Get category ID
     *
     * @return mixed
     */
    public function getCategoryId();

    /**
     * Set category ID
     *
     * @param int $id
     * @return mixed
     */
    public function setCategoryId(int $id);

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
     * Get content
     *
     * @return string|null
     */
    public function getContent();

    /**
     * Set content
     *
     * @param string $content
     * @return \Bss\Faq\Api\Data\FaqInterface
     */
    public function setContent($content);
    /**
     * Get view
     *
     * @return mixed
     */
    public function getView();

    /**
     * Set view
     *
     * @param int $view
     * @return mixed
     */
    public function setView(int $view);
    /**
     * Get like
     *
     * @return mixed
     */
    public function getLike();

    /**
     * Set like
     *
     * @param int $like
     * @return mixed
     */
    public function setLike(int $like);
    /**
     * Get dislike
     *
     * @return mixed
     */
    public function getDislike();

    /**
     * Set dislike
     *
     * @param int $dislike
     * @return mixed
     */
    public function setDislike(int $dislike);
    /**
     * Get creation date
     *
     * @return string
     */
    public function getCreatedBy(): string;

    /**
     * Set creation date
     *
     * @param string $createdBy
     * @return mixed
     */
    public function setCreatedBy(string $createdBy);

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
     * Get faq order
     *
     * @return int
     */
    public function getSortOder(): int;

    /**
     * Set faq order
     *
     * @param int $sortOder
     * @return mixed
     */
    public function setSortOder(int $sortOder);

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
