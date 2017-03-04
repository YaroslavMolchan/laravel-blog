<?php

namespace App\Http\Controllers;

use App\Repositories\SubscriptionRepository;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    /**
     * @var SubscriptionRepository
     */
    private $subscriptions;

    /**
     * SubscribeController constructor.
     * @param SubscriptionRepository $subscriptions
     */
    public function __construct(SubscriptionRepository $subscriptions)
    {
        $this->subscriptions = $subscriptions;
    }

    public function create(Request $request)
    {
        if (!$request->has('email')) {
            return [
                'ok' => false,
                'message' => 'Email не указан.'
            ];
        }
        $email = $request->input('email');
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return [
                'ok' => false,
                'message' => 'Email указан не верно.'
            ];
        }

        $this->subscriptions->updateOrCreate(['email' => $email]);

        return [
            'ok' => true,
            'message' => '<b>Спасибо.</b> Вы подписаны на рассылку.'
        ];
    }
}
