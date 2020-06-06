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
                        <input type="text" class="form-control" placeholder="822xxx">
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
                    <textarea class="form-control" name="example-textarea-input" rows="5" placeholder="Content..">
Test Message..

Send by wabot service at {{ \Carbon\Carbon::now()->format('d/m/Y') }}
                    </textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-center mt-4">
                    <button disabled type="button" class="btn btn-pill btn-primary">Send</button>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-sm-4" style="margin-top: 20px;">
                    <div class="progress progress-sm">
                        <div class="progress-bar progress-bar-indeterminate"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>