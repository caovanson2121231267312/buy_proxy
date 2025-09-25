<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;
    protected $fillable = ['key', 'value', 'desc'];

    // Lấy config theo key
    public static function getValue($key, $default = null) {
        return optional(self::where('key', $key)->first())->value ?? $default;
    }

    // Cập nhật config
    public static function setValue($key, $value) {
        return self::updateOrCreate(['key' => $key], ['value' => $value]);
    }

    public static function getDesc($key, $default = null) {
        return optional(self::where('key', $key)->first())->desc ?? $default;
    }

    public static function setDesc($key, $value) {
        return self::updateOrCreate(['key' => $key], ['desc' => $value]);
    }
}
