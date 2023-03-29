<?php
require "./models/Ticket.php";

class TicketController
{
    private $ticket;
    private $params;

    public function __construct($params)
    {
        $ticket = new Ticket();
        $this->ticket = $ticket;
        $this->params = $params;
    }

    public function ListTicket()
    {
        $result = $this->ticket->read();
        $result = $result->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) < 1) {
            response(400, null, ERROR_MESSAGE_TICKET_NOT_FOUND);
        }

        $return = [];
        foreach ($result as $data) {
            array_push($return, [
                "ticket_code" => $data["ticket_code"],
                "status" => $data["status"],
            ]);
        }
        response(200, $return);
    }

    public function DetailTicket()
    {
        $result =  $this->ticket->read($this->params);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);

        if (!$this->params || count($result) < 1) {
            response(400, null, ERROR_MESSAGE_TICKET_NOT_FOUND);
        }

        $return = [];
        foreach ($result as $data) {
            array_push($return, [
                "ticket_code" => $data["ticket_code"],
                "status" => $data["status"],
            ]);
        }
        response(200, $return);
    }

    public function ChangeStatus()
    {
        $result =  $this->ticket->change_status($this->params);
        $num = $result["statement_update"]->rowCount();

        if ($num < 1) {
            response(400, null, MESSAGE_NOT_UPDATED);
        }

        $data = $result["statement_select"]->fetch(PDO::FETCH_ASSOC); 
        $updated_at = new DateTime($data["updated_at"]);
        $return = [
            "ticket_code" => $data["ticket_code"],
            "status" => $data["status"],
            "updated_at" => $updated_at->getTimestamp(),
        ];
        response(200, $return);
    }
}
