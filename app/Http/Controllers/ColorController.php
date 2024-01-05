<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ColorController extends Controller
{
    public function update(Request $request, $id)
    {

        $data = Color::find($id);
        $data->name = $request->NewCategName;

        $data->save();
        return redirect()->back()->with('success', 'Color Updated Succesfully');
    }
    public function addColor(Request $request)
    {
        DB::table('colors')->insert([
            'name' => $request->input('name'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->back()->with('success', 'Color added successfully.');
    }
}
