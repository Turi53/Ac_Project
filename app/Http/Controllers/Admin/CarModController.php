<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarMod;
use App\Services\ModService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class CarModController extends Controller
{
    private ModService $modService;

    public function __construct(ModService $modService) {
        $this->modService = $modService;
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(CarMod $carMod)
    {
        //
    }

    public function edit(CarMod $carMod)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(CarMod $carMod)
    {
        //
    }
}
