<?php

namespace Nca\Shortlink\Matcher;

interface MatcherInterface
{
    public function match(string $source): ?string;
}