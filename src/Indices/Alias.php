<?php declare(strict_types=1);

namespace ElasticAdapter\Indices;

final class Alias
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var array|null
     */
    private $filter;
    /**
     * @var string|null
     */
    private $routing;

    public function __construct(string $name, ?array $filter = null, ?string $routing = null)
    {
        $this->name = $name;
        $this->filter = $filter;
        $this->routing = $routing;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function filter(): ?array
    {
        return $this->filter;
    }

    public function routing(): ?string
    {
        return $this->routing;
    }
}
