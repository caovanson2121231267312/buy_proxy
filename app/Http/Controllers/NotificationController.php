<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationMail;
use Illuminate\Support\Facades\Queue;

class NotificationController extends Controller
{
    public function index()
    {
        // dd(auth()->user()->id);
        $data_v = Notification::latest()->paginate(10);

        // dd($data_v);
        return view('admin.notifications.index', compact('data_v'));
    }

    public function create()
    {
        return view('admin.notifications.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'users'   => 'nullable|array',
            'users.*' => 'exists:users,id',
        ]);
        // dd($request->users);
        try {
            $notification = Notification::create([
                'title'      => $request->title,
                'content'    => $request->content,
                'send_email' => $request->has('send_email'),
                'user_ids'   => $request->users,
                'user_id'   => auth()->user()->id,
            ]);

            // Nếu tick gửi email
            if ($request->has('send_email') && !empty($request->users)) {
                $users = User::whereIn('id', $request->users)->get();
                foreach ($users as $user) {
                    // Mail::raw($notification->content, function ($message) use ($user, $notification) {
                    //     $message->to($user->email)
                    //         ->subject($notification->title);
                    // });

                    Mail::to($user->email)->queue(new NotificationMail(
                        $notification->title,
                        $notification->content
                    ));
                }
            }

            return redirect()->route('notifications.index')->with('success', 'Thông báo đã được tạo.');
        } catch (Exception $e) {
            // dd($e);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
