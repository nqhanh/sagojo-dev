<?php
/**
 * Description of Date
 *
 * @author greg
 * @package
 */

class Daq_Validate_WP_Username
    extends Daq_Validate_Abstract implements Daq_Validate_Interface
{

    public function isValid($value)
    {
        if ($value == '') {
            $this->setError(__('Please enter a username.', DAQ_DOMAIN));
            return false;
        } elseif ( ! validate_username( $value ) ) {
            $this->setError(__('[:en]This username is invalid because it uses illegal characters. Please enter a valid username.[:vi]Tên đăng nhập không hợp lệ vì có chứa ký tự đặc biệt. Vui lòng chọn một tên khác.[:ja]ユーザ名に使用できない文字が入力されています。変更して下さい。', DAQ_DOMAIN) );
            $value = '';
            return false;
        } elseif ( username_exists( $value ) ) {
            $this->setError(__('[:en]This username is already registered, please choose another one.[:vi]Tên đăng nhập này đã có người sử dụng, vui lòng chọn tên khác.[:ja]このユーザ名は既に登録済みです。別のユーザ名の登録をお願いします。', DAQ_DOMAIN));
            return false;
	}

        return true;
    }
}
?>