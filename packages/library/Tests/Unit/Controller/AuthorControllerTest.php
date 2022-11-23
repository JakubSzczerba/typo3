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
class AuthorControllerTest extends UnitTestCase
{
    /**
     * @var \Library\Library\Controller\AuthorController|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder($this->buildAccessibleProxy(\Library\Library\Controller\AuthorController::class))
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
    public function createActionAddsTheGivenAuthorToAuthorRepository(): void
    {
        $author = new \Library\Library\Domain\Model\Author();

        $authorRepository = $this->getMockBuilder(\Library\Library\Domain\Repository\AuthorRepository::class)
            ->onlyMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $authorRepository->expects(self::once())->method('add')->with($author);
        $this->subject->_set('authorRepository', $authorRepository);

        $this->subject->createAction($author);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenAuthorToView(): void
    {
        $author = new \Library\Library\Domain\Model\Author();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('author', $author);

        $this->subject->editAction($author);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenAuthorInAuthorRepository(): void
    {
        $author = new \Library\Library\Domain\Model\Author();

        $authorRepository = $this->getMockBuilder(\Library\Library\Domain\Repository\AuthorRepository::class)
            ->onlyMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $authorRepository->expects(self::once())->method('update')->with($author);
        $this->subject->_set('authorRepository', $authorRepository);

        $this->subject->updateAction($author);
    }
}
