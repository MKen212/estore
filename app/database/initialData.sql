/* Table Initial Data SQL Statements for estore*/

-- Countries data
-- NOTE This assumes CH is Local "Domestic" Country. Change as required
INSERT INTO countries (`Code`, `Name`, `ShippingBand`) VALUES
  ('AD', 'Andorra', 'Europe'),
  ('AE', 'United Arab Emirates', 'Rest of World'),
  ('AF', 'Afghanistan', 'Rest of World'),
  ('AG', 'Antigua and Barbuda', 'Rest of World'),
  ('AI', 'Anguilla', 'Rest of World'),
  ('AL', 'Albania', 'Europe'),
  ('AM', 'Armenia', 'Rest of World'),
  ('AO', 'Angola', 'Rest of World'),
  ('AQ', 'Antarctica', 'Rest of World'),
  ('AR', 'Argentina', 'Rest of World'),
  ('AS', 'American Samoa', 'Rest of World'),
  ('AT', 'Austria', 'Europe'),
  ('AU', 'Australia', 'Rest of World'),
  ('AW', 'Aruba', 'Rest of World'),
  ('AX', 'Åland', 'Europe'),
  ('AZ', 'Azerbaijan', 'Rest of World'),
  ('BA', 'Bosnia and Herzegovina', 'Europe'),
  ('BB', 'Barbados', 'Rest of World'),
  ('BD', 'Bangladesh', 'Rest of World'),
  ('BE', 'Belgium', 'Europe'),
  ('BF', 'Burkina Faso', 'Rest of World'),
  ('BG', 'Bulgaria', 'Europe'),
  ('BH', 'Bahrain', 'Rest of World'),
  ('BI', 'Burundi', 'Rest of World'),
  ('BJ', 'Benin', 'Rest of World'),
  ('BL', 'Saint Barthélemy', 'Rest of World'),
  ('BM', 'Bermuda', 'Rest of World'),
  ('BN', 'Brunei', 'Rest of World'),
  ('BO', 'Bolivia', 'Rest of World'),
  ('BQ', 'Bonaire', 'Rest of World'),
  ('BR', 'Brazil', 'Rest of World'),
  ('BS', 'Bahamas', 'Rest of World'),
  ('BT', 'Bhutan', 'Rest of World'),
  ('BV', 'Bouvet Island', 'Rest of World'),
  ('BW', 'Botswana', 'Rest of World'),
  ('BY', 'Belarus', 'Europe'),
  ('BZ', 'Belize', 'Rest of World'),
  ('CA', 'Canada', 'Rest of World'),
  ('CC', 'Cocos [Keeling] Islands', 'Rest of World'),
  ('CD', 'Democratic Republic of the Congo', 'Rest of World'),
  ('CF', 'Central African Republic', 'Rest of World'),
  ('CG', 'Republic of the Congo', 'Rest of World'),
  ('CH', 'Switzerland', 'Domestic'),
  ('CI', 'Ivory Coast', 'Rest of World'),
  ('CK', 'Cook Islands', 'Rest of World'),
  ('CL', 'Chile', 'Rest of World'),
  ('CM', 'Cameroon', 'Rest of World'),
  ('CN', 'China', 'Rest of World'),
  ('CO', 'Colombia', 'Rest of World'),
  ('CR', 'Costa Rica', 'Rest of World'),
  ('CU', 'Cuba', 'Rest of World'),
  ('CV', 'Cape Verde', 'Rest of World'),
  ('CW', 'Curacao', 'Rest of World'),
  ('CX', 'Christmas Island', 'Rest of World'),
  ('CY', 'Cyprus', 'Europe'),
  ('CZ', 'Czech Republic', 'Europe'),
  ('DE', 'Germany', 'Europe'),
  ('DJ', 'Djibouti', 'Rest of World'),
  ('DK', 'Denmark', 'Europe'),
  ('DM', 'Dominica', 'Rest of World'),
  ('DO', 'Dominican Republic', 'Rest of World'),
  ('DZ', 'Algeria', 'Rest of World'),
  ('EC', 'Ecuador', 'Rest of World'),
  ('EE', 'Estonia', 'Europe'),
  ('EG', 'Egypt', 'Rest of World'),
  ('EH', 'Western Sahara', 'Rest of World'),
  ('ER', 'Eritrea', 'Rest of World'),
  ('ES', 'Spain', 'Europe'),
  ('ET', 'Ethiopia', 'Rest of World'),
  ('FI', 'Finland', 'Europe'),
  ('FJ', 'Fiji', 'Rest of World'),
  ('FK', 'Falkland Islands', 'Rest of World'),
  ('FM', 'Micronesia', 'Rest of World'),
  ('FO', 'Faroe Islands', 'Europe'),
  ('FR', 'France', 'Europe'),
  ('GA', 'Gabon', 'Rest of World'),
  ('GB', 'United Kingdom', 'Europe'),
  ('GD', 'Grenada', 'Rest of World'),
  ('GE', 'Georgia', 'Rest of World'),
  ('GF', 'French Guiana', 'Rest of World'),
  ('GG', 'Guernsey', 'Europe'),
  ('GH', 'Ghana', 'Rest of World'),
  ('GI', 'Gibraltar', 'Europe'),
  ('GL', 'Greenland', 'Rest of World'),
  ('GM', 'Gambia', 'Rest of World'),
  ('GN', 'Guinea', 'Rest of World'),
  ('GP', 'Guadeloupe', 'Rest of World'),
  ('GQ', 'Equatorial Guinea', 'Rest of World'),
  ('GR', 'Greece', 'Europe'),
  ('GS', 'South Georgia and the South Sandwich Islands', 'Rest of World'),
  ('GT', 'Guatemala', 'Rest of World'),
  ('GU', 'Guam', 'Rest of World'),
  ('GW', 'Guinea-Bissau', 'Rest of World'),
  ('GY', 'Guyana', 'Rest of World'),
  ('HK', 'Hong Kong', 'Rest of World'),
  ('HM', 'Heard Island and McDonald Islands', 'Rest of World'),
  ('HN', 'Honduras', 'Rest of World'),
  ('HR', 'Croatia', 'Europe'),
  ('HT', 'Haiti', 'Rest of World'),
  ('HU', 'Hungary', 'Europe'),
  ('ID', 'Indonesia', 'Rest of World'),
  ('IE', 'Ireland', 'Europe'),
  ('IL', 'Israel', 'Rest of World'),
  ('IM', 'Isle of Man', 'Europe'),
  ('IN', 'India', 'Rest of World'),
  ('IO', 'British Indian Ocean Territory', 'Rest of World'),
  ('IQ', 'Iraq', 'Rest of World'),
  ('IR', 'Iran', 'Rest of World'),
  ('IS', 'Iceland', 'Europe'),
  ('IT', 'Italy', 'Europe'),
  ('JE', 'Jersey', 'Europe'),
  ('JM', 'Jamaica', 'Rest of World'),
  ('JO', 'Jordan', 'Rest of World'),
  ('JP', 'Japan', 'Rest of World'),
  ('KE', 'Kenya', 'Rest of World'),
  ('KG', 'Kyrgyzstan', 'Rest of World'),
  ('KH', 'Cambodia', 'Rest of World'),
  ('KI', 'Kiribati', 'Rest of World'),
  ('KM', 'Comoros', 'Rest of World'),
  ('KN', 'Saint Kitts and Nevis', 'Rest of World'),
  ('KP', 'North Korea', 'Rest of World'),
  ('KR', 'South Korea', 'Rest of World'),
  ('KW', 'Kuwait', 'Rest of World'),
  ('KY', 'Cayman Islands', 'Rest of World'),
  ('KZ', 'Kazakhstan', 'Rest of World'),
  ('LA', 'Laos', 'Rest of World'),
  ('LB', 'Lebanon', 'Rest of World'),
  ('LC', 'Saint Lucia', 'Rest of World'),
  ('LI', 'Liechtenstein', 'Europe'),
  ('LK', 'Sri Lanka', 'Rest of World'),
  ('LR', 'Liberia', 'Rest of World'),
  ('LS', 'Lesotho', 'Rest of World'),
  ('LT', 'Lithuania', 'Europe'),
  ('LU', 'Luxembourg', 'Europe'),
  ('LV', 'Latvia', 'Europe'),
  ('LY', 'Libya', 'Rest of World'),
  ('MA', 'Morocco', 'Rest of World'),
  ('MC', 'Monaco', 'Europe'),
  ('MD', 'Moldova', 'Europe'),
  ('ME', 'Montenegro', 'Europe'),
  ('MF', 'Saint Martin', 'Rest of World'),
  ('MG', 'Madagascar', 'Rest of World'),
  ('MH', 'Marshall Islands', 'Rest of World'),
  ('MK', 'North Macedonia', 'Europe'),
  ('ML', 'Mali', 'Rest of World'),
  ('MM', 'Myanmar [Burma]', 'Rest of World'),
  ('MN', 'Mongolia', 'Rest of World'),
  ('MO', 'Macao', 'Rest of World'),
  ('MP', 'Northern Mariana Islands', 'Rest of World'),
  ('MQ', 'Martinique', 'Rest of World'),
  ('MR', 'Mauritania', 'Rest of World'),
  ('MS', 'Montserrat', 'Rest of World'),
  ('MT', 'Malta', 'Europe'),
  ('MU', 'Mauritius', 'Rest of World'),
  ('MV', 'Maldives', 'Rest of World'),
  ('MW', 'Malawi', 'Rest of World'),
  ('MX', 'Mexico', 'Rest of World'),
  ('MY', 'Malaysia', 'Rest of World'),
  ('MZ', 'Mozambique', 'Rest of World'),
  ('NA', 'Namibia', 'Rest of World'),
  ('NC', 'New Caledonia', 'Rest of World'),
  ('NE', 'Niger', 'Rest of World'),
  ('NF', 'Norfolk Island', 'Rest of World'),
  ('NG', 'Nigeria', 'Rest of World'),
  ('NI', 'Nicaragua', 'Rest of World'),
  ('NL', 'Netherlands', 'Europe'),
  ('NO', 'Norway', 'Europe'),
  ('NP', 'Nepal', 'Rest of World'),
  ('NR', 'Nauru', 'Rest of World'),
  ('NU', 'Niue', 'Rest of World'),
  ('NZ', 'New Zealand', 'Rest of World'),
  ('OM', 'Oman', 'Rest of World'),
  ('PA', 'Panama', 'Rest of World'),
  ('PE', 'Peru', 'Rest of World'),
  ('PF', 'French Polynesia', 'Rest of World'),
  ('PG', 'Papua New Guinea', 'Rest of World'),
  ('PH', 'Philippines', 'Rest of World'),
  ('PK', 'Pakistan', 'Rest of World'),
  ('PL', 'Poland', 'Europe'),
  ('PM', 'Saint Pierre and Miquelon', 'Rest of World'),
  ('PN', 'Pitcairn Islands', 'Rest of World'),
  ('PR', 'Puerto Rico', 'Rest of World'),
  ('PS', 'Palestine', 'Rest of World'),
  ('PT', 'Portugal', 'Europe'),
  ('PW', 'Palau', 'Rest of World'),
  ('PY', 'Paraguay', 'Rest of World'),
  ('QA', 'Qatar', 'Rest of World'),
  ('RE', 'Réunion', 'Rest of World'),
  ('RO', 'Romania', 'Europe'),
  ('RS', 'Serbia', 'Europe'),
  ('RU', 'Russia', 'Europe'),
  ('RW', 'Rwanda', 'Rest of World'),
  ('SA', 'Saudi Arabia', 'Rest of World'),
  ('SB', 'Solomon Islands', 'Rest of World'),
  ('SC', 'Seychelles', 'Rest of World'),
  ('SD', 'Sudan', 'Rest of World'),
  ('SE', 'Sweden', 'Europe'),
  ('SG', 'Singapore', 'Rest of World'),
  ('SH', 'Saint Helena', 'Rest of World'),
  ('SI', 'Slovenia', 'Europe'),
  ('SJ', 'Svalbard and Jan Mayen', 'Europe'),
  ('SK', 'Slovakia', 'Europe'),
  ('SL', 'Sierra Leone', 'Rest of World'),
  ('SM', 'San Marino', 'Europe'),
  ('SN', 'Senegal', 'Rest of World'),
  ('SO', 'Somalia', 'Rest of World'),
  ('SR', 'Suriname', 'Rest of World'),
  ('SS', 'South Sudan', 'Rest of World'),
  ('ST', 'São Tomé and Príncipe', 'Rest of World'),
  ('SV', 'El Salvador', 'Rest of World'),
  ('SX', 'Sint Maarten', 'Rest of World'),
  ('SY', 'Syria', 'Rest of World'),
  ('SZ', 'Swaziland', 'Rest of World'),
  ('TC', 'Turks and Caicos Islands', 'Rest of World'),
  ('TD', 'Chad', 'Rest of World'),
  ('TF', 'French Southern Territories', 'Rest of World'),
  ('TG', 'Togo', 'Rest of World'),
  ('TH', 'Thailand', 'Rest of World'),
  ('TJ', 'Tajikistan', 'Rest of World'),
  ('TK', 'Tokelau', 'Rest of World'),
  ('TL', 'East Timor', 'Rest of World'),
  ('TM', 'Turkmenistan', 'Rest of World'),
  ('TN', 'Tunisia', 'Rest of World'),
  ('TO', 'Tonga', 'Rest of World'),
  ('TR', 'Turkey', 'Rest of World'),
  ('TT', 'Trinidad and Tobago', 'Rest of World'),
  ('TV', 'Tuvalu', 'Rest of World'),
  ('TW', 'Taiwan', 'Rest of World'),
  ('TZ', 'Tanzania', 'Rest of World'),
  ('UA', 'Ukraine', 'Europe'),
  ('UG', 'Uganda', 'Rest of World'),
  ('UM', 'U.S. Minor Outlying Islands', 'Rest of World'),
  ('US', 'United States', 'Rest of World'),
  ('UY', 'Uruguay', 'Rest of World'),
  ('UZ', 'Uzbekistan', 'Rest of World'),
  ('VA', 'Vatican City', 'Europe'),
  ('VC', 'Saint Vincent and the Grenadines', 'Rest of World'),
  ('VE', 'Venezuela', 'Rest of World'),
  ('VG', 'British Virgin Islands', 'Rest of World'),
  ('VI', 'U.S. Virgin Islands', 'Rest of World'),
  ('VN', 'Vietnam', 'Rest of World'),
  ('VU', 'Vanuatu', 'Rest of World'),
  ('WF', 'Wallis and Futuna', 'Rest of World'),
  ('WS', 'Samoa', 'Rest of World'),
  ('XK', 'Kosovo', 'Europe'),
  ('YE', 'Yemen', 'Rest of World'),
  ('YT', 'Mayotte', 'Rest of World'),
  ('ZA', 'South Africa', 'Rest of World'),
  ('ZM', 'Zambia', 'Rest of World'),
  ('ZW', 'Zimbabwe', 'Rest of World');

-- Shipping data
-- UPDATED Jun-2020 based on Swiss Post prices
INSERT INTO shipping (`Band`, `Type`, `PriceBandKG`, `PriceBandCost`) VALUES
  ('Domestic', 'Standard', '2', '7.00'),
  ('Domestic', 'Standard', '5', '9.70'),
  ('Domestic', 'Standard', '10', '9.70'),
  ('Domestic', 'Fast', '2', '9.00'),
  ('Domestic', 'Fast', '5', '10.70'),
  ('Domestic', 'Fast', '10', '10.70'),
  ('Domestic', 'Express', '2', '18.00'),
  ('Domestic', 'Express', '5', '22.00'),
  ('Domestic', 'Express', '10', '22.00'),
  ('Europe', 'Standard', '2', '34.00'),
  ('Europe', 'Standard', '5', '42.00'),
  ('Europe', 'Standard', '10', '46.00'),
  ('Europe', 'Fast', '2', '38.00'),
  ('Europe', 'Fast', '5', '48.00'),
  ('Europe', 'Fast', '10', '56.00'),
  ('Europe', 'Express', '2', '98.00'),
  ('Europe', 'Express', '5', '158.00'),
  ('Europe', 'Express', '10', '200.00'),
  ('Rest of World', 'Standard', '2', '44.00'),
  ('Rest of World', 'Standard', '5', '57.00'),
  ('Rest of World', 'Standard', '10', '76.00'),
  ('Rest of World', 'Fast', '2', '53.00'),
  ('Rest of World', 'Fast', '5', '76.00'),
  ('Rest of World', 'Fast', '10', '104.00'),
  ('Rest of World', 'Express', '2', '119.00'),
  ('Rest of World', 'Express', '5', '182.00'),
  ('Rest of World', 'Express', '10', '250.00');

-- Product Categories data
INSERT INTO prod_categories (`Name`) VALUES
  ('Clothes-Men'),
  ('Clothes-Women'),
  ('Shoes-Men'),
  ('Shoes-Women');

-- Product Brands data
INSERT INTO prod_brands (`Name`) VALUES
  ('UnBranded'),
  ('Armani'),
  ('Burberry'),
  ('Hermes'),
  ('Prada');