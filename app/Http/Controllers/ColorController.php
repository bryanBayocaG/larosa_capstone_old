<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function update(Request $request, $id)
    {

        $data = Color::find($id);
        $data->name = $request->NewCategName;

        $data->save();
        return redirect()->back()->with('message', 'Color Updated Succesfully');
    }
}
