<?php
/**
 * @FileName AbstractLogic.php
 *
 * @Author: huangfuhui
 * @Date: 2017/12/1 下午7:29
 * @Email: huangfuhui@meimeifa.com
 */

namespace App\Logics;


class AbstractLogic
{
    /**
     * @var array
     */
    protected $attributes = [];

    public function __construct()
    {
        $request = app('request')->all();
        foreach ($request as $key => $value) {
            $this->attributes[$key] = $value;
        }
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function __get($name)
    {
        return isset($this->attributes[$name]) ? $this->attributes[$name] : null;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @param array $attributes
     */
    public function setAttributes(array $attributes = [])
    {
        foreach ($attributes as $key => $value) {
            $this->attributes[$key] = $value;
        }
    }

    /**
     * @param string $errMsg
     */
    public function error(string $errMsg = '')
    {
        abort(404, trim($errMsg));
    }
}