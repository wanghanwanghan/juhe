<?php

namespace Wanghan\Juhe;

use Wanghan\Juhe\Exceptions\ExceptionBase;
use Wanghan\Juhe\Exceptions\HttpException;
use Wanghan\Juhe\Exceptions\InvalidArgumentException;

class Phone
{
    //聚合查询key
    protected $key = 'e12158fa89c0f7a14b363d8cde0ad6c6';

    //'http://apis.juhe.cn/ip/ip2addr?ip='.$ip.'&dtype=json&key=ffb7c65113fddc659264139050eaccf2'
    protected $url = 'http://apis.juhe.cn/mobile/get';

    public function selectPhone($phoneNum, $dataType = 'json')
    {
        //判断参数
        if (!\is_numeric($phoneNum))
        {
            throw new InvalidArgumentException('number input');
        }

        if (!\in_array(\strtolower($dataType),['json','xml']))
        {
            throw new InvalidArgumentException('json or xml input');
        }

        $url = "$this->url?phone={$phoneNum}&dtype={$dataType}&key={$this->key}";

        try
        {
            $response = \file_get_contents($url);

            return 'json' === \strtolower($dataType) ? \json_decode($response, true) : $response;

        }catch (ExceptionBase $e)
        {
            throw new HttpException($e->getMessage(),$e->getCode(),$e);
        }
    }
}
