<?php


echo "EXERCICIO 1";
echo "<br>";
echo "<br>";
echo "teste";
echo "<br>";
echo "<br>";

$url = "users/create";
$url2 = "users.create.pedro.teste";

$new_url = explode("/", $url);
$new_url2 = explode(".", $url2);

print_r($new_url);
echo "<br>";
print_r($new_url2);
echo "<br>";

echo "<br>";
echo "<br>";
echo "EXERCICIO 2";
echo "<br>";
echo "<br>";

$path = "Pedro/estudos_05-26/users/create";

$path_parts = explode("/", $path);

for ($i = 0; $i < count($path_parts); $i++) {
  echo $path_parts[$i];
  echo "<br>";
}


echo "<br>";
echo "<br>";
echo "EXERCICIO 3";
echo "<br>";
echo "<br>";

$segments = ["users", "create", "id", "10"];

echo count($segments);



echo "<br>";
echo "<br>";
echo "<br>";
echo "EXERCICIO 4";
echo "<br>";
echo "<br>";

$segments2 = ["users", "create"];

if (count($segments2) < 3) {
  echo "rota simples";
}


echo "<br>";
echo "<br>";
echo "<br>";
echo "EXERCICIO 5";
echo "<br>";
echo "<br>";

$segments3 = ["Pedro", "projeto", "users", "create"];

$segments3_tratado = array_slice($segments3, 2);

print_r($segments3_tratado);


echo "<br>";
echo "<br>";
echo "<br>";
echo "EXERCICIO 6";
echo "<br>";
echo "<br>";

$segments6 = ["Pedro", "projeto", "users", "edit", "10"];

$segments6_tratado = array_slice($segments6, 2, 2);

print_r($segments6_tratado);


echo "<br>";
echo "<br>";
echo "<br>";
echo "EXERCICIO 7";
echo "<br>";
echo "<br>";

$url7 = "/Carlos/Pedro/projeto/users/create";

$url7_exploded = explode("/", $url7);
$url7_exploded_tratado = array_slice($url7_exploded, 4, 2);

$controller = $url7_exploded_tratado[0];
$action = $url7_exploded_tratado[1];

echo $controller;
echo "<br>";
echo $action;