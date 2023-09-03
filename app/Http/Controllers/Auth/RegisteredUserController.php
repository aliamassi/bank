<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Currency;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:' . User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $this->createAccounts($user);
//        Account::factory()->count(3)->create();

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * @param $user
     * @return void
     */
    public function createAccounts($user): void
    {
        $euro = Currency::create(['name' => 'EUR', 'code' => 978]);
        $euro_account = $euro->accounts()->create(['user_id' => $user->id]);
        $euro_account->account_number = str_pad($euro_account->id + 1, 5, "0", STR_PAD_LEFT).'-'.$euro->code;
        $euro_account->save();

        $usd = Currency::create(['name' => 'USD', 'code' => 840]);
        $usd_account = $usd->accounts()->create(['user_id' => $user->id]);
        $usd_account->account_number = str_pad($usd_account->id + 1, 5, "0", STR_PAD_LEFT).'-'.$usd->code;
        $usd_account->save();

        $jod = Currency::create(['name' => 'JOD', 'code' => 400]);
        $jod_account = $jod->accounts()->create(['user_id' => $user->id]);
        $jod_account->account_number = str_pad($jod_account->id + 1, 5, "0", STR_PAD_LEFT).'-'.$jod->code;
        $jod_account->save();
    }
}
