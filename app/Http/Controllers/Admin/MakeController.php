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
        $this->$makeService = $makeService;
    }

    public function index()
    {

    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function edit(Make $make)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(Make $make)
    {
        //
    }
}
