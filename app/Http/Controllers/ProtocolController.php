<?php

namespace App\Http\Controllers;

use App\Models\Cv;
use App\Models\Tarima;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Inertia\Inertia;


class ProtocolController extends Controller
{
    public function index()
    {
        return Inertia::render('Protocolos/Protocolos');
    }

    public function store($value)
    {
        return Inertia::render('Protocolos/Protocolos', ['Value' => $value]);
    }

    public function showTar(Request $request)
    {
        $cv = Cv::where('codigo', $request->id)->first();
        $tar = Tarima::where('cvs_id', $cv->id)->get();
        return Inertia::render('Protocolos/Protocolos', ['tarimas' => $tar, 'cv' => $cv]);
    }

    public function servidor()
    {
        error_reporting(E_ALL);

        /* Permitir al script esperar para conexiones. */
        set_time_limit(0);

        /* Activar el volcado de salida implícito, así veremos lo que estamos obteniendo
 * mientras llega. */
        ob_implicit_flush();

        $address = '127.0.0.1';
        $port = 1337;

        if (($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) === false) {
            echo "socket_create() falló: razón: " . socket_strerror(socket_last_error()) . "\n";
        }

        if (socket_bind($sock, $address, $port) === false) {
            echo "socket_bind() falló: razón: " . socket_strerror(socket_last_error($sock)) . "\n";
        }

        if (socket_listen($sock, 5) === false) {
            echo "socket_listen() falló: razón: " . socket_strerror(socket_last_error($sock)) . "\n";
        }

        do {
            if (($msgsock = socket_accept($sock)) === false) {
                echo "socket_accept() falló: razón: " . socket_strerror(socket_last_error($sock)) . "\n";
                break;
            }
            /* Enviar instrucciones. */
            $msg = "\nBienvenido al Servidor De Prueba de PHP. \n" .
                "Para salir, escriba 'quit'. Para cerrar el servidor escriba 'shutdown'.\n";
            socket_write($msgsock, $msg, strlen($msg));

            do {
                if (false === ($buf = socket_read($msgsock, 2048, PHP_NORMAL_READ))) {
                    echo "socket_read() falló: razón: " . socket_strerror(socket_last_error($msgsock)) . "\n";
                    break 2;
                }
                if (!$buf = trim($buf)) {
                    continue;
                }
                if ($buf == 'quit') {
                    break;
                }
                if ($buf == 'shutdown') {
                    socket_close($msgsock);
                    break 2;
                }
                echo "$buf\n";
            } while (true);
            socket_close($msgsock);
        } while (true);

        socket_close($sock);
    }
}
