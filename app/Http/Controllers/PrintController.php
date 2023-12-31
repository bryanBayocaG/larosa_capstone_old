<?php

namespace App\Http\Controllers;

use App\Models\item;
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
}
