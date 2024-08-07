<?php

namespace App\Dao\Models\Core;

use App\Dao\Builder\DataBuilder;
use App\Dao\Entities\Core\DefaultEntity;
use App\Dao\Entities\Core\SystemRoleEntity;
use App\Dao\Repositories\Core\CrudRepository;
use App\Dao\Traits\ActiveTrait;
use App\Dao\Traits\DataTableTrait;
use App\Dao\Traits\OptionTrait;
use App\Facades\Model\GroupModel;
use App\Facades\Model\RoleModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Console\Presets\Bootstrap;
use Kyslik\ColumnSortable\Sortable;
use Mehradsadeghi\FilterQueryString\FilterQueryString as FilterQueryString;
use Touhidurabir\ModelSanitize\Sanitizable as Sanitizable;
use Illuminate\Support\Str;

class SystemRole extends Model
{
    use Sortable, FilterQueryString, Sanitizable, DataTableTrait, CrudRepository, DefaultEntity, SystemRoleEntity, ActiveTrait, ActiveTrait, OptionTrait;

    protected $table = 'system_role';
    protected $primaryKey = 'system_role_code';
    protected $keyType = 'string';

    protected $fillable = [
        'system_role_code',
        'system_role_name',
        'system_role_level',
        'system_role_description',
    ];

    public $sortable = [
        'system_role_code',
        'system_role_name',
        'system_role_level',
        'system_role_description',
    ];

    protected $casts = [
        'system_role_code' => 'string',
    ];

    protected $filters = [
        'filter',
    ];

    public $timestamps = false;
    public $incrementing = false;

    public static function field_name()
    {
        return 'system_role_name';
    }

    public function fieldSearching()
    {
        return $this->field_name();
    }

    public function fieldDatatable(): array
    {
        return [
            DataBuilder::build(RoleModel::field_key())->name('Code')->sort(),
            DataBuilder::build(RoleModel::field_name())->name('Name')->show(true)->sort(),
            DataBuilder::build(RoleModel::field_level())->name('Level')->show(true)->sort(),
            DataBuilder::build(RoleModel::field_description())->name('Description')->show(true),
        ];
    }

    public function has_group()
    {
        return $this->belongsToMany(GroupModel::getModel(), 'system_group_connection_role', 'system_role_code', 'system_group_code');
    }

    public static function boot()
    {
        parent::creating(function ($model) {
            if(empty($model->{SystemRole::field_primary()})){
                $model->{SystemRole::field_primary()} = Str::camel($model->{SystemRole::field_name()});
            }
        });
        parent::boot();
    }
}
