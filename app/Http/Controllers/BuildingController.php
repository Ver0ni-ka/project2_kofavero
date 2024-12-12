<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Architects;
use App\Models\Building;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;


class BuildingController extends Controller implements HasMiddleware
{
    // call auth middleware
    public static function middleware(): array
    {
        return [
        'auth',
        ];
    }

    // display all Books
    public function list(): View
    {
    $items = Building::orderBy('name', 'asc')->get();
    return view(
    'building.list',
    [
    'title' => 'Buildings',
    'items' => $items
    ]
    );
    }

    // display new Book form
    public function create(): View
    {
        $architects = Architects::orderBy('name', 'asc')->get();
        return view(
        'building.form',
        [
        'title' => 'Add new building',
        'building' => new Building(),
        'architects' => $architects,
        ]
        );
    }

    // create new Book entry
    public function put(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
        'name' => 'required|min:3|max:256',
        'architect_id' => 'required',
        'description' => 'nullable',
        'year' => 'numeric',
        'image' => 'nullable|image',
        'display' => 'nullable',
        ]);
        $building = new Building();
        $building->name = $validatedData['name'];
        $building->architect_id = $validatedData['architect_id'];
        $building->description = $validatedData['description'];
        $building->year = $validatedData['year'];
        $building->display = (bool) ($validatedData['display'] ?? false);

        if ($request->hasFile('image')) {
            // here you can add code that deletes old image file when new one is uploaded
             $uploadedFile = $request->file('image');
             $extension = $uploadedFile->clientExtension();
             $name = uniqid();
             $building->image = $uploadedFile->storePubliclyAs(
             '/',
             $name . '.' . $extension,
             'uploads'
             );
            }

        $building->save();
        return redirect('/buildings');
    }

    // display Book edit form
    public function update(Building $building): View
    {
    $architects = Architects::orderBy('name', 'asc')->get();
    return view(
    'building.form',
    [
    'title' => 'Rediģēt grāmatu',
    'building' => $building,
    'architects' => $architects,
    ]
    );
    }
    // update Book data
    public function patch(Building $building, Request $request): RedirectResponse
    {
    $validatedData = $request->validate([
    'name' => 'required|min:3|max:256',
    'architect_id' => 'required',
    'description' => 'nullable',
    'year' => 'numeric',
    'image' => 'nullable|image',
    'display' => 'nullable',
    ]);
    $building->name = $validatedData['name'];
    $building->architect_id = $validatedData['architect_id'];
    $building->description = $validatedData['description'];
    $building->year = $validatedData['year'];
    $building->display = (bool) ($validatedData['display'] ?? false);
    if ($request->hasFile('image')) {
        // here you can add code that deletes old image file when new one is uploaded
         $uploadedFile = $request->file('image');
         $extension = $uploadedFile->clientExtension();
         $name = uniqid();
         $building->image = $uploadedFile->storePubliclyAs(
         '/',
         $name . '.' . $extension,
         'uploads'
         );
        }
    $building->save();
    return redirect('/buildings/update/' . $building->id);
    }

    // delete Book
    public function delete(Building $building): RedirectResponse
    {
        if ($building->image) {
            unlink(getcwd() . '/images/' . $building->image);
            }
        // delete the image file too
        $building->delete();
        return redirect('/buildings');
    }



}
