<?php

declare(strict_types=1);

namespace Nca\Shortlink\Entity;

class Shortlink
{
    /**
     * @var string
     */
    private $source;

    /**
     * @var string
     */
    private $destination;

    /**
     * @param string $source
     * @param string $destination
     */
    public function __construct(string $source, string $destination)
    {
        $this->source = $source;
        $this->destination = $destination;
    }

    /**
     * @return string
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * @return string
     */
    public function getDestination(): string
    {
        return $this->destination;
    }
}
