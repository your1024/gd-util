<?php
namespace Yhy\GdUtil;

/**
 * 字符串工具
 * Class Str
 *
 * @package Yhy\GdUtil
 */
class Str
{
    /**
     * 生成文件名
     * @param ...$options
     *
     * @return string
     */
    public static function getFileName(...$options): string
    {
        return implode('-',$options);
    }

    /**
     * 获取文件扩展名
     * @param  string  $filePath 文件路径
     * @return mixed|string 扩展名
     */
    public static function getExt(string $filePath){
        $arr = explode('.', $filePath);
        $ext = $arr[count($arr) - 1];
        $extends = ['jpg','jpeg','png','gif'];
        if (!in_array($ext,$extends)){
            $ext = 'jpg';
        }
        return $ext;
    }
}
