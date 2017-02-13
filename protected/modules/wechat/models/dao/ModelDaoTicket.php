<?php
class ModelDaoTicket extends ModelDataMongoCollection
{
    const _ID = '_id';

    const TICKET = 'ticket';

    const EXPIRE_LIMIT = 'expireLimit';

    const EXPIRE_TIME = 'expireTime';

    const NONCESTR = 'noncestr';

    const TIMESTAMP = 'timestamp';

    const SIGNATURE = 'signature';

    const URL = 'url';

    public function __construct()
    {
        parent::__construct('dbOp', 'op', 'ticket');
    }

    public function findByUrl($url)
    {
        $query = [
            self::URL => $url,
        ];

        $ret = $this->findOne($query);

        return DbWrapper::transform($ret);
    }

    public function addTicket($ticket, $expireLimit, $expireTime, $noncestr, $timestamp, $url, $signature)
    {
        $doc = [
            self::_ID => new MongoId(),
            self::TICKET => $ticket,
            self::EXPIRE_LIMIT => $expireLimit,
            self::EXPIRE_TIME => $expireTime,
            self::NONCESTR => $noncestr,
            self::TIMESTAMP => $timestamp,
            self::URL => $url,
            self::SIGNATURE => $signature,
        ];

        $this->add($doc);
    }

    public function updateTicket($id, $ticket, $expireLimit, $expireTime, $noncestr, $timestamp, $url, $signature)
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
            self::SIGNATURE => $signature,
        ];

        $this->modify($query, $doc);
    }
}
