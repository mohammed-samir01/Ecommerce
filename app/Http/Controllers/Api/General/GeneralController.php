<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Http\Resources\General\FeaturedProductsResource;
use App\Http\Resources\General\ProductCategoriesResource;
use App\Http\Resources\General\ProductResource;
use App\Http\Resources\General\ProductsResource;
use App\Http\Resources\General\RelatedProductsResource;
use App\Http\Resources\General\ShopResource;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Tag;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Livewire\WithPagination;

class  GeneralController extends Controller
{

    use GeneralTrait;
    use WithPagination;

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

                return $products;


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

//            return $product;


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

            return ShopResource::collection($products);

    }

    public function shop_tag()
    {
//        return ProductCategory::tree();

        return response()->json(ProductCategory::tree());

    }


    public function tags()
    {
//       return Tag::whereStatus(true)->get();

       return response()->json(Tag::whereStatus(true)->get());

    }


    public function featured_products()
    {
        $featuredProducts = Product::with('firstMedia')
        ->inRandomOrder()->Featured()->Active()->HasQuantity()->ActiveCategory()
        ->take(8)->get();

        $featuredProducts =  FeaturedProductsResource::collection($featuredProducts);

       return $this->returnData('Featured_Products',$featuredProducts,"Done");
    }

    public function show_products_with_categories($slug)
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
        if ($slug == '') {
            $products = $products->ActiveCategory();
        } else {
            $product_category = ProductCategory::whereSlug($slug)->whereStatus(true)->first();

            if (is_null($product_category->parent_id)) {
                $categoriesIds = ProductCategory::whereParentId($product_category->id)
                    ->whereStatus(true)->pluck('id')->toArray();

                $products = $products->whereHas('category', function ($query) use ($categoriesIds) {
                    $query->whereIn('id', $categoriesIds);
                });

            } else {

                $products = $products->with('category')->whereHas('category', function ($query) use ($slug) {
                    $query->where(['slug' => $slug, 'status' => true]);
                });

            }
        }

        $products = $products->Active()
            ->HasQuantity()
            ->orderBy($sort_field, $sort_type)
            ->paginate($this->paginationLimit);

        return $products ;

//        return response()->json($products);


    }


    public function show_products_with_tags($slug)
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

        $products = $products->with('tags')->whereHas('tags', function ($query) use ($slug) {
            $query->where([
                'slug' => $slug,
                'status' => true,
            ]);
        });

        $products = $products->Active()
            ->HasQuantity()
            ->orderBy($sort_field, $sort_type)
            ->paginate($this->paginationLimit);

        return $products;

//        return response()->json($products);


    }

    public function related_products($slug)
    {
        $product = Product::with('media', 'category', 'tags', 'reviews')->withAvg('reviews', 'rating')->whereSlug($slug)
            ->Active()->HasQuantity()->ActiveCategory()->firstOrFail();

        $relatedProducts = Product::with('firstMedia')->whereHas('category', function ($query) use ($product) {
            $query->whereId($product->product_category_id);
            $query->whereStatus(true);
        })->inRandomOrder()->Active()->HasQuantity()->take(4)->get();

//        return $relatedProducts;

//        return response()->json($relatedProducts);

        return RelatedProductsResource::collection($relatedProducts);

    }

}
