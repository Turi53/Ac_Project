<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarMod;
use App\Services\ModService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class PublishedCarModsController extends Controller
{
    private ModService $modService;

    public function __construct(ModService $modService) {
        $this->modService = $modService;
    }

    public function index()
    {

    }

    public function store(Request $request)
    {
        //
    }

    public function destroy(CarMod $trackMod)
    {
        //
    }
}
