<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Address Dropdowns</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom Styles */
        body {
            padding: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Filter By:</h2>
        <form id="addressForm" action="{{ route('generate-pdf') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="region">Region:</label>
                <select id="region" name="region" class="form-control">
                    <option value="">Select region</option>
                    @foreach ($regions as $region)
                        <option value="{{ $region->region_code }}">{{ $region->region_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="province">Province:</label>
                <select id="province" name="province" class="form-control" disabled>
                    <option value="">Select province</option>
                </select>
            </div>
            <div class="form-group">
                <label for="municipality">Municipality:</label>
                <select id="municipality" name="municipality" class="form-control" disabled>
                    <option value="">Select Municipality</option>
                </select>
            </div>
            <div class="form-group">
                <label for="barangay">Barangay:</label>
                <select id="barangay" name="barangay" class="form-control" disabled>
                    <option value="">Select Barangay</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){


            $('#region').change(function(){
                var province_id = $(this).val();
                if(province_id){
                    $.ajax({
                        type: 'GET',
                        url: '/noncomis/public/province/' + province_id,
                        success: function(response){
                            $('#province').empty();
                            $('#municipality').empty();
                            $('#barangay').empty();
                            $('#province').append('<option value="">Select Province</option>');
                            $.each(response, function(key, value){
                                $('#province').append('<option value="'+ value.province_code +'">'+ value.province_name +'</option>');
                            });
                            $('#province').prop('disabled', false);
                        }
                    });
                } else {
                    $('#province').empty();
                    $('#municipality').empty();
                    $('#barangay').empty();
                    $('#municipality').prop('disabled', true);
                    $('#barangay').prop('disabled', true);
                }
            });

        
            $('#province').change(function(){
                var province_id = $(this).val();
                if(province_id){
                    $.ajax({
                        type: 'GET',
                        url: '/noncomis/public/municipalities/' + province_id,
                        success: function(response){
                            $('#municipality').empty();
                            $('#barangay').empty();
                            $('#municipality').append('<option value="">Select Municipality</option>');
                            $.each(response, function(key, value){
                                $('#municipality').append('<option value="'+ value.municipality_code +'">'+ value.municipality_name +'</option>');
                            });
                            $('#municipality').prop('disabled', false);
                        }
                    });
                } else {
                    $('#municipality').empty();
                    $('#barangay').empty();
                    $('#municipality').prop('disabled', true);
                    $('#barangay').prop('disabled', true);
                }
            });



            $('#municipality').change(function(){
                var municipality_id = $(this).val();
                if(municipality_id){
                    $.ajax({
                        type: 'GET',
                        url: '/noncomis/public/barangays/' + municipality_id,
                        success: function(response){
                            $('#barangay').empty();
                            $('#barangay').append('<option value="">Select Barangay</option>');
                            $.each(response, function(key, value){
                                $('#barangay').append('<option value="'+ value.barangay_code +'">'+ value.barangay_name +'</option>');
                            });
                            $('#barangay').prop('disabled', false);
                        }
                    });
                } else {
                    $('#barangay').empty();
                    $('#barangay').prop('disabled', true);
                }
            });
        });
    </script>



     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>
</html>
