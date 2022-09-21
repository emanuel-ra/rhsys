const GetBranches = (company_id,token,selector_results) =>{
    $("#"+selector_results).html('');
    $.ajax({
        type:"POST"  ,
        data:`company_id=${company_id}&_token=${token}` ,
        dataType:"json" ,
        url:"./ajax/branches",
        success:function(result){
            
            let domElement;
            result.forEach(element => {
                //console.log(element.name);

                $("#"+selector_results).html(`<option value="${element.id}">${element.name}</option>`);
                //domOptions += domElement;

                

            });

            
        }
    });
}
