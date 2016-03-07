<?php

namespace CentraleLille\SearchBundle\Entity\SearchRepository;

use FOS\ElasticaBundle\Repository;
use CentraleLille\SearchBundle\Model\SearchUser;

class searchRepository extends Repository
{
    public function search(SearchUser $userSearch)
    {
        // we create a query to return all the articles
        // but if the criteria title is specified, we use it
        if ($userSearch->getUsername() != null || $userSearch != '' || $userSearch->getEmail() != null) {
            $query = new \Elastica\Query\Match();
            $query->setFieldQuery('user.username', $userSearch->getUsername());
            $query->setFieldFuzziness('user.username', 0.4);

             
            //
        } else {
            $query = new \Elastica\Query\MatchAll();
        }
         $baseQuery = $query;

        // then we create filters depending on the chosen criterias
        $boolFilter = new \Elastica\Filter\Bool();

        
        /*
            Dates filter
            We add this filter only the getIspublished filter is not at "false"
        */
        

        // Published or not filter
        

        $filtered = new \Elastica\Query\Filtered($baseQuery, $boolFilter);

        $query = \Elastica\Query::create($filtered);

        return $this->find($query);
    }}
