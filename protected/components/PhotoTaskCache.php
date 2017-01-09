<?php
/**
 *
 * @author zhanglu
 *
 */
class PhotoTaskCache
{
    const MODE_CLUSTER = 'cluster'; //主从部署
    const MODE_SINGLE = 'single';   //一致性hash
    const WRITE = 'write';
    const READ = 'read';

    protected $componentId = null;
    protected $mode = self::MODE_SINGLE;
    protected $exception;

    protected static $readOperation = array(
        // Strings
        'GET', 'MGET', 'BITCOUNT', 'STRLEN', 'GETBIT', 'GETRANGE',
        // Keys
        'KEYS', 'TYPE', 'SCAN', 'EXISTS', 'PTTL', 'TTL',
        // Hashes
        'HEXISTS', 'HGETALL', 'HKEYS', 'HLEN', 'HGET', 'HMGET',
        // Set
        'SISMEMBER', 'SMEMBERS', 'SRANDMEMBER', 'SSCAN', 'SCARD', 'SDIFF', 'SINTER',
        // List
        'LINDEX', 'LLEN', 'LRANGE',
        // Sorted Set
        'ZCARD', 'ZCOUNT', 'ZRANGE', 'ZRANGEBYSCORE', 'ZRANK', 'ZREVRANGE', 'ZREVRANGEBYSCORE',
        'ZREVRANK', 'ZSCAN', 'ZSCORE',
    );

    /**
     * 这些方法的第二个参数应当是数组
     *
     * @example sadd($key, array($member1, $member2, ...))
     * @var array
     */
    protected static $unshiftFns = array(
        // Set
        'SREM', 'SADD',

        // Sorted Set
        'ZADD', 'ZREM',

        // Hashes
        'HDEL',

        // List
        'LPUSH', 'RPUSH',
    );

    /**
     * 这个方法的第二个参数应该是关联数组
     *
     * @example zadd($key, array($member1 => $score1, $member2 => $score2, ...))
     */
    const ARR_ARGV_FUNC = 'ZADD';

    /**
     * 构造函数
     *
     * PhotoTaskCache constructor.
     * @param string $componentId componentId
     * @param string $mode redis集群类型
     * @param bool $exception 操作redis错误时是否抛异常
     */
    public function __construct($componentId, $mode = self::MODE_SINGLE, $exception = false)
    {
        $this->componentId = $componentId;
        $this->mode = $mode;
        $this->exception = $exception;
    }

    public function setProperty($name, $value)
    {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        } else {
            throw new Exception('property : ' . $name . ' not exists', Errno::INTERNAL_SERVER_ERROR);
        }
    }

    public function __call($method, $arguments)
    {
        $methUpper = strtoupper($method);
        $componentId = $this->componentId;
        if ($this->mode === self::MODE_CLUSTER) {
            $componentId .= '.' . (in_array($methUpper, self::$readOperation) ? self::READ : self::WRITE);
        }
        $cache = Yii::app()->getComponent($componentId);
        $ret = false;
        try {
            //对可以批量处理多个member数据的方法做处理，比如: sadd($key, $value1, $value2 = null, $valueN = null)
            if (in_array($methUpper, self::$unshiftFns)) {
                //对zadd做特殊处理，因为原生zadd的参数结构如：zAdd($key, $score1, $value1, $score2 = null, $value2 = null, $scoreN = null, $valueN = null)
                if ($methUpper === self::ARR_ARGV_FUNC) {
                    $argv = array();
                    foreach ($arguments[1] as $mem => $score) {
                        $argv[] = $score;
                        $argv[] = $mem;
                    }
                    $arguments[1] = $argv;
                }
                array_unshift($arguments[1], $arguments[0]);
                $arguments = $arguments[1];
            }
            $ret = call_user_func_array(array($cache, $method), $arguments);
        } catch (Exception $e) {
            if ($this->exception === false) {
                LogHelper::warning($method.' operation failed :: ' . $e->getMessage());
            } else {
                throw $e;
            }
        }
        return $ret;
    }
}
