<?php

/*
 * This file is part of the Acquia Platform: Cloud Data Model.
 *
 * (c) Acquia, Inc.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Acquia\Platform\Cloud\Hosting;

final class DbInstance implements DbInstanceInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $instanceName;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $host;

    /**
     * @var int
     */
    private $clusterID;

    public function __construct($instanceName)
    {
        if (!is_string($instanceName) || !preg_match('#^[a-z0-9]+$#i', $instanceName)) {
            throw new \InvalidArgumentException(
                sprintf(
                    '%s: DbInstance name must be an alphanumeric string (%s given)',
                    __METHOD__,
                    is_string($instanceName) ? $instanceName : gettype($instanceName)
                )
            );
        }
        $this->instanceName = $instanceName;
    }

    /**
     * {@inheritdoc}
     */
    public static function create(array $dbInstanceData)
    {
        $app = new static($dbInstanceData['instance_name']);
        if (isset($dbInstanceData['name'])) {
            $app->setName($dbInstanceData['name']);
        }
        if (isset($dbInstanceData['username'])) {
            $app->setUsername($dbInstanceData['username']);
        }
        if (isset($dbInstanceData['password'])) {
            $app->setPassword($dbInstanceData['password']);
        }
        if (isset($dbInstanceData['host'])) {
            $app->setHost($dbInstanceData['host']);
        }
        if (isset($dbInstanceData['db_cluster'])) {
            $app->setClusterID($dbInstanceData['db_cluster']);
        }

        return $app;
    }

    /**
     * {@inheritdoc}
     */
    public function getInstanceName()
    {
        return $this->instanceName;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        if ($this->name === null) {
            throw new \RuntimeException(
                sprintf('%s: This DbInstance object does not know the name.', __METHOD__)
            );
        }
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        if (!is_string($name) || empty($name)) {
            throw new \InvalidArgumentException(
                sprintf('%s: $name expects a string.', __METHOD__)
            );
        }
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function getUsername()
    {
        if ($this->username === null) {
            throw new \RuntimeException(
                sprintf('%s: This DbInstance object does not know the username.', __METHOD__)
            );
        }
        return $this->username;
    }

    /**
     * {@inheritdoc}
     */
    public function setUsername($username)
    {
        if (!is_string($username) || empty($username)) {
            throw new \InvalidArgumentException(
                sprintf('%s: $username expects a string.', __METHOD__)
            );
        }
        $this->username = $username;
    }

    /**
     * {@inheritdoc}
     */
    public function getPassword()
    {
        if ($this->password === null) {
            throw new \RuntimeException(
                sprintf('%s: This DbInstance object does not know the password.', __METHOD__)
            );
        }
        return $this->password;
    }

    /**
     * {@inheritdoc}
     */
    public function setPassword($password)
    {
        if (!is_string($password) || empty($password)) {
            throw new \InvalidArgumentException(
                sprintf('%s: $password expects a string.', __METHOD__)
            );
        }
        $this->password = $password;
    }

    /**
     * {@inheritdoc}
     */
    public function getHost()
    {
        if ($this->host === null) {
            throw new \RuntimeException(
                sprintf('%s: This DbInstance object does not know the host.', __METHOD__)
            );
        }
        return $this->host;
    }

    /**
     * {@inheritdoc}
     */
    public function setHost($host)
    {
        if (!is_string($host) || empty($host)) {
            throw new \InvalidArgumentException(
                sprintf('%s: $host expects a string.', __METHOD__)
            );
        }
        $this->host = $host;
    }

    /**
     * {@inheritdoc}
     */
    public function getClusterID()
    {
        if ($this->clusterID === null) {
            throw new \RuntimeException(
                sprintf('%s: This DbInstance object does not know the clusterID.', __METHOD__)
            );
        }
        return $this->clusterID;
    }

    /**
     * {@inheritdoc}
     */
    public function setClusterID($clusterID)
    {
        if (!is_string($clusterID) || empty($clusterID)) {
            throw new \InvalidArgumentException(
                sprintf('%s: $clusterID expects a string.', __METHOD__)
            );
        }
        $this->clusterID = $clusterID;
    }
}
