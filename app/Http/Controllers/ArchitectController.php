<?php

namespace App\Http\Controllers;

use App\Models\Architects;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;



class ArchitectController extends Controller implements HasMiddleware
{
    // display all Authors
    public function list(): View
    {
        $items = Architects::orderBy('name', 'asc')->get();
        return view(
            'architect.list', 
            [
            'title' => 'Architects',
            'items' => $items,
        ]);
    }

    // display new Author form
    public function create(): View
    {
        return view(
            'architect.form',
            [
                'title' => 'Add new architect',
                'architect' => new Architects()
            ]
        );
    }


    public function put(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $architect = new Architects();
        $architect->name = $validatedData['name'];
        $architect->save();

        return redirect('/architects');
    }

// display Author editing form
    public function update(Architects $architect): View
    {
        return view(
            'architect.form',
            [
                'title' => 'Edit Architect',
                'architect' => $architect
            ]
        );
    }

    // update existing Author data
public function patch(Architects $architect, Request $request): RedirectResponse
{
 $validatedData = $request->validate([
 'name' => 'required|string|max:255',
 ]);
 $architect->name = $validatedData['name'];
 $architect->save();
 return redirect('/architects');
}


    public function delete(Architects $architect): RedirectResponse
{
    $architect->delete();
    return redirect('/architects');
}

    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            'auth',
        ];
    }
}


