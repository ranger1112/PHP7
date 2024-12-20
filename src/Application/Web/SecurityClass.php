<?php

namespace Application\Web;

class SecurityClass
{
    public function __construct()
    {
        $this->filter = [
            'striptags' => function ($a) {
                return strip_tags($a);
            },
            'digits' => function ($a) {
                return preg_replace('/[^0-9]/', '', $a);
            },
            'alpha' => function ($a) {
                return preg_replace('/[^a-zA-Z]/i', '', $a);
            },
        ];
        $this->validate = [
            'alnum' => function ($a) {
                // ctype_alnum() 函数检测字符串中是否全部由字母和数字组成
                return ctype_alnum($a);
            },
            'digits' => function ($a) {
                // ctype_digit() 函数检测字符串中是否全部由数字组成
                return ctype_digit($a);
            },
            'alpha' => function ($a) {
                // ctype_alpha() 函数检测字符串中是否全部由字母组成
                return ctype_alpha($a);
            },
        ];
    }

    /**
     * 我们这里将使用 __call() 来实现过滤器和验证器的函数调用
     * @param $name
     * @param $arguments
     * @return null
     */
    public function __call($name, $arguments)
    {
        preg_match('/^(filter|validate)(.*)$/i', $name, $matches);
        $prefix = $matches[1] ?? '';
        $function = strtolower($matches[2] ?? '');
        if ($prefix && $function) {
            return $this->$prefix[$function]($arguments[0]);
        }

        return NULL;
    }


}