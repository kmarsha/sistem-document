<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use App\Models\DocumentDetail;
use Illuminate\Support\Facades\Auth;

class RemarkController extends Controller
{
    public function remarkList()
    {
        $documents = Document::whereNotNull('remark')->get();

        return view('documents.remark', compact('documents'));
    }

    public function remark(Request $request, Document $document)
    {
        try {
            $mark = $request->mark;
            $number = $document->document_no;
            $nasabah = $request->nasabah;

            // return response()->json([
            //     'doc' => $document,
            //     'req' => $request->nasabah,
            //     // 'detail' => $detail,
            // ]);

            $document->update([
                'status' => $mark,
                'remark' => $mark,
            ]);

            // $detail = DocumentDetail::where('document_no', $number)->get();

            // if ($detail[0]['document_no'] == $number) {
                DocumentDetail::create([
                    'document_no' => $number,
                    'nama_nasabah' => $nasabah,
                    'amount' => 1,
                ]);
            // }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
