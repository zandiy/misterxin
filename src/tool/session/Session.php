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

abstract class Session implements SessionHandlerInterface, SessionIdInterface {

    /**
     * session过期时间
     * @var int 
     */
    protected $lifetime = 3600;
    protected $sessionName = '';

    /**
     * 打开Session 
     * @access public 
     * @param string $savePath 
     * @param string $sessID
     */
    abstract public function open($savePath, $sessID);

    /**
     * 关闭Session 
     * @access public 
     */
    abstract public function close();

    /**
     * 读取Session 
     * @access public 
     * @param string $sessID 
     */
    abstract public function read($sessID);

    /**
     * 写入Session 
     * @access public 
     * @param string $sessID 
     * @param String $sessData  
     */
    abstract public function write($sessID, $sessData);

    /**
     * 删除Session 
     * @access public 
     * @param string $sessID 
     */
    abstract public function destroy($sessID);

    /**
     * Session 垃圾回收
     * @access public 
     * @param string $sessMaxLifeTime 
     */
    abstract public function gc($sessMaxLifeTime);

    /**
     * 生成 session_id
     */
    public function create_sid() {
        
    }

}
