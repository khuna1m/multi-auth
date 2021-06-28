<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
<title>Form</title>

<style>
    body {
        padding-bottom: 3%
    }
    .container {
        font-family: 'Prompt', sans-serif;
    }

    label {
        width: 100%;
    }

    .card {
        margin-top: 15px;
    }

    .card-header {
        padding: 1.35rem 1.75rem 0rem 1.75rem;
        margin-bottom: 0;
        background-color: rgba(255, 255, 255, 0.03);
        border-bottom: none !important;
    }

    .card-body {
        padding: 0.75rem 1.75rem;
    }

    button.btn.btn-dark {
        margin-top: 15px;
    }

    button.btn.btn-link{
        color: #cf2e2e;
        font-weight: 700;
        padding: 0;
    }

    button.btn.btn-link:hover {
        color: #902020;
        text-decoration: none;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div id="address-card">
                <div class="card">
                    <div class="card-header">
                        <h5>รายละเอียดที่อยู่
                            {{-- <span><button id="delete" class="btn btn-link float-right">✕</button><span> --}}
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="">
                            <div class="form-group">
                                <label for="province">จังหวัด</label>
                                <select class="form-control province" data-indexclass="province">
                                    <option selected disabled>โปรดเลือกจังหวัด</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="district">เขต/อำเภอ</label>
                                        <select class="form-control district" data-indexclass="district">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sub-district">แขวง/ตำบล</label>
                                        <select class="form-control sub-district" data-indexclass="sub-district">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="postcode">รหัสไปรษณีย์</label>
                                <input class="form-control postcode" readonly>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <button id="add" type="button" class="btn btn-dark">+
                เพิ่มที่อยู่ใหม่</button>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    // Call a function
    getProvince();addAddress();deleteAddress();

    function getProvince() {
        $.ajax({
            url: 'api/get-provinces',
            data: 'data',
            dataType: 'JSON',
            success: function(result) {
                // console.log(result); 
                result.provinces.forEach(function(province) {
                    $('.province').append(
                        `<option value="${province.id}">${province.name}</option>`)
                });
            },
            error: function(error) {
                console.log('error')
            }
        });
    }

    function addAddress() { 
        $('.container').on('click', '#add', function() {
            $('#address-card').append(
                document.getElementsByClassName('card')[0].outerHTML
            );
            $('#address-card').find('h5').not(':first').last().append(
                `<span><button id="delete" class="btn btn-link float-right">✕</button><span>`
            );
        });
    }

    function deleteAddress() { 
        $('#address-card').on('click', '#delete', function() {
            // $(this).parent().parent().remove().end();
            console.log($(this).parent().find('.card'));
            $(this).parent().parent().parent().parent().not(document.getElementsByClassName('card')[0]).remove().end();
        });
    }
    
    // Trigger getDistrict() after province's field is selected
    $('#address-card').on('change', '.province', function() {
        let selectedElement = $(this).parent().find('.province');
        let provinceID = selectedElement.val();
        let dataClass = selectedElement.attr('data-indexclass');
        let currentIndex = $('.' + dataClass).index(selectedElement);
        
        console.log({selectedElement}, {currentIndex}, {provinceID});
        getDistrict(currentIndex, provinceID);
    });

    function getDistrict(index, id) {
        //Remove old districts when choose new value in province field
        $('.district').eq(index).find('option').remove();

        $.ajax({
            url: 'api/get-districts?id=' + id,
            type: 'GET',
            data: 'data',
            dataType: 'JSON',
            success: function(result) { // console.log(result);
                $('.district').eq(index).append(`<option selected disabled>โปรดเลือกเขต/อำเภอ</option>`);
                result.districts.forEach(function(district) {
                    $('.district').eq(index).append(
                        `<option value="${district.id}">${district.name}</option>`)
                });
            },
            error: function(error) {
                console.log('error')
            }
        });
    }

    // Trigger getSubDistrict() after district's field is selected
    $('#address-card').on('change', '.district', function() {
        let selectedElement = $(this).parent().find('.district');
        let districtID = selectedElement.val();
        let dataClass = selectedElement.attr('data-indexclass');
        let currentIndex = $('.' + dataClass).index(selectedElement);
        
        console.log({selectedElement}, {currentIndex}, {districtID});
        getSubDistrict(currentIndex, districtID);
    });

    function getSubDistrict(index, id) {
        //Remove old districts when choose new value in province field
        $('.sub-district').eq(index).find('option').remove();

        $.ajax({
            url: 'api/get-sub-districts?id=' + id,
            type: 'GET',
            data: 'data',
            dataType: 'JSON',
            success: function(result) { // console.log(result);
                $('.sub-district').eq(index).append(`<option selected disabled>โปรดเลือกแขวง/ตำบล</option>`);
                result.subdistricts.forEach(function(subdistrict) {
                    $('.sub-district').eq(index).append(
                        `<option value="${subdistrict.id}">${subdistrict.name}</option>`)
                });
            },
            error: function(error) {
                console.log('error')
            }
        });
    }

    // Trigger getPostcode() after subdistrict's field is selected
    $('.container').on('change', '.sub-district', function() {
        let selectedElement = $(this).parent().find('.sub-district');
        let subdistrictID = selectedElement.val();
        let currentIndex = $('.sub-district').index(selectedElement);
        console.log({selectedElement}, {currentIndex}, {subdistrictID});
        getPostcode(currentIndex, subdistrictID);  
    });

    function getPostcode(index, id) {
            $.ajax({
            url: 'api/get-sub-district?id=' + id,
            type: 'GET',
            data: 'data',
            dataType: 'JSON',
            success: function(result) {
                //console.log(result.subdistrict);
                result.subdistrict.forEach(function(subdistrict) {
                    $('.postcode').eq(index).val(subdistrict.postcode);
                });
            },
            error: function(error) {
                console.log('error')
            }
        });
    }
</script>