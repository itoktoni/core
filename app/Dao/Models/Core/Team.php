<?php

namespace App\Dao\Models\Core;

use App\Dao\Builder\DataBuilder;
use App\Dao\Entities\Core\DefaultEntity;
use App\Dao\Entities\Core\TeamEntity;
use App\Dao\Repositories\Core\CrudRepository;
use App\Dao\Traits\ActiveTrait;
use App\Dao\Traits\DataTableTrait;
use App\Dao\Traits\OptionTrait;
use App\Facades\Model\TeamModel;
use App\Facades\Model\UserModel;
use Illuminate\Database\Eloquent\Model;
use Kirschbaum\PowerJoins\PowerJoins;
use Kyslik\ColumnSortable\Sortable;
use Mehradsadeghi\FilterQueryString\FilterQueryString as FilterQueryString;
use Touhidurabir\ModelSanitize\Sanitizable as Sanitizable;

class Team extends Model
{
    use Sortable
    , FilterQueryString
    , Sanitizable
    , DataTableTrait
    , DefaultEntity
    , TeamEntity
    , ActiveTrait
    , OptionTrait
    , PowerJoins
    , CrudRepository;

    protected $table = 'teams';
    protected $primaryKey = 'team_id';

    protected $fillable = [
        'team_id',
        'team_name',
        'team_domain',
        'team_user_id',
    ];

    public $sortable = [
        'team_name',
        'team_domain',
    ];

    protected $casts = [
        'team_user_id' => 'integer'
    ];

    protected $filters = [
        'filter',
    ];

    public $timestamps = false;
    public $incrementing = false;

    public function field_name()
    {
        return 'team_name';
    }

    public function fieldSearching()
    {
        return $this->field_name();
    }

    public function has_lead()
    {
        return $this->hasOne(UserModel::getModel(), UserModel::field_primary(), TeamModel::field_lead_id());
    }

    public function has_user()
    {
        return $this->belongsToMany(UserModel::getModel(), 'team_user', 'team_id', 'id');
    }

    public function fieldDatatable(): array
    {
        return [
            DataBuilder::build($this->field_key())->name('ID'),
            DataBuilder::build($this->field_name())->name('Name')->sort(),
            DataBuilder::build(UserModel::field_name())->name('Team Lead')->sort(),
        ];
    }

    public function dataRepository()
    {
        $query = $this
            ->select($this->getSelectedField())
            ->leftJoinRelationship('has_lead')
            ->sortable()
            ->filter();

        $query = env('PAGINATION_SIMPLE') ? $query->simplePaginate(env('PAGINATION_NUMBER')) : $query->paginate(env('PAGINATION_NUMBER'));

        return $query;
    }

}
