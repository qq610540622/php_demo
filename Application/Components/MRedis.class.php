<?php

namespace Components;

class MRedis {

    public $redis;
    public function __construct($options = array(), $pcconnect = false) {
        $config = array_merge(array(
            'host' => C('REDIS_HOST') ?: '127.0.0.1',
            'port' => C('REDIS_PORT') ?: 6379,
            'timeout' => C('DATA_CACHE_TIMEOUT') ?: false,
            'auth' => C('REDIS_AUTH') ?: "",
            'persistent' => false,
                ), $options);
        static $_G;
        if ($_G["redisobj"]) {
            $this->redis = $_G["redisobj"];
        } else {
            $this->redis = new \Redis();
            $pcconnect ? $this->redis->pconnect($config["host"], $config["port"]) : $this->redis->connect($config["host"], $config["port"]);

            if ($config["auth"] && $this->redis->auth($config["auth"]) === false) {
                E("认证失败");
            };
            $_G["redisobj"] = $this->redis;
        }
    }

    public function set($key, $value, $tablename = false) {
        if ($tablename)
            $this->redis->select($tablename);
        return $this->redis->set($key, serialize($value));
    }

    public function get($key, $tablename = false) {
        if ($tablename)
            $this->redis->select($tablename);
        $rs = $this->redis->get($key);
        return unserialize($this->redis->get($key));
    }

    public function push($value, $queuename = false) {
        $this->redis->select(0);
        $rs = $this->redis->lPush($queuename, serialize($value));
        return $rs;
    }

    public function pop($tablename = false) {
        $this->redis->select(0);
        $s = $this->redis->lPop($tablename);
        //echo $s;
        return unserialize($s);
    }

    public function del($key, $tablename = false) {
        if ($tablename)
            $this->redis->select($tablename);
        return $this->redis->del($key);
    }

    public function hGet($hash_name, $id) {
        return $this->redis->hGet($hash_name, $id);
    }

    public function hSet($hash_name, $id, $value) {
        $this->redis->hSet($hash_name, $id, $value);
    }

    public function expire($hash_name, $time) {
        $this->redis->expire($hash_name, $time);
    }

    public function hGetAll($hash_name) {
        $s = $this->redis->hGetAll($hash_name);
        return $s;
    }

    public function hDel($hash_name, $id) {
        return $this->redis->hDel($hash_name, $id);
    }

    public function setex($key, $ttl = 60, $value) {
        $this->redis->select(0);
        return $this->redis->setex($key, $ttl, serialize($value));
    }

    public function select($tablename = false) {
        if ($tablename)
            $this->redis->select($tablename);
    }

    public function close() {
        $this->redis->close();
    }

    public function __destruct() {
        $this->redis->close();
    }

}
