<?php
//Definições Globais
require_once 'config/global.php';
//Carrego o controlador e executo a ação solicitada
if(isset($_GET["controller"])){
    //Carrego a instância do controlador correspondente
    $controllerObj=carregarControlador($_GET["controller"]);
    //Disparo a ação
    launchAction($controllerObj);
}else{
    //Carrego a instância do controlador default
    $controllerObj=carregarControlador(CONTROLLER_DEFAULT);
    //Disparo a ação
    launchAction($controllerObj);
}
function carregarControlador($controller){    
    switch ($controller) {
        case 'funcionarios':
            $strFileController=getcwd().'/controllers/funcionariosController.php';
            require_once $strFileController;
            $controllerObj=new FuncionariosController();
            break;
        default:
            $strFileController=getcwd().'/controllers/'.CONTROLLER_DEFAULT.'Controller.php';
            require_once $strFileController;
            $controllerObj=new FuncionariosController();
            break;
    }
    return $controllerObj;
}
function launchAction($controllerObj){
    if(isset($_GET["action"])){
        $controllerObj->run($_GET["action"]);
    }else{
        $controllerObj->run(DEFAULT_ACTION);
    }
}
/*
function carregarControlador($controller){
    //Crio o Nome do controller: exemplo, userController
    $controlador=ucwords($controller).'Controller';
    //Crio o Nome do arquivo do controller: exemplo, controller/userController.php
    $strFileController='controller/'.$controlador.'.php';
    //Se não houver controller com este nome de arquivo, 
    //carrego aquele definido como default
    if(!is_file($strFileController)){
        $strFileController='controller/'.ucwords(CONTROLLER_DEFAULT).'Controller.php';
    }
    //Carrego o arquivo onde o controller está definido:
    require_once $strFileController;
    //Crio o objeto
    $controllerObj=new $controlador();
    //retorno instância do objeto do controller
    return $controllerObj;
}
*/
?>