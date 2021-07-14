<?php 
namespace App\Table;

class Article {

    private $div = 'p';
    private $link = 'a';

    public function __get($key)
    {
        $method = 'get' . ucfirst($key);
        $this->$key = $this->$method();
        return $this->$key;
    }

    public function getUrl()
    {
        return 'index.php?p=article&id=' . $this->id;
    }

    public function getExtrait()
    {
        $html = "<{$this->div}>{$this->segment()}</{$this->div}>";
        $html .= "<{$this->div}><{$this->link} href=". $this->getUrl() .">Voir la suite</{$this->link}></{$this->div}>";
        return $html;
    }

    private function segment()
    {
        return substr($this->contenu, 0, 100);
    }
}
