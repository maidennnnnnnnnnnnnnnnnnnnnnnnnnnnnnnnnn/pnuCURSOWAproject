<?php

require_once __DIR__ . '/BaseCommand.php';

class ShowCommand extends BaseCommand
{
    private $name;

    public function __construct(FileSystem $fileSystem, $name)
    {
        parent::__construct($fileSystem);
        $this->name = $name;
    }

    public function execute()
    {
        $this->fileSystem->show($this->name);
    }

}
