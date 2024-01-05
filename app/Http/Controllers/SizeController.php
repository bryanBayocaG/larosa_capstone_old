<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SizeController extends Controller
{
    public function update(Request $request, $id)
    {

        $data = Size::find($id);
        $data->name = $request->NewCategName;
        $data->description = $request->NewDescription;
        $data->save();
        return redirect()->back()->with('success', 'Size Updated Succesfully');
    }
    public function addsize(Request $request)
    {
        DB::table('sizes')->insert([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->back()->with('success', 'Size added successfully.');
    }
}
