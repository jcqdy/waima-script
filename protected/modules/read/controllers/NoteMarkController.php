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

        ResponseHelper::outputJsonV2($ret, 'ok', 200);
    }

    public function actionDel()
    {
        $noteId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'noteId');
//        $markId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'markId', '');

        $modelLogicDelNoteMark = new ModelLogicDelNoteMark();
        $modelLogicDelNoteMark->execute($noteId);

        ResponseHelper::outputJsonV2([], 'ok', 200);
    }

    public function actionDetail()
    {
        $noteId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'noteId');

        $modelLogicNoteDetail = new ModelLogicNoteDetail();
        $ret = $modelLogicNoteDetail->execute($noteId);

        ResponseHelper::outputJsonV2($ret, 'ok', 200);
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

        ResponseHelper::outputJsonV2([], 'ok', 200);
    }

    public function actionAddNote()
    {
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'userId');
        $note = ParameterValidatorHelper::validateString($_REQUEST, 'note');
        $scriptId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'scriptId');
//        $mark = ParameterValidatorHelper::validateArray($_REQUEST, 'mark');
        $mark = ParameterValidatorHelper::validateJson($_REQUEST, 'mark');
        $markId = ParameterValidatorHelper::validateArray($_REQUEST, 'markId');
//        $markPos = ParameterValidatorHelper::validateArray($_REQUEST, 'markPos');

        $modelLogicAddNote = new ModelLogicAddNote();
        $ret = $modelLogicAddNote->execute($userId, $note, $scriptId, $mark, $markId);

        ResponseHelper::outputJsonV2($ret, 'ok', 200);
    }

    public function actionScriptList()
    {
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'userId');

        $modelLogicNoteScriptList = new ModelLogicNoteScriptList();
        $ret = $modelLogicNoteScriptList->execute($userId);

        ResponseHelper::outputJsonV2($ret, 'ok', 200);
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
