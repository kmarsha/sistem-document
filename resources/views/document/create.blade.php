@extends('layouts.app', ['title' => 'Create Document Page'])

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="card">
      <div class="card-body">
        <h1 class="text-center h1 m-4">New Document</h1>
        <form action="{{ route('document.store') }}" method="post">
          @csrf
          <div class="mb-3 row">
            <label for="staticDocumentSubject" class="col-sm-2 col-form-label">Document Subject</label>
            <div class="col-sm-10">
              <input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror" value="{{ old('subject') }}" id="staticDocumentSubject">
              @error('subject')
                  <span class="text-danger text-end row" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
          </div>
          <div class="mt-4 row">
            <button class="btn btn-primary" type="submit">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection