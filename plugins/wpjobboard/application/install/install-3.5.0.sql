ALTER TABLE `wpjb_job` 
    ADD `geo_status` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
    ADD `geo_latitude` FLOAT(9, 6) NOT NULL DEFAULT 0,
    ADD `geo_longitude` FLOAT(9, 6) NOT NULL DEFAULT 0; --

ALTER TABLE `wpjb_employer` 
    ADD `company_country` SMALLINT(5) UNSIGNED NOT NULL AFTER `company_logo_ext` ,
    ADD `company_state` VARCHAR(40) NOT NULL AFTER `company_country` ,
    ADD `company_zip_code` VARCHAR(20) NOT NULL AFTER `company_state` ; --

ALTER TABLE `wpjb_employer` 
    ADD `geo_status` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
    ADD `geo_latitude` FLOAT(9, 6) NOT NULL DEFAULT 0,
    ADD `geo_longitude` FLOAT(9, 6) NOT NULL DEFAULT 0; --

INSERT INTO `wpjb_mail` (`id`, `sent_to`, `sent_when`, `mail_title`, `mail_body`, `mail_from`) VALUES ('11', '1', 'Admin has to manually approve user resume', 'User resume is pending approval', 'You have received this email because user {$firstname} {$lastname} (ID: {$id}) posted or updated his resume, and admin action is required in order to approve or reject the resume.

Resume edit link:
{$resume_admin_url}', ''), ('12', '1', 'Admin has to manually grant company access to resumes', 'Company is requesting access to resumes', 'You have received this email because employer {$company_name} (ID: {$id}) is requesting full resumes access.

You can approve/reject this request at:
{$company_admin_url}', ''), ('13', '2', 'Sent when client finishes posting PAID job', 'Vui long thanh toan', 'You have received this email because employer {$company_name} (ID: {$id}) is requesting full resumes access.

You can approve/reject this request at:
{$company_admin_url}Ban da dang tin tuyen dung voi tieu de "{$position_title}" tren trang Sagojo.com
Ma so tin tuyen dung cua ban la {$id}.
De kich hoat tin tuyen dung cua ban, vui long thanh toan cho chung toi {$price} bang tien mat hoac chuyen khoan vao tai khoan so: xxx tai Ngan hang YYY voi noi dung nhu sau:
Tin tuyen dung {$id}
Chung toi rat vui duoc hop tac cung Qui Cong ty', ''); --

ALTER TABLE `wpjb_listing` ADD `description` TEXT NOT NULL DEFAULT "" ; --