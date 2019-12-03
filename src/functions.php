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
    function p($var)
    {
        $pre = '<pre style="position:relative;z-index:1000;padding:10px;border-radius:5px;background:#f5f5f5;border:1px solid #aaa;font-size:14px;line-height:18px;opacity:0.9;">';
        if (is_bool($var)) {
            var_dump($var);
        } elseif (is_null($var)) {
            var_dump(NULL);
        } elseif (is_object($var)){
            echo $pre;
            var_dump($var);
            echo '</pre>';
        } else {
            echo $pre. print_r($var, true) . '</pre>';
        }
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

if (!function_exists('search_condition')) {
    /**
     * search condition
     * @param array $data
     * @param array $subject $_GET $_POST
     * @return array
     */
    function search_condition($data = [], $subject = [], $first = true)
    {
        $result = [];
        if (empty($data)) {
            return $result;
        }
        //statement
        $conds = [
            'equal',
            'like',
            'startDate',
            'date',
        ];

        $cond = '';
        $searchArray = [];

        foreach ($conds as $key => $value) {
            if (array_key_exists($value, $data)) {
                foreach ($data[$value] as $k => $v) {
                    if (!empty($subject[$k])) {
                        $link = !$first ? ' AND ' : '';
                        switch ($value) {
                            case 'equal':
                                $cond .= $link . $v . '=' . $subject[$k];
                                $searchArray[$k] = $subject[$k];
                                break;
                            case 'like':
                                $cond .= $link . $k . ' like \'%' . $subject[$k] . '%\'';
                                $searchArray[$k] = $subject[$k];
                                break;
                            case 'date':
                                $cond .= $link . $v['value'] . $v['symbol'] . strtotime($subject[$k]);
                                $searchArray[$k] = $subject[$k];
                                break;
                        }
                        $first = false;
                    }
                }
            }
        }

        //return
        $result['cond'] = $cond;
        $result['searchArray'] = $searchArray;

        return $result;
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
     * @param int $position position of to insert array
     * @param to insert array
     */
    function array_insert($array, $position, $insert_array)
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

