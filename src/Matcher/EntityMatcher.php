<?php

namespace Nca\Shortlink\Matcher;

use Nca\Shortlink\Entity\Shortlink;

class EntityMatcher implements MatcherInterface
{
    /** @var Shortlink */
    private $entity;

    public function __construct(Shortlink $entity)
    {
        $this->entity = $entity;
    }

    public function match(string $source): ?string
    {
        if ($source === $this->entity->getSource()) {
            return $this->entity->getDestination();
        }

        return null;
    }
}