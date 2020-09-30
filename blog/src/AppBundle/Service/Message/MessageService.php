<?php

namespace AppBundle\Service\Message;

use AppBundle\Entity\Message;
use AppBundle\Repository\MessageRepository;
use AppBundle\Service\Users\UserServiceInterface;
use Doctrine\Common\Collections\ArrayCollection;

class  MessageService implements MessageServiseInterface
{

    private $messageRepository;

    /**
     * @var UserServiceInterface
     */
    private $userService;


    public function __construct(
        MessageRepository $messageRepository,
        UserServiceInterface $userService)
    {
        $this->messageRepository = $messageRepository;
        $this->userService = $userService;
    }


    /**
     * @param Message $message
     * @param int $recipientId
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     */
    public function create(Message $message, int $recipientId): bool
    {
        $sender = $this->userService->currentUser();
        $recipient = $this->userService->findOneById($recipientId);
        $message
                ->setSender($sender)
                ->setRecipient($recipient);

        return $this->messageRepository->insert($message);
    }


    public function getAllByUser()
    {
        return $this
            ->messageRepository
            ->findBy(
                [
                    'recipient' => $this
                                     ->userService
                                     ->currentUser(),
                ],
                [
                    'dateAdded' => "DESC"
                ]);
    }


    /**
     * @param int $id
     * @return Message|null|object
     */
    public function getOne(int $id): ?Message
    {
        return $this->messageRepository->find($id);
    }

    public function getAllUnseenByUser()
    {
        return $this->messageRepository
                    ->findBy(
                        [
                            'recipient' =>$this->userService->currentUser(),
                            'isSeen' => false
                        ]
                    );
    }
}
