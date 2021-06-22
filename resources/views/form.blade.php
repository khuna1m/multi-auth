<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">

<style>
    .container {
        font-family: 'Prompt', sans-serif;
    }

    label {
        width: 100%;
    }

    .card {
        margin-top: 10%;
    }

</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">รายละเอียดที่อยู่</div>
                <div class="card-body">
                    <form action="">
                        <div class="form-group">
                            <label for="province">จังหวัด</label>
                            <select class="form-control" id="province" onchange="getDistrict()">
                                <option selected disabled>โปรดเลือกจังหวัด</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="district">เขต/อำเภอ</label>
                                    <select class="form-control" id="district" onchange="getSubDistrict()">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sub-district">แขวง/ตำบล</label>
                                    <select class="form-control" id="subdistrict" onchange="getPostcode()">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="postcode">รหัสไปรษณีย์</label>
                            <input class="form-control" id="postcode" readonly>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    // Call to use a function
    getProvince();

    function getPostcode() {
        var selectedDistrict = $('#district').val();
        console.log(selectedDistrict);

        $.ajax({
            url: 'api/get-sub-district?id=' + selectedDistrict,
            type: 'GET',
            data: 'data',
            dataType: 'JSON',
            success: function(result) {
                console.log(result);
                result.subdistricts.forEach(function(subdistrict) {
                    $('#postcode').val(subdistrict.postcode)
                });
            },
            error: function(error) {
                console.log('error')
            }
        });
    }

    function getSubDistrict() {
        var selectedDistrict = $('#district').val();
        console.log(selectedDistrict);

        //Remove old sub-districts when choose new value in district field
        $('#subdistrict').find('option').remove();

        $.ajax({
            url: 'api/get-sub-district?id=' + selectedDistrict,
            type: 'GET',
            data: 'data',
            dataType: 'JSON',
            success: function(result) {
                console.log(result);
                result.subdistricts.forEach(function(subdistrict) {
                    $('#subdistrict').append(
                        `<option value="${subdistrict.id}">${subdistrict.name}</option>`)
                });
            },
            error: function(error) {
                console.log('error')
            }
        });
    }

    function getDistrict() {
        var selectedProvince = $('#province').val();
        console.log(selectedProvince);

        //Remove old districts when choose new value in province field
        $('#district').find('option').remove();

        $.ajax({
            url: 'api/get-district?id=' + selectedProvince,
            type: 'GET',
            data: 'data',
            dataType: 'JSON',
            success: function(result) {
                // console.log(result);
                result.districts.forEach(function(district) {
                    $('#district').append(
                        `<option value="${district.id}">${district.name}</option>`)
                });
            },
            error: function(error) {
                console.log('error')
            }
        });
    }

    function getProvince() {
        $.ajax({
            url: 'api/get-province',
            data: 'data',
            dataType: 'JSON',
            success: function(result) {
                // console.log(result);
                result.provinces.forEach(function(province) {
                    $('#province').append(
                        `<option value="${province.id}">${province.name}</option>`)
                });
            },
            error: function(error) {
                console.log('error')
            }
        });
    }
</script>
