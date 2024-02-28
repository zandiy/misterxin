<?php

/**
 * mister.xin PHP-CLASS
 *
 * @author      mister.xin <29502954@qq.com>
 * @copyright   (c) http://mister.xin All rights reserved.
 * @link        https://github.com/zandiy/misterxin
 * @license     https://www.apache.org/licenses/LICENSE-2.0
 * @date        2024-2-28
 */

namespace misterxin\tool\session;

use misterxin\tool\Json;

class Redis extends Session {

    protected $host;
    protected $port;
    protected $timeout;

    /**
     * Redis 实例
     * @var \Redis
     */
    protected $handle = null;

    public function __construct($config = []) {
        $this->sessionName = isset($config['sessionName']) ? $config['sessionName'] : '';
        $this->host = isset($config['host']) ? $config['host'] : '127.0.0.1';
        $this->port = isset($config['port']) ? $config['port'] : 6379;
        $this->timeout = isset($config['timeout']) ? $config['timeout'] : 1;
        $this->lifetime = isset($config['lifetime']) ? : $this->lifetime;
    }

    public function close() {
        $this->gc(ini_get('session.gc_maxlifetime'));
        $this->handle->close();
        $this->handle = null;
        return true;
    }

    public function destroy($sessID) {
        return $this->handle->delete($this->sessionName . $sessID);
    }

    public function gc($sessMaxLifeTime) {
        return true;
    }

    public function open($savePath, $sessID) {
        $this->handle = new \Redis;
        return $this->handle->connect($this->host, $this->port, $this->timeout);
    }

    public function read($sessID) {
        $sessData = $this->handle->get($this->sessionName . $sessID);
        return Json::decode($sessData);
    }

    public function write($sessID, $sessData) {
        $status = $this->handle->set($this->sessionName . $sessID, Json::encode($sessData));
        $this->handle->expire($this->sessionName . $sessID, $this->lifetime);
        return $status;
    }

}
