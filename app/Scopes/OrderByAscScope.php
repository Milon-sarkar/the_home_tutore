<?php
/**
 * Created by PhpStorm.
 * User: Dictator
 * Date: 3/11/2021
 * Time: 8:22 AM
 */

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;


class OrderByAscScope implements Scope
{

    private $column_name;

    public function __construct($column_name)
    {
        $this->column_name = $column_name;
    }

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $builder->orderBy($this->column_name,'ASC');
    }
}