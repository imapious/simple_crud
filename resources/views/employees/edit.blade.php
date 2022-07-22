<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    {{-- Jquery --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <title>Simple Crud for Employee</title>
  </head>
  <body class="m-4">

    <h1>Create New Employee</h1>

    @include('flash-message')

    <div class="card m-3"  style="width: 30rem;">

        <div class="card-header">
            <h5>Employee Details</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('employees.update', $employee->id) }}">
                @csrf
                @method('PATCH')
                <div class="mb-3">
                  <label for="full_name" class="form-label">Full Name</label>
                  <input type="text" class="form-control" name="full_name" id="full_name" value="{{ $employee->full_name }}" required>
                </div>
                <div class="mb-3">
                    <label for="birthdate" class="form-label">Birthdate</label>
                    <input type="date" class="form-control @if ($errors->has('birthdate')) is-invalid @endif"  name="birthdate" id="birthdate" value="{{ $employee->birthdate }}"  required>
                    @if ($errors->has('birthdate'))
                        @foreach ($errors->all() as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                </div>
                <div class="mb-3">
                    <label for="department" class="form-label">Department</label>
                    <select class="form-select js-select-departments mb-3" name="department" id="department" value="{{ $employee->department }}">
                        <option selected disabled value="0">--Select a department--</option>
                        @if ($departments)
                            @foreach ($departments as $single_department)
                                <option {{ $single_department->department === $employee->department ? 'selected' : '' }} value="{{ $single_department->department }}">{{ $single_department->department }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            $('.js-select-departments').select2({
                placeholder: "Select a department",
                allowClear: true,
                tags: true
            });

            $('.js-select-departments').on("change", function (e) {
                if (this.value === '0') {
                    $('.other_department').css('display', 'block');
                } else {
                    $('.other_department').css('display', 'none');
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>