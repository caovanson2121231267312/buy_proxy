<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Proxy;
use App\Models\Notification;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    public function index(Request $request)
    {
        $data = Proxy::where('status', 1)->where('api_id', 1)
                    ->get()
                    ->groupBy('proxy_type');

        $arr = [];

        foreach($data as $key => $value) {
            $arr[] = Proxy::where('proxy_type', $key)
                    ->where('status', 1)
                    ->get()
                    ->groupBy('use_time_min');
        }

            // dd($arr);
        return view('seo.index', [
            "data" => $arr,
        ]);
    }



    // Danh sách bài viết
    public function blog(Request $request)
    {
        // Lấy danh sách bài viết, mới nhất lên đầu
        $posts = Post::with('user')
            ->where('status', 1) // chỉ lấy bài viết đã duyệt (nếu bạn muốn)
            ->orderBy('created_at', 'desc')
            ->paginate(10); // chia trang, mỗi trang 10 bài

        return view('shop.posts.index', compact('posts'));
    }

    // Xem chi tiết bài viết theo slug
    public function show($slug)
    {
        $post = Post::with('user')->where('slug', $slug)->firstOrFail();
        return view('shop.posts.show', compact('post'));
    }

    public function lien_he(Request $request)
    {
        // Notification::latest()->delete();

        return view('seo.lien_he', [

        ]);
    }

    public function submit_lien_he(Request $request)
    {
        Notification::create([
            "title" => $request->title,
            "content" => $request->name . ' ' . $request->phone . ' ' . $request->email . ' ' . $request->content,
            "user_id" => 1,
            "user_ids" => [1],
        ]);
        return redirect()->back()->with(['success' => 'Đã gửi yêu cầu hỗ trợ tới admin']);
    }
}
