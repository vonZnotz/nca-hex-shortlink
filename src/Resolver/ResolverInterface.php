<?php

declare(strict_types=1);

namespace Nca\Shortlink\Resolver;

interface ResolverInterface
{
    /**
     * @param string $source
     * @return string|null
     */
    public function resolve(string $source): ?string;
}
