<?php

namespace App\Http\Services\General;

use App\Models\Emdad\RelatedCompanies;

use function PHPUnit\Framework\isEmpty;

class UrwayGateway
{
  public  static function initPayment($request)
  {

    $curl = curl_init();
    $txn_details = $request['trackId'] . "|" . config('services.urway.id') . "|" . config('services.urway.pass') . "|" . config('services.urway.key') . "|" . $request['amount'] . "|".config('services.urway.currency');
    $hash = hash('sha256', $txn_details);
    curl_setopt_array($curl, array(
      CURLOPT_URL => config('services.urway.url'),
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => '
      {
      "transid": ' . $request['transId'] . ',
      "trackid": ' . $request['trackId'] . ',
      "terminalId": '.config('services.urway.id').',
      "action": "1",
      "udf2":"http://172.21.1.116:9090/payment",
      "customerEmail" : "'.$request['email'].'",
      "merchantIp": "10.10.10.101",
      "password": '.config('services.urway.pass').',
      "country":'.config('services.urway.country').',
      "currency": '.config('services.urway.currency').',
      "amount": ' . $request['amount'] . ',
      "requestHash":"' . $hash . '"
      }',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
      ),
    ));

    $response = curl_exec($curl);
    // dd($response);

    curl_close($curl);

    return $response;
  }

  public  static function getPaymentStatus($request)
  {
    $curl = curl_init();
    $txn_details = $request['trackId'] . "|" . config('services.urway.id') . "|" . config('services.urway.pass') . "|" . config('services.urway.key') . "|" . $request['amount'] . "|".config('services.urway.currency');
    $hash = hash('sha256', $txn_details);
    curl_setopt_array($curl, array(
      CURLOPT_URL => config('services.urway.url'),
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => '
      {
      "transid": ' . $request['transId'] . ',
      "trackid": ' . $request['trackId'] . ',
      "terminalId": '.config('services.urway.id').',
      "action": "10",
      "customerEmail" : "' . $request['email'] . '",
      "merchantIp": "10.10.10.101",
      "password": '.config('services.urway.pass').',
      "country":'.config('services.urway.country').',
      "currency": '.config('services.urway.currency').',
      "udf1": "1",
      "amount": ' . $request['amount'] . ',
      "requestHash":"' . $hash . '"
      }',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    return $response;
  }
}
