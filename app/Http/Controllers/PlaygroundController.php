<?php

namespace App\Http\Controllers;

use Facebook\WebDriver\Exception\NoSuchElementException;
use Facebook\WebDriver\Exception\TimeoutException;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\Panther\Client;

class PlaygroundController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Playground');
    }

    /**
     * @throws NoSuchElementException
     * @throws TimeoutException
     */
    public function runTest(Request $request)
    {
        $client = Client::createChromeClient();
        $client->request('GET', 'https://www.recreation.gov/');
        $crawler = $client->waitFor('.sarsa-heading-title');

        // return the title and links
        return $crawler->filter('.sarsa-heading-title')->nodeName();
    }
}
