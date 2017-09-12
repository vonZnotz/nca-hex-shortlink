<?php

namespace Nca\Shortlink\Matcher;

class MatcherCollection implements MatcherInterface
{
    /** @var MatcherInterface[] */
    private $matchers;

    public function __construct(MatcherInterface ...$matchers)
    {
        $this->matchers = $matchers;
    }

    public function match(string $source): ?string
    {
        foreach ($this->matchers as $matcher) {
            $destination = $matcher->match($source);

            if ($destination !== null) {
                return $destination;
            }
        }

        return null;
    }
}