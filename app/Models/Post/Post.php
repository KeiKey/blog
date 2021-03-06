<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed id
 * @property mixed title
 * @property mixed content
 * @property mixed category_id
 * @property mixed thumbnail
 * @property mixed bg_image
 * @property mixed user_id
 * @property mixed state
 * @property mixed disabled_by
 */
class Post extends Model
{
    use RelationshipTrait,
        AttributesTrait,
        ScopesTrait,
        SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
        'category_id',
        'thumbnail',
        'bg_image',
        'user_id',
        'state',
        'disabled_by'
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];
}
