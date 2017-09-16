<?php

declare(strict_types=1);

namespace Nca\Shortlink\Resolver;

use Nca\Shortlink\Entity\Shortlink;

class ShortlinkResolver implements ResolverInterface
{
    /**
     * @var Shortlink
     */
    private $shortlink;

    /**
     * @param Shortlink $shortlink
     */
    public function __construct(Shortlink $shortlink)
    {
        $this->shortlink = $shortlink;
    }

    /**
     * @inheritDoc
     */
    public function resolve(string $source): ?string
    {
        if ($source === $this->shortlink->getSource()) {
            return $this->shortlink->getDestination();
        }

        return null;
    }
}
