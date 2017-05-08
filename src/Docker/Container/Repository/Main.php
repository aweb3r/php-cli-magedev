<?php
/**
 * This file is part of the teamneusta/php-cli-magedev package.
 *
 * Copyright (c) 2017 neusta GmbH | Ein team neusta Unternehmen
 *
 * For the full copyright and license information, please view the LICENSE file that was distributed with this source code.
 *
 * @license https://opensource.org/licenses/mit-license MIT License
 */

namespace TeamNeusta\Magedev\Docker\Container\Repository;

use TeamNeusta\Magedev\Docker\Container\AbstractContainer;

/**
 * Class: Main
 *
 * @see AbstractContainer
 */
class Main extends AbstractContainer
{
    /**
     * getName
     */
    public function getName()
    {
        return 'main';
    }

    /**
     * getImage
     */
    public function getImage()
    {
        return new \TeamNeusta\Magedev\Docker\Image\Repository\Main($this->context);
    }

    /**
     * getBuildName
     */
    public function getBuildName()
    {
        // name for this image is project dependend
        return $this->context->buildName(
            $this->getName()
        );
    }

    /**
     * getConfig
     */
    public function getConfig()
    {
        $homePath    = $this->context->getConfig()->getHomePath();
        $projectPath = $this->context->getConfig()->getProjectPath();

        // TODO: make this configurable ?
        $this->setBinds([
            $projectPath  . ':/var/www/html:rw',
            $homePath     . '/.composer:/var/www/.composer:rw', // TODO: check for existence?
            $homePath     . '/.ssh:/var/www/.ssh:rw'
        ]);

        $config = parent::getConfig();
        return $config;
    }
}
