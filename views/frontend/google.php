<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<form class="col-6 m-auto border border-primary p-2 row">
    <div class="mb-3 col-6">
        <label>Tỉnh</label>
        <select id="tinh" class="form-control">
            <option value="0"> Chọn Tỉnh/ Thành phố</option>
        </select>
    </div>
    <div class="mb-3 col-6">
        <label>Huyện</label>
        <select id="huyen" class="form-control">
            <option value="0"> Chọn Quận/ Huyện</option>
        </select>
    </div>
    <div class="mb-3 col-6">
        <label>Xã</label>
        <select id="xa" class="form-control">
            <option value="0"> Chọn Phường/ Xã</option>
        </select>
    </div>
</form>
<!-- secript lấy tỉnh -->
<script>
    $(document).ready(function() {
        $.ajax({
            url: "http://localhost/JavaScript/php/index.php?option=tinh",
            dataType: 'json',
            success: function(data) {
                $("#tinh").html("");
                for (i = 0; i < data.length; i++) {
                    var tinh = data[i];
                    var str = ` 
                    <option value="${tinh['matp']}">${tinh['name']} 
                    </option>`;
                    $("#tinh").append(str);
                }
                $("#tinh").on("change", function(e) {
                    layHuyen();
                });
            }
        });
    })
</script>
<!-- secript lấy huyện trong tỉnh -->
<script>
    function layHuyen() {
        var matp = $("#tinh").val();
        $.ajax({
            url: "http://localhost/JavaScript/php/index.php?option=huyen&matp=" + matp,
            dataType: 'json',
            success: function(data) {
                $("#huyen").html("");
                for (i = 0; i < data.length; i++) {
                    var huyen = data[i];
                    var str = ` 
                    <option value="${huyen['maqh']}">${huyen['name']} 
                    </option>`;
                    $("#huyen").append(str);
                }
                $("#huyen").on("change", function(e) {
                    layXa();
                });
            }
        });
    }
</script>
<!-- secript lấy xã trong huyện -->
<script>
    function layXa() {
        var maqh = $("#huyen").val();
        $.ajax({
            url: "http://localhost/JavaScript/php/index.php?option=xa&maqh=" + maqh,
            dataType: 'json',
            success: function(data) {
                $("#xa").html("");
                for (i = 0; i < data.length; i++) {
                    var xa = data[i];
                    var str = ` 
                    <option value="${xa['xaid']}">${xa['name']} 
                    </option>`;
                    $("#xa").append(str);
                }
            }
        });
    }
</script>