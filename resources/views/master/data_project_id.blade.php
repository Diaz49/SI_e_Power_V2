@extends('templates.app')
@section('content')

            <div class="card m-4">
                <div class="card-header">
                    <h4 class="card-title">Data Project ID</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        {!! $dataTable->table(['class' => 'display table table-striped table-hover table-responsive ' ]) !!}

                    </div>
                </div>
            </div>
  

    @push('scripts')
        {{ $dataTable->scripts() }}
    @endpush
@endsection
