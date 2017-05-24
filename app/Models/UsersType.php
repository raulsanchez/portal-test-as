<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class UsersType
 *
 * @package App
 * @property string $slug
 * @property string $name
 * @property string $description
*/
class UsersType extends Model
{
    use SoftDeletes;

    protected $fillable = ['slug', 'name', 'description'];
}
