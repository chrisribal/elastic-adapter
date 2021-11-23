<?php declare(strict_types=1);

namespace ElasticAdapter\Tests\Unit\Search;

use ElasticAdapter\Search\PointInTimeManager;
use Elasticsearch\Client;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \ElasticAdapter\Search\PointInTimeManager
 */
final class PointInTimeManagerTest extends TestCase
{
    /**
     * @var MockObject
     */
    private $client;
    /**
     * @var PointInTimeManager
     */
    private $pointInTimeManager;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = $this->createMock(Client::class);
        $this->pointInTimeManager = new PointInTimeManager($this->client);
    }

    public function test_point_in_time_can_be_opened(): void
    {
        $this->client
            ->expects($this->once())
            ->method('openPointInTime')
            ->with([
                'index' => 'test',
                'keep_alive' => '1m',
            ])
            ->willReturn([
                'id' => '46ToAwMDaWR5BXV1',
            ]);

        $this->assertSame('46ToAwMDaWR5BXV1', $this->pointInTimeManager->open('test', '1m'));
    }

    public function test_point_in_time_can_be_closed(): void
    {
        $this->client
            ->expects($this->once())
            ->method('closePointInTime')
            ->with([
                'body' => [
                    'id' => '46ToAwMDaWR5BXV1',
                ],
            ]);

        $this->assertSame($this->pointInTimeManager, $this->pointInTimeManager->close('46ToAwMDaWR5BXV1'));
    }
}
