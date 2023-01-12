<div class="modal" id="modal_cancel_requisition" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cancelar Requisicion</h5>              
            </div>
            <form action="{{ route('recruitment.requisitions.cancel') }}" id="modal_cancel_requisition_form" method="post">

                <div class="modal-body">
                    <b><span id="modal_requisition_text_cancel"></span></b>
                    @csrf
                    <input type="hidden" name="requisition_id" id="requisition_id_cancel">
                    <div class="form-group">
                        <label for="">Motivo Cancelacion</label>
                        <textarea name="cancelation_reason" id="cancelation_reason" class="form-control" required></textarea>
                    </div>                
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="$('#modal_cancel_requisition').modal('hide')">Cerrar</button>
                    <button class="btn btn-danger" >Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>