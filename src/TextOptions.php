<?php
namespace Yhy\GdUtil;

/**
 * 文字配置参数
 * Class TextOptions
 *
 * @package App\Http\Lib
 */
class TextOptions
{
    /**
     * 字体文件
     * @var string
     */
    public $fontFile = '';
    /**
     * rgb 颜色
     * @var int|false
     */
    public $rgbColor = '';
    /**
     * 字体大小
     * @var int
     */
    public $fontSize = 14;
    /**
     * 行高
     * @var int
     */
    public $lineHeight = 20;
    /**
     *  定位 :
     *  top left-top right-top
     *  center left-center right-center
     *  bottom left-bottom right-bottom
     * @var string
     */
    public $position = 'top';
    /**
     * 横坐标
     * @var int
     */
    public $x = 0;
    /**
     * 纵坐标
     * @var int
     */
    public $y = 0;
    /**
     * 左右边距
     * @var int
     */
    public $padding = 10;

}
