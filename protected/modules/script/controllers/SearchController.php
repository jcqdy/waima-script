<?php

class SearchController extends Controller
{
    public function actionIndex()
    {
        $keyword = ParameterValidatorHelper::validateString($_POST, 'keyword');

        $modelLogicSearch = new ModelLogicSearch();
        $ret = $modelLogicSearch->execute($keyword);

        ResponseHelper::outputJsonV2($ret, 'ok', 200);
    }

}
