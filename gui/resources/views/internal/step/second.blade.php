<div class="col-md-12 col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <img id="imageQR" src="" alt="">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <p>Scan the QRCode make sure it's work like a charm then click continue</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <button id="btnContinue" disabled type="button" class="btn btn-pill btn-primary">Continue</button>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-sm-4" style="margin-top: 20px;">
                    <div class="progress progress-sm" id="loadingBar">
                        <div class="progress-bar progress-bar-indeterminate"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('extended_js')
<script>
    $(document).ready(function(){
        var btnContinue = $("#btnContinue"),
        imageQR = $("#imageQR"),
        loadingBar = $("#loadingBar");
        loadingBar.hide();

        setInterval(() => {
            $.post('{{ route("api.qrcode") }}', {phone: '085882174015'}, function(res){
                if(res.info){
                    imageQR.attr('src', res.data.base64);
                }
            });
        }, 5000);

        btnContinue.click(function(){
            loadingBar.show();
            btnContinue.prop('disabled', true);

            window.location.assign('{{ route("internal_service_new") }}?step=3');
        });
    });
</script>
@endpush