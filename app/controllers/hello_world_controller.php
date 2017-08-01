<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
      echo 'Hello World!';
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      View::make('helloworld.html');
    }

    public static function resepti(){
      // Testaa koodiasi täällä
      View::make('suunnitelmat/resepti.html');
    }

    public static function lista(){
      // Testaa koodiasi täällä
      View::make('suunnitelmat/lista.html');
    }

    public static function muokkaa(){
      // Testaa koodiasi täällä
      View::make('suunnitelmat/muokkaa.html');
    }

    public static function etusivu(){
      // Testaa koodiasi täällä
      View::make('suunnitelmat/etusivu.html');
    }
  }
