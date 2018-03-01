<?php
class BookCaseScriptEntity
{
    public $isFolder;

    public $folderName;

    public $folderId;

    public $data;

    public function __construct($isFolder, $scripts, $folderName = '', $folderId = '')
    {
        if ($isFolder === 1) {
            $this->folderId = $folderId;
            $this->folderName = $folderName;
            $this->isFolder = 1;

            foreach ($scripts as $script) {
                $this->data[] = new ScriptEntity($script);
            }
        } else {
            $this->isFolder = 0;
            unset($this->folderName, $this->folderId);
            foreach ($scripts as $script) {
                $this->data = new ScriptEntity($script);
            }
        }
    }
}
