<?php

/**
 *
 * @author liuhongwei
 *
 */
class ControllerParameterValidator
{

    /**
     * @param Array $mixed /mixed $data
     * @param String $porp
     * @param int $default NAN
     * @throws ParameterValidationException
     * @return int
     * 检查是否为空，为空并且设置默认值，则返回默认值
     */
    public static function checkEmpty($mixed, $porp, $default = NAN)
    {
        if (is_array($mixed)) {
            if (isset($mixed[$porp])) {
                $value = $mixed[$porp];
            } elseif (@is_nan($default)) {
                throw new ParameterValidationException("$porp is required!");
            } else {
                return $default;
            }
        } else {
            $value = $mixed;
        }

        //处理空白字符
        if (is_string($value)) {
            $value = trim($value);
        }

        if (! isset($value) || @is_nan($value)) {
            if (@is_nan($default)) {
                throw new ParameterValidationException("$porp can't be empty!");
            } else {
                return $default;
            }
        }

        return $value;
    }

    /**
     * @param Array $mixed /mixed $data
     * @param String $porp
     * @param int $min default null
     * @param int $max default null
     * @param int $default NAN
     * @throws ParameterValidationException
     * @return int
     * 对整形的过滤处理
     */
    public static function validateInteger($mixed, $porp, $min = null, $max = null, $default = NAN)
    {

        $value = self::checkEmpty($mixed, $porp, $default);

        if (! preg_match(self::$numberPattern, "$value")) {
            if (@is_nan($default)) {
                throw new ParameterValidationException("$porp must be an integer.");
            } else {
                return $default;
            }
        }

        $value = intval($value);

        if ($min !== null && $value < $min) {
            if (@is_nan($default)) {
                throw new ParameterValidationException("$porp is too small (minimum is $min)");
            } else {
                return $default;
            }
        }

        if ($max !== null && $value > $max) {
            if (@is_nan($default)) {
                throw new ParameterValidationException("$porp is too big (maximum is $max)");
            } else {
                return $default;
            }
        }

        return $value;
    }

    //这是对整形的正则过滤
    private static $numberPattern = '/^\s*[-+]?[0-9]*\.?[0-9]+([eE][-+]?[0-9]+)?\s*$/';

    /**
     * @param Array $mixed /mixed $data
     * @param String $porp
     * @param float $min
     * @param float $max
     * @param float $default NAN
     * @throws ParameterValidationException
     * @return number
     */
    //进行浮点处理
    public static function validateFloat($mixed, $porp, $min = null, $max = null, $default = NAN)
    {
        $value = self::checkEmpty($mixed, $porp, $default);

        if (! preg_match(self::$numberPattern, "$value")) {
            if (@is_nan($default)) {
                throw new ParameterValidationException("$porp must be an number.");
            } else {
                return $default;
            }
        }

        $value = floatval($value);

        if ($min !== null && $value < $min) {
            throw new ParameterValidationException("$porp is too small (minimum is $min)");
        }

        if ($max !== null && $value > $max) {
            throw new ParameterValidationException("$porp is too big (maximum is $max)");
        }

        return $value;
    }


    /**
     * 注意：字符串特殊处理， 如果设置了默认值且字符串为空， 则返回默认值
     * @param Array $mixed /mixed $data
     * @param String $porp
     * @param int $min
     * @param int $max
     * @param String $default NAN
     * @throws ParameterValidationException
     * @return String
     */
    public static function validateString($mixed, $porp, $min = null, $max = null, $default = NAN)
    {
        $value = self::checkEmpty($mixed, $porp, $default);

        //字符串特殊处理， 如果设置了默认值且字符串为空， 则返回默认值
        if (! @is_nan($default)) {
            if (empty($value)) {
                return $default;
            }
        }
        $length = mb_strlen($value); // 这里不能用strlen，字符串长度跟编码有关
        if ($min !== null && $length < $min) {
            throw new ParameterValidationException("$porp is too short (minimum is $min characters)");
        }

        if ($max !== null && $length > $max) {
            throw new ParameterValidationException("$porp is too long (maximum is $max characters)");
        }

        return $value;

    }

    private static $mongoDatePattern = '/^1[\.\d]{12,}$/';

    /**
     * 1394087667 = 2014-03-06 14:30
     * @param Array $mixed /mixed $data
     * @param String $porp
     * @param Array $validValues
     * @param String $default NAN
     * @throws ParameterValidationException
     * @return MongoDate
     */
    //对时间进行过滤
    public static function validateMongoDate($mixed, $porp, $default = NAN)
    {
        $value = ControllerParameterValidator::validateFloat($mixed, $porp, 0, null, $default);
        if (! $value) {
            if (@is_nan($default)) {
                throw new ParameterValidationException("$porp is invalid");
            } elseif ($default) {
                $value = $default;
            } else {
                return $default;
            }
        }

        $startArr = explode('.', $value);
        $startUsec = 0;
        if (isset($startArr[1])) {
            $usec = $startArr[1];
            $usec = str_pad($usec, 6, '0');
            $startUsec = (substr($usec, 0, 3)) * 1000;
        }
        $startTime = new MongoDate(intval($startArr[0]), $startUsec);
        return $startTime;
    }

    /**
     * @param Array $mixed /mixed $data
     * @param String $porp
     * @param Array $validValues
     * @param String $default NAN
     * @throws ParameterValidationException
     * @return String
     */
    //对枚举型字串进行处理
    public static function validateEnumString($mixed, $porp, $validValues, $default = NAN)
    {
        $value = ControllerParameterValidator::validateString($mixed, $porp, null, null, $default);
        if (@is_nan($default) && ! in_array($value, $validValues)) {
            throw new ParameterValidationException("$porp is not valid!");
        }
        return $value;
    }

    /**
     * @param Array $mixed /mixed $data
     * @param String $porp
     * @param Array $validValues
     * @param String $default NAN
     * @throws ParameterValidationException
     * @return String
     */
    public static function validateEnumInteger($mixed, $porp, $validValues, $default = NAN)
    {
        $value = ControllerParameterValidator::validateInteger($mixed, $porp, null, null, $default);
        if (@is_nan($default) && ! in_array($value, $validValues)) {
            throw new ParameterValidationException("$porp is not valid!");
        }
        return $value;
    }

    private static $mongoIdPattern = '/^[0-9A-Fa-f]{24}$/';
    /**
     * @param Array $mixed /mixed $data
     * @param String $porp
     * @param String $default NAN
     * @throws ParameterValidationException
     * @return String
     */
    //MongId的处理
    public static function validateMongoIdAsString($mixed, $porp, $default = NAN)
    {
        $value = ControllerParameterValidator::validateString($mixed, $porp, 24, 24, $default);
        if ($value instanceof MongoId) {
            return $value->__toString();
        }

        if (@is_nan($default) && ! preg_match(self::$mongoIdPattern, $value)) {
            throw new ParameterValidationException("$porp must be an valid mongoId.");
        }
        return $value;
    }

    private static $etagPattern = '/^[0-9a-zA-Z_\-]+$/';

    /**
     * @param Array $mixed /mixed $data
     * @param String $porp
     * @param String $default NAN
     * @throws ParameterValidationException
     * @return etag
     */
    //这里是处理唯一标识，etag
    public static function validateEtag($mixed, $porp, $default = NAN)
    {
        $value = ControllerParameterValidator::validateString($mixed, $porp, 5, null, $default);
        if (@is_nan($default) && ! preg_match(self::$etagPattern, $value)) {
            throw new ParameterValidationException("$porp must be an valid etag.");
        }
        return $value;
    }

    /**
     * @param Array $mixed /mixed $data
     * @param String $porp
     * @param float $min
     * @param float $max
     * @param String $default NAN
     * @throws ParameterValidationException
     * @return Array
     */
    //将传入的字符串按照指定的方式切割为数组
    public static function validateArray($mixed, $porp, $split = ',', $min = null, $max = null, $default = NAN)
    {

        $value = self::checkEmpty($mixed, $porp, $default);
        if (null == $value) {
            if (@is_nan($default)) {
                return array();
            } else {
                return $default;
            }
        }
        if (! is_array($value)) {
            $value = explode($split, $value);
        }

        $length = count($value);

        if ($min !== null && $length < $min) {
            throw new ParameterValidationException("$porp is too short (minimum is $min elements).");
        }

        if ($max !== null && $length > $max) {
            throw new ParameterValidationException("$porp is too long (maximum is $max elements).");
        }
        return $value;
    }

    /**
     * @param Array $mixed /mixed $data
     * @param String $porp
     * @param String $default NAN
     * @throws ParameterValidationException
     * @return string
     */
    public static function validateUserId($mixed, $porp, $default = NAN)
    {
        $ret = ControllerParameterValidator::validateMongoIdAsString($mixed, $porp, $default);
        return $ret;
    }

    /**
     * 验证公共参数是否正确
     *
     * @param array $aryData
     * @static
     * @access public
     * @return array
     */
    public static function validateCommonParamters($aryData)
    {
        $appName = ControllerParameterValidator::validateString($aryData, 'appName', 1, 50, null);
        if (! $appName) {
            $appName = ControllerParameterValidator::validateString($aryData, 'appname', 1, 50);
        }

        $appVersion = ControllerParameterValidator::validateString($aryData, 'appVersion', 1, 50, null);
        if (! $appVersion) {
            $appVersion = ControllerParameterValidator::validateString($aryData, 'appversion', 1, 50);
        }

        $platform = ControllerParameterValidator::validateString($aryData, 'platform');
        if ($platform == 'iphone') {
            $platform = 'ios';
        }

        return array(
            'appName' => $appName,
            'appVersion' => $appVersion,
            'platform' => $platform,
        );
    }
}
