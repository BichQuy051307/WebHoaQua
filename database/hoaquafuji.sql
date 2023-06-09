-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 07, 2023 lúc 03:38 PM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `hoaquafuji`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(512) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Mâm Quả Thắp Hương tài Lộc', 'mam-qua-thap-huong-tai-loc', NULL, '2023-05-16 23:57:31', '2023-05-16 23:57:31'),
(2, 'Giỏ Quà Tặng Cao Cấp', 'gio-qua-tang-cao-cap', NULL, '2023-05-17 00:00:44', '2023-05-17 00:00:44'),
(3, 'Táo', 'tao', NULL, '2023-05-17 00:03:37', '2023-05-17 00:31:34'),
(4, 'Cam', 'cam', NULL, '2023-05-17 00:03:45', '2023-05-17 00:03:45'),
(5, 'Nho', 'nho', NULL, '2023-05-17 00:03:54', '2023-05-17 00:03:54'),
(6, 'Cherry', 'cherry', NULL, '2023-05-17 00:04:08', '2023-05-17 00:04:08'),
(7, 'Đặc Sản Vùng Miền', 'dac-san-vung-mien', NULL, '2023-05-17 00:04:30', '2023-05-17 00:04:30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `customer_notes` longtext DEFAULT NULL,
  `notes` longtext DEFAULT NULL,
  `amount` double(8,2) NOT NULL,
  `score_awards` double(8,2) NOT NULL DEFAULT 0.00,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `user_id`, `name`, `phone`, `email`, `address`, `customer_notes`, `notes`, `amount`, `score_awards`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ORD20230517072439IV0', NULL, 'quy', '123456', NULL, '3rfegrth', NULL, NULL, 50000.00, 0.00, 2, '2023-05-17 00:25:02', '2023-05-17 00:25:43'),
(2, 'ORD20230519153337IEC', NULL, 'bich qiuy', '243576', NULL, 'rfhfc', NULL, NULL, 710.00, 0.00, 2, '2023-05-19 08:33:50', '2023-06-01 07:10:33');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders_detail`
--

CREATE TABLE `orders_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `price` double(8,2) NOT NULL,
  `price_sale` double(8,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `orders_detail`
--

INSERT INTO `orders_detail` (`id`, `order_id`, `product_id`, `name`, `slug`, `code`, `quantity`, `price`, `price_sale`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ORD20230517072439IV0', 1, 'Cam Vàng Ai Cập', 'cam-vang-ai-cap', 'C01', 1, 60000.00, 50000.00, 1, '2023-05-17 00:24:39', '2023-05-17 00:24:39'),
(2, 'ORD20230519153337IEC', 57, 'Mâm quả tài lộc 8', 'mam-qua-tai-loc-8', 'm08', 1, 390.00, 350.00, 1, '2023-05-19 08:33:37', '2023-05-19 08:33:37'),
(3, 'ORD20230519153337IEC', 39, 'Nho ngón tay khô nguyên cành Úc', 'nho-ngon-tay-kho-nguyen-canh-uc', 'n07', 2, 200.00, 180.00, 1, '2023-05-19 08:33:37', '2023-05-19 08:33:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `slug` text NOT NULL,
  `code` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `description` longtext DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `price` double(8,2) NOT NULL,
  `price_sale` double(8,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `bought` int(11) NOT NULL DEFAULT 0,
  `view_count` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `code`, `category_id`, `description`, `unit`, `image`, `price`, `price_sale`, `quantity`, `bought`, `view_count`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Cam Vàng Ai Cập', 'cam-vang-ai-cap', 'C01', 4, '– Cam vàng Ai Cập có chứa nhiều Vitamin C, tốt cho da, chống lão hóa,  giảm Cholesterol, có tác dụng hồi phục sức khỏe nhanh, tăng cường chức  năng tạo hồng huyết cầu, giảm căng thẳng thần kinh.  – Việc tiêu thụ vitamin C ở liều cao (khoảng 500mg mỗi ngày) rất tốt cho người ốm. –  Quả cam mọng nước chứa một hàm lượng Vitamin C cao đến mức chỉ cần ăn  một quả cũng đáp ứng được 130% nhu cầu vitaminC hàng ngày của chúng ta.  Ngoài ra, cam còn được biết tới như một loại đồ ăn kiêng giàu chất xơ,  Vitamin A, B, Canxi, Magnesium, Sắt, Đồng, Iốt… – Ăn cam thường xuyên  sẽ giúp phòng tránh các bệnh truyền nhiễm do virus; giảm đáng kể nguy  cơ mắc bệnh sỏi thận. Để tránh lượng calo dư thừa, hãy bổ sung Cam vào  chế độ dinh dưỡng hàng ngày của mình.', 'kg', '168434654120230517180221RXXQzog1MMD3HojtLwzxJ2wOFwd6CEVTxoKd83UK.jpg', 60000.00, 50000.00, 20, 1, 2, 1, '2023-05-17 00:22:47', '2023-05-18 07:27:50'),
(4, 'Cam Đỏ Úc', 'cam-do-uc', 'C04', 4, 'Cam đỏ Úc mang đặc điểm chung của giống cam vàng nhưng trong thành phần  chứa hàm  lượng lycopen cao nên được ưa chuộng hàng đầu tại Úc', 'kg', '168431134920230517081549MdIwYT4GvFMEHD5TvrHKug0Sxw3YPu3lNwJbpFdT.jpg', 65.00, 55.00, 20, 0, 2, 1, '2023-05-17 01:15:49', '2023-05-18 07:28:03'),
(5, 'Táo EnVy New Zealand', 'tao-envy-new-zealand', 't01', 3, 'Táo Envy được trồng nhiều tại USA và New Zealand nhưng chất lượng táo  đến từ các nông trại của New Zealand luôn vượt trội, với đẳng cấp khác  biệt!', 'kg', '1684312004202305170826449Jo2BlIA4np76gsY0Ua76mTR6oMDFv7p54gtZfc0.jpg', 70.00, 60.00, 20, 0, 0, 1, '2023-05-17 01:26:44', '2023-05-18 07:28:14'),
(6, 'Táo Trucape  Nam Phi', 'tao-trucape-nam-phi', 't02', 3, '– Kích thước quả khá nhỏ, nhưng cầm rất chắc tay. Táo giòn, ngọt và  nhiều nước, hơn nữa quả lại không quá to là đặc điểm rất được yêu thích ở  dòng táo này.', 'kg', '1684312645202305170837250lmnXjWXroEmEHDDKR3rXQwLmxeV3RN7PXwsnjGa.jpg', 55.00, 50.00, 20, 0, 0, 1, '2023-05-17 01:37:25', '2023-05-18 07:28:28'),
(7, 'Táo Jazz', 'tao-jazz', 't03', 3, '– Giảm cholesterol xấu: Táo có chứa pectin, một loại chất xơ hòa tan.  Pectin có hiệu quả trong việc làm giảm cholesterol xấu trong cơ thể bằng  cách giảm lipoprotein mật độ thấp (LDL). Điều này sẽ giúp làm giảm nguy  cơ mắc bệnh xơ vữa động mạch và bệnh tim hiệu quả.  – Ngăn ngừa bệnh  Alzheimer: Táo có tác dụng ngăn ngừa bệnh Alzheimer là bởi vì trong táo  có chứa một chất chống oxy hóa hiệu quả gọi là quercetin.  Quercetin  đặc biệt có hiệu ứng với hệ thần kinh, đó là bảo vệ các tế bào não khỏi  bị hư hại, phòng tránh các bệnh liên quan đến thần kinh, bao gồm cả  Alzheimer.  – Giảm nguy cơ tiểu đường: Tiêu thụ táo ở mức độ vừa phải  còn có lợi ở chỗ giữ cho lượng đường trong máu của bạn luôn ở mức kiểm  soát, tránh tăng cao dẫn đến bệnh tiểu đường. Các dưỡng chất thực vật và  chất chống oxy hóa trong táo như polyphenol sẽ làm giảm hấp thu glucose  và ổn định lượng đường trong máu.  – Tăng cường hệ thống miễn dịch  của cơ thể: Vitamin C là một trong những thành phần có tác dụng hỗ trợ  hệ miễn dịch của con người. Vitamin C lại có nhiều trong táo nên tiêu  thụ táo hàng ngày sẽ giúp cơ thể trước những sự tấn công của các yếu tố  bên ngoài.', 'kg', '168431276020230517083920n694tmMySKshM5YwbPtWw0eQFJeFjlZ4aKKPwbvj.jpg', 80.00, 75.00, 20, 0, 0, 1, '2023-05-17 01:39:20', '2023-05-18 07:28:39'),
(8, 'Táo KiKu Mỹ', 'tao-kiku-my', 't04', 3, '-Táo cung cấp chất xơ rất tốt, giúp ổn định lượng đường trong máu, giúp bộ máy tiêu hóa hoạt động tốt.  -Đường  tự nhiên trong táo không ảnh hưởng tới bệnh nhân tiểu đường. Ngoài ra,  táo cung cấp vitamin A, C, Kali và axit Folic. Vỏ táo giàu chất xơ và có  lợi cho hệ tiêu hóa, hơn 1 nửa lượng vitamin C của quả táo đều nằm ở  vỏ.', 'kg', '168431287320230517084113sEFUozWEBsBcsbveoetvC4LsKqaWOvMdD8mwlkqR.jpg', 70.00, 65.00, 20, 0, 1, 1, '2023-05-17 01:41:13', '2023-05-18 07:28:54'),
(9, 'Cam Đỏ Đài Loan', 'cam-do-dai-loan', 'c02', 4, '1. Chống lão hóa cho làn da: Cam có đầy đủ beta-carotene là một chất  chống ôxy hóa mạnh mẽ bảo vệ các tế bào, ngăn ngừa các dấu hiệu lão hóa.   2️⃣. Hỗ trợ tiêu hóa: Cam rất giàu chất xơ, có tác dụng hỗ trợ quá trình tiêu hóa.   3️⃣. Tăng cường thể lực: Uống nước cam bỏ thêm chút muối sau khi luyện tập ra nhiều mồ hôi là cách để lấy lại thể lực nhanh chóng.   4️⃣. Nhanh lành vết thương: trong nước cam còn chứa folate, thúc đẩy quá trình chữa lành các vết thương.   5️⃣. Giảm nguy cơ mắc bệnh tim mạch: Dinh dưỡng trong cam Cara giúp giúp cải thiện tuần hoàn máu, giảm nguy cơ các bệnh tim mạch.', 'kg', '168431349420230517085134VmTig5DdjJvHGofXgQgIqKTCQIYney0pBiMLL3lN.jpg', 60.00, 55.00, 20, 0, 1, 1, '2023-05-17 01:51:34', '2023-05-18 07:29:06'),
(10, 'Táo Vàng Mỹ', 'tao-vang-my', 't05', 3, '– Táo vàng Mỹ có chứa nhiều chất pectin, đây là một chất xơ hòa tan  có thể ngăn chặn tình trạng oxy hóa, giảm cholesterol cũng như ngăn ngừa  bệnh tim. Vỏ táo rất có lợi cho tiêu hóa cũng như mang lại hàm lượng  vitamin C rất cao.  – Lượng khoáng chất magie và kali trong táo sẽ  điều chỉnh được áp suất của máu cũng như giữ cho tim luôn đập ở mức ổn  định. Bên cạnh đó, táo còn giúp bảo vệ thành mạch máu rất hiệu quả.  –  Hàm lượng kẽm trong táo sẽ làm tăng trí nhớ của con người, ngoài ra còn  tạo nên kháng thể giúp cho cơ thể chống lại vi khuẩn bên ngoài như các  vi lượng như canxi, sắt, vitamin B1, B2, C…', 'kg', '168431366320230517085423enHKmDgMCtDH7mJQoKvGCf17ybsmnPPYjAf5ylPQ.jpg', 90.00, 85.00, 20, 0, 1, 1, '2023-05-17 01:54:23', '2023-05-18 07:29:22'),
(11, 'Táo Xanh Mỹ', 'tao-xanh-my', 't06', 3, 'Táo xanh Mỹ là một trong những thực phẩm tốt nhất cho sức khỏe tổng thể và sắc đẹp mà bạn nên biết và nên ăn hàng ngày:  –  Trong một quả táo có chứa khoảng 4g chất xơ, đáp ứng được 17% nhu cầu  cần thiết của cơ thể mỗi ngày. Giúp điều trị bệnh tiểu đường, cải thiện  chức năng của hệ tiêu hóa,bảo vệ tim mạch, hỗ trợ giảm cân hiệu quả  – Lượng vitamin A, C, B1 dồi dào tăng cường sức khỏe, chống lại các gốc tự do, ngăn ngừa ung thư và làm chậm quá trình lão hóa  – Hàm lượng khoáng chất: kali, canxi, photpho, sắt,… dồi dào tốt cho da, tóc, móng; giảm triệu chứng của các bệnh về xương khớp.', 'kg', '168431376520230517085605Dq4QN8A8YAHVFf4KW6bqO0tbIfb6V9lSLc3GukfF.jpg', 65.00, 60.00, 20, 0, 0, 1, '2023-05-17 01:56:05', '2023-05-18 07:29:32'),
(13, 'Táo Xanh Pháp', 'tao-xanh-phap', 't08', 3, 'Táo xanh Pháp là thực phẩm tuyệt vời hỗ trợ giảm cân, giữ dáng, đẹp da, bạn có biết?', 'kg', '168431413620230517090216Y0eokW3TZk8eDG3FY8Lb0KSsPxE6hLnh1veVJbhs.jpg', 70.00, 65.00, 20, 0, 0, 1, '2023-05-17 02:02:16', '2023-05-18 07:29:43'),
(14, 'Giỏ quả quà tặng 1.', 'gio', 'g01', 2, 'Giỏ quả biếu tặng người phụ nữ.', 'Giỏ', '168433457820230517144258XnLBTjOeAGTQ42fIsro27LDUQbuzRQ2qcyWW2rmL.png', 350.00, 300.00, 20, 0, 2, 1, '2023-05-17 07:42:58', '2023-05-18 07:58:22'),
(15, 'Giỏ quả biếu tặng 2.', 'gio-qua-bieu-tang-2', 'g02', 2, 'Giỏ quả biếu tặng ông bà.', 'Giỏ', '168433475220230517144552xLJxlC5XppbF7doX9f95TvlF5kI28r8Q3hyTM3Ku.png', 300.00, 280.00, 100, 0, 1, 1, '2023-05-17 07:45:52', '2023-05-18 07:58:01'),
(16, 'Giỏ quả biếu tặng3.', 'gio-qua-bieu-tang3', 'g03', 2, 'Giỏ biếu quà tặng cha, mẹ.', 'Giỏ', '168433512220230517145202DrpfzRsU4fYeDtM9xKPGzOBk13nHrgOZLYmpxD1A.png', 400.00, 360.00, 100, 0, 2, 1, '2023-05-17 07:52:02', '2023-05-18 07:58:27'),
(17, 'Cam Vàng Úc', 'cam-vang-uc', 'c03', 4, 'Múi cam to, tép mọng nước màu vàng tươi, ít xơ, vị ngọt thanh, thơm  mát  và đặc trưng mà ai ai cũng thích là hầu hết không có hạt. Vị tươi  ngọt  sảng khoái tan vào trong miệng khiến bạn cảm thấy cực kì sung sướng   khi được thưởng thức cam vàng Úc', 'kg', '1684346752202305171805526De4lsaUdksce9Mczkyrt2fVwBgJcUTHdOATy9ol.jpg', 70.00, 68.00, 20, 0, 0, 1, '2023-05-17 11:05:52', '2023-05-18 07:30:27'),
(18, 'Táo xanh ngọt Mỹ', 'tao-xanh-ngot-my', 'c09', 3, 'Táo xanh ngọt Mỹ sẽ là một sự lựa chọn khác cho những tín đồ yêu táo xanh, bạn đã nếm thử chưa?', 'kg', '1684346911202305171808313mgV7AW1EZMfAwEVlUzOkDNmbvItNUeza2bhup9q.jpg', 90.00, 85.00, 20, 0, 0, 1, '2023-05-17 11:08:31', '2023-05-18 07:30:40'),
(19, 'Xoài Cát Chu Đồng Tháp', 'xoai-cat-chu-dong-thap', 'x01', 7, '- Giàu dinh dưỡng: Uống mỗi ngày một cốc sinh tố xoài chứa tỷ lệ phần  trăm dinh dưỡng như sau: 103  kalo, 75% vitamin C có tác dụng chống ôxy  hóa và tăng cường hệ miễn  dịch; 24% vitamin A giúp chống oxy hóa và  tăng thị lực; 12% vitamin B6  và một số vitamin B khác các tác dụng  phòng bệnh não và tim; 10% lợi  khuẩn; 8% đồng cần cho việc sản xuất các  tế bào máu; 8% kali giúp cân  bằng lượng natri trong cơ thể và 5%  magie.  - Ngừa ung thư: Nhiều nghiên cứu cho thấy các hợp chất  chống ôxy hóa trong trái xoài có  tác dụng bảo vệ cơ thể, chống lại ung  thư ruột kết, ung thư vú, ung thư  tuyến tiền liệt và bệnh bạch cầu. Các  hợp chất này là isoquercitrin,  quercetin, fisetin, astragalin,  methylgallat, axit gallic cũng như các  enzim khác.  - Giảm lượng  cholesterol: Hàm lượng cao vitamin C, pectin và chất xơ được tìm thấy  trong xoài có  tác dụng làm giảm nồng độ cholesterol trong huyết thanh,  đặc biệt là cải  thiện tình trạng rối loạn mỡ trong máu.  - Làm  sạch da: Loại trái cây ngon và có màu sắc đậm như xoài tốt cho làn da  bạn cả bên  trong và bên ngoài. Ăn xoài có thể giúp làm sạch lỗ chân  lông bị tắc và  loại bỏ mụn.  -Tốt cho mắt: Một cốc xoài xắt lát  cung cấp 24% lượng vitamin A cần thiết cho cơ thể  mỗi ngày. Loại  vitamin này giúp thúc đẩy thị lực, ngăn ngừa khô mắt và  quáng gà.', 'kg', '168434700620230517181006VsZM2eueBxd8rKmNSPuMx5qspibR1JDEt2dw7Gj4.jpg', 50.00, 45.00, 600, 0, 0, 1, '2023-05-17 11:10:06', '2023-05-17 11:10:06'),
(20, 'Bưởi da xanh Phú Quý', 'buoi-da-xanh-phu-quy', 'b01', 7, '- Tăng cường hệ miễn dịch: bưởi cung cấp khoảng 600% nhu cầu vitamin C   hàng ngày của cơ thể. Lượng vitamin C này có thể giúp bạn tránh được  cảm  lạnh, sốt, nhiễm trùng và các chứng bệnh khác.  - Điều hòa huyết áp: Bưởi có chứa một lượng kali cao giúp thư giãn các mạch máu và thúc đẩy sự lưu thông máu dễ dàng.  - Củng cố xương cốt: Bởi trong bưởi rất giàu Kali giúp xương chắc khỏe.  -  Giảm cân, giữ gìn vóc dáng: enzyme - carnitine palmitoyltransferase có   trong bưởi giúp quá trình giảm cân nhanh và cực kỳ an toàn.', 'kg', '168441858820230518140308zIIxRZhldkF1CS0mXPk31RMqqFo78PrASZLgHtMC.jpg', 60.00, 55.00, 300, 0, 1, 1, '2023-05-18 07:03:08', '2023-05-18 07:05:03'),
(21, 'Dưa hấu không hạt', 'dua-hau-khong-hat', 'd01', 7, '- Giàu vitamin và khoáng chất: Cũng  giống như mọi loại quả khác, dưa  hấu rất giàu khoáng chất và vitamin.  Nó chứa nhiều vitamin A, B, C,  kali, sắt, canxi, mangan, kẽm, chất chống  oxy hóa và các chất dinh  dưỡng khác.   - Tốt cho tim mạch và xương: Ăn nhiều dưa hấu giúp  cải thiện chức năng tim mạch vì nó cải thiện lưu  lượng máu. Dưa hấu  cũng rất giàu kali, giúp giữ canxi trong cơ thể, giúp  xương và khớp  mạnh hơn.  - Phòng chống ung thư: Lycopene có trong dưa hấu có tác  dụng ngăn ngừa ung thư, đặc biệt là ung  thư vú, ung thư ruột kết, ung  thư phổi, ung thư tuyến tiền liệt và ung  thư nội mạc tử cung.  -  Làm giảm mỡ trong cơ thể: dưa hấu còn rất ít calo và chứa nhiều nước, vì  thế, dưa hấu là món hoàn hảo cho những người muốn giảm cân.  -  Tăng cường hệ miễn dịch, chữa lành vết thương: Dưa hấu chứa hàm lượng  vitamin C cao, giúp tăng cường hệ miễn dịch và bảo vệ các tế bào và ADN  khỏi bị oxy hoạt tính.', 'kg', '168441882220230518140702RwkdlJJNMiVeYVn3O3t6BdTZSaiVms0QeFcthBZ0.jpg', 40.00, 35.00, 100, 0, 0, 1, '2023-05-18 07:07:02', '2023-05-18 07:07:02'),
(22, 'Mít Nghệ Tiền Giang', 'mit-nghe-tien-giang', 'm01', 7, 'Không chỉ được yêu mến với vị ngọt thanh, mùi  hương dễ chịu mà mít còn có nguồn dinh dưỡng dồi dào, mang lại nhiều  lợi ích tuyệt vời cho sức khỏe con người.', 'kg', '168441894520230518140905SOY42haEFY3iz3mZKGmbUNmqnvYQzfeeJ8vREsIU.jpg', 50.00, 45.00, 100, 0, 0, 1, '2023-05-18 07:09:05', '2023-05-18 07:09:05'),
(23, 'Dừa trọc size L', 'dua-troc-size-l', 'd01', 7, 'Dừa trọc luôn có vị ngọt đậm và hương thơm đặc trưng. Với mong muốn kết nối những sản phẩm làm từ dừa tới tay người tiêu dùng nhanh chóng, tiện lợi, người nông dân, chọn lọc đã vận chuyển và gia công cẩn thận để mang đến người tiêu dùng những sản phẩm tươi ngon, chất lượng nhất.', 'kg', '168441904820230518141048Kp5ixnjmqARNoqkXdSutSBGPMxQsqsWKyst11tRy.jpg', 60.00, 55.00, 100, 0, 0, 1, '2023-05-18 07:10:48', '2023-05-18 07:10:48'),
(24, 'Dưa hấu ruột vàng', 'dua-hau-ruot-vang', 'd02', 7, 'Dưa hấu ruột vàng - một đặc sản của đất Long An. Loại dưa này đặc biệt chỉ trồng đc ở 2 nơi duy nhất là Long An và Tiền Giang nước ta, trong đó loại của Long An trái to, vỏ mỏng và đạt độ ngọt cao hơn.', 'kg', '168441915020230518141230tB3BNRVctuZDyGkMaYSXlsSKtH51tiERi1ZQpbSU.jpg', 45.00, 40.00, 100, 0, 0, 1, '2023-05-18 07:12:30', '2023-05-18 07:12:30'),
(25, 'Roi đỏ An Phước', 'roi-do-an-phuoc', 'r01', 7, 'Roi đỏ An Phước được trồng theo tiêu chuẩn VietGap và GlobolGap, roi   không có hạt và có hương thơm đặc trưng, ruột đặc, ăn giòn và ngọt.', 'kg', '1684419217202305181413377zaB70sGEr1VK40rszcfRmNFJlkkXagbQ3Qc7Cps.jpg', 55.00, 40.00, 100, 0, 0, 1, '2023-05-18 07:13:37', '2023-05-18 07:13:37'),
(26, 'Chôm Chôm nhãn Tiền Giang', 'chom-chom-nhan-tien-giang', 'c01', 7, 'Quả chôm chôm nhãn có kích thước trung bình, trọng lượng từ 20 - 23g, vỏ   quả lúc vừa chín màu vàng, khi chín có màu vàng đỏ, trên vỏ quả có một   rãnh dọc kéo dài từ đỉnh đến đáy quả, trông như hai nửa vỏ ráp lại,  cùi  dày và tróc khỏi hột rất ráo, ăn ngon, giòn, vị ngọt dịu, thơm...  được  người tiêu dùng suốt từ Bắc tới Nam ưa chuộng.', 'kg', '16844192932023051814145325lIecuMlwruaWuFmQ0l4mCcLX0HfSsw06l8ygYr.jpg', 45.00, 40.00, 200, 0, 0, 1, '2023-05-18 07:14:53', '2023-05-18 07:15:20'),
(27, 'Vú sữa Lò Rèn', 'vu-sua-lo-ren', 'v01', 7, 'Ngọt ngào đậm đà, thơm lừng hấp dẫn mọi giác quan, chính là trái vú sữa Lò Rèn căng mọng. Hãy thưởng thức ngay!', 'kg', '168441944320230518141723CNtGpa9w80yKegNqml1yZNlVKG3ml4T8yNMMYdKJ.jpg', 50.00, 45.00, 100, 0, 0, 1, '2023-05-18 07:17:23', '2023-05-18 07:17:23'),
(28, 'Cherry Canada', 'cherry-canada', 'h01', 6, '– Có hàm lượng vitamin A cao, không chỉ tốt cho mắt, ăn quả cherry Canada hàng ngày còn cải thiện làn da.  – Cải thiện tình trạng mất trí nhớ, ngăn ngừa ung thư, làm chậm lão hóa.  – Tốt cho tim mạch, giảm viêm nhiễm xương khớp, đau nhức cơ. Lượng chất xơ dồi dào trong cherry hỗ trợ tốt cho tiêu hóa.', 'kg', '1684419609202305181420099uhrh5uq9aG51FDP4QvxZnIWwf3nPPIQEYR3H8Sl.jpg', 250.00, 230.00, 100, 0, 1, 1, '2023-05-18 07:20:09', '2023-05-18 07:20:22'),
(29, 'Cherry Mỹ', 'cherry-my', 'h02', 6, '– Có hàm lượng vitamin A cao, không chỉ tốt cho mắt, ăn quả cherry Mỹ hàng ngày còn cải thiện làn da. – Cải thiện tình trạng mất trí nhớ, ngăn ngừa ung thư, làm chậm lão hóa. – Tốt cho tim mạch, giảm viêm nhiễm xương khớp, đau nhức cơ. Lượng chất xơ dồi dào trong cherry hỗ trợ tốt cho tiêu hóa.', 'kg', '168441976720230518142247Eattrki3srSL1dUDDGjUoTTM4DPoJf1F0CkOcmUI.jpg', 400.00, 360.00, 500, 0, 0, 1, '2023-05-18 07:22:47', '2023-05-18 07:22:47'),
(30, 'Cherry Vàng', 'cherry-vang', 'h03', 6, 'Cherry Vàng là nguồn vitamin A tuyệt vời, là loại trái cây giàu chất sắt, chất xơ cao, chất béo, không cholesterol, tốt cho hệ miễn dịch, tiêu hóa và làm đẹp da.', 'kg', '168441984220230518142402bA7oQpCOSUjZA4ZfVtc0zf5Oap0IU9IsIuuSRfMy.jpg', 250.00, 230.00, 100, 0, 0, 1, '2023-05-18 07:24:02', '2023-05-18 07:24:02'),
(31, 'Cherry Australia', 'cherry-australia', 'h04', 6, '– Có hàm lượng vitamin A cao, không chỉ tốt cho mắt, ăn quả cherry Australia hàng ngày còn cải thiện làn da.  – Cải thiện tình trạng mất trí nhớ, ngăn ngừa ung thư, làm chậm lão hóa.  – Tốt cho tim mạch, giảm viêm nhiễm xương khớp, đau nhức cơ. Lượng chất xơ dồi dào trong cherry hỗ trợ tốt cho tiêu hóa.', 'kg', '168441991820230518142518jJy1TyLwJr5Dx0Lw0hoGj72RZPmu3aApH2LA1xPy.jpg', 500.00, 480.00, 100, 0, 0, 1, '2023-05-18 07:25:18', '2023-05-18 07:25:18'),
(32, 'Cherry New Zealand', 'cherry-new-zealand', 'h05', 6, 'Quả Cherry hay còn gọi là quả anh đào, là loại hoa quả nhập khẩu. Cherry nhập về Việt Nam có rất nhiều loại và giá cả cũng rất khác nhau. Cherry có 2 mùa trong năm là cherry Mỹ, cherry Canada, cherry Trung Quốc có từ tháng 5 đến tháng 9. Cherry Úc, cherry Newzealand, cherry Chile có từ tháng 11 kéo dài đến tháng 3 năm sau.', 'kg', '168442003920230518142719ymbUagaYNwPTw5hqfK7lwTOxELl91HWg8z3TDnZ6.jpg', 450.00, 430.00, 100, 0, 0, 1, '2023-05-18 07:27:19', '2023-05-18 07:27:19'),
(33, 'Nho đỏ kẹo Mỹ', 'nho-do-keo-my', 'n01', 5, 'Vì sao nho kẹo đỏ Mỹ lại có cái tên là KẸO mà không phải tên khác? Cùng tìm hiểu trong phần chi tiết sản phẩm nhé.', 'kg', '1684420364202305181432446qaxwEmkCpLi3YQ6sdTWH2PLdPxtU5TVpQ3F5AFc.jpg', 80.00, 75.00, 20, 0, 1, 1, '2023-05-18 07:32:44', '2023-05-18 07:51:35'),
(34, 'Nho Ngón Tay Mỹ', 'nho-ngon-tay-my', 'n02', 5, 'Nho ngón tay mỹ có hình dáng thuôn dài độc đáo, nho móng tay được ưu ái để đi biếu, đi tặng sếp! Nhưng hương vị của nho như thế nào?!?  Hãy ghé thăm Fuji để khám phá ngay nhé!', 'kg', '168442043420230518143354X3UXKtzW1vubSi0ve7Jzdgt5ZX24nkpC2zy3xXz6.jpg', 100.00, 95.00, 20, 0, 0, 1, '2023-05-18 07:33:54', '2023-05-18 07:33:54'),
(35, 'Nho Xanh Sữa Hàn Quốc', 'nho-xanh-sua-han-quoc', 'n03', 5, '-  Nho Hàn Shine Muscat cung cấp nhiều chất chống oxi hóa rất tốt cho  tim  mạch, huyết áp cao. Chúng cũng rất tốt cho mắt, não và trí nhớ.  Vỏ   nho rất tốt cho sức khỏe như: tăng cường sức đề kháng, chống lão hóa,  có  tác dụng thải độc tố... Hàm lượng resveratrol trong vỏ nho phong phú   hơn trong thịt và hạt nho, đồng thời có tác dụng giảm máu nhiễm mỡ,   chống tụ huyết, phòng chống xơ vữa động mạch và tăng cường hệ thống  miễn  dịch của cơ thể.  Việc ăn nho thường xuyên giúp cơ thể khỏe  mạnh,  giúp nhanh phục hồi đối với những người bị thiếu máu kinh niên,  những  bệnh nhân bị huyết áp cao, viêm phế quản, gout, viêm dạ dày và  táo bón.', 'kg', '168442050120230518143501pfMLBPxg6G2FZ7PnnxxkXOM858K5GB6G9fqxfXZj.jpg', 120.00, 110.00, 15, 0, 0, 1, '2023-05-18 07:35:01', '2023-05-18 07:35:01'),
(36, 'Nho đỏ không hạt Úc', 'nho-do-khong-hat-uc', 'n04', 5, '– Là giống nho không hạt, có màu đỏ tươi hấp dẫn, bên ngoài vỏ phủ một lớp phấn trắng tự nhiên, vỏ mỏng, vị ngọt thanh mát.', 'kg', '168442060220230518143642lIG4lY726WJANVk6I3rzBYbHGLWgUgKQoVBPekzv.jpg', 80.00, 75.00, 15, 0, 0, 1, '2023-05-18 07:36:42', '2023-05-18 07:36:42'),
(37, 'Nho xanh Mỹ', 'nho-xanh-my', 'n05', 5, '– Giảm nguy cơ tai biến tim mạch, giảm tác hại của thuốc lá đối với phổi, ngăn ngừa ung thư. – Tốt cho tim mạch, huyết áp cao, tốt cho mắt, não và trí nhớ, giảm cholesteron và cân bằng huyết áp. – Ăn nho thường xuyên giúp thải đọc tố, làm mát cơ thể.', 'kg', '168442066420230518143744LpUHVLx0hGebZmDY4jrhFdpm7pj12NgjlFE5R1uw.jpg', 100.00, 95.00, 15, 0, 0, 1, '2023-05-18 07:37:44', '2023-05-18 07:37:44'),
(38, 'Nho đen Úc', 'nho-den-uc', 'n06', 5, 'Nho đen Úc được đánh giá là một trong những giống nho đen ngon nhất hiện nay. Quả có dạng thuôn dài, vỏ mỏng, không có hạt, màu đen sẫm, rất ngọt.', 'kg', '168442078920230518143949b8ZwYQQUFq6KAtGLNJcbDyHoDvGpJlJPsGKRhpbQ.jpg', 150.00, 145.00, 10, 0, 0, 1, '2023-05-18 07:39:49', '2023-05-18 07:39:49'),
(39, 'Nho ngón tay khô nguyên cành Úc', 'nho-ngon-tay-kho-nguyen-canh-uc', 'n07', 5, 'Nho ngón tay khô nguyên cành Úc được sấy từ những quả nho ngón tay đen, sấy theo kĩ thuật hàng đầu và được tuyển chọn rất kĩ lưỡng. Với kĩ thuật sấy hiện đại, quả nho giữ nguyên được hình dáng nguyên cành, những quả nho ngón tay sấy khô đều, rất đẹp mắt và ngon miệng.', 'kg', '168442088220230518144122xwocG6HxHudHeru5xKKuDQcpNuZTFMzDjBY6FQce.jpg', 200.00, 180.00, 8, 2, 2, 1, '2023-05-18 07:41:22', '2023-05-19 08:30:21'),
(40, 'Nho xanh Nam Phi', 'nho-xanh-nam-phi', 'n08', 5, 'Nho xanh Nam Phi có kích thước vừa phải. Thịt  nho chắc có màu xanh ngọc bắt mắt, vị nho giòn ngọt vừa phải, chùm nho to hấp dẫn.   Thuộc chủng nho không hạt nên nho xanh Nam Phi rất phù hợp với trẻ em ăn dặm và người già.', 'kg', '168442141920230518145019BaIs1rETz7ggQUzbCDDr0jxBt9BczE0NpoFDMKko.jpg', 180.00, 170.00, 10, 0, 1, 1, '2023-05-18 07:50:19', '2023-05-18 07:51:45'),
(41, 'Nho đỏ Nam Phi', 'nho-do-nam-phi', 'n09', 5, 'Nho đỏ Nam Phi sở hữu màu đỏ căng mọng hấp dẫn, giòn tan, ngọt đậm đà. Chùm to, sai quả, ngon nhất khi ăn lạnh', 'kg', '168442153920230518145219SC6esju6p7S9D9wBhjUBkyyvbLSiz0KKtzfVpnvS.jpg', 190.00, 180.00, 10, 0, 0, 1, '2023-05-18 07:52:19', '2023-05-18 07:52:19'),
(42, 'NHO KHÔ NGUYÊN CÀNH ÚC', 'nho-kho-nguyen-canh-uc', 'n10', 5, 'Nho khô nguyên cành nhập khẩu Clusters là một trong những món ăn được ưa thích của nhiều người.  Là giống nho có nguồn gốc 100% tự nhiên từ được trồng ở trang trại Murray River Organics của Úc, nho khô nguyên cành Clusters được đánh giá rất cao không chỉ tại thị trường Úc mà còn được ưu chuộng vô cùng tại thị trường Việt Nam.', 'kg', '168442161620230518145336pWVezU7XKkJNVZWEeNKQA3VxVTmtGfk9Ll6twhqr.jpg', 290.00, 270.00, 10, 0, 0, 1, '2023-05-18 07:53:36', '2023-05-18 07:53:36'),
(43, 'Nho xanh ngón tay Úc', 'nho-xanh-ngon-tay-uc', 'n11', 5, 'Bên cạnh nho đen ngón tay đang được ưa chuộng trên thị trường, nho xanh ngón tay Úc cũng có màn chào sân không hề kém cạnh. Bạn đã nếm thử chưa?', 'kg', '168442171820230518145518aqooj9PikAfDuRVR3aBP4MmbXLT8cDGAH8QLMHvV.jpg', 300.00, 280.00, 10, 0, 0, 1, '2023-05-18 07:55:18', '2023-05-18 07:55:18'),
(44, 'Nho đen kẹo Peru', 'nho-den-keo-peru', 'n12', 5, 'Nho đen kẹo không hạt Peru với chủng Autumn Royal quả thuôn dài,  nhiều nước,  ăn rất giòn và ngọt thanh, nho Peru rất thích hợp cho  người già và  trẻ nhỏ, những người ăn kiêng. Bạn đã nếm thử chưa?', 'kg', '168442179420230518145634CsCE3jFXC7EelO1euLnkd1pjmbbbzj9wRqI0Ac4k.jpg', 350.00, 320.00, 10, 0, 0, 1, '2023-05-18 07:56:34', '2023-05-18 07:56:34'),
(45, 'Giỏ quả biếu tặng 4', 'gio-qua-bieu-tang-4', 'g04', 2, 'Giỏ quả biếu tặng thầy cô.', 'Giỏ', '168442198920230518145949UERU8IodfHJc4zciFPg1oaAQwNcSbYO3cJ7PDTgy.png', 500.00, 450.00, 10, 0, 1, 1, '2023-05-18 07:59:49', '2023-05-18 08:07:27'),
(46, 'Giỏ quả biếu tặng 5', 'gio-qua-bieu-tang-5', 'g05', 2, 'Giỏ quả biếu tặng cấp trên.', 'Giỏ', '1684422542202305181509020XfgEYncBZxNLxbncVyWPAZ5BkQjM8HQfAzerRl2.png', 500.00, 450.00, 10, 0, 0, 1, '2023-05-18 08:09:02', '2023-05-18 08:09:02'),
(47, 'Giỏ quả biếu tặng 6', 'gio-qua-bieu-tang-6', 'g06', 2, 'Giỏ quả tặng bạn bè.', 'Giỏ', '168442303120230518151711xv6AQrk3XeTTO4FPqP59gUA7iWyyxSqaAEST31kS.png', 480.00, 450.00, 10, 0, 0, 1, '2023-05-18 08:17:11', '2023-05-18 08:17:11'),
(48, 'Giỏ quả biếu tặng 7', 'gio-qua-bieu-tang-7', 'g07', 2, 'Giỏ biếu quà tặng cha, mẹ.', 'Giỏ', '1684423211202305181520116qGrZyezQvwdWYrAx2URT0IL9DoXrHLfhevbo3UA.png', 400.00, 380.00, 5, 0, 0, 1, '2023-05-18 08:20:11', '2023-05-18 08:20:11'),
(49, 'Giỏ Quả Biếu Tặng 8', 'gio-qua-bieu-tang-8', 'g08', 2, 'Giỏ quả biếu tặng thầy cô.', 'Giỏ', '168442349420230518152454jUh6hUjbigQdjpG7gZexhQZtidw0CJufOfDC7bq3.png', 450.00, 400.00, 10, 0, 0, 1, '2023-05-18 08:24:54', '2023-05-18 08:24:54'),
(50, 'Mâm quả tài lộc 1', 'mam-qua-tai-loc-1', 'm01', 1, 'Mâm quả tài lộc', 'g', '168442386420230518153104eGv6rNPAtggX0uzrOH43ZUpqMjCKLi2tcWMJ7h2L.png', 300.00, 280.00, 10, 0, 1, 1, '2023-05-18 08:31:04', '2023-05-18 08:34:51'),
(51, 'Mâm quả tài lộc 2', 'mam-qua-tai-loc-2', 'm02', 1, 'Mâm quả tài lộc', 'Giỏ', '168442393920230518153219pVpAeyyrfjKOigB19Q3JaVi4eQNajAJyZkLUe2vY.png', 400.00, 380.00, 10, 0, 0, 1, '2023-05-18 08:32:19', '2023-05-18 08:34:39'),
(52, 'Mâm quả tài lộc 3', 'mam-qua-tai-loc-3', 'm03', 1, 'Mâm quả tài lộc', 'Giỏ', '168442401320230518153333ubvniQtuIDcPT78lRTDeyISK7M8AInBpiclcOGBA.png', 350.00, 320.00, 10, 0, 1, 1, '2023-05-18 08:33:33', '2023-06-01 08:03:42'),
(53, 'Mâm quả tài lộc 4', 'mam-qua-tai-loc-4', 'm04', 1, 'Mâm quả tài lộc', 'Giỏ', '168442415020230518153550tHeyNtP14PgeEeWfFAAAVkJisNdwuKWpwLsC8CF2.png', 450.00, 420.00, 10, 0, 0, 1, '2023-05-18 08:35:50', '2023-05-18 08:35:50'),
(54, 'Mâm quả tài lộc 5', 'mam-qua-tai-loc-5', 'm05', 1, 'Mâm quả tài lộc', 'Giỏ', '168442422020230518153700J6Jju39WlZt8A4z0lkjx30VGyJcugV4CW0aDu3Lb.png', 360.00, 350.00, 5, 0, 1, 1, '2023-05-18 08:37:00', '2023-05-19 06:37:20'),
(55, 'Mâm quả tài lộc 6', 'mam-qua-tai-loc-6', 'm06', 1, 'Mâm quả tài lộc', 'Giỏ', '168442433120230518153851qkuQNH6fJcQwRaitkTTb2YFLNjCTivruwhbIvWtu.png', 450.00, 400.00, 5, 0, 0, 1, '2023-05-18 08:38:51', '2023-05-18 08:38:51'),
(56, 'Mâm quả tài lộc 7', 'mam-qua-tai-loc-7', 'm07', 1, 'Mâm quả tài lộc', 'Giỏ', '168442442020230518154020PWqyXKcGdJR8IUNKJjgu6BYiyQsJolbcAjssUIKZ.png', 390.00, 370.00, 5, 0, 0, 1, '2023-05-18 08:40:20', '2023-05-18 08:40:20'),
(57, 'Mâm quả tài lộc 8', 'mam-qua-tai-loc-8', 'm08', 1, 'Mâm quả tài lộc', 'Giỏ', '168442448520230518154125bOOfvRLIdrqK1xE15JTYoixwaHC6d9MX4w9oYGXZ.png', 390.00, 350.00, 4, 1, 1, 1, '2023-05-18 08:41:25', '2023-05-19 08:13:17');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `avatar` varchar(512) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'customer',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `avatar`, `email`, `role`, `email_verified_at`, `address`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Administrator', NULL, 'admin@gmail.com', 'admin', NULL, 'Hà Nội', '$2y$10$4edleQ7FIcS8PthADtoE.uiy3SBXgEcRg0cNNLMbJKRudJkVsRMC2', '9It1msSc1sO9ZsVuXeIClvxUJB5L1hErrv6CrnLChtTEhNhAeA5yqSt0xBlV', NULL, '2023-05-09 10:29:26'),
(6, 'quy', NULL, 'bichquy@gmail.com', 'customer', NULL, 'phu yen', '$2y$10$WroyiB7IlW0u7g047wQvFe5tumN1B50kZy7NstZ8jU1.9Bweyyieq', 'IpjZwOtHFkF3J1ekPWoIizY3JNSgd0Hj2wpY2mm8o8AxjxVgfOUi5JCP6OMw', '2023-05-17 08:01:16', '2023-05-17 08:01:16');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_ibfk_1` (`category_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Chỉ mục cho bảng `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `wishlists_ibfk_1` (`user_id`),
  ADD KEY `wishlists_ibfk_2` (`product_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `orders_detail`
--
ALTER TABLE `orders_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD CONSTRAINT `orders_detail_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Các ràng buộc cho bảng `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wishlists_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
