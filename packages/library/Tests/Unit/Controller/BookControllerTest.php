<?php

declare(strict_types=1);

namespace Library\Library\Tests\Unit\Controller;

use PHPUnit\Framework\MockObject\MockObject;
use TYPO3\TestingFramework\Core\AccessibleObjectInterface;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;
use TYPO3Fluid\Fluid\View\ViewInterface;

/**
 * Test case
 */
class BookControllerTest extends UnitTestCase
{
    /**
     * @var \Library\Library\Controller\BookController|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder($this->buildAccessibleProxy(\Library\Library\Controller\BookController::class))
            ->onlyMethods(['redirect', 'forward', 'addFlashMessage'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function listActionFetchesAllBooksFromRepositoryAndAssignsThemToView(): void
    {
        $allBooks = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $bookRepository = $this->getMockBuilder(\Library\Library\Domain\Repository\BookRepository::class)
            ->onlyMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $bookRepository->expects(self::once())->method('findAll')->will(self::returnValue($allBooks));
        $this->subject->_set('bookRepository', $bookRepository);

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('books', $allBooks);
        $this->subject->_set('view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenBookToView(): void
    {
        $book = new \Library\Library\Domain\Model\Book();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('book', $book);

        $this->subject->showAction($book);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenBookToBookRepository(): void
    {
        $book = new \Library\Library\Domain\Model\Book();

        $bookRepository = $this->getMockBuilder(\Library\Library\Domain\Repository\BookRepository::class)
            ->onlyMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $bookRepository->expects(self::once())->method('add')->with($book);
        $this->subject->_set('bookRepository', $bookRepository);

        $this->subject->createAction($book);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenBookToView(): void
    {
        $book = new \Library\Library\Domain\Model\Book();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('book', $book);

        $this->subject->editAction($book);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenBookInBookRepository(): void
    {
        $book = new \Library\Library\Domain\Model\Book();

        $bookRepository = $this->getMockBuilder(\Library\Library\Domain\Repository\BookRepository::class)
            ->onlyMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $bookRepository->expects(self::once())->method('update')->with($book);
        $this->subject->_set('bookRepository', $bookRepository);

        $this->subject->updateAction($book);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenBookFromBookRepository(): void
    {
        $book = new \Library\Library\Domain\Model\Book();

        $bookRepository = $this->getMockBuilder(\Library\Library\Domain\Repository\BookRepository::class)
            ->onlyMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $bookRepository->expects(self::once())->method('remove')->with($book);
        $this->subject->_set('bookRepository', $bookRepository);

        $this->subject->deleteAction($book);
    }
}
