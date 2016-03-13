<?php
/**
 * User: stephen.parker
 * Date: 12/03/2016
 * Time: 19:56
 */

namespace Application\Service;


use EnliteMonolog\Service\MonologServiceAwareInterface;
use EnliteMonolog\Service\MonologServiceAwareTrait;
use Zend\Cache\Storage\StorageInterface;

class CommentsService implements MonologServiceAwareInterface
{
    use MonologServiceAwareTrait;

    /**
     * @var \Zend\Cache\Storage\StorageInterface
     */
    protected $storage;

    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    /**
     * Clear all comments
     */
    public function clearComments()
    {
        $this->getMonologService()->addInfo('Clear all comments');
        $this->storage->removeItem('comments');
    }

    /**
     * Remove a specific item
     *
     * @param $id
     */
    public function removeComment($id)
    {
        $this->getMonologService()->addInfo('Remove comment: ' . $id);
        $comments = $this->getComments();

        foreach ($comments as $k => $v) {
            if ($v['id'] == $id) {
                unset($comments[$k]);
            }
        }
        sort($comments);
        $this->storage->setItem('comments', $comments);
    }

    /**
     * @return array
     */
    public function getComments()
    {
        $this->getMonologService()->addInfo('Get comments');

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
     * @param $author
     * @param $text
     */
    public function addComment($author, $text)
    {
        $this->getMonologService()->addInfo('Add comment ' . $author . ' ' . $text);
        $comments = $this->getComments();
        array_push($comments, [
            'id'     => $this->getNextId(),
            'author' => $author,
            'text'   => $text,
        ]);
        $this->storage->setItem('comments', $comments);
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