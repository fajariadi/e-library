<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">Form Buku</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form id="form-action" action="{{ route('buku.store') }}" method="post">
            @csrf
            {{-- @method('post') --}}
            <div class="form-group">
                <label for="judul">Judul Buku</label>
                <input type="text" class="form-control" id="judul" placeholder="Judul Buku" name="judul">
            </div>
            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" class="form-control" id="author" placeholder="Author" name="author">
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="author">Genre</label>
                        <input type="text" class="form-control" id="genre" placeholder="Genre" name="genre">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="gambar">Gambar</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="gambar" name="gambar">
                                <label class="custom-file-label" for="gambar">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" name="harga" class="form-control">
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="author">Jumlah Halaman</label>
                        <input type="number" class="form-control" id="jumlah_halaman" placeholder="Jumlah Halaman" name="jumlah_halaman">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="jumlah_buku">Jumlah Buku</label>
                        <input type="number" class="form-control" id="jumlah_buku" placeholder="Jumlah Buku" name="jumlah_buku">
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div> 