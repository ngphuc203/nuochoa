-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 28, 2023 lúc 02:22 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `nuochoa`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banners`
--

CREATE TABLE `banners` (
  `banner_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `banners`
--

INSERT INTO `banners` (`banner_id`, `image`) VALUES
(1, 'banner_64971d5a235d46.73527116.jpg'),
(2, 'banner_64971d62019939.89993753.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `brands`
--

INSERT INTO `brands` (`brand_id`, `name`) VALUES
(1, 'Versace'),
(2, 'Giorgio Armani'),
(4, 'Acqua Di Parma'),
(5, 'Montblanc'),
(6, 'Escentric Molecules'),
(7, 'Yves Saint Laurent'),
(8, 'Gucci');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `description`) VALUES
(1, 'Nước Hoa Nam', 'Bản Lĩnh Phái Mạnh'),
(2, 'Nước Hoa Nữ', 'Hương Thơm Dài Lâu'),
(3, 'Unisex', '111');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `news`
--

INSERT INTO `news` (`news_id`, `image`, `title`, `content`) VALUES
(2, 'get.png', 'KHÁM PHÁ NƯỚC HOA MONTBLANC EXPLORER FOR MEN EDP - HÀNH TRÌNH ĐẬM CHẤT PHIÊU LƯU TRONG THẾ GIỚI HƯƠNG', '<p>Trong thế giới vô vàn hương thơm cao cấp, <a href=\"https://www.thegioinuochoa.com.vn/mont-blanc\"><i><strong>Montblanc</strong></i></a> là một thương hiệu đã khẳng định vị thế của mình với những tác phẩm sáng tạo độc đáo và đẳng cấp. Và không ngoại lệ, <i><strong>Montblanc Explorer For Men EDP</strong></i> đã trở thành một biểu tượng mới trong dòng sản phẩm nước hoa nam. Với sự kết hợp tinh tế giữa hương thảo mộc và sự mạnh mẽ của những thành phần tự nhiên, <a href=\"https://www.thegioinuochoa.com.vn/mont-blanc/6552-montblanc-explorer-for-men-edp.html\"><strong>nước hoa Montblanc Explorer&nbsp; For Men EDP </strong></a>mang lại một trải nghiệm thực sự độc đáo và táo bạo cho những quý ông hiện đại. Hãy cùng&nbsp;<a href=\"https://www.thegioinuochoa.com.vn/\"><i><strong>Thế Giới Nước Hoa</strong></i></a> khám phá rõ hơn về dòng sản phẩm&nbsp;<i><strong>Montblanc Explorer For Men EDP</strong></i>&nbsp;trong bài viết này nhé!</p><figure class=\"image\"><img src=\"https://www.thegioinuochoa.com.vn/image/get?file=gallery%2Furi%2F202306%2F1687936542.6402.png\" alt=\"\"></figure><p><i>Montblanc Explorer for Men EDP là một hành trình khám phá sự mạnh mẽ và tinh tế</i></p><h4><strong>1. NƯỚC HOA MONTBLANC EXPLORER FOR MEN EDP - CHÀNG TRAI YÊU THÍCH SỰ PHIÊU LƯU VÀ THÁCH THỨC</strong></h4><p><a href=\"https://www.thegioinuochoa.com.vn/mont-blanc/6552-montblanc-explorer-for-men-edp.html\"><strong>Nước hoa Montblanc Explorer For Men EDP</strong></a>&nbsp;là câu chuyện đầy cảm hứng về những cuộc phiêu lưu,&nbsp; tìm kiếm sự thành công và khát khao muốn phá vỡ mọi giới hạn. Ở chai nước hoa này, ba chuyên gia mùi hương Jordi Fernandez, Antoine Maisondieu và Oliver Pescheux đã mang đến cho chúng ta một người đàn ông hiện đại trưởng thành, đầy tự tin, luôn tò mò tìm kiếm những điều mới mẻ và dũng cảm trong mọi tình huống.</p><h4><strong>2. HƯƠNG THƠM NAM TÍNH VÀ QUYẾN RŨ CỦA NƯỚC HOA MONTBLANC EXPLORER FOR MEN EDP</strong></h4><p><i><strong>Montblanc Explorer for Men EDP</strong></i> là một hành trình khám phá sự mạnh mẽ và tinh tế. Hương đầu của nước hoa là sự pha trộn giữa Cam Bergamot và Hồng tiêu, mang lại một sự tươi mát và sảng khoái. Hương giữa của Da thuộc và Cỏ hương bài tạo nên một sự ấm áp và quyến rũ đầy lôi cuốn. Cuối cùng, hương cơ bản của&nbsp;<a href=\"https://www.thegioinuochoa.com.vn/mont-blanc/6552-montblanc-explorer-for-men-edp.html\"><strong>nước hoa Montblanc Explorer for Men EDP</strong></a> với sự kết hợp của Lá cây hoắc hương Indo, Akigalawood và Hương Ambroxan mang lại một sự cân bằng hoàn hảo và kéo dài hương thơm.<strong>&nbsp;</strong></p><figure class=\"image\"><img src=\"https://www.thegioinuochoa.com.vn/image/get?file=gallery%2Furi%2F202306%2F1687936542.3572.png\" alt=\"\"></figure><p><br>&nbsp;</p><p><i>Đây là một lựa chọn hoàn hảo cho những quý ông muốn tỏa sáng và tạo dấu ấn riêng của mình</i></p><p>Không chỉ mạnh mẽ trong hương thơm,&nbsp;<a href=\"https://www.thegioinuochoa.com.vn/mont-blanc/6552-montblanc-explorer-for-men-edp.html\"><i><strong>Montblanc Explorer for Men EDP</strong></i></a> còn chinh phục người dùng bởi thiết kế sang trọng và tỉ mỉ. Chai nước hoa được thiết kế đơn giản nhưng vô cùng đẳng cấp, mang lại một cảm giác sang trọng và lịch lãm khi sử dụng.</p><h4><strong>3. NƯỚC HOA MONTBLANC EXPLORER FOR MEN EDP MANG ĐẾN SỰ TỰ TIN VÀ ĐẲNG CẤP CHO NGƯỜI SỬ DỤNG</strong></h4><p><a href=\"https://www.thegioinuochoa.com.vn/mont-blanc/6552-montblanc-explorer-for-men-edp.html\"><strong>Nước hoa&nbsp;Montblanc Explorer for Men EDP</strong></a>&nbsp;không chỉ đơn thuần là một loại nước hoa, mà là một tác phẩm nghệ thuật đầy sự tỉ mỉ và cảm hứng, thể hiện cái tôi và cái chất của người đàn ông hiện đại.. Hương thơm nam tính và quyến rũ này sẽ nâng tầm phong cách của bạn và ghi dấu ấn đáng nhớ trong mọi cuộc gặp gỡ và sự kiện.&nbsp;</p><p><a href=\"https://www.thegioinuochoa.com.vn/mont-blanc/6552-montblanc-explorer-for-men-edp.html\"><i><strong>Montblanc Explorer for Men EDP</strong></i></a><i>&nbsp;</i>không chỉ là một lựa chọn hoàn hảo cho những quý ông muốn thể hiện sự cá tính và đẳng cấp, mà còn là một món quà tuyệt vời cho những người thân yêu của bạn. Bạn có thể tự tin tặng nước hoa này như một món quà đáng nhớ trong các dịp đặc biệt như sinh nhật, kỷ niệm, hay ngày lễ.</p><figure class=\"image\"><img src=\"https://www.thegioinuochoa.com.vn/image/get?file=gallery%2Furi%2F202306%2F1687936542.055.png\" alt=\"\"></figure><p><br>&nbsp;</p><p><i>Được đựng trong một&nbsp;thiết kế chai đẳng cấp, Montblanc Explorer for Men EDP thực sự là một biểu tượng của sự sang trọng và lịch lãm</i></p><p><a href=\"https://www.thegioinuochoa.com.vn/mont-blanc/6552-montblanc-explorer-for-men-edp.html\"><i><strong>Montblanc Explorer for Men EDP</strong></i></a>&nbsp;không chỉ là một lựa chọn hoàn hảo cho những quý ông muốn thể hiện sự cá tính và đẳng cấp, mà còn là một món quà tuyệt vời cho những người thân yêu của bạn. Bạn có thể tự tin tặng nước hoa này như một món quà đáng nhớ trong các dịp đặc biệt như sinh nhật, kỷ niệm, hay ngày lễ.</p><p><i><strong>Montblanc Explorer for Men EDP</strong></i> là một tác phẩm nước hoa nam độc đáo và đẳng cấp từ Montblanc. Với hương thơm mạnh mẽ và sự tỉ mỉ trong từng chi tiết, nước hoa này mang đến sự tự tin, nam tính và quyến rũ cho những quý ông hiện đại. Nếu bạn đang tìm kiếm một hương thơm độc đáo và biểu tượng để thể hiện phong cách riêng của mình,&nbsp;<a href=\"https://www.thegioinuochoa.com.vn/mont-blanc/6552-montblanc-explorer-for-men-edp.html\"><strong>Nước hoa&nbsp;Montblanc Explorer for Men EDP</strong></a> là sự lựa chọn hoàn hảo. Hãy đến ngay&nbsp;<a href=\"https://www.thegioinuochoa.com.vn/\"><i><strong>Thế Giới Nước Hoa</strong></i></a>, khám phá và trải nghiệm sức mạnh của nó và tạo dấu ấn riêng của mình bạn nhé.</p>');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_date` date DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`order_id`, `order_date`, `total_amount`, `status`, `name`, `address`, `phone`) VALUES
(6, '2023-06-28', 10480000.00, 'Đã hoàn thành', 'q', 'ádasd', '123123123');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `order_detail_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`order_detail_id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(5, 6, 9, 2, 2250000.00),
(6, 6, 10, 2, 2990000.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `origins`
--

CREATE TABLE `origins` (
  `origin_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `origins`
--

INSERT INTO `origins` (`origin_id`, `name`) VALUES
(1, 'Pháp'),
(2, 'USA'),
(3, 'Anh'),
(4, 'Nhật'),
(6, 'Italy'),
(7, 'Đức');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `origin_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `price`, `image`, `category_id`, `brand_id`, `origin_id`, `created_at`, `updated_at`) VALUES
(9, 'Nước hoa ACQUA DI PARMA BLU MEDI CHINOTTO DI LIGURIA EDT', '<p><strong>Phong cách:&nbsp;Thanh lịch , Mạnh mẽ , Thu hút</strong></p>', 2250000.00, '20230625142320.jpg', 1, 4, 2, '2023-06-25 12:23:20', '2023-06-25 12:23:20'),
(10, 'Nước Hoa YVES SAINT LAURENT LIBRE EDP', '<figure class=\"image\"><img src=\"https://nuochoamy.vn/upload/images/nuoc-hoa-nu(9).jpg\" alt=\"Nước Hoa YVES SAINT LAURENT LIBRE EDP 90ml\"></figure><p><br><i><strong>Hốt hoảng khi mùi cơ thể khó chịu của nàng ảnh hưởng đám đông?</strong></i><br><i><strong>Thường xuyên tiếp khách nhưng mất tự tin?</strong></i><br><i><strong>Chàng né tránh, không gần gũi, xảy ra cãi vã liên tục?</strong></i><br><i><strong>Bất ngờ phát hiện nhiều vệt nám ở vùng da xịt nước hoa?</strong></i><br><br>Bạn đang gặp những vấn đề nan giải&nbsp;như trên? Bạn ngại ngùng khi gặp những trở ngại không đáng có hoặc không hay biết loại nước hoa mình đang sử dụng bị dị ứng trầm trọng:<br><br><strong>- Nếu không sử dụng nước hoa, bạn khó lòng tự tin trước nhiều người, trình bày lệch lạc, không phát huy khả năng bản thân ở cuộc họp quan trọng.</strong><br><strong>- Nếu không sử dụng nước hoa, mùi cơ thể khó chịu gây mất thiện cảm trước đám đông, đặc biệt là phái đẹp.</strong><br><strong>- Nếu bạn sử dụng nước hoa hết hạn, bạn mắc phải những tiềm ẩn về dị ứng và kích ứng da</strong><br><br><strong>- Nếu bạn lạm dụng nước hoa, càng ngay ra nhiều hệ lụy, ảnh hưởng trầm trọng&nbsp;và gây hại cho mô não.</strong><br><strong>- Nếu bạn lạm dụng nước hoa&nbsp;thường xuyên có thể dẫn đến nám da, da trở nên nhạy cảm với ánh sáng hơn.</strong><br><strong>- Nếu bạn lạm dụng nước hoa quá mức,&nbsp;khả năng gây ung thư, dị tật bẩm sinh, rối loạn hệ thống thần kinh trung ương và các phản ứng dị ứng nghêm trọng.</strong><br><br><i>Đối với phụ nữ, nước hoa như người bạn đồng hành, luôn bên cạnh để tạo thêm phần tự tin. Tại sao lại như thế? Bởi lẽ:</i><br><br><strong>- Nước hoa giúp tạo dấu ấn, lan tỏa ra từ cơ thể phụ nữ, cuốn hút người đối diện</strong><br><strong>- Nước hoa thể hiện cá tính qua hương nước hoa, giúp bạn tự tin, thể hiện bản thân hơn</strong><br><strong>- Nước hoa giữ lửa tình yêu, khơi gợi cảm xúc cùng chàng, đó là chìa khóa để giữ vững tình yêu.</strong><br><strong>- Nước hoa giúp dấu đi mùi cơ thể khó chịu làm người ta say mê.</strong><br><br>&nbsp;</p><blockquote><p><i><strong>Bạn biết gì về Nước Hoa YSL Y EDT 80ml?</strong></i></p><p><br><i>YSL Y thể hiện sự cân bằng giữa những nốt hương mạnh mẽ và nhẹ nhàng, nồng nàn và tươi mát. Một mùi hương nguyên bản và nổi bật, xác định lại vẻ đẹp nam tính là những gì được mô tả về YSL Y.</i><br><br><i>Thành phần của mùi hương được lựa chọn dựa trên sự tương phản giữa những nốt tươi, sáng với các sắc thái mạnh, tối và đầy nhục cảm. Aldehyde trắng, tinh dầu cam quýt, gia vị cay và hương liệu thơm đặt cạnh long diên hương, trầm hương, nhựa thông, tuyết tùng và xạ hương, tạo nên một bản hòa phối kỳ lạ và gợi cảm.</i><br><br><i>Thiết kế chai là một biểu hiện của tính nam tính hiện đại, sáng tạo. Thân chai thủy tinh trong vuông vứt mạnh mẽ với cách tô điểm gắn trên thân với một kim loại ‘Y’. Nó thể hiện được liên kết đến di sản của thương hiệu Yves Saint Laurent.</i></p></blockquote><ul><li><strong>Phong cách:&nbsp;Nữ tính, gợi cảm, nồng nàn</strong></li><li><strong>Xuất xứ: Pháp</strong></li><li><strong>Nồng độ:&nbsp;Eau De Parfum&nbsp;(EDP)</strong></li><li><strong>Cách sử dụng: xịt</strong></li><li><strong>Lưu hương: 7-12h</strong></li><li><strong>Nhóm hương:&nbsp;</strong></li><li><strong>Mùi hương đặc trưng: Hoa cam, Hoa oải hương, Hương vanila</strong></li></ul>', 2990000.00, '20230626093423.jpg', 2, 7, 1, '2023-06-26 07:34:23', '2023-06-26 07:34:23'),
(11, 'Nước Hoa MONTBLANC EXPLORER EDP 100ML', '<p><br>&nbsp;</p><figure class=\"image\"><img src=\"https://nuochoamy.vn/upload/images/bn%20nh%20nam.png\" alt=\"Nước hoa CAROLINA HERRERA 212 EDT 100ml\"></figure><p><br><i><strong>Thật thảm họa nếu&nbsp;mùi cơ thể khó chịu của mình ảnh hưởng đám đông?</strong></i><br><i><strong>Tự ti khi tiếp xúc nhiều&nbsp;người trong các dịp quan trọng: hội họp, dự tiệc...?</strong></i><br><i><strong>Tình yêu nhàm chán, đi xuống và gặp nhiều trục trặc, cãi vã?</strong></i><br><i><strong>Hoang mang khi vùng da sử dụng nước hoa xuất hiện triệu chứng dị ứng, bị nám?</strong></i><br><br>Bạn đang gặp những vấn đề nan giải&nbsp;như trên? Bạn đã khá tốn kém để tìm phương án \"cứu cánh\" vì mùi cơ thể khó chịu của mình hoặc không hay biết loại nước hoa mình đang sử dụng bị dị ứng trầm trọng:<br><br><strong>- Nếu không sử dụng nước hoa, bạn khó lòng tự tin trước nhiều người, trình bày lệch lạc, không phát huy khả năng bản thân ở cuộc họp quan trọng.</strong><br><strong>- Nếu không sử dụng nước hoa, mùi cơ thể khó chịu gây mất thiện cảm trước đám đông, đặc biệt là phái đẹp.</strong><br><strong>- Nếu bạn sử dụng nước hoa hết hạn, bạn mắc phải những tiềm ẩn về dị ứng và kích ứng da</strong><br><br><strong>- Nếu bạn lạm dụng nước hoa, càng ngay ra nhiều hệ lụy, ảnh hưởng trầm trọng&nbsp;và gây hại cho mô não.</strong><br><strong>- Nếu bạn lạm dụng nước hoa&nbsp;thường xuyên có thể dẫn đến nám da, da trở nên nhạy cảm với ánh sáng hơn.</strong><br><strong>- Nếu bạn lạm dụng nước hoa quá mức,&nbsp;khả năng gây ung thư, dị tật bẩm sinh, rối loạn hệ thống thần kinh trung ương và các phản ứng dị ứng nghêm trọng.</strong><br><br><i>Nước hoa&nbsp;là một loại trang sức vô hình, nhưng cũng sẽ bất lợi nếu sử dụng không đúng cách. Vì thế, hãy tìm hiểu hướng dẫn trước khi sử dụng nhé!</i><br><br><strong>- Nước hoa tạo dấu ấn qua mùi hương nước hoa, lan tỏa ra từ cơ thể mới làm người ta nhớ mãi</strong><br><strong>- Nước hoa thể hiện cá tính qua hương nước hoa, giúp bạn tự tin, thể hiện bản thân hơn</strong><br><strong>- Nước hoa giữ lửa tình yêu, khơi gợi cảm xúc đối phương, đó là chìa khóa để giữ vững tình yêu.</strong><br><strong>- Nước hoa giúp dấu đi mùi cơ thể khó chịu làm người ta say mê.</strong><br><br>Xem thêm:&nbsp;<strong>Top 50+ Mẫu&nbsp;</strong><a href=\"https://nuochoamy.vn/top-nuoc-hoa-cho-nam-nu-chinh-hang-xach-tay-nhap-khau-my-cao-cap-gia-re-tai-hcm.html\"><strong>nước hoa cho nam chính hãng xách tay</strong></a><strong>&nbsp;cao cấp thịnh hành 2020</strong><br><strong>THAM KHẢO: BÍ QUYẾT </strong><a href=\"https://nuochoamy.vn/nuoc-hoa-theo-so-thich.html\"><strong>CHỌN NƯỚC HOA PHÙ HỢP VỚI TÍNH CÁCH SỞ THÍCH</strong></a></p><blockquote><p><i><strong>Bạn biết gì về Nước Hoa MONTBLANC EXPLORER EDP?</strong></i><br><br><i>Nước Hoa MONTBLANC EXPLORER EDP được thiết kế mạnh mẽ và nam tính, mở đầu hương thơm với sự pha trộn một cách cầu kỳ giữa hương cam bergamot và Hồng tiêu, thanh tươi và ấm nồng trong hai nhóm hương tạo thành một cảm giác khác biệt.</i><br><br><i>Với thành phần cam được đẩy cao hơn một cách thông minh biến topnote trở nên phóng khoáng, trẻ trung và cực kỳ tươi mát, phù hợp cho mọi không gian và thời gian. Da thuộc và cỏ hương bài sẽ ẩn hiện tại tầng hương giữa, khó để cảm nhận một cách thật rõ ràng, trước khi hương thơm đầy cuốn hút của Ambroxan cùng Akigalawood biến bạn trở thành một người đàn ông giàu tham vọng, một kẻ tự tin, thành đạt, và cực kỳ hấp dẫn trong mắt phụ nữ.</i></p></blockquote><ul><li><strong>Giới tính:&nbsp;Nam</strong></li><li><strong>Phong cách:&nbsp;Tự tin, Nam tính, Cuốn hút</strong></li><li><strong>Xuất xứ: Đức</strong></li><li><strong>Nồng độ:&nbsp;Eau De Parfum (EDP)</strong></li><li><strong>Cách sử dụng: xịt</strong></li><li><strong>Lưu hương: 7&nbsp;- 12&nbsp;giờ</strong></li><li><strong>Nhóm hương:&nbsp;Hương gỗ thơm</strong></li></ul><p><strong>Hương Đầu: Cam Bergamot, Hồng tiêu</strong><br><strong>Hương giữa: Da thuộc, Cỏ hương bài</strong><br><strong>Hương cuối: Lá cây hoắc hương Indo, Akigalawood, Hương Ambroxan</strong><br>&nbsp;</p><figure class=\"image\"><img src=\"https://nuochoamy.vn/upload/images/nuoc-hoa-cho-nam(2).png\" alt=\"Nước hoa CAROLINA HERRERA 212 EDT 100ml\"></figure><p><strong>CÁC LƯU Ý KHI MUA HÀNG</strong></p><ul><li>1. Địa chỉ mua hàng: <strong>142D/18 Cô Giang, Phường 2, Phú Nhuận, Tp.HCM</strong> ( Đi hết đường cô giang quẹo phải rồi quẹo trái là hẻm 142D)</li><li>2. Vui lòng liên hệ: <strong>0901961077</strong>&nbsp;để được giải đáp và hỗ trợ tư vấn.</li><li>3. Vui lòng kiểm tra kỹ hóa đơn, số tiền thừa&nbsp;trước&nbsp;khi rời quầy thanh toán.</li><li>4. Mọi khiếu nại về thanh toán không được giải quyết sau khi rời quầy thanh toán.</li><li>5. Cam kết chính hãng 100% - Phát hiện <strong>hàng Fake 1 Đền 10</strong></li><li>6. Chính sách&nbsp;bảo hành chuyên nghiệp - <strong>1 ĐỔI 1 TRONG 2 THÁNG&nbsp;</strong></li></ul>', 600000.00, '20230628135158.jpg', 1, 5, 7, '2023-06-28 11:51:58', '2023-06-28 11:51:58'),
(12, 'Nước Hoa Jean Paul Gaultier So Scandal EDP', '<h3>CHI TIẾT SẢN PHẨM</h3><figure class=\"image\"><img src=\"https://nuochoamy.vn/upload/images/1-tim-mua-nuoc-hoa-cho-nu(2).jpg\" alt=\"Nước Hoa Jean Paul Gaultier So Scandal EDP \"></figure><p><i><strong>Hốt hoảng khi mùi cơ thể khó chịu của nàng ảnh hưởng đám đông?</strong></i><br><i><strong>Thường xuyên tiếp khách nhưng mất tự tin?</strong></i><br><i><strong>Chàng né tránh, không gần gũi, xảy ra cãi vã liên tục?</strong></i><br><i><strong>Bất ngờ phát hiện nhiều vệt nám ở vùng da xịt nước hoa?</strong></i><br><br>Bạn đang gặp những vấn đề nan giải&nbsp;như trên? Bạn ngại ngùng khi gặp những trở ngại không đáng có hoặc không hay biết loại nước hoa mình đang sử dụng bị dị ứng trầm trọng:<br><br><strong>- Nếu không sử dụng nước hoa, bạn khó lòng tự tin trước nhiều người, trình bày lệch lạc, không phát huy khả năng bản thân ở cuộc họp quan trọng.</strong><br><strong>- Nếu không sử dụng nước hoa, mùi cơ thể khó chịu gây mất thiện cảm trước đám đông, đặc biệt là phái đẹp.</strong><br><strong>- Nếu bạn sử dụng nước hoa hết hạn, bạn mắc phải những tiềm ẩn về dị ứng và kích ứng da</strong><br><br><strong>- Nếu bạn lạm dụng nước hoa, càng ngay ra nhiều hệ lụy, ảnh hưởng trầm trọng&nbsp;và gây hại cho mô não.</strong><br><strong>- Nếu bạn lạm dụng nước hoa&nbsp;thường xuyên có thể dẫn đến nám da, da trở nên nhạy cảm với ánh sáng hơn.</strong><br><strong>- Nếu bạn lạm dụng nước hoa quá mức,&nbsp;khả năng gây ung thư, dị tật bẩm sinh, rối loạn hệ thống thần kinh trung ương và các phản ứng dị ứng nghêm trọng.</strong><br><br><i>Đối với phụ nữ, nước hoa như người bạn đồng hành, luôn bên cạnh để tạo thêm phần tự tin. Tại sao lại như thế? Bởi lẽ:</i><br><br><strong>- Nước hoa giúp tạo dấu ấn, lan tỏa ra từ cơ thể phụ nữ, cuốn hút người đối diện</strong><br><strong>- Nước hoa thể hiện cá tính qua hương nước hoa, giúp bạn tự tin, thể hiện bản thân hơn</strong><br><strong>- Nước hoa giữ lửa tình yêu, khơi gợi cảm xúc cùng chàng, đó là chìa khóa để giữ vững tình yêu.</strong><br><strong>- Nước hoa giúp dấu đi mùi cơ thể khó chịu làm người ta say mê.</strong><br><br>Xem thêm:&nbsp;<strong>Top 50+ Mẫu&nbsp;</strong><a href=\"https://chosaigon24h.vn/gia-ban-nuoc-hoa-hang-hieu-nam-nu-chinh-hang-re-nhat-tai-hcm.html\"><strong>nước hoa cho nữ chính hãng xách tay</strong></a><strong>&nbsp;cao cấp thịnh hành 2020</strong></p><p><strong>CLICK XEM: </strong><a href=\"https://nuochoamy.vn/nuoc-hoa-theo-so-thich.html\"><strong>Bí quyết chọn nước hoa phù hợp với tính cách sở thích</strong></a></p><blockquote><p><i><strong>Bạn biết gì về Nước Hoa JEAN PAUL SO SCANDAL EDP?</strong></i><br><i>Khi So Scandal tiếp cận, hương thơm ngọt ngào tràn ngập không gian và dường như không ai có thể trốn khỏi sự cám dỗ mượt mà mà So Scandal mang lại. Sự kết hợp tinh tế của những loài hoa trắng mang vẻ đẹp thuần khiết dần dần xuất hiện. Hoa Cam đẹp theo cách trong sáng, Hoa Nhài Sambac thanh tao và Hoa Huệ uỷ mị, chúng kết hợp với nhau như đang nhẹ nhàng ve vẩy vẻ đẹp của một thiên thần. Nhưng Scandal vẫn là Scandal, những dòng sữa ngấm dần vào làn da… mềm mại, nũng nịu và gợi tình, So Scandal có thể liếc nhìn bạn bằng đôi mắt của một cô Nàng ngây thơ và khiến bạn chuếnh choáng trong khoái cảm.</i></p><p>&nbsp;</p></blockquote><p>&nbsp; &nbsp;</p><p><strong>Thương hiệu:&nbsp;</strong>Jean Paul Gaultier</p><p><strong>Xuất xứ</strong>: Pháp, Tây Ban Nha</p><p><strong>Năm phát hành</strong>: 2020</p><p><strong>Nhóm hương</strong>: Quả mâm xôi, Hoa huệ tây, Sữa</p><p><strong>Phong cách</strong>: Quyến rũ, Gợi cảm, Khiêu khích</p><p>Hương chính: Hoa huệ, Orange Blossom, Hoa Nhài Sambac, Sữa, Raspberry&nbsp; &nbsp;</p>', 9000000.00, '20230628140442.jpg', 2, 1, 7, '2023-06-28 12:04:42', '2023-06-28 12:04:42'),
(13, 'Nước Hoa Versace Pour Homme EDT 100ml 200ml', '<p>&nbsp;</p><figure class=\"image\"><img src=\"https://nuochoamy.vn/upload/images/nuoc-hoa-nam(5).jpg\" alt=\"Nước Hoa Dior Homme Sport EDT 125ml\"></figure><p><br><br><i><strong>Thật thảm họa nếu&nbsp;mùi cơ thể khó chịu của mình ảnh hưởng đám đông?</strong></i><br><i><strong>Tự ti khi tiếp xúc nhiều&nbsp;người trong các dịp quan trọng: hội họp, dự tiệc...?</strong></i><br><i><strong>Tình yêu nhàm chán, đi xuống và gặp nhiều trục trặc, cãi vã?</strong></i><br><i><strong>Hoang mang khi vùng da sử dụng nước hoa xuất hiện triệu chứng dị ứng, bị nám?</strong></i><br><br>Bạn đang gặp những vấn đề nan giải&nbsp;như trên? Bạn đã khá tốn kém để tìm phương án \"cứu cánh\" vì mùi cơ thể khó chịu của mình hoặc không hay biết loại nước hoa mình đang sử dụng bị dị ứng trầm trọng:<br><br><strong>- Nếu không sử dụng nước hoa, bạn khó lòng tự tin trước nhiều người, trình bày lệch lạc, không phát huy khả năng bản thân ở cuộc họp quan trọng.</strong><br><strong>- Nếu không sử dụng nước hoa, mùi cơ thể khó chịu gây mất thiện cảm trước đám đông, đặc biệt là phái đẹp.</strong><br><strong>- Nếu bạn sử dụng nước hoa hết hạn, bạn mắc phải những tiềm ẩn về dị ứng và kích ứng da</strong><br><br><strong>- Nếu bạn lạm dụng nước hoa, càng ngay ra nhiều hệ lụy, ảnh hưởng trầm trọng&nbsp;và gây hại cho mô não.</strong><br><strong>- Nếu bạn lạm dụng nước hoa&nbsp;thường xuyên có thể dẫn đến nám da, da trở nên nhạy cảm với ánh sáng hơn.</strong><br><strong>- Nếu bạn lạm dụng nước hoa quá mức,&nbsp;khả năng gây ung thư, dị tật bẩm sinh, rối loạn hệ thống thần kinh trung ương và các phản ứng dị ứng nghêm trọng.</strong><br><br><i><strong>Nước hoa&nbsp;là một loại trang sức vô hình, nhưng cũng sẽ bất lợi nếu sử dụng không đúng cách. Vì thế, hãy tìm hiểu hướng dẫn trước khi sử dụng nhé!</strong></i><br><br><strong>- Nước hoa tạo dấu ấn qua mùi hương nước hoa, lan tỏa ra từ cơ thể mới làm người ta nhớ mãi</strong><br><strong>- Nước hoa thể hiện cá tính qua hương nước hoa, giúp bạn tự tin, thể hiện bản thân hơn</strong><br><strong>- Nước hoa giữ lửa tình yêu, khơi gợi cảm xúc đối phương, đó là chìa khóa để giữ vững tình yêu.</strong><br><strong>- Nước hoa giúp dấu đi mùi cơ thể khó chịu làm người ta say mê.</strong><br><br>Xem thêm:&nbsp;<strong>Top 50+ Mẫu&nbsp;</strong><a href=\"https://nuochoamy.vn/top-nuoc-hoa-cho-nam-nu-chinh-hang-xach-tay-nhap-khau-my-cao-cap-gia-re-tai-hcm.html\"><strong>nước hoa cho nam chính hãng xách tay</strong></a><strong>&nbsp;cao cấp thịnh hành 2020</strong><br><strong>THAM KHẢO: BÍ QUYẾT </strong><a href=\"https://nuochoamy.vn/nuoc-hoa-theo-so-thich.html\"><strong>CHỌN NƯỚC HOA PHÙ HỢP VỚI TÍNH CÁCH SỞ THÍCH</strong></a></p><blockquote><p><i><strong>Bạn biết gì về Nước Hoa Versace Pour Homme EDT 100ml?</strong></i><br><br><i>Versace Pour Homme của nhãn hiệu Versace là chai nước hoa mới thuộc dòng hương thơm Fougere dành cho nam giới. Được giới thiệu vào năm 2008 với người sáng tạo ra dòng nước hoa này là Alberto Morllas. Thông qua hương thơm đầy nam tính , dứt khoát, Versace Pour Homme liên kết sức mạnh và sự say mê để tạo nên một người đàn ông năng động và thành đạt.</i></p></blockquote><ul><li><strong>Giới tính:&nbsp;Nam</strong></li><li><strong>Phong cách: Cá tính&nbsp;, Mạnh mẽ , Thu hút</strong></li><li><strong>Xuất xứ: Mỹ</strong></li><li><strong>Nồng độ:&nbsp;Eau De Toilette (EDT)</strong></li><li><strong>Cách sử dụng: xịt</strong></li><li><strong>Lưu hương: 7&nbsp;- 10&nbsp;giờ</strong></li><li><strong>Nhóm hương:&nbsp;</strong></li></ul><p><strong>Hương Đầu: Quả chanh vàng, Hoa cam Neroli, Cam Bergamot, Hoa hồng de Mai (tháng năm)</strong><br><strong>Hương giữa: Hoa lan dạ hương, Cây đơn sâm, Gỗ tuyết tùng, Hoa phong lữ</strong><br><strong>Hương cuối: Đậu Tonka, Xạ hương, Hổ phách</strong><br>&nbsp;</p><h2>NHỮNG HÌNH ẢNH THỰC TẾ&nbsp;SHOWROOM NƯỚC HOA<br>&nbsp;</h2><figure class=\"image\"><img src=\"https://nuochoamy.vn/upload/images/showroom1%20(1)(1).jpg\" alt=\"Giới thiệu\"></figure><figure class=\"image\"><img src=\"https://nuochoamy.vn/upload/images/showroom%20(1).jpg\" alt=\"Giới thiệu\"></figure><figure class=\"image\"><img src=\"https://nuochoamy.vn/upload/images/showroom5%20(1).jpg\" alt=\"Giới thiệu\"></figure><p><strong>CÁC LƯU Ý KHI MUA HÀNG</strong></p><ul><li>1. Địa chỉ mua hàng: <strong>142D/18 Cô Giang, Phường 2, Phú Nhuận, Tp.HCM</strong> ( Đi hết đường cô giang quẹo phải rồi quẹo trái là hẻm 142D)</li><li>2. Vui lòng liên hệ: <strong>0901961077</strong>&nbsp;để được giải đáp và hỗ trợ tư vấn.</li><li>3. Vui lòng kiểm tra kỹ hóa đơn, số tiền thừa&nbsp;trước&nbsp;khi rời quầy thanh toán.</li><li>4. Mọi khiếu nại về thanh toán không được giải quyết sau khi rời quầy thanh toán.</li><li>5. Cam kết chính hãng 100% - Phát hiện <strong>hàng Fake 1 Đền 10</strong></li><li>6. Chính sách&nbsp;bảo hành chuyên nghiệp - <strong>1 ĐỔI 1 TRONG 2 THÁNG&nbsp;</strong></li></ul>', 7400051.00, '20230628140609.jpg', 1, 1, 6, '2023-06-28 12:06:09', '2023-06-28 12:06:09');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`banner_id`);

--
-- Chỉ mục cho bảng `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `origins`
--
ALTER TABLE `origins`
  ADD PRIMARY KEY (`origin_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `origin_id` (`origin_id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `banners`
--
ALTER TABLE `banners`
  MODIFY `banner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `origins`
--
ALTER TABLE `origins`
  MODIFY `origin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`origin_id`) REFERENCES `origins` (`origin_id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`brand_id`),
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
