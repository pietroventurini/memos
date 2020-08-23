<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataLayer extends Model
{
    public function getUserID($email) {
        $users = User::where('email', $email)->get(['id']);
        return $users[0]->id;
    }

    public function getGroupsOfUser($user_id) {
        //$groups = Group::where('user_id', $user_id)->get();
        $groups = User::find($user_id)->groups()->get();
        //$groups = User::find($user_id)->groups;
        return $groups;
    }

    public function getUsersOfGroup($group_id) {
        $users = Group::find($group_id)->users()->get();
    }

    public function getMemosOfGroup($group_id) {
        return Memo::where('group_id', $group_id)
                    ->orderBy('expires_at', 'asc')
                    ->get();
        // equivalente a
        // return $group_id->$memos ma probabilmente non posso invocarci sopra orderBy
    }

    public function getShoplistsOfGroup($group_id) {
        return Shoplist::where('group_id', $group_id)
                    ->orderBy('expires_at', 'asc')
                    ->get();
    }

    public function getMemosOfUser($user_id) {
        return Memo::where('user_id', $user_id)
                    ->orderBy('expires_at', 'asc')
                    ->get();
    }

    public function getShoplistsOfUser($user_id) {
        return Shoplist::where('user_id', $user_id)
                    ->orderBy('expires_at', 'asc')
                    ->get();
    }
}
