<?php

declare(strict_types=1);

namespace NtpSrv\classes;

use \RuntimeException;

class Autoloader
{
    /**
     * List of namespaces this autoloader is registered for.
     * These are stored as key value pairs, key being the namespace, value
     * being the path to load from.
     *
     * @var array $registeredNamespaces
     */
    private array $registeredNamespaces;

    /**
     * Add a namespace to the list that this autoloader will be registered for.
     *
     * @param string[] $namespaces Namespace => Path key value pairs to register.
     */
    public function __construct(array $namespaces)
    {
        foreach ($namespaces as $namespace => $path) {
            $this->registeredNamespaces[$namespace] = $path;
        }
    }

    /**
     * Autoloader for classes, controllers and models.
     *
     * @throws RuntimeException Standard exception if the class is not found.
     * @return void
     */
    public function init(): void
    {
        $autoLoadFn = function (string $class) {
            $found = false;
            $baseDir = '';
            $classLen = 0;

            foreach ($this->registeredNamespaces as $prefix => $path) {
                $len = strlen($prefix);

                if (strncmp($prefix, $class, $len) === 0) {
                    $found = true;
                    $baseDir = $path;
                    $classLen = $len;
                }
            }

            // Namespace is not registered.
            if (!$found) {
                return;
            }

            $relativeClass = substr($class, $classLen);

            $endPath = str_replace('\\', '/', $relativeClass) . '.php';
            $file = $baseDir . $endPath;

            if (file_exists($file)) {
                include $file;

                return;
            }

            throw new RuntimeException('Class ' . $class . ' not found.');
        };

        spl_autoload_register($autoLoadFn);
    }
}
