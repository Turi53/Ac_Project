<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ModService;
use Illuminate\Http\Request;

class DraftsCarModsController extends Controller
{
    private ModService $modService;

    public function __construct(ModService $modService) {
        $this->modService = $modService;
    }

    public function index()
    {
        $draftCarMods = $this->modService->getDraftCarMods();

        return view('admin.draft-car-mods.index', [
            'draftCarMods' => $draftCarMods
        ]);
    }
}
