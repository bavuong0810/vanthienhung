<?php
/*
 * IPN URL: Ghi nhận kết quả thanh toán từ VNPAY
 * Các bước thực hiện:
 * Kiểm tra checksum 
 * Tìm giao dịch trong database
 * Kiểm tra tình trạng của giao dịch trước khi cập nhật
 * Cập nhật kết quả vào Database
 * Trả kết quả ghi nhận lại cho VNPAY
 */
@include "admin/lib/config.php";
@include "admin/lib/function.php";
date_default_timezone_set('Asia/Ho_Chi_Minh');

global $d;
$d = new func_index($config['database']);

$inputData = array();
$returnData = array();
$vnp_HashSecret = getenv('VNPAY_SECRET');
$data = $_REQUEST;
foreach ($data as $key => $value) {
    if (substr($key, 0, 4) == "vnp_") {
        $inputData[$key] = $value;
    }
}

$vnp_SecureHash = $inputData['vnp_SecureHash'];
unset($inputData['vnp_SecureHashType']);
unset($inputData['vnp_SecureHash']);
ksort($inputData);
$i = 0;
$hashData = "";
foreach ($inputData as $key => $value) {
    if ($i == 1) {
        $hashData = $hashData . '&' . $key . "=" . $value;
    } else {
        $hashData = $hashData . $key . "=" . $value;
        $i = 1;
    }
}
$vnpTranId = $inputData['vnp_TransactionNo']; //Mã giao dịch tại VNPAY
$vnp_BankCode = $inputData['vnp_BankCode']; //Ngân hàng thanh toán
$secureHash = hash('sha256', $vnp_HashSecret . $hashData);
$status = 0;
$orderId = $d->clean($inputData['vnp_TxnRef']);

try {
    //Check Orderid    
    //Kiểm tra checksum của dữ liệu
    if ($secureHash == $vnp_SecureHash) {
        //Lấy thông tin đơn hàng lưu trong Database và kiểm tra trạng thái của đơn hàng, mã đơn hàng là: $orderId            
        //Việc kiểm tra trạng thái của đơn hàng giúp hệ thống không xử lý trùng lặp, xử lý nhiều lần một giao dịch
        $items = $d->o_fet("select * from #_dathang where ma_dh = '" . $orderId . "'");
        $order = !empty($items[0]) ? $items[0] : NULL;
        if ($order != NULL) {
            if ( $status == 0) {
                if ($inputData['vnp_ResponseCode'] == '00') {
                    $status = 'paid';
                } else {
                    $status = 'failed';
                }
                //Cài đặt Code cập nhật kết quả thanh toán, tình trạng đơn hàng vào DB
                $d->reset();
                $d->setTable('#_dathang');
                $d->setWhere('ma_dh', $orderId);
                $dataUpdate['payment_status'] = $status;
                if (!$d->update($dataUpdate)) {
                    $returnData['RspCode'] = '99';
                    $returnData['Message'] = 'Can not update order!';
                } else {
                    //Trả kết quả về cho VNPAY: Website TMĐT ghi nhận yêu cầu thành công                
                    $returnData['RspCode'] = '00';
                    $returnData['Message'] = 'Confirm Success';
                }
            } else {
                $returnData['RspCode'] = '02';
                $returnData['Message'] = 'Order already confirmed';
            }
        } else {
            $returnData['RspCode'] = '01';
            $returnData['Message'] = 'Order not found';
        }
    } else {
        $returnData['RspCode'] = '97';
        $returnData['Message'] = 'Chu ky khong hop le';
    }
} catch (Exception $e) {
    var_dump($e);
    $returnData['RspCode'] = '99';
    $returnData['Message'] = 'Unknow error';
}
//Trả lại VNPAY theo định dạng JSON
echo json_encode($returnData);
