
CREATE TABLE IF NOT EXISTS `payments` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,  
  `txn_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_gross` float(10,2) NOT NULL,
  `currency_code` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `payment_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

//https://www.sandbox.paypal.com/signin?returnUri=https%3A%2F%2Fwww.sandbox.paypal.com%2Fmep

// https://developer.paypal.com/developer/accounts/

// username : bathirinath3@gmail.com  pass: bathiri9

// profile -> profile and setting -> my selling tools -> website preference -> auto return -> on ->return url -> ur file url
// https://www.formget.com/paypal-subscription/