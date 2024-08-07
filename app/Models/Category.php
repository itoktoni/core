<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 *
 * @property $category_id
 * @property $category_name
 * @property $category_user_id
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Category extends Model
{
    protected $table = 'category';
    protected $perPage = 20;
    protected $primaryKey = 'category_id';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['category_id', 'category_name', 'category_user_id'];


}
