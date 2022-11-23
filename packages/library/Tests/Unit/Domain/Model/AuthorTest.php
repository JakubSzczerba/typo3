<?php

declare(strict_types=1);

namespace Library\Library\Tests\Unit\Domain\Model;

use PHPUnit\Framework\MockObject\MockObject;
use TYPO3\TestingFramework\Core\AccessibleObjectInterface;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Test case
 */
class AuthorTest extends UnitTestCase
{
    /**
     * @var \Library\Library\Domain\Model\Author|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = $this->getAccessibleMock(
            \Library\Library\Domain\Model\Author::class,
            ['dummy']
        );
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getNameReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getName()
        );
    }

    /**
     * @test
     */
    public function setNameForStringSetsName(): void
    {
        $this->subject->setName('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('name'));
    }

    /**
     * @test
     */
    public function getSurnameReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getSurname()
        );
    }

    /**
     * @test
     */
    public function setSurnameForStringSetsSurname(): void
    {
        $this->subject->setSurname('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('surname'));
    }

    /**
     * @test
     */
    public function getPhotoReturnsInitialValueForFileReference(): void
    {
        self::assertEquals(
            null,
            $this->subject->getPhoto()
        );
    }

    /**
     * @test
     */
    public function setPhotoForFileReferenceSetsPhoto(): void
    {
        $fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $this->subject->setPhoto($fileReferenceFixture);

        self::assertEquals($fileReferenceFixture, $this->subject->_get('photo'));
    }
}
