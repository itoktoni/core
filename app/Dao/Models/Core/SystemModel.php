<?php

namespace App\Dao\Models\Core;

use App\Dao\Entities\Core\DefaultEntity;
use App\Dao\Repositories\Core\CrudRepository;
use App\Dao\Traits\ActiveTrait;
use App\Dao\Traits\DataTableTrait;
use App\Dao\Traits\OptionTrait;
use Illuminate\Database\Eloquent\Model;
use Kirschbaum\PowerJoins\PowerJoins;
use Kyslik\ColumnSortable\Sortable;
use Mehradsadeghi\FilterQueryString\FilterQueryString as FilterQueryString;
use Touhidurabir\ModelSanitize\Sanitizable as Sanitizable;

class SystemModel extends Model
{
    use Sortable
    , FilterQueryString
    , Sanitizable
    , DataTableTrait
    , DefaultEntity
    , ActiveTrait
    , OptionTrait
    , PowerJoins
    , CrudRepository;

    protected $filters = [
        'filter',
    ];

    public $timestamps = false;
    public $incrementing = false;

    public function fieldSearching()
    {
        return self::field_name();
    }
}
