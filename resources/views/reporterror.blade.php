@extends('partials.master')

@section('content')
    @if (Auth::check())
        <div class="container">
            <div class="col-xs-12 col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Report a problem with the server:</div>
                        <div class="panel-body">
                            <div class="form-area">
                                <form role="form" method="POST" action="{{ route('submiterror') }}">
                                    {{ csrf_field() }}
                                    <br style="clear:both">
                                    <div class="form-group">
                                        <label for="date">Date encountered:</label>
                                        <input type="date" class="form-control" id="date" name="date" value="{{ date('Y-m-d') }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Describe the error:</label>
                                        <textarea class="form-control" id="message" name="description" maxlength="500" rows="7"></textarea>
                                        <span class="help-block"><p id="characterLeft" class="help-block ">You have reached the limit</p></span>
                                    </div>
                                    <button type="submit" id="submit" name="btnSubmit" class="btn btn-primary pull-right">Submit Form</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">

            $(document).ready(function(){
                $('#characterLeft').text('500 characters left');
                $('#message').keydown(function () {
                    var max = 500;
                    var len = $(this).val().length;
                    if (len >= max) {
                        $('#characterLeft').text('You have reached the limit');
                        $('#characterLeft').addClass('red');
                        $('#btnSubmit').addClass('disabled');
                    }
                    else {
                        var ch = max - len;
                        $('#characterLeft').text(ch + ' characters left');
                        $('#btnSubmit').removeClass('disabled');
                        $('#characterLeft').removeClass('red');
                    }
                });
            });
        </script>
    @else
        <h2>You shouldn't be seeing this, someone messed up.</h2>
    @endif
@stop