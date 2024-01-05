<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function update(Request $request, $id)
    {
        $data = Category::find($id);
        $data->name = $request->NewCategName;

        $data->description = $request->NewDescription;
        $data->save();
        return redirect()->back()->with('success', 'Set Category Updated Succesfully');
    }
    public function addSetCategory(Request $request)
    {
        DB::table('categories')->insert([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->back()->with('success', 'Set Category added successfully.');
    }
}
