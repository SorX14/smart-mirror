<?php
/**
 * User: stephen.parker
 * Date: 12/03/2016
 * Time: 19:56
 */

namespace Application\Service;


use Zend\Cache\Storage\StorageInterface;

class CommentsService
{

    /**
     * @var \Zend\Cache\Storage\StorageInterface
     */
    protected $storage;

    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    /**
     * @param $author
     * @param $text
     */
    public function addComment($author, $text)
    {
        $comments = $this->getComments();
        array_push($comments, [
            'id'     => $this->getNextId(),
            'author' => $author,
            'text'   => $text,
        ]);
        $this->storage->setItem('comments', $comments);
    }

    /**
     * @return array
     */
    public function getComments()
    {
        $comments = [
            [
                'id'     => 1,
                'author' => 'Pete Hunt',
                'text'   => 'This is one comment',
            ],
            [
                'id'     => 2,
                'author' => 'Jordan Walke',
                'text'   => 'This is *another* comment',
            ],
        ];

        if (!$this->storage->hasItem('comments')) {
            $this->storage->setItem('comments', $comments);

            return $comments;
        } else {
            return $this->storage->getItem('comments');
        }
    }

    /**
     * Get the next ID for comments
     *
     * @return integer
     */
    private function getNextId()
    {
        $comments = $this->getComments();
        $lastComment = end($comments);

        return ++$lastComment['id'];
    }

}