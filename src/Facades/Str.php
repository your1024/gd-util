<?php
namespace Yhy\GdUtil\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Str
 *
 * @package Yhy\GdUtil\Facades
 * @method static getFileName(...$options): string
 * @method static getExt(string $filePath)
 */
class Str extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return "Str";
    }
}
