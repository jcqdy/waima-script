<?php

class CollectListEntity
{
    public $package;

    public $note = [];

    public function __construct($package, $scripts, $collects)
    {
        $this->package = new PartPkgEntity($package);
        foreach ($collects as $collect) {
            $item = new NoteMarkEntity($collect);
            $item->scriptName = isset($scripts[$collect['scriptId']]) ? $scripts[$collect['scriptId']]['scriptName'] : '';
            $this->note[] = $item;
        }
    }
}
