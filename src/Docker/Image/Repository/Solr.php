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
 * Class Solr.
 */
class Solr extends AbstractImage
{
    /**
     * configure.
     */
    public function configure()
    {
        $solrConfig[] = $this->config->get('solr');

        $this->from($this->imageFactory->create('Solr'));
        $this->name('Solr');
        $this->from('solr:5.3.1');
        $this->run('apt-get update');

        foreach ($solrConfig as $core) {
            $this->run('/opt/solr/bin/solr create -c' . $core);
        }
    }
}

