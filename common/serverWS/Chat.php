<?php

namespace common\serverWS;

use common\models\tables\Comment;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use Ratchet\WebSocket\WsConnection;

class Chat implements MessageComponentInterface
{
    /** @var  WsConnection[] */
    private $clients = [];

    /**
     * Chat constructor.
     */
    public function __construct()
    {
        echo "server started\n";
    }

    /**
     * @param WsConnection $conn
     */
    function onOpen(ConnectionInterface $conn)
    {
        $this->clients[$conn->resourceId] = $conn;
        echo "New connection : {$conn->resourceId}\n";
    }

    /**
     * @param WsConnection $conn
     */
    function onClose(ConnectionInterface $conn)
    {
        unset($this->clients[$conn->resourceId]);
    }

    /**
     * @param WsConnection $conn
     */
    function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo $e->getMessage() . PHP_EOL;
        $conn->close();
        unset($this->clients[$conn->resourceId]);
    }

    /**
     * @param WsConnection $from
     */
    function onMessage(ConnectionInterface $from, $msg)
    {
        $rez = $this->workMessage($msg);
        $from->send($rez);
        //echo "{$from->resourceId}: {$msg}\n";
        //foreach ($this->clients as $client) {s
        //    $client->send(json_encode($rez));
        //}
    }

    function workMessage($msg)
    {
        $mes = json_decode($msg, true);
        $com = new Comment();
        $com->task_id = $mes['task_id'];
        $com->creator_id = $mes['creator_id'];
        $com->comment = $mes['comment'];
        if ($com->save()) {
            $rez['username'] = $com->creator->username;
            $rez['comment'] = $com->comment;
            return json_encode($rez);
        }
        return false;
    }
}