<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * عرض صفحة إدخال البريد الإلكتروني لطلب رابط إعادة تعيين كلمة المرور.
     */
    public function create(): View
    {
        return view('seller.forgot-password');
    }

    /**
     * معالجة طلب إرسال رابط إعادة تعيين كلمة المرور.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        
        $status = Password::broker('sellers')->sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
    }
}
