<?php
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
    DB::listen(function($sql, $bindings, $time){

        $logFile = storage_path('logs/query.log');
        $monolog = new Logger('log');
        $monolog->pushHandler(new StreamHandler($logFile), Logger::INFO);
        if (strpos($sql, 'select ') !== false) {
            // This is a select query. No modification to db. Do not log.
        } elseif (strpos($sql, 'insert into `log`') !== false){
            // Do not log db interactions that insert into log. Do not log.
        } else {
            // Probably a valid interaction for logging

            if (\Auth::check()) {
                $name = \Auth::user()->name;
                $email = \Auth::user()->email;
                $id = \Auth::user()->id;
            } else {
                $name = 'guest';
                $email = 'guest';
                $id = -1;
            }
            $monolog->info('Account Name: ' . $name);
            $monolog->info('Account E-Mail: ' . $email);
            $monolog->info('Account ID: ' . $id);
            $monolog->info($sql,  compact('bindings', 'time'));
            $timestamp = date('Y-m-d H:i:s');
            DB::table('log')->insert([
                ['email' => $email, 'Action' => $sql, 'name' => $name, 'created_at' => $timestamp]
            ]);
        }




    });
?>