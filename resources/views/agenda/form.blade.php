<x-modal data-backdrop="static" data-keyboard="false" size="modal-lg">
    <x-slot name="title">
        Tambah
    </x-slot>

    @method('POST')

    <div class="row">
        <div class="col-md-12 col-12">
            <div class="form-group">
                <label for="nama_kegiatan">Nama Kegiatan</label>
                <input type="text" class="form-control" name="nama_kegiatan" id="nama_kegiatan"
                    placeholder="Masukkan nama kegiatan" autocomplete="off">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <div class="input-group datepicker" id="tanggal" data-target-input="nearest">
                    <input type="text" name="tanggal" class="form-control datetimepicker-input"
                        data-target="#tanggal" data-toggle="datetimepicker" autocomplete="off"
                        placeholder="{{ date('Y-m-d') }}" />
                    <div class="input-group-append" data-target="#tanggal" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <label for="waktu_mulai">Waktu</label>
                <div class="input-group timepicker" id="waktu_mulai" data-target-input="nearest">
                    <input type="text" name="waktu_mulai" class="form-control datetimepicker-input"
                        data-target="#waktu_mulai" data-toggle="datetimepicker" autocomplete="off"
                        placeholder="{{ date('H:m') }}" />
                    <div class="input-group-append" data-target="#waktu_mulai" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-6">
            <div class="form-group">
                <label for="kategori">Kategori</label>
                <select name="kategori" id="kategori" class="form-control select2"></select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="tempat_kegiatan">Tempat Kegiatan</label>
                <input type="text" class="form-control" name="tempat_kegiatan" id="tempat_kegiatan"
                    placeholder="Masukkan tempat kegiatan" autocomplete="off">
            </div>
        </div>
    </div>
    <x-slot name="footer">
        <button type="button" onclick="submitForm(this.form)" class="btn btn-sm btn-outline-info" id="submitBtn">
            <span id="spinner-border" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            <i class="fas fa-save mr-1"></i>
            Simpan</button>
        <button type="button" data-dismiss="modal" class="btn btn-sm btn-outline-danger">
            <i class="fas fa-times"></i>
            Close
        </button>
    </x-slot>
</x-modal>
