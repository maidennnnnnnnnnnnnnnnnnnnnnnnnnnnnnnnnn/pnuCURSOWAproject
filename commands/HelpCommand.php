<?php

require_once __DIR__ . '/BaseCommand.php';

class HelpCommand extends BaseCommand {

    public function __construct(FileSystem $fileSystem) {
        parent::__construct($fileSystem);
    }

    public function execute() {
        echo "Available commands and usage:\n";
        echo "------------------------------\n";
        echo "create [name] - Creates a new file or folder. If [name] ends with '/', it's a folder, otherwise a file.\n";
        echo "delete [name] - Deletes a file or folder.\n";
        echo "move [name] [destination] - Moves a file or folder to the specified destination.\n";
        echo "edit [file] [content] - Edits the content of a file.\n";
        echo "show [name] - Displays the contents of a file or folder. If no [name] is specified, shows current directory contents.\n";
        echo "enter [folder] - Changes the current directory to the specified folder.\n";
        echo "exit - Exits the terminal.\n";
        echo "help - Shows this help message.\n";
    }
}
