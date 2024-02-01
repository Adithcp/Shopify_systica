<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Osiset\ShopifyApp\Utils;
use GuzzleHttp\Client;
use App\Models\Product;

class ShopifyController extends Controller
{
    public function view()
    {
        $client = new Client();
        $response = $client->request('GET', "https://fcd924-4.myshopify.com/admin/api/2024-01/products.json", [
            'headers' => [
                'X-Shopify-Access-Token' => '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',
            ],
        ]);
        
        $body = $response->getBody();
        $data = json_decode($body, true);
        
        foreach ($data['products'] as $productData) {
            $existingProduct = Product::where('shopify_product_id', $productData['id'])->first();
        // dd($productData);
            if (!$existingProduct) {
                $product = new Product([
                    'shopify_product_id' => $productData['id'],
                    'title' => $productData['title'],
                    'body_html' => $productData['body_html'],
                    'vendor' => $productData['vendor'],
                    'product_type' => $productData['product_type'],
                    'shopify_created_at' => $productData['created_at'],
                    'handle' => $productData['handle'],
                    'shopify_updated_at' => $productData['updated_at'],
                    'shopify_published_at' => $productData['published_at'],
                    'template_suffix' => $productData['template_suffix'],
                    'published_scope' => $productData['published_scope'],
                    'tags' => $productData['tags'],
                    'status' => $productData['status'],
                    'admin_graphql_api_id' => $productData['admin_graphql_api_id'],
                ]);
        
                $product->save();
            }
        }        

    }
}
