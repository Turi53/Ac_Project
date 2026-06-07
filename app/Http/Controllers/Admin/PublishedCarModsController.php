<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarMod;
use App\Models\Mod;
use App\Services\ModService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

class PublishedCarModsController extends Controller
{
    private ModService $modService;

    public function __construct(ModService $modService) {
        $this->modService = $modService;
    }

    public function index()
    {
        $publishedCarMods = $this->modService->getPublishedCarMods();

        return view('admin.published-car-mods.index', [
                'publishedCarMods' => $publishedCarMods
            ]
        );
    }
}
