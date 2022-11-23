<?php
defined('TYPO3') || die();

(static function() {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'Library',
        'web',
        'books',
        '',
        [
            \Library\Library\Controller\BookController::class => 'list, show, new, create, edit, update, delete',
            
        ],
        [
            'access' => 'user,group',
            'icon'   => 'EXT:library/Resources/Public/Icons/user_mod_books.svg',
            'labels' => 'LLL:EXT:library/Resources/Private/Language/locallang_books.xlf',
        ]
    );

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_library_domain_model_book', 'EXT:library/Resources/Private/Language/locallang_csh_tx_library_domain_model_book.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_library_domain_model_book');

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_library_domain_model_author', 'EXT:library/Resources/Private/Language/locallang_csh_tx_library_domain_model_author.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_library_domain_model_author');
})();
