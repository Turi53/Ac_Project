<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarModRequest;
use App\Models\CarMod;
use App\Services\AuthorService;
use App\Services\MakeService;
use App\Services\ModService;
use Illuminate\Http\Request;
use Throwable;

class CarModController extends Controller
{
    private ModService $modService;
    private MakeService $makeService;
    private AuthorService $authorService;

    public function __construct(ModService $modService, MakeService $makeService, AuthorService $authorService) {
        $this->modService = $modService;
        $this->makeService = $makeService;
        $this->authorService = $authorService;
    }

    public function index()
    {
        return view('admin.car-mods.index');
    }

    public function create()
    {
        return view('admin.car-mods.create', [
            'carMod' => new CarMod,
            'makes' => $this->makeService->getAllMakes(),
            'authors' => $this->authorService->getAllAuthors()
        ]);
    }

    public function store(StoreCarModRequest $request)
    {
        $carData = $request->safe()->only([
            'model',
            'year_of_manufacture',
            'power',
            'torque',
            'zero_to_100',
            'weight',
            'top_speed',
            'make_id'
            ]);

        $modData = $request->safe()->only([
            'description',
            'download_link',
            'is_premium',
            'author_id',
        ]);

        try {
            $this->modService->createCarMod($carData, $modData);
            return redirect()->route('admin.car-mods.index')
                ->with('success', 'Car mod created successfully');
        } catch(Throwable $e) {
            report($e);
            return redirect()->back()
                ->with('error', 'Something went wrong');
        }
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
