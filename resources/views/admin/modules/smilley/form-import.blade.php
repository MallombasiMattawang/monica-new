<div class="col-md-6">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Import</h3>
        </div>
        @if ($errors->any())
        <div class="col-md-12">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        @endif
        <form role="form" action="{{url('ped-panel/submit-import-smilley')}}" method="POST" enctype="multipart/form-data" onsubmit="disableSubmitButton()">
            @csrf
            <div class="box-body">
                <div class="form-group">
                    <label for="fileImport">File Import <span class="text-red">*</span></label>
                    <input type="file" id="fileImport" class="form-control" name="file">
                    <p class="help-block">File bertipe xlsx dan max size 5 Mb.</p>
                </div>

            </div>

            <div class="box-footer">
                <button type="submit" id="submit-button" class="btn btn-primary pull-right">Submit</button>
            </div>
        </form>
    </div>
</div>

<div class="col-md-6">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-info"></i> Keterangan</h3>
        </div>
        <div class="box-body">
            <p>Sebelum melakukan import data, pastikan anda telah melakukan prosedur berikut ini : </p>
            <ol>
                <li>Mengunduh Format Excel pada menu Tabel referensi </li>
                <li>Mengisi tiap row data pada file excel sesuai ketentuan dan format data tiap kolomnya</li>
                <li>Proses import data akan gagal jika terjadi hal berikut ini :
                    <ol>

                        <li>Format data tidak sesuai dan atau kolom tidak sesuai</li>
                        <li>Ukuran file terlalu besar dan atau file mengalami corupt</li>
                        <li>Jaringan Internet tidak stabil</li>
                    </ol>
                </li>

            </ol>
        </div>

    </div>
</div>

<script>
    function disableSubmitButton() {
        var submitButton = document.getElementById("submit-button");
        submitButton.disabled = true;
        submitButton.innerHTML = "Loading...";
    }

</script>
