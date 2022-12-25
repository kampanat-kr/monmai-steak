<?php

    class fileUtil {

        public static function clear_cache($dirname, $cache_life = 0) {
            if (is_dir($dirname))
                $dir_handle = opendir($dirname);

            if (!$dir_handle)
                return false;

            while ($file = readdir($dir_handle)) {
                if ($file != "." && $file != "..") {
                    $filename = $dirname . "/" . $file;
                    if (!is_dir($filename)) {
                        if ($cache_life != 0 && (date("YmdHi") - date("YmdHi", filemtime($filename)) >= $cache_life))
                            unlink($filename);
                    }
                }
            }

            closedir($dir_handle);

            return true;
        }

        public static function create_directory($pathname) {
            if (!file_exists($pathname)) {
                mkdir($pathname);
            }

            return true;
        }

        public static function delete_directory($dirname) {
            if (is_dir($dirname))
                $dir_handle = opendir($dirname);

            if (!$dir_handle)
                return false;

            while ($file = readdir($dir_handle)) {
                if ($file != "." && $file != "..") {
                    if (!is_dir($dirname . "/" . $file))
                        unlink($dirname . "/" . $file);
                    else {
                        if (!self::delete_directory($dirname . "/" . $file))
                            return false;
                    }
                }
            }

            closedir($dir_handle);
            rmdir($dirname);

            return true;
        }

        public static function delete_file($filename) {
            if (!is_dir($filename)) {
                if (file_exists($filename)) {
                    unlink($filename);
                }
            }
        }

        public static function file_extension($filename) {
            $filename = strtolower($filename);
            $exts = split("[/\\.]", $filename);
            $n = count($exts) - 1;
            $exts = $exts[$n];
            return $exts;
        }

        /**
         * Check if the file exists
         * Check in subfolders too
         */
        public static function find_file($dirname, $fname, &$file_path) {
            $dir = opendir($dirname);
            while ($file = readdir($dir)) {

                if (empty($file_path) && $file != '.' && $file != '..') {
                    if (is_dir($dirname . '/' . $file)) {
                        self::find_file($dirname . '/' . $file, $fname, $file_path);
                    } else {
                        if (file_exists($dirname . '/' . $fname)) {
                            $file_path = $dirname . '/' . $fname;
                            return;
                        }
                    }
                }
            }
        }

        /**
         * Generate randomly an unique id
         * @note this is used to fight acrobat cache
         * */
        public static function rnunid($prefix = "") {

            return $prefix . md5(uniqid());  // 32 characters long
            //$unique = sha1( uniqid() );  // 40 characters long
        }

    }

?>
