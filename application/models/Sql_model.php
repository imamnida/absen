<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sql_model extends CI_Model {

    public function execute_sql_commands($commands) {
        $output = '';
        foreach ($commands as $command) {
            if (!empty(trim($command))) {
                $result = $this->db->query($command);
                if (!$result) {
                    $output .= "<p>Error executing SQL command: " . $this->db->error()['message'] . "</p>";
                }
            }
        }
        return $output;
    }

    public function drop_all_tables() {
        $output = '';
        $tables = $this->db->list_tables();
        foreach ($tables as $table) {
            $drop_result = $this->db->query("DROP TABLE IF EXISTS $table");
            if ($drop_result) {
                $output .= "<p>Tabel $table berhasil dihapus.</p>";
            } else {
                $output .= "<p>Error menghapus tabel $table: " . $this->db->error()['message'] . "</p>";
            }
        }
        return "<h2>Semua Tabel Berhasil Dihapus</h2>" . $output;
    }

    public function truncate_all_tables() {
        $output = '';
        $tables = $this->db->list_tables();
        foreach ($tables as $table) {
            $truncate_result = $this->db->query("TRUNCATE TABLE $table");
            if ($truncate_result) {
                $output .= "<p>Tabel $table berhasil dikosongkan.</p>";
            } else {
                $output .= "<p>Error mengosongkan tabel $table: " . $this->db->error()['message'] . "</p>";
            }
        }
        return "<h2>Semua Tabel Berhasil Dikosongkan</h2>" . $output;
    }

    public function upload_sql_file($file_path) {
        $output = '';
        $sql_file_content = file_get_contents($file_path);
        $sql_commands = explode(';', $sql_file_content);
        $output .= $this->execute_sql_commands($sql_commands);
        return $output;
    }
}
?>
