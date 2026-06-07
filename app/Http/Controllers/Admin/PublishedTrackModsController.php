<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrackMod;
use App\Services\ModService;
use Illuminate\Http\Request;

class PublishedTrackModsController extends Controller
{
    private ModService $modService;

    public function __construct(ModService $modService) {
        $this->modService = $modService;
    }

    public function index()
    {
        $publishedTrackMods = $this->modService->getPublishedTrackMods();

        return view('admin.published-track-mods.index', [
                'publishedTrackMods' => $publishedTrackMods]
        );
    }
}
