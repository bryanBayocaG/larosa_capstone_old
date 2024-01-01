<?php

namespace App\Http\Controllers;

use App\Models\ItemCategory;
use Illuminate\Http\Request;

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
}
