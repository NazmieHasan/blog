<?php

namespace AppBundle\Service\Message;

use AppBundle\Entity\Message;

interface MessageServiseInterface

{
    public function create(Message $message, int $recipientId) : bool;

    public function getAllByUser();

    public function getOne(int $id) : ?Message;

    public function getAllUnseenByUser();

}