const requisition = {
    modal:{
        cancelation:{
            open: ({id,title}) => {          
                $("#modal_cancel_requisition").modal('show')
                document.getElementById("modal_requisition_text_cancel").innerText = title;
                document.getElementById("requisition_id_cancel").value = id;
            } 
        }        
    }
}