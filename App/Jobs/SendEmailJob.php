<?php
namespace App\Jobs;

use App\Queue\Dispatchable;
use App\Queue\JobInterface;

class SendEmailJob implements JobInterface
{
    use Dispatchable;

    private $email;

    public function __construct($email)
    {
        $this->email = $email;
    }

    public function handle()
    {
//        throw new \Exception('an error happened!');

        echo "Sending an email to $this->email \r\n";
        sleep(1);

    }

}