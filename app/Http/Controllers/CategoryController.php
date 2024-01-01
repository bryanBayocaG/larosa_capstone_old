<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function update(Request $request, $id)
    {
        $data = Category::find($id);
        $data->name = $request->NewCategName;

        $data->description = $request->NewDescription;
        $data->save();
        return redirect()->back()->with('message', 'Category Updated Succesfully');
    }
}
