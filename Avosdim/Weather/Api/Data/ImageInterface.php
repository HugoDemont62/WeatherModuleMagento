<?php


namespace Avosdim\Weather\Api\Data;

interface ImageInterface
{
    /**
     * Social Network Product Feed entity id field
     */
    public const ID = 'image_id';
    /**
     * Social Network Product Feed title field
     */
    public const PATH = 'path';
    /**
     * Social Network Product Feed created at field
     */
    public const CREATED_AT = 'created_at';
    /**
     * Social Network Product Feed updated at field
     */
    public const UPDATED_AT = 'updated_at';


    /**
     * @return string
     */
    public function getPath(): string;

    /**
     * @param string $path
     *
     * @return ImageInterface
     */
    public function setPath(string $path): ImageInterface;


    /**
     * @return string
     */
    public function getCreatedAt(): string;

    /**
     * @param string $createdAt
     *
     * @return ImageInterface
     */
    public function setCreatedAt(string $createdAt): ImageInterface;

    /**
     * @return string
     */
    public function getUpdatedAt(): string;

    /**
     * @param string $updatedAt
     *
     * @return ImageInterface
     */
    public function setUpdatedAt(string $updatedAt): ImageInterface;

    /**
     * @return string
     */
    public function getIdField(): string;
}
