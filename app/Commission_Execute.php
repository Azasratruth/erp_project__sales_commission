<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property integer $commission_id
 * @property integer $seller_id
 * @property integer $added_by_id
 * @property integer $approved_by_id
 * @property integer $executed_by_id
 * @property string $created_at
 * @property string $updated_at
 * @property float $commission_amount
 * @property boolean $approved
 * @property boolean $executed
 * @property string $deleted_at
 * @property User $seller_id
 * @property User $added_by_id
 * @property User $approved_by_id
 * @property Commission $commission
 * @property User $executed_by_id
 */
class Commission_Execute extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'commission_execute';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['commission_id', 'seller_id', 'added_by_id', 'approved_by_id', 'executed_by_id', 'created_at', 'updated_at', 'commission_amount', 'approved', 'executed', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seller_id()
    {
        return $this->belongsTo('App\User', 'added_by_id');
    }

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
    public function commission()
    {
        return $this->belongsTo('App\Commission');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function executed_by_id()
    {
        return $this->belongsTo('App\User', 'executed_by_id');
    }
}
