<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Member
 *
 * @property int $id
 * @property string $fullname
 * @property string $jensiyat
 * @property string|null $email
 * @property bool $active
 * @property string|null $codeMeli
 * @property string|null $codePosti
 * @property string|null $phone
 * @property string $fullAddress
 * @property int $createdby
 * @property Carbon $expire
 * @property Carbon $updated_at
 * @property Carbon $created
 *
 * @package App\Models
 */
class Member extends Model
{
	protected $table = 'members';
	public $timestamps = false;

	protected $casts = [
		'active' => 'bool',
		'createdby' => 'int'
	];

	protected $dates = [
		'expire',
		'created'
	];

	protected $fillable = [
		'fullname',
		'jensiyat',
		'email',
		'active',
		'codeMeli',
		'codePosti',
		'phone',
		'fullAddress',
		'createdby',
		'expire',
		'created'
	];

    public function createdby()
    {
        return $this->hasOne(User::class, 'id');
    }
}
