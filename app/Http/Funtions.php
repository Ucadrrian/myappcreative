<?php 
function getModulesArray(){
    $a=[
    '0'=>'Cmmics',
    '1'=>'Blog',
    '2'=>'Revisiones'
    ];
    return $a;
}

function getRoleUserArray($id){
    $roles=['0' =>'Usuario Normal','1'=>'Administrador'];
    return $roles[$id];
}

function getUserStatusArray($id){
    $status =['0'=>'Registrado','1'=>'Verificado','100'=>'Baneado'];
        return $status[$id];
}


