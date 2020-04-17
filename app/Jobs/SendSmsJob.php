<?php

namespace App\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendSmsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    private $to;
    private $message;
    
    /**
    * Create a new job instance.
    *
    * @return void
    */
    public function __construct($to, $message)
    {
        $this->to = $to;
        $this->message = $message;
    }
    
    /**
    * Execute the job.
    *
    * @return void
    */
    public function handle()
    {
        try {
            $response_json = sendSms($this->to, $this->message);
            $response = json_decode($response_json);
            $status = $response->response_code;
            if ($status == 200) {
                Log::info('SMS sent to: ' . $this->to . " -> " . $response_json. ' Message Body: ' . $this->message );
                return true;
            } else {
                throw new Exception('Invalid response from server: ' . $response_json);
            }
        } catch (Exception $e) {
            Log::error('SMS failed: ' + $e->getMessage());
            return false;
        }
    }
}
