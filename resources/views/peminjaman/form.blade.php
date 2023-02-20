<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">Form Peminjaman</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form id="form-action" action="{{ $peminjaman->kode ? route('peminjaman.update', $peminjaman->kode) : route('peminjaman.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @if ($peminjaman->kode)
                @method('put')
            @endif
            <div class="form-group">
                <label for="judul">Nama Peminjaman</label>
                <input type="text" value="{{ $peminjaman->user_id }}" class="form-control" id="nama" placeholder="Nama Peminjaman" name="user_id">
            </div>
            <div class="form-group">
                <label for="bukus">Judul Buku</label>
                <select class="form-control" multiple="multiple" name="bukus_id[]" id="bukus">
                    
                </select>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="author">Lama Peminjaman</label>
                    <input type="number" value="{{ $peminjaman->durasi }}" class="form-control" id="durasi" placeholder="Lama Peminjaman" name="durasi">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div> 