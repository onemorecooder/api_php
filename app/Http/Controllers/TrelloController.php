<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class TrelloController extends Controller
{
    public function index($boardId)
    {
        $client = new Client(['base_uri' => 'https://api.trello.com/1/']);
        $response = $client->request('GET', 'boards/' . $boardId . '/cards', [
            'query' => [
                'key' => env('TRELLO_KEY'),
                'token' => env('TRELLO_TOKEN'),
            ],
        ]);
        $cards = json_decode($response->getBody(), true);
        return view('trello.cards', ['cards' => $cards, 'boardId' => $boardId]);
    }

    public function getBoards()
    {
        $client = new Client(['base_uri' => 'https://api.trello.com/1/']);
        $response = $client->request('GET', 'members/me/boards', [
            'query' => [
                'key' => env('TRELLO_KEY'),
                'token' => env('TRELLO_TOKEN'),
            ],
        ]);
        $boards = json_decode($response->getBody());
        return view('trello.boards', ['boards' => $boards]);
    }

    public function showCreateCardForm($boardId)
    {
        return view('trello.create_card', ['idBoard' => $boardId]);
    }

    public function storeCard(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'idBoard' => 'required',
        ]);

        $client = new Client(['base_uri' => 'https://api.trello.com/1/']);
        $response = $client->request('POST', 'cards', [
            'query' => [
                'key' => env('TRELLO_KEY'),
                'token' => env('TRELLO_TOKEN'),
                'idList' => $this->getFirstListId($validatedData['idBoard']),
                'idBoard' => $validatedData['idBoard'],
                'name' => $validatedData['name'],
                'desc' => $validatedData['description'],
                'due' =>  $request->input('dueDate'),
            ],
        ]);
        return redirect()->route('cards.index', ['boardId' => $validatedData['idBoard']]);
    }


    public function getFirstListId($boardId)
    {
        $client = new Client(['base_uri' => 'https://api.trello.com/1/']);
        $response = $client->request('GET', 'boards/' . $boardId . '/lists', [
            'query' => [
                'key' => env('TRELLO_KEY'),
                'token' => env('TRELLO_TOKEN'),
            ],
        ]);
        $lists = json_decode($response->getBody(), true);
        return $lists[0]['id'];
    }

    public function edit($id)
    {
        $client = new Client(['base_uri' => 'https://api.trello.com/1/']);
        $response = $client->request('GET', "cards/{$id}", [
            'query' => [
                'key' => env('TRELLO_KEY'),
                'token' => env('TRELLO_TOKEN'),
            ],
        ]);
        $card = json_decode($response->getBody(), true);
        $boardId = $card['idBoard']; // Extract the boardId from the response
        return view('trello.edit', ['card' => $card, 'cardId' => $id, 'boardId' => $boardId]);
    }

    public function update(Request $request, $cardId)
    {
        $client = new Client(['base_uri' => 'https://api.trello.com/1/']);
        $response = $client->request('PUT', "cards/{$cardId}", [
            'query' => [
                'key' => env('TRELLO_KEY'),
                'token' => env('TRELLO_TOKEN'),
                'name' => $request->input('name'),
                'desc' => $request->input('description'),
                'due' => $request->input('dueDate'),
            ],
        ]);

        $boardId = $request->input('boardId');

        return redirect()->route('cards.index', ['boardId' => $boardId]);
    }
}
