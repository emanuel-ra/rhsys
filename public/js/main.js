const GetBranches = (company_id,token,selector_results,base_url,selected_id=0) =>{
    $("#"+selector_results).html('');
    console.log(base_url);
    $.ajax({
        type:"POST"  ,
        data:`company_id=${company_id}&_token=${token}` ,
        dataType:"json" ,
        url:`${base_url}/ajax/branches`,
        success:function(result){            
            result.forEach(element => {
                selected = (selected_id == element.id) ? 'selected':'';
                $("#"+selector_results).append(`<option ${selected} value="${element.id}">${element.name}</option>`);
            });            
        }
    });
}

const GetStates = (country_id=151,token,selector_results,base_url,selected_id=0) =>{
    $("#"+selector_results).html('');
    $.ajax({
        type:"POST"  ,
        data:`country_id=${country_id}&_token=${token}` ,
        dataType:"json" ,
        url:`${base_url}/ajax/states`,
        success:function(result){            
            result.forEach(element => {
                selected = (selected_id == element.id) ? 'selected':'';
                $("#"+selector_results).append(`<option ${selected} value="${element.id}">${element.name}</option>`);
            });            
        }
    });
}


const GetJopPositions = (department_id,token,selector_results,base_url,selected_id=0) =>{
    $("#"+selector_results).html('');
    console.log(base_url);
    $.ajax({
        type:"POST"  ,
        data:`department_id=${department_id}&_token=${token}` ,
        dataType:"json" ,
        url:`${base_url}/ajax/jop/positions`,
        success:function(result){            
            result.forEach(element => {
                selected = (selected_id == element.id) ? 'selected':'';
                $("#"+selector_results).append(`<option ${selected} value="${element.id}">${element.name}</option>`);
            });            
        }
    });
}

const requisition = {
    modal:{
        cancelation:{
            open: ({id,title}) => {          
                $("#modal_cancel_requisition").modal('show')
                document.getElementById("modal_requisition_text_cancel").innerText = title;
                document.getElementById("requisition_id_cancel").value = id;
            } 
        },
        completed:{
            open: (id) => {
                $("#modal_complete_requisition").modal('show')
                document.getElementById("modal_requisition_text_complete").innerText = title;
                document.getElementById("requisition_id_complete").value = id;
            }
        }
        
    }
}