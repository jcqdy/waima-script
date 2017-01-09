<?php
class CommonException extends ErrorException
{

    public function __construct($code = null)
    {
        MessageHelper::setStatus($code);
        parent::__construct(MessageHelper::getMessage(), $code);
    }
}
