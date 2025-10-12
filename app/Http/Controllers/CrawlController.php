<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\DomCrawler\Crawler;

class CrawlController extends Controller
{
    public function index()
    {
        // Danh sách domain bạn muốn cho user chọn
        $domains = [
            'vnexpress.net' => 'VNExpress',
            // 'dantri.com.vn' => 'Dân Trí',
            // 'thanhnien.vn'  => 'Thanh Niên',
        ];

        return view('admin.crawl.form', compact('domains'));
    }

    public function crawl(Request $request)
    {
        $request->validate([
            'url'    => 'required|url',
            'domain' => 'required',
            'status' => 'required',
        ]);

        $url = $request->input('url');
        $domain = $request->input('domain');

        try {
            // Lấy HTML
            $html = file_get_contents($url);
            if (preg_match('/<article[^>]*class="[^"]*fck_detail[^"]*"[^>]*>(.*?)<\/article>/is', $html, $match)) {
    $article = $match[1];

    // Loại bỏ href trong tất cả thẻ <a>
    $article = preg_replace('/\s*href\s*=\s*"[^"]*"/i', '', $article);

    // Gắn lại vào nội dung ban đầu
    $html = str_replace($match[1], $article, $html);
}


            $crawler = new Crawler($html);

            $title = '';
            $description = '';
            $content = '';
            $image = '';

            switch ($domain) {
                case 'vnexpress.net':
                    $title = $crawler->filter('header h1')->count()
                        ? $crawler->filter('header h1')->text()
                        : ($crawler->filter('meta[property="og:title"]')->count()
                            ? $crawler->filter('meta[property="og:title"]')->attr('content')
                            : '');

                    $description = $crawler->filter('header p')->count()
                        ? $crawler->filter('header p')->text()
                        : ($crawler->filter('meta[property="og:description"]')->count()
                            ? $crawler->filter('meta[property="og:description"]')->attr('content')
                            : '');

                    if ($crawler->filter('article.fck_detail')->count()) {
                        $content = $crawler->filter('article.fck_detail')->html();
                        // $content = str_ireplace(['VNExpress.vn', 'VNExpress'], 'buyproxy.vn', $content);

                        // 1️⃣ Thay các ảnh lazy-load (data-src -> src)
                        $content = preg_replace_callback(
                            '/<img[^>]+>/i',
                            function ($matches) {
                                $img = $matches[0];
                                if (preg_match('/data-src="([^"]+)"/i', $img, $m)) {
                                    $realSrc = $m[1];
                                    if (preg_match('/src="[^"]*"/i', $img)) {
                                        $img = preg_replace('/src="[^"]*"/i', 'src="' . $realSrc . '"', $img);
                                    } else {
                                        $img = str_replace('<img', '<img src="' . $realSrc . '"', $img);
                                    }
                                }
                                $img = preg_replace('/src="data:image\/[^"]+"/i', '', $img);
                                return $img;
                            },
                            $content
                        );

                        // 2️⃣ Loại bỏ cụm <figure> phức tạp, chỉ giữ lại ảnh + caption
                        $content = preg_replace_callback(
                            '/<figure[^>]*>.*?<\/figure>/is',
                            function ($matches) {
                                $figureHtml = $matches[0];

                                // Lấy URL ảnh trong meta[itemprop=url] hoặc data-src
                                if (preg_match('/itemprop="url"[^>]+content="([^"]+)"/i', $figureHtml, $metaMatch)) {
                                    $imageUrl = $metaMatch[1];
                                } elseif (preg_match('/data-src="([^"]+)"/i', $figureHtml, $dataSrcMatch)) {
                                    $imageUrl = $dataSrcMatch[1];
                                } elseif (preg_match('/src="([^"]+)"/i', $figureHtml, $srcMatch)) {
                                    $imageUrl = $srcMatch[1];
                                } else {
                                    $imageUrl = null;
                                }

                                // Lấy caption (nếu có)
                                $caption = '';
                                if (preg_match('/<figcaption[^>]*>(.*?)<\/figcaption>/is', $figureHtml, $capMatch)) {
                                    $caption = strip_tags($capMatch[1], '<em><strong><b><i>');
                                }

                                // Nếu có ảnh
                                if ($imageUrl) {
                                    $replace = '<p><img src="' . $imageUrl . '" style="max-width:100%;height:auto;" alt="' . e(strip_tags($caption)) . '">';
                                    if ($caption) {
                                        $replace .= '<br>' . $caption;
                                    }
                                    $replace .= '</p>';
                                    return $replace;
                                }

                                // Nếu không có ảnh thì bỏ hẳn <figure>
                                return '';
                            },
                            $content
                        );
                    }

                    $image = $crawler->filter('meta[property="og:image"]')->count()
                        ? $crawler->filter('meta[property="og:image"]')->attr('content')
                        : '';
                    break;

                case 'dantri.com.vn':
                    $title = $crawler->filter('header h1')->count()
                        ? $crawler->filter('header h1')->text()
                        : ($crawler->filter('meta[property="og:title"]')->count()
                            ? $crawler->filter('meta[property="og:title"]')->attr('content')
                            : '');

                    $description = $crawler->filter('header p')->count()
                        ? $crawler->filter('header p')->text()
                        : ($crawler->filter('meta[property="og:description"]')->count()
                            ? $crawler->filter('meta[property="og:description"]')->attr('content')
                            : '');

                    $content = $crawler->filter('div.dt-singular-content')->count()
                        ? $crawler->filter('div.dt-singular-content')->html()
                        : '';

                    $image = $crawler->filter('meta[property="og:image"]')->count()
                        ? $crawler->filter('meta[property="og:image"]')->attr('content')
                        : '';
                    break;

                case 'thanhnien.vn':
                    $title = $crawler->filter('header h1')->count()
                        ? $crawler->filter('header h1')->text()
                        : ($crawler->filter('meta[property="og:title"]')->count()
                            ? $crawler->filter('meta[property="og:title"]')->attr('content')
                            : '');

                    $description = $crawler->filter('header p')->count()
                        ? $crawler->filter('header p')->text()
                        : ($crawler->filter('meta[property="og:description"]')->count()
                            ? $crawler->filter('meta[property="og:description"]')->attr('content')
                            : '');

                    $content = $crawler->filter('div.abf-relative')->count()
                        ? $crawler->filter('div.abf-relative')->html()
                        : '';

                    $image = $crawler->filter('meta[property="og:image"]')->count()
                        ? $crawler->filter('meta[property="og:image"]')->attr('content')
                        : '';
                    break;

                default:
                    $title = $crawler->filter('header h1')->count()
                        ? $crawler->filter('header h1')->text()
                        : ($crawler->filter('title')->count()
                            ? $crawler->filter('title')->text()
                            : '');

                    $description = $crawler->filter('header p')->count()
                        ? $crawler->filter('header p')->text()
                        : ($crawler->filter('meta[name="description"]')->count()
                            ? $crawler->filter('meta[name="description"]')->attr('content')
                            : '');

                    $image = $crawler->filter('meta[property="og:image"]')->count()
                        ? $crawler->filter('meta[property="og:image"]')->attr('content')
                        : '';
                    break;
            }

            // ✅ Lưu ảnh đại diện (nếu có)
            $localImagePath = null;
            if ($image) {
                try {
                    $response = Http::get($image);
                    if ($response->successful()) {
                        $filename = 'post_' . time() . '.jpg';
                        Storage::disk('public')->put('posts/' . $filename, $response->body());
                        $localImagePath = 'posts/' . $filename;
                    }
                } catch (\Exception $e) {
                    Log::error('Không thể tải ảnh: ' . $e->getMessage());
                }
            }

            // ✅ Lưu bài viết
            Post::create([
                'title'       => $title,
                'content'     => $content,
                'description' => $description,
                'user_id'     => auth()->id(),
                'status'      => $request->status,
                'image'       => $localImagePath ?? null,
            ]);

            return redirect()->route('posts.index')->with(['success' => 'Đã cào ' . $url]);
        } catch (\Exception $e) {
            return back()->with('error', 'Lỗi khi crawl dữ liệu: ' . $e->getMessage());
        }
    }
}
