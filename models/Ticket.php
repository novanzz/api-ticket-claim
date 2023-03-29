<?php
require "./config/Database.php";

class Ticket
{
    private $conn;
    private $table = "ticket";

    public function __construct()
    {
        $database = new Database();
        $db = $database->connect();
        $this->conn = $db;
    }

    public function read($params = null)
    {
        $query = "SELECT * FROM " . $this->table;
        if (@$params["event_id"] && @$params["status"]) {
            $query .= " WHERE event_id = :event_id  AND status = :status";
            $statement = $this->conn->prepare($query);
            $statement->bindParam(':status', $params["status"], PDO::PARAM_STR);
            $statement->bindParam(':event_id', $params["event_id"], PDO::PARAM_INT);
        } else if (@$params["event_id"]) {
            $query .= " WHERE event_id = :event_id";
            $statement = $this->conn->prepare($query);
            $statement->bindParam(':event_id', $params["event_id"], PDO::PARAM_INT);
        } else if (@$params["status"]) {
            $query .= " WHERE status = :status";
            $statement = $this->conn->prepare($query);
            $statement->bindParam(':status', $params["status"], PDO::PARAM_STR);
        } else {
            $statement = $this->conn->prepare($query);
        }

        $statement->execute();
        return $statement;
    }

    public function change_status($params = null)
    {
        if (
            !@$params["event_id"] ||
            !@$params["ticket_code"] ||
            !@$params["status"] ||
            !@CHOICES_STATUS[$params["status"]]
        ) {
            response(400, null, MESSAGE_NOT_UPDATED);
        }

        $query_update =
            "UPDATE " . $this->table .
            " SET status = :status, updated_at = '" . date("Y-m-d h:i:s") .
            "' WHERE event_id = :event_id AND ticket_code = :ticket_code";
        $statement_update = $this->conn->prepare($query_update);
        $statement_update->bindParam(':status', $params["status"], PDO::PARAM_STR);
        $statement_update->bindParam(':event_id', $params["event_id"], PDO::PARAM_INT);
        $statement_update->bindParam(':ticket_code', $params["ticket_code"], PDO::PARAM_STR);
        $statement_update->execute();

        $query_select =
            "SELECT * FROM " . $this->table .
            " WHERE event_id = :event_id
            AND ticket_code = :ticket_code";
        $statement_select = $this->conn->prepare($query_select);
        $statement_select->bindParam(':event_id', $params["event_id"], PDO::PARAM_INT);
        $statement_select->bindParam(':ticket_code', $params["ticket_code"], PDO::PARAM_STR);
        $statement_select->execute();

        return ["statement_update" => $statement_update, "statement_select" => $statement_select];
    }
}
