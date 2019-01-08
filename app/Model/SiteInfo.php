<?php
/**
 * Created by PhpStorm.
 * User: 22971
 * Date: 2018/12/26
 * Time: 13:25
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SiteInfo extends Model
{
    use SoftDeletes;

    protected $table = 'site_info';

    protected $guarded = ['deleted_at'];

    public static function getSiteInfo()
    {
        return self::orderBy('created_at', 'desc')->first();
    }

}