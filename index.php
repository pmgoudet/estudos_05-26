<?php

include "./controllerUser.php";


function rota(string $rota, callable $f)
{

  // URL atual
  $url = $_SERVER['REQUEST_URI'];
  $url = str_replace("/Pedro/estudos_prealternance/estudos_05-26/", "", $url);
  # $url_array = explode("/", $url);

  if ($url == $rota) {
    $f();
    exit();
  }
}

rota("users/add", function () {
  $controller = new ControllerUser(
    new ViewAddUser(),
    new ViewReadUser(),
    new ModelUser()
  );

  $controller->renderAdd();
});

rota("users/read", function () {
  $controller = new ControllerUser(
    new ViewAddUser(),
    new ViewReadUser(),
    new ModelUser()
  );

  $controller->renderRead();
});
