<?php

/**
 * Part of the Antares package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    Logger
 * @version    0.9.0
 * @author     Antares Team
 * @license    BSD License (3-clause)
 * @copyright  (c) 2017, Antares
 * @link       http://antaresproject.io
 */

namespace Antares\Logger\Events;

use Antares\Model\User;
use Carbon\Carbon;

class NewDeviceDetected
{

    /**
     * User instance.
     *
     * @var User
     */
    public $user;

    /**
     * DateTime of detection
     *
     * @var Carbon
     */
    public $dateTime;

    /**
     * Detection parameters.
     *
     * @var array
     */
    public $params = [];

    /**
     * NewDeviceDetected constructor.
     * @param User $user
     * @param Carbon $dateTime
     * @param array $params
     */
    public function __construct(User $user, Carbon $dateTime, array $params = []) {
        $this->user     = $user;
        $this->dateTime = $dateTime;
        $this->params   = $params;
    }

}