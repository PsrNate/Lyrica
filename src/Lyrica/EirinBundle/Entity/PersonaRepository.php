<?php

namespace Lyrica\EirinBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * PersonaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PersonaRepository extends EntityRepository
{
    /**
     * Fetches two opponents, up to user options
     *
     * @param array $excluding the game ops excluded by user
     * @return array
     */
    public function findOpponents($excluding = array())
    {
        // Initial query : find valid ids
        $qb = $this->createQueryBuilder();
        $qb->select('p.id');
        $qb->from('Persona', 'p');
        $qb->innerJoin('Game', 'g');
        
        // Exclusions
        for ($i = 0, $c = count($excluding) ; $i < $c ; $i++)
        {
            if ($i == 0)
            {
                $qb->where('g.opus != '.$excluding[0]);
            }
            else
            {
                $qb->andWhere('g.opus != '.$excluding[$i]);
            }
        }
        
        // Applying query
        $ids = $qb->getQuery()->getScalarResult();
        
        // Then picking two random ids
        $idsLength = count($ids);
        //First
        $results[0] = rand(0, $idsLength);
        // Second
        do
            {
                $results[1] = rand(0, $idsLength);
            }
        while ($results[1] == $results[0]);
        
        // Finally, return the personae
        $results[0] = $this->find($results[0]);
        $results[1] = $this->find($results[1]);
        
        return $results;
    }
}