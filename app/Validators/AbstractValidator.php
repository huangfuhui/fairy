<?php
/**
 * @FileName AbstractValidator.php
 *
 * @Author: huangfuhui
 * @Date: 2017/12/13 下午5:18
 * @Email: huangfuhui@meimeifa.com
 */

namespace App\Validators;

use Validator;

abstract class AbstractValidator
{
    /**
     * rules.
     *
     * @var array
     */
    protected $rules = [];

    /**
     * messages.
     *
     * @var array
     */
    protected $messages = [];

    /**
     * attributes.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * get rules by scenario.
     *
     * @param $scenario
     *
     * @return array
     */
    public function rules($scenario)
    {
        return $this->rules[$scenario] ?: [];
    }

    /**
     * get messages.
     *
     * @return array
     */
    public function messages()
    {
        return $this->messages;
    }

    /**
     * get attributes.
     *
     * @return array
     */
    public function attributes()
    {
        return $this->attributes;
    }

    /**
     * validate by $scenario.
     *
     * @param   $scenario
     * @param   $data
     */
    public static function validate($scenario, $data = [])
    {
        self::scenario($scenario, $data)->validate();
    }

    /**
     * create validator by $scenario.
     *
     * @param   $scenario
     * @param   $data
     *
     * @return \Illuminate\Validation\Validator
     */
    public static function scenario($scenario, $data = [])
    {
        $default_data = app('request')->all();
        $params       = empty($data) ? $default_data : array_merge($default_data, $data);
        $instance     = new static();

        return Validator::make(
            $params,
            $instance->rules($scenario),
            $instance->messages(),
            $instance->attributes()
        );
    }
}