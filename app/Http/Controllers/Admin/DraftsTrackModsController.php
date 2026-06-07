<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ModService;
use Illuminate\Http\Request;

class DraftsTrackModsController extends Controller
{
    private ModService $modService;

    public function __construct(ModService $modService) {
        $this->modService = $modService;
    }

    public function index()
    {
        $draftTrackMods = $this->modService->getDraftTrackMods();

        return view('admin.draft-track-mods.index', [
            'draftTrackMods' => $draftTrackMods
        ]);
    }
}
