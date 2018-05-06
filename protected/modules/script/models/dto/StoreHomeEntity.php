<?php

class StoreHomeEntity
{
    public $banner = [];

    public $scriptType = [];

    public $hotScript = [];

    public $newScript = [];

    public function __construct($banners, $types, $hotScript, $newScript, $datas)
    {
        $urlPrefix = Yii::app()->params['qiniu_prefix'];
        foreach ($banners as $banner) {
            $bannerEtag = isset($banner['resourceUrl']) ? $banner['resourceUrl'] :'';
            $this->banner[] = [
                'opId' => isset($banner['_id']) ? (string)$banner['_id'] : '',
                'resourceUrl' => $urlPrefix . $bannerEtag,
                'gotoType' => isset($banner['gotoType']) ? $banner['gotoType'] : 1,
                'sort' => isset($banner['sort']) ? $banner['sort'] :'',
                'type' => isset($banner['type']) ? $banner['type'] :'',
                'data' => isset($datas[$banner['_id']]) ? $datas[$banner['_id']] : '',
            ];
        }

        foreach ($types as $type) {
            $coverEtag = isset($type['coverUrl']) ? $type['coverUrl'] :'';
            $this->scriptType[] = [
                'typeId' => isset($type['_id']) ? $type['_id'] : '',
                'typeName' => isset($type['name']) ? $type['name'] : '',
                'typeEname' => isset($type['eName']) ? $type['eName'] : '',
                'coverUrl' => $urlPrefix . $coverEtag,
            ];
        }

        foreach ($hotScript as $script) {
            $this->hotScript[] = new ScriptEntity($script);
        }

        foreach ($newScript as $script) {
            $this->newScript[] = new ScriptEntity($script);
        }
    }
}
