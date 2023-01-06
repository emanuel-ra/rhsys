const requisition = {
    modal:{
        cancelation:{
            open: (id) => {
                const requisition_name = document.getElementById("requisition_name").getAttribute('data-title');;
                $("#modal_cancel_requisition").modal('show')
                document.getElementById("modal_requisition_text").value = requisition_name;
                document.getElementById("requisition_id").value = id;
            } 
        }
    }
}