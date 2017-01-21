<?php
class ModelDaoTicket extends ModelDataMongoCollection
{
    const _ID = '_id';

    const TICKET = 'ticket';

    const EXPIRE_LIMIT = 'expireLimit';

    const EXPIRE_TIME = 'expireTime';

    const NONCESTR = 'noncestr';

    const TIMESTAMP = 'timestamp';

    const URL = 'url';

    public function __construct()
    {
        parent::__construct('dbOp', 'op', 'ticket');
    }

    public function getOne()
    {
        $ret = $this->findOne();

        return DbWrapper::transform($ret);
    }

    public function addTicket($ticket, $expireLimit, $expireTime, $noncestr, $timestamp, $url)
    {
        $doc = [
            self::_ID => new MongoId(),
            self::TICKET => $ticket,
            self::EXPIRE_LIMIT => $expireLimit,
            self::EXPIRE_TIME => $expireTime,
            self::NONCESTR => $noncestr,
            self::TIMESTAMP => $timestamp,
            self::URL => $url,
        ];

        $this->add($doc);
    }

    public function updateTicket($id, $ticket, $expireLimit, $expireTime, $noncestr, $timestamp, $url)
    {
        $query = [
            self::_ID => $id instanceof MongoId ? $id : new MongoId($id),
        ];

        $doc = [
            self::TICKET => $ticket,
            self::EXPIRE_LIMIT => $expireLimit,
            self::EXPIRE_TIME => $expireTime,
            self::NONCESTR => $noncestr,
            self::TIMESTAMP => $timestamp,
            self::URL => $url,
        ];

        $this->modify($query, $doc);
    }
}
