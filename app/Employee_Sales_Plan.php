<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property integer $added_by_id
 * @property integer $approved_by_id
 * @property integer $executed_by_id
 * @property string $created_at
 * @property string $updated_at
 * @property boolean $quarter
 * @property boolean $approved
 * @property boolean $executed
 * @property string $deleted_at
 * @property User $added_by_id
 * @property User $approved_by_id
 * @property User $executed_by_id
 * @property Commission[] $commissions
 */
class Employee_Sales_Plan extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'employee_sales_plan';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['added_by_id', 'approved_by_id', 'executed_by_id', 'created_at', 'updated_at', 'quarter', 'approved', 'executed', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function added_by_id()
    {
        return $this->belongsTo('App\User', 'added_by_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function approved_by_id()
    {
        return $this->belongsTo('App\User', 'approved_by_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function executed_by_id()
    {
        return $this->belongsTo('App\User', 'executed_by_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function commissions()
    {
        return $this->hasMany('App\Commission');
    }
}
