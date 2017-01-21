<?php
class ModelDaoTicket extends ModelDataMongoCollection
{
    const _ID = '_id';

    const TICKET = 'ticket';

    const EXPIRE_LIMIT = 'expireLimit';

    const EXPIRE_TIME = 'expireTime';

    public function __construct()
    {
        parent::__construct('dbOp', 'op', 'ticket');
    }

    public function getOne()
    {
        $ret = $this->findOne();

        return DbWrapper::transform($ret);
    }

    public function addTicket($ticket, $expireLimit, $expireTime)
    {
        $doc = [
            self::_ID => new MongoId(),
            self::TICKET => $ticket,
            self::EXPIRE_LIMIT => $expireLimit,
            self::EXPIRE_TIME => $expireTime,
        ];

        $this->add($doc);
    }

    public function updateTicket($id, $ticket, $expireLimit, $expireTime)
    {
        $query = [
            self::_ID => $id instanceof MongoId ? $id : new MongoId($id),
        ];

        $doc = [
            self::TICKET => $ticket,
            self::EXPIRE_LIMIT => $expireLimit,
            self::EXPIRE_TIME => $expireTime,
        ];

        $this->modify($query, $doc);
    }
}
