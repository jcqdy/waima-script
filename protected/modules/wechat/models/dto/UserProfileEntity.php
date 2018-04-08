<?php

class UserProfileEntity
{
    public $userInfo;

    public $record;

    public function __construct($user)
    {
        $this->userInfo = new UserEntity($user);
        $this->record = [
            'readNum' => [
                'readNum' => isset($user['readNum']) ? (int)$user['readNum'] : 1,
                'achText' => Yii::t('userModule.text', 'readNumAchText',
                    ['{readNumRatio}' => $user['readNumRatio'] * 100], null, 'zh_cn'),
            ],
            'readDays' => [
                'readNum' => isset($user['readDays']) ? (int)$user['readDays'] : 1,
                'achText' => Yii::t('userModule.text', 'readDayAchText',
                    ['{readDayRatio}' => $user['readDayRatio'] * 100], null, 'zh_cn'),
            ],
            'keepReadDays' => [
                'readNum' => isset($user['readDays']) ? (int)$user['readDays'] : 1,
                'achText' => '',
            ],
        ];
    }
}
