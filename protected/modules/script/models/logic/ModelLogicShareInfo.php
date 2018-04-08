<?php
class ModelLogicShareInfo
{
    public $modelDaoScript;

    public function __construct()
    {
        $this->modelDaoScript = new ModelDaoScript();
    }

    public function execute($scriptId)
    {
        $script = $this->modelDaoScript->findOneScript($scriptId);
        if (empty($script) || ! isset($script['qrcodeUrl']))
            throw new Exception('script is not exists', Errno::INVALID_PARAMETER);

        return [
            'qrcodeUrl' => Yii::app()->params['qiniu_prefix'] . $script['qrcodeUrl']
        ];
    }
}
