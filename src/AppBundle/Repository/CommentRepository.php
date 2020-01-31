<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Comment;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping;
use Doctrine\ORM\OptimisticLockException;

class CommentRepository extends \Doctrine\ORM\EntityRepository
{
    public function __construct(EntityManagerInterface $em,
                                Mapping\ClassMetadata $metaData = null )
    {
        parent::__construct($em,
            $metaData == null ?
                new Mapping\ClassMetadata(Comment::class) :
                $metaData);

    }

    /**
     * @param Comment $comment
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     */
    public function insert(Comment $comment)
    {
        $this->_em->persist($comment);
        try {
            $this->_em->flush();
            return true;
        } catch (OptimisticLockException $e) {
            return false;
        }
    }


}
