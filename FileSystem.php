<?php

class FileSystem {
    private $structure = [];
    private $currentPath = '/';


    public function getCurrentPath() {
        return $this->currentPath;
    }

    public function createFile($name) {
        if (isset($this->structure[$this->currentPath][$name])) {
            echo "Error: A file or folder named '$name' already exists.\n";
            return;
        }

        $this->structure[$this->currentPath][$name] = 'file';
        echo "Created file: $name\n";
    }

    public function createFolder($name) {
    if (isset($this->structure[$this->currentPath][$name])) {
        echo "Error: A file or folder named '$name' already exists.\n";
        return;
    }

    $this->structure[$this->currentPath][$name] = [];

    $folderPath = rtrim($this->currentPath, '/') . '/' . ltrim($name, '/');
    $this->structure[$folderPath] = [];

    echo "Created folder: $name\n";
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
    echo "Debug: Moving $name to $newPath\n";

    if (!isset($this->structure[$this->currentPath][$name])) {
        echo "Error: File or directory not found: $name\n";
        return;
    }

    $resolvedPath = $this->resolvePath($newPath);
    echo "Debug: Resolved Path: $resolvedPath\n";

    $resolvedPath = rtrim($resolvedPath, '/');

    if (!isset($this->structure[$resolvedPath]) || !is_array($this->structure[$resolvedPath])) {
        echo "Error: Destination folder does not exist: $newPath\n";
        return;
    }

    $this->structure[$resolvedPath][$name] = $this->structure[$this->currentPath][$name];
    unset($this->structure[$this->currentPath][$name]);

    echo "Moved $name to $resolvedPath\n";
}

    private function resolvePath($path) {
    if ($path === '/') {
        return '/';
    }

    if ($path === '..') {
        return dirname($this->currentPath);
    }

    if (str_starts_with($path, '/')) {
        return rtrim($path, '/');
    }

    return rtrim($this->currentPath, '/') . '/' . ltrim($path, '/');
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
        if ($path === '..') {
            if ($this->currentPath !== '/') {
                $this->currentPath = dirname($this->currentPath);
            }
        } elseif ($path === '/') {
            $this->currentPath = '/';
        } else {
            $newPath = rtrim($this->currentPath, '/') . '/' . ltrim($path, '/');

            if (isset($this->structure[$this->currentPath][$path]) && is_array($this->structure[$this->currentPath][$path])) {
                $this->currentPath = $newPath;  // Navigate into the folder
                echo "Current directory: " . $this->currentPath . "\n";
            } else {
                echo "Error: Directory not found: $path\n";
            }
        }
    }

    public function show($name = null) {
        if ($name == null) {
            $this->listContents();
            return;
        }

        if (isset($this->structure[$this->currentPath][$name])) {
            $item = $this->structure[$this->currentPath][$name];
            if (is_array($item)) {
                // It's a folder
                echo "$name is a folder\n";
                $this->listFolderContents($name);  // List contents of the folder
            } else {
                // It's a file
                echo "$name is a file with content: " . $item . "\n";
            }
        } else {
            echo "Error: $name not found\n";
        }

    }

    public function listContents() {
        echo "Current Path: " . $this->currentPath . "\n";
        echo "Contents:\n";

        if (isset($this->structure[$this->currentPath])) {
            foreach ($this->structure[$this->currentPath] as $name => $type) {
                echo "- $name (" . (is_array($type) ? 'folder' : 'file') . ")\n";
            }
        } else {
            echo "No contents in the current directory.\n";
        }
    }

    private function listFolderContents($folderName) {
    $folderName = rtrim($folderName, '/');
    if (isset($this->structure[$this->currentPath][$folderName]) && is_array($this->structure[$this->currentPath][$folderName])) {
        echo "Contents of folder $folderName:\n";
        foreach ($this->structure[$this->currentPath][$folderName] as $name => $type) {
            echo "- $name (" . (is_array($type) ? 'folder' : 'file') . ")\n";
        }
    } else {
        echo "Error: $folderName is not a valid folder or does not exist.\n";
    }
}

}
