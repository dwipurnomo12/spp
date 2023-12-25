<div class="modal fade" id="modal-penarikan" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Menu Penarikan / Pencairan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/penarikan" method="POST" id="penarikanForm">
                @csrf

                <div class="modal-body">
                    <div id="errorAlert" class="alert alert-danger" style="display: none;"></div>
                    <div class="row">
                        <div class="col">
                            <input type="hidden" id="tabungan_id">
                            <div class="form-group">
                                <label for="user_id">Pilih Siswa <span style="color: red">*</span></label>
                                <select id="user_id" class="js-menu-penarikan" name="user_id" style="width: 100%">
                                    <option value="">Pilih Siswa</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">
                                            {{ $user->siswa->nm_siswa }} - {{ $user->siswa->kelas->kelas }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="tabungan">Saldo Tabungan</label>
                                        <input type="text" id="tabungan" name="tabungan" class="form-control"
                                            readonly></input>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="nominal">Nominal Penarikan <span
                                                style="color: red">*</span></label>
                                        <input type="text" id="nominal" name="nominal" class="form-control"
                                            required></input>
                                        @error('nominal')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-primary" id="simpanButton">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
