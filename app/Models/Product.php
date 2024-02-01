<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'shopify_product_id',
        'title',
        'body_html',
        'vendor',
        'product_type',
        'shopify_created_at',
        'handle',
        'shopify_updated_at',
        'shopify_published_at',
        'template_suffix',
        'published_scope',
        'tags',
        'status',
        'admin_graphql_api_id',
    ];
}
