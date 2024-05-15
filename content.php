<form action="" method="post">
            <fieldset class="fs1">
                <legend style="border: 1px solid rgb(95, 94, 94); padding: 20px; border-radius: 40px;">Order Management</legend>
                <div>
                    <label for="">User Name</label>
                    <input type="text" name="nameCus">
                </div>
                <!-- <div>
                    <label for="">Date</label>
                    <input type="date" name="dateOr">
                </div> -->
                <div>
                    <label for="">Status</label>
                    <select id="st1" name="status">
                        <option value="-1">Select Status</option>
                        <option value="0">Chưa Xác Nhận</option>
                        <option value="1">Đã Xác Nhận</option>
                        <option value="2"> Đã Giao Thành Công</option>
                        <option value="3"> Đã Huỷ</option>
                    </select>
                </div>
                <div>
                    <label for="">&nbsp</label>
                    <input type="submit" name="searchOr" id="" value="Search" onclick="loaddingpageOrder()">
                </div>
            </fieldset>
            </form>