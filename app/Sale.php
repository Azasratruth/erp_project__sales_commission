<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property integer $seller_id
 * @property integer $product_id
 * @property integer $quantity
 * @property integer $customer_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property User $seller_id
 * @property Product $product
 * @property User $customer_id
 */
class Sale extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'sale';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['seller_id', 'product_id', 'quantity', 'customer_id', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer_id()
    {
        return $this->belongsTo('App\User', 'customer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seller_id()
    {
        return $this->belongsTo('App\User', 'seller_id');
    }
}
