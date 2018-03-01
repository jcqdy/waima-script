<?php

class NoteMarkController extends Controller
{
    public function actionList()
    {
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_POST, 'userId');
        $scriptId = ParameterValidatorHelper::validateMongoIdAsString($_POST, 'scriptId');

        $modelLogicNoteMarkList = new ModelLogicNoteMarkList();
        $ret = $modelLogicNoteMarkList->execute($userId, $scriptId);

        ResponseHelper::outputJsonV2($ret, 'ok', 200);
    }

    public function actionDel()
    {
        $noteId = ParameterValidatorHelper::validateMongoIdAsString($_POST, 'noteId', '');
        $markId = ParameterValidatorHelper::validateMongoIdAsString($_POST, 'markId', '');

        $modelLogicDelNoteMark = new ModelLogicDelNoteMark();
        $modelLogicDelNoteMark->execute($noteId, $markId);

        ResponseHelper::outputJsonV2([], 'ok', 200);
    }

    public function actionNote()
    {
        $noteId = ParameterValidatorHelper::validateMongoIdAsString($_POST, 'noteId');

        $modelLogicNote = new ModelLogicNote();
        $ret = $modelLogicNote->execute($noteId);

        ResponseHelper::outputJsonV2($ret, 'ok', 200);
    }

    public function actionMark()
    {
        $markId = ParameterValidatorHelper::validateMongoIdAsString($_POST, 'markId');

        $modelLogicNote = new ModelLogicNote();
        $ret = $modelLogicNote->execute($markId);

        ResponseHelper::outputJsonV2($ret, 'ok', 200);
    }

    public function actionEditNote()
    {
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_POST, 'userId');
        $noteId = ParameterValidatorHelper::validateMongoIdAsString($_POST, 'noteId');
        $note = ParameterValidatorHelper::validateString($_POST, 'note');

        $modelLogicEditNote = new ModelLogicEditNote();
        $modelLogicEditNote->execute($userId, $noteId, $note);

        ResponseHelper::outputJsonV2([], 'ok', 200);
    }

    public function actionAddNote()
    {
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_POST, 'userId');
        $note = ParameterValidatorHelper::validateString($_POST, 'note');
        $scriptId = ParameterValidatorHelper::validateMongoIdAsString($_POST, 'scriptId');
        $mark = ParameterValidatorHelper::validateString($_POST, 'mark');
        
        $modelLogicAddNote = new ModelLogicAddNote();
        $ret = $modelLogicAddNote->execute($userId, $note, $scriptId, $mark);

        ResponseHelper::outputJsonV2($ret, 'ok', 200);
    }

    public function actionAddMark()
    {
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_POST, 'userId');
        $scriptId = ParameterValidatorHelper::validateMongoIdAsString($_POST, 'scriptId');
        $mark = ParameterValidatorHelper::validateString($_POST, 'mark');

        $modelLogicAddNote = new ModelLogicAddMark();
        $ret = $modelLogicAddNote->execute($userId, $scriptId, $mark);

        ResponseHelper::outputJsonV2($ret, 'ok', 200);
    }
}
