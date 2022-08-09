<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProductReviewRequest;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{
    public function index()
    {
        if (!auth()->user()->ability('admin', 'manage_product_reviews, show_product_reviews')) {
            return redirect('admin/index');
        }

        $reviews = ProductReview::query()
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);
        return view('backend.product_reviews.index', compact('reviews'));
    }

    public function create()
    {
        if (!auth()->user()->ability('admin', 'create_product_reviews')) {
            return redirect('admin/index');
        }

        //
    }

    public function store(Request $request)
    {
        if (!auth()->user()->ability('admin', 'create_product_reviews')) {
            return redirect('admin/index');
        }

        //
    }

    public function show(ProductReview $productReview)
    {
        if (!auth()->user()->ability('admin', 'display_product_reviews')) {
            return redirect('admin/index');
        }

        return view('backend.product_reviews.show', compact('productReview'));
    }

    public function edit(ProductReview $productReview)
    {
        if (!auth()->user()->ability('admin', 'update_product_reviews')) {
            return redirect('admin/index');
        }

        return view('backend.product_reviews.edit', compact('productReview'));
    }

    public function update(ProductReviewRequest $request, ProductReview $productReview)
    {
        if (!auth()->user()->ability('admin', 'update_product_reviews')) {
            return redirect('admin/index');
        }

        $productReview->update($request->validated());

        return redirect()->route('admin.product_reviews.index')->with([
            'message' => 'Updated successfully',
            'alert-type' => 'success'
        ]);
    }

    public function destroy(ProductReview $productReview)
    {
        if (!auth()->user()->ability('admin', 'delete_product_reviews')) {
            return redirect('admin/index');
        }

        $productReview->delete();

        return redirect()->route('admin.product_reviews.index')->with([
            'message' => 'Deleted successfully',
            'alert-type' => 'success'
        ]);
    }
}
