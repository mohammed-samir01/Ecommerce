<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{

    use GeneralTrait;

    public function index(){

        $product_categories = ProductCategory::whereStatus(1)->whereNull('parent_id')->get();


        return $this->returnData('categories',$product_categories,'Done');


    }
}
