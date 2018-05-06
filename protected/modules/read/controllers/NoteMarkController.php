<?php

class NoteMarkController extends Controller
{
    public function actionList()
    {
        $sp = ParameterValidatorHelper::validateInteger($_REQUEST, 'sp', 0);
        $num = ParameterValidatorHelper::validateInteger($_REQUEST, 'num', 1, 20, 20);
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'userId');
        $scriptId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'scriptId');

        $modelLogicNoteMarkList = new ModelLogicNoteMarkList();
        $ret = $modelLogicNoteMarkList->execute($userId, $scriptId, $sp, $num);

        ResponseHelper::outputJsonApp($ret, 'ok', 200);
    }

    public function actionDel()
    {
        $noteId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'noteId');
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'userId');
//        $markId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'markId', '');

        $modelLogicDelNoteMark = new ModelLogicDelNoteMark();
        $modelLogicDelNoteMark->execute($noteId, $userId);

        ResponseHelper::outputJsonApp([], 'ok', 200);
    }

    public function actionDetail()
    {
        $noteId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'noteId');

        $modelLogicNoteDetail = new ModelLogicNoteDetail();
        $ret = $modelLogicNoteDetail->execute($noteId);

        ResponseHelper::outputJsonApp($ret, 'ok', 200);
    }

//    public function actionMark()
//    {
//        $markId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'markId');
//
//        $modelLogicNote = new ModelLogicNote();
//        $ret = $modelLogicNote->execute($markId);
//
//        ResponseHelper::outputJsonV2($ret, 'ok', 200);
//    }

    public function actionEditNote()
    {
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'userId');
        $noteId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'noteId');
        $note = ParameterValidatorHelper::validateString($_REQUEST, 'note');

        $modelLogicEditNote = new ModelLogicEditNote();
        $modelLogicEditNote->execute($userId, $noteId, $note);

        ResponseHelper::outputJsonApp([], 'ok', 200);
    }

    public function actionAddNote()
    {
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'userId');
        $note = ParameterValidatorHelper::validateString($_REQUEST, 'note');
        $scriptId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'scriptId');
//        $mark = ParameterValidatorHelper::validateArray($_REQUEST, 'mark');
        $mark = $_REQUEST['mark'];
        $markId = ParameterValidatorHelper::validateArray($_REQUEST, 'markId');
//        $markPos = ParameterValidatorHelper::validateArray($_REQUEST, 'markPos');

//        $mark = @json_decode($mark, true);
//        if (! is_array($mark))
//            throw new Exception('mark is wrong', Errno::INVALID_PARAMETER);

        $modelLogicAddNote = new ModelLogicAddNote();
        $ret = $modelLogicAddNote->execute($userId, $note, $scriptId, $mark, $markId);

        ResponseHelper::outputJsonApp($ret, 'ok', 200);
    }

    public function actionScriptList()
    {
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'userId');

        $modelLogicNoteScriptList = new ModelLogicNoteScriptList();
        $ret = $modelLogicNoteScriptList->execute($userId);

        ResponseHelper::outputJsonApp($ret, 'ok', 200);
    }

//    public function actionAddMark()
//    {
//        $userId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'userId');
//        $scriptId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'scriptId');
//        $mark = ParameterValidatorHelper::validateString($_REQUEST, 'mark');
//
//        $modelLogicAddNote = new ModelLogicAddMark();
//        $ret = $modelLogicAddNote->execute($userId, $scriptId, $mark);
//
//        ResponseHelper::outputJsonV2($ret, 'ok', 200);
//    }
}
