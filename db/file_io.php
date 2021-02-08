<?php
    class FileIo{
        function getNumberOfLines($filePath){
            $fp = file($filePath);
            return count($fp);
        }

        function open($filePath){
            $fileHandle =  fopen($filePath , 'r+');
            return $fileHandle != false ? $fileHandle : die('Could not access the file');
        }

        function save($filePath , $value){
            $fileHandle = fopen($filePath , 'w+');
            $result =  fwrite ($fileHandle, $value);
            fclose($fileHandle);
            return $result;
        }


        function generateCsv($array){
            $result = "";
            foreach($array as $row){
                $cellIndex = 0;
                foreach($row as $cell){
                    $result .= $cell;
                    if($cellIndex < count($row) - 1){
                        $result .= ",";
                    }
                    $cellIndex++;
                }
                $result .= "\n";
            }
            return $result;
        }
    }