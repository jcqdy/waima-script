<?php

class TaskParameterValidatorHelper
{
    public static function validateTaskInfo($mixed, $porp)
    {
        if (!isset($mixed[$porp])) {
            throw new TaskException(TaskErrno::TASKINFO_PARAM_ERROR);
        }
        $taskInfo = json_decode($mixed[$porp], true);
        if (json_last_error() != JSON_ERROR_NONE) {
            throw new TaskException(TaskErrno::JSON_ERROR);
        }
        if (empty($taskInfo)) {
            throw new TaskException(TaskErrno::TASKINFO_PARAM_ERROR);
        }
        $data = array();
        foreach ($taskInfo as $lang => $info) {
            $row = array();
            $row['taskName'] = ParameterValidatorHelper::validateString($info, 'taskName');
            $row['cover'] = ParameterValidatorHelper::validateString($info, 'cover');
            $row['desc'] = ParameterValidatorHelper::validateString($info, 'desc');
            $row['shortDesc'] = ParameterValidatorHelper::validateString($info, 'shortDesc');
            if (!is_array($info['award'])) {
                throw new TaskException(TaskErrno::TASKINFO_PARAM_ERROR);
            }
            $row['award']['awardTitle'] = ParameterValidatorHelper::validateString($info['award'], 'awardTitle');
            $row['award']['awardDesc'] = ParameterValidatorHelper::validateString($info['award'], 'awardDesc');
            $row['award']['awardshortDesc'] = ParameterValidatorHelper::validateString($info['award'], 'awardshortDesc');
            $row['award']['awardPic'] = ParameterValidatorHelper::validateString($info['award'], 'awardPic');
            $row['award']['awardLink'] = ParameterValidatorHelper::validateString($info['award'], 'awardLink');
            $data[$lang] = $row;
        }
        
        return $data;
    }
    
    public static function validateJson($json)
    {
        $data = json_decode($json, true);
        if (json_last_error() != JSON_ERROR_NONE) {
            throw new TaskException(TaskErrno::JSON_ERROR);
        }
        return $data;
    }
    
    public static function validateFormatDate($date, $min = null, $max = null)
    {
        if (!preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/', $date)) {
            throw new Exception("时间格式错误", 11046);
        }
        $time = strtotime($date);
        if ($min != null && $time < strtotime($min)) {
            throw new Exception("时间格式错误", 11046);
        }
        if ($max != null && $time > strtotime($max)) {
            throw new Exception("时间格式错误", 11046);
        }
        return $time;
    }
    
    public static function compareTime($a, $b)
    {
        if ($a >= $b) {
            throw new Exception("结束时间必须大于开始时间", 11047);
        }
    }
    
    public static function validateLanguageTaskInfo($language, $taskInfo)
    {
        foreach ($language as $row) {
            if (!isset($taskInfo[$row])) {
                throw new TaskException(TaskErrno::TASKINFO_PARAM_ERROR);
            }
        }
    }
    
    /**
     * 获取数组
     * @param array $mixed
     * @param string $porp
     */
    public static function getArray($mixed, $porp, $default = array())
    {
        if (!is_array($mixed)) {
            return $default;
        }
        if (!isset($mixed[$porp])) {
            return $default;
        }
        if (!is_array($mixed[$porp])) {
            return $default;
        }
        return $mixed[$porp];
    }
    
    
    /**
     * 获取语言
     */
    public static function getLanguage($mixed, $porp)
    {
        $lang = '';
        if (isset($mixed[$porp])) {
            $lang = trim(strtolower($mixed[$porp]));
        }
        if (in_array($lang, array('zh-hans', 'zh-cn', 'zh_hans', 'zh_cn', 'zh_hans_cn', 'zh-hans-cn', 'zh-hans_cn'))) {
            $lang = 'zh_cn';
        } else {
            $lang = substr($lang, 0, 2);
            switch ($lang) {
                case 'zh':
                    $lang = 'zh_cn';//zh_tw 繁体显示简体
                    break;
                case 'en':
                    $lang = 'en_us';
                    break;
                case 'th':
                    $lang = 'th_th';
                    break;
                case 'ja':
                    $lang = 'ja_jp';
                    break;
                default:
                    $lang = 'en_us';
                    break;
            }
        }
        return $lang;
    }
}
