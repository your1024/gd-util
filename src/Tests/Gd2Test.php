<?php

namespace Yhy\GdUtil\Tests;

use Tests\TestCase;
use Yhy\GdUtil\Facades\Gd2;
use Yhy\GdUtil\Facades\Str;
use Yhy\GdUtil\ImageCopyOptions;
use Yhy\GdUtil\TextOptions;

class Gd2Test extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $bgFile = "https://gimg2.baidu.com/image_search/src=http%3A%2F%2Fhbimg.b0.upaiyun.com%2F4a7acc2b90a2f75ceac8ba156f2d8c89ff48a09420ef-XvyOeD_fw658&refer=http%3A%2F%2Fhbimg.b0.upaiyun.com&app=2002&size=f9999,10000&q=a80&n=0&g=0n&fmt=auto?sec=1670050599&t=bd7a2695c11b35e54e4043749fb3023a";
        $avatarFile = "https://thirdwx.qlogo.cn/mmopen/vi_32/E23LNSoiaIpia3avTzX7vHt0q1v653zyHUWzshSdhnE5N3pTfOdIyh9Z72r89prn6wiafMofzlet2xtBUvicfKwBKw/132";
        $font = dirname(__FILE__,2) . '/resource/fonts/simkai.ttf';
        $bgImg  = Gd2::getImgDraw($bgFile);
        $avatarImg = Gd2::drawCircle($avatarFile);
        $paddingTop = 80;
        // 字体颜色
        $titleColor = Gd2::getColor($bgImg,140,161,145);
        // 合成头像
        $imageCopyOptions = new ImageCopyOptions();
        $imageCopyOptions->position = 'top';
        $imageCopyOptions->boxWidth = $imageCopyOptions->boxHeight = min(Gd2::width($avatarImg), Gd2::height($avatarImg));
        Gd2::imageCopy($bgImg, $avatarImg, $imageCopyOptions);
        // 绘制昵称
        $options = new TextOptions();
        $options->fontFile = $font;
        $options->fontSize = 20;
        $options->lineHeight = 25;
        $options->rgbColor = $titleColor;
        $options->padding = 0;
        $options->y = $paddingTop + 132;
        Gd2::writeText($bgImg,'窗前明月光,疑似地上霜',$options);
        // 保存图片
        $ext = Str::getExt($bgFile);
        $fileName = Str::getFileName(10001,1);
        $path = Gd2::save($bgImg, $ext, 'images',$fileName);
        echo $path;
        $this->assertTrue(true);
    }
}
