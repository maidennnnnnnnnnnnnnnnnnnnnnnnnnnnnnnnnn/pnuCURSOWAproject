<?php

require_once __DIR__ . '/../FileSystem.php';
require_once __DIR__ . '/../Command.php';

abstract class BaseCommand implements Command
{
    protected $fileSystem;

    public function __construct(FileSystem $fileSystem)
    {
        $this->fileSystem = $fileSystem;
    }

    abstract public function execute();
}
