@extends('layouts.master')
@push('css')
<link rel="stylesheet" href="{{ asset('lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
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
              <li class="breadcrumb-item active">Buku</li>
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
                        <h3 class="card-title">DAFTAR BUKU</h3>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" class="float-sm-right btn btn-xs btn-primary btn-add"><i class="fa fa-plus"></i> Tambah Buku</button>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{ $dataTable->scripts() }}
    <script>
        $('.btn-add').on('click', function(){
            $.ajax({
                method: 'get',
                url: `{{ url('buku/create') }}`,
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
                        window.LaravelDataTables["bukus-table"].ajax.reload()
                        $('#modalAction').modal('hide')
                    }
                    // error: function(res){
                    //     let errors = res.responseJSON?.errors
                    //     $(_form).find('.text-danger.text-small').remove()
                    //     if (errors) {
                    //         for(const[key, value] of Object.entries(errors)){
                    //             $(`[name = '${key}']`).parent().append(`<span class="text-danger text-small">${value}</span>`)
                    //         }
                    //     }
                    // }
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
                                window.LaravelDataTables["bukus-table"].ajax.reload()
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