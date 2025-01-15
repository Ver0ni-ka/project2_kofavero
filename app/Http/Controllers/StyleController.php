<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Style;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;





class StyleController extends Controller implements HasMiddleware
{
    
    public function list(): View
    {
        $items = Style::orderBy('name', 'asc')->get();
        return view(
            'style.list', 
            [
            'title' => 'Styles',
            'items' => $items,
        ]);
    }

    // display new Style form
    public function create(): View
    {
        return view(
            'style.form',
            [
                'title' => 'Add new style',
                'style' => new Style()
            ]
        );
    }


    public function put(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $style = new Style();
        $style->name = $validatedData['name'];
        $style->description = $validatedData['description'] ?? null;
        $style->save();

        return redirect('/styles');
    }

// display Style editing form
    public function update(Style $style): View
    {
        return view(
            'style.form',
            [
                'title' => 'Edit Style',
                'style' => $style
            ]
        );
    }

    // update existing Author data
public function patch(Style $style, Request $request): RedirectResponse
{
 $validatedData = $request->validate([
 'name' => 'required|string|max:255',
 'description' => 'nullable',
 ]);
 $style->name = $validatedData['name'];
 $style->description = $validatedData['description'] ?? null;
  $style->save();
 return redirect('/styles');
}


    public function delete(Style $style): RedirectResponse
{
    $style->delete();
    return redirect('/styles');
}

    public static function middleware(): array
    {
        return [
            'auth',
        ];
    }
}
