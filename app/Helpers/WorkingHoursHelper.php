<?php
function wh_format($value){
    $days = [
        'monday' => [] ,
        'tuesday' => [] ,
        'wednesday'  => [] ,
        'thursday' => [] ,
        'friday' => [] ,
        'saturday' => [] ,
        'sunday' => [] ,
    ];
    if($value==""){ $days = []; }

    $json = json_decode($value, true);

    foreach($json as $key => $value)
    {
        $days[$key] = [$value["enable"],$value["start"],$value["end"],$key];             
    }

    return $days;
}
function wh_short_format($value){
    if($value==""){return 'Sin horario configurado';}
    $json = json_decode($value, true);

    $days = [
        'monday' => [] ,
        'tuesday' => [] ,
        'wednesday'  => [] ,
        'thursday' => [] ,
        'friday' => [] ,
        'saturday' => [] ,
        'sunday' => [] ,
    ];
    
    $free_day = "";
    $same = [];
    $different = [];
    $last = null;
    $last_key = null;
    
    foreach($json as $key => $value)
    {
        if($value["enable"]){
            $days[$key] = [$value["enable"],$value["start"],$value["end"],$key];                      

        }else{
            $free_day = $key;
            unset($days[$key]);
        }        
    }
    $i=0;$o=0;
    foreach($days as $key => $value)
    {
        if($last_key!=null)
        {
            if( ($days[$last_key][1] == $days[$key][1]) && ($days[$last_key][2] == $days[$key][2])){
                $same[$i] = $value;
                $i++;
            }else{
                $different[$o] = $value;
                $o++;
            }
        }else{
            $same[$i] = $value;
            $i++;
        }             
        $last_key = $key;
    }   

    $x = "";
    array_walk($different, function($i) use (&$x){                
        $x.= " & ".Lang::get('days.'.$i[3]).' de '.$i[1].' a '.$i[2].', ' ;
    });   

    return Lang::get('days.'.$same[0][3]).' a '.Lang::get('days.'.$same[count($same)-1][3]).' de '.$same[0][1].' a '.$same[0][2].$x.' descansando el día '.Lang::get('days.'.$free_day).' de cada semana';
}
