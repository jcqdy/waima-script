<?php

class CollectListEntity
{
    public $package;

    public $note = [];

    public function __construct($package, $scripts, $collects)
    {
        $prefix = Yii::app()->params['qiniu_prefix'];
        $this->package = new PartPkgEntity($package);
        foreach ($collects as $collect) {
            $item = new NoteMarkEntity($collect);
            $item->scriptName = isset($scripts[$collect['scriptId']]) ? $scripts[$collect['scriptId']]['name'] : '';
            $coverUrl =  isset($scripts[$collect['scriptId']]) ? $scripts[$collect['scriptId']]['coverUrl'] : '';
            $item->coverUrl = $prefix . $coverUrl;
            $item->writer = isset($scripts[$collect['scriptId']]) ? $scripts[$collect['scriptId']]['writer'] : [];
            $this->note[] = $item;
        }
    }
}
