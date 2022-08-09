<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CountryRequest;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        if (!auth()->user()->ability('admin', 'manage_countries, show_countries')) {
            return redirect('admin/index');
        }

        $countries = Country::with('states')
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);

        return view('backend.countries.index', compact('countries'));
    }

    public function create()
    {
        if (!auth()->user()->ability('admin', 'create_countries')) {
            return redirect('admin/index');
        }

        return view('backend.countries.create');
    }

    public function store(CountryRequest $request)
    {
        if (!auth()->user()->ability('admin', 'create_countries')) {
            return redirect('admin/index');
        }

        Country::create($request->validated());

        return redirect()->route('admin.countries.index')->with([
            'message' => 'Created successfully',
            'alert-type' => 'success'
        ]);
    }

    public function show(Country $country)
    {
        if (!auth()->user()->ability('admin', 'display_countries')) {
            return redirect('admin/index');
        }

        return view('backend.countries.show');
    }

    public function edit(Country $country)
    {
        if (!auth()->user()->ability('admin', 'update_countries')) {
            return redirect('admin/index');
        }

        return view('backend.countries.edit', compact('country'));
    }

    public function update(CountryRequest $request, Country $country)
    {
        if (!auth()->user()->ability('admin', 'update_countries')) {
            return redirect('admin/index');
        }

        $country->update($request->validated());

        return redirect()->route('admin.countries.index')->with([
            'message' => 'Updated successfully',
            'alert-type' => 'success'
        ]);
    }

    public function destroy(Country $country)
    {
        if (!auth()->user()->ability('admin', 'delete_countries')) {
            return redirect('admin/index');
        }
        $country->delete();

        return redirect()->route('admin.countries.index')->with([
            'message' => 'Deleted successfully',
            'alert-type' => 'success'
        ]);
    }
}
