<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
        '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
        '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
        '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
        '/activites' => [
            [['_route' => 'api_activites', '_controller' => 'App\\Controller\\API\\APIActivitesController::index'], null, null, null, false, false, null],
            [['_route' => 'activites', '_controller' => 'App\\Controller\\ActivitesController::index'], null, null, null, false, false, null],
        ],
        '/calendrier' => [
            [['_route' => 'api_calendrier', '_controller' => 'App\\Controller\\API\\APICalendrierController::index'], null, null, null, false, false, null],
            [['_route' => 'calendrier', '_controller' => 'App\\Controller\\CalendrierController::index'], null, null, null, false, false, null],
        ],
        '/contact' => [
            [['_route' => 'api_contact', '_controller' => 'App\\Controller\\API\\APIContactController::index'], null, null, null, false, false, null],
            [['_route' => 'contact', '_controller' => 'App\\Controller\\ContactController::index'], null, null, null, false, false, null],
        ],
        '/equipe' => [
            [['_route' => 'api_equipe', '_controller' => 'App\\Controller\\API\\APIEquipeController::index'], null, null, null, false, false, null],
            [['_route' => 'equipe', '_controller' => 'App\\Controller\\EquipeController::index'], null, null, null, false, false, null],
        ],
        '/formations' => [
            [['_route' => 'api_formations', '_controller' => 'App\\Controller\\API\\APIFormationsController::index'], null, null, null, false, false, null],
            [['_route' => 'formations', '_controller' => 'App\\Controller\\FormationsController::index'], null, null, null, false, false, null],
        ],
        '/galerie' => [
            [['_route' => 'api_galerie', '_controller' => 'App\\Controller\\API\\APIGalerieController::index'], null, null, null, false, false, null],
            [['_route' => 'galerie', '_controller' => 'App\\Controller\\GalerieController::index'], null, null, null, false, false, null],
        ],
        '/' => [
            [['_route' => 'api_home', '_controller' => 'App\\Controller\\API\\APIHomeController::index'], null, null, null, false, false, null],
            [['_route' => 'home', '_controller' => 'App\\Controller\\HomeController::index'], null, null, null, false, false, null],
        ],
        '/impression3d' => [
            [['_route' => 'api_impression3d', '_controller' => 'App\\Controller\\API\\APIImpression3dController::index'], null, null, null, false, false, null],
            [['_route' => 'impression3d', '_controller' => 'App\\Controller\\Impression3dController::index'], null, null, null, false, false, null],
        ],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                    .'|wdt/([^/]++)(*:57)'
                    .'|profiler/([^/]++)(?'
                        .'|/(?'
                            .'|search/results(*:102)'
                            .'|router(*:116)'
                            .'|exception(?'
                                .'|(*:136)'
                                .'|\\.css(*:149)'
                            .')'
                        .')'
                        .'|(*:159)'
                    .')'
                .')'
                .'|/Download/([^/]++)(?'
                    .'|(*:190)'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        38 => [[['_route' => '_twig_error_test', '_controller' => 'twig.controller.preview_error::previewErrorPageAction', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        102 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        116 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        136 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception::showAction'], ['token'], null, null, false, false, null]],
        149 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception::cssAction'], ['token'], null, null, false, false, null]],
        159 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
        190 => [
            [['_route' => 'api_ddl', '_controller' => 'App\\Controller\\API\\APIImpression3dController::fileAction'], ['ddl'], ['GET' => 0], null, false, true, null],
            [['_route' => 'ddl', '_controller' => 'App\\Controller\\Impression3dController::fileAction'], ['ddl'], ['GET' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
