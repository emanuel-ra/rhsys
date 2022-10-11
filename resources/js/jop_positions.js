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
