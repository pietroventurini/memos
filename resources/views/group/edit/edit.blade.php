@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                    <h5 class="card-header">{{__('home.edit') . " " . $group->name }}</h5>

                    <div class="card-body">
                        <!--tratto da https://getbootstrap.com/docs/4.5/components/forms/#custom-styles-->
                        <form class="needs-validation"  action="{{ route('groups.update', ['group' => $group->id]) }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom01">{{ __('home.name') }}</label>
                                    <input type="text" class="form-control" id="validationCustom01" name="name" 
                                            value="{{$group->name}}" aria-describedby="nameHelpBlock" autocomplete="off" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom02">{{ __('home.description') }}</label>
                                    <input type="text" class="form-control" id="validationCustom02" name="description" 
                                            value="{{$group->description}}" aria-describedby="descHelpBlock" autocomplete="off">
                                </div>
                            </div>


                            <!-- Table of group members -->
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label> {{ __('home.members') }} </label>
                                    @include('group.edit.members')
                                </div>
                            </div>

                            <!-- Add a new member -->
                            <div class="form-row">
                                <div class="form-group col-xs-12 col-sm-6 col-md-4">
                                    <label for="validationCustom03"> {{ __('home.group.member.new') }} </label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="email@address.com" id="usr_email" 
                                                name="usr_email" aria-describedby="memberHelpBlock">

                                        <div class="input-group-append">
                                            <button class="btn btn-outline-primary" type="button" name="add_member" id="add_member">
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-plus-fill" 
                                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm7.5-3a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                                                <path fill-rule="evenodd" d="M13 7.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0v-2z"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <span id="error_email" class="text-danger"></span>
                                    <input type="hidden" name="row_id" value="hidden_row_id" />
                                </div>
                            </div>


                            <button class="btn btn-primary float-right btn-lg m-1" type="submit" name="submit" id="submit">
                                {{ __('home.edit') }}
                            </button>
                        </form>

                        
                        <button class="btn btn-danger float-right btn-lg m-1" id="destroy"> {{__('home.delete')}} </button>
                        <a class="btn btn-secondary float-right btn-lg m-1" href="{{route('groups.show', ['group' => $group->id])}}" role="button"> {{__('home.cancel')}} </a>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    function isAlreadyInTable(id) {
        if ($('#row_'+id).length)
            return true;
        return false;
    }

    function addNewRow(member) {
        const err_already_there = member.name + ' is already in this group';
        if (isAlreadyInTable(member.id)) {
            $('#error_email').text(err_already_there);
            $('#usr_email').val('');
        } else {
            var new_row = '';
            new_row = "<tr id='row_" + member.id + "' >";
            new_row += "<input type='hidden' name='members[]' value='" + member.id + "' />";
            new_row += "<td>" + member.name + "</td>";
            new_row += "<td class='d-none d-sm-table-cell'>" + member.email + "</td>";
            new_row += "<td><button class='btn btn-outline-danger remove-btn' type='button'>";
            new_row += "<svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-person-dash-fill' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>";
            new_row += "<path fill-rule='evenodd' d='M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm5-.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z'/>";
            new_row += "</svg>";
            new_row += "</button></td>";
            new_row += "</tr>";

            $('#members_table').append(new_row);
            $('#usr_email').val('');
        }
    }

    function validateEmail(email) {
        const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }

    function validate() {
        const error_email = 'This email is not valid';
        const error_user = "There aren't any users with this email"
        const email = $('#usr_email').val();
        if (validateEmail(email)) {
            $('#error_email').text('');
            $('#usr_email').css('border-color', '');

            $.ajax({
                type: 'GET',
                url: '/users',
                dataType: 'json',
                data: {
                    email: email,
                },
                success: function(response){
                    addNewRow(response.user)
                },
                error: function(response) {
                    $('#error_email').text(response.responseJSON.message);
                    $('#usr_email').css('border-color', '#cc0000');
                }
            })
        } else {
            $('#error_email').text(error_email);
            $('#usr_email').css('border-color', '#cc0000');
        }
    }


    $(document).ready(function() {
        

        $('#add_member').click(function() {
            validate() 
        });

        $("#members_table tbody").on("click", ".remove-btn", function(event){
            $(this).closest('tr').remove();
        });
        

        $('#destroy').click(function() {
            $.ajax({
                type: 'DELETE',
                url: "{{route('groups.destroy', ['group' => $group->id]) }}",
                contentType: 'application/json',
                success: function(response){
                    window.location.href = "/home";
                },
                error: function(response) {
                    window.location.href = "/home";
                }
            })
        })
        


    });


</script>
@endsection




