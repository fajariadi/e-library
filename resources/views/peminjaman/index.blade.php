@extends('layouts.master')
@push('css')
<link rel="stylesheet" href="{{ asset('lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('lte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
<link rel="stylesheet" href="{{ asset('lte/plugins/toastr/toastr.min.css') }}">
@endpush

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Peminjaman</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h3 class="card-title">DAFTAR PEMINJAMAN</h3>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" class="float-sm-right btn btn-xs btn-primary btn-add"><i class="fa fa-plus"></i> Tambah Pinjaman</button>
                    </div>
                </div>
            </div> 
            <div class="card-body">
              {{ $dataTable->table() }}
            </div>
          </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

    <div class="modal fade" id="modalAction">
        <div class="modal-dialog modal-lg">
            
        </div>
    </div>
  @endsection

  @push('js')
    
    <script src="{{ asset('lte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('lte/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('lte/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('lte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
     <script src="{{ asset('lte/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('lte/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{ asset('lte/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    <script src="{{ asset('lte/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    {{ $dataTable->scripts() }}
    <script>
        $('.btn-add').on('click', function(){
            $.ajax({
                method: 'get',
                url: `{{ url('peminjaman/create') }}`,
                success: function(res){
                    $('#modalAction').find('.modal-dialog').html(res)
                    $('#modalAction').modal('show')
                    store()
                }
            })
        })

        function store(){
            $('#formAction').on('submit', function (e) {
                e.preventDefault()
                const _form = this
                const formData = new FormData(_form)
                const url = this.getAttribute('action')

                $.ajax({
                    method: 'POST',
                    url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res){
                        window.LaravelDataTables["peminjaman-table"].ajax.reload()
                        $('#modalAction').modal('hide')
                        toastr.success(res.message)
                    },
                    error: function(res){
                        let errors = res.responseJSON?.errors
                        if (errors) {
                            toastr.error(res.message)
                        }
                    }
                })
            })
        }

        $('#bukus-table').on('click', '.action', function(){
            let data = $(this).data()
            let id = data.id
            let jenis = data.jenis

            if(jenis == 'delete'){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: 'DELETE',
                            url: `{{ url('buku/') }}/${id}`,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(res){
                                window.LaravelDataTables["peminjaman-table"].ajax.reload()
                                Swal.fire(
                                    'Deleted!',
                                    res.message,
                                    res.status
                                )
                            }
                        })
                    }
                })
            }else{
                $.ajax({
                    method: 'get',
                    url: `{{ url('buku/') }}/${id}/edit`,
                    success: function(res){
                        $('#modalAction').find('.modal-dialog').html(res)
                        $('#modalAction').modal('show')
                        store()
                    }
                })
            }
        })
    </script>
@endpush