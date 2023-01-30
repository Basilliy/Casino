<html lang="en">
<head>
    <title>Register</title>
</head>
<body>
<style>
    * {box-sizing: border-box}

    .container {
        padding: 16px;
    }

    input[type=text], input[type=password] {
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px 0;
        display: inline-block;
        border: none;
        background: #f1f1f1;
    }

    input[type=text]:focus, input[type=password]:focus {
        background-color: #ddd;
        outline: none;
    }

    hr {
        border: 1px solid #f1f1f1;
        margin-bottom: 25px;
    }

    .history {
        background-color: #0f6bff;
        color: white;
        padding: 16px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
        opacity: 0.9;
    }

    .generatebtn {
        background-color: #4CAF50;
        color: white;
        padding: 16px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
        opacity: 0.9;
    }

    .off {
        background-color: #ff0000;
        color: white;
        padding: 16px 20px;
        margin: 8px 0;
        border: none;
        width: 100%;
        opacity: 0.9;
    }

    .luckybtn {
        background-color: #ffab00;
        color: white;
        padding: 16px 20px;
        margin: 8px 0;
        border: none;
        width: 100%;
        opacity: 0.9;
    }

    .generatebtn:hover {
        opacity:1;
    }

    a {
        color: dodgerblue;
    }
</style>

{{--@if (session()->has('success'))--}}
{{--    <div class="link">{{ session('success')[0]}}</div>--}}
{{--@endif--}}
{{--<form action="{{route('user.create')}}" method="POST">--}}
{{--    {{csrf_field()}}--}}
{{--    <div class="container">--}}
{{--        <h1>Register</h1>--}}

{{--        <hr>--}}

{{--        @if($errors->has('user_name'))--}}
{{--            <div class="error">{{ $errors->first('user_name') }}</div>--}}
{{--        @endif--}}
{{--        <label for="email"><b>Username</b></label>--}}
{{--        <input type="text" placeholder="Enter Username" name="user_name" required>--}}

{{--        @if($errors->has('phone_number'))--}}
{{--            <div class="error">{{ $errors->first('phone_number') }}</div>--}}
{{--        @endif--}}
{{--        <label for="psw"><b>Phone number</b></label>--}}
{{--        <input type="text" placeholder="Enter phone number" name="phone_number" required>--}}
{{--        <hr>--}}

{{--        <button type="submit" class="registerbtn">Register</button>--}}
{{--    </div>--}}
{{--</form>--}}

<div>
    <button type="submit" class="generatebtn" style="width: 45%" onclick="getNew()">Generate new link</button>
    <p style="display: none" id="newLinkField"></p>
</div>

<div>
    <button type="submit" class="off" style="width: 45%" onclick="turnOff()">Turn link OFF</button>
    <p style="display: none" id="linkDeactivationField"></p>
</div>

<div>
    <button type="submit" class="luckybtn" style="width: 45%" onclick="lucky()">Im feeling lucky</button>
    <p style="display: none" id="resultField"></p>
    <p style="display: none" id="numberField"></p>
    <p style="display: none" id="sumField"></p>
</div>

<div>
    <button type="submit" class="history" style="width: 45%" onclick="history()">History</button>
    <p style="display: none" id="historyError"></p>
    <table style="display: none" id="historyField">
        <thead>
            <tr>
                <th>Result</th>
                <th>Number</th>
                <th>Sum</th>
            </tr>
        </thead>
        <tbody id="historyData">

        </tbody>
    </table>
</div>

</body>

<script src="{{asset('js/scripts.min.js')}}"></script>
<script>

    function hideAll()
    {
        $('#newLinkField').hide().html('');
        $('#linkDeactivationField').hide().html('');
        $('#resultField').hide().html('');
        $('#numberField').hide().html('');
        $('#sumField').hide().html('');
        $('#historyError').hide().html('');
        $('#historyField').hide();
        $('#historyData').html('');
    }

    function getNew()
    {
        hideAll();
        $.ajax("{{route('link.new')}}", {
            type: "POST",
            data: {
                link_code: "{{$link_code}}",
                _token: "{{csrf_token()}}",
            },
            statusCode: {
                200: function (response) {
                    $('#newLinkField').show().html('<a href="'+response.link+'">New link for you</a>');
                },
                404: function (response) {
                    $('#newLinkField').show().html(response.message);
                },
                422: function (response) {
                    $('#newLinkField').show().html('validation error');
                },
            },
        });
    }

    function turnOff()
    {
        hideAll();
        $.ajax("{{route('link.deactivate')}}", {
            type: "PUT",
            data: {
                link_code: "{{$link_code}}",
                _token: "{{csrf_token()}}",
            },
            statusCode: {
                200: function (response) {
                    $('#linkDeactivationField').show().html('Link was deactivated');
                    location.reload()
                },
                404: function (response) {
                    $('#linkDeactivationField').show().html('Some wrong');
                },
                422: function (response) {
                    $('#linkDeactivationField').show().html('Validation error');
                },
            },
        });
    }

    function lucky()
    {
        hideAll();
        $.ajax("{{route('game.new')}}", {
            type: "POST",
            data: {
                link_code: "{{$link_code}}",
                _token: "{{csrf_token()}}",
            },
            statusCode: {
                201: function (response) {
                    $('#resultField').show().html(response.data.result);
                    $('#numberField').show().html(response.data.number);
                    $('#sumField').show().html(response.data.sum);
                },
                404: function (response) {
                    $('#resultField').show().html(response.error);
                },
                422: function (response) {
                    $('#resultField').show().html('Validation error');
                },
            },
        });
    }

    function history()
    {
        hideAll();
        $.ajax("{{route('game.history')}}", {
            type: "GET",
            data: {
                link_code: "{{$link_code}}",
                _token: "{{csrf_token()}}",
            },
            statusCode: {
                200: function (response) {
                    var games = '';
                    $.each(response.data, function (index, value) {
                        games+= '<tr>'
                            +'<td>' + value.result + '<td>'
                            +'<td>' + value.number + '<td>'
                            +'<td>' + value.sum + '<td>'
                            +'</td>';
                    });
                    $('#historyData').html(games);
                    $('#historyField').show();
                },
                404: function (response) {
                    $('#historyError').show().html('Some error');
                },
                422: function (response) {
                    $('#historyError').show().html('Validation error');
                },
            },
        });
    }

</script>
</html>
