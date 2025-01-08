<?php

require_once __DIR__ . '/BaseCommand.php';

class MoveCommand extends BaseCommand {
    private $name;
    private $newPath;

    public function __construct(FileSystem $fileSystem, $name, $newPath) {
        parent::__construct($fileSystem);
        $this->name = $name;
        $this->newPath = $newPath;
    }

    public function execute() {
        $this->fileSystem->move($this->name, $this->newPath);
    }
}
