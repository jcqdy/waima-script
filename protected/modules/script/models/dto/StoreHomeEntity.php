<?php

class StoreHomeEntity
{
    public $banner = [];

    public $scriptType = [];

    public $hotScript = [];

    public $newScript = [];

    public function __construct($banners, $types, $hotScript, $newScript)
    {
        foreach ($banners as $banner) {
            $this->banner[] = [
                'resourceUrl' => isset($banner['resourceUrl']) ? $banner['resourceUrl'] :'',
                'gotoUrl' => isset($banner['gotoUrl']) ? $banner['gotoUrl'] :'',
                'sort' => isset($banner['sort']) ? $banner['sort'] :'',
                'type' => isset($banner['type']) ? $banner['type'] :'',
            ];
        }

        foreach ($types as $type) {
            $this->scriptType[] = [
                'typeId' => isset($type['_id']) ? $type['_id'] : '',
                'typeName' => isset($type['name']) ? $type['name'] : '',
                'typeEname' => isset($type['eName']) ? $type['eName'] : '',
                'coverUrl' => isset($type['coverUrl']) ? $type['coverUrl'] : '',
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
