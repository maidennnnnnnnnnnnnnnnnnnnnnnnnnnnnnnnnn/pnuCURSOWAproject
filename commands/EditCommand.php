<?php

require_once __DIR__ . '/BaseCommand.php';

class EditCommand extends BaseCommand {

    public function execute(array $args) {
        $name = array_shift($args);
        $content = implode(' ', $args);
        FileSystem::getInstance()->edit($name, $content);
    }
}