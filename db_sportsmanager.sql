-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2019 at 02:06 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sportsmanager`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_title`
--

CREATE TABLE `account_title` (
  `Account_Title_ID` int(11) NOT NULL,
  `Head_Of_Account_ID` int(11) NOT NULL,
  `Account_Title` varchar(50) NOT NULL,
  `Opening_Balance` text NOT NULL,
  `Opening_Balance_Date` date NOT NULL,
  `Account_Code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_title`
--

INSERT INTO `account_title` (`Account_Title_ID`, `Head_Of_Account_ID`, `Account_Title`, `Opening_Balance`, `Opening_Balance_Date`, `Account_Code`) VALUES
(1, 8, 'Sales A/c', '0', '2018-08-03', 'SAL001'),
(2, 3, 'Advertising Expense A/c', '0', '2018-08-03', 'ADE001'),
(3, 3, 'Amortization Expense A/c', '0', '2018-08-03', 'AME001'),
(4, 3, 'Insurance Expense A/c', '0', '2018-08-03', 'INE001'),
(5, 3, 'Salaries and Wages A/c', '0', '2018-08-03', 'SAW001'),
(6, 3, 'Rent Expense A/c', '0', '2018-08-03', 'RNE001'),
(7, 3, 'Utilities Expense A/c', '0', '2018-08-03', 'UTE001'),
(8, 3, 'Marketing Expense A/c', '0', '2018-08-03', 'MKE001'),
(9, 8, 'Gain on sale A/c', '0', '2018-08-03', 'GOS001'),
(10, 8, 'Interest Income A/c', '0', '2018-08-03', 'INI001'),
(11, 3, 'Loss on sale A/c', '0', '2018-08-03', 'LOS001'),
(12, 3, 'Interest Expense A/c', '0', '2018-08-03', 'INTE001'),
(13, 6, 'Income Tax Payable A/c', '0', '2018-08-03', 'INT001'),
(14, 5, 'Cash A/c', '0', '2018-08-03', 'CASH001'),
(15, 5, 'Marketable Securities A/c', '0', '2018-08-03', 'MKS001'),
(16, 5, 'Accounts Receivable A/c', '0', '2018-08-03', 'ACR001'),
(17, 5, 'Inventory A/c', '0', '2018-08-03', 'INV001'),
(18, 5, 'Prepaid expenses A/c', '0', '2018-08-03', 'PRE001'),
(19, 5, 'Allowance for Doubtful Accounts A/c', '0', '2018-08-03', 'ADA001'),
(20, 5, 'Buildings A/c', '0', '2018-08-03', 'BLG001'),
(21, 5, 'Equipment A/c', '0', '2018-08-03', 'EQP001'),
(22, 5, 'Leasehold Improvements A/c', '0', '2018-08-03', 'LHI001'),
(23, 5, 'Accumulated Depreciation A/c', '0', '2018-08-03', 'ACD001'),
(24, 5, 'Land A/c', '0', '2018-08-03', 'LAD001'),
(25, 4, 'Investment in Bonds A/c', '0', '2018-08-03', 'IIB001'),
(26, 4, 'Investment in Stocks A/c', '0', '2018-08-03', 'IIS001'),
(27, 5, 'Goodwill A/c', '0', '2018-08-03', 'GDW001'),
(28, 5, 'Intellectual Property A/c', '0', '2018-08-03', 'INP001'),
(29, 6, 'Accounts Payable A/c', '0', '2018-08-03', 'ACP001'),
(30, 6, 'Cash Dividends Payable A/c', '0', '2018-08-03', 'CDP001'),
(31, 4, 'Capital Stock A/c', '0', '2018-08-03', 'CPS001'),
(32, 4, 'Common Stock A/c', '0', '2018-08-03', 'CMS001'),
(33, 4, 'Dividends A/c', '0', '2018-08-03', 'DIV001'),
(34, 4, 'Paid-In Capital A/c', '0', '2018-08-03', 'PIC001'),
(35, 4, 'Preferred Stock A/c', '0', '2018-08-03', 'PRS001'),
(36, 4, 'Retained Earnings A/c', '0', '2018-08-03', 'RTE001'),
(37, 4, 'Treasury Stock A/c', '0', '2018-08-03', 'TRS001'),
(38, 3, 'Income Tax A/c', '0', '2018-08-03', 'INCE001'),
(39, 3, 'Discount Allowed A/c', '0', '2018-08-15', 'DISA001'),
(40, 9, 'Opening Stock (IS) A/c', '0', '2018-08-17', 'OSIS001'),
(41, 10, 'Closing Stock (IS) A/c', '0', '2018-08-17', 'CSIS001'),
(42, 11, 'Closing Stock (BS) A/c', '0', '2018-08-17', 'CSBS001'),
(43, 5, 'Purchases A/c', '0', '2018-08-17', 'PRC001'),
(44, 5, 'Bank A/c', '0', '2018-09-22', 'BANK001');

-- --------------------------------------------------------

--
-- Table structure for table `business_info`
--

CREATE TABLE `business_info` (
  `Business_ID` int(11) NOT NULL,
  `Business_Name` varchar(30) NOT NULL,
  `Logo` text NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Contact_No` varchar(35) NOT NULL,
  `Address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `business_info`
--

INSERT INTO `business_info` (`Business_ID`, `Business_Name`, `Logo`, `Email`, `Contact_No`, `Address`) VALUES
(1, 'The Players Club', '90876', 'newsh@gmail.com', '03235135565', 'Multan');

-- --------------------------------------------------------

--
-- Table structure for table `charts_of_accounts`
--

CREATE TABLE `charts_of_accounts` (
  `Head_Of_Account_ID` int(11) NOT NULL,
  `Head_Of_Account_Title` varchar(20) NOT NULL,
  `Entry_Type_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `charts_of_accounts`
--

INSERT INTO `charts_of_accounts` (`Head_Of_Account_ID`, `Head_Of_Account_Title`, `Entry_Type_ID`) VALUES
(3, 'Expense', 0),
(4, 'Equity', 1),
(5, 'Assets', 0),
(6, 'Liabilities', 1),
(7, 'Drawings ', 0),
(8, 'Income', 1),
(9, 'Opening Stock (IS)', 0),
(10, 'Closing Stock (IS)', 1),
(11, 'Closing Stock (BS)', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Customer_ID` int(11) NOT NULL,
  `Customer_Name` varchar(30) NOT NULL,
  `Gender_ID` int(11) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Discount` int(11) NOT NULL,
  `Contact_No` text NOT NULL,
  `NIC` text NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Total_Spent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Customer_ID`, `Customer_Name`, `Gender_ID`, `Email`, `Discount`, `Contact_No`, `NIC`, `Address`, `Total_Spent`) VALUES
(0, 'Walk in Customer', 0, '', 0, '', '', '', 0),
(1, 'Adeel', 1, '', 0, '03350804614', '', '', 300);

-- --------------------------------------------------------

--
-- Table structure for table `due_date`
--

CREATE TABLE `due_date` (
  `Due_Date_ID` int(11) NOT NULL,
  `Business_ID_Ext` int(11) NOT NULL,
  `Business_Owner` varchar(25) NOT NULL,
  `Issue_Date` date NOT NULL,
  `Exp_Date` date NOT NULL,
  `Basic_Code` varchar(17) NOT NULL,
  `Act_Code` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `due_date`
--

INSERT INTO `due_date` (`Due_Date_ID`, `Business_ID_Ext`, `Business_Owner`, `Issue_Date`, `Exp_Date`, `Basic_Code`, `Act_Code`) VALUES
(1, 131, 'Sajid', '2019-06-09', '2020-06-09', '6903427790', '13779674193036');

-- --------------------------------------------------------

--
-- Table structure for table `entry_type`
--

CREATE TABLE `entry_type` (
  `Entry_Type_ID` int(11) NOT NULL,
  `Entry_Type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `entry_type`
--

INSERT INTO `entry_type` (`Entry_Type_ID`, `Entry_Type`) VALUES
(0, 'Debit'),
(1, 'Credit');

-- --------------------------------------------------------

--
-- Table structure for table `exchange_item`
--

CREATE TABLE `exchange_item` (
  `Exchange_Item_ID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Customer_ID` int(11) NOT NULL,
  `Product_Name1` varchar(20) NOT NULL,
  `Qty1` int(11) NOT NULL,
  `Product_Name2` varchar(20) NOT NULL,
  `Qty2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exchange_item`
--

INSERT INTO `exchange_item` (`Exchange_Item_ID`, `Date`, `Customer_ID`, `Product_Name1`, `Qty1`, `Product_Name2`, `Qty2`) VALUES
(1, '2018-12-17', 0, '20', 1, '1344', 1);

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `Gender_ID` int(11) NOT NULL,
  `Gender` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`Gender_ID`, `Gender`) VALUES
(1, 'Male'),
(2, 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `general_journal_detail`
--

CREATE TABLE `general_journal_detail` (
  `General_Journal_Detail_ID` int(11) NOT NULL,
  `Voucher_ID` int(11) NOT NULL,
  `Account_Title_ID` int(11) NOT NULL,
  `Entry_Type_ID` int(11) NOT NULL,
  `Amount` decimal(10,2) NOT NULL,
  `Balance` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `general_journal_detail`
--

INSERT INTO `general_journal_detail` (`General_Journal_Detail_ID`, `Voucher_ID`, `Account_Title_ID`, `Entry_Type_ID`, `Amount`, `Balance`) VALUES
(1, 1, 14, 0, '600.00', '600.00'),
(2, 1, 1, 1, '600.00', '600.00'),
(3, 2, 14, 0, '600.00', '1200.00'),
(4, 2, 1, 1, '600.00', '1200.00'),
(5, 3, 14, 0, '600.00', '1800.00'),
(6, 3, 1, 1, '600.00', '1800.00'),
(7, 4, 14, 0, '750.00', '2550.00'),
(8, 4, 1, 1, '750.00', '2550.00'),
(9, 5, 14, 0, '750.00', '3300.00'),
(10, 5, 1, 1, '750.00', '3300.00'),
(11, 6, 14, 0, '600.00', '3900.00'),
(12, 6, 1, 1, '600.00', '3900.00'),
(13, 7, 6, 0, '1200.00', '1200.00'),
(14, 7, 1, 1, '1200.00', '2700.00'),
(15, 8, 2, 0, '500.00', '500.00'),
(16, 8, 1, 1, '500.00', '2200.00'),
(17, 9, 14, 0, '750.00', '4650.00'),
(18, 9, 1, 1, '750.00', '2950.00');

-- --------------------------------------------------------

--
-- Table structure for table `general_journal_master`
--

CREATE TABLE `general_journal_master` (
  `Voucher_ID` int(11) NOT NULL,
  `Transaction_Date` date NOT NULL,
  `Memo_No` int(11) NOT NULL,
  `Is_Adjustment` tinyint(1) NOT NULL,
  `Description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `general_journal_master`
--

INSERT INTO `general_journal_master` (`Voucher_ID`, `Transaction_Date`, `Memo_No`, `Is_Adjustment`, `Description`) VALUES
(1, '2019-06-11', 0, 0, 'Paid through Invoice # 001'),
(2, '2019-06-13', 0, 0, 'Paid through Invoice # 002'),
(3, '2019-06-15', 0, 0, 'Paid through Invoice # 003'),
(4, '2019-06-17', 0, 0, 'Paid through Invoice # 004'),
(5, '2019-07-11', 0, 0, 'Paid through Invoice # 005'),
(6, '2019-08-08', 0, 0, 'Paid through Invoice # 006'),
(7, '2019-08-08', 0, 0, 'Rent Pay'),
(8, '2019-08-08', 0, 0, 'Ad Ex'),
(9, '2019-09-28', 0, 0, 'Paid through Invoice # 007');

-- --------------------------------------------------------

--
-- Table structure for table `income_statement`
--

CREATE TABLE `income_statement` (
  `Income_Statement_ID` int(11) NOT NULL,
  `Account_Title_ID` int(11) NOT NULL,
  `Entry_Type_ID` int(11) NOT NULL,
  `Amount` text NOT NULL,
  `Bit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoicedetails`
--

CREATE TABLE `invoicedetails` (
  `Invoice_Detail_ID` int(100) NOT NULL,
  `Invoice_No` int(70) NOT NULL,
  `Barcode_ID` varchar(50) NOT NULL,
  `Quantity` varchar(25) NOT NULL,
  `Purchase_Price` text NOT NULL,
  `Sale_Price` text NOT NULL,
  `Detail_Total` text NOT NULL,
  `Invoice_Individual_Discount` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoicedetails`
--

INSERT INTO `invoicedetails` (`Invoice_Detail_ID`, `Invoice_No`, `Barcode_ID`, `Quantity`, `Purchase_Price`, `Sale_Price`, `Detail_Total`, `Invoice_Individual_Discount`) VALUES
(1, 1, '110', '1', '500', '600', '600', '0'),
(2, 2, '110', '1', '500', '600', '600', '0'),
(3, 3, '110', '1', '500', '600', '600', '0'),
(4, 4, '110', '1', '500', '600', '600', '0'),
(5, 4, '111', '1', '120', '150', '150', '0'),
(6, 5, '110', '1', '500', '600', '600', '0'),
(7, 5, '111', '1', '120', '150', '150', '0'),
(8, 6, '110', '1', '500', '600', '600', '0'),
(9, 7, '111', '1', '120', '150', '150', '0'),
(10, 7, '110', '1', '500', '600', '600', '0');

-- --------------------------------------------------------

--
-- Table structure for table `invoicetype`
--

CREATE TABLE `invoicetype` (
  `Invoice_Type_ID` int(11) NOT NULL,
  `Invoice_Type_Name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoicetype`
--

INSERT INTO `invoicetype` (`Invoice_Type_ID`, `Invoice_Type_Name`) VALUES
(1, 'Retailer'),
(2, 'Wholeseller');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_master`
--

CREATE TABLE `invoice_master` (
  `Invoice_No` int(70) NOT NULL,
  `Invoice_Type_ID` int(11) NOT NULL,
  `Payment_Mode_ID` int(11) NOT NULL,
  `Customer_ID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Master_Total` text NOT NULL,
  `GrandTotal` text NOT NULL,
  `Discount` text NOT NULL,
  `Time` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_master`
--

INSERT INTO `invoice_master` (`Invoice_No`, `Invoice_Type_ID`, `Payment_Mode_ID`, `Customer_ID`, `Date`, `Master_Total`, `GrandTotal`, `Discount`, `Time`) VALUES
(1, 1, 1, 0, '2019-06-11', '600', '600', '00', '5:15 PM'),
(2, 1, 1, 0, '2019-06-13', '600', '600', '00', '6:32 PM'),
(3, 1, 1, 0, '2019-06-15', '600', '600', '00', '2:30 PM'),
(4, 1, 1, 0, '2019-06-17', '750', '750', '00', '7:10 PM'),
(5, 1, 1, 0, '2019-07-11', '750', '750', '00', '8:25 PM'),
(6, 1, 1, 0, '2019-08-08', '600', '600', '00', '8:10 PM'),
(7, 1, 1, 0, '2019-09-28', '750', '750', '00', '2:11 PM');

-- --------------------------------------------------------

--
-- Table structure for table `link_accounts`
--

CREATE TABLE `link_accounts` (
  `Account_Title_ID` int(11) NOT NULL,
  `Head_Of_Account_ID` int(11) NOT NULL,
  `Account_Date` date NOT NULL,
  `Amount` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `link_accounts`
--

INSERT INTO `link_accounts` (`Account_Title_ID`, `Head_Of_Account_ID`, `Account_Date`, `Amount`) VALUES
(1, 8, '2018-08-03', '6350'),
(2, 3, '2018-08-03', '500'),
(3, 3, '2018-08-03', '0'),
(4, 3, '2018-08-03', '0'),
(5, 3, '2018-08-03', '0'),
(6, 3, '2018-08-03', '1200'),
(7, 3, '2018-08-03', 'p'),
(8, 3, '2018-08-03', '0'),
(9, 8, '2018-08-03', '0'),
(10, 8, '2018-08-03', '0'),
(11, 3, '2018-08-03', '0'),
(12, 3, '2018-08-03', '0'),
(13, 6, '2018-08-03', '0'),
(14, 5, '2018-08-03', '4650'),
(15, 5, '2018-08-03', '0'),
(16, 5, '2018-08-03', '0'),
(17, 5, '2018-08-03', '0'),
(18, 5, '2018-08-03', '0'),
(19, 5, '2018-08-03', '0'),
(20, 5, '2018-08-03', '0'),
(21, 5, '2018-08-03', '0'),
(22, 5, '2018-08-03', '0'),
(23, 5, '2018-08-03', '0'),
(24, 5, '2018-08-03', '0'),
(25, 4, '2018-08-03', '0'),
(26, 4, '2018-08-03', '0'),
(27, 5, '2018-08-03', '0'),
(28, 5, '2018-08-03', '0'),
(29, 6, '2018-08-03', '0'),
(30, 6, '2018-08-03', '0'),
(31, 4, '2018-08-03', '0'),
(32, 4, '2018-08-03', '0'),
(33, 4, '2018-08-03', '0'),
(34, 4, '2018-08-03', '0'),
(35, 4, '2018-08-03', '0'),
(36, 4, '2018-08-03', '0'),
(37, 4, '2018-08-03', '0'),
(38, 3, '2018-08-03', '0'),
(39, 3, '2018-08-15', '0'),
(40, 9, '2018-08-17', '0'),
(41, 10, '2019-09-28', '20600'),
(42, 11, '2019-09-28', '45500'),
(43, 5, '2018-08-17', '0'),
(44, 5, '2018-09-22', '0');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `Option_ID` int(11) NOT NULL,
  `Option_Name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `paymentmode`
--

CREATE TABLE `paymentmode` (
  `Payment_Mode_ID` int(11) NOT NULL,
  `Payment_Mode` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paymentmode`
--

INSERT INTO `paymentmode` (`Payment_Mode_ID`, `Payment_Mode`) VALUES
(1, 'Cash'),
(2, 'Bank');

-- --------------------------------------------------------

--
-- Table structure for table `productcategory`
--

CREATE TABLE `productcategory` (
  `Product_Category_ID` int(11) NOT NULL,
  `Category_Name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productcategory`
--

INSERT INTO `productcategory` (`Product_Category_ID`, `Category_Name`) VALUES
(1, 'T-Shirt'),
(2, 'Polo');

-- --------------------------------------------------------

--
-- Table structure for table `productunit`
--

CREATE TABLE `productunit` (
  `Product_Unit_Id` int(11) NOT NULL,
  `Product_Unit` varchar(11) NOT NULL,
  `Product_Category_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productunit`
--

INSERT INTO `productunit` (`Product_Unit_Id`, `Product_Unit`, `Product_Category_ID`) VALUES
(1, 'Qty', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_color`
--

CREATE TABLE `product_color` (
  `pro_color_id` int(11) NOT NULL,
  `pro_color_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_color`
--

INSERT INTO `product_color` (`pro_color_id`, `pro_color_name`) VALUES
(1, 'Green'),
(2, 'Red'),
(3, 'Blue');

-- --------------------------------------------------------

--
-- Table structure for table `product_master`
--

CREATE TABLE `product_master` (
  `Barcode_ID` varchar(50) NOT NULL,
  `Product_Name` varchar(50) NOT NULL,
  `Product_Category_ID` text NOT NULL,
  `Product_Unit_Id` text NOT NULL,
  `pro_color_id` int(11) NOT NULL,
  `pro_size_id` int(11) NOT NULL,
  `product_brand` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_master`
--

INSERT INTO `product_master` (`Barcode_ID`, `Product_Name`, `Product_Category_ID`, `Product_Unit_Id`, `pro_color_id`, `pro_size_id`, `product_brand`) VALUES
('110', 'UTS Pro', '1', '1', 1, 2, 'uts'),
('111', 'Uts New', '1', '1', 1, 1, 'uts'),
('12444', 'muy tech', '1', '1', 1, 4, 'muy');

-- --------------------------------------------------------

--
-- Table structure for table `product_price`
--

CREATE TABLE `product_price` (
  `Product_Price_ID` int(100) NOT NULL,
  `Barcode_ID` varchar(50) NOT NULL,
  `Purchase_Price` text NOT NULL,
  `Retail_Price` text NOT NULL,
  `Product_Discount` text NOT NULL,
  `Product_Price_Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_price`
--

INSERT INTO `product_price` (`Product_Price_ID`, `Barcode_ID`, `Purchase_Price`, `Retail_Price`, `Product_Discount`, `Product_Price_Date`) VALUES
(1, '110', '500', '600', '0.0', '2019-06-09'),
(2, '111', '120', '150', '0.0', '2019-06-10'),
(3, '12444', '300', '400', '0.0', '2019-06-11');

-- --------------------------------------------------------

--
-- Table structure for table `product_size`
--

CREATE TABLE `product_size` (
  `pro_size_id` int(11) NOT NULL,
  `pro_size_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_size`
--

INSERT INTO `product_size` (`pro_size_id`, `pro_size_name`) VALUES
(1, 'S'),
(2, 'M'),
(3, 'L'),
(4, 'XL');

-- --------------------------------------------------------

--
-- Table structure for table `product_stock`
--

CREATE TABLE `product_stock` (
  `Product_Stock_ID` int(100) NOT NULL,
  `Barcode_ID` varchar(50) NOT NULL,
  `Product_Quantity` text NOT NULL,
  `Product_Stock_Date` date NOT NULL,
  `Vendor_ID` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_stock`
--

INSERT INTO `product_stock` (`Product_Stock_ID`, `Barcode_ID`, `Product_Quantity`, `Product_Stock_Date`, `Vendor_ID`) VALUES
(1, '110', '10', '2019-06-09', 1),
(2, '111', '10', '2019-06-10', 1),
(3, '110', '12', '2019-06-10', 1),
(4, '110', '45', '2019-06-13', 1),
(5, '12444', '12', '2019-06-13', 1),
(6, '111', '10', '2019-09-28', 1),
(7, '110', '12', '2019-09-28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sales_detail`
--

CREATE TABLE `sales_detail` (
  `Sales_Detail_ID` int(100) NOT NULL,
  `Sales_No` int(70) NOT NULL,
  `Barcode_ID` varchar(50) NOT NULL,
  `Quantity` varchar(25) NOT NULL,
  `Return_Quantity` text NOT NULL,
  `Purchase_Price` text NOT NULL,
  `Sale_Price` text NOT NULL,
  `Detail_Total` text NOT NULL,
  `Sales_Individual_Discount` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_detail`
--

INSERT INTO `sales_detail` (`Sales_Detail_ID`, `Sales_No`, `Barcode_ID`, `Quantity`, `Return_Quantity`, `Purchase_Price`, `Sale_Price`, `Detail_Total`, `Sales_Individual_Discount`) VALUES
(1, 1, '110', '1', '0', '500', '600', '600', '0'),
(2, 2, '110', '1', '0', '500', '600', '600', '0'),
(3, 3, '110', '1', '0', '500', '600', '600', '0'),
(4, 4, '111', '1', '0', '120', '150', '150', '0'),
(5, 4, '110', '1', '0', '500', '600', '600', '0'),
(6, 5, '110', '1', '0', '500', '600', '600', '0'),
(7, 5, '111', '1', '0', '120', '150', '150', '0'),
(8, 6, '110', '1', '0', '500', '600', '600', '0'),
(9, 7, '111', '1', '0', '120', '150', '150', '0'),
(10, 7, '110', '1', '0', '500', '600', '600', '0');

-- --------------------------------------------------------

--
-- Table structure for table `sales_master`
--

CREATE TABLE `sales_master` (
  `Sales_No` int(70) NOT NULL,
  `Invoice_No` int(70) NOT NULL,
  `Invoice_Type_ID` int(11) NOT NULL,
  `Payment_Mode_ID` int(11) NOT NULL,
  `Customer_ID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Master_Total` text NOT NULL,
  `GrandTotal` text NOT NULL,
  `Discount` text NOT NULL,
  `Time` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_master`
--

INSERT INTO `sales_master` (`Sales_No`, `Invoice_No`, `Invoice_Type_ID`, `Payment_Mode_ID`, `Customer_ID`, `Date`, `Master_Total`, `GrandTotal`, `Discount`, `Time`) VALUES
(1, 1, 1, 1, 0, '2019-06-11', '600', '600', '00', '5:15 PM'),
(2, 2, 1, 1, 0, '2019-06-13', '600', '600', '00', '6:32 PM'),
(3, 3, 1, 1, 0, '2019-06-15', '600', '600', '00', '2:30 PM'),
(4, 4, 1, 1, 0, '2019-06-17', '750', '750', '00', '7:10 PM'),
(5, 5, 1, 1, 0, '2019-07-11', '750', '750', '00', '8:25 PM'),
(6, 6, 1, 1, 0, '2019-08-08', '600', '600', '00', '8:10 PM'),
(7, 7, 1, 1, 0, '2019-09-28', '750', '750', '00', '2:11 PM');

-- --------------------------------------------------------

--
-- Table structure for table `sales_return_detail`
--

CREATE TABLE `sales_return_detail` (
  `Sales_Return_Detail_ID` int(100) NOT NULL,
  `Sales_Return_No` int(70) NOT NULL,
  `Barcode_ID` varchar(50) NOT NULL,
  `Quantity` text NOT NULL,
  `Sub_Total` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales_return_master`
--

CREATE TABLE `sales_return_master` (
  `Sales_Return_No` int(70) NOT NULL,
  `Invoice_No` int(70) NOT NULL,
  `Invoice_Type_ID` int(11) NOT NULL,
  `Payment_Mode_ID` int(11) NOT NULL,
  `Customer_ID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Sub_Total` text NOT NULL,
  `GrandTotal` text NOT NULL,
  `Discount` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `temp_table`
--

CREATE TABLE `temp_table` (
  `Barcode_ID` int(11) NOT NULL,
  `Available_Stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trial_balance`
--

CREATE TABLE `trial_balance` (
  `Trial_balance_ID` int(11) NOT NULL,
  `Trial_Balance_Date` date NOT NULL,
  `Account_Title_ID` int(11) NOT NULL,
  `Entry_Type_ID` int(11) NOT NULL,
  `Trial_Balance` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `User_Type_Id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `name`, `User_Type_Id`) VALUES
(1, 'admin', 'admin123', 'Umer Yasin', '1'),
(2, 'usama', '1234', 'Usama', '2');

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE `usertype` (
  `User_Type_Id` int(11) NOT NULL,
  `User_Type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`User_Type_Id`, `User_Type`) VALUES
(1, 'Admin'),
(2, 'Operator');

-- --------------------------------------------------------

--
-- Table structure for table `user_forms`
--

CREATE TABLE `user_forms` (
  `Form_ID` int(11) NOT NULL,
  `Forms_Name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_forms`
--

INSERT INTO `user_forms` (`Form_ID`, `Forms_Name`) VALUES
(1, 'Home'),
(2, 'Business Info'),
(3, 'Customers'),
(4, 'Vendors'),
(5, 'Products'),
(6, 'New Invoice'),
(7, 'Product_Received'),
(8, 'Accounts'),
(9, 'Sales Return'),
(10, 'Exchange_Item'),
(11, 'Reports'),
(12, 'User Management');

-- --------------------------------------------------------

--
-- Table structure for table `user_permission`
--

CREATE TABLE `user_permission` (
  `Permission_ID` int(11) NOT NULL,
  `User_Type_Id` int(11) NOT NULL,
  `Home` varchar(11) NOT NULL,
  `Business` varchar(11) NOT NULL,
  `Customers` varchar(11) NOT NULL,
  `Vendors` varchar(11) NOT NULL,
  `Products` varchar(11) NOT NULL,
  `Product_Received` varchar(11) NOT NULL,
  `New_Invoice` varchar(11) NOT NULL,
  `Accounts` varchar(11) NOT NULL,
  `Sales_Return` varchar(11) NOT NULL,
  `Exchange_Item` varchar(11) NOT NULL,
  `Reports` varchar(11) NOT NULL,
  `User_Management` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_permission`
--

INSERT INTO `user_permission` (`Permission_ID`, `User_Type_Id`, `Home`, `Business`, `Customers`, `Vendors`, `Products`, `Product_Received`, `New_Invoice`, `Accounts`, `Sales_Return`, `Exchange_Item`, `Reports`, `User_Management`) VALUES
(1, 1, '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1'),
(2, 2, '0', '0', '1', '0', '0', '0', '1', '0', '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `Vendor_ID` int(11) NOT NULL,
  `Vendor_Name` varchar(30) NOT NULL,
  `Reg_No` text NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Country_Name` varchar(25) NOT NULL,
  `Contact_No` varchar(13) NOT NULL,
  `Address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_title`
--
ALTER TABLE `account_title`
  ADD PRIMARY KEY (`Account_Title_ID`),
  ADD UNIQUE KEY `Account_Code` (`Account_Code`);

--
-- Indexes for table `business_info`
--
ALTER TABLE `business_info`
  ADD PRIMARY KEY (`Business_ID`);

--
-- Indexes for table `charts_of_accounts`
--
ALTER TABLE `charts_of_accounts`
  ADD PRIMARY KEY (`Head_Of_Account_ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Customer_ID`);

--
-- Indexes for table `due_date`
--
ALTER TABLE `due_date`
  ADD PRIMARY KEY (`Due_Date_ID`);

--
-- Indexes for table `exchange_item`
--
ALTER TABLE `exchange_item`
  ADD PRIMARY KEY (`Exchange_Item_ID`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`Gender_ID`);

--
-- Indexes for table `general_journal_detail`
--
ALTER TABLE `general_journal_detail`
  ADD PRIMARY KEY (`General_Journal_Detail_ID`);

--
-- Indexes for table `general_journal_master`
--
ALTER TABLE `general_journal_master`
  ADD PRIMARY KEY (`Voucher_ID`);

--
-- Indexes for table `income_statement`
--
ALTER TABLE `income_statement`
  ADD PRIMARY KEY (`Income_Statement_ID`);

--
-- Indexes for table `invoicedetails`
--
ALTER TABLE `invoicedetails`
  ADD PRIMARY KEY (`Invoice_Detail_ID`);

--
-- Indexes for table `invoicetype`
--
ALTER TABLE `invoicetype`
  ADD PRIMARY KEY (`Invoice_Type_ID`);

--
-- Indexes for table `invoice_master`
--
ALTER TABLE `invoice_master`
  ADD PRIMARY KEY (`Invoice_No`);

--
-- Indexes for table `link_accounts`
--
ALTER TABLE `link_accounts`
  ADD PRIMARY KEY (`Account_Title_ID`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`Option_ID`);

--
-- Indexes for table `paymentmode`
--
ALTER TABLE `paymentmode`
  ADD PRIMARY KEY (`Payment_Mode_ID`);

--
-- Indexes for table `productcategory`
--
ALTER TABLE `productcategory`
  ADD PRIMARY KEY (`Product_Category_ID`);

--
-- Indexes for table `productunit`
--
ALTER TABLE `productunit`
  ADD PRIMARY KEY (`Product_Unit_Id`);

--
-- Indexes for table `product_color`
--
ALTER TABLE `product_color`
  ADD PRIMARY KEY (`pro_color_id`);

--
-- Indexes for table `product_master`
--
ALTER TABLE `product_master`
  ADD PRIMARY KEY (`Barcode_ID`);

--
-- Indexes for table `product_price`
--
ALTER TABLE `product_price`
  ADD PRIMARY KEY (`Product_Price_ID`);

--
-- Indexes for table `product_size`
--
ALTER TABLE `product_size`
  ADD PRIMARY KEY (`pro_size_id`);

--
-- Indexes for table `product_stock`
--
ALTER TABLE `product_stock`
  ADD PRIMARY KEY (`Product_Stock_ID`);

--
-- Indexes for table `sales_detail`
--
ALTER TABLE `sales_detail`
  ADD PRIMARY KEY (`Sales_Detail_ID`);

--
-- Indexes for table `sales_master`
--
ALTER TABLE `sales_master`
  ADD PRIMARY KEY (`Sales_No`);

--
-- Indexes for table `sales_return_detail`
--
ALTER TABLE `sales_return_detail`
  ADD PRIMARY KEY (`Sales_Return_Detail_ID`);

--
-- Indexes for table `sales_return_master`
--
ALTER TABLE `sales_return_master`
  ADD PRIMARY KEY (`Sales_Return_No`);

--
-- Indexes for table `temp_table`
--
ALTER TABLE `temp_table`
  ADD PRIMARY KEY (`Barcode_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`User_Type_Id`);

--
-- Indexes for table `user_forms`
--
ALTER TABLE `user_forms`
  ADD PRIMARY KEY (`Form_ID`);

--
-- Indexes for table `user_permission`
--
ALTER TABLE `user_permission`
  ADD PRIMARY KEY (`Permission_ID`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`Vendor_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exchange_item`
--
ALTER TABLE `exchange_item`
  MODIFY `Exchange_Item_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `income_statement`
--
ALTER TABLE `income_statement`
  MODIFY `Income_Statement_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoicedetails`
--
ALTER TABLE `invoicedetails`
  MODIFY `Invoice_Detail_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_color`
--
ALTER TABLE `product_color`
  MODIFY `pro_color_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_price`
--
ALTER TABLE `product_price`
  MODIFY `Product_Price_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_size`
--
ALTER TABLE `product_size`
  MODIFY `pro_size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_stock`
--
ALTER TABLE `product_stock`
  MODIFY `Product_Stock_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sales_detail`
--
ALTER TABLE `sales_detail`
  MODIFY `Sales_Detail_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sales_return_detail`
--
ALTER TABLE `sales_return_detail`
  MODIFY `Sales_Return_Detail_ID` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_permission`
--
ALTER TABLE `user_permission`
  MODIFY `Permission_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
