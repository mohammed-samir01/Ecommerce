<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\StateRequest;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index()
    {
        if (!auth()->user()->ability('admin', 'manage_states, show_states')) {
            return redirect('admin/index');
        }

        $states = State::with('cities')
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);

        return view('backend.states.index', compact('states'));
    }

    public function create()
    {
        if (!auth()->user()->ability('admin', 'create_states')) {
            return redirect('admin/index');
        }
        $countries = Country::get(['id', 'name']);
        return view('backend.states.create', compact('countries'));
    }

    public function store(StateRequest $request)
    {
        if (!auth()->user()->ability('admin', 'create_states')) {
            return redirect('admin/index');
        }

        State::create($request->validated());

        return redirect()->route('admin.states.index')->with([
            'message' => 'Created successfully',
            'alert-type' => 'success'
        ]);
    }

    public function show(State $state)
    {
        if (!auth()->user()->ability('admin', 'display_states')) {
            return redirect('admin/index');
        }

        return view('backend.states.show', compact('state'));
    }

    public function edit(State $state)
    {
        if (!auth()->user()->ability('admin', 'update_states')) {
            return redirect('admin/index');
        }
        $countries = Country::get(['id', 'name']);
        return view('backend.states.edit', compact('countries', 'state'));
    }

    public function update(StateRequest $request, State $state)
    {
        if (!auth()->user()->ability('admin', 'update_states')) {
            return redirect('admin/index');
        }

        $state->update($request->validated());

        return redirect()->route('admin.states.index')->with([
            'message' => 'Updated successfully',
            'alert-type' => 'success'
        ]);
    }

    public function destroy(State $state)
    {
        if (!auth()->user()->ability('admin', 'delete_states')) {
            return redirect('admin/index');
        }
        $state->delete();

        return redirect()->route('admin.states.index')->with([
            'message' => 'Deleted successfully',
            'alert-type' => 'success'
        ]);
    }

    public function get_states(Request $request)
    {
        $states = State::whereCountryId($request->country_id)->whereStatus(true)->get(['id', 'name'])->toArray();
        return response()->json($states);
    }
}
