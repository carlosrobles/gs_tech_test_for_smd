<?php

use Aws\Sqs\SqsClient;
use Aws\Exception\AwsException;

class GoldenScent_Publisher_Model_Publisher
{
    protected $client;

    public function __construct()
    {
        $this->client = new SqsClient([
            'region' => 'ap-south-1',
            'version' => '2012-11-05',
            'credentials' => [
                'key' => getenv('AWS_ACCESS_KEY_ID'),
                'secret' => getenv('AWS_SECRET_ACCESS_KEY'),
            ]
        ]);
    }

    /*
     * Publish mesage to sqs
     */
    public function publish($url, $message)
    {
        try {
            $params = [
                'DelaySeconds' => 10,
                'MessageBody' => $message,
                'QueueUrl' => $url
            ];
            $this->client->sendMessage($params);
            //TODO: need to log order ids after publishing them for reference
        } catch (AwsException $e) {
            //TODO: need to log in magento
            error_log($e->getMessage());
        }
    }
}