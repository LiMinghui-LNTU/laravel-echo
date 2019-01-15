<?php
/**
 * Created by PhpStorm.
 * User: liminghui
 * Date: 2019/1/15
 * Time: 18:07
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Designer extends Model
{
    use SoftDeletes;

    protected $table = 'designers';

    protected $guarded = ['deleted_at'];

}