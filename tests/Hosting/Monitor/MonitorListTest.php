<?php

/*
 * This file is part of the Acquia Platform: Cloud Data Model.
 *
 * (c) Acquia, Inc.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Acquia\Platform\Cloud\Tests\Hosting\Monitor;

use Acquia\Platform\Cloud\Hosting\Monitor\MonitorInterface;
use Acquia\Platform\Cloud\Hosting\Monitor\MonitorList;

/**
 * @coversDefaultClass \Acquia\Platform\Cloud\Hosting\Monitor\MonitorList
 */
class MonitorListTest extends \PHPUnit_Framework_TestCase
{
    protected function getMonitor($serviceName = 'service')
    {
        $mock = $this->getMock('Acquia\Platform\Cloud\Hosting\Monitor\MonitorInterface');
        $mock->expects($this->any())
            ->method('getMonitoringUrls')
            ->willReturn(['url'])
        ;
        $mock->expects($this->any())
            ->method('getName')
            ->willReturn($serviceName)
        ;
        $mock->expects($this->any())
            ->method('getArrayCopy')
            ->willReturn([
                'name' => $serviceName,
                'status' => 'active',
                'urls' => [
                    'url',
                ],
            ])
        ;
        return $mock;
    }

    /**
     * @covers ::offsetSet
     */
    public function testAllowsMonitorToBeAppended()
    {
        $list = new MonitorList();
        $list->append($this->getMock('Acquia\Platform\Cloud\Hosting\Monitor\MonitorInterface'));
        $this->assertTrue($list[0] instanceof MonitorInterface);
    }

    /**
     * @covers ::offsetSet
     * @expectedException \InvalidArgumentException
     */
    public function testThrowsExceptionIfNonMonitorIsAppended()
    {
        $list = new MonitorList();
        $list->append(new static);
    }

    /**
     * @covers ::getMonitoringUrls
     */
    public function testReturnsEmptyArrayIfNoMonitorsAdded()
    {
        $list = new MonitorList();
        $this->assertEquals([], $list->getMonitoringUrls());
    }

    /**
     * @covers ::getMonitoringUrls
     */
    public function testReturnsUrlsForAllMonitorsAdded()
    {
        $list = new MonitorList();
        $list->append($this->getMonitor('service1'));
        $list->append($this->getMonitor('service2'));
        $this->assertEquals(
            ['service1' => ['url'], 'service2' => ['url']],
            $list->getMonitoringUrls()
        );
        $this->assertEquals(
            ['service2' => ['url']],
            $list->getMonitoringUrls('service2')
        );
    }

    /**
     * @covers ::getArrayCopy
     */
    public function testReturnsArrayCopyForAllMonitorsAdded()
    {
        $list = new MonitorList();
        $list->append($this->getMonitor('service1'));
        $list->append($this->getMonitor('service2'));
        $this->assertEquals(
            [
                'service1' => [
                    'name' => 'service1',
                    'status' => 'active',
                    'urls' => [
                        0 => 'url',
                    ],
                ],
                'service2' => [
                    'name' => 'service2',
                    'status' => 'active',
                    'urls' => [
                        0 => 'url',
                    ],
                ]
            ],
            $list->getArrayCopy()
        );
        $this->assertEquals(
            [
                'service2' => [
                    'name' => 'service2',
                    'status' => 'active',
                    'urls' => [
                        'url'
                    ],
                ]
            ],
            $list->getArrayCopy('service2')
        );
    }
}
