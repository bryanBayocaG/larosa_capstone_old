<?php

namespace App\Console\Commands;

use App\Models\RentInfo;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CheckOverdue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-overdue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $apiKey = 'da96e8b9124390d6e9a85bfc253e6cea';

        // $currentDate = Carbon::now()->format('Y-m-d');

        // DB::table('rent_infos')
        //     ->where('return_date', '<', $currentDate)
        //     ->where('status', 'Renting')
        //     ->update(['status' => 'Overdue']);

        // $overDueRent = RentInfo::where('status', 'Overdue')->get();

        // foreach ($overDueRent as $Orent) {
        //     $message = 'Dear ' . $Orent->first_name . ' ' . $Orent->first_name . ', we would like to inform you about the Rent you had made is Overdue, this will result in having a fine of 300 pesos penalty each day this rented Item/Set is not returned.';
        //     $cleanedNumber = str_replace('-', '', $Orent->contact_num);
        //     $client = new Client();
        //     $client->post('https://semaphore.co/api/v4/messages', [
        //         'form_params' => [
        //             'apikey' => $apiKey,
        //             'number' => $cleanedNumber,
        //             'message' => $message,
        //             'sendername' => 'LAROSA',
        //         ],
        //         'verify' => false,
        //     ]);
        // }

            $message = 'Dear hoyhoyhoy testing sang dynanimic';
            $client = new Client();
            $client->post('https://semaphore.co/api/v4/messages', [
                'form_params' => [
                    'apikey' => $apiKey,
                    'number' => '09667984996',
                    'message' => $message,
                    'sendername' => 'LAROSA',
                ],
                'verify' => false,
            ]);
    }
}
