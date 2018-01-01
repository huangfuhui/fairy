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
     * @param string $key
     * @param mixed  $data
     */
    public function addData($key, $data)
    {
        isset($data) ? $this->viewData[$key] = $data : null;
    }

    /**
     * 设置分页数据
     *
     * @param array $data
     */
    public function setPage($data)
    {
        isset($data) ? $this->viewData['page_data'] = $data : null;
    }

    /**
     * 获取指定键的视图数据
     *
     * @param string $key
     * @param string $default
     *
     * @return mixed
     */
    public function getData($key, $default = '')
    {
        if (isset($this->viewData[$key])) {
            return $this->viewData[$key];
        } else {
            return $default;
        }
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