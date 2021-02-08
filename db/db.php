<?php
    require_once('file_io.php');
    class Database{
        private $io;

        function __construct($schemas){
            $this->io = new FileIo();
            $this->tables = array_merge($this->tables , $schemas);
        }

        public $tables = Array();



        private function save($tableName , $values){
            $valueToUpdate = $this->io->generateCsv($values);
            return $this->io->save($this->tables[$tableName]["path"] , $valueToUpdate);
        }

        public function editRow($tableName , $searchBy , $value , $newItem){
            $newTable = Array();
            $allValues = $this->getTable($tableName);
            foreach($allValues as $singleValue){
                if(strtolower($singleValue[$searchBy]) == strtolower($value)){
                    $singleValue = $newItem;
                }
                array_push($newTable , $singleValue);
            }
            return $this->save($tableName , $newTable);
        }

        public function searchTable($tableName , $searchBy , $value){
            $allValues = $this->getTable($tableName);
            $valuesToReturn = array_filter($allValues , function($item) use($searchBy , $value) {
                return strtolower($item[$searchBy]) == strtolower($value);
            });

            return $valuesToReturn;
        }

        public function getTable($tableName){
            $filePath = $this->tables[$tableName]["path"];
            $users = Array();

            $fileHandle = $this->io->open($filePath);
            $numberOfLines = $this->io->getNumberOfLines($filePath);
            $counter = 0;
            if($fileHandle!=null) {
                for($i = 0; $i<$numberOfLines;$i++){
                $line = fgetcsv($fileHandle,1024,",","\"");

                    $columnIndex = 0;
                    foreach($this->tables[$tableName]["schema"] as $columnName){
                        $users[$counter][$columnName] = $line[$columnIndex];
                        $columnIndex++;
                    }
                    $counter++;
                }
            }

            return $users;
        }

    }