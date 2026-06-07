<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Make;
use App\Services\MakeService;
use Illuminate\Http\Request;

class MakeController extends Controller
{
    private MakeService $makeService;

    public function __construct(MakeService $makeService) {
        $this->makeService = $makeService;
    }

    public function index()
    {
        $makes = $this->makeService->getAllMakes();

        return view('admin.makes.index', ['makes' => $makes]);
    }

    public function create()
    {
        return view('admin.makes.create', ['make' => new make]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:makes,name'],
        ]);

        $make = $this->makeService->createMake($data);

        return redirect()
            ->route('admin.makes.index')
            ->with('success', 'The Make ' . $make->name . ' has successfully been created');
    }

    public function edit(Make $make)
    {
        return view('admin.makes.edit', ['make' => $make]);
    }

    public function update(Request $request, Make $make)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255',],
        ]);

        $this->makeService->updateMake($make->id, $data);

        return redirect()
            ->route('admin.makes.index')
            ->with('success', 'The Make ' . $make->name . ' has successfully been updated');
    }

    public function destroy(Make $make)
    {
        $this->makeService->deleteMake($make->id);

        return redirect()->back()->with('success', 'The Make ' . $make->name . ' has successfully been deleted');
    }
}
