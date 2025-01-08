<?php

require_once __DIR__ . '/BaseCommand.php';

class ChangeDirectoryCommand extends BaseCommand {
    private $path;

    public function __construct(FileSystem $fileSystem, $path) {
        parent::__construct($fileSystem);
        $this->path = $path;
    }

    public function execute() {
        $this->fileSystem->changeDirectory($this->path);
    }
}
