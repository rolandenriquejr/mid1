<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Customers</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    {{--Filter Table CSS --}}
    {!! Html::style('css/filtertable.css')  !!}

  </head>
  <body>
    <div class="container">
        <h3>List of Customers</h3>
        <div class="row pull-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCustomer">
              Add New Customer
            </button>
            {{-- {{ Html::linkRoute('customers.create', 'Add New Customer', array(), array('class' => 'btn btn-primary')) }} --}}
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="panel panel-primary filterable">
                <div class="panel-heading">
                    <h3 class="panel-title">Customers</h3>
                    <div class="pull-right">
                        <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr class="filters">
                            <th><input type="text" class="form-control" placeholder="Last Name" disabled></th>
                            <th><input type="text" class="form-control" placeholder="First Name" disabled></th>
                            <th><input type="text" class="form-control" placeholder="Address" disabled></th>
                            <th><input type="text" class="form-control text-right" placeholder="Action" disabled></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($customers as $customer)
                        <tr>
                            <td>{{ $customer->first_name }}</td>
                            <td>{{ $customer->last_name }}</td>
                            <td>{{ $customer->address }}</td>
                            <td class="text-right">
        
                            <button class="edit-modal btn btn-success " data-id="{{$customer->id}}" data-fname="{{$customer->first_name}}" data-lname="{{$customer->last_name}}" data-address="{{$customer->address}}"><i class="glyphicon glyphicon-pencil"></i></button>

                            </td>
                            <td class="text-left">
                            {!! Form::open(['route' => ['customers.destroy', $customer->id], 'method' => 'DELETE']) !!}
                                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit' ,'class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </dir>

    {{-- Edit Modal --}}
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="panel panel-primary">
              <div class="panel-heading">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="panel-title" id="myModalLabel"><b>Edit Customer</b></h4>
              </div>
            <div class="modal-body">
                @if($customers->count() == 0)
                {!! Form::open(['method' => 'PUT']) !!} {{-- This should be Form::Model --}}
                @else
                {!! Form::model($customer, ['route' => ['customers.update', $customer->id], 'method' => 'PUT']) !!} {{-- This should be Form::Model --}}
                @endif
                    {!! Form::hidden('id', null, ['id' => 'fid', 'class' => 'form-control', 'required' => '']) !!} {{-- the "id" here match the "#fid" in the javascript --}}

                    {!! Form::label('name', 'First Name:') !!}
                    {!! Form::text('first_name', null, ['id' => 'fname', 'class' => 'form-control', 'required' => '', 'maxlength' => '35']) !!} {{-- the "id" here match the "#name" in the javascript --}}
                    
                    {!! Form::label('name', 'Last Name:') !!}
                    {!! Form::text('last_name', null, ['id' => 'lname', 'class' => 'form-control', 'required' => '', 'maxlength' => '35']) !!}

                    {!! Form::label('address', 'Address:') !!}
                    {!! Form::text('address', null, ['id' => 'address', 'class' => 'form-control', 'required' => '', 'maxlength' => '35']) !!}

                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-dismiss="modal" style="margin-top:20px">Cancel</button>
                      {!! Form::submit('Update', ['class' => 'btn btn-success', 'style' => 'margin-top: 20px']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
          </div>
        </div>
    </div>

    <!-- Add Customer Modal -->
    <div class="modal fade" id="addCustomer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Add New Customer</h4>
          </div>
          <div class="modal-body">
            {!! Form::open([]) !!} {{-- edit to include your route --}}
                {!! Form::label('last_name', 'Last Name:') !!}
                {!! Form::text('last_name', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '15')) !!}
                
                {!! Form::label('first_name', 'First Name:') !!}
                {!! Form::text('first_name', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '15')) !!}

                {!! Form::label('address', 'Address:') !!}
                {!! Form::text('address', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '30')) !!}
               
          </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" style="margin-top:20px">Close</button>
                {!! Form::submit('Add New Customer', array('class' => 'btn btn-primary', 'style' => 'margin-top: 20px')) !!}
              </div>
            {!! Form::close() !!}
        </div>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    {{--Filter Table Script --}}
    {!! Html::script('js/filtertable.js') !!}

    {{-- Edit Data Modal Javascript--}}
    <script type="text/javascript">
        $(document).on('click', '.edit-modal', function() {
            $('.form-horizontal').show();
            $('#fid').val($(this).data('id'));   {{-- refer to the edit button above this is data-id --}}
            $('#fname').val($(this).data('fname')); {{-- refer to the edit button above this is data-name --}}
            $('#lname').val($(this).data('lname')); {{-- refer to the edit button above this is data-name --}}
            $('#address').val($(this).data('address')); {{-- refer to the edit button above this is data-address --}}
            $('#myModal').modal('show');                {{-- when the edit button is clicked this values are passed into the modal. Name (id) of the modal is myModal --}}
        });
    </script>
  </body>
</html>