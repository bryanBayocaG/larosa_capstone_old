<?php

namespace App\Http\Controllers;

use App\Models\included_item;
use App\Models\item;
use App\Models\product_set;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;
// use PDF;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PrintController extends Controller
{
    public function singleItemPrint($id)
    {
        $singItem = item::find($id);
        $pdf = Pdf::loadView('admin.pdf', compact('singItem'))->setPaper('letter', 'portrait');
        return $pdf->stream('qrCode.pdf', array('Attachment' => false));
    }
    public function singleItemDL($id)
    {
        $singItem = item::find($id);
        $pdf = Pdf::loadView('admin.pdf', compact('singItem'))->setPaper('letter', 'portrait');
        return $pdf->download('qrCode.pdf');
    }
    public function setItemPrint($id)
    {
        $setItem = product_set::find($id);
        $includes = included_item::where('product_set_id', $id)->get();
        $pdf = Pdf::loadView('admin.pdf2', compact('setItem', 'includes'))->setPaper('letter', 'portrait');
        return $pdf->stream('qrSetCode.pdf', array('Attachment' => false));
    }
    public function setItemDL($id)
    {
        $setItem = product_set::find($id);
        $includes = included_item::where('product_set_id', $id)->get();
        $pdf = Pdf::loadView('admin.pdf2', compact('setItem', 'includes'))->setPaper('letter', 'portrait');
        return $pdf->download('qrSetCode.pdf');
    }
}
