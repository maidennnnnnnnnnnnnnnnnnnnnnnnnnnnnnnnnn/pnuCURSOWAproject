<?php

class FileSystem {
    private $structure = [];
    private $currentPath = '/';

    public function getCurrentPath() {
        return $this->currentPath;
    }

    public function createFile($name) {
        // Check if file or folder already exists before creating
        if (!isset($this->structure[$this->currentPath][$name])) {
            $this->structure[$this->currentPath][$name] = 'file';
            echo "Created file: $name\n";
        } else {
            echo "Error: File or folder with name $name already exists\n";
        }
    }

    public function createFolder($name) {
        // Check if file or folder already exists before creating
        if (!isset($this->structure[$this->currentPath][$name])) {
            $this->structure[$this->currentPath][$name] = [];
            echo "Created folder: $name\n";
        } else {
            echo "Error: File or folder with name $name already exists\n";
        }
    }

    public function delete($name) {
        if (isset($this->structure[$this->currentPath][$name])) {
            unset($this->structure[$this->currentPath][$name]);
            echo "Deleted: $name\n";
        } else {
            echo "Error: File or directory not found: $name\n";
        }
    }

    public function move($name, $newPath) {
        if (isset($this->structure[$this->currentPath][$name])) {
            $this->structure[$newPath][$name] = $this->structure[$this->currentPath][$name];
            unset($this->structure[$this->currentPath][$name]);
            echo "Moved $name to $newPath\n";
        } else {
            echo "Error: File or directory not found: $name\n";
        }
    }

    public function edit($name, $content) {
        if ($this->structure[$this->currentPath][$name] ?? null === 'file') {
            $this->structure[$this->currentPath][$name] = $content;
            echo "Edited file $name\n";
        } else {
            echo "Error: File not found: $name\n";
        }
    }

    public function changeDirectory($path) {
        // If going up one directory
        if ($path === '..') {
            if ($this->currentPath !== '/') {
                $this->currentPath = dirname($this->currentPath);
            }
        } elseif ($path === '/') {
            // If going to root directory
            $this->currentPath = '/';
        } else {
            // Handle relative path or direct folder name
            $newPath = rtrim($this->currentPath, '/') . '/' . ltrim($path, '/');

            // Check if the folder exists under the current path
            if (isset($this->structure[$this->currentPath][$path]) && is_array($this->structure[$this->currentPath][$path])) {
                $this->currentPath = $newPath;  // Navigate into the folder
                echo "Current directory: " . $this->currentPath . "\n";
            } else {
                echo "Error: Directory not found: $path\n";
            }
        }
    }

    public function listContents() {
        echo "Current Path: " . $this->currentPath . "\n";
        echo "Contents:\n";

        // Check the structure at the current path
        if (isset($this->structure[$this->currentPath])) {
            foreach ($this->structure[$this->currentPath] as $name => $type) {
                echo "- $name (" . (is_array($type) ? 'folder' : 'file') . ")\n";
            }
        } else {
            echo "No contents in the current directory.\n";
        }
    }
}

