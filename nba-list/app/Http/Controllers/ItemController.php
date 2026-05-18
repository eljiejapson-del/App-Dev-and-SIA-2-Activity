<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    private $players = [
        ['id' => 1, 'name' => 'Stephen Curry', 'position' => 'Point Guard', 'team' => 'GS Warriors', 'number' => '30', 'image' => 'https://ak-static.cms.nba.com/wp-content/uploads/headshots/nba/latest/260x190/201939.png'],
        ['id' => 2, 'name' => 'LeBron James', 'position' => 'Small Forward', 'team' => 'LA Lakers', 'number' => '23', 'image' => 'https://ak-static.cms.nba.com/wp-content/uploads/headshots/nba/latest/260x190/2544.png'],
        ['id' => 3, 'name' => 'Nikola Jokic', 'position' => 'Center', 'team' => 'Denver Nuggets', 'number' => '15', 'image' => 'https://ak-static.cms.nba.com/wp-content/uploads/headshots/nba/latest/260x190/203999.png'],
        ['id' => 4, 'name' => 'Luka Doncic', 'position' => 'Point Guard', 'team' => 'Dallas Mavericks', 'number' => '77', 'image' => 'https://ak-static.cms.nba.com/wp-content/uploads/headshots/nba/latest/260x190/1629029.png'],
        ['id' => 5, 'name' => 'Giannis Antetokounmpo', 'position' => 'Power Forward', 'team' => 'Milwaukee Bucks', 'number' => '34', 'image' => 'https://ak-static.cms.nba.com/wp-content/uploads/headshots/nba/latest/260x190/203507.png'],
        ['id' => 6, 'name' => 'Kevin Durant', 'position' => 'Power Forward', 'team' => 'Phoenix Suns', 'number' => '35', 'image' => 'https://ak-static.cms.nba.com/wp-content/uploads/headshots/nba/latest/260x190/201142.png'],
        ['id' => 7, 'name' => 'Ja Morant', 'position' => 'Point Guard', 'team' => 'Memphis Grizzlies', 'number' => '12', 'image' => 'https://ak-static.cms.nba.com/wp-content/uploads/headshots/nba/latest/260x190/1629630.png'],
        ['id' => 8, 'name' => 'Jayson Tatum', 'position' => 'Small Forward', 'team' => 'Boston Celtics', 'number' => '0', 'image' => 'https://ak-static.cms.nba.com/wp-content/uploads/headshots/nba/latest/260x190/1628369.png'],
        ['id' => 9, 'name' => 'Joel Embiid', 'position' => 'Center', 'team' => 'Philly 76ers', 'number' => '21', 'image' => 'https://ak-static.cms.nba.com/wp-content/uploads/headshots/nba/latest/260x190/203954.png'],
        ['id' => 10, 'name' => 'Kyrie Irving', 'position' => 'Point Guard', 'team' => 'Dallas Mavericks', 'number' => '11', 'image' => 'https://ak-static.cms.nba.com/wp-content/uploads/headshots/nba/latest/260x190/202681.png'],
        ['id' => 11, 'name' => 'Anthony Edwards', 'position' => 'Shooting Guard', 'team' => 'MN Timberwolves', 'number' => '5', 'image' => 'https://ak-static.cms.nba.com/wp-content/uploads/headshots/nba/latest/260x190/1630162.png'],
        ['id' => 12, 'name' => 'Victor Wembanyama', 'position' => 'Center', 'team' => 'SA Spurs', 'number' => '1', 'image' => 'https://ak-static.cms.nba.com/wp-content/uploads/headshots/nba/latest/260x190/1641705.png'],
        ['id' => 13, 'name' => 'S. Gilgeous-Alexander', 'position' => 'Point Guard', 'team' => 'OKC Thunder', 'number' => '2', 'image' => 'https://ak-static.cms.nba.com/wp-content/uploads/headshots/nba/latest/260x190/1628983.png'],
        ['id' => 14, 'name' => 'Devin Booker', 'position' => 'Shooting Guard', 'team' => 'Phoenix Suns', 'number' => '1', 'image' => 'https://ak-static.cms.nba.com/wp-content/uploads/headshots/nba/latest/260x190/1626164.png'],
        ['id' => 15, 'name' => 'Damian Lillard', 'position' => 'Point Guard', 'team' => 'Milwaukee Bucks', 'number' => '0', 'image' => 'https://ak-static.cms.nba.com/wp-content/uploads/headshots/nba/latest/260x190/203081.png'],
        ['id' => 16, 'name' => 'Kawhi Leonard', 'position' => 'Small Forward', 'team' => 'LA Clippers', 'number' => '2', 'image' => 'https://ak-static.cms.nba.com/wp-content/uploads/headshots/nba/latest/260x190/202695.png'],
    ];

    public function index() {
        return view('items.index', ['items' => $this->players]);
    }

    public function show($id) {
        $item = collect($this->players)->firstWhere('id', $id);
        if (!$item) abort(404);

        // ERROR FIX: We pass 'items' so count() in layouts/app.blade.php doesn't crash
        return view('items.show', [
            'item' => $item,
            'items' => $this->players 
        ]);
    }
}