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

namespace Antares\Logger\Utilities;

use Antares\Brands\Model\Brands;
use Antares\Logger\Model\Logs;
use Antares\Model\User;
use HTML;

class LogCreatorDecorator
{

    /**
     * @var Logs
     */
    protected $log;

    /**
     * @var string
     */
    protected static $pattern = '#%d %s';

    /**
     * @var User[]
     */
    protected static $cachedAuthorsAsUser = [];

    /**
     * @var User[]
     */
    protected static $cachedUsers = [];

    /**
     * @var Brands[]
     */
    protected static $cachedBrands = [];

    /**
     * LogCreatorDecorator constructor.
     * @param Logs $log
     */
    public function __construct(Logs $log) {
        $this->log = $log;
    }

    /**
     * @param Logs $log
     * @return LogCreatorDecorator
     */
    public static function make(Logs $log) : self {
        return new LogCreatorDecorator($log);
    }

    /**
     * @return string
     */
    public function getDecorated() : string {
        $entity = $this->getAvailableCreatorEntity();

        if($entity instanceof User) {
            return HTML::link(handles('users/' . $entity->id . '/edit'), sprintf(self::$pattern, $entity->id, $entity->fullname));
        }

        if($entity instanceof Brands) {
            return sprintf(self::$pattern, $entity->id, $entity->name);
        }

        return '#' . $entity->id;
    }

    /**
     * @return Brands|User
     */
    protected function getAvailableCreatorEntity() {
        if($this->log->author_id) {
            $id = $this->log->author_id;

            if( array_key_exists($id, self::$cachedAuthorsAsUser) ) {
                return self::$cachedAuthorsAsUser[$id];
            }

            /* @var $user User */
            $user = User::query()->where('id', $id)->first();

            return self::$cachedAuthorsAsUser[$id] = $user;
        }

        if($this->log->user_id) {
            $userId = $this->log->user_id;

            if( array_key_exists($userId, self::$cachedUsers) ) {
                return self::$cachedUsers[$userId];
            }

            return self::$cachedUsers[$userId] = $this->log->user;
        }

        if($this->log->brand_id) {
            $brandId = $this->log->brand_id;

            if( array_key_exists($brandId, self::$cachedBrands) ) {
                return self::$cachedBrands[$brandId];
            }

            return self::$cachedBrands[$brandId] = $this->log->brand;
        }
    }

}