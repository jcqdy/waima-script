<?php
/**
 * Factory class file
 *
 * @author zhanglu@camera360.com
 * @date 2014/04/18
 *
 */
class Factory
{
    private static $fakeObj = array();
    
    public static function create($className, $arrClsArgs = array()) 
    {
        if (defined('TEST') && !empty(self::$fakeObj[$className])) {
            return array_shift(self::$fakeObj[$className]);
        }
        // 根据$className创建不同类型的对象
        if (!class_exists($className)) {
            return null;
        }
        $objRfc = new ReflectionClass($className); 

        if (empty($arrClsArgs)) {
            $obj = $objRfc->newInstance();
        } else {
            $obj = $objRfc->newInstanceArgs($arrClsArgs);
        }

        if (false === $obj) {//create class err
            return null;
        }
        return $obj;        
    }
    
    public static function set($className, $fakeObj)
    {
        self::$fakeObj[$className][] = $fakeObj;
    }
    
    public static function clear($className)
    {
        self::$fakeObj[$className] = null;
    }
}
