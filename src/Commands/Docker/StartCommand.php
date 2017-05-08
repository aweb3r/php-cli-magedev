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

namespace TeamNeusta\Magedev\Commands\Docker;

use Symfony\Component\Console\Question\ConfirmationQuestion;
use TeamNeusta\Magedev\Commands\AbstractCommand;

/**
 * Class: StartCommand
 *
 * @see AbstractCommand
 */
class StartCommand extends AbstractCommand
{
    /**
     * configure
     */
    protected function configure()
    {
        $this->setName("docker:start");
        $this->setDescription("start docker container");

        $this->onExecute(function ($runtime) {
            $runtime
                ->getDocker()
                ->getManager()
                ->startContainers();
        });
    }
}
