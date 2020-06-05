<?php

/**
 * common functions
 *
 */

if (!function_exists('p')) {
    /**
     * print_r instead
     *
     */
    function p($var, $echo = true)
    {
        $pre = '<pre style="position:relative;z-index:1000;padding:10px;border-radius:5px;background:#f5f5f5;border:1px solid #aaa;font-size:14px;line-height:18px;opacity:0.9;">';
        ob_start();
        var_dump($var);

        $output = ob_get_clean();
        $output = htmlspecialchars($output);
        $output = $pre . $output . '</pre>';
        if ($echo) {
            echo($output);
            return;
        }
        return $output;
    }
}

if (!function_exists('msg')) {
    /**
     * APP return
     *
     *
     * @param string $msg
     * @param bool $success
     * @param mixed $data
     *
     * @return array
     */
    function msg($msg = 'failed', $status = 0, $data = FALSE)
    {
        return [
            'message' => $msg,
            'status' => $status,
            'data' => $data,
        ];
    }
}

if (!function_exists('new_addslashes')) {
    /**
     * return to be handle  each elements of array  via  addslashes function
     * @param sring or array $params
     * @return  sring or array
     */
    function new_addslashes($params)
    {
        if (!is_array($params)) {
            return addslashes($params);
        }
        if (empty($params)) {
            return FALSE;
        }
        foreach ($params as $key => $value) {
            $params[$key] = new_addslashes($value);
        }
        return $params;
    }
}

if (!function_exists('go_url')) {
    /**
     * @param $url
     * @return string
     */
    function go_url($url)
    {
        return '<script type="text/javascript">location.href="' . $url . '"</script>';
    }
}

if (!function_exists('to_underscore')) {
    /**
     *  AdminMember to admin_member
     *
     */
    function to_underscore($str)
    {
        $dstr = preg_replace_callback('/([A-Z]{1})/', function ($matchs) {
            return '_' . strtolower($matchs[0]);
        }, $str);
        return ltrim($dstr, '_');
    }
}

if (!function_exists('array_insert')) {
    /**
     * @param array $array
     * @param int   $position position of to insert array, start position is 1
     * @param to    insert array
     */
    function array_insert(array $array, int $position, array $insert_array)
    {
        $first_array = array_splice($array, 0, $position);
        return array_merge($first_array, $insert_array, $array);
    }
}

if (!function_exists('array_to_select')) {
    /**
     * array to select
     * @param array $arr
     * @param string $default
     * @param string $field
     * @return bool|string
     */
    function array_to_select($arr = [], $default = '', $field = '')
    {
        if (empty($arr)) {
            return false;
        }
        $options = '';
        foreach ($arr as $key => $value) {
            $selected = $default == $key ? 'selected' : '';
            if ($field) {
                $options .= '<option value="' . $key . '"  ' . $selected . '>' . $value[$field] . '</option>';
            } else {
                $options .= '<option value="' . $key . '"  ' . $selected . '>' . $value . '</option>';
            }
        }
        return $options;
    }
}

if (!function_exists('array_no_repeat_merge'))
{
    /**
     * 索引数组合并，没有重复值
     * @param $array
     * @return array
     *
     */
    function array_no_repeat_merge($array){
        $result = [];
        if( !empty($array) ){
            foreach ($array as $key=>$value) {
                $result = array_merge($result, $value);
            }
            $result = array_unique($result);
        }
        return $result;
    }
}

if (!function_exists('in_multi_array'))
{
    /**
     * 获取所有数组里面都有的值
     * @param $array
     * @return array
     *
     */
    function in_multi_array($array) {
        $result = [];
        $merge_array = arrayNoRepeatMerge($array);
        if( !empty($merge_array) ){
            foreach ($merge_array as $key=>$value){
                $exist = true;
                foreach($array as $k=>$v){
                    if( !in_array($value, $v) ){
                        $exist = false;
                        break;
                    }
                }
                if($exist){
                    $result[] = $value;
                }
            }
        }
        return $result;
    }
}

if (!function_exists('format_price'))
{
    /**
     * format price
     * @param $array
     * @return array
     *
     */
    function format_price($price) {
        $result = '0.00';
        if( empty($price) ){
            return $result;
        }
        $result = number_format($price, 2);
        return $result;
    }
}

if (!function_exists('copy_dir')){
    function copy_dir($src, $dst) {  
        $dir = opendir($src);
        if( !is_dir($dst) ){
            mkdir($dst);
        }
        while(false !== ( $file = readdir($dir)) ) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if ( is_dir($src . '/' . $file) ) {
                    copy_dir($src . '/' . $file,$dst . '/' . $file);
                    continue;
                } else {
                    copy($src . '/' . $file,$dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }
}