<?php
/**
 * @FileName ViewData.php
 *
 * @Author: huangfuhui
 * @Date: 2017/12/12 下午6:10
 * @Email: huangfuhui@meimeifa.com
 */

namespace App\Traits;

trait ViewData
{
    /**
     * 视图数据
     *
     * @var array
     */
    private $viewData = [];

    /**
     * 添加视图数据
     *
     * @param $data
     */
    public function addData($data)
    {

    }

    /**
     * 获取指定键的视图数据
     *
     * @param string $key
     * @param string $default
     */
    public function getData($key, $default = '')
    {

    }

    /**
     * 返回所有的视图数据
     *
     * @return array
     */
    public function viewData()
    {
        return $this->viewData;
    }
}