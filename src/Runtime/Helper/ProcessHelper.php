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

namespace TeamNeusta\Magedev\Runtime\Helper;

/**
 * Class ProcessHelper
 */
class ProcessHelper extends AbstractHelper
{
    /**
     * isProcessRunning
     *
     * @param string $processName
     * @return bool
     */
    public function isProcessRunning($processName)
    {
        $pid = [];
        exec("sudo pidof -c ".$processName, $pid);
        return !empty($pid);
    }
}
