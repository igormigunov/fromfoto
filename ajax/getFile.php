<?php
/**
 * Created by PhpStorm.
 * User: igor migunov
 * Date: 06.12.2015
 * Time: 21:50
 */
function file_force_download($file) {
    if (file_exists($file)) {
        // ���������� ����� ������ PHP, ����� �������� ������������ ������ ���������� ��� ������
        // ���� ����� �� ������� ���� ����� �������� � ������ ���������!
        if (ob_get_level()) {
            ob_end_clean();
        }
        // ���������� ������� �������� ���� ���������� �����
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        // ������ ���� � ���������� ��� ������������
        if ($fd = fopen($file, 'rb')) {
            while (!feof($fd)) {
                print fread($fd, 1024);
            }
            fclose($fd);
        }
        exit;
    }
}
if($_REQUEST["FILE"]){
    file_force_download("/web/fromfoto.com/public_html".$_REQUEST["FILE"]);
    die();
}