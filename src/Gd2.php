<?php
namespace Yhy\GdUtil;

/**
 * Class Gd2
 *
 * @package Yhy\GdUtil
 */
class Gd2 implements Gd2Interface
{
    public function drawCircle(string $filePath)
    {
        $srcImg = $this->getImgDraw($filePath);
        $w = imagesx($srcImg);
        $h = imagesy($srcImg);
        // 直径
        $d = min($w, $h);
        $drawImg = imagecreatetruecolor($d, $d);
        imagesavealpha($drawImg, true);
        // 透明背景
        $bg = imagecolorallocatealpha($drawImg, 255, 255, 255, 127);
        imagefill($drawImg, 0, 0, $bg);
        // 半径
        $r = floor($d / 2);
        $circleX = $r; // 圆心横坐标
        $circleY = $r; // 圆心纵坐标
        for ($x = 0; $x < $d; $x ++) {
            for ($y = 0; $y < $d; $y++) {
                $rgbColor = imagecolorat($srcImg, $x, $y);
                // 比较是否在圆内 公式 (x-circleX)^2 + (y-circleY)^2 <= r^2
                $within = (($x-$circleX) * ($x - $circleX) + ($y-$circleY) * ($y-$circleY)) <= $r * $r;
                if ($within) {
                    // 画圆内上的点
                    imagesetpixel($drawImg, $x, $y, $rgbColor);
                }
            }
        }
        return $drawImg;
    }

    /**
     * 图片合并
     * @param  resource  $dstImg
     * @param  resource  $srcImg
     * @param  ImageCopyOptions  $options
     *
     * @return mixed|void
     */
    public function imageCopy($dstImg, $srcImg, ImageCopyOptions $options)
    {
        list($positionX, $positionY) = $this->getPosition($dstImg, $options->position, $options->boxWidth, $options->boxHeight);
        imagecopy($dstImg, $srcImg, $positionX + $options->x, $positionY + $options->y, 0, 0, $options->boxWidth, $options->boxHeight);
        imagedestroy($srcImg);
    }

    /**
     * 获得图片资源
     * @param  string  $filePath
     *
     * @return false|\GdImage|mixed|resource
     */
    public function getImgDraw(string $filePath)
    {
        $ext = Str::getExt($filePath);
        switch (strtolower($ext)) {
            case "jpeg":
            case "jpg":
                $srcImg = imagecreatefromjpeg($filePath);
                break;
            case "png":
                $srcImg = imagecreatefrompng($filePath);
                break;
            case "gif":
                $srcImg = imagecreatefromgif($filePath);
                break;
            default:
                $srcImg = imagecreatefromjpeg($filePath);
        }
        return $srcImg;
    }

    /**
     * 文字
     * @param $imgResource
     * @param  string  $text
     * @param  TextOptions  $options
     * @param  int  $angle
     *
     * @return mixed
     */
    public function writeText($imgResource, string $text, TextOptions $options, $angle = 0)
    {
        $tempText = "";
        $offset = 0;
        // 计算长度
        for ($i = 0; $i < mb_strlen($text); $i++) {
            $tempText .= mb_substr($text, $i, 1, 'utf8');
            $strBox = imagettfbbox($options->fontSize, $angle, $options->fontFile, $tempText);
            $strLen = $strBox[2] - $strBox[0];
            if ($strLen >= imagesx($imgResource) - 2 * $options->padding - $options->x) {
                // 获取换行最大字符长度
                $offset = $i;
                break;
            }
        }
        if ($offset > 0) {
            $lines = ceil(mb_strlen($text, 'utf8') / ($offset-1));
            // 取第一行获得字体宽度
            $first = mb_substr($text, 0, $offset-1);
            $box = imagettfbbox($options->fontSize, $angle, $options->fontFile, $first);
            $boxLen = $box[2] - $box[0];
            // 获取定位位置
            list($positionX, $positionY) = $this->getPosition($imgResource, $options->position,$boxLen, $options->lineHeight * $lines);
            for ($i = 0 ; $i < $lines; $i ++) {
                // 换行绘制文字
                $line = mb_substr($text, ($offset-1) * $i, $offset-1);
                imagettftext($imgResource, $options->fontSize, $angle, $positionX + $options->x + $options->padding / 2, $positionY + $options->y + ($i + 1) * $options->lineHeight, $options->rgbColor, $options->fontFile,$line);
            }
        }else{
            // 无需换行直接绘制
            $box = imagettfbbox($options->fontSize, $angle, $options->fontFile, $text);
            $boxLen = $box[2] - $box[0];
            // 获取定位位置
            list($positionX, $positionY) = $this->getPosition($imgResource, $options->position, $boxLen, $options->lineHeight);
            imagettftext($imgResource, $options->fontSize, $angle, $positionX + $options->x + $options->padding / 2, $positionY + $options->y + $options->lineHeight, $options->rgbColor, $options->fontFile, $text);
        }
        return $imgResource;
    }

    /**
     * 调整图片大小
     *
     * @param $imgResource
     * @param  int  $width
     * @param  int  $height
     *
     * @return false|\GdImage|resource
     */
    public function resize($imgResource,int $width, int $height = -1)
    {
        return imagescale($imgResource,$width,$height,IMG_BILINEAR_FIXED);
    }

    /**
     * 获得x,y轴定位
     * @param  resource  $imgResource
     * @param  string  $position
     * @param  int  $boxWidth
     * @param  int  $boxHeight
     *
     * @return array
     */
    public function getPosition($imgResource, string $position = 'top',int $boxWidth = 0, int $boxHeight = 0): array
    {
        $width = imagesx($imgResource);
        $height = imagesy($imgResource);
        switch ($position) {
            case 'top':
                $positionX = ($width - $boxWidth) / 2;
                $positionY = 0;
                break;
            case 'left-top':
                $positionX = 0;
                $positionY = 0;
                break;
            case 'right-top':
                $positionX = $width - $boxHeight;
                $positionY = 0;
                break;
            case 'center':
                $positionX = ($width - $boxWidth) / 2;
                $positionY = ($height - $boxHeight) / 2;
                break;
            case 'left-center':
                $positionX = 0;
                $positionY = ($height - $boxHeight) / 2;
                break;
            case 'right-center':
                $positionX = $width - $boxWidth;
                $positionY = ($height - $boxHeight) / 2;
                break;
            case 'bottom':
                $positionX = ($width - $boxWidth) / 2;
                $positionY = $height - $boxHeight;
                break;
            case 'left-bottom':
                $positionX = 0;
                $positionY = $height - $boxHeight;
                break;
            case 'right-bottom':
                $positionX = $width - $boxWidth;
                $positionY = $height - $boxHeight;
                break;
            default:
                $positionX = 0;
                $positionY = 0;
        }
        return [$positionX,$positionY];
    }

    /**
     * 获得颜色rgb
     * @param $imgResource
     * @param  int  $red
     * @param  int  $green
     * @param  int  $blue
     *
     * @return false|int|mixed
     */
    public function getColor($imgResource, int $red = 255, int $green = 255, int $blue = 255)
    {
        return imagecolorallocate($imgResource, 50, 50, 50);
    }

    /**
     * 图片宽度
     * @param  resource  $imageResource
     *
     * @return false|int|mixed
     */
    public function width($imageResource)
    {
        return imagesx($imageResource);
    }

    /**
     * 图片高度
     * @param  resource  $imageResource
     *
     * @return false|int|mixed
     */
    public function height($imageResource)
    {
        return imagesy($imageResource);
    }


    /**
     * 保存文件
     * @param $imgRecourse
     * @param  string  $ext
     * @param  string  $path
     * @param  string  $fileName
     *
     * @return string
     */
    public function save($imgRecourse, $ext = 'png', string $path = 'default', $fileName = 'default'): string
    {
        // 判断是否创建文件夹
        $savePath = storage_path($path);
        if (!file_exists($savePath)) {
            mkdir($savePath, '0766', true);
        }
        $filePath = $savePath . '/' . $fileName . '.' . $ext;
        switch (strtolower($ext)) {
            case "jpeg":
            case "jpg":
                imagejpeg($imgRecourse, $filePath);
                break;
            case "png":
                imagepng($imgRecourse, $filePath);
                break;
            case "gif":
                imagegif($imgRecourse, $filePath);
                break;
            default:
                imagejpeg($imgRecourse, $filePath);
        }
        imagedestroy($imgRecourse);
        return $path . '/' . $fileName . '.' . $ext;
    }

}
