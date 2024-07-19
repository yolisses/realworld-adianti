<?php

use Adianti\Control\TPage;
use Adianti\Database\TTransaction;
use Adianti\Widget\Base\TElement;
use Adianti\Widget\Container\TVBox;
use Adianti\Widget\Datagrid\TPageNavigation;
use Adianti\Widget\Form\TEntry;
use Adianti\Widget\Form\TLabel;

class ArticlesPage extends TPage
{
  public function __construct()
  {
    parent::__construct();

    TTransaction::open('sample');
    $articles = Article::all();
    TTransaction::close();

    $list = new TVBox;
    $this->add($list);

    foreach ($articles as $article) {
      $container = new TVBox;

      $title = new TLabel($article->title);
      $container->add($title);

      $description = new TLabel($article->description);
      $container->add($description);

      $link = new TElement('a');
      $link->href = 'index.php?class=ArticlePage&id=' . $article->id;
      $link->add($container);

      $list->add($link);
    }
  }
}
