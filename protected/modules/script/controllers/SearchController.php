<?php

class SearchController extends Controller
{
    public function actionIndex()
    {
        $keyword = ParameterValidatorHelper::validateArray($_POST, 'keyword', ' ');

        $modelLogicSearch = new ModelLogicSearch();
        $ret = $modelLogicSearch->execute($keyword);

        ResponseHelper::outputJsonV2($ret, 'ok', 200);
    }

}
