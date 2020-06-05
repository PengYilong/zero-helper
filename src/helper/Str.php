<?php
namespace zero\helper;

class Str
{

    /**
     * 字符串命令风格转换
     *
     * @param string $name
     * @param boolean $type
     * @param boolean $ucfirst
     * @return void
     */
    public static function parseName(string $name, bool $type = false, bool $ucfirst = true) : string
    {
        if( $type ){
            //下换线转成骆驼型
            $name = preg_replace_callback('/_([a-zA-Z])/', function ($match) {
                p($match);
                return strtoupper($match[1]);
            }, $name);
            return $ucfirst ? ucfirst($name) : lcfirst($name);
        }
        //大小写转换成下划线类型 NewsData to news_data
        return strtolower( trim( preg_replace('/[A-Z]/', '_\\0', $name), '_') );
    }
    
    /**
     * 下换线转成骆驼型
     *
     * @param string $name
     * @param boolean $uppercase 首字母是否大小写
     * @return string
     */
    public static function camel(string $name, bool $uppercase = false) : string
    {
        $name = ucwords( str_replace(['-', '_'], ' ', $name) );
        return $uppercase ? ucfirst($name) : lcfirst($name);
    }

    /**
     * 骆驼型转换成下划线型
     *
     * @param string $name
     * @return string
     */
    public static function snake(string $name, string $delimeter = '_') : string
    {
        return strtolower( trim( preg_replace('/[A-Z]/', '_\\0', $name), $delimeter) );
    }
}