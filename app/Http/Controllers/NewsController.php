<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use jcobhams\NewsApi\NewsApi;

class NewsController extends Controller {

    public function getNewsList( Request $request ) {
        $q = 'tesla';
        $sources = $domains = $exclude_domains = '';
        $from = $to = date( 'Y-m-d', strtotime( '-1 month' ) );
        $language = 'en';
        $page_size = null;
        $page = null;
        $country = 'en';
        $results = [];
        if ( $request->search ||  $request->published_date ) {
            $q = $request->search;
            $date = $request->published_date;
        }
        $newsapi = new NewsApi( env( 'NEWS_API_KEY' ) );

        $sortBy = $newsapi->getSortBy();
        $sort_by = $request->sort_by ? $request->sort_by : 'publishedAt';
        $all_articles = $newsapi->getEverything( $q, $sources, $domains, $exclude_domains, $from, $to, $language, $sort_by,  $page_size, $page );
        $sources = $newsapi->getSources( 'business', $language, 'us' );
        $top_headlines = $newsapi->getTopHeadlines( $q, null, 'us', 'business',  $page_size, $page );
        $results = array_merge( $all_articles->articles, $top_headlines->articles );
        return view( 'news.index', compact( 'results', 'q', 'from', 'sortBy' ) );
    }
}