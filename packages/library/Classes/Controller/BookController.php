<?php

declare(strict_types=1);

namespace Library\Library\Controller;


/**
 * This file is part of the "Library" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 
 */

/**
 * BookController
 */
class BookController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * bookRepository
     *
     * @var \Library\Library\Domain\Repository\BookRepository
     */
    protected $bookRepository = null;

    /**
     * @param \Library\Library\Domain\Repository\BookRepository $bookRepository
     */
    public function injectBookRepository(\Library\Library\Domain\Repository\BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * action list
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listAction(): \Psr\Http\Message\ResponseInterface
    {
        $books = $this->bookRepository->findAll();
        $this->view->assign('books', $books);
        return $this->htmlResponse();
    }

    /**
     * action show
     *
     * @param \Library\Library\Domain\Model\Book $book
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function showAction(\Library\Library\Domain\Model\Book $book): \Psr\Http\Message\ResponseInterface
    {
        $this->view->assign('book', $book);
        return $this->htmlResponse();
    }

    /**
     * action new
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function newAction(): \Psr\Http\Message\ResponseInterface
    {
        return $this->htmlResponse();
    }

    /**
     * action create
     *
     * @param \Library\Library\Domain\Model\Book $newBook
     */
    public function createAction(\Library\Library\Domain\Model\Book $newBook)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->bookRepository->add($newBook);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \Library\Library\Domain\Model\Book $book
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("book")
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function editAction(\Library\Library\Domain\Model\Book $book): \Psr\Http\Message\ResponseInterface
    {
        $this->view->assign('book', $book);
        return $this->htmlResponse();
    }

    /**
     * action update
     *
     * @param \Library\Library\Domain\Model\Book $book
     */
    public function updateAction(\Library\Library\Domain\Model\Book $book)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->bookRepository->update($book);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \Library\Library\Domain\Model\Book $book
     */
    public function deleteAction(\Library\Library\Domain\Model\Book $book)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->bookRepository->remove($book);
        $this->redirect('list');
    }

    /**
     * action
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function Action(): \Psr\Http\Message\ResponseInterface
    {
        return $this->htmlResponse();
    }
}
