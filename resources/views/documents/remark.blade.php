@extends('layouts.app', ['title' => 'Remark Document Page'])

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <p class="text-start">
        <a href="{{ route('documents.list') }}" class="btn btn-default">Unremarked Document</a>
      </p>
    
    @forelse($documents as $document)
      <div class="mt-2">
        <div class="card" style="width: 100%;">
          <div class="card-body">
            <h5 class="card-title">{{ $document->document_no }} <div id="status" class="badge @if($document->status == 'approve') bg-success @else bg-danger @endif text-capitalize float-end">{{ $document->remark }}</div></h5>
            <p class="card-text">{{ $document->document_subject }}</p>
          </div>
        </div>
      </div>
    @empty
      <div class="">
        <h1 class="text-center" style="">There is No Document Remarked.</h1>
        <p class="text-center">
          <a href="{{ route('documents.list') }}" class="btn btn-primary mb-4">Remark Document</a>
        </p>
      </div>
    @endforelse
  </div>
</div>

@endsection