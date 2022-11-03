<?php
namespace Yhy\GdUtil;

interface Gd2Interface
{
    /**
     * 根据本地图片或网络图片画圆
     * 返回一个处理成圆形的Gd类型的图片资源
     * @param  string  $filePath 文件路径
     *
     * @return mixed
     */
    public function drawCircle(string $filePath);

    /**
     * 合并图片
     * @param resource $dstImg 目标图片资源
     * @param resource $srcImg 绘制图片资源
     * @param  ImageCopyOptions  $options
     *
     * @return mixed
     */
    public function imageCopy($dstImg,$srcImg,ImageCopyOptions $options);

    /**
     * 根据本地图片或网络图片画圆
     * 返回一个Gd类型的图片资源
     * @param  string  $filePath
     *
     * @return mixed
     */
    public function getImgDraw(string $filePath);

    /**
     * 定位
     * @param resource $imgResource 图片资源
     * @param  int  $boxWidth 定位盒子的宽度
     * @param  int  $boxHeight 定位盒子的高度
     *
     * @return mixed
     */
    public function getPosition($imgResource,string $position = 'top',int $boxWidth = 0, int $boxHeight = 0);

    /**
     * 获得字体颜色
     * @param $imgResource
     * @param  int  $red
     * @param  int  $green
     * @param  int  $blue
     *
     * @return mixed
     */
    public function getColor($imgResource,int $red = 255,int $green = 255,int $blue = 255);
    /**
     * 绘制文字
     * @param  resource $imgResource
     * @param  string  $text
     * @param  TextOptions  $options
     * @param  int  $angle
     *
     * @return mixed
     */
    public function writeText($imgResource,string $text,TextOptions $options,$angle = 0);

    /**
     * 调整图片大小
     *
     * @param resource $imgResource
     * @param  int  $width
     * @param  int  $height
     *
     * @return mixed
     */
    public function resize($imgResource,int $width,int $height = -1);

    /**
     * 获得图片宽度
     * @param resource $imageResource
     *
     * @return mixed
     */
    public function width($imageResource);

    /**
     * 获得图片高度
     * @param resource $imageResource
     *
     * @return mixed
     */
    public function height($imageResource);
    /**
     * 保存图片
     * @param $imgRecourse
     * @param  string  $ext
     * @param  string  $path
     * @param  string  $fileName
     *
     * @return mixed
     */
    public function save($imgRecourse,$ext = 'png',string $path = 'default',$fileName = 'default');
}
