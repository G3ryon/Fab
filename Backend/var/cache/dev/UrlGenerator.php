<?php

// This file has been auto-generated by the Symfony Routing Component.

return [
    '_twig_error_test' => [['code', '_format'], ['_controller' => 'twig.controller.preview_error::previewErrorPageAction', '_format' => 'html'], ['code' => '\\d+'], [['variable', '.', '[^/]++', '_format', true], ['variable', '/', '\\d+', 'code', true], ['text', '/_error']], [], []],
    '_wdt' => [['token'], ['_controller' => 'web_profiler.controller.profiler::toolbarAction'], [], [['variable', '/', '[^/]++', 'token', true], ['text', '/_wdt']], [], []],
    '_profiler_home' => [[], ['_controller' => 'web_profiler.controller.profiler::homeAction'], [], [['text', '/_profiler/']], [], []],
    '_profiler_search' => [[], ['_controller' => 'web_profiler.controller.profiler::searchAction'], [], [['text', '/_profiler/search']], [], []],
    '_profiler_search_bar' => [[], ['_controller' => 'web_profiler.controller.profiler::searchBarAction'], [], [['text', '/_profiler/search_bar']], [], []],
    '_profiler_phpinfo' => [[], ['_controller' => 'web_profiler.controller.profiler::phpinfoAction'], [], [['text', '/_profiler/phpinfo']], [], []],
    '_profiler_search_results' => [['token'], ['_controller' => 'web_profiler.controller.profiler::searchResultsAction'], [], [['text', '/search/results'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], []],
    '_profiler_open_file' => [[], ['_controller' => 'web_profiler.controller.profiler::openAction'], [], [['text', '/_profiler/open']], [], []],
    '_profiler' => [['token'], ['_controller' => 'web_profiler.controller.profiler::panelAction'], [], [['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], []],
    '_profiler_router' => [['token'], ['_controller' => 'web_profiler.controller.router::panelAction'], [], [['text', '/router'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], []],
    '_profiler_exception' => [['token'], ['_controller' => 'web_profiler.controller.exception::showAction'], [], [['text', '/exception'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], []],
    '_profiler_exception_css' => [['token'], ['_controller' => 'web_profiler.controller.exception::cssAction'], [], [['text', '/exception.css'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], []],
    'api_activites' => [[], ['_controller' => 'App\\Controller\\API\\APIActivitesController::index'], [], [['text', '/activites']], [], []],
    'api_api_formbool' => [[], ['_controller' => 'App\\Controller\\API\\APIAdminController::index'], [], [['text', '/api/formationbool']], [], []],
    'api_calendrier' => [[], ['_controller' => 'App\\Controller\\API\\APICalendrierController::index'], [], [['text', '/calendrier']], [], []],
    'api_contact' => [[], ['_controller' => 'App\\Controller\\API\\APIContactController::index'], [], [['text', '/contact']], [], []],
    'api_equipe' => [[], ['_controller' => 'App\\Controller\\API\\APIEquipeController::index'], [], [['text', '/equipe']], [], []],
    'api_formations' => [[], ['_controller' => 'App\\Controller\\API\\APIFormationsController::index'], [], [['text', '/formations']], [], []],
    'api_galerie' => [[], ['_controller' => 'App\\Controller\\API\\APIGalerieController::index'], [], [['text', '/galerie']], [], []],
    'api_home' => [[], ['_controller' => 'App\\Controller\\API\\APIHomeController::index'], [], [['text', '/']], [], []],
    'api_api_date' => [[], ['_controller' => 'App\\Controller\\API\\APIImpression3dController::DateDisplay'], [], [['text', '/api/Date']], [], []],
    'api_api_ddl' => [[], ['_controller' => 'App\\Controller\\API\\APIImpression3dController::fileAction'], [], [['text', '/api/Download']], [], []],
    'api_api_upload' => [[], ['_controller' => 'App\\Controller\\API\\APIImpression3dController::uploadfile'], [], [['text', '/api/up']], [], []],
    'api_api_print' => [[], ['_controller' => 'App\\Controller\\API\\APIImpression3dController::insertNewPrint'], [], [['text', '/api/Print']], [], []],
    'activites' => [[], ['_controller' => 'App\\Controller\\ActivitesController::index'], [], [['text', '/activites']], [], []],
    'admin' => [[], ['_controller' => 'App\\Controller\\AdminController::index'], [], [['text', '/admin']], [], []],
    'calendrier' => [[], ['_controller' => 'App\\Controller\\CalendrierController::index'], [], [['text', '/calendrier']], [], []],
    'contact' => [[], ['_controller' => 'App\\Controller\\ContactController::index'], [], [['text', '/contact']], [], []],
    'equipe' => [[], ['_controller' => 'App\\Controller\\EquipeController::index'], [], [['text', '/equipe']], [], []],
    'formations' => [[], ['_controller' => 'App\\Controller\\FormationsController::index'], [], [['text', '/formations']], [], []],
    'galerie' => [[], ['_controller' => 'App\\Controller\\GalerieController::index'], [], [['text', '/galerie']], [], []],
    'home' => [[], ['_controller' => 'App\\Controller\\HomeController::index'], [], [['text', '/']], [], []],
    'impression3d' => [[], ['_controller' => 'App\\Controller\\Impression3dController::index'], [], [['text', '/impression3d']], [], []],
    'ddl' => [['ddl'], ['_controller' => 'App\\Controller\\Impression3dController::fileAction'], [], [['variable', '/', '[^/]++', 'ddl', true], ['text', '/Download']], [], []],
];
