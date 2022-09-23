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
