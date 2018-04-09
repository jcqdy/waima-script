<?php
class ModelLogicStoreHome
{
    protected $modelDataStore;

    public function __construct()
    {
        $this->modelDataStore = new ModelDataStore();
    }

    public function execute()
    {
        $banners = $this->modelDataStore->getBanner();
        $opIds = array_keys($banners);
        $actives = $this->modelDataStore->queryByOpIds($opIds, 1);
        $datas = [];
        foreach ($actives as $act) {
            if ($act['type'] == 2) {
                $script = $this->modelDataStore->findScript($act['data']);
                if (empty($script))
                    continue;

                $datas[$act['opId']] = new ScriptEntity($script);
            } elseif ($act['type'] == 3) {
                $datas[$act['opId']] = $act['data'];
            } else {
                $datas[$act['opId']] = [];
            }
        }

        $types = $this->modelDataStore->queryAll();

        $hotScript = $this->modelDataStore->getHotScripts(CommonConst::STORE_HOT_SCRIPT_NUM);
        $newScript = $this->modelDataStore->getNewScripts(CommonConst::STORE_NEW_SCRIPT_NUM);

        return new StoreHomeEntity($banners, $types, $hotScript, $newScript, $datas);
    }
}
