<?php

namespace App\Http\Controllers;

use Google\Cloud\PubSub\PubSubClient;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    /**
     * POST /publish
     * Send a message to the topic
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function publish(Request $request)
    {
        $request->validate([
            'data'=>'required'
        ]);

        $pubSubClient = new PubSubClient([
            'keyFile' => json_decode(file_get_contents(storage_path(env('GOOGLE_APPLICATION_CREDENTIALS'))), true)
        ]);

        $topic = $pubSubClient->topic('demo')
            ->publish([
                'data' => $request->get('data'),
                'attributes' => [
                    'location' => 'Sydney'
                ]
            ]);

        return response()->json($topic, 200);
    }
}
