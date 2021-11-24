<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Lended
 *
 * @property int $id
 * @property int $operatorid
 * @property int $memberid
 * @property bool $tahvil
 * @property Carbon $created
 * @property Carbon $tarikhTahvil
 *
 * @package App\Models
 */
class Lended extends Model
{
	protected $table = 'lended';
	public $timestamps = false;

	protected $casts = [
		'operatorid' => 'int',
		'memberid' => 'int',
		'book_id' => 'int',
		'tahvil' => 'bool'
	];

	protected $dates = [
		'created',
		'tarikhTahvil'
	];

	protected $fillable = [
		'operatorid',
		'memberid',
		'book_id',
		'tahvil',
		'created',
		'tarikhTahvil',
        'operator',
        'member',
        'book'
	];

    public function getMemberAttribute()
    {
        return Member::find($this->memberid);
    }
    public function getOperatorAttribute()
    {
        return User::find($this->operatorid);
    }
    public function getBookAttribute()
    {
        return Book::find($this->book_id);
    }

    public function operatorid()
    {
        return $this->hasOne(User::class, 'id');
    }

    public function memberid()
    {
        return $this->hasOne(Member::class, 'id');
    }

    public function book_id()
    {
        return $this->hasOne(Book::class, 'id');
    }
}
