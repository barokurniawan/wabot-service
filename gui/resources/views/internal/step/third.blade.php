<div class="col-md-12 col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <p>Let's make sure it is work by write some message!</p>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-sm-4">
                    <div class="input-group mb-2">
                        <span class="input-group-text">+62</span>
                        <input id="txt_phone" type="text" class="form-control" placeholder="822xxx">
                        <small class="form-hint">
                            <ul>
                                <li>Use other whatsapp number as receiver of test message</li>
                            </ul>
                        </small>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-sm-4">
                    <textarea class="form-control" id="txt_message" rows="5" placeholder="Content..">
Test Message..

Send by wabot service at {{ \Carbon\Carbon::now()->format('d/m/Y') }}
                    </textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-center mt-4">
                    <button id="btnContinue" type="button" class="btn btn-pill btn-primary">Send</button>
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
var txt_phone = $("#txt_phone"),
    txt_message = $("#txt_message"),
    loadingBar = $("#loadingBar"),
    btnContinue = $("#btnContinue");

$(document).ready(function(){
    loadingBar.hide();

    btnContinue.click(function(){
        btnContinue.prop('disabled', true);
        loadingBar.show();
        if(txt_phone.val() == ""){
            alert('Phone number is required');
            return false;
        }

        if(txt_message.val() == ""){
            alert('message is required');
            return false;
        }

        sendMessage(txt_phone.val(), txt_message.val(), function(r){
            btnContinue.prop('disabled', false);
            loadingBar.fadeOut();
        });
    });

    function sendMessage(ph, msg, doneCallback = null){
        $.post('{{ route("api.send-message") }}', {
            phone: ph, message: msg,
            cl: '085882174015'
        }, function(res){
            if(res.info){
                alert('it\'s work like a charm')
                window.location.assign('{{ route("home") }}');
            } else {
                alert(res.status);
            }
        }).done(function(res){
            if(doneCallback != null){
                doneCallback(res);
            }
        });
    }
});
</script>
@endpush