    <table class="table table-hover" id="members_table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">{{ __('home.name') }}</th>
                <th scope="col" class="d-none d-sm-table-cell">E-mail</th>
                <th scope="col">{{ __('home.remove') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($members as $member)
                <tr id='row_{{$member->id}}'>
                    <input type="hidden" name="members[]" value="{{$member->id}}" />
                    <td>{{$member->name}}</td>
                    <td class="d-none d-sm-table-cell">{{$member->email}}</td>
                    <td>
                        @if($member->pivot->isAdmin == 0)
                        <button class="btn btn-outline-primary remove-btn" type="button">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-dash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm5-.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                        </button>
                        @endif()
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>