<?php

namespace CentraleLille\SearchBundle\Model;

use Symfony\Component\HttpFoundation\Request;

class SearchString
{

    protected $stringSearch;
    protected $categorie;


    public function getStringSearch()
    {
        return $this->stringSearch;
    }

    public function setStringSearch($stringSearch)
    {
        $this->stringSearch = $stringSearch;
        return $this;
    }

    public function getCategorie()
    {
        return $this->categorie;
    }

    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
        return $this;
    }
}
