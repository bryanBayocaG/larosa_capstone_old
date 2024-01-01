<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function update(Request $request, $id)
    {

        $data = Size::find($id);
        $data->name = $request->NewCategName;
        $data->description = $request->NewDescription;
        $data->save();
        return redirect()->back()->with('message', 'Size Updated Succesfully');
    }
}
