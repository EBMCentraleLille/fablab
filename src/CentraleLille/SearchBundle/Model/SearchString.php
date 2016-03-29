<?php

namespace CentraleLille\SearchBundle\Model;

use Symfony\Component\HttpFoundation\Request;

class SearchString
{
    
    protected $stringSearch;
   
 

    public function getStringSearch()
    {
        return $this->stringSearch;
    }

    public function setStringSearch($stringSearch)
    {
        $this->stringSearch = $stringSearch;

        return $this;
    }
}
