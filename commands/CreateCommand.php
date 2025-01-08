<?php

require_once __DIR__ . '/BaseCommand.php';

class CreateCommand extends BaseCommand {
    private $name;

    public function __construct(FileSystem $fileSystem, $name) {
        parent::__construct($fileSystem);
        $this->name = $name;
    }

    public function execute() {
        if (str_ends_with($this->name, '/')) {
            $folderName = rtrim($this->name, '/');
            $this->fileSystem->createFolder($folderName);
        } else {
            $this->fileSystem->createFile($this->name);
        }
    }
}
