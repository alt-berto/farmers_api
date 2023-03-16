<?php

namespace App\Http\Controllers;
use App\User;
use App\Order;
use Illuminate\Support\Facades\Mail;

use Laravel\Lumen\Routing\Controller as BaseController;

/**
 * @OA\Info(
 * 	title="Farmers API",
 *  version="0.0.1",
 *  @OA\Contact(
 *  	email="alberto@pis83digital.com",
 *      name="Piso83 Digital Developer"
 *  )
 * )
 */

class Controller extends BaseController
{
    //

    protected function invitation_mail(int $order_id): string {
        $order = Order::with(['details.inventory_price.inventory.product'])->where('state', 1)->where('id', $order_id)->firstOrFail();
        $user = User::where('client_id', $order->client_id)->firstOrFail();


        $subject = "Notificación de canjeo de : $user->first_name $user->last_name - Orden #$order->id";
        $parameters = [
            'user' => $user,
            'order' => $order,
            'subject' => $subject,
            'to' => (string) $user->email,
            'to_name' => ($user->first_name . ' ' . $user->last_name),
            'copies' => [
                'ing.molinanestor@gmail.com',
                //'aurora.matamoros@upl-ltd.com'
                ]
        ];

        try {
            Mail::send('mail.notification', $parameters, static function($message) use ($parameters) {
                $message->to($parameters['to'], $parameters['to_name'])->subject($parameters['subject']);
                $message->from(env('MAIL_FROM_CONTACT'), 'UPL FARMERS');
            });
            return 'send';
        } catch ( \Exception $e ) {
            return $e->getMessage();
        }
    }
}
