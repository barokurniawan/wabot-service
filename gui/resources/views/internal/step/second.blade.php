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
                    <p>Scan the QRCode to continue</p>
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
        var imageQR = $("#imageQR"),
        intervalCheck = null,
        loadingBar = $("#loadingBar");
        loadingBar.hide();

        doChecking();
        intervalCheck = setInterval(doChecking, 5000);

        function doChecking(){
            $.post('{{ route("api.qrcode") }}', {phone: '{{ $client_phone }}'}, function(res){
                if(res.info){
                    imageQR.attr('src', res.data.base64);
                }

                if(res.status_code == 100){
                    clearInterval(intervalCheck);
                    window.location.assign('{{ route("internal_service_new") }}?step=3&cl={{ $client_phone }}');
                }
            });
        }
    });
</script>
@endpush