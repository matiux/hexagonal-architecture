<?php

declare(strict_types=1);

namespace HexagonalArchitecture\Step04\Idea\Application\Service;

use DDDStarterPack\Application\Service\Response\BasicApplicationServiceResponse;

/**
 * @template T of \HexagonalArchitecture\Step04\Idea\Domain\Model\Idea
 * @extends BasicApplicationServiceResponse<T>
 */
class VotaIdeaResponse extends BasicApplicationServiceResponse
{
    protected function errorCode(): int
    {
        return 1;
    }

    protected function successCode(): int
    {
        return 0;
    }
}
