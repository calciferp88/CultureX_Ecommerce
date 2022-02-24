	
<!-- ClutureX Database Setup File -->
<!-- A database named 'culturexdb' is required to be created first -->
<!-- After creating database, run this file with DROP queries commented -->

<?php

	$connect = mysqli_connect('localhost','root','','culturexdb');

	//---CREATE---

    $createstaff = "CREATE TABLE staff (
    staffID INT(11) NOT NULL PRIMARY KEY,
    staffName VARCHAR(30),
    staffEmail VARCHAR(30),
    cultureXMail VARCHAR(30),
    staffRole VARCHAR(30),
    staffPhone VARCHAR(20),
    staffGender VARCHAR(30),
    staffPassword TEXT,
    status VARCHAR(20))";

	$createbrand = "CREATE TABLE brand (
	brandID INT(11) NOT NULL PRIMARY KEY,
	brandName VARCHAR(50),
	staffID INT(11),
	FOREIGN KEY(staffID) REFERENCES staff(staffID))";

	$createcategory = "CREATE TABLE category (
	categoryID INT(11) NOT NULL PRIMARY KEY,
	categoryName VARCHAR(50),
	status VARCHAR(10) )";

	$createuser = "CREATE TABLE user (
	userID INT(11) NOT NULL PRIMARY KEY,
	userName VARCHAR(30),
	userEmail VARCHAR(30),
	userPhone VARCHAR(20),
	userPassword TEXT,
	userDateOfBirth DATE,
	userCountry VARCHAR(30),
	userGender VARCHAR(30),
	sellerStatus BOOLEAN,
	status VARCHAR(10))";

	$createincome = "CREATE TABLE income (
	incomeID INT(11) NOT NULL PRIMARY KEY,
	incomeDate DATE,
	incomeDay VARCHAR(30),
	incomeMonth VARCHAR(30),
	incomeYear INT(5),
	incomeAmount INT(10),
	cardType VARCHAR(20),
	cardNumber VARCHAR(30),
	incomeStatus VARCHAR(10),
	userID INT(11),
	FOREIGN KEY(userID) REFERENCES user(userID))";

	$createsneaker = "CREATE TABLE sneaker (
	sneakerID INT(11) NOT NULL PRIMARY KEY,
	sneakerName VARCHAR(30),
	sneakerPrice INT(10),
	sneakerSubCategory VARCHAR(10),
	description TEXT,
	inStock INT(10),
	onSaleDate DATE,
	totalSale INT,
	productImage1 TEXT,
	productImage2 TEXT,
	productImage3 TEXT,
	productImage4 TEXT,
	productImage5 TEXT,
	sellerID INT(11),
	brandID INT(11),
	categoryID INT(11),
	FOREIGN KEY(sellerID) REFERENCES user(userID),
	FOREIGN KEY(brandID) REFERENCES brand(brandID),
	FOREIGN KEY(categoryID) REFERENCES category(categoryID))";

	$createauction = "CREATE TABLE auction (
	auctionID INT(11) NOT NULL PRIMARY KEY,
	endDate DATE,
	endTime TIME,
	reservePrice INT(11),
	headshotPrice INT(11),
	increment INT(11),
	currentBid INT(11),
	currentAuctioneer INT(11),
	sneakerID INT(11),
	auctionStatus VARCHAR(50),
	FOREIGN KEY(currentAuctioneer) REFERENCES user(userID),
	FOREIGN KEY(sneakerID) REFERENCES sneaker(sneakerID))";

	$createadvertisement = "CREATE TABLE advertisement (
	advertisementID INT(11) NOT NULL PRIMARY KEY,
	advertiserID INT(11),
	advertiseImage TEXT,
	startDate DATE,
	advertiseLength int(11),
	day1 DATE,
	day2 DATE,
	day3 DATE,
	FOREIGN KEY(advertiserID) REFERENCES user(userID))";

	$creatpurchase = "CREATE TABLE purchase (
	purchaseID INT(11) NOT NULL PRIMARY KEY,
	purchaseDate DATE,
	purchaseDay INT(10),
	purchaseMonth VARCHAR(10),
	purchaseYear INT(5),
	totalPrice INT(10),
	cardType VARCHAR(30),
	cardNumber INT(30),
	receiverName VARCHAR(50),
	receiverEmail VARCHAR(50),
	receiverPhone VARCHAR(30),
	postalCode VARCHAR(20),
	city VARCHAR(50),
	fullAddress TEXT,
	purchaseStatus VARCHAR(30),
	buyerID INT(11),
	sellerID INT(11),
	FOREIGN KEY(buyerID) REFERENCES user(userID),
	FOREIGN KEY(sellerID) REFERENCES user(userID))";

	$createpurchasesneaker = "CREATE TABLE purchasesneaker (
	purchaseID INT(11) NOT NULL,
	sneakerID INT(11) NOT NULL,
	sneakerQuantity INT(11),
	FOREIGN KEY(purchaseID) REFERENCES purchase(purchaseID),
	FOREIGN KEY(sneakerID) REFERENCES sneaker(sneakerID))";

	$createdeliverystaff = "CREATE TABLE deliverystaff (
	deliveryStaffID INT(11) NOT NULL PRIMARY KEY,
	deliverystaffName VARCHAR(30),
	deliveryStaffEmail VARCHAR(30),
	quickMail VARCHAR(50),
	deliveryStaffPhone INT(30),
	deliverystaffRole VARCHAR(30),
	deliveryStaffPassword TEXT,
	status VARCHAR(30))";

	$createdelivery = "CREATE TABLE delivery (
	deliveryID INT(11) NOT NULL PRIMARY KEY,
	purchaseID INT(11),
	arrivalDate DATE,
	deliveryStaffID INT(11),
	FOREIGN KEY(deliveryStaffID) REFERENCES deliverystaff(deliveryStaffID),
	FOREIGN KEY(purchaseID) REFERENCES purchase(purchaseID))";

	$createnoti = "CREATE TABLE notification (
	notificationID INT(11) NOT NULL,
	notification TEXT,
	notiDate DATE,
	notiTime TIME,
	notiStatus TEXT,
	auctionID INT(11),
	purchaseID INT(11),
	userID INT(11),
	FOREIGN KEY(auctionID) REFERENCES auction(auctionID),
	FOREIGN KEY(purchaseID) REFERENCES purchase(purchaseID),
	FOREIGN KEY(userID) REFERENCES user(userID))";

	// //	---RUN creating tables---

	$runcategory = mysqli_query($connect, $createcategory);
	$runstaff = mysqli_query($connect, $createstaff);
	$runbrand = mysqli_query($connect, $createbrand);
	$runuser  = mysqli_query($connect, $createuser);
	$runsneaker = mysqli_query($connect, $createsneaker);
	$runauction = mysqli_query($connect, $createauction);
	$runincome = mysqli_query($connect, $createincome);
	$runpurchase = mysqli_query($connect, $creatpurchase);
	$runpurchasesneaker = mysqli_query($connect, $createpurchasesneaker);
	$runadvertisement = mysqli_query($connect, $createadvertisement);
	$rundeliverystaff = mysqli_query($connect, $createdeliverystaff);
	$rundelivery = mysqli_query($connect, $createdelivery);
	$runnoti  = mysqli_query($connect, $createnoti);


	// // Alert if RUN Successfully

	if ($runbrand){ echo "Brand Table Created</br>";
	}else{	echo mysqli_error($connect);}

	if ($runcategory){ echo "Category Table Created</br>";
	}else{	echo mysqli_error($connect);}

	if ($runstaff){ echo "Staff Table Created</br>";
	}else{	echo mysqli_error($connect);}

	if ($runuser){ echo "User Table Created</br>";
	}else{	echo mysqli_error($connect);}

	if ($runsneaker){ echo "Sneaker Table Created</br>";
	}else{	echo mysqli_error($connect);}

	if ($runincome){ echo "Income Table Created</br>";
	}else{	echo mysqli_error($connect);}

	if ($runauction){ echo "Auction Table Created</br>";
	}else{	echo mysqli_error($connect);}

	if ($runpurchase){ echo "Purchase Table Created</br>";
	}else{	echo mysqli_error($connect);}

	if ($runpurchasesneaker){ echo "PurchaseSneaker Dummy Table Created</br>";
	}else{	echo mysqli_error($connect);}

	if ($runadvertisement){ echo "Advertisement Table Created</br>";
	}else{	echo mysqli_error($connect);}

	if ($rundeliverystaff){ echo "Delivery Staff Table Created</br>";
	}else{	echo mysqli_error($connect);}

	if ($rundelivery){ echo "Delivery Table Created</br>";
	}else{	echo mysqli_error($connect);}

	// if ($runnoti){ echo "Notification Table Created</br>";
	// }else{	echo mysqli_error($connect);}

	//---Default Insert for admin---

	$hash = md5('adminstaff');

	$insertstaff = "INSERT INTO staff
	VALUES (1, 'Admin', 'admin@gmail.com', 'admin@culturex.com', 'Admin', '09456269274','Male', '$hash', '')";

	// delivery staff insert
	$insertdelistaff = "INSERT INTO deliverystaff
	VALUES (1, 'Delivery Admin', 'deli@gmail.com', 'deliadmin@quick.com', '099877899', 'Admin','$hash', 'free')";	

	//---RUN Default INSERT---
	$runstaffinsert = mysqli_query($connect, $insertstaff);
	$rundelistaffinsert = mysqli_query($connect, $insertdelistaff);

	// --- Insert Successfully
	if ($runstaffinsert){
	echo "Default Admin Data inserted</br>";
	}else{  echo mysqli_error($connect);}

	if ($rundelistaffinsert){
	echo "Default Delivery Admin Data inserted</br>"; 	
	}else{  echo mysqli_error($connect);}



 ?>
