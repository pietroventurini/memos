<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\User;
use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

class GroupController extends Controller
{
    
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('group',['except' => ['create', 'store']]);
        $this->middleware('group.admin',['only' => ['edit', 'update', 'destroy']]);
    }

    public function show($group_id) {
        $user_id = auth()->id();

        $group = Group::find($group_id);
        return view('group/group')->with('group', $group);
    }

    public function create() {
        return view('group/create');
    }

    public function index() {
        return redirect('home');
    }


    public function store(Request $request) {
        // TODO aggiungere validazione dei campi !!!!

        if (!$request->filled('name'))
            return redirect()->back()->withErrors(['msg'=> __('home.group.name.missing')]);

        // Create group
        $user = User::find(auth()->id());
        $group = new Group();
        $group->name = $request->input('name');
        $group->description = $request->input('description');
        $group->save();
        // Attach group to user and set administrator
        $user->groups()->attach($group, array('isAdmin' => true));

        // Add other members
        if($request->has('members')) {
            foreach ($request->input('members') as $member_email) {
                if ($member_email !== null) {
                    $member = User::where('email','like',$member_email)->first();
                    if ($member !== null)
                        if (!$member->belongsToGroup($group->id))
                            $member->groups()->attach($group, array('isAdmin' => false));
                }
            }
        }
        
        // Redirect to group
        return redirect()->route('groups.edit', ['group' => $group->id]);
    }

    public function edit($group_id) {
        $group = Group::find($group_id);
        $members = $group->users;
        return view('group.edit.edit')->with(['group'=>$group, 'members'=> $members]);
    }

    /**
     * Update group information such as title, description and members
     */
    public function update(Request $request) {
        $group = Group::find($request->route('group'));
        $admin =  $group->admin->first();
        $members_ids = array(); //IDs of new members
        $old_members_ids = array(); //IDs of old members

        foreach($group->users as $user) {
            array_push($old_members_ids, $user->id);
        }

        // TODO add name validation (check empty/length...)
        if ($request->has('name') && $request->filled('name')) {
            $name = $request->input('name');
            $group->name = $name;
            $group->save();
        }
        // TODO add description validation (check length...)
        if ($request->has('description')) {
            $desc = $request->input('description');
            $group->description = $desc;
            $group->save();
        }
        if ($request->has('members')) 
            $members_ids = $request->input('members');
        
        
        // add new members
        foreach ($members_ids as $member_id) {
            if (!in_array($member_id, $old_members_ids) && ($member_id != $admin->id)) {
                $group->users()->attach($member_id, array('isAdmin' => false)); //add the new member
                echo $member_id . " is a new member <br>";
            }   
        }

        // remove removed members
        foreach ($old_members_ids as $old_member_id) {
            if (!in_array($old_member_id, $members_ids) && ($old_member_id != $admin->id)) {
                $group->users()->detach($old_member_id); //remove the member
                echo $old_member_id . " is removed <br>";
            }   
        } 
        
        return redirect()->route('groups.show', ['group' => $group->id]);
    }

    public function destroy($group_id) {
        $group = Group::find($group_id);
        if ($group !== null) {
            $group->delete();
            return response()->json(['message' => "__('home.group.deleted')"], 200);
        }
        
        return redirect()->back()->withErrors(['msg'=> __('home.error.group')]);
    }
}
