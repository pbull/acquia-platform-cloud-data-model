<?php

/*
 * This file is part of the Acquia Platform: Cloud Data Model.
 *
 * (c) Acquia, Inc.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Acquia\Platform\Cloud\Tests\Hosting;

use Acquia\Platform\Cloud\Hosting\Server;

/**
 * @coversDefaultClass \Acquia\Platform\Cloud\Hosting\Server
 */
class ServerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getName
     */
    public function testNamePropertyMayBeAccessedViaMethods()
    {
        $server = new Server('test');
        $this->assertEquals('test', $server->getName());
    }

    /**
     * @covers ::__construct
     * @expectedException \InvalidArgumentException
     */
    public function testNamePropertyMustBeAString()
    {
        $server = new Server([]);
    }

    /**
     * @covers ::__construct
     * @expectedException \InvalidArgumentException
     */
    public function testNamePropertyMustBeAnAlphanumericString()
    {
        $server = new Server(' ');
    }

    /**
     * @covers ::create()
     */
    public function testServerCanBeInstantiatedWithFactoryMethod()
    {
        $server = Server::create(['name' => 'web-123']);
        $this->assertInstanceOf('\Acquia\Platform\Cloud\Hosting\Server', $server);
        $this->assertInstanceOf('\Acquia\Platform\Cloud\Hosting\ServerInterface', $server);

        $server = Server::create(
            [
                'name' => 'web-123',
                'fully_qualified_domain_name' => 'web-123.prod.hosting.acquia.com',
                'ami_type' => 'm2.xlarge',
                'ec2_region' => 'us-east-1',
                'ec2_availability_zone' => 'us-east-1d',
                'services' => array('web' => array('status' => 'online'))
            ]
        );
        $this->assertInstanceOf('\Acquia\Platform\Cloud\Hosting\Server', $server);
        $this->assertInstanceOf('\Acquia\Platform\Cloud\Hosting\ServerInterface', $server);
    }

    /**
     * @covers ::getFullyQualifiedDomainName
     * @covers ::setFullyQualifiedDomainName
     */
    public function testFullyQualifiedDomainNamePropertyMayBeAccessedViaMethods()
    {
        $fqdn = 'web-123.prod.hosting.acquia.com';
        $server = new Server('test');
        $server->setFullyQualifiedDomainName($fqdn);
        $this->assertEquals($fqdn, $server->getFullyQualifiedDomainName());
    }

    /**
     * @covers ::getFullyQualifiedDomainName
     * @expectedException \RuntimeException
     */
    public function testGetFullyQualifiedDomainNameWillThrowExceptionIfPropertyNotSet()
    {
        $server = new Server('test');
        $server->getFullyQualifiedDomainName();
    }

    /**
     * @covers ::setFullyQualifiedDomainName
     * @expectedException \InvalidArgumentException
     */
    public function testSetFullyQualifiedDomainNameWillThrowExceptionIfNotAString()
    {
        $server = new Server('test');
        $server->setFullyQualifiedDomainName([]);
    }

    /**
     * @covers ::setFullyQualifiedDomainName
     * @expectedException \InvalidArgumentException
     */
    public function testSetFullyQualifiedDomainNameWillThrowExceptionIfEmptyString()
    {
        $server = new Server('test');
        $server->setFullyQualifiedDomainName('');
    }

    /**
     * @covers ::getAmiType
     * @covers ::setAmiType
     */
    public function testAmiTypePropertyMayBeAccessedViaMethods()
    {
        $ami = 'm2.xlarge';
        $server = new Server('test');
        $server->setAmiType($ami);
        $this->assertEquals($ami, $server->getAmiType());
    }

    /**
     * @covers ::getAmiType
     * @expectedException \RuntimeException
     */
    public function testGetAmiTypeWillThrowExceptionIfPropertyNotSet()
    {
        $server = new Server('test');
        $server->getAmiType();
    }

    /**
     * @covers ::setAmiType
     * @expectedException \InvalidArgumentException
     */
    public function testSetAmiTypeWillThrowExceptionIfNotAString()
    {
        $server = new Server('test');
        $server->setAmiType([]);
    }

    /**
     * @covers ::setAmiType
     * @expectedException \InvalidArgumentException
     */
    public function testSetAmiTypeWillThrowExceptionIfEmptyString()
    {
        $server = new Server('test');
        $server->setAmiType('');
    }

    /**
     * @covers ::getEc2Region
     * @covers ::setEc2Region
     */
    public function testEc2RegionPropertyMayBeAccessedViaMethods()
    {
        $ec2region = 'us-east-1';
        $server = new Server('test');
        $server->setEc2Region($ec2region);
        $this->assertEquals($ec2region, $server->getEc2Region());

    }

    /**
     * @covers ::getEc2Region
     * @expectedException \RuntimeException
     */
    public function testGetEc2RegionWillThrowExceptionIfPropertyNotSet()
    {
        $server = new Server('test');
        $server->getEc2Region();
    }

    /**
     * @covers ::setEc2Region
     * @expectedException \InvalidArgumentException
     */
    public function testSetEc2RegionWillThrowExceptionIfNotAString()
    {
        $server = new Server('test');
        $server->setEc2Region([]);
    }

    /**
     * @covers ::setEc2Region
     * @expectedException \InvalidArgumentException
     */
    public function testSetEc2RegionWillThrowExceptionIfEmptyString()
    {
        $server = new Server('test');
        $server->setEc2Region('');
    }

    /**
     * @covers ::getEc2AvailabilityZone
     * @covers ::setEc2AvailabilityZone
     */
    public function testEc2AvailabilityZonePropertyMayBeAccessedViaMethods()
    {
        $ec2AvailabilityZone = 'us-east-1d';
        $server = new Server('test');
        $server->setEc2AvailabilityZone($ec2AvailabilityZone);
        $this->assertEquals($ec2AvailabilityZone, $server->getEc2AvailabilityZone());

    }

    /**
     * @covers ::getEc2AvailabilityZone
     * @expectedException \RuntimeException
     */
    public function testGetEc2AvailabilityZoneWillThrowExceptionIfPropertyNotSet()
    {
        $server = new Server('test');
        $server->getEc2AvailabilityZone();
    }

    /**
     * @covers ::setEc2AvailabilityZone
     * @expectedException \InvalidArgumentException
     */
    public function testSetEc2AvailabilityZoneWillThrowExceptionIfNotAString()
    {
        $server = new Server('test');
        $server->setEc2AvailabilityZone([]);
    }

    /**
     * @covers ::setEc2AvailabilityZone
     * @expectedException \InvalidArgumentException
     */
    public function testSetEc2AvailabilityZoneWillThrowExceptionIfEmptyString()
    {
        $server = new Server('test');
        $server->setEc2AvailabilityZone('');
    }

    /**
     * @covers ::getServices
     * @covers ::setServices
     */
    public function testServicesPropertyMayBeAccessedViaMethods()
    {
        $services = array('web' => array('status' => 'online'));
        $server = new Server('test');
        $server->setServices($services);
        $this->assertEquals($services, $server->getServices());

    }

    /**
     * @covers ::getServices
     * @expectedException \RuntimeException
     */
    public function testGetServicesWillThrowExceptionIfPropertyNotSet()
    {
        $server = new Server('test');
        $server->getServices();
    }

    /**
     * @covers ::setServices
     * @expectedException \InvalidArgumentException
     */
    public function testSetServicesWillThrowExceptionIfNotAnArray()
    {
        $server = new Server('test');
        $server->setServices('');
    }

    /**
     * @covers ::setServices
     * @expectedException \InvalidArgumentException
     */
    public function testSetServicesWillThrowExceptionIfEmptyArray()
    {
        $server = new Server('test');
        $server->setServices([]);
    }
}
