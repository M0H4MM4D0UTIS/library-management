<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CategoryBook
 *
 * @property int $category_id
 * @property int $book_id
 *
 * @package App\Models
 */
class CategoryBook extends Model
{
	protected $table = 'category_book';
	public $incrementing = false;
	public $timestamps = false;

    protected $fillable = [
        'category_id',
        'book_id',
    ];

	protected $casts = [
		'category_id' => 'int',
		'book_id' => 'int'
	];

    public function category_id()
    {
        return $this->hasOne(Category::class, 'id');
    }

    public function book_id()
    {
        return $this->hasOne(Book::class, 'id');
    }
}
