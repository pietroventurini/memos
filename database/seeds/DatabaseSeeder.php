<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Marco',
            'email' => 'marco@memos.unibs.it',
            'email_verified_at' => now(),
            'password' => bcrypt('marco')
        ]);
        
        User::create([
            'name' => 'Anna',
            'email' => 'anna@memos.unibs.it',
            'email_verified_at' => now(),
            'password' => bcrypt('anna')
        ]);

        User::create([
            'name' => 'Pietro',
            'email' => 'pietro@memos.unibs.it',
            'email_verified_at' => now(),
            'password' => bcrypt('pietro')
        ]);

        $dl = new DataLayer();
        $user1 = $dl->getUserID('marco@memos.unibs.it');
        $user2 = $dl->getUserID('anna@memos.unibs.it');
        $user3 = $dl->getUserID('pietro@memos.unibs.it');

        // boh, non so come popolare gli attributi delle tabelle pivot (many-to-many)

    }
}
