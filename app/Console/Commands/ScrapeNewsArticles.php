<?php

namespace App\Console\Commands;

use App\Models\NewsArticle;
use Goutte\Client;
use Illuminate\Console\Command;

class ScrapeNewsArticles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:scrape-news-articles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $websites = ['https://www.nbcnews.com/'];

        foreach ($websites as $website) {
            $client = new Client();
            $crawler = $client->request('GET', $website);

            $crawler->filter('a')->each(function ($node) use ($website) {
                $url = $node->attr('href');

                if (preg_match('/^https?:\/\//', $url)) {
                    $client = new Client();
                    $crawler = $client->request('GET', $url);

                    $title = $crawler->filter('title')->text();
                    $content = $crawler->filter('p')->text();
                    $image = $crawler->filter('img')->first()->attr('src') ?? null;

                    $newsArticle = new NewsArticle;
                    $newsArticle->title = $title;
                    $newsArticle->content = $content;
                    $newsArticle->image = $image;
                    $newsArticle->source = $website;
                    $newsArticle->save();
                }
            });
        }
    }
}
