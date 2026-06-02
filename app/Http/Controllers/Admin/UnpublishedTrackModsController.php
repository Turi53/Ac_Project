<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ModService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class UnpublishedTrackModsController extends Controller
{
    private ModService $modService;

    public function __construct(ModService $modService) {
        $this->modService = $modService;
    }

    public function index()
    {
        $unpublishedTrackMods = $this->modService->getUnpublishedTrackMods();

        return view('admin.unpublished-track-mods.index', [
            'unpublishedTrackMods' => $unpublishedTrackMods]
        );
    }
}
