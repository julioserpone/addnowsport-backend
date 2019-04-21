<?php

namespace App\Jobs;

use App\Usuario;
use App\Jobs\Job;
use Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmail extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $data;
    protected $model;

    /**
     * Create a new job instance.
     *
     * @param  User  $user
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
        $this->model = $this->data['model'];
        unset($this->data['model']);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //NOTE: If you use the $this->data in the Mail: queue, we serialization error
        $to = $this->data['email'];
        $subject = $this->data['subject'];
        $attachments = (isset($this->data['attachments']) ? : null);

        //This defines a variable named $ data, within sight of the email. If you want to create another variable, you assign the same but with another associative array
        $content['data'] = $this->data;

        try {
            Mail::queue($this->data['template'], $content, function ($message) use ($to, $subject, $attachments, $content) {
                $message->to($to)->subject($subject);
                if ($attachments) {
                    foreach ($attachments as $key => $attachment) {
                        $message->attach($attachment);
                    }
                }
            });

            //$this->model->createLog($action);
        }
        catch(\Exception $e){
            $this->failed($e->getMessage());
        }
    }

    public function failed($e)
    {
        dd($e);
        //$this->model->createLog('not_send_mail',$e);
    }

}
