<?php
require "connection.php";

// Get all tables
$tables = array();
$result = Database::search("SHOW TABLES");
while ($row = $result->fetch_row()) {
    $tables[] = $row[0];
}

// Create backup
$backup = '';
foreach ($tables as $table) {
    $result = Database::search("SELECT * FROM $table");
    $num_fields = $result->field_count;

    $backup .= 'DROP TABLE IF EXISTS ' . $table . ';';
    $row2 = Database::search("SHOW CREATE TABLE $table")->fetch_row();
    $backup .= "\n\n" . $row2[1] . ";\n\n";

    for ($i = 0; $i < $num_fields; $i++) {
        while ($row = $result->fetch_row()) {
            $backup .= 'INSERT INTO ' . $table . ' VALUES(';
            for ($j = 0; $j < $num_fields; $j++) {
                $row[$j] = $row[$j] ? addslashes($row[$j]) : 'NULL';
                $backup .= '"' . $row[$j] . '"' . ($j < ($num_fields - 1) ? ',' : '');
            }
            $backup .= ");\n";
        }
    }
    $backup .= "\n\n\n";
}

// Save the backup to a file
$backup_file = 'db-backup-' . date('Y-m-d-H-i-s') . '.sql';
file_put_contents($backup_file, $backup);
echo "Backup created successfully! Download it from <a href='$backup_file'>$backup_file</a>";

?>