<?php

namespace App\Dao\Models;

use App\Dao\Entities\Core\DefaultEntity;
use App\Dao\Entities\Core\SystemGroupEntity;
use App\Dao\Repositories\Core\CrudRepository;
use App\Dao\Traits\ActiveTrait;
use App\Dao\Traits\DataTableTrait;
use App\Dao\Traits\OptionTrait;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Mehradsadeghi\FilterQueryString\FilterQueryString as FilterQueryString;
use Touhidurabir\ModelSanitize\Sanitizable as Sanitizable;


/**
 * Class Category
 *
 * @property $category_id
 * @property $category_name
 * @property $category_user_id
 *
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */

class Category extends Model
{
    use Sortable, CrudRepository, FilterQueryString, Sanitizable, DataTableTrait, DefaultEntity, SystemGroupEntity, ActiveTrait, OptionTrait;

    protected $perPage = 20;
    protected $table = 'history';
    protected $primaryKey = 'history_id';
    protected $connection = 'backup';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['history_id', 'history_rfid', 'history_waktu'];
}
