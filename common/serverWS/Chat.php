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
        $queryString = $conn->httpRequest->getUri()->getQuery();
        $channel = explode("=", $queryString)[1];
        $this->clients[$channel][$conn->resourceId] = $conn;
        echo "New connection : {$conn->resourceId} | {$channel}\n";

        $arrComments = Comment::find()->where(['task_id' => $channel])->with('creator')->all();
        foreach ($arrComments as $item) {
            $rez[] = [
                'username' => $item->creator->username,
                'comment' => $item->comment
            ];
        }
        $conn->send(json_encode($rez));
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
        foreach ($this->clients[$rez['task_id']] as $client) {
            $client->send(json_encode($rez['comment']));
        }
    }

    function workMessage($msg)
    {
        $mes = json_decode($msg, true);
        $com = new Comment();
        $com->task_id = $mes['task_id'];
        $com->creator_id = $mes['creator_id'];
        $com->comment = $mes['comment'];
        if ($com->save()) {
            $rez['comment'][] = [
                'username' => $com->creator->username,
                'comment' => $com->comment
            ];
            $rez['task_id'] = $com->task_id;
            return $rez;
        }
        return false;
    }
}