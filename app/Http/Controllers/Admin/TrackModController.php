<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTrackModRequest;
use App\Http\Requests\UpdateTrackModRequest;
use App\Models\TrackMod;
use App\Services\AuthorService;
use App\Services\ModService;
use Throwable;

class TrackModController extends Controller
{
    private ModService $modService;
    private AuthorService $authorService;

    public function __construct(ModService $modService, AuthorService $authorService) {
        $this->modService = $modService;
        $this->authorService = $authorService;
    }

    public function index()
    {
        $trackMods = $this->modService->getAllTrackMods();

        return view('admin.track-mods.index', ['trackMods' => $trackMods]);
    }

    public function create()
    {
        return view('admin.track-mods.create', [
            'trackMod' => new TrackMod(),
            'authors' => $this->authorService->getAllAuthors()
        ]);
    }

    public function store(StoreTrackModRequest $request)
    {
        $trackData = $request->safe()->only([
            'name',
            'distance',
            'number_of_pits',
            'country',
            'city',
        ]);

        $modData = $request->safe()->only([
            'description',
            'download_link',
            'is_premium',
            'author_id',
        ]);

        try {
            $this->modService->createTrackMod($trackData, $modData);
            return redirect()->route('admin.track-mods.index')
                ->with('success', 'Track mod created successfully');
        } catch(Throwable $e) {
            report($e);
            return redirect()->back()
                ->with('error', 'Something went wrong');
        }
    }

    public function show(TrackMod $trackMod)
    {
        //
    }

    public function edit(TrackMod $trackMod)
    {
        return view('admin.track-mods.edit', [
            'trackMod' => $trackMod,
            'authors' => $this->authorService->getAllAuthors()
        ]);
    }

    public function update(UpdateTrackModRequest $request, TrackMod $trackMod)
    {
        $trackData = $request->safe()->only([
            'name',
            'distance',
            'number_of_pits',
            'country',
            'city',
        ]);

        $modData = $request->safe()->only([
            'description',
            'download_link',
            'is_premium',
            'author_id',
        ]);

        try {
            $this->modService->updateTrackMod($trackMod->id, $trackData, $modData);
            return redirect()->route('admin.track-mods.index')
                ->with('success', 'Track mod Updated successfully');
        } catch(Throwable $e) {
            report($e);
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function destroy(TrackMod $trackMod)
    {
        $this->modService->deleteTrackMod($trackMod->id);

        return redirect()->back()->with('success', 'The Track has been successfully deleted');
    }
}
