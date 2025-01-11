<?php

require_once __DIR__ . '/BaseCommand.php';

class DeleteCommand extends BaseCommand {
    public function execute(array $args) {
        $name = array_shift($args);
        FileSystem::getInstance()->delete($name);
    }
}