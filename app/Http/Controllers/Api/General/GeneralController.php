<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Http\Resources\General\ProductCategoriesResource;
use App\Http\Resources\General\ProductResource;
use App\Http\Resources\General\ProductsResource;
use App\Http\Resources\General\ShopResource;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class  GeneralController extends Controller
{

    use GeneralTrait;
    protected $paginationTheme = 'bootstrap';
    public $paginationLimit = 12;
    public $slug;
    public $sortingBy = 'default';


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

                $products=  ProductsResource::collection($products);

                return $this->returnData('products',$products,'Done');


            } else {

                return response()->json(['error' => true , 'message' => 'No Products Found'],200);
            }
    }

    public function get_product_categories()
    {
        $product_categories = ProductCategory::whereStatus(1)->whereNull('parent_id')->get();

        if ($product_categories->count() > 0){

            $categories =  ProductCategoriesResource::collection($product_categories);

            return $this->returnData('Categories',$categories,'Done');


        } else {

            return response()->json(['error' => true , 'message' => 'No Categories Found'],201);
        }

    }

    public function show_product($slug)
    {
        $product = Product::with('media', 'category', 'tags', 'reviews')->withAvg('reviews', 'rating')->whereSlug($slug)
            ->Active()->HasQuantity()->ActiveCategory()->firstOrFail();

        if ($product->count() > 0){

            $product = new ProductResource($product);

            return $this->returnData('Product',$product,'Done');


        } else {

            return response()->json(['error' => true , 'message' => 'No Product Selected'],201);
        }


    }

    public function shop()
    {
        switch ($this->sortingBy) {
            case 'popularity':
                $sort_field = 'id';
                $sort_type = 'asc';
                break;
            case 'low-high':
                $sort_field = 'price';
                $sort_type = 'asc';
                break;
            case 'high-low':
                $sort_field = 'price';
                $sort_type = 'desc';
                break;
            default:
                $sort_field = 'id';
                $sort_type = 'asc';
        }

        $products = Product::with('firstMedia');
        if ($this->slug == '') {
            $products = $products->ActiveCategory();
        } else {
            $product_category = ProductCategory::whereSlug($this->slug)->whereStatus(true)->first();

            if (is_null($product_category->parent_id)) {
                $categoriesIds = ProductCategory::whereParentId($product_category->id)
                    ->whereStatus(true)->pluck('id')->toArray();

                $products = $products->whereHas('category', function ($query) use ($categoriesIds) {
                    $query->whereIn('id', $categoriesIds);
                });

            } else {

                $products = $products->with('category')->whereHas('category', function ($query) {
                    $query->where([
                        'slug' => $this->slug,
                        'status' => true
                    ]);
                });

            }
        }

        $products = $products->Active()
            ->HasQuantity()
            ->orderBy($sort_field, $sort_type)
            ->paginate($this->paginationLimit);


        if ($products->count() > 0){

            return ShopResource::collection($products);

//            return $this->returnData('Categories',$products,'Done');


        } else {

            return response()->json(['error' => true , 'message' => 'No Products Found'],201);
        }




    }

}
