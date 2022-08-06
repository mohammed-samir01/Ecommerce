<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Http\Resources\General\ProductCategoriesResource;
use App\Http\Resources\General\ProductResource;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class  GeneralController extends Controller
{

    use GeneralTrait;

    public function get_products()
    {
        $products = Product::when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);

            if ($products->count() > 0){

                return ProductResource::collection($products);
            } else {

                return response()->json(['error' => true , 'message' => 'No Products Found'],200);
            }
    }

    public function get_product_categories()
    {
        $categories = ProductCategory::when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);

        if ($categories->count() > 0){

            return ProductCategoriesResource::collection($categories);
        } else {

            return response()->json(['error' => true , 'message' => 'No Categories Found'],200);
        }

    }
}
