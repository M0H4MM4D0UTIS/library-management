<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Book
 *
 * @property int $id
 * @property string $name
 * @property string|null $author
 * @property string|null $shabak
 * @property string|null $serial
 * @property string|null $publisher
 * @property string|null $year
 * @property string|null $version
 * @property int $createdby
 * @property Carbon $created
 *
 * @package App\Models
 */
class Book extends Model
{
	protected $table = 'books';
	public $timestamps = false;
    protected $appends = ['categories'];

	protected $casts = [
		'createdby' => 'int'
	];

	protected $dates = [
		'created'
	];

	protected $fillable = [
		'name',
		'author',
		'shabak',
		'serial',
		'publisher',
		'year',
		'version',
		'createdby',
		'created'
	];
    public function getCategoriesAttribute()
    {
        $cat_list = CategoryBook::all()->where('book_id', $this->id);
        if($cat_list->count() <= 0)
            return [];
        return Category::all()->whereIn('id', $cat_list->pluck('category_id')->toArray())->pluck('name')->toArray();
    }
    /*
     * $list is Category id array - sample $list = array(1, 2, 3, 4, 5)
     */
    public function setCategory($cat_list)
    {
        if(count($cat_list) <= 0)
            return;
        foreach ($cat_list as $cat_id)
        {
            if(CategoryBook::where('book_id', $this->id)->where('category_id', $cat_id)->count() <= 0)
            {
                CategoryBook::create([
                    'book_id' => $this->id,
                    'category_id' => $cat_id
                ]);
            }
        }

        CategoryBook::where('book_id', $this->id)->whereNotIn('category_id', $cat_list)->delete();
    }

}
