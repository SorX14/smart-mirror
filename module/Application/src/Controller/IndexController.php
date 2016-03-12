<?php
/**
 * User: stephen.parker
 * Date: 12/03/2016
 * Time: 15:29
 */

namespace Application\Controller;


use Application\Service\CommentsService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    /**
     * @var \Application\Service\CommentsService
     */
    protected $commentsService;

    public function __construct(CommentsService $commentsService)
    {
        $this->commentsService = $commentsService;
    }

    public function indexAction()
    {
        return new ViewModel();
    }

    public function commentsAction()
    {
        if ($this->getRequest()->isPost()) {
            $postData = $this->getRequest()->getPost();

            $this->commentsService->addComment(
                $postData['author'],
                $postData['text']
            );
        }

        return new JsonModel($this->commentsService->getComments());
    }
}