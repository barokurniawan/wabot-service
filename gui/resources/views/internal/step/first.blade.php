<div class="col-md-12 col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="row d-flex justify-content-center">
                <div class="col-sm-4">
                    <div class="input-group mb-2">
                        <span class="input-group-text">+62</span>
                        <input id="txt_phone_number" type="text" class="form-control" placeholder="822xxx">
                        <small class="form-hint">
                            <ul>
                                <li>Your telephone number must be registered on whatsapp</li>                                        
                                <li>Write phone number without +62 (write number only)</li>                                        
                            </ul>
                        </small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <button id="btnContinue" type="button" class="btn btn-pill btn-primary">Continue</button>
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
        loadingBar = $("#loadingBar");
        loadingBar.hide();

        btnContinue.click(function(){
            loadingBar.show();
            btnContinue.prop('disabled', true);

            registration(function(){
                btnContinue.prop('disabled', false);
                loadingBar.fadeOut();
            });
        });
    });

    function registration(doneCallback = null){
        var phone = $("#txt_phone_number").val();

        if(phone == "" || phone == null){
            alert('Phone number is required');
            doneCallback();
            return;
        }

        $.get('{{ route("ajax_validate_phone") }}', {phone: phone}, 
        function(response){
            if(response.info == false){
                alert(response.message);
                doneCallback();
                return;
            }
        }).then(function(res){
            if(res.info){
                $.post('{{ route("api.registration") }}', {phone: phone, user_id: '{{ $userID }}'}, 
                function(response){
                    if(response.info || response.status_code == 101){
                        window.location.assign('{{ route("internal_service_new") }}?step=2&cl=' + phone);
                        return;
                    }
                }).always(function(){
                    if(doneCallback != null){
                        doneCallback();
                    }
                });
            }
        }).fail(function(err){
            alert(err.statusText);
        }).always(function(){
            if(doneCallback != null){
                doneCallback();
            }
        });
    }
</script>
@endpush