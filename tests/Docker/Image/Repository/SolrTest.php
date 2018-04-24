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

namespace TeamNeusta\Magedev\Test\Docker\Image\Repository;

use Mockery as m;
use TeamNeusta\Magedev\Docker\Image\Repository\Solr;
use TeamNeusta\Magedev\Runtime\Config;
use TeamNeusta\Magedev\Runtime\Helper\FileHelper;
use TeamNeusta\Magedev\Docker\Image\Factory as ImageFactory;

/**
 * Class: SolrTest.
 *
 * @see \PHPUnit_Framework_TestCase
 */
class SolrTest extends \TeamNeusta\Magedev\Test\TestCase
{
    public function testConfigure()
    {
        $config = m::mock(Config::class);
        $config->shouldReceive('get')->with('env_vars')->andReturn([]);
        $imageFactory = m::mock(ImageFactory::class);
        $fileHelper = m::mock(FileHelper::class);

        $contextBuilder = m::mock("Docker\Context\ContextBuilder[__destruct,run,add,from]")->makePartial();
        $contextBuilder->shouldReceive('from')
            ->with('solr:5.3.1')->times(1);
        $contextBuilder->shouldReceive('run')
            ->with('usermod -u '.getmyuid().' solr')->times(1);

        $imageApiFactory = m::mock("\TeamNeusta\Magedev\Docker\Api\ImageFactory");
        $nameBuilder = m::mock("\TeamNeusta\Magedev\Docker\Helper\NameBuilder");

        $image = new Solr(
            $config,
            $imageFactory,
            $fileHelper,
            $contextBuilder,
            $imageApiFactory,
            $nameBuilder
        );
        $image->configure();
    }
}
