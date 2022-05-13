<?php

namespace App\Http\Controllers;

use Anik\Amqp\ConsumableMessage;
use Anik\Amqp\ProducibleMessage;
use Anik\Laravel\Amqp\Facades\Amqp;
use App\Jobs\ProcessPodcast;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PhotoController extends Controller
{
    public function index()
    {
//        $users = User::all();
//
//        var_dump($users->toArray());
//
////        dispatch(ProcessPodcast::class);
//        for ($i = 0; $i < 50; $i++) {
//            dispatch((new ProcessPodcast('default--' . $i))->onQueue('default'));
//        }
//
//        for ($i = 0; $i < 30; $i++) {
//            dispatch((new ProcessPodcast('high--' . $i))->onQueue('high'));
//        }



        return '12321';
    }

    public function produce()
    {
        for ($i = 0; $i < 5; $i++) {
//            $messages = ['my first message', 'my second message'];
            $messages = new ProducibleMessage('my message');
            Amqp::publish($messages); // publishes to default connection
//            Amqp::connection('rabbitmq')->publish($messages);
//
//            app('amqp')->publish($messages); // publishes to default connection
//            app('amqp')->connection('rabbitmq')->publish($messages); // publishes to rabbitmq connection
        }
    }

    public function consume(Request $request)
    {
        Amqp::connection('rabbitmq')->consume(function(ConsumableMessage $message) {
            var_dump($message->getMessageBody());
            $message->ack();
        }, '', 'amq.topic', 'laravel-amqp'); // consumes from rabbitmq connection

        die('asdf');
    }

}
