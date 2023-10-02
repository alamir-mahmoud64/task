<?php

namespace App\Http\Controllers;

use App\Imports\QRImport;
use chillerlan\QRCode\QRCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class QRController extends Controller
{
    public function generateQR(Request $request)
    {
        $validated = $request->validate([
            'qr_data_file'=>'required|file|mimes:xls'
        ]);
        $collection = Excel::toCollection(new QRImport, $request->file('qr_data_file'))->first();
        $qrObj = (new QRCode);
//        return view('qr',compact('collection',));



        $pdf = App::make('dompdf.wrapper');
        $customPaper = array(0,0,130,300);
        $pdf->setPaper($customPaper,'landscape');
        $pdf->loadView('qr',compact('collection','qrObj'));
        return $pdf->download("QR_Data.pdf");
    }
}
