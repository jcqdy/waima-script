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
        $types = $this->modelDataStore->queryType();

        $hotScript = $this->modelDataStore->getHotScripts(CommonConst::STORE_HOT_SCRIPT_NUM);
        $newScript = $this->modelDataStore->getNewScripts(CommonConst::STORE_NEW_SCRIPT_NUM);

        return new StoreHomeEntity($banners, $types, $hotScript, $newScript);
    }
}
