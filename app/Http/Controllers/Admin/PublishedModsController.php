<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mod;
use App\Services\ModService;
use Illuminate\Http\Request;

class PublishedModsController extends Controller
{
    private ModService $modService;

    public function __construct(ModService $modService) {
        $this->modService = $modService;
    }

    public function store(Mod $mod)
    {
        $this->modService->publishMod($mod->id);

        return redirect()->back()->with('success', 'Car Mod has been published');
    }

    public function destroy(Mod $mod)
    {
        $this->modService->unpublishMod($mod->id);

        return redirect()->back()->with('success', 'Car Mod has been unpublished');
    }
}
