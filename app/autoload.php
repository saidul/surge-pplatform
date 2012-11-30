<?php

use Symfony\Component\ClassLoader\UniversalClassLoader;
use Doctrine\Common\Annotations\AnnotationRegistry;

$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
    'Symfony'          => array(__DIR__.'/../vendor/symfony/src', __DIR__.'/../vendor/bundles'),
    'Sensio'           => __DIR__.'/../vendor/bundles',
    'JMS'              => __DIR__.'/../vendor/bundles',
    'Doctrine\\Common' => __DIR__.'/../vendor/doctrine-common/lib',
    'Doctrine\\DBAL'   => __DIR__.'/../vendor/doctrine-dbal/lib',
    'Doctrine'         => __DIR__.'/../vendor/doctrine/lib',
    'Monolog'          => __DIR__.'/../vendor/monolog/src',
    'Assetic'          => __DIR__.'/../vendor/assetic/src',
    'Metadata'         => __DIR__.'/../vendor/metadata/src',

    'FOS'              => __DIR__.'/../vendor/bundles',
    'Stof'             => __DIR__.'/../vendor/bundles',
    'Gedmo'            => __DIR__.'/../vendor/doctrine-extensions/lib',
    'Doctrine\\Common\\DataFixtures' => __DIR__.'/../vendor/doctrine-data-fixtures/lib',
    'Knp\\Component'   => __DIR__.'/../vendor/knp-components/src',
    'Knp\\Bundle'      => __DIR__.'/../vendor/bundles',
    //'Knp\\Snappy'                => __DIR__.'/../vendor/snappy/src',
    'OpenSky'          => __DIR__.'/../vendor/bundles',
    'Mopa'             => __DIR__.'/../vendor/bundles', //twitter bootstrap2 integration
    'Imagine'          => __DIR__.'/../vendor/imagine/lib',
    'Avalanche'        => __DIR__.'/../vendor/bundles',
    'Berriart'         => __DIR__.'/../vendor/bundles',
    'Liip'             => __DIR__.'/../vendor/bundles',
    'Igorw'            => __DIR__.'/../vendor/bundles',
    'Sylius'           => __DIR__.'/../vendor/bundles',
    'WhiteOctober\PagerfantaBundle' => __DIR__.'/../vendor/bundles',
    'Pagerfanta'       => __DIR__.'/../vendor/pagerfanta/src',
    'Gregwar'          => __DIR__.'/../vendor/bundles',
    'HWI'              => __DIR__.'/../vendor/bundles',
    'Buzz'             => __DIR__.'/../vendor/buzz/lib'
));
$loader->registerPrefixes(array(
    'Twig_Extensions_' => __DIR__.'/../vendor/twig-extensions/lib',
    'Twig_'            => __DIR__.'/../vendor/twig/lib',
));

// intl
if (!function_exists('intl_get_error_code')) {
    require_once __DIR__.'/../vendor/symfony/src/Symfony/Component/Locale/Resources/stubs/functions.php';

    $loader->registerPrefixFallbacks(array(__DIR__.'/../vendor/symfony/src/Symfony/Component/Locale/Resources/stubs'));
}

$loader->registerNamespaceFallbacks(array(
    __DIR__.'/../src',
));
$loader->register();

AnnotationRegistry::registerLoader(function($class) use ($loader) {
    $loader->loadClass($class);
    return class_exists($class, false);
});
AnnotationRegistry::registerFile(__DIR__.'/../vendor/doctrine/lib/Doctrine/ORM/Mapping/Driver/DoctrineAnnotations.php');

require __DIR__.'/../vendor/swiftmailer/lib/swift_required.php';