<?php

namespace App\Dao\Models\Core;

use App\Dao\Entities\Core\DefaultEntity;
use App\Dao\Repositories\Core\CrudRepository;
use App\Dao\Traits\ActiveTrait;
use App\Dao\Traits\DataTableTrait;
use App\Dao\Traits\OptionTrait;
use App\Http\Requests\Core\GeneralRequest;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Mehradsadeghi\FilterQueryString\FilterQueryString as FilterQueryString;
use Touhidurabir\ModelSanitize\Sanitizable as Sanitizable;

class Category extends Model
{
    use Sortable, FilterQueryString, Sanitizable, DataTableTrait, DefaultEntity, ActiveTrait, OptionTrait, CrudRepository;

    protected $table = 'category';
    protected $primaryKey = 'category_id';
    protected $keyType = 'string';

    protected $fillable = [
        'category_id',
        'category_name',
        'category_action',
        'category_controller',
        'category_sort',
        'category_description',
        'category_enable',
        'category_url',
        'category_type',
    ];

    public $sortable = [
        'category_code',
        'category_name',
        'category_controller',
        'category_sort',
    ];

    protected $casts = [
        'category_sort' => 'integer'
    ];

    protected $filters = [
        'filter',
    ];

    public $timestamps = false;
    public $incrementing = false;

    public function field_name()
    {
        return 'category_name';
    }

    public function fieldSearching()
    {
        return $this->field_name();
    }
}
