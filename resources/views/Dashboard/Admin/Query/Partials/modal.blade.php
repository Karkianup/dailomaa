<div class="modal fade bd-example-modal-lg" id="modal-{{ $data->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Details of Query<span class="member"></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">

                            <div>
                                <label for="subject" class="bmd-label-floating"> Subject</label>
                                <input id="subject" type="text" class="form-control" readonly
                                    value="{{ $data->subject }}">

                            </div>
                            <div>
                                <label for="sender" class="bmd-label-floating"> Sender</label>
                                <input id="sender" type="text" class="form-control" readonly
                                    value="{{ $data->name }}">

                            </div>
                            <div>
                                <label for="email" class="bmd-label-floating">Sender Email</label>
                                <input id="email" type="text" class="form-control" readonly
                                    value="{{ $data->email }}">

                            </div>

                            <div>
                                <label for="message" class="bmd-label-floating"> Message</label>
                                <textarea class="form-control" id="message" readonly
                                    name="message">{{ $data->message }}</textarea>

                            </div>

                        </div>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
