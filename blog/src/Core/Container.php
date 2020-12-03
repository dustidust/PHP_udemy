<?php

namespace App\Core;

use PDO;
use App\Post\PostsRepository;
use App\Post\PostsController;
use Exception;
use PDOException;

class Container
{

  private $receipts = [];
  private $instances = [];

  public function __construct()
  {
    $this->receipts = [
      'postsController' => function () {
        return new PostsController(
          $this->make('postsRepository')
        );
      },
      'postsRepository' => function () {
        return new PostsRepository(
          $this->make("pdo")
        );
      },
      'pdo' => function () {
        try {    // FÜR DEN FALL DAS SICH JEMAND EINLOGGEN MÖCHTE UND ICH NICHT MÖCHTE DAS PHP IHM MEIN PASSWORT ZEIGT
          $pdo = new PDO(
            'mysql:host=localhost;dbname=blog;charset=utf8',
            'root',
            ''
          );
        } catch (PDOException $e) {
          echo "verbindung zur Datenbank ist fehlgeschlagen";
          die();
        }
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        return $pdo;
      }
    ];
  }

  public function make($name)
  {
    if (!empty($this->instances[$name])) {
      return $this->instances[$name];
    }

    if (isset($this->receipts[$name])) {
      $this->instances[$name] = $this->receipts[$name]();
    }

    return $this->instances[$name];
  }
}
