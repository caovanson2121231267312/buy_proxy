<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;

class CrawlController extends Controller
{
    public function index()
    {
        // Danh sách domain bạn muốn cho user chọn
        $domains = [
            'vnexpress.net' => 'VNExpress',
            'dantri.com.vn' => 'Dân Trí',
            'thanhnien.vn'  => 'Thanh Niên',
        ];

        return view('admin.crawl.form', compact('domains'));
    }

    public function crawl(Request $request)
    {
        $request->validate([
            'url'    => 'required|url',
            'domain' => 'required',
        ]);

        $url = $request->input('url');
        $domain = $request->input('domain');

        try {
            // Lấy HTML
            $html = file_get_contents($url);

            $crawler = new Crawler($html);

            $title = '';
            $description = '';
            $content = '';
            $image = '';

            switch ($domain) {
                case 'vnexpress.net':
                    $title = $crawler->filter('h1.title-detail')->count() ? $crawler->filter('h1.title-detail')->text() : '';
                    $description = $crawler->filter('p.description')->count() ? $crawler->filter('p.description')->text() : '';
                    $content = $crawler->filter('article.fck_detail')->count() ? $crawler->filter('article.fck_detail')->html() : '';
                    $image = $crawler->filter('meta[property="og:image"]')->count() ? $crawler->filter('meta[property="og:image"]')->attr('content') : '';
                    break;

                case 'dantri.com.vn':
                    $title = $crawler->filter('h1.dt-news__title')->count() ? $crawler->filter('h1.dt-news__title')->text() : '';
                    $description = $crawler->filter('h2.dt-news__sapo')->count() ? $crawler->filter('h2.dt-news__sapo')->text() : '';
                    $content = $crawler->filter('div.dt-news__content')->count() ? $crawler->filter('div.dt-news__content')->html() : '';
                    $image = $crawler->filter('meta[property="og:image"]')->count() ? $crawler->filter('meta[property="og:image"]')->attr('content') : '';
                    break;

                case 'thanhnien.vn':
                    $title = $crawler->filter('h1.details__headline')->count() ? $crawler->filter('h1.details__headline')->text() : '';
                    $description = $crawler->filter('p.details__sapo')->count() ? $crawler->filter('p.details__sapo')->text() : '';
                    $content = $crawler->filter('div.abf-relative')->count() ? $crawler->filter('div.abf-relative')->html() : '';
                    $image = $crawler->filter('meta[property="og:image"]')->count() ? $crawler->filter('meta[property="og:image"]')->attr('content') : '';
                    break;

                default:
                    $title = $crawler->filter('title')->count() ? $crawler->filter('title')->text() : '';
                    $description = $crawler->filter('meta[name="description"]')->count() ? $crawler->filter('meta[name="description"]')->attr('content') : '';
                    $image = $crawler->filter('meta[property="og:image"]')->count() ? $crawler->filter('meta[property="og:image"]')->attr('content') : '';
                    break;
            }

            return view('crawl.result', compact('url', 'domain', 'title', 'description', 'content', 'image'));

        } catch (Exception $e) {
            return back()->with('error', 'Lỗi khi crawl dữ liệu: ' . $e->getMessage());
        }
    }
}
