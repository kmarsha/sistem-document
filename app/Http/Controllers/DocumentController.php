<?php

namespace App\Http\Controllers;

use App\Models\DocumentDetail;
use App\Models\Document;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role_id == '1') {
            $user = Auth::user()->username;
            $documents = Document::where('created_by', $user)->get();
            $count = Document::where('created_by', $user)->count();

            return view('documents.index', compact('documents', 'count'));
        } elseif (Auth::user()->role_id == '2') {
            $model = Document::whereNull('remark');
            $documents = $model->get();
            $count = $model->count();

            return view('documents.index', compact('documents', 'count'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('document.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required',
        ]);

        try {
            $subject = $request->subject;
            $date = Carbon::now()->format('Y_m_d');
            $val_subj_name = str_replace(' ', '_', strtolower($subject));
            $author = Auth::user()->username;

            $doc_no = "{$date}_{$val_subj_name}_{$author}";

            Document::insert([
                'document_no' => $doc_no,
                'document_subject' => ucwords($subject),
                'created_by' => $author,
                'created_at' => Carbon::now()->toDateTimeString(),
            ]);

            return redirect('/documents')->with('success', 'Saved Document Successfully!');
        } catch (\Throwable $th) {
            throw $th;
            // return back()->with('error', "Error: " . $th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        return view('document.edit', compact('document'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        try {
            $subject = $request->subject;
            $date = Carbon::now()->format('Y_m_d');
            $val_subj_name = str_replace(' ', '_', strtolower($subject));
            $author = Auth::user()->username;

            $doc_no = "{$date}_{$val_subj_name}_{$author}";
            
            $document->update([
                'document_no' => $doc_no,
                'document_subject' => ucwords($subject),
                'updated_by' => $author,
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);

            return redirect('/documents')->with('success', 'Saved Document Successfully!');
        } catch (\Throwable $th) {
            throw $th;
            // return back()->with('error', "Error: " . $th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        $document->delete();

        return redirect('/documents')->with('success', 'Deleted Document Successfully!');
    }
}
