<?php

use App\Dogs\Commands\FetchDogsCommand;
use Illuminate\Support\Facades\Schedule;

Schedule::command(FetchDogsCommand::class)->everyFiveMinutes();
