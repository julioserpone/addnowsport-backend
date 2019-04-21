<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Artisan;
use Session;
use Mail;
use Redirect;

class CommandsController extends Controller
{

    public function migrate()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        ini_set('max_execution_time', 120);
        Artisan::call('migrate', ["--force"=> true ]);
        Session::flash('message-success', 'Migrated');
        ini_set('max_execution_time', 30);
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        return Redirect::to('/');
    }

    public function rollBackAll()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        ini_set('max_execution_time', 120);
        Artisan::call('migrate:rollback', ["--force"=> true ]);
        Session::flash('message-success', 'Migrated');
        ini_set('max_execution_time', 30);
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        return Redirect::to('/');
    }

    public function rollBackOneStep()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        ini_set('max_execution_time', 120);
        Artisan::call('migrate:rollback  --step=1', ["--force"=> true ]);
        Session::flash('message-success', 'Migrated');
        ini_set('max_execution_time', 30);
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        return Redirect::to('/');
    }

    public function seeder()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        ini_set('max_execution_time', 180);
        Artisan::call('db:seed');
        Session::flash('message-success', 'seeder');
        ini_set('max_execution_time', 30);
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        return Redirect::to('/');
    }

    public function all()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        ini_set('max_execution_time', 600);
        Artisan::call('migrate:reset', ["--force"=> true ]);
        Artisan::call('migrate', ["--force"=> true ]);
        Artisan::call('db:seed');
        Session::flash('message-success', 'Migrated and seeder');
        ini_set('max_execution_time', 30);
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        return Redirect::to('/');
    }

    public function sendmail()
    {
        $emailTosend = "ranaldoraffaele@gmail.com";
        $Asunto = "Email de prueba";
        $name = "CorreoTesteando";
        $data = array('info' => 'Esto es un correo de prueba');
        $view = "emails.prueba";
        Mail::to($emailTosend)->send(new Email($view, $Asunto, $name, $data));
    }

}
