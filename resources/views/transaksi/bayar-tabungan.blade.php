<div class="modal fade" id="modal-tabungan" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pembayaran Menggunakan Saldo Tabungan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formBayarTabungan" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <input type="hidden" id="userId" name="userId" value="">
                            <input type="hidden" id="tagihanId" name="tagihanId" value="">

                            <div class="form-group">
                                <label for="tabungan">Saldo Tabungan Saat Ini</label>
                                <input type="text" id="saldoTabungan" name="tabungan" class="form-control"
                                    readonly></input>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                    <button type="button" class="btn btn-primary"
                        onclick="konfirmasiPembayaranTabungan($('#userId').val(), $('#tagihanId').val())">Bayar</button>
                </div>
            </form>
        </div>
    </div>
</div>
