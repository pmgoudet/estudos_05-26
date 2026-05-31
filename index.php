<?php


// URL atual
$url = $_SERVER['REQUEST_URI'];
// Pega apenas o path
$path = parse_url($url, PHP_URL_PATH);
// Remove barras extras
$path = trim($path, '/');
// Quebra a URL em partes
$segments = explode('/', $path);
// remove o prefixo do projeto
$base = 'Pedro/estudos_prealternance/estudos_05-26';
$baseSegments = explode('/', trim($base, '/'));


if (array_slice($segments, 0, count($baseSegments)) === $baseSegments) {
  $segments = array_slice($segments, count($baseSegments));
}


echo "<pre>";
print_r($segments);
print_r($base);
print_r($baseSegments);
echo "</pre>";

$controller = $segments[0] ?? null;
$action = $segments[1] ?? null;


function rota(string $rota, callable $f)
{
  if ($_SERVER['REQUEST_URI'] == $rota) {
    $f();
    exit();
  }
}

// rota("/Pedro/estudos_prealternance/estudos_05-26/", function () {
//   echo "funciona";
//   header('/Pedro/estudos_prealternance/estudos_05-26/users/add');
//   exit();
// });

// rota("/Pedro/estudos_prealternance/estudos_05-26/users/add", fn() => require "controllerUser.php");

// rota("/Pedro/estudos_prealternance/estudos_05-26/users", function () {
//   echo "pagina users";
// });