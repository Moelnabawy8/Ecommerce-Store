<?php

namespace App\Http\Controllers\Admin;

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
        return view('Admin.forgot-password');
    }

    /**
     * معالجة طلب إرسال رابط إعادة تعيين كلمة المرور.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // استخدام broker الخاص بـ admins
        $status = Password::broker('admins')->sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
    }
}
