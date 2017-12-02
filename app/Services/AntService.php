<?php
/**
 * @FileName AntService.php
 *
 * @Author: huangfuhui
 * @Date: 2017/12/2 下午2:28
 * @Email: huangfuhui@meimeifa.com
 */

namespace App\Services;

use GuzzleHttp\Client;

class AntService
{
    private $client = null;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}