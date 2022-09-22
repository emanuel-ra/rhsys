const GetBranches = (company_id,token,selector_results) =>{
    $("#"+selector_results).html('');
    $.ajax({
        type:"POST"  ,
        data:`company_id=${company_id}&_token=${token}` ,
        dataType:"json" ,
        url:"./ajax/branches",
        success:function(result){            
            result.forEach(element => {
                $("#"+selector_results).append(`<option value="${element.id}">${element.name}</option>`);
            });            
        }
    });
}

const GetStates = (country_id=151,token,selector_results) =>{
    $("#"+selector_results).html('');
    $.ajax({
        type:"POST"  ,
        data:`country_id=${country_id}&_token=${token}` ,
        dataType:"json" ,
        url:"./ajax/states",
        success:function(result){            
            result.forEach(element => {
                $("#"+selector_results).append(`<option value="${element.id}">${element.name}</option>`);
            });            
        }
    });
}
