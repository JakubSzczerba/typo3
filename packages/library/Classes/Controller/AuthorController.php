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
 * AuthorController
 */
class AuthorController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * authorRepository
     *
     * @var \Library\Library\Domain\Repository\AuthorRepository
     */
    protected $authorRepository = null;

    /**
     * @param \Library\Library\Domain\Repository\AuthorRepository $authorRepository
     */
    public function injectAuthorRepository(\Library\Library\Domain\Repository\AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
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
     * @param \Library\Library\Domain\Model\Author $newAuthor
     */
    public function createAction(\Library\Library\Domain\Model\Author $newAuthor)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->authorRepository->add($newAuthor);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \Library\Library\Domain\Model\Author $author
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("author")
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function editAction(\Library\Library\Domain\Model\Author $author): \Psr\Http\Message\ResponseInterface
    {
        $this->view->assign('author', $author);
        return $this->htmlResponse();
    }

    /**
     * action update
     *
     * @param \Library\Library\Domain\Model\Author $author
     */
    public function updateAction(\Library\Library\Domain\Model\Author $author)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->authorRepository->update($author);
        $this->redirect('list');
    }
}
