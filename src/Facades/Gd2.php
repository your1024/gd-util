<?php
namespace Yhy\GdUtil\Facades;
use Illuminate\Support\Facades\Facade;
use Yhy\GdUtil\ImageCopyOptions;
use Yhy\GdUtil\TextOptions;

/**
 * GD facade
 * Class Gd2
 *
 * @package Yhy\GdUtil\Facades
 * @method static drawCircle(string $filePath)
 * @method static imageCopy($dstImg, $srcImg, ImageCopyOptions $options)
 * @method static getImgDraw(string $filePath)
 * @method static writeText($imgResource, string $text, TextOptions $options, $angle = 0)
 * @method static getPosition($imgResource, string $position = 'top',int $boxWidth = 0, int $boxHeight = 0): array
 * @method static getColor($imgResource, int $red = 255, int $green = 255, int $blue = 255)
 * @method static save($imgRecourse, $ext = 'png', string $path = 'default', $fileName = 'default'): string
 * @method static resize($imgResource,int $width, int $height = -1)
 * @method static width($imageResource)
 * @method static height($imageResource)
 */
class Gd2 extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return "Gd2";
    }
}
