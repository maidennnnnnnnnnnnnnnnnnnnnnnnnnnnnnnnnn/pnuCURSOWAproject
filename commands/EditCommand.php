<?php

require_once __DIR__ . '/BaseCommand.php';

class EditCommand extends BaseCommand {
    private $name;
    private $content;

    public function __construct(FileSystem $fileSystem, $name, $content) {
        parent::__construct($fileSystem);
        $this->name = $name;
        $this->content = $content;
    }

    public function execute() {
        $this->fileSystem->edit($this->name, $this->content);
    }
}
