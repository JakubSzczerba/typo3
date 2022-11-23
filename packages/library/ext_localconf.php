<?php
defined('TYPO3') || die();

(static function() {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Library',
        'Library',
        [
            \Library\Library\Controller\BookController::class => 'list, show, new, create, edit, update, delete, ',
            \Library\Library\Controller\AuthorController::class => 'new, create, edit, update'
        ],
        // non-cacheable actions
        [
            \Library\Library\Controller\BookController::class => 'new, create, edit, update'
        ]
    );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    library {
                        iconIdentifier = library-plugin-library
                        title = LLL:EXT:library/Resources/Private/Language/locallang_db.xlf:tx_library_library.name
                        description = LLL:EXT:library/Resources/Private/Language/locallang_db.xlf:tx_library_library.description
                        tt_content_defValues {
                            CType = list
                            list_type = library_library
                        }
                    }
                }
                show = *
            }
       }'
    );
})();
