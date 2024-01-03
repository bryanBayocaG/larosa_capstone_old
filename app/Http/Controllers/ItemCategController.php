<?php

namespace App\Http\Controllers;

use App\Models\ItemCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemCategController extends Controller
{
    public function update(Request $request, $id)
    {
        $data = ItemCategory::find($id);
        $data->name = $request->NewCategName;

        $data->description = $request->NewDescription;
        $data->save();
        return redirect()->back()->with('message', 'Category Updated Succesfully');
    }
    public function addItemCategory(Request $request)
    {
        DB::table('item_categories')->insert([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->back()->with('message', 'Item Category added successfully.');
    }
}
