<?php
namespace Yhy\GdUtil;

/**
 * 图片合并参数类
 * Class ImageCopyOptions
 *
 * @package App\Http\Lib
 */
class ImageCopyOptions
{
    /**
     *  定位:
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
     * 图片宽度
     * @var int
     */
    public $boxWidth = 100;
    /**
     * 图片长度
     * @var int
     */
    public $boxHeight = 100;
}
