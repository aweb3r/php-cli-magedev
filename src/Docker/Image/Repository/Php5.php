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

namespace TeamNeusta\Magedev\Docker\Image\Repository;

use TeamNeusta\Magedev\Docker\Image\AbstractImage;

/**
 * Class Php5.
 */
class Php5 extends AbstractImage
{
    /**
     * configure.
     */
    public function configure()
    {
        $this->name('php5');
        $this->from('php:5.6-apache');

        $useProxy = $this->config->optionExists("proxy");
        if ($useProxy) {
            $proxy = $this->config->get('proxy');
            if (array_key_exists('HTTP', $proxy)) {
                $httpProxy = $proxy['HTTP'];
                $this->run('echo "Acquire::http::Proxy \\"'.$httpProxy.';\\" > /etc/apt/apt.conf"');
                $this->run('pear config-set http_proxy  '.$httpProxy);
            }
        }

        $this->run('apt-get update');
        $this->run('apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libmcrypt-dev libpng12-dev libxml2-dev');
        $this->run('apt-get install -y mysql-client');
        $this->run('apt-get install -y git');

        $this->run('docker-php-ext-install -j$(nproc) mcrypt');
        $this->run('docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/');
        $this->run('docker-php-ext-install -j$(nproc) gd');
        $this->run('docker-php-ext-install -j$(nproc) soap');
        $this->run('docker-php-ext-install -j$(nproc) pdo_mysql');

        $this->run('pear upgrade');
        $this->run('pecl upgrade');
        $this->run('pecl install xdebug-2.3.3');
        $this->run('a2enmod rewrite');

        $this->run('mkdir /var/www/.composer');
        $this->run('mkdir /var/www/.ssh');
        $this->run('mkdir /var/www/modules');
        $this->run('mkdir /var/www/composer-cache');

        $this->run('chown www-data:www-data /var/www/html');
        $this->run('chown www-data:www-data /var/www/.composer');
        $this->run('chown www-data:www-data /var/www/.ssh');
        $this->run('chown www-data:www-data /var/www/modules');
    }
}
