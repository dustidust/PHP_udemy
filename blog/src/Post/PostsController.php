<?php
// POSTCONTROLLER IST ZUSTÄNDIG FÜR ALLE POSTS UND ANZEIGECODE DINGE IST DIE LOGIK DAHINTER
namespace App\Post;

class PostsController
{

  public function __construct(PostsRepository $postsRepository)
  {
    $this->postsRepository = $postsRepository;
  }

  // PROTECTED WEIL SIE NUR IN DIESER KLASSE BENÖTIGT WIRD
  protected function render($view, $params)
  {
    // ERSTELLE MIR EINE VARIABLE, DIE GENAUSO HEIßT WIE DER $KEY UND WEISE IHM DEN WERT $VALUE ZU
    // foreach ($params as $key => $value) 
    // {
    //    ${$key} = $value;
    // }

    extract($params);

    include __DIR__ . "/../../views/{$view}.php";
  }

  public function index()
  {
    $posts = $this->postsRepository->fetchPosts();

    $this->render("post/index", [
      'posts' => $posts
    ]);
  }

  // FUNKTION UM EINEN NEUEN POST ZU LADEN
  public function show()
  {
    $id = $_GET['id'];
    $post = $this->postsRepository->fetchPost($id);

    $this->render("post/show", [
      'post' => $post
    ]);
  }
}
