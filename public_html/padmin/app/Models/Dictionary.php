<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Dictionary
 * @package App\Models
 * @version October 10, 2019, 12:20 pm UTC
 *
 * @property integer tipus_id
 * @property string nev
 * @property string leiras
 * @property integer user_id
 */
class Dictionary extends Model
{
    use SoftDeletes;

    public $table = 'dictionaries';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'tipus',
        'nev',
        'leiras',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'tipus' => 'integer',
        'nev' => 'string',
        'leiras' => 'string',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'tipus' => 'required',
        'nev' => 'required',
    ];


}
