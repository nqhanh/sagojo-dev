<?php
/**
 * Description of USAState
 *
 * @author greg
 * @package 
 */

class Wpjb_List_USAState
{
    public static function getByCode($code)
    {
        $all = self::getAll();
        if(isset($all[$code])) {
            return $all[$code];
        } else {
            return "";
        }
    }

    public static function getAll()
    {
        return  array('08'=>"[:en]Ho Chi Minh[:vi]TP Hồ Chí Minh[:ja]Ho Chi Minh",
            '04'=>"[:en]Ha Noi[:vi]TP Hà Nội[:ja]Ha Noi",
            '511'=>"[:en]Da Nang[:vi]TP Đà Nẵng[:ja]Da Nang",
            '76'=>"An Giang",
            '64'=>"[:en]Ba Ria Vung Tau[:vi]Bà Rịa Vũng Tàu[:ja]Ba Ria Vung Tau",
            '781'=>"[:en]Bac Lieu[:vi]Bạc Liêu[:ja]Bac Lieu",
            '281'=>"[:en]Bac Kan[:vi]Bắc Kạn[:ja]Bac Can",
            '240'=>"[:en]Bac Giang[:vi]Bắc Giang[:ja]Bac Giang",
            '241'=>"[:en]Bac Ninh[:vi]Bắc Ninh[:ja]Bac Ninh",
            '75'=>"[:en]Ben Tre[:vi]Bến Tre[:ja]Ben Tre",
            '650'=>"[:en]Binh Duong[:vi]Bình Dương[:ja]Binh Duong",
            '56'=>"[:en]Binh Dinh[:vi]Bình Định[:ja]Binh Dinh",
            '651'=>"[:en]Binh Phuoc[:vi]Bình Phước[:ja]Binh Phuoc",
            '62'=>"[:en]Binh Thuan[:vi]Bình Thuận[:ja]Binh Thuan",
            '780'=>"[:en]Ca Mau[:vi]Cà Mau[:ja]Ca Mau",
            '26'=>"[:en]Cao Bang[:vi]Cao Bằng[:ja]Cao Bang",
            '71'=>"[:en]Can Tho - Hau Giang[:vi]Cần Thơ - Hậu Giang[:ja]Can Tho - Hau Giang",
            '50'=>"[:en]Dak Lak - Dac Nong[:vi]ĐắkLắk - Đắc Nông[:ja]Dak Lak - Dac Nong",
            '61'=>"[:en]Dong Nai[:vi]Đồng Nai[:ja]Dong Nai",
            '67'=>"[:en]Dong Thap[:vi]Đồng Tháp[:ja]Dong Thap",
            '59'=>"[:en]Gia Lai[:vi]Gia Lai[:ja]Gia Lai",
            '19'=>"[:en]Ha Giang[:vi]Hà Giang[:ja]Ha Giang",
            '351'=>"[:en]Ha Nam[:vi]Hà Nam[:ja]Ha Nam",
            '39'=>"[:en]Ha Tinh[:vi]Hà Tĩnh[:ja]Ha Tinh",
            '320'=>"[:en]Hai Duong[:vi]Hải Dương[:ja]Hai Duong",
            '31'=>"[:en]Hai Phong[:vi]TP Hải Phòng [:ja]Hai Phong",
            '18'=>"[:en]Hoa Binh[:vi]Hoà Bình[:ja]Hoa Binh",
            '321'=>"[:en]Hung Yen[:vi]Hưng Yên[:ja]Hung Yen",
            '58'=>"[:en]Khanh Hoa[:vi]Khánh Hoà[:ja]Khanh Hoa",
            '77'=>"[:en]Kien Giang[:vi]Kiên Giang[:ja]Kien Giang",
            '60'=>"Kon Tum",
            '23'=>"[:en]Lai Chau - Dien Bien[:vi]Lai Châu - Điện Biên[:ja]Lai Chau - Dien Bien",
            '25'=>"[:en]Lang Son[:vi]Lạng Sơn[:ja]Lang Son",
            '20'=>"[:en]Lao Cai[:vi]Lao Cai[:ja]Lao Cai",
            '63'=>"[:en]Lam Dong[:vi]Lâm Đồng[:ja]Lam Dong",
            '72'=>"[:en]Long An [:vi]Long An[:ja]Long An",
            '350'=>"[:en]Nam Dinh[:vi]Nam Định[:ja]Nam Dinh",
            '38'=>"[:en]Nghe An[:vi]Nghệ An[:ja]Nghe An",
            '30'=>"[:en]Ninh Binh[:vi]Ninh Bình[:ja]Ninh Binh",
            '68'=>"[:en]Ninh Thuan[:vi]Ninh Thuận[:ja]Ninh Thuan",
            '210'=>"[:en]Phu Tho[:vi]Phú Thọ[:ja]Phu Tho",
            '57'=>"[:en]Phu Yen[:vi]Phú Yên[:ja]:Phu Yen",
            '52'=>"[:en]Quang Binh[:vi]Quảng Bình[:ja]Quang Binh",
            '510'=>"[:en]Quang Nam[:vi]Quảng Nam[:ja]Quang Nam",
            '55'=>"[:en]Quang Ngai[:vi]Quảng Ngãi[:ja]Quang Ngai",
            '33'=>"[:en]Quang Ninh[:vi]Quảng Ninh[:ja]Quang Ninh",
            '53'=>"[:en]Quang Tri[:vi]Quảng Trị[:ja]Quang Tri",
            '79'=>"[:en]Soc Trang[:vi]Sóc Trăng[:ja]Soc Trang",
            '22'=>"[:en]Son La[:vi]Sơn La[:ja]Son La",
            '66'=>"[:en]Tay Ninh[:vi]Tây Ninh[:ja]Tay Ninh",
            '36'=>"[:en]Thai Binh[:vi]Thái Bình[:ja]Thai Binh",
			'280'=>"[:en]Thai Nguyen[:vi]Thái Nguyên[:ja]Thai Nguyen",
			'37'=>"[:en]Thanh Hoa[:vi]Thanh Hoá[:ja]Thanh Hoa",
			'54'=>"[:en]Thua Thien Hue[:vi]Thừa Thiên Huế[:ja]Thua Thien Hue",
			'73'=>"[:en]Tien Giang[:vi]Tiền Giang[:ja]Tien Giang",
			'74'=>"[:en]Tra Vinh[:vi]Trà Vinh[:ja]Tra Vinh",
			'27'=>"[:en]Tuyen Quang[:vi]Tuyên Quang[:ja]Tuyen Quang",
			'70'=>"[:en]Vinh Long[:vi]Vĩnh Long[:ja]Vinh Long",
			'211'=>"[:en]Vinh Phuc[:vi]Vĩnh Phúc[:ja]Vinh Phuc",
			'29'=>"[:en]Yen Bai[:vi]Yên Bái[:ja]Yen Bai");
    }
}

?>