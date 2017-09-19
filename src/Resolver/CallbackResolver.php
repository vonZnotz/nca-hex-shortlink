<?php

namespace Nca\Shortlink\Resolver;

class CallbackResolver implements ResolverInterface
{
    /**
     * @var \Closure
     */
    protected $callback;

    /**
     * @param \Closure $callback
     */
    public function __construct(\Closure $callback)
    {
        $this->callback = $callback;
    }

    /**
     * @inheritDoc
     */
    public function resolve(string $source): ?string
    {
        $callback = $this->callback;

        try {
            $destination = $callback($source);
        } catch (\Exception $e) {
            $destination = null;
        }

        return $destination;
    }
}
