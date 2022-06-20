@extends('layouts.app', ['title' => 'Document Page'])

@section('content')
<div class="container">
  <div class="row justify-content-center">
    
    @approver
      <p class="text-start">
        <a href="{{ route('documents.remark-list') }}" class="btn btn-default">Remarked Document</a>
      </p>
    @endapprover

    @if($count >= 1)
      @maker
        <p class="text-end">
          <a href="{{ route('document.create') }}" class="btn btn-primary mb-2" style="widht: 100%;">Create Document</a>
        </p>
      @endmaker
    @endif

    @forelse($documents as $document)
      <div class="mt-2">
        <div class="card" style="width: 100%;">
          <div class="card-body">
            <h5 class="card-title">{{ $document->document_no }} <div id="status" class="badge @approver bg-secondary @endapprover @maker @if($document->status == 'approve' || $document->status == 'on progress') bg-success @elseif($document->status == 'reject') bg-danger @endif @endmaker float-end text-capitalize"> @approver @if($document->status == 'on progress') Unremarked @endif @endapprover
              @maker {{ $document->status }} @endmaker
            </div></h5>
            <p class="card-text">{{ $document->document_subject }}</p>

            @maker
              <div class="row float-end">
                <div class="col-6">
                  <a href="{{ route('document.edit', $document->document_no) }}"><button class="btn btn-warning">Edit</button></a>
                </div>
                <div class="col-6">
                  <form action="{{ route('document.destroy', $document->document_no) }}" method="post">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger">Delete</button>
                  </form>
                </div>
              </div>
            @else
              <button class="btn btn-primary" onclick="remarkModal('{{ $document->document_no }}')">Take Action</button>
            {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
            @endmaker
          </div>
        </div>
      </div>
    @empty
      @maker
        <div class="">
          <h1 class="text-center" style="">You haven't create any document yet.</h1>
          <p class="text-center">
            <a href="{{ route('document.create') }}" class="btn btn-primary mb-4">Create Document</a>
          </p>
        </div>
      @else
        <div class="">
          <h1 class="text-center" style="">There is No Document Available.</h1>
          {{-- <p class="text-center">
            <a href="{{ route('documents.list') }}" class="btn btn-primary mb-4" style="width: 100%;">Remark Document</a>
          </p> --}}
        </div>
      @endmaker
    @endforelse
  </div>
</div>

  @include('documents._remarking')
@endsection

@push('js')
<script>
  function remarkModal(id) {
    $('#remark-modal').modal('show');
    $('#doc-id').val(id);
  }
</script>
@endpush