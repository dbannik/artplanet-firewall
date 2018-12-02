<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 01.12.18
 * Time: 15:54.
 */

namespace ArtplanetFirewall\Component\Resource;

/**
 * Interface Resource.
 */
interface ResourceInterface
{
    /**
     * @return array
     */
    public function getData(): array;
}
