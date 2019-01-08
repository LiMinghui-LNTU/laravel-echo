<?php
/**
 * Created by PhpStorm.
 * User: 22971
 * Date: 2018/12/26
 * Time: 13:23
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Navigation extends Model
{
    use SoftDeletes;

    protected $table = 'navigation';

    protected $guarded = ['deleted_at'];

    public static function getAllNavigation()
    {
        return self::where('is_show', 1)->orderBy('rank', 'asc')->get();
    }
}