<?php

class StoreHomeEntity
{
    public $banner = [];

    public $scriptType = [];

    public $hotScript = [];

    public $newScript = [];

    public function __construct($banners, $types, $hotScript, $newScript)
    {
        $urlPrefix = Yii::app()->params['qiniu_prefix'];
        foreach ($banners as $banner) {
            $bannerEtag = isset($banner['resourceUrl']) ? $banner['resourceUrl'] :'';
            $this->banner[] = [
                'resourceUrl' => $urlPrefix . $bannerEtag,
                'gotoUrl' => isset($banner['gotoUrl']) ? $banner['gotoUrl'] :'',
                'sort' => isset($banner['sort']) ? $banner['sort'] :'',
                'type' => isset($banner['type']) ? $banner['type'] :'',
            ];
        }

        foreach ($types as $type) {
            $bannerEtag = isset($banner['coverUrl']) ? $banner['coverUrl'] :'';
            $this->scriptType[] = [
                'typeId' => isset($type['_id']) ? $type['_id'] : '',
                'typeName' => isset($type['name']) ? $type['name'] : '',
                'typeEname' => isset($type['eName']) ? $type['eName'] : '',
                'coverUrl' => $urlPrefix . $bannerEtag,
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
