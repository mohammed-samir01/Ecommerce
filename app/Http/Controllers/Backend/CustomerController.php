<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CustomerRequest;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CustomerController extends Controller
{
    public function index()
    {
        if (!auth()->user()->ability('admin', 'manage_customers, show_customers')) {
            return redirect('admin/index');
        }

        $customers = User::whereHas('roles', function ($query) {
            $query->where('name', 'customer');
        })
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);
        return view('backend.customers.index', compact('customers'));
    }

    public function create()
    {
        if (!auth()->user()->ability('admin', 'create_customers')) {
            return redirect('admin/index');
        }

        return view('backend.customers.create');
    }

    public function store(CustomerRequest $request)
    {
        if (!auth()->user()->ability('admin', 'create_customers')) {
            return redirect('admin/index');
        }

        $input['first_name'] = $request->first_name;
        $input['last_name'] = $request->last_name;
        $input['username'] = $request->username;
        $input['email'] = $request->email;
        $input['mobile'] = $request->mobile;
        $input['password'] = bcrypt($request->password);
        $input['status'] = $request->status;

        if ($image = $request->file('user_image')) {
            $file_name = Str::slug($request->username).".".$image->getClientOriginalExtension();
            $path = public_path('/assets/users/' . $file_name);
            Image::make($image->getRealPath())->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);
            $input['user_image'] = $file_name;
        }

        $customer = User::create($input);
        $customer->markEmailAsVerified();
        $customer->attachRole(Role::whereName('customer')->first()->id);

        return redirect()->route('admin.customers.index')->with([
            'message' => 'Created successfully',
            'alert-type' => 'success'
        ]);
    }

    public function show(User $customer)
    {
        if (!auth()->user()->ability('admin', 'display_customers')) {
            return redirect('admin/index');
        }

        return view('backend.customers.show', compact('customer'));
    }

    public function edit(User $customer)
    {
        if (!auth()->user()->ability('admin', 'update_customers')) {
            return redirect('admin/index');
        }

        return view('backend.customers.edit', compact('customer'));
    }

    public function update(CustomerRequest $request, User $customer)
    {
        if (!auth()->user()->ability('admin', 'update_customers')) {
            return redirect('admin/index');
        }

        $input['first_name'] = $request->first_name;
        $input['last_name'] = $request->last_name;
        $input['username'] = $request->username;
        $input['email'] = $request->email;
        $input['mobile'] = $request->mobile;
        if (trim($request->password) != ''){
            $input['password'] = bcrypt($request->password);
        }
        $input['status'] = $request->status;

        if ($image = $request->file('user_image')) {
            if ($customer->user_image != null && File::exists('assets/users/'. $customer->user_image)){
                unlink('assets/users/'. $customer->user_image);
            }
            $file_name = Str::slug($request->username).".".$image->getClientOriginalExtension();
            $path = public_path('/assets/users/' . $file_name);
            Image::make($image->getRealPath())->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);
            $input['user_image'] = $file_name;
        }

        $customer->update($input);

        return redirect()->route('admin.customers.index')->with([
            'message' => 'Updated successfully',
            'alert-type' => 'success'
        ]);
    }

    public function destroy(User $customer)
    {
        if (!auth()->user()->ability('admin', 'delete_customers')) {
            return redirect('admin/index');
        }

        if (File::exists('assets/users/'. $customer->user_image)){
            unlink('assets/users/'. $customer->user_image);
        }
        $customer->delete();

        return redirect()->route('admin.customers.index')->with([
            'message' => 'Deleted successfully',
            'alert-type' => 'success'
        ]);
    }

    public function remove_image(Request $request)
    {
        if (!auth()->user()->ability('admin', 'delete_customers')) {
            return redirect('admin/index');
        }

        $customer = User::findOrFail($request->customer_id);
        if (File::exists('assets/users/'. $customer->user_image)){
            unlink('assets/users/'. $customer->user_image);
            $customer->user_image = null;
            $customer->save();
        }
        return true;
    }

    public function get_customers()
    {
        $customers = User::whereHas('roles', function ($query) {
            $query->where('name', 'customer');
        })
            ->when(\request()->input('query') != '', function ($query) {
                $query->search(\request()->input('query'));
            })
            ->get(['id', 'first_name', 'last_name', 'email'])->toArray();

        return response()->json($customers);
    }
}
