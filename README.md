![Travis (.org)](https://img.shields.io/travis/jsan5709/metamorphoser) ![GitHub issues](https://img.shields.io/github/issues/jsan5709/metamorphoser) ![GitHub](https://img.shields.io/github/license/jsan5709/metamorphoser)
# Metamorphoser :bug: :butterfly:

Es un librería diseñada para manipular arreglos asociativos (associative arrays) en varias etapas.

Aunque el principal uso que le doy es para procesar linea por linea archivos CSV.

## Instalación

Metamorphoser es compatible y testeado en PHP 7.3 y superiores.

Esta librería puede ser instalada a través de [composer](https://www.getcomposer.org) usando el siguiente comando:
```
composer require jsanbae/metamorphoser
```

## Partes del Metamorphoser
### Metamorphoser
Órgano encargado de orquestar el orden los Pipes(etapas) para la metamorfosis y entregar los datos "metamorfoseados", como así también los datos con errores y lo datos filtrados.
### Dataset
Entidad atómica en la cual se encapsula los datos, estructura necesaria para ser procesada dentro de la metamorfosis.
### Pipes
Órganos encargados de procesar los dataset. Se han definido 4 tipos, sin embargo, puedes crear los que tu quieras.
#### Arranger
Pipe encargada de dar estructura definida a lo datos
#### Mutator
Pipe encargada de modificar(formatear, limpiar, etc) la información.
#### Validator
Pipe encargada de validar la información, determina si información tiene errores. Colecciona los errores de la información.
#### Filter
Pipe encargada de quitar la información, mediante filtros.

## Ejemplo de uso
Favor ver archivos en directorio ./example

## Laravel Friendly :kissing_heart:

Si bien es una librería que no tiene dependencia directa con [Laravel Framework](https://laravel.com) puedes integrarla sin problemas en tus proyectos Laravel, con el siguiente comando:

```
php artisan make:metamorphoser myMetamorphoser
```
El comando creará los siguientes archivos base:
```
- app
  -- Metamorphosers
    --- myMorpher.php
    --- Arrangers
       ---- MyArranger.php
    --- Mutators
       ---- MyMutator.php
    --- Validators
       ---- MyValidator.php
    --- Filters
       ---- MyFilter.php
```
Implementado sería:

```
use App\Metamorphosers\myMorpher;
....
$metamorposer = new myMorpher();
$metamorposer->morph($data); 
//o desde un archivo
$file_path = "/mydir/data.csv";
$separator = ";";
$metamorposer->morphFromCSV($file_path, $separator);
```
Salida:
```
//Output
array(3) =>
 ["data"] => ['data processed']
 ["errors"] => ['data errors']
 ["filtered"] => ['data filtered']
```

## Contribución

Es librería sencilla hecha con amor :heart:, pero se que puede mejorar con contribuciones de quienes la usen.

Sugiere tus propias mejoras, te invito a discutirlas en "Issues" antes de enviar tus "Pull Requests".

Los "Pull requests" para bugs siempre son bienvenidos, por favor explica tu bug que estás intentando corregir en el mensaje.

Hay sólo algunas pruebas unitarias en el PHPUnit. Sería genial tener  más tests para obtener mayor cobertura en otros casos. Sientete libre en contribuir con eso.

## Disclaimer

No se me ocurrió otro nombre más rebuscado para esta librería (y puta que lo pensé)
