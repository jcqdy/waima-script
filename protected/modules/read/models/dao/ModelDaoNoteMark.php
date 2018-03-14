<?php
class ModelDaoNoteMark extends ModelDataMongoCollection
{
    const _ID = '_id';

    const TYPE = 'type';

    const SCRIPT_ID = 'scriptId';

    const USER_ID = 'userId';

    const MARK_POS = 'markPos';

    const MARK = 'mark';

    const NOTE = 'note';

    const CREATE_TIME = 'createTime';

    const DEL_TIME = 'delTime';

    const UPDATE_TIME = 'updateTime';

    const PKG_ID = 'pkgId';

    const STATUS = 'status';

    public function __construct()
    {
        parent::__construct('dbwaima-script', 'waima-script', 'noteMark');
    }

    public function queryByUidSids($userId, $scriptIds, $status = 1)
    {
        $query[self::USER_ID] = $userId instanceof MongoId ? $userId : new MongoId($userId);
        foreach ($scriptIds as $k => $id) {
            $scriptIds[$k] =  $id instanceof MongoId ? $id : new MongoId($id);
        }
        $query[self::SCRIPT_ID] = ['$in' => $scriptIds];
        $query[self::STATUS] = $status;

        $ret = $this->query($query);
        
        return DbWrapper::transform($ret);
    }

    public function queryByUidSid($userId, $scriptId, $status = 1)
    {
        $query[self::USER_ID] = $userId instanceof MongoId ? $userId : new MongoId($userId);
        $query[self::SCRIPT_ID] = $scriptId instanceof MongoId ? $scriptId : new MongoId($scriptId);
        $query[self::STATUS] = $status;

        $ret = $this->query($query);

        return DbWrapper::transform($ret);
    }

    public function delByid($id)
    {
        $query[self::_ID] = $id instanceof MongoId ? $id : new MongoId($id);
        $doc[self::STATUS] = 0;

        return $this->modify($query, $doc);
    }

    public function getNoteMark($noteId, $status = 1)
    {
        $query[self::_ID] = $noteId instanceof MongoId ? $noteId : new MongoId($noteId);
        $query[self::STATUS] = $status;

        $ret = $this->findOne($query);
        return DbWrapper::transform($ret);
    }

    public function editNote($noteId, $note, $updateTime, $status = 1)
    {
        $query[self::_ID] = $noteId instanceof MongoId ? $noteId : new MongoId($noteId);
        $query[self::STATUS] = $status;

        $doc[self::NOTE] = $note;
        $doc[self::UPDATE_TIME] = $updateTime;

        return $this->modify($query, $doc);
    }

    public function addNote($scriptId, $userId, $markPos, $mark, $note, $createTime)
    {
        $doc[self::_ID] = new MongoId();
        $doc[self::TYPE] = 1;
        $doc[self::SCRIPT_ID] = $scriptId instanceof MongoId ? $scriptId : new MongoId($scriptId);
        $doc[self::USER_ID] = $userId instanceof MongoId ? $userId : new MongoId($userId);
        $doc[self::MARK_POS] = $markPos;
        $doc[self::MARK] = $mark;
        $doc[self::NOTE] = $note;
        $doc[self::CREATE_TIME] = $doc[self::UPDATE_TIME] = $createTime;
        $doc[self::PKG_ID] = '';
        $doc[self::STATUS] = 1;

        $ret = $this->add($doc);
        if ($ret !== false)
            return DbWrapper::transform($doc);

        return false;
    }

    public function addMark($scriptId, $userId, $markPos, $mark, $createTime)
    {
        $doc[self::_ID] = new MongoId();
        $doc[self::TYPE] = 2;
        $doc[self::SCRIPT_ID] = $scriptId instanceof MongoId ? $scriptId : new MongoId($scriptId);
        $doc[self::USER_ID] = $userId instanceof MongoId ? $userId : new MongoId($userId);
        $doc[self::MARK_POS] = $markPos;
        $doc[self::MARK] = $mark;
        $doc[self::NOTE] = '';
        $doc[self::CREATE_TIME] = $doc[self::CREATE_TIME] = $createTime;
        $doc[self::PKG_ID] = '';
        $doc[self::STATUS] = 1;

        $ret = $this->add($doc);
        if ($ret !== false)
            return DbWrapper::transform($doc);

        return false;
    }

    public function updatePkgId($noteId, $pkgId, $status = 1)
    {
        $query[self::_ID] = $noteId instanceof MongoId ? $noteId : new MongoId($noteId);
        $query[self::STATUS] = $status;

        if (empty($pkgId))
            $doc[self::PKG_ID] = $pkgId;
        else
            $doc[self::PKG_ID] = $pkgId instanceof MongoId ? $pkgId : new MongoId($pkgId);

        return $this->modify($query, $doc);
    }

    public function queryByPkgId($pkgId, $sp, $num, $status = 1)
    {
        $query[self::PKG_ID] = $pkgId instanceof MongoId ? $pkgId : new MongoId($pkgId);
        $query[self::STATUS] = $status;
        if ($sp != 0)
            $query[self::UPDATE_TIME] = ['$lt' => $sp];

        $sort[self::UPDATE_TIME] = -1;

        $ret = $this->query($query, [], $sort, $num);

        return DbWrapper::transform($ret);
    }

    public function queryByUidSidSortUpTime($userId, $scriptId, $sp, $num, $status = 1)
    {
        $query[self::USER_ID] = $userId instanceof MongoId ? $userId : new MongoId($userId);
        $query[self::SCRIPT_ID] = $scriptId instanceof MongoId ? $scriptId : new MongoId($scriptId);
        $query[self::STATUS] = $status;
        if ($sp != 0)
            $query[self::UPDATE_TIME] = ['$lt' => $sp];

        $sort[self::UPDATE_TIME] = -1;

        $ret = $this->query($query, [], $sort, $num);

        return DbWrapper::transform($ret);
    }
}
