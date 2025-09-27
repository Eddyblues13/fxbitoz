<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminToUserEmail;

class EmailController extends Controller
{
    /**
     * Send email to specific user
     */
    public function sendToUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            $user = User::findOrFail($request->user_id);

            // Send email
            Mail::to($user->email)->send(new AdminToUserEmail(
                $request->subject,
                $request->message,
                $user->name
            ));

            // Log this action
            $this->logAdminAction('Sent email to user: ' . $user->email);

            return redirect()->back()->with('message', 'Email sent successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error sending email: ' . $e->getMessage());
        }
    }

    private function logAdminAction($action)
    {
        \Log::info('Admin Email Action: ' . auth()->user()->email . ' - ' . $action);
    }
}
