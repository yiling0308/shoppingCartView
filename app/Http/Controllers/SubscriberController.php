<?php
namespace App\Http\Controllers;

use Google\Cloud\PubSub\PubSubClient;

class SubscriberController extends Controller
{
    /**
     * GET /pull
     * Pull and acknowledge the messages that were sent to the topic
     *
     * @return void
     */
    public function pull()
    {
        $pubsub = new PubSubClient([
            'keyFile' => json_decode(file_get_contents(storage_path(env('GOOGLE_APPLICATION_CREDENTIALS'))), true)
        ]);

        $pubsub->topic('demo');

        $subscription = $pubsub->subscription('demo-sub');

        $messages = $subscription->pull();

        foreach ($messages as $message) {
            echo $message->data() . "\n";
            $subscription->acknowledge($message);
        }
    }
}
